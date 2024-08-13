<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/products/paginate', [ProductsController::class, 'paginate'])->name('products.paginate');
Route::post('/ofertas/paginate', [ProductsController::class, 'paginateOffers'])->name('ofertas.paginate');

Route::post('/payment/culqi', [PaymentController::class, 'culqi'])->name('payment.culqi');

Route::get('/offers/{id}', [OfferController::class, 'get'])->name('offers.get');

Route::post('login-rev-api', [AuthController::class, 'login']);
Route::post('signup', [AuthController::class, 'signup']);

Route::middleware(['web', 'auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard/top-products/{orderBy}', [DashboardController::class, 'topProducts'])->name('dashboard.top-products');

    Route::post('/address', [AddressController::class, 'save'])->name('address.save');
    Route::delete('/address/{id}', [AddressController::class, 'delete'])->name('address.delete');
    Route::patch('/address/markasfavorite', [AddressController::class, 'markasfavorite'])->name('address.markasfavorite');

    Route::post('/sales/paginate', [SaleController::class, 'paginate'])->name('sales.paginate');
    Route::post('/sales/confirmation', [SaleController::class, 'confirmation'])->name('sales.confirmation');
    Route::patch('/sales/status', [SaleController::class, 'status'])->name('sales.status');
    Route::get('/saledetails/{sale}', [SaleDetailController::class, 'bySale'])->name('sale.bySale');

    Route::get('/offers', [OfferController::class, 'all'])->name('offers.all');
    Route::patch('/offers', [OfferController::class, 'save'])->name('offers.save');
    Route::delete('/offers/{offer_id}', [OfferController::class, 'delete'])->name('offers.delete');
});