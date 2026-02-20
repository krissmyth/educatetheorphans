<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'page_url',
        'page_name',
        'ip_address',
        'user_agent',
        'referer',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getMostViewedPages($limit = 10)
    {
        return self::selectRaw('page_name, page_url, COUNT(*) as views')
            ->groupBy('page_url', 'page_name')
            ->orderByDesc('views')
            ->limit($limit)
            ->get();
    }

    public static function getVisitorCount($days = 30)
    {
        return self::where('created_at', '>=', now()->subDays($days))
            ->selectRaw('COUNT(DISTINCT ip_address) as count')
            ->first()
            ->count ?? 0;
    }

    public static function getPageViewsCount($days = 30)
    {
        return self::where('created_at', '>=', now()->subDays($days))
            ->count();
    }

    public static function getTodayPageViews()
    {
        return self::whereDate('created_at', today())->count();
    }

    public static function getTodayUniqueVisitors()
    {
        return self::whereDate('created_at', today())
            ->selectRaw('COUNT(DISTINCT ip_address) as count')
            ->first()
            ->count ?? 0;
    }

    public static function getTopReferrers($limit = 5)
    {
        return self::selectRaw('referer, COUNT(*) as visits')
            ->whereNotNull('referer')
            ->where('referer', '!=', '')
            ->groupBy('referer')
            ->orderByDesc('visits')
            ->limit($limit)
            ->get();
    }

    public static function getVisitorsLastDays($days = 7)
    {
        return self::where('created_at', '>=', now()->subDays($days))
            ->selectRaw('DATE(created_at) as date, COUNT(DISTINCT ip_address) as visitors')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    }

    public static function getPageViewsLastDays($days = 7)
    {
        return self::where('created_at', '>=', now()->subDays($days))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as views')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    }
}
