<?php

namespace App\Models;

use App\Events\TradeEvent;
use App\Traits\Uuids;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Product extends Model implements Buyable
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
        'product_id',
        'product_type',
        'brand_id',
        'category_id',
        'sub_category_id',
        'sub_sub_category_id',
        'sku', // stock keeping unit
        'name',
        'slug',
        'model',
        'part_number',
        'description',
        'details',
        'weight_unit',
        'weight_value',
        'processor',
        'hard_drive',
        'hard_drive_type',
        'memory',
        'operating_system',
        'old_cost',
        'new_cost',
        'buying_price',
        'selling_price',
        'available_quantity',
        'reordering_level',
        'part_names',
        'sizes',
        'colors'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sizes' => 'array',
        'colors' => 'array'
    ];

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }

    /**
     * get colors
     * @return BelongsToMany
     */
    public function color(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'color_products')->latest();
    }

    /**
     * get sizes
     * @return BelongsToMany
     */
    public function size(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'size_products')->latest();
    }

    /**
     * get user
     * @return morphTo
     */
    public function productable(): morphTo
    {
        return $this->morphTo('products');
    }

    /**
     * get category
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * get sub_category
     * @return BelongsTo
     */
    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    /**
     * get sub_sub_category
     * @return BelongsTo
     */
    public function sub_sub_category(): BelongsTo
    {
        return $this->belongsTo(SubSubCategory::class);
    }

    /**
     * get history
     * @return HasMany
     */
    public function history(): HasMany
    {
        return $this->hasMany(History::class)->latest();
    }

    /**
     * get wish_lists
     * @return HasOne
     */
    public function wish_list(): HasOne
    {
        return $this->hasOne(WishList::class);
    }

    /**
     * get options
     * @return HasOne
     */
    public function option(): HasOne
    {
        return $this->hasOne(Option::class);
    }

    /**
     * get product_option
     * @return HasOne
     */
    public function product_option(): HasOne
    {
        return $this->hasOne(ProductOption::class);
    }

    /**
     * get product_option
     * @return HasMany
     */
    public function product_options(): HasMany
    {
        return $this->hasMany(ProductOption::class)->latest();
    }

    /**
     * get product_images
     * @return HasOne
     */
    public function product_image(): HasOne
    {
        return $this->hasOne(ProductImage::class);
    }

    /**
     * get product_data_sheets
     * @return HasMany
     */
    public function product_data_sheet(): HasMany
    {
        return $this->hasMany(ProductDataSheet::class);
    }

    /**
     * reviews
     * @return HasMany
     */
    public function review(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * get brand
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
