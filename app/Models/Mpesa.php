<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Mpesa extends Model
{
    use HasFactory, Uuids, SoftDeletes, Searchable;

    /**
     * stop the autoincrement
     */
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
        'order_id',
        'reference_number',
        'transaction_number',
        'phone_number',
        'description',
        'amount',
        'options',
        'payload',
        'attempts',
        'is_paid',
        'is_withdrawn',
        'is_initiated',
        'is_successful',
        'queued_at',
        'callback_received_at',
    ];

    /**
     * create casts
     */
    protected $casts = [
        'options' => 'array',
        'payload' => 'array'
    ];

    /**
     * get user
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * get order
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
