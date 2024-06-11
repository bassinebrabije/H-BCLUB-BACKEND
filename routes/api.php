<?php

use App\Http\Controllers\CoachingController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TrainerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('inscriptions', InscriptionController::class);
Route::resource('trainers', TrainerController::class);
Route::resource('members', MemberController::class);
Route::resource('coaching', CoachingController::class);

Route::post('send-email', [EmailController::class, 'sendEmail']);

Route::get('download-coaching-pdf', [CoachingController::class, 'downloadPDF']);

Route::get('download-members-pdf', [MemberController::class, 'downloadPDF']);

Route::get('download-trainers-pdf', [TrainerController::class, 'downloadPDF']);

Route::get('download-pdf', [InscriptionController::class, 'downloadPDF']);
