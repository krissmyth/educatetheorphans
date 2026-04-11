<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    protected $fillable = [
        'mailchimp_id',
        'title',
        'preview',
        'featured_image',
        'content',
        'status',
        'sent_at',
        'synced_at',
    ];

    protected $casts = [
        'sent_at'   => 'datetime',
        'synced_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'sent')->whereNotNull('sent_at');
    }
}
