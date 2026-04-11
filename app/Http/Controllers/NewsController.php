<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
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
     * Subscribe an email to the newsletter
     */
    public function subscribe()
    {
        request()->validate([
            'email'     => 'required|email',
            'firstName' => 'required|string',
            'lastName'  => 'required|string',
        ]);

        $result = $this->mailchimp->subscribe(
            request('email'),
            request('firstName'),
            request('lastName')
        );

        if ($result['success']) {
            return response()->json(['success' => true,  'message' => $result['message']]);
        }

        return response()->json(['success' => false, 'message' => $result['message']], 422);
    }

    /**
     * Display the news listing page — reads from local database
     */
    public function index(): View
    {
        $items = NewsItem::published()
            ->orderByDesc('sent_at')
            ->get();

        return view('news', ['items' => $items]);
    }

    /**
     * Display a single news item — reads from local database
     */
    public function show(string $id): View
    {
        // Support both numeric DB id and mailchimp_id string
        $item = is_numeric($id)
            ? NewsItem::findOrFail($id)
            : NewsItem::where('mailchimp_id', $id)->firstOrFail();

        $related = NewsItem::published()
            ->where('id', '!=', $item->id)
            ->orderByDesc('sent_at')
            ->limit(3)
            ->get();

        return view('campaign-detail', [
            'item'    => $item,
            'related' => $related,
        ]);
    }
}
