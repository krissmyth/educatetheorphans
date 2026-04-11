<?php

namespace App\Http\Controllers;

use App\Models\PageView;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'todayPageViews'     => PageView::getTodayPageViews(),
            'todayUniqueVisitors'=> PageView::getTodayUniqueVisitors(),
            'totalPageViews'     => PageView::getPageViewsCount(30),
            'totalVisitors'      => PageView::getVisitorCount(30),
            'mostViewedPages'    => PageView::getMostViewedPages(5),
            'topReferrers'       => PageView::getTopReferrers(5),
            'visitorsTrend'      => PageView::getVisitorsLastDays(7),
            'pageViewsTrend'     => PageView::getPageViewsLastDays(7),
        ]);
    }
}
