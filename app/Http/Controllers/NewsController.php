<?php

namespace App\Http\Controllers;

use App\Services\MailchimpService;
use Illuminate\View\View;

class NewsController extends Controller
{
    protected MailchimpService $mailchimp;

    public function __construct(MailchimpService $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    /**
     * Display the news listing page with latest campaigns
     */
    public function index(): View
    {
        $campaigns = $this->mailchimp->getCampaigns();

        return view('news', [
            'campaigns' => $campaigns,
            'title' => 'News',
        ]);
    }

    /**
     * Display a single campaign detail page
     */
    public function show(string $id): View
    {
        $campaign = $this->mailchimp->getCampaign($id);

        if (!$campaign) {
            abort(404, 'Campaign not found');
        }

        $content = $this->mailchimp->getCampaignContent($id);

        // Get all campaigns to show related items
        $allCampaigns = $this->mailchimp->getCampaigns();
        $relatedCampaigns = array_filter($allCampaigns, function ($c) use ($id) {
            return $c['id'] !== $id;
        });
        $relatedCampaigns = array_slice($relatedCampaigns, 0, 3);

        return view('campaign-detail', [
            'campaign' => $campaign,
            'content' => $content,
            'relatedCampaigns' => $relatedCampaigns,
            'title' => $campaign['subject'],
        ]);
    }
}
