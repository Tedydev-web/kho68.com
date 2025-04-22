<?php

use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\MediaController;
use App\Livewire\Account;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Logout;
use App\Livewire\Auth\Register;
use App\Livewire\BankPaymentProcess;
use App\Livewire\Cart;
use App\Livewire\ChangePassword;
use App\Livewire\Checkout;
use App\Livewire\CheckPayment;
use App\Livewire\CourseOrderDetail;
use App\Livewire\CourseProductDetail;
use App\Livewire\DetailK;
use App\Livewire\ForgetPassword;
use App\Livewire\HistoryOrder;
use App\Livewire\Home;
use App\Livewire\OrderDetail;
use App\Livewire\OtherProductDetail;
use App\Livewire\OtherProductOrderDetail;
use App\Livewire\PaymentPolicy;
use App\Livewire\PrivacyPolicy;
use App\Livewire\ProductList;
use App\Livewire\ProductSearch;
use App\Livewire\SocialOrderDetail;
use App\Livewire\SocialProductDetail;
use App\Livewire\TransactionHistory;
use App\Livewire\Transactions;
use App\Livewire\WalletRecharge;
use App\Livewire\WarrantyPolicy;
use App\Livewire\WishList;
use App\Livewire\WordpressOrderDetail;
use App\Livewire\WordpressProductDemo;
use App\Livewire\WordpressProductDetail;
use Illuminate\Support\Facades\Route;



Route::get('/upload-file', [GoogleDriveController::class, 'showUploadForm'])->name('upload.file.view');
Route::post('/upload-file', [GoogleDriveController::class, 'uploadFile'])->name('upload.file');
Route::get(  '/download-file', [GoogleDriveController::class, 'downloadFile'])->name('download.file');
Route::get('/temporary-download/{filename}', [GoogleDriveController::class, 'temporaryDownload'])->name('temporary.download');

Route::get('/search', ProductSearch::class)->name('search');

Route::get('/forget-password', ForgetPassword::class)->name('forget-password');
Route::get('/social-order-detail/{id}', SocialOrderDetail::class)->name('social-order-detail');
Route::get('/course-order-detail/{id}', CourseOrderDetail::class)->name('course-order-detail');
Route::get('/wordpress-order-detail/{id}', WordpressOrderDetail::class)->name('wordpress-order-detail');
Route::get('/other-product-order-detail/{id}', OtherProductOrderDetail::class)->name('other-product-order-detail');

Route::get('/order-detail/{id}', OrderDetail::class)->name('order-detail');

Route::get('/wishlist', WishList::class)->name('wishlist');
Route::get('/wallet/recharge', WalletRecharge::class)->name('wallet.recharge');
Route::get('/wallet/transactions', TransactionHistory::class)->name('wallet.transactions');
Route::get('/bank/process/{orderId}', BankPaymentProcess::class)->name('bank.process');

Route::get('/chinh-sach-thanh-toan', PaymentPolicy::class)->name('payment.policy');
Route::get('/chinh-sach-bao-hanh', WarrantyPolicy::class)->name('warranty.policy');
Route::get('/chinh-sach-bao-mat', PrivacyPolicy::class)->name('privacy.policy');


Route::get('/', Home::class)->name('home');

//    Route::get('/search', function () {
//        return view('search');
//    })->name('search');

Route::get('/wordpress-product-demo/{slug}', WordpressProductDemo::class)->name('wordpress-product-demo');

Route::get('/checkout', Checkout::class)->name('checkout');
Route::get('/checkpayment', CheckPayment::class)->name('checkpayment');

Route::get('/account', Account::class)->name('account');

Route::get('/change-password', ChangePassword::class)->name('change-password');

Route::get('/detail-k', DetailK::class)->name('detail-k');
Route::get('/course-product-detail/{slug}', CourseProductDetail::class)->name('course-product-detail');
Route::get('/social-product-detail/{slug}', SocialProductDetail::class)->name('social-product-detail');
Route::get('/other-product-detail/{slug}', OtherProductDetail::class)->name('other-product-detail');

Route::get('/wordpress-product-detail/{slug}', WordpressProductDetail::class)->name('wordpress-product-detail');

Route::get('/login', Login::class)->name('login');

Route::get('/register', Register::class)->name('register');

Route::get('/history-order', HistoryOrder::class)->name('history-order')->middleware('auth');
Route::get('/transactions', Transactions::class)->name('transactions');

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

Route::get('/cart', Cart::class)->name('cart');
Route::get('/category/{slug}', action: ProductList::class)->name('category-products');

Route::get('/{slug}', ProductList::class)->name('products');



