<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsItem;
use App\Services\MailchimpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class NewsSyncController extends Controller
{
    public function sync(MailchimpService $mailchimp): RedirectResponse
    {
        try {
            $mailchimp->clearCache();
            $campaigns = $mailchimp->getCampaigns();

            if (empty($campaigns)) {
                return back()->with('warning', 'No campaigns found in Mailchimp.');
            }

            $synced = 0;

            foreach ($campaigns as $campaign) {
                $id = $campaign['id'] ?? null;
                if (!$id) continue;

                $html = null;
                try {
                    $html = $mailchimp->getCampaignContent($id);
                } catch (\Exception $e) {
                    Log::warning("Could not fetch content for campaign {$id}: " . $e->getMessage());
                }

                $featuredImage = null;
                if ($html) {
                    preg_match_all('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $html, $matches);
                    $images = $matches[1] ?? [];
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

                $synced++;
            }

            return back()->with('success', "Sync complete — {$synced} campaigns imported from Mailchimp.");

        } catch (\Exception $e) {
            Log::error('Mailchimp sync failed: ' . $e->getMessage());
            return back()->with('error', 'Sync failed: ' . $e->getMessage());
        }
    }
}
