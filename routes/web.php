<?php

use App\Http\Controllers\AccountantController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BedAllotmentController;
use App\Http\Controllers\BloodDonorController;
use App\Http\Controllers\CaseHistoryController;
use App\Http\Controllers\DayoffScheduleController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LapController;
use App\Http\Controllers\LapReportController;
use App\Http\Controllers\MedicineCategoryController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientServiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentItemController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServicePackageController;
use App\Http\Controllers\TimeScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('allotments-by-date', [BedAllotmentController::class, 'getBedAllotmentByDate'])->name('bedAllotmentsByDate');

Route::resources([
  'users' => UserController::class,
  'accountants' => AccountantController::class,
  'appointments' => AppointmentController::class,
  'bed-allotments' => BedAllotmentController::class,
  'blood-donors' => BloodDonorController::class,
  'case-histories' => CaseHistoryController::class,
  'days-off-schedules' => DayoffScheduleController::class,
  'departements' => DepartementController::class,
  'documents' => DocumentController::class,
  'donors' => DonorController::class,
  'expenses' => ExpenseController::class,
  'finances' => FinanceController::class,
  'invoinces' => InvoiceController::class,
  'lap-templates' => LapController::class,
  'lap-reports' => LapReportController::class,
  'medicines' => MedicineController::class,
  'medicines-categories' => MedicineCategoryController::class,
  'patients-services' => PatientServiceController::class,
  'payments' => PaymentController::class,
  'payments-items' => PaymentItemController::class,
  'prescriptions' => PrescriptionController::class,
  'publics' => PublicController::class,
  'services' => ServiceController::class,
  'service-packages' => ServicePackageController::class,
  'time-schedules' => TimeScheduleController::class
]);
