<?php

namespace App\Http\Controllers;

use App\Models\PageView;
use App\Models\Donation;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Get analytics data
        $todayPageViews = PageView::getTodayPageViews();
        $todayUniqueVisitors = PageView::getTodayUniqueVisitors();
        $totalPageViews = PageView::getPageViewsCount(30);
        $totalVisitors = PageView::getVisitorCount(30);
        $mostViewedPages = PageView::getMostViewedPages(5);
        $topReferrers = PageView::getTopReferrers(5);
        $visitorsTrend = PageView::getVisitorsLastDays(7);
        $pageViewsTrend = PageView::getPageViewsLastDays(7);

        // Get donation stats
        $totalDonations = Donation::where('status', 'completed')->sum('amount');
        $donationCount = Donation::where('status', 'completed')->count();
        $averageDonation = $donationCount > 0 ? round($totalDonations / $donationCount, 2) : 0;

        return view('dashboard', [
            'todayPageViews' => $todayPageViews,
            'todayUniqueVisitors' => $todayUniqueVisitors,
            'totalPageViews' => $totalPageViews,
            'totalVisitors' => $totalVisitors,
            'mostViewedPages' => $mostViewedPages,
            'topReferrers' => $topReferrers,
            'visitorsTrend' => $visitorsTrend,
            'pageViewsTrend' => $pageViewsTrend,
            'totalDonations' => number_format($totalDonations, 2),
            'donationCount' => $donationCount,
            'averageDonation' => number_format($averageDonation, 2),
        ]);
    }
}
