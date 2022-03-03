<?php

use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use \App\Http\Resources\UserResource;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentResource;
use App\User;
use App\Student;
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

Route::prefix('users')->group(function () {
    Route::get('{user}/student', 'UserController@student');
    Route::get('notification', 'Notification@index');
    Route::get('notification/unread', 'Notification@UnreadNotifications');
    Route::get('notification/read', 'Notification@ReadNotifications');
    Route::get('notification/markasread', 'Notification@update');
    Route::get('current', 'UserController@current');
});

Route::resource('users', 'UserController')->only(['index', 'show']);
Route::prefix('students')->group(function () {
    Route::get('{student}/user', 'StudentController@user');
    Route::get('{student}/picture', 'StudentController@picture');
    Route::get('{student}/students_programmes', 'StudentProgrammeController@students_programmes');
    Route::get('{student}/students_check_lists', 'StudentCheckListController@students_check_lists');
    Route::get('{student}/students_units', 'StudentUnitController@students_units');
    Route::get('{student}/programmes', 'ProgrammeController@students_programmes');
    Route::get('{student}/check_lists', 'CheckListController@students_check_lists');
    Route::get('/timetable', 'StudentController@timetable');
    Route::get('/exam_results', 'StudentController@examResults');
    
});

Route::resource('charges', 'ChargeController')->only(['index', 'show']);
Route::resource('check_lists', 'CheckListController')->only(['index', 'show']);
Route::resource('students', 'StudentController')->only(['index', 'show']);
Route::resource('exam_centers', 'ExamCenterController')->only(['index', 'show']);
Route::resource('programme', 'ProgrammeController')->only(['index', 'show']);
Route::resource('programme_units', 'ProgrammeUnitController')->only(['index', 'show']);
Route::resource('semester', 'SemesterController')->only(['index', 'show']);
Route::resource('student_types', 'StudentTypeController')->only(['index', 'show']);
Route::resource('students_programmes', 'StudentProgrammeController')->only(['index', 'show']);
Route::resource('students_check_lists', 'StudentCheckListController')->only(['index', 'show']);
Route::resource('students_units', 'StudentUnitController')->only(['index', 'show']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
