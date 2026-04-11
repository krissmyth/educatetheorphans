<?php

namespace App\Console\Commands;

use App\Models\NewsItem;
use App\Services\MailchimpService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncMailchimpCampaigns extends Command
{
    protected $signature   = 'news:sync {--force : Clear cache before syncing}';
    protected $description = 'Sync Mailchimp campaigns into the local news_items table';

    public function handle(MailchimpService $mailchimp): int
    {
        $this->info('Fetching campaigns from Mailchimp...');

        if ($this->option('force')) {
            $mailchimp->clearCache();
        }

        try {
            $campaigns = $mailchimp->getCampaigns();
        } catch (\Exception $e) {
            $this->error('Failed to fetch campaigns: ' . $e->getMessage());
            Log::error('news:sync failed', ['error' => $e->getMessage()]);
            return self::FAILURE;
        }

        if (empty($campaigns)) {
            $this->warn('No campaigns returned from Mailchimp.');
            return self::SUCCESS;
        }

        $synced  = 0;
        $skipped = 0;

        foreach ($campaigns as $campaign) {
            $id = $campaign['id'] ?? null;
            if (!$id) {
                continue;
            }

            // Fetch full HTML content for each campaign
            try {
                $html = $mailchimp->getCampaignContent($id);
            } catch (\Exception $e) {
                $this->warn("Could not fetch content for campaign {$id}: " . $e->getMessage());
                $html = null;
            }

            // Extract featured image from stored HTML
            $featuredImage = null;
            if ($html) {
                preg_match_all('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $html, $matches);
                $images = $matches[1] ?? [];
                // Use 2nd image (skip header logo), fall back to 1st
                $featuredImage = $images[1] ?? $images[0] ?? null;
            }

            NewsItem::updateOrCreate(
                ['mailchimp_id' => $id],
                [
                    'title'          => $campaign['subject'],
                    'preview'        => $campaign['preview'] ?? null,
                    'featured_image' => $campaign['featured_image'] ?? $featuredImage,
                    'content'        => $html,
                    'status'         => $campaign['status'] ?? 'sent',
                    'sent_at'        => $campaign['send_time'] ?? null,
                    'synced_at'      => now(),
                ]
            );

            $this->line("  ✓ {$campaign['subject']}");
            $synced++;
        }

        $this->info("Sync complete: {$synced} campaigns synced, {$skipped} skipped.");
        return self::SUCCESS;
    }
}
