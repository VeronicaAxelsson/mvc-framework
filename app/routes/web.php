<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\YatzyController;
use App\Http\Controllers\Game21Controller;
use App\Http\Controllers\DiceController;


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

Route::get('/index', [IndexController::class, 'index']);

Route::prefix('dice')->group(function () {
    Route::get('/', [DiceController::class, 'index'])->name('dice');
    Route::post('/roll', [DiceController::class, 'roll']);
});

Route::prefix('yatzy')->group(function () {
    Route::get('/', [YatzyController::class, 'index'])->name('yatzy');
    Route::post('/throw', [YatzyController::class, 'throw']);
    Route::post('/newgame', [YatzyController::class, 'newGame']);
    Route::post('/newround', [YatzyController::class, 'newRound']);
});

Route::prefix('game21')-> group(function () {
    Route::get('/', [Game21Controller::class, 'index'])->name('game21');
    Route::post('/roll', [Game21Controller::class, 'roll']);
    Route::post('/end', [Game21Controller::class, 'end']);
    Route::post('/reset', [Game21Controller::class, 'reset']);
    Route::post('/newround', [Game21Controller::class, 'newRound']);
});
