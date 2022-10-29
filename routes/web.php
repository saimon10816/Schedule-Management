<?php

use App\Http\Controllers\CompanyA_Controller;
use App\Http\Controllers\CompanyBController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [PagesController::class, 'index'])->name('home')->middleware('auth');


Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::resource('company', CompanyA_Controller::class);


Route::get('/admin/companyA/create', [CompanyA_Controller::class, 'create'])->name('admin.companyA.create');

Route::post('/admin/companyA/create', [CompanyA_Controller::class, 'store'])->name('admin.companyA.store');

Route::get('/admin/companyA/list', [CompanyA_Controller::class, 'list'])->name('admin.companyA.list');

Route::get('/admin/companyA/edit/{id}', [CompanyA_Controller::class, 'edit'])->name('admin.companyA.edit');

Route::post('/admin/companyA/update/{id}', [CompanyA_Controller::class, 'update'])->name('admin.companyA.update');

Route::delete('/admin/companyA/delete/{id}', [CompanyA_Controller::class, 'delete'])->name('admin.companyA.delete');

Route::get('/companyA/search/list', [CompanyA_Controller::class, 'search'])->name('admin.companyA.search');



Route::get('/admin/companyB/create', [CompanyBController::class, 'create'])->name('admin.companyB.create');

Route::post('/admin/companyB/create', [CompanyBController::class, 'store'])->name('admin.companyB.store');

Route::get('/admin/companyB/list', [CompanyBController::class, 'list'])->name('admin.companyB.list');

Route::get('/admin/companyB/edit/{id}', [CompanyBController::class, 'edit'])->name('admin.companyB.edit');

Route::post('/admin/companyB/update/{id}', [CompanyBController::class, 'update'])->name('admin.companyB.update');

Route::delete('/admin/companyB/delete/{id}', [CompanyBController::class, 'delete'])->name('admin.companyB.delete');

Route::get('/companyB/search/list', [CompanyBController::class, 'search'])->name('admin.companyB.search');
