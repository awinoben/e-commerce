<?php

namespace App\Models;

use App\Events\TradeEvent;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Slide extends Model
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
        'name',
        'slug',
        'url',
        'slide_image',
        'slide_image_url',
    ];

    /**
     * trigger this to create a slug before
     * any save happens
     */
    protected $dispatchesEvents = [
        'saving' => TradeEvent::class,
        'creating' => TradeEvent::class,
        'updating' => TradeEvent::class,
    ];
}
