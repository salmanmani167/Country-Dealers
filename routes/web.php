<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Admin\GoalsController;
use App\Http\Controllers\Admin\HouseController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\AssetsController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\LeavesController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\ShiftsController;
use App\Http\Controllers\Frontend\JobController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\OvertimesController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\TimesheetsController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\FilemanagerController;
use App\Http\Controllers\Admin\ShiftScheduleController;
use App\Http\Controllers\Admin\EmployeeProfileController;
use App\Http\Controllers\Frontend\JobApplicationController;
use App\Http\Controllers\Admin\JobController as BackendJobController;


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
Route::middleware('auth')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout',[AuthController::class,'logout'])->name('logout');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('profile', [UserController::class, 'updateProfile']);
    Route::get('update-password', [UserController::class, 'changePassword'])->name('update-password');
    Route::post('update-password/{user}', [UserController::class, 'updatePassword'])->name('update-password.post');
    Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::delete('departments', [DepartmentController::class, 'destroy'])->name('departments.destroy');
    Route::get('users', [UsersController::class, 'index'])->name('users.index');
    Route::get('settings/theme', [SettingsController::class, 'theme'])->name('settings.theme');
    Route::get('settings/company', [SettingsController::class, 'company'])->name('settings.company');
    Route::get('settings/invoice', [SettingsController::class, 'invoice'])->name('settings.invoice');
    Route::get('settings/attendance', [SettingsController::class, 'attendance'])->name('settings.attendance');
    Route::get('settings/features', [SettingsController::class, 'features'])->name('settings.features');
    Route::post('settings/update-feature', [SettingsController::class, 'updateFeatureStatus'])->name('settings.features-update');
    Route::get('houses', [HouseController::class, 'index'])->name('houses.index');
    Route::get('agencies', [AgencyController::class, 'index'])->name('agencies.index');
    Route::get('policies', [PolicyController::class, 'index'])->name('policies.index');
    Route::get('holidays', [HolidayController::class, 'index'])->name('holidays.index');
    Route::get('vacation-type', [LeaveTypeController::class, 'index'])->name('leave-types.index');
    Route::get('vacations', [LeavesController::class, 'index'])->name('leaves.index');
    Route::get('designations', [DesignationController::class, 'index'])->name('designations.index');
    Route::get('backups',[BackupController::class,'index'])->name('backups');
    Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('employee-list', [EmployeeController::class, 'list'])->name('employees.list');
    Route::get('employee-profile/{user}', [EmployeeController::class, 'profile'])->name('employees.profile');
    Route::get('clients', [ClientsController::class, 'index'])->name('clients.index');
    Route::get('client-list', [ClientsController::class, 'list'])->name('clients.list');
    Route::get('client-profile/{user}', [ClientsController::class, 'profile'])->name('clients.profile');
    Route::post('family-info/{employee}', [EmployeeProfileController::class, 'familyInfo'])->name('update.familyinfo');
    Route::post('bank-info/{employee}', [EmployeeProfileController::class, 'bankInfo'])->name('update.bankinfo');
    Route::post('education-info/{employee}', [EmployeeProfileController::class, 'educationInfo'])->name('update.educationinfo');
    Route::post('experience-info/{employee}', [EmployeeProfileController::class, 'experienceInfo'])->name('update.experience');
    Route::get('filemanager', [FilemanagerController::class, 'index'])->name('apps.filemanager');
    Route::get('overtime', [OvertimesController::class, 'index'])->name('overtime');
    Route::get('shifts', [ShiftsController::class, 'index'])->name('shifts.index');
    Route::post('shifts', [ShiftsController::class, 'store']);
    Route::put('shifts', [ShiftsController::class, 'update']);
    Route::delete('shifts', [ShiftsController::class, 'destroy']);
    Route::get('timesheets', [TimesheetsController::class,'index'])->name('timesheet');
    Route::post('timesheets', [TimesheetsController::class,'store']);
    Route::put('timesheets', [TimesheetsController::class,'update']);
    Route::delete('timesheets', [TimesheetsController::class,'destroy']);
    Route::apiResource('schedules', ShiftScheduleController::class)->except(['show','update']);
    Route::put('schedules', [ShiftScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('schedules', [ShiftScheduleController::class, 'destroy'])->name('schedules.destroy');

    Route::get('tickets', [TicketsController::class, 'index'])->name('tickets');
    Route::post('tickets', [TicketsController::class, 'store']);
    Route::put('tickets', [TicketsController::class, 'update']);
    Route::delete('tickets', [TicketsController::class, 'destroy']);

    Route::get('goal-types', [GoalsController::class, 'goalTypes'])->name('goal-types');
    Route::get('goals', [GoalsController::class, 'index'])->name('goals');
    Route::get('asset', [AssetsController::class, 'index'])->name('assets');

    Route::get('jobs',[BackendJobController::class,'index'])->name('jobs');
    Route::post('jobs',[BackendJobController::class,'store']);
    Route::put('jobs', [BackendJobController::class, 'update']);
    Route::delete('jobs', [BackendJobController::class, 'destroy'])->name('jobs.destroy');
    Route::get('job-applicants',[BackendJobController::class,'applicants'])->name('job-applicants');
    Route::post('download-cv',[BackendJobController::class,'downloadCv'])->name('download-cv');

    Route::get('notification', [UserNotificationController::class, 'index'])->name('notifications.index');
    Route::get('user-notifications', [UserNotificationController::class, 'user'])->name('user.notifications');
    Route::get('mark-notifications', [UserNotificationController::class, 'clearAll'])->name('notifications.markAllAsRead');

    Route::impersonate();
});

Route::middleware('is_employee')->prefix('employee')->group(function(){
    Route::get('', function(){
        return 'Welcome';
    });
});

Route::get('job-list',[JobController::class,'index'])->name('job-list');
Route::get('job-view/{job}',[JobController::class,'show'])->name('job-view');
Route::post('apply',[JobApplicationController::class,'store'])->name('apply-job');

Route::middleware('guest')->group(function(){
    Route::get('', function(){
        return redirect()->route('login');
    });
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'postLogin']);
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'store']);
    Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('forgot-password', [AuthController::class, 'reset']);
});
