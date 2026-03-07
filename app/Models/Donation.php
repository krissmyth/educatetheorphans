<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'stripe_payment_intent_id',
        'stripe_customer_id',
        'paypal_order_id',
        'paypal_transaction_id',
        'amount',
        'currency',
        'frequency',
        'payment_method',
        'payment_gateway',
        'status',
        'donor_email',
        'donor_name',
        'donor_phone',
        'gift_aid_eligible',
        'gift_aid_title',
        'gift_aid_first_name',
        'gift_aid_last_name',
        'gift_aid_address_line1',
        'gift_aid_address_line2',
        'gift_aid_city',
        'gift_aid_postcode',
        'aggregated_donations',
        'sponsored_event',
        'gift_aid_declaration_date',
        'metadata',
        'completed_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'gift_aid_eligible' => 'boolean',
        'sponsored_event' => 'boolean',
        'gift_aid_declaration_date' => 'date',
        'completed_at' => 'datetime',
        'metadata' => 'array',
    ];

    /**
     * Scope for completed donations
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope for Gift Aid eligible donations
     */
    public function scopeWithGiftAid($query)
    {
        return $query->where('gift_aid_eligible', true);
    }

    /**
     * Get Gift Aid amount (25% of donation)
     */
    public function getGiftAidAmountAttribute()
    {
        return $this->gift_aid_eligible ? $this->amount * 0.25 : 0;
    }

    /**
     * Get total amount including Gift Aid
     */
    public function getTotalWithGiftAidAttribute()
    {
        return $this->amount + $this->gift_aid_amount;
    }
}
