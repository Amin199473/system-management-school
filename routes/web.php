<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\Reports\ResultReportController;
use App\Http\Controllers\Backend\accountsManagement\AccountsEmployeeSalaryController;
use App\Http\Controllers\Backend\accountsManagement\OtherCostController;
use App\Http\Controllers\Backend\accountsManagement\StudentFeeController;
use App\Http\Controllers\Backend\employee\EmployeeAttendanceController;
use App\Http\Controllers\Backend\employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\Backend\setup\ExamTypeController;
use App\Http\Controllers\Backend\setup\FeeAmountController;
use App\Http\Controllers\Backend\student\ExamFeeController;
use App\Http\Controllers\Backend\setup\DesignationController;
use App\Http\Controllers\Backend\setup\FeeCategoryController;
use App\Http\Controllers\Backend\setup\StudentYearController;
use App\Http\Controllers\Backend\setup\StudentClassController;
use App\Http\Controllers\Backend\setup\StudentGroupController;
use App\Http\Controllers\Backend\setup\StudentShiftController;
use App\Http\Controllers\Backend\student\MonthlyFeeController;
use App\Http\Controllers\Backend\student\StudentRegController;
use App\Http\Controllers\Backend\setup\AssignSubjectController;
use App\Http\Controllers\Backend\setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Student\StudentRollController;
use App\Http\Controllers\Backend\employee\EmployeeRegController;
use App\Http\Controllers\Backend\employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\employee\MonthlySalaryController;
use App\Http\Controllers\Backend\marks\GradeController;
use App\Http\Controllers\Backend\marks\MarksController;
use App\Http\Controllers\Backend\Reports\AttendanceReportController;
use App\Http\Controllers\Backend\Reports\MarkSheetController;
use App\Http\Controllers\Backend\Reports\ProfitController;
use App\Http\Controllers\Backend\Reports\ResultReportController as ReportsResultReportController;
use App\Http\Controllers\Backend\student\RegistraionFeeController;

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

//middleware Prevent Browser Back Button After Logout
Route::group(['middleware' => 'prevent-back-history'], function () {

    Route::get('/', function () {
        return view('auth.login');
    })->middleware('guest');

    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');


    //Logout Route
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth'])->group(function () {
        //System Managment School Routes
        Route::prefix('dashboard/')->group(function () {
            Route::resource('/users', UserController::class);
            Route::resource('/profile', ProfileController::class);
            Route::get('/changePassword', [ProfileController::class, 'ChangePassword'])->name('ChangePassword');
            Route::post('/UpdatePassword', [ProfileController::class, 'UpdatePassword'])->name('UpdatePassword');

            //setup management routes
            Route::prefix('/setup')->group(function () {
                Route::resource('/studentClass', StudentClassController::class);
                Route::resource('/studentYear', StudentYearController::class);
                Route::resource('/studentGroup', StudentGroupController::class);
                Route::resource('/studentShift', StudentShiftController::class);
                Route::resource('/feeCategory', FeeCategoryController::class);
                Route::resource('/feeAmount', FeeAmountController::class)->except('destroy');
                Route::get('/feeAmount/details/{id}', [FeeAmountController::class, 'details'])->name('feeAmount.details');
                Route::resource('/examType', ExamTypeController::class);
                Route::resource('/schoolSubject', SchoolSubjectController::class);
                Route::resource('/assignSubject', AssignSubjectController::class)->except('destroy');
                Route::get('/assignSubject/details/{id}', [AssignSubjectController::class, 'details'])->name('assignSubject.details');
                Route::resource('/designation', DesignationController::class);
            });

            //student Routes
            Route::prefix('/students')->group(function () {
                Route::resource('/registration', StudentRegController::class)->except('destroy');

                //search Route
                Route::get('/studentSearch', [StudentRegController::class, 'studentSearch'])->name('studentSearch');
                Route::get('/promotion/{promotion}', [StudentRegController::class, 'Promotion'])->name('promotion');
                Route::post('/updatePromotion/{promotion}', [StudentRegController::class, 'updatePromotion'])->name('promotion.update');
                Route::get('/generatePdf/{id}', [StudentRegController::class, 'generatePdf'])->name('generatePdf');
                Route::resource('/rollGenerate', StudentRollController::class);

                //the Route is for Ajax Request
                Route::get('/getStudents', [StudentRollController::class, 'getStudents'])->name('getStudents');

                //route for registration Fee
                Route::resource('/registrationFee', RegistraionFeeController::class)->except(['show', 'edit', 'update', 'destroy']);
                Route::get('/registrationFee/paySlip', [RegistraionFeeController::class, 'RegistrationFeePaySlip'])->name('paySlip');

                //route for registration monthly Fee
                Route::resource('/monthlyFee', MonthlyFeeController::class)->except(['show', 'edit', 'update', 'destroy']);
                Route::get('/monthlyFee/paySlip', [MonthlyFeeController::class, 'MonthlyFeePaySlip'])->name('monthlyFee.paySlip');


                //route for registration monthly Fee
                Route::resource('/examFee', ExamFeeController::class)->except(['show', 'edit', 'update', 'destroy']);
                Route::get('/examFee/paySlip', [ExamFeeController::class, 'ExamFeePaySlip'])->name('examFee.paySlip');
            });


            // Employee Routes
            Route::prefix('/employees')->group(function () {
                Route::resource('/employeeRegistration', EmployeeRegController::class)->except('destroy');
                Route::get('/employeeRegistration/details/{id}', [EmployeeRegController::class, 'details'])->name('employeeRegistration.details');

                Route::get('/employeeSalary', [EmployeeSalaryController::class, 'index'])->name('employeeSalary.index');
                Route::get('/incrementSalary/{id}', [EmployeeSalaryController::class, 'IncrementSalary'])->name('employee.Increment.salary');
                Route::post('/incrementSalaryUpdate/{id}', [EmployeeSalaryController::class, 'UpdateIncrementSalary'])->name('employee.Increment.salary.update');
                Route::get('/employeeSalary/details/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryDetails'])->name('employee.salary.details');


                Route::resource('/employeeLeave', EmployeeLeaveController::class);

                Route::resource('/employeeAttendance', EmployeeAttendanceController::class)->except('destroy');
                Route::get('/employeeAttendance/details/{date}', [EmployeeAttendanceController::class, 'details'])->name('employeeAttendance.details');

                Route::resource('/monthlySalary', MonthlySalaryController::class);
            });


            // Marks Routes
            Route::prefix('/marks')->group(function () {
                Route::resource('/marksManagement', MarksController::class)->except(['store', 'show', 'edit', 'update', 'destroy']);
                Route::get('/marksGetStudents', [MarksController::class, 'GetStudents'])->name('marksGetStudents');
                Route::post('/marksEntryStore', [MarksController::class, 'marksEntryStore'])->name('marksEntryStore');

                Route::get('/marksEdit', [MarksController::class, 'marksEdit'])->name('marksEdit');
                Route::get('/marksGetStudentsEdit', [MarksController::class, 'marksGetStudentsEdit'])->name('marksGetStudents.edit');
                Route::post('/marksGetStudentsUpdate', [MarksController::class, 'marksGetStudentsUpdate'])->name('marksGetStudents.update');


                Route::resource('/marksGrade', GradeController::class);
            });




            // Accounts Management Routes
            Route::prefix('/accountsManagement')->group(function () {
                Route::resource('/studentFee', StudentFeeController::class)->except(['show', 'edit', 'update', 'destory']);
                //Ajax Route
                Route::get('/studentFeeGet', [StudentFeeController::class, 'StudentFeeGet'])->name('studentFeeGet');

                Route::resource('/accountEmployeeSalary', AccountsEmployeeSalaryController::class);
                //Ajax Route
                Route::get('/accountSalaryGetEmployee', [AccountsEmployeeSalaryController::class, 'accountSalaryGetEmployee'])->name('accountSalaryGetEmployee');

                Route::resource('/otherCost', OtherCostController::class);
            });



            // Reports Management Routes
            Route::prefix('/reports')->group(function () {
                Route::get('/monthlyProfit', [ProfitController::class, 'MonthlyProfit'])->name('monthlyProfit');
                Route::get('/getMonthlyProfit', [ProfitController::class, 'GetMonthlyProfit'])->name('getMonthlyProfit');
                Route::get('/reportProfitPDF', [ProfitController::class, 'ReportProfitPDF'])->name('reportProfitPDF');

                Route::get('/markSheet', [MarkSheetController::class, 'MarkSheet'])->name('markSheet');
                Route::get('/getReportMarkSheet', [MarkSheetController::class, 'GetReportMarkSheet'])->name('getReportMarkSheet');

                Route::get('/attendanceReport', [AttendanceReportController::class, 'AttendanceReport'])->name('attendanceReport');
                Route::get('/getReportAttendance', [AttendanceReportController::class, 'GetReportAttendance'])->name('getReportAttendance');

                Route::get('/resultReport', [ResultReportController::class, 'ResultReport'])->name('resultReport');
                Route::get('/getResultReportStudent', [ResultReportController::class, 'GetResultReportStudent'])->name('getResultReportStudent');
                Route::get('/studentIdCard', [ResultReportController::class, 'StudentIdCard'])->name('studentIdCard');
                Route::get('/getStudentIDCard', [ResultReportController::class, 'GetStudentIDCard'])->name('getStudentIDCard');
            });
        });
    });
});
