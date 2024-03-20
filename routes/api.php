<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ItemModelController;
use App\Http\Controllers\TempPurchaseDetailsController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CustomController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class,'me']);

});


Route::get('employees', [EmployeeController::class, 'index']);
Route::post('employee/store', [EmployeeController::class, 'store']);
Route::get('employee/{id}', [EmployeeController::class, 'show']);
Route::put('employee/update/{id}', [EmployeeController::class, 'update']);
Route::delete('employee/{id}', [EmployeeController::class, 'destroy']);

//Supplier Route
Route::get('/supplier', [SupplierController::class, 'index']);
Route::post('/supplier/store', [SupplierController::class, 'store']);
Route::get('/supplier/{id}', [SupplierController::class, 'show']);
Route::put('/supplier/update/{id}', [SupplierController::class, 'update']);
Route::delete('/supplier/{id}', [SupplierController::class, 'destroy']);

//Category Route
Route::get('/category', [CategoryController::class, 'index']);
Route::post('/category/store', [CategoryController::class, 'store']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::put('/category/update/{id}', [CategoryController::class, 'update']);
Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

//Brand Route
Route::get('/brand', [BrandController::class, 'index']);
Route::post('/brand/store', [BrandController::class, 'store']);
Route::get('/brand/{id}', [BrandController::class, 'show']);
Route::put('/brand/update/{id}', [BrandController::class, 'update']);
Route::delete('/brand/{id}', [BrandController::class, 'destroy']);

//Models Route
Route::get('/models', [ItemModelController::class, 'index']);
Route::post('/models/store', [ItemModelController::class, 'store']);
Route::get('/models/{id}', [ItemModelController::class, 'show']);
Route::put('/models/update/{id}', [ItemModelController::class, 'update']);
Route::delete('/models/{id}', [ItemModelController::class, 'destroy']);

//Temporary Purchase Route
Route::get('/temp_purchase', [TempPurchaseDetailsController::class, 'index']);
Route::post('/temp_purchase/store', [TempPurchaseDetailsController::class, 'store']);
Route::delete('/temp_purchase/{id}', [TempPurchaseDetailsController::class, 'destroy']);

//Purchase Route
Route::get('/purchase', [PurchaseController::class, 'index']);
Route::post('/purchase/store', [PurchaseController::class, 'store']);
Route::get('/purchase/{id}', [PurchaseController::class, 'show']);
Route::get('/purchase/{invoice}', [PurchaseController::class, 'purchaseDetails']);
Route::put('/purchase/update/{id}', [PurchaseController::class, 'update']);
Route::delete('/purchase/{id}', [PurchaseController::class, 'destroy']);

//Stock Route
Route::get('/stocks', [StockController::class, 'index']);
Route::get('/stocks/{id}', [StockController::class, 'show']);


//Custom Route
Route::get('/getBrandByCategory/{categoryId}',[CustomController::class, 'getBrandByCategory']);
Route::get('/getModelByBrand/{brandId}',[CustomController::class, 'getModelByBrand']);
