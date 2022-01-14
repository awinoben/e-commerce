<?php

namespace App\Http\Controllers;

use App\Models\ColorProduct;
use App\Models\Option;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductOption;
use App\Models\ProductSize;
use App\Models\SizeProduct;
use Carbon\Carbon;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Propaganistas\LaravelPhone\PhoneNumber;
use YoHang88\LetterAvatar\LetterAvatar;

class SystemController extends Controller
{
    /**
     * instance of controller
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * returns the elapsed time
     * @param $time
     * @return false|string
     */
    public static function elapsedTime($time)
    {
        return Carbon::parse($time)->diffForHumans();
    }

    /**
     * Write the system log files
     * @param array $data
     * @param string $channel
     * @param string $fileName
     */
    public static function log(array $data, string $channel, string $fileName)
    {
        $file = storage_path('logs/' . $fileName . '.log');

        // finally, create a formatter
        $formatter = new JsonFormatter();

        // Create the log data
        $log = [
            'ip' => request()->getClientIp(),
            'data' => $data,
        ];
        // Create a handler
        $stream = new StreamHandler($file, Logger::INFO);
        $stream->setFormatter($formatter);

        // bind it to a logger object
        $securityLogger = new Logger($channel);
        $securityLogger->pushHandler($stream);
        $securityLogger->log('info', $channel, $log);
    }

    /**
     * generate avatars here
     * @param string $name
     * @param int $size
     * @return LetterAvatar
     */
    public static function generateAvatars(string $name, int $size): LetterAvatar
    {
        return new LetterAvatar($name, 'square', $size);
    }

    /**
     * get greetings here
     * @return string
     */
    public static function pass_greetings_to_user(): string
    {
        if (date("H") < 12) {
            return "Good Morning";
        } elseif (date("H") >= 12 && date("H") < 16) {
            return "Good Afternoon";
        } elseif (date("H") >= 16) {
            return "Good Evening";
        }
    }

    /**
     * store image here
     * @param $image_request
     * @param string|null $fileName
     * @param string $path
     * @return array|string[]
     */
    public static function store_media($image_request, string $path = 'photos', string $fileName = null): array
    {
        // check if feature_image exists
        if (isset($image_request)) {
            if (isset($fileName)) {
                // check if image exists
                self::un_link_media($fileName, $path);
            }

            // generate new name for image
            $newFileName = Str::slug(Str::slug($image_request->getClientOriginalName()) . '_' . Str::random(8)) . '.' . $image_request->extension();

            // store the new image
            $image_request->storeAs($path, $newFileName, 'public');

            return [
                $newFileName, // this will be the new file name i.e shiftechafrica.png
                config('app.url') . '/storage/' . $path . '/' . $newFileName // set the path for loading the image i.e http://storage/path/shiftechfrica.png
            ];
        }
        return [null, '#'];
    }

    /**
     * unlink media here
     * @param string|null $fileName
     * @param string $path
     */
    public static function un_link_media(string $fileName = null, string $path = 'photos')
    {
        // check if image exists
        $exists = File::exists(storage_path('app/public/' . $path . '/' . $fileName));
        if ($exists && !is_null($fileName)) {
            // unlink the media here after upload
            unlink(storage_path('app/public/' . $path . '/' . $fileName));
        }
    }

    /**
     * sync the product options i.e the upgrades and so on here
     * @param string $product_id
     * @param array $product_ids
     */
    public static function sync_products_options(string $product_id, array $product_ids)
    {
        if (count($product_ids)) {
            // remove items
            $option = Option::query()->updateOrCreate([
                'product_id' => $product_id
            ]);

//            ProductOption::query()
//                ->where('option_id', $option->id)
//                ->forceDelete();

            foreach ($product_ids as $item) {
                // update items
                ProductOption::query()->updateOrCreate([
                    'product_id' => $item,
                    'option_id' => $option->id
                ]);
            }
        }
    }

    /**
     * extract part names here
     * @param array $productIDS
     * @return array
     */
    public static function syncPartNames(array $productIDS): array
    {
        $part_names = array();
        $products = Product::query()->whereIn('id', $productIDS)->get();
        if (count($products)) {
            foreach ($products as $product) {
                array_push($part_names, Str::lower($product->name));
            }

        }
        return $part_names;
    }


    /**
     * sync relation here
     * @param array $data
     * @param object $product
     * @param bool $is_colors
     * @return void
     */
    public static function relationSyncing(array $data, object $product, bool $is_colors = true)
    {
        if ($is_colors) {
            if (count($data))
                foreach ($data as $datum) {
                    // remove items
                    ColorProduct::query()
                        ->whereNotIn('color_id', $data)
                        ->where('product_id', $product->id)
                        ->forceDelete();

                    // update items
                    ColorProduct::query()->updateOrCreate([
                        'color_id' => $datum,
                        'product_id' => $product->id
                    ]);
                }
        } else {
            if (count($data))
                foreach ($data as $datum) {
                    // remove items
                    SizeProduct::query()
                        ->whereNotIn('size_id', $data)
                        ->where('product_id', $product->id)
                        ->forceDelete();

                    // update items
                    SizeProduct::query()->updateOrCreate([
                        'size_id' => $datum,
                        'product_id' => $product->id
                    ]);
                }
        }
    }

    /**
     * get sum of all the items in the cart
     * @return float
     */
    public static function cartSubTotal(): float
    {
        $sum = 0.00;
        foreach (Cart::instance('shopping')->content() as $cart) {
            $sum += $cart->model->selling_price * $cart->qty;
        }

        return $sum;
    }

    /**
     * format phone number
     * @param string $phoneNumber
     * @param string $short2Code
     * @param bool $payment
     * @return string
     */
    public static function format_phone_number(string $phoneNumber, string $short2Code, bool $payment = false): string
    {
        if ($payment)
            return "" . ltrim((string)PhoneNumber::make($phoneNumber)->ofCountry($short2Code), "+");
        return (string)PhoneNumber::make($phoneNumber)->ofCountry($short2Code);
    }

    /**
     * validate the phone number with country
     * @param string $phoneNumber
     * @param string $short2Code
     * @return bool
     */
    public static function validate_phone_number(string $phoneNumber, string $short2Code): bool
    {
        try {
            return PhoneNumber::make($phoneNumber, $short2Code)->isOfCountry($short2Code);
        } catch (Exception $exception) {
            return false;
        }
    }

    /**
     * get default currency
     * @return string
     */
    public static function defaultCurrency(): string
    {
        return (string)CacheController::cacheCountries()
            ->where('slug', Str::slug('Kenya'))
            ->first()
            ->data['currencyCode'];
    }
}
