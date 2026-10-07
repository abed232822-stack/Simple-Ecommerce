<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SessionController;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Products;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Info pages (placeholder content)
$pages = [
    'about' => ['About', ['We are a small online shop that brings sellers and customers together.', 'Every product is reviewed before it goes live, so you can shop with confidence.']],
    'contact' => ['Contact', ['Questions about an order or a product? We would love to hear from you.', 'Email: support@example.com', 'Phone: +000 000 000 000']],
    'shipping-policy' => ['Shipping Policy', ['Orders are processed after they are accepted by our team.', 'Shipping details will be added here soon.']],
    'returns' => ['Returns & Exchanges', ['Changed your mind? You can delete a pending order from your orders page.', 'Full return details will be added here soon.']],
    'faq' => ['FAQ', ['How do I place an order? Add products to your cart, then confirm your order.', 'How do I become a seller? Create an account and choose the seller role.', 'More answers will be added here soon.']],
];

foreach ($pages as $slug => [$title, $paragraphs]) {
    Route::get("/$slug", fn () => view('page', ['title' => $title, 'paragraphs' => $paragraphs]))->name("page.$slug");
}

//Products
Route::get('/', function () {
    return view('landingPage',['products'=>Products::where('status','accepted')->latest()->take(5)->get(),'categories'=>Category::latest()->take(6)->get()]);
});

Route::get('/allProducts', function () {
    return view('all-products',['products'=>Products::where('status','accepted')->get()]);
})->name('AllProducts');

Route::get('/product/{product}',[ProductsController::class,'create'])
    ->name('productDetail');

Route::get('/AddProduct',[ProductsController::class,'createAdd'])
    ->name('AddProduct.view')
    ->middleware(['auth','can:create product']);

Route::Post('/AddProduct',[ProductsController::class,'store'])
    ->name('AddProduct.store')
    ->middleware(['auth','can:create product']);

Route::delete('/product/{product}',[ProductsController::class,'destroy'])
    ->name('ProductDelete')
    ->middleware(['auth','can:delete product']);

//Categories
Route::get('/allCategories', function () {
    return view('all-categories',['categories'=>Category::all()]);
})->name('AllCategories');

Route::get('/Category/{category}',[CategoryController::class,'show'])
    ->name('ShowCategoryProducts');

//Session
Route::get('/login', [SessionController::class,'create'])->name('login')->middleware('guest');
Route::post('/login',[SessionController::class,'store'])->name('login.post');
Route::delete('/login',[SessionController::class,'destroy'])->name('logout');

Route::get('/register', [RegisterController::class,'create']);
Route::post('/register',[RegisterController::class,'store'])->name('register.post');

//Cart
Route::Post('/product/{id}',[CartController::class,'AddToCart'])
    ->name('AddToCart')
    ->middleware(['auth','can:add to cart']);

Route::get('/cart',[CartController::class,'index'])
    ->name('cart')
    ->middleware(['auth','can:view cart']);

Route::delete('/cart/{id}',[CartController::class,'destroy'])
    ->name('cart.delete')
    ->middleware(['auth','can:remove from cart']);

//Order
Route::post('/order',[OrderController::class,'store'])
    ->name('order.post')
    ->middleware(['auth','can:create order']);

Route::post('/orderDetail',[OrderDetailController::class,'store'])
    ->name('orderDetail.post')
    ->middleware(['auth','can:create order details']);

Route::get('/order/{id}',[OrderController::class,'show'])
    ->name('show.order')
    ->middleware(['auth','can:view own orders']);

Route::get('/order/{order}/details',[OrderController::class,'showDetail'])
    ->name('showDetails.order')
    ->middleware(['auth','can:view order details']);

Route::delete('/order/{order}',[OrderController::class,'destroy'])
    ->name('order.delete')
    ->middleware(['auth','can:delete own order']);

//seller
Route::get('Seller/Dashboard/seller',[SellerController::class,'create'])
    ->name('SellerDashboard')
    ->middleware(['auth','can:access seller dashboard']);

Route::get('Seller/Dashboard/seller/{product}/edit',[SellerController::class,'edit'])
    ->name('SellerDashboard.edit')
    ->middleware(['auth','can:edit product']);

Route::Put('Seller/Dashboard/seller/{product}',[SellerController::class,'update'])
    ->name('SellerDashboard.update')
    ->middleware(['auth','can:update product']);

//Admin
Route::get('/Admin/Dashboard/Customers',[AdminController::class,'GetCustomers'])
    ->name('GetCustomers')
    ->middleware(['auth','can:view customers']);

Route::get('/Admin/Dashboard/Sellers',[AdminController::class,'GetSellers'])
    ->name('GetSellers')
    ->middleware(['auth','can:view sellers']);

Route::put('/Admin/UpdateSalary/{user}',[AdminController::class,'UpdateBalance'])
    ->name('UpdateBalance')
    ->middleware(['auth','can:update user balance']);

Route::get('/Admin/{user}/Orders',[AdminController::class,'CustomerOrdersShow'])
    ->name('CustomerOrders')
    ->middleware(['auth','can:view customer orders']);

Route::get('/Admin/{user}/Products',[AdminController::class,'SellerProductsShow'])
    ->name('SellerProducts')
    ->middleware(['auth','can:view seller products']);

Route::put('/Admin/{order}/AcceptingRejectingOrder',[AdminController::class,'AcceptingRejectingOrder'])
    ->name('AcceptingRejectingOrder')
    ->middleware(['auth','can:accept order']);

Route::put('/Admin/{product}/AcceptingProduct',[AdminController::class,'AcceptingPorductPublish'])
    ->name('AcceptingProduct')
    ->middleware(['auth','can:accept product']);

//Search
Route::get('/search/suggestions', [SearchController::class, 'suggestions']);

//Notifications
Route::post('/Notification/MarkAsRead',function (){
    Auth::user()->unreadNotifications->markAsRead();
})->name('MarkAsRead')
->middleware(['auth','can:mark notifications as read']);