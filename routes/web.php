<?php

use App\Http\Controllers\PdfController;
use App\Livewire\Home\Initial;
use App\Livewire\Sale\SaleEdit;
use App\Livewire\Sale\SaleList;
use App\Livewire\Sale\SaleShow;
use App\Livewire\Sale\SaleCreate;
use App\Livewire\Cashier\CashierShow;
use App\Livewire\Product\ProductShow;
use Illuminate\Support\Facades\Route;
use App\Livewire\Client\ClientComponent;
use App\Livewire\Cashier\CashierComponent;
use App\Livewire\Product\ProductComponent;
use App\Livewire\Category\CategoryComponent;
use App\Livewire\Shop\ShopComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', Initial::class)->name('home');

Route::get('/categories', CategoryComponent::class)->name('categories');

Route::get('/cashiers', CashierComponent::class)->name('cashiers');
Route::get('/cashiers/{cashier}/statuses', CashierShow::class)->name('cashiers.statuses');

Route::get('/clients', ClientComponent::class)->name('clients')->middleware(['auth']);

Route::get('/products', ProductComponent::class)->name('products')->middleware(['auth']);
Route::get('/products/{product}', ProductShow::class)->name('products.show')->middleware(['auth']);

Route::get('/sale/create', SaleCreate::class)->name('sales.create')->middleware(['auth']);
Route::get('/sales',SaleList::class)->name('sales.list')->middleware(['auth']);
Route::get('/sales/{sale}',SaleShow::class)->name('sales.show')->middleware(['auth']);
Route::get('/sales/{sale}/edit',SaleEdit::class)->name('sales.edit')->middleware(['auth']);

Route::get('/tienda', ShopComponent::class)->name('tienda')->middleware(['auth']);

// Entre [] cuando queremos ejecutar un metodo del controlador
Route::get('/sales/invoice/{sale}', [PdfController::class, 'invoice'])->name('sales.invoice')->middleware(['auth']);