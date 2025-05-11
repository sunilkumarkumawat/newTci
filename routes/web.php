<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;
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

// sidebar
Route::match(['get', 'post'], 'sidebar', 'Auth\AuthController@sidebar');


// dashboard
Route::match(['get', 'post'], 'dashboard', 'Controller@index');

// Usercontroller
Route::match(['get', 'post'], 'login', 'Auth\AuthController@getLogin');
Route::match(['get', 'post'], '/', 'DashboardController@dashboard');
Route::match(['get', 'post'], 'userAdd', 'UserController@userAdd');
Route::match(['get', 'post'], 'userView', 'UserController@userView');
Route::match(['get', 'post'], 'userEdit', 'UserController@userEdit');

// student

Route::match(['get', 'post'], 'studentAdd', 'StudentController@studentAdd');
Route::match(['get', 'post'], 'studentView', 'StudentController@studentView');
Route::match(['get', 'post'], 'studentEdit', 'StudentController@studentEdit');


// teacher
Route::match(['get', 'post'], 'teacherView', 'TeacherController@teacherView');


// expense
Route::match(['get', 'post'], 'expense', 'ExpenseController@expense');
// Route::match(['get', 'post'], 'expenseView', 'ExpenseController@expenseView');

// library-management
Route::match(['get', 'post'], 'cabin', 'LibraryController@cabin');
Route::match(['get', 'post'], 'locker', 'LibraryController@locker');
Route::match(['get', 'post'], 'wallet', 'LibraryController@wallet');
Route::match(['get', 'post'], 'walletlist', 'LibraryController@walletlist');
Route::match(['get', 'post'], 'billing', 'LibraryController@billadd');
Route::match(['get', 'post'], 'subscription', 'LibraryController@subscription');
Route::match(['get', 'post'], 'due', 'LibraryController@duefees');


// book management
Route::match(['get', 'post'], 'bookAdd', 'BookController@bookadd');
Route::match(['get', 'post'], 'bookAssign', 'BookController@bookassign');
