<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Invoice_Report;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices', InvoicesController::class );

Route::resource('section', SectionsController::class);

Route::resource('product', ProductsController::class);

Route::get('/get_section/{id}', [InvoicesController::class , 'getproducts'])->name('getproducts');

Route::get('show_status/{id}' , [InvoicesController::class , 'show_status'])->name('show_status');

Route::post('update_status/{id}' , [InvoicesController::class , 'update_status'])->name('update_status');

Route::get('paid_invoice' , [InvoicesController::class , 'paid_invoice'])->name('paid_invoice');

Route::get('part_paid_invoice' , [InvoicesController::class , 'part_paid_invoice'])->name('part_paid_invoice');

Route::get('none_paid_invoice' , [InvoicesController::class , 'none_paid_invoice'])->name('none_paid_invoice');

Route::get('archive_invoice' , [InvoicesController::class , 'archive_invoice'])->name('archive_invoice');

Route::post('return_archive_invoice' , [InvoicesController::class , 'return_archive_invoice'])->name('return_archive_invoice');

Route::post('delete_archive_invoice' , [InvoicesController::class , 'delete_archive_invoice'])->name('delete_archive_invoice');

Route::get('print_invoice/{id}' , [InvoicesController::class , 'print_invoice'])->name('print_invoice');

Route::get('show_file/{file_name}', [InvoiceAttachmentsController::class , 'show_file']);

Route::get('download/{file_name}', [InvoiceAttachmentsController::class , 'download']);

Route::post('destory', [InvoiceAttachmentsController::class , 'destroy']) -> name('invoice_attachment.destroy');

Route::post('add', [InvoiceAttachmentsController::class , 'store']) -> name('invoice_attachment.store');

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);

    });

Route::get('invoices_report' , [Invoice_Report::class , 'index'])->name('invoices_report');

Route::post('Search_invoices' , [Invoice_Report::class , 'Search_invoices'])->name('search_invoices');

Route::get('custmer_report', [Invoice_Report::class , 'show_custmer_report'])->name('custmer_report');

Route::post('search_custmer', [Invoice_Report::class , 'search_custmer'])->name('search_custmer');

Route::get('markread' , [InvoicesController::class , 'markread'])->name('markread');

Route::get('markThisRead/{id}' , [InvoicesController::class , 'markThisRead'])->name('markThisRead');

Route::get('{page}', [AdminController::class , 'index']);
