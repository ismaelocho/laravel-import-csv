<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenditureController;

use App\Http\Livewire\Expenditures;


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
    return view('welcome');
});

Route::get('/expense', function () {
    return view('viewExpenditureTable');
})->middleware('auth')->name('expense');

Route::get('/expense-import',[ExpenditureController::class,'index'])->middleware('auth')->name('expenditure.index');
Route::post('/import',[ExpenditureController::class,'import'])->middleware('auth')->name('expenditure.import');
Route::post('/expenditure',[ExpenditureController::class,'edit'])->middleware('auth')->name('expenditure.edit');
Route::get('expenses', Expenditures::class)->middleware('auth')->name('expenses.list');;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
