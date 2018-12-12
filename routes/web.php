<?php

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

Route::get('/', function () {
    return view('pages.index');
})->name('home');

Route::get('/food/{key}', '\\' . \App\Http\Controllers\ProductsAction::class)->name('food');

Route::post('/subscribe', function (\Illuminate\Http\Request $request) {
    $subscriber = new \App\Subscriber();
    $subscriber->email = $request->input('email');
    $subscriber->status = 1;
    $subscriber->save();

    $mail = new \App\Mail\UserSubscribedEmail($request->input('email'));
    \App\Jobs\SendEmail::dispatch($mail)->onQueue('emails');

    return redirect('/thank-you');
})->name('subscribe');

Route::get('/thank-you', function (\Illuminate\Http\Request $request) {
    return view('pages.thank-you-for-subcription');
})->name('thank-you');

Route::get('/cart/add/{id}', '\\' . \App\Http\Controllers\AddToCartAction::class)->name('add-to-cart');
Route::get('/cart/remove/{id}', '\\' . \App\Http\Controllers\AddToCartAction::class)->name('add-to-cart');
Route::get('/cart', '\\' . \App\Http\Controllers\ShowCartAction::class)->name('show-cart');

//Route::get('/admin/form', '\\' . \App\Http\Controllers\FormAction::class)->name('admin-form');
//Route::post('/admin/form', '\\' . \App\Http\Controllers\FormAction::class)->name('admin-form-proceeding');

Route::match(['get', 'post'], '/admin/form', '\\' . \App\Http\Controllers\FormAction::class)->name('admin-form');
Route::match(['get'], '/admin/products', function () {
    return view('admin/products-list', ['products' => \App\Product::all()]);
})->name('admin-products');

Route::match(['delete'], '/admin/products-delete', function (\Illuminate\Http\Request $request) {
    $product = \App\Product::find($request->input('id'));
    $product->delete();

    return back();
})->name('admin-products');

//Route::prefix('{language?}')->group(function (\Illuminate\Routing\Router $router) {
//    Route::get('welcome', function ($language) {
//        dd($language);
//
//        echo __('welcome');
//    });
//});

Route::get('/feature', function (){
    dd('some feature');
});











































//
//Route::get('/welcome', function () {
//    echo __('messages.welcome');
////    dd("The language is: " . \Illuminate\Support\Facades\App::getLocale());
//});
//
//Route::group(['middleware' => [\App\Middlewares\LanguageMiddleware::class]], function () {
//    Route::get('/{lang?}/welcome', function () {
////        dd("The language is: " . \Illuminate\Support\Facades\App::getLocale());
//        echo __('messages.welcome');
//    });
//});

