<?php

namespace App\Models;

use App\Events\TradeEvent;
use App\Jobs\MailJob;
use App\Traits\Uuids;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Laravel\Scout\Searchable;
use LaravelMultipleGuards\Traits\FindGuard;
use Note\Models\Notification;
use World\Countries\Model\Country;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes, Uuids, FindGuard, Searchable;

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
        'role_id',
        'country_id',
        'name',
        'slug',
        'email',
        'phone_number',
        'password',
        'is_active',
        'can_receive_offer_notification',
        'can_receive_news_letter'
    ];

    /**
     * set phone number as the default username
     */
    public function username(): string
    {
        return 'phone_number';
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * override the default
     * laravel emailing here
     * and call yours
     * @param $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $user = User::query()->firstWhere('email', request()->input('email'));
        if ($user)
            dispatch(new MailJob(
                $user->name,
                $user->email,
                'Account Password Reset',
                'You are receiving this email because we received a password reset request for your account. This password reset
		link will expire in 60 minutes. If you did not request a password reset, no further action is required.',
                true,
                url(config('app.url') . '/reset-password/' . $token),
                'Account Password Reset'
            ))->onQueue('emails')->delay(2);
    }

    /**
     * send verification email
     * to the registered user
     * @return void
     * @throws Exception
     */
    public function sendEmailVerificationNotification()
    {
        if (auth()->check()) {
            dispatch(new MailJob(
                $this->findGuardType()->user()->name,
                $this->findGuardType()->user()->email,
                'Verify Email Address',
                'Please click the button below to verify your email address. If you did not create an account, no further action is required.',
                true,
                URL::temporarySignedRoute(
                    'verification.verify',
                    Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                    [
                        'id' => $this->findGuardType()->id(),
                        'hash' => sha1($this->findGuardType()->user()->email),
                    ]
                ),
                'Verify Email Address'
            ))->onQueue('emails')->delay(2);
        } else {
            $user = User::query()->firstWhere('email', request()->input('email'));
            dispatch(new MailJob(
                $user->name,
                $user->email,
                'Verify Email Address',
                'Please click the button below to verify your email address. If you did not create an account, no further action is required.',
                true,
                URL::temporarySignedRoute(
                    'verification.verify',
                    Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                    [
                        'id' => $user->id,
                        'hash' => sha1($user->email),
                    ]
                ),
                'Verify Email Address'
            ))->onQueue('emails')->delay(2);
        }
    }

    /**
     * get notifications
     * @return MorphMany @
     */
    public function notification(): MorphMany
    {
        return $this->morphMany(Notification::class, 'notification');
    }

    /**
     * get country
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * role
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * user_detail
     * @return HasOne
     */
    public function user_detail(): HasOne
    {
        return $this->hasOne(UserDetail::class);
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
     * order
     * @return HasMany
     */
    public function order(): HasMany
    {
        return $this->hasMany(Order::class)->latest();
    }

    /**
     * product
     * @return HasMany
     */
    public function product(): HasMany
    {
        return $this->hasMany(Product::class)->latest();
    }

    /**
     * wish_lists
     * @return HasMany
     */
    public function wish_list(): HasMany
    {
        return $this->hasMany(WishList::class)->latest();
    }

    /**
     * wallet
     * @return HasOne
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
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
     * statements
     * @return HasMany
     */
    public function statement(): HasMany
    {
        return $this->hasMany(Statement::class)->latest();
    }

    /**
     * mpesas
     * @return HasMany
     */
    public function mpesa(): HasMany
    {
        return $this->hasMany(Mpesa::class)->latest();
    }
}
