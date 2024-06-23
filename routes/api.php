<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoachingController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TrainerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('admins', [AuthController::class, 'index']);
Route::delete('admins/{id}', [AuthController::class, 'destroy']);

/*API for put get post  */

Route::resource('inscriptions', InscriptionController::class);
Route::resource('trainers', TrainerController::class);
Route::resource('members', MemberController::class);
Route::resource('coaching', CoachingController::class);

/*-------------------------------------------*/
/*API for  send-email from  inscriptions*/

Route::post('send-email', [EmailController::class, 'sendEmail']);

/*-------------------------------------------*/

/*API for  get Pdf  all tables*/

Route::get('download-coaching-pdf', [CoachingController::class, 'downloadPDF']);

Route::get('download-members-pdf', [MemberController::class, 'downloadPDF']);

Route::get('download-trainers-pdf', [TrainerController::class, 'downloadPDF']);

Route::get('download-admins-pdf', [AuthController::class, 'downloadPDF']);

Route::get('download-inscription-pdf', [InscriptionController::class, 'downloadPDF']);
