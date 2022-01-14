<?php

namespace App\Models;

use App\Events\TradeEvent;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Order extends Model
{
    use HasFactory, Uuids, SoftDeletes, Searchable;

    // stop autoincrement
    public $incrementing = false;

    /**
     * type of auto-increment
     *
     * @string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'payment_option_id',
        'quantity',
        'sub_cost',
        'order_number',
        'is_dispatched',
        'is_cancelled',
        'is_received',
        'is_paid',
        'is_payment_dispatched'
    ];

    /**
     * trigger this to create a slug before
     * any save happens
     */
    protected $dispatchesEvents = [
        'saving' => TradeEvent::class,
        'creating' => TradeEvent::class,
        'updating' => TradeEvent::class
    ];

    /**
     * user
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * earning
     * @return HasOne
     */
    public function earning(): HasOne
    {
        return $this->hasOne(Earning::class);
    }

    /**
     * history
     * @return HasMany
     */
    public function history(): HasMany
    {
        return $this->hasMany(History::class)->latest();
    }

    /**
     * payment option
     * @return BelongsTo
     */
    public function payment_option(): BelongsTo
    {
        return $this->belongsTo(PaymentOption::class);
    }

    /**
     * payment option
     * @return HasMany
     */
    public function mpesa(): HasMany
    {
        return $this->hasMany(Mpesa::class);
    }
}
