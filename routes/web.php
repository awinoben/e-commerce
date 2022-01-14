<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\AnalyticsDashboard;
use App\Http\Livewire\Admin\Brand\AddBrand;
use App\Http\Livewire\Admin\Brand\EditBrand;
use App\Http\Livewire\Admin\Brand\ListBrand;
use App\Http\Livewire\Admin\Category\AddCategory;
use App\Http\Livewire\Admin\Category\EditCategory;
use App\Http\Livewire\Admin\Category\ListCategory;
use App\Http\Livewire\Admin\Color\AddColor;
use App\Http\Livewire\Admin\Color\EditColor;
use App\Http\Livewire\Admin\Color\ListColor;
use App\Http\Livewire\Admin\Customer\CustomerList;
use App\Http\Livewire\Admin\Filter\AddFilter;
use App\Http\Livewire\Admin\Filter\ListFilter;
use App\Http\Livewire\Admin\Location\AddLocation;
use App\Http\Livewire\Admin\Location\EditLocation;
use App\Http\Livewire\Admin\Location\ListLocation;
use App\Http\Livewire\Admin\Order\AllOrder;
use App\Http\Livewire\Admin\Order\CancelledOrder;
use App\Http\Livewire\Admin\Order\DeliveredOrder;
use App\Http\Livewire\Admin\Order\NewOrder;
use App\Http\Livewire\Admin\Order\OrderDetail;
use App\Http\Livewire\Admin\Order\PendingOrder;
use App\Http\Livewire\Admin\Payment\MpesaList;
use App\Http\Livewire\Admin\Payment\StatementList;
use App\Http\Livewire\Admin\Product\AddProduct;
use App\Http\Livewire\Admin\Product\EditProduct;
use App\Http\Livewire\Admin\Product\ListProduct;
use App\Http\Livewire\Admin\Product\ProductReview;
use App\Http\Livewire\Admin\Profile\AdminProfile;
use App\Http\Livewire\Admin\Sale\SalesList;
use App\Http\Livewire\Admin\Size\AddSize;
use App\Http\Livewire\Admin\Size\EditSize;
use App\Http\Livewire\Admin\Size\ListSize;
use App\Http\Livewire\Admin\Slide\AddSlide;
use App\Http\Livewire\Admin\Slide\ListSlide;
use App\Http\Livewire\Admin\Subcategory\AddSubCategory;
use App\Http\Livewire\Admin\Subcategory\EditSubCategory;
use App\Http\Livewire\Admin\Subcategory\ListSubCategory;
use App\Http\Livewire\Admin\Subscriber\ListSubscribers;
use App\Http\Livewire\Admin\SubSubCategory\AddSubSubCategory;
use App\Http\Livewire\Admin\SubSubCategory\EditSubSubCategory;
use App\Http\Livewire\Admin\SubSubCategory\ListSubSubCategory;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Home;
use App\Http\Livewire\Page\AboutUs;
use App\Http\Livewire\Page\CategoryShop;
use App\Http\Livewire\Page\CheckoutPage;
use App\Http\Livewire\Page\ComparePage;
use App\Http\Livewire\Page\ContactUs;
use App\Http\Livewire\Page\ProductPage;
use App\Http\Livewire\Page\Shop;
use App\Http\Livewire\Page\ShoppingCart;
use App\Http\Livewire\Page\SubCategoryShop;
use App\Http\Livewire\Page\WishlistPage;
use App\Http\Livewire\User\AccountDetails;
use App\Http\Livewire\User\UserHistory;
use App\Http\Livewire\User\UserMpesa;
use App\Http\Livewire\User\UserOrders;
use App\Http\Livewire\User\UserStatement;
use App\Http\Livewire\User\UserWishList;
use App\Http\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([
    'prefix' => '/'
], function () {
    Route::get('', Welcome::class)->name('welcome');
    Route::get('home', Home::class)->name('home');
    Route::get('about', AboutUs::class)->name('about.us');
    Route::get('contact', ContactUs::class)->name('contact.us');
    Route::get('shop/{category_id?}/{name?}', Shop::class)->name('shop');
    Route::get('product/{id}', ProductPage::class)->name('product.page');
    Route::get('cart', ShoppingCart::class)->name('shopping.cart');
    Route::get('wishlist', WishlistPage::class)->name('wishlist.page');
    Route::get('compare', ComparePage::class)->name('compare.page');
    Route::get('category-shop/{slug}', CategoryShop::class)->name('category.shop');
    Route::get('sub-category-shop/{id}', SubCategoryShop::class)->name('sub.category.shop');
});

Route::group([
    'prefix' => '/',
    'middleware' => ['auth']
], function () {
    Route::post('verify-email', [EmailVerificationNotificationController::class, 'store'])->name('verification.resend');

    Route::group([
        'prefix' => '/',
        'middleware' => ['verified']
    ], function () {
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('logout', [HomeController::class, 'logout'])->name('user.logout');

        Route::group([
            'prefix' => 'customer'
        ], function () {
            Route::get('checkout', CheckoutPage::class)->name('checkout.page');
            Route::get('account', AccountDetails::class)->name('user.details');
            Route::get('orders', UserOrders::class)->name('user.orders');
            Route::get('histories', UserHistory::class)->name('user.histories');
            Route::get('wishlists', UserWishList::class)->name('user.wishlists');
            Route::get('mpesas', UserMpesa::class)->name('user.mpesas');
            Route::get('statements', UserStatement::class)->name('user.statements');
        });
    });
});

Route::group([
    'prefix' => 'admin',
], function () {
    Route::get('login', [AuthenticatedSessionController::class, 'loginAdminPage'])->name('admin.login');
    Route::post('login', [AuthenticatedSessionController::class, 'loginAdmin'])->name('admin.login.post');


    Route::group([
        'middleware' => ['auth:admin']
    ], function () {
        Route::get('dashboard', AdminDashboard::class)->name('admin.dashboard');
        Route::get('profile', AdminProfile::class)->name('admin.profile');
        Route::get('analytics', AnalyticsDashboard::class)->name('admin.analytics');
        Route::get('sales', SalesList::class)->name('admin.sales.list');
        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::group([
            'prefix' => 'customers'
        ], function () {
            Route::get('/', CustomerList::class)->name('admin.customer.list');
        });

        Route::group([
            'prefix' => 'brands'
        ], function () {
            Route::get('add', AddBrand::class)->name('admin.add.brand');
            Route::get('edit/{id}', EditBrand::class)->name('admin.edit.brand');
            Route::get('list', ListBrand::class)->name('admin.list.brand');
        });

        Route::group([
            'prefix' => 'category'
        ], function () {
            Route::get('add', AddCategory::class)->name('admin.add.category');
            Route::get('edit/{id}', EditCategory::class)->name('admin.edit.category');
            Route::get('list', ListCategory::class)->name('admin.list.category');
        });

        Route::group([
            'prefix' => 'filters'
        ], function () {
            Route::get('add', AddFilter::class)->name('admin.add.filter');
            Route::get('list', ListFilter::class)->name('admin.list.filter');
        });

        Route::group([
            'prefix' => 'sub-category'
        ], function () {
            Route::get('add', AddSubCategory::class)->name('admin.add.sub.category');
            Route::get('edit/{id}', EditSubCategory::class)->name('admin.edit.sub.category');
            Route::get('list', ListSubCategory::class)->name('admin.list.sub.category');
        });

        Route::group([
            'prefix' => 'sub-sub-category'
        ], function () {
            Route::get('add', AddSubSubCategory::class)->name('admin.add.sub.sub.category');
            Route::get('edit/{id}', EditSubSubCategory::class)->name('admin.edit.sub.sub.category');
            Route::get('list', ListSubSubCategory::class)->name('admin.list.sub.sub.category');
        });

        Route::group([
            'prefix' => 'slides'
        ], function () {
            Route::get('add', AddSlide::class)->name('admin.add.slide');
            Route::get('list', ListSlide::class)->name('admin.list.slide');
        });

        Route::group([
            'prefix' => 'size'
        ], function () {
            Route::get('add', AddSize::class)->name('admin.add.size');
            Route::get('list', ListSize::class)->name('admin.list.size');
            Route::get('edit/{id}', EditSize::class)->name('admin.edit.size');
        });

        Route::group([
            'prefix' => 'color'
        ], function () {
            Route::get('add', AddColor::class)->name('admin.add.color');
            Route::get('list', ListColor::class)->name('admin.list.color');
            Route::get('edit/{id}', EditColor::class)->name('admin.edit.color');
        });

        Route::group([
            'prefix' => 'location'
        ], function () {
            Route::get('add', AddLocation::class)->name('admin.add.location');
            Route::get('list', ListLocation::class)->name('admin.list.location');
            Route::get('edit/{id}', EditLocation::class)->name('admin.edit.location');
        });

        Route::group([
            'prefix' => 'product'
        ], function () {
            Route::get('add', AddProduct::class)->name('admin.add.product');
            Route::get('edit/{id}', EditProduct::class)->name('admin.edit.product');
            Route::get('list', ListProduct::class)->name('admin.list.product');
            Route::get('review/{id}', ProductReview::class)->name('admin.list.product.reviews');
        });

        Route::group([
            'prefix' => 'orders'
        ], function () {
            Route::get('detail/{id}', OrderDetail::class)->name('admin.order.detail');
            Route::get('new', NewOrder::class)->name('admin.new.order');
            Route::get('pending', PendingOrder::class)->name('admin.pending.order');
            Route::get('delivered', DeliveredOrder::class)->name('admin.delivered.order');
            Route::get('cancelled', CancelledOrder::class)->name('admin.cancelled.order');
            Route::get('all', AllOrder::class)->name('admin.all.order');
        });

        Route::group([
            'prefix' => 'payments'
        ], function () {
            Route::get('m-pesa', MpesaList::class)->name('admin.mpesa.list');
            Route::get('statements', StatementList::class)->name('admin.statement.list');
        });

        Route::group([
            'prefix' => 'subscribers'
        ], function () {
            Route::get('list', ListSubscribers::class)->name('admin.subscribe.list');
        });
    });
});

require __DIR__ . '/auth.php';
