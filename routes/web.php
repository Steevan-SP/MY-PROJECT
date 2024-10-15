<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\Admin\CashflowController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StaffallocationController;
use App\Http\Controllers\Admin\PdfController;
use App\Http\Controllers\Admin\ReportController;
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
    return view('welcome');
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
});

Route::group(['prefix' => 'guests','middleware' => 'auth'], function () {
    Route::get('/', [GuestController::class, 'index'])->name('guest.index');
    Route::get('/register',[GuestController::class, 'register'])->name('guest.register');
    Route::post('/store',[GuestController::class, 'store'])->name('guest.store');
    Route::get('/print_ticket',[GuestController::class, 'print_ticket'])->name('guest.print_ticket');
    Route::get('/search-guest', [GuestController::class, 'search'])->name('search.guest');


});

Route::group(['prefix' => '{guest}'], function () {
    Route::get('/invoice',[GuestController::class, 'invoice'])->name('guest.invoice');
    Route::get('/payment',[GuestController::class, 'paymentindex'])->name('guest.paymentindex');
    Route::post('/payment',[GuestController::class,'paymentstore'])->name('guest.paymentstore');
    Route::get('/ticket',[GuestController::class, 'ticket'])->name('guest.ticket');
    Route::get('ticket-pdf', [GuestController::class, 'ticketPdf'])->name('ticket.pdf');

});

Route::group(['prefix' => 'cashflow','middleware' => 'auth'], function () {
    Route::get('/', [CashflowController::class, 'index'])->name('cashflow.index');
    Route::get('/search/payments', [CashflowController::class,'search'])->name('search.payments');

});

Route::group(['prefix' => 'inventory', 'middleware' => 'auth'], function () {
    Route::get('/', [InventoryController::class, 'index'])->name('inventory.index');
    Route::get('/create', [InventoryController::class, 'create'])->name('inventory.create');
    Route::post('/', [InventoryController::class, 'store'])->name('inventory.store');
    Route::get('/{id}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
    Route::put('/{id}', [InventoryController::class, 'update'])->name('inventory.update');
    Route::delete('/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
});

Route::group(['prefix' => 'stock','middleware' => 'auth'], function () {
    Route::get('/',     [StockController::class, 'index'])->name('stock.index');
    Route::get('/create',[StockController::class, 'create'])->name('stock.create');
    Route::post('/store',[StockController::class, 'store'])->name('stock.store');
    Route::get('/view',[StockController::class, 'view'])->name('stock.view');
});

Route::group(['prefix' => '{stock}'], function () {
    Route::get('/edit',[StockController::class, 'edit'])->name('stock.edit');
    Route::patch('/',[StockController::class, 'update'])->name('stock.update');
});

Route::group(['prefix' => 'tickets','middleware' => 'auth'], function () {
    Route::get('/', [TicketController::class, 'index'])->name('ticket.index');
});

Route::group(['prefix' => '{ticket}'], function () {
    Route::get('/edit',[TicketController::class, 'edit'])->name('ticket.edit');
    Route::patch('/',[TicketController::class, 'update'])->name('ticket.update');
});
    
Route::group(['prefix' => 'staff', 'middleware' => 'auth'], function () {
    Route::get('/', [StaffallocationController::class, 'index'])->name('staff.index');
    Route::get('/create_staff', [StaffallocationController::class, 'create'])->name('staff.create');
    Route::post('/store', [StaffallocationController::class, 'store'])->name('staff.store');
    Route::delete('/{id}', [StaffallocationController::class, 'destroy'])->name('staff.destroy'); 
});
Route::group(['prefix' => 'users','middleware' => 'auth'], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/create',[UserController::class, 'create'])->name('user.create');
    Route::post('/store',[UserController::class, 'store'])->name('user.store');

    Route::group(['prefix' => '{user}'], function () {
        Route::get('/show',[UserController::class, 'show'])->name('user.show');
        Route::get('/edit',[UserController::class, 'edit'])->name('user.edit');
        Route::patch('/',[UserController::class, 'update'])->name('user.update');
        Route::get('/delete',[UserController::class,'delete'])->name('user.delete');
        Route::delete('/',[UserController::class,'destroy'])->name('user.destroy');
    });
});

Route::group(['prefix' => 'billing', 'middleware' => 'auth'], function () {
    Route::get('/', [BillingController::class, 'index'])->name('billing.index');
    Route::post('/store', [BillingController::class, 'store'])->name('billing.store');
    Route::get('/printbill', [BillingController::class, 'printbill'])->name('billing.printbill');
    
    Route::group(['prefix' => '{billing}'], function () {
        Route::get('/payment', [BillingController::class, 'paymentIndex'])->name('billing.paymentindex');
        Route::post('/payment', [BillingController::class, 'paymentstore'])->name('billing.paymentstore');
        Route::get('/bill',[BillingController::class, 'bill'])->name('billing.bill');
        Route::get('generate-pdf', [BillingController::class, 'generatePdf'])->name('generate.pdf');
    });
});
Route::group(['prefix' => 'reports'], function() {
    Route::get('/daily_transaction', [ReportController::class, 'dailyTransaction'])->name('reportDT.index');
    Route::get('/daily_transaction/pdf', [ReportController::class, 'generatePDF'])->name('dailyTransaction.pdf');
    Route::middleware('auth')->post('/dailyTransaction/filter', [ReportController::class, 'filterTransactions'])->name('dailyTransaction.filter');
    Route::get('/guest_details', [ReportController::class, 'guestDetails'])->name('reportGD.index');
    Route::get('/guest_details/pdf', [ReportController::class, 'guest_detailsPDF'])->name('guestDetails.pdf');
    Route::get('/Total_guest', [ReportController::class, 'Total_guest'])->name('TotalGuest.index');
    Route::get('/Total_guest/pdf', [ReportController::class, 'total_guest_PDF'])->name('GD_generatePDF.pdf');
    Route::get('/Total_Stock', [ReportController::class, 'Total_Stock'])->name('TotalStockSummary.index');
    Route::get('/stock-report/pdf', [ReportController::class, 'Total_Stock_PDF'])->name('stock.report.pdf');
    Route::get('/Local_Guest', [ReportController::class, 'Local_Guest'])->name('LocalGuestReport.index');
  
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
