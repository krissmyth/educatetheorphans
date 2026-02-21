<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class MailchimpService
{
    protected ApiClient $client;
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('mailchimp.api_key');

        $this->client = new ApiClient();
        $this->client->setConfig([
            'apiKey' => $this->apiKey,
            'server' => $this->getServerPrefix(),
        ]);
    }

    /**
     * Get the server prefix from the API key
     * Mailchimp API keys have format: key-serverprefix (e.g., xxxxx-us12)
     */
    private function getServerPrefix(): string
    {
        $parts = explode('-', $this->apiKey);
        return end($parts) ?: 'us1';
    }

    /**
     * Get the latest 12 campaigns
     */
    public function getCampaigns(): array
    {
        $cacheKey = 'mailchimp.campaigns';

        return Cache::remember($cacheKey, 86400, function () {
            try {
                // Fetch 12 campaigns, sorted by send_time descending (newest first)
                $response = $this->client->campaigns->list(
                    null,      // fields
                    null,      // exclude_fields
                    12,        // count
                    0,         // offset
                    null,      // type
                    null,      // status
                    null,      // before_send_time
                    null,      // since_send_time
                    null,      // before_create_time
                    null,      // since_create_time
                    null,      // list_id
                    null,      // folder_id
                    null,      // member_id
                    'send_time', // sort_field
                    'desc'     // sort_dir (descending = newest first)
                );

                $campaigns = [];
                if (isset($response->campaigns) && is_array($response->campaigns)) {
                    foreach ($response->campaigns as $campaign) {
                        $formatted = $this->formatCampaign($campaign);

                        // Try to extract featured image from campaign
                        $formatted['featured_image'] = $this->extractFeaturedImage($campaign->id);

                        $campaigns[] = $formatted;
                    }
                }

                return $campaigns;
            } catch (\Exception $e) {
                Log::error('Mailchimp API error getting campaigns: ' . $e->getMessage());
                return [];
            }
        });
    }

    /**
     * Get a single campaign by ID
     */
    public function getCampaign(string $id): ?array
    {
        $cacheKey = 'mailchimp.campaign.' . $id;

        return Cache::remember($cacheKey, 86400, function () use ($id) {
            try {
                $campaign = $this->client->campaigns->get($id);
                return $this->formatCampaign($campaign);
            } catch (\Exception $e) {
                Log::error('Mailchimp API error getting campaign ' . $id . ': ' . $e->getMessage());
                return null;
            }
        });
    }

    /**
     * Get the HTML content of a campaign
     */
    public function getCampaignContent(string $id): ?string
    {
        $cacheKey = 'mailchimp.campaign.content.' . $id;

        return Cache::remember($cacheKey, 86400, function () use ($id) {
            try {
                $content = $this->client->campaigns->getContent($id);
                return $content->html ?? null;
            } catch (\Exception $e) {
                Log::error('Mailchimp API error getting campaign content ' . $id . ': ' . $e->getMessage());
                return null;
            }
        });
    }

    /**
     * Format campaign data for consistent display
     */
    private function formatCampaign($campaign): array
    {
        return [
            'id'               => $campaign->id ?? null,
            'subject'          => $campaign->settings?->subject_line ?? $campaign->subject_line ?? 'Untitled Campaign',
            'preview'          => $campaign->settings?->preview_text ?? $campaign->preview_text ?? '',
            'send_time'        => $campaign->send_time ?? null,
            'create_time'      => $campaign->create_time ?? null,
            'type'             => $campaign->type ?? null,
            'status'           => $campaign->status ?? null,
            'list_id'          => $campaign->recipients?->list_id ?? null,
            'opens'            => $campaign->report_summary?->opens ?? 0,
            'clicks'           => $campaign->report_summary?->clicks ?? 0,
            'opens_rate'       => isset($campaign->report_summary?->open_rate) ? round($campaign->report_summary->open_rate * 100, 2) : 0,
            'clicks_rate'      => isset($campaign->report_summary?->click_rate) ? round($campaign->report_summary->click_rate * 100, 2) : 0,
            'emails_sent'      => $campaign->report_summary?->emails_sent ?? 0,
            'bounces'          => $campaign->report_summary?->bounces ?? 0,
            'featured_image'   => null,
        ];
    }

    /**
     * Clear all campaign cache (useful for manual refreshes)
     */
    public function clearCache(): void
    {
        Cache::forget('mailchimp.campaigns');
        // Note: Individual campaign caches should be cleared separately if needed
    }

    /**
     * Extract featured image from campaign content
     * Fetches the 2nd or 3rd image (skips header) from campaign HTML
     */
    private function extractFeaturedImage(string $campaignId): ?string
    {
        try {
            // Use the campaigns content endpoint
            $cacheKey = 'mailchimp.campaign.images.' . $campaignId;

            return Cache::remember($cacheKey, 86400, function () use ($campaignId) {
                $content = $this->client->campaigns->getContent($campaignId);

                if (!isset($content->html) || empty($content->html)) {
                    return null;
                }

                // Extract all image URLs from the HTML
                preg_match_all('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $content->html, $matches);

                if (empty($matches[1])) {
                    return null;
                }

                $images = $matches[1];

                // Return 2nd image if available, otherwise 3rd
                if (count($images) > 1) {
                    return $images[1];
                } elseif (count($images) > 2) {
                    return $images[2];
                }

                return null;
            });
        } catch (\Exception $e) {
            Log::error('Error extracting featured image from campaign ' . $campaignId . ': ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Subscribe an email to the mailing list
     * Returns an array with 'success' boolean and 'message' string
     */
    public function subscribe(string $email, ?string $firstName = null, ?string $lastName = null): array
    {
        try {
            $listId = config('mailchimp.list_id');

            if (!$listId) {
                Log::error('Mailchimp list ID not configured');
                return [
                    'success' => false,
                    'message' => 'Service configuration error. Please try again later.'
                ];
            }

            $data = [
                'email_address' => strtolower($email),
                'status' => 'pending',
                'merge_fields' => [
                    'FNAME' => $firstName ?: 'Friend',
                    'LNAME' => $lastName ?: 'of ETO',
                ]
            ];

            Log::info('Mailchimp subscription attempt', ['email' => $email, 'data' => $data]);

            $this->client->lists->addListMember($listId, $data);
            Log::info('Mailchimp subscription success', ['email' => $email]);

            return [
                'success' => true,
                'message' => 'Thanks for subscribing! Check your email for confirmation.'
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            Log::error('Mailchimp API error', ['status' => $statusCode, 'body' => $body]);

            // Parse JSON response to get specific error message
            $errorData = json_decode($body, true);

            if ($statusCode === 400 && isset($errorData['title'])) {
                $title = $errorData['title'];
                $detail = $errorData['detail'] ?? '';

                // Handle specific Mailchimp errors
                if (stripos($title, 'Forgotten Email') !== false) {
                    // For forgotten emails, try to re-add with 'subscribed' status
                    // which can work for previously deleted members
                    try {
                        Log::info('Attempting to re-add forgotten email with subscribed status', ['email' => $email]);
                        $data['status'] = 'subscribed';
                        $this->client->lists->addListMember($listId, $data);
                        Log::info('Successfully re-added forgotten email', ['email' => $email]);
                        return [
                            'success' => true,
                            'message' => 'Thanks for subscribing! Check your email for confirmation.'
                        ];
                    } catch (\Throwable $retryError) {
                        Log::error('Failed to re-add forgotten email', ['email' => $email, 'error' => $retryError->getMessage()]);
                        return [
                            'success' => false,
                            'message' => 'We had trouble adding this email. Please try again in a few moments, or contact us at support@educatetheorphans.com if the problem persists.'
                        ];
                    }
                } elseif (stripos($title, 'Member Exists') !== false) {
                    return [
                        'success' => false,
                        'message' => 'This email is already subscribed to our list.'
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => $detail ?: 'Unable to subscribe. Please try again later.'
                    ];
                }
            }

            return [
                'success' => false,
                'message' => 'Unable to subscribe. Please try again later.'
            ];
        } catch (\Throwable $e) {
            Log::error('Mailchimp subscription error', ['message' => $e->getMessage(), 'type' => get_class($e)]);
            return [
                'success' => false,
                'message' => 'Unable to subscribe. Please try again later.'
            ];
        }
    }
}
