<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    protected $fillable = ['name', 'email', 'subject', 'message', 'email_sent', 'read'];

    protected $casts = [
        'email_sent' => 'boolean',
        'read'       => 'boolean',
    ];
}
