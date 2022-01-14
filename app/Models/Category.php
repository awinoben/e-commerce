<?php

namespace App\Models;

use App\Events\TradeEvent;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Category extends Model
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
        'is_special'
    ];

    /**
     * set casts
     *
     * @var array
     */
    protected $casts = [
        'is_special' => 'boolean'
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
     * products
     * @return HasMany
     */
    public function product(): HasMany
    {
        return $this->hasMany(Product::class)->latest();
    }

    /**
     * sub_category
     * @return HasMany
     */
    public function sub_category(): HasMany
    {
        return $this->hasMany(SubCategory::class)->latest();
    }

    /**
     * sub_sub_category
     * @return HasMany
     */
    public function sub_sub_category(): HasMany
    {
        return $this->hasMany(SubSubCategory::class)->latest();
    }
}
