<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// 🔓 Public Routes
Route::match(['get', 'post'], 'login', 'Auth\AuthController@getLogin')->name('login');
Route::get('/', function () {
    return redirect('/dashboard');
});
Route::get('logout', function () {

    DB::table('login_logs')->insert([
        'user_id' => Auth::id(),
        'category' => 2,
        'type' => 'users', // or 'student' / 'teacher' accordingly
        'time_at' => now(),
    ]);

    Auth::logout();
    return redirect('/login');
});



Route::post('/loginAuth', function (Request $request) {
    $user = User::where('username', $request->user_name)->first();


    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }


    $currentSession = DB::table('settings')
        ->where('id', 1)
        ->value('current_active_session_id');


    Auth::login($user); // ✅ session-based login

    session(['current_session' => $currentSession]);

    DB::table('login_logs')->insert([
        'user_id' => $user->id,
        'category' => 1,
        'type' => 'users', // or 'student' / 'teacher' accordingly
        'time_at' => now(),
    ]);

    return response()->json(['user' => $user], 200);
});

// 🔐 Protected Routes (Only accessible if logged in)
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::match(['get', 'post'], 'dashboard', 'Controller@index');

    // Sidebar
    Route::match(['get', 'post'], 'sidebar', 'Auth\AuthController@sidebar');

    Route::post('/set-session', function (\Illuminate\Http\Request $request) {
        $sessionId = $request->input('sessionSelect');
        session(['current_session' => $sessionId]);
        return redirect()->back();
    })->name('set.session');

    // branch
    Route::match(['get', 'post'], 'commonEdit/{modal}/{id}', 'SharesController@commonEdit');
    Route::match(['get', 'post'], 'createCommon', 'SharesController@createCommon');
    Route::match(['get', 'post'], 'branch', 'SharesController@branch');
    Route::match(['get', 'post'], 'role', 'SharesController@role');
    Route::match(['get', 'post'], 'expense', 'SharesController@expense');
    Route::match(['get', 'post'], 'setting', 'SharesController@setting');
    Route::match(['get', 'post'], 'commonView/{modal_type}', 'SharesController@commonView');
    Route::match(['get', 'post'], 'common-status-change/{model}/{id}', 'SharesController@changeStatusCommon');
    Route::match(['delete'], 'common-delete/{model}/{id}', 'SharesController@deleteCommon');
    Route::match(['delete'], 'common-force-delete/{model}/{id}', 'SharesController@deleteForceCommon');
    Route::match(['delete'], 'common-restore/{model}/{id}', 'SharesController@restoreCommon');
    Route::match(['get', 'post'], '/get-dependent-options', 'SharesController@getDependentOptions');
    Route::match(['get', 'post'], '/set-current-branch', 'SharesController@setCurrentBranch');
    Route::match(['get', 'post'], '/set-permission-view/{roleId}/{userId}', 'SharesController@setPermissionView');
    Route::match(['get', 'post'], '/batches', 'SharesController@batches');
    Route::match(['get', 'post'], '/generatePassword', 'SharesController@generatePassword');
    Route::match(['get', 'post'], '/excelUpload/{modal}', 'SharesController@saveExcelData');






    Route::match(['get', 'post'], '/chapters/data', 'SharesController@chaptersData');



















    // User Controller
    Route::match(['get', 'post'], 'userAdd', 'UserController@userAdd');
    Route::match(['get', 'post'], 'userView', 'UserController@userView');
    Route::match(['get', 'post'], 'userEdit/{id}', 'UserController@userEdit');


    // Student
    Route::match(['get', 'post'], 'studentAdd', 'StudentController@studentAdd');
    Route::match(['get', 'post'], 'studentView', 'StudentController@studentView');
    Route::match(['get', 'post'], 'studentEdit/{id}', 'StudentController@studentEdit');
    Route::match(['get', 'post'], 'studentIdPassword', 'SharesController@studentIdPassword');
    Route::match(['get', 'post'], 'userPassword', 'SharesController@userPassword');
    Route::match(['get', 'post'], 'allTypeUsersData', 'SharesController@allTypeUsersData');

    // Teacher
    Route::match(['get', 'post'], 'teacherView', 'TeacherController@teacherView');

    // Expense
    Route::match(['get', 'post'], 'expenseEdit/{id}', 'ExpenseController@expenseedit');

    // Library Management
    Route::match(['get', 'post'], 'cabin', 'LibraryController@cabin');
    Route::match(['get', 'post'], 'locker', 'LibraryController@locker');
    Route::match(['get', 'post'], 'wallet', 'LibraryController@wallet');
    Route::match(['get', 'post'], 'walletlist', 'LibraryController@walletlist');
    Route::match(['get', 'post'], 'billing', 'LibraryController@billadd');
    Route::match(['get', 'post'], 'subscription', 'LibraryController@subscription');
    Route::match(['get', 'post'], 'due', 'LibraryController@duefees');
    // printfiles
    Route::match(['get', 'post'], 'printbill', 'LibraryController@print');

    // Book Management
    Route::match(['get', 'post'], 'bookAdd', 'BookController@bookadd');
    Route::match(['get', 'post'], 'bookAssign', 'BookController@bookassign');



    //Message Type
    Route::match(['get', 'post'], 'messageTypeAdd', 'MessageController@messageTypeAdd');
    Route::match(['get', 'post'], 'messageTemplate', 'MessageController@messageTemplate');



    // Route::match(['get', 'post'], 'commonView/{modal_type}', 'CommonController@commonView');

    Route::match(['get', 'post'], 'role/permission/{roleId}', 'SharesController@savePermission');

    Route::match(['get', 'post'], 'subject', 'SharesController@subject');
    Route::match(['get', 'post'], 'tags', 'SharesController@tags');
    Route::match(['get', 'post'], 'chapter', 'SharesController@chapter');
    Route::match(['get', 'post'], 'topics', 'SharesController@topics');
    Route::match(['get', 'post'], 'topicData', 'SharesController@topicData');
    Route::match(['get', 'post'], 'questionDashboard', 'SharesController@questionDashboard');
    Route::match(['get', 'post'], 'questions', 'SharesController@questions');
    Route::match(['get', 'post'], 'questionView', 'SharesController@questionView');
    Route::match(['get', 'post'], 'questionData', 'SharesController@questionData');



    Route::match(['get', 'post'], 'resultAnalysis/dashboard', 'ResultAnalysisController@dashboard');
    Route::match(['get', 'post'], 'test-wise-report', 'ResultAnalysisController@testWiseReport');
    Route::match(['get', 'post'], 'student-wise-report', 'ResultAnalysisController@studentWiseReport');

    Route::match(['get', 'post'], 'exam/dashboard', 'ExamController@dashboard');
    Route::match(['get', 'post'], 'exam/list', 'ExamController@examList');
    Route::match(['get', 'post'], 'exam/create', 'ExamController@examCreate');
    Route::match(['get', 'post'], 'examData', 'ExamController@examData');
    Route::match(['get', 'post'], 'createExam', 'ExamController@createExam');
});
