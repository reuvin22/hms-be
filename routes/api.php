<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Headers: Authorization');

use App\Models\Pathology;
use Illuminate\Http\Request;

use App\Services\SettingService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DOHController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ICDAPIController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\EyeCenterController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\Auth\GrantController;
use App\Http\Controllers\Auth\ModuleController;
use App\Http\Controllers\Setting\BedController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HealthMonitorController;
use App\Http\Controllers\Auth\PermissionController;
use App\Http\Controllers\PatientApprovalController;
use App\Http\Controllers\Setting\AboutUsController;
use App\Http\Controllers\Auth\GrantModuleController;
use App\Http\Controllers\Setting\PathologyController;
use App\Http\Controllers\Setting\RadiologyController;
use App\Http\Controllers\Setting\HospitalChargeController;

// for exam only=

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login'])->middleware('db.connection');
Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'user']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
Route::group(['middleware' => ['auth:sanctum', 'db.connection']], function () {
    Route::apiResource('search', SearchController::class);

    Route::apiResource('permission', PermissionController::class);
    Route::apiResource('module', ModuleController::class);
    Route::apiResource('grants', GrantController::class);
    Route::apiResource('grant-module', GrantModuleController::class);
    Route::apiResource('grant-user-modules', AuthController::class);
    Route::apiResource('user-list', UserController::class);
    Route::get('user-by-id', [UserController::class, 'getById']);
    Route::apiResource('user-bulk-registration', UserController::class);
    Route::apiResource('generatePDF', PDFController::class);
    Route::apiResource('icd', ICDAPIController::class);

    Route::apiResource('get-all-notification', NotificationController::class);

    //Doctor Order
    Route::apiResource('doctor-orders', PatientController::class);
    Route::apiResource('update-progress-note', PatientController::class);
    Route::apiResource('update-physician-order', PatientController::class);
    Route::apiResource('create-doctor-order', PatientController::class);
    Route::apiResource('create-progress-notes-list', PatientController::class);

    //Patient Approval
    Route::apiResource('get-patient-approval', PatientController::class);
    Route::apiResource('get-patient-total', PatientController::class);
    Route::apiResource('update-approve-patient', PatientController::class);
    Route::apiResource('delete-approve-patient', PatientController::class);

    //System
    Route::apiResource('get-about-us', AboutUsController::class);
    Route::apiResource('create-about-us', AboutUsController::class);
    Route::apiResource('update-about-us', AboutUsController::class);
    Route::apiResource('create-module', ModuleController::class);
    Route::apiResource('update-module', ModuleController::class);

    // Personal Information
    Route::apiResource('get-personal-info-list', PatientController::class);

    // patient management
    Route::apiResource('auto-save', PatientController::class);
    Route::apiResource('er-list', PatientController::class);
    Route::apiResource('opd-list', PatientController::class);
    Route::apiResource('ipd-list', PatientController::class);
    Route::apiResource('physician-list', PatientController::class);
    Route::apiResource('physician-charge', PatientController::class);
    Route::apiResource('create-patient', PatientController::class);
    Route::apiResource('create-in-patient', PatientController::class);
    Route::apiResource('create-out-patient', PatientController::class);
    Route::apiResource('create-doctor-request', PatientController::class);


    Route::apiResource('update-patient-medication', PatientController::class);
    Route::apiResource('delete-patient-medication', PatientController::class);
    Route::apiResource('get-detail-by-id', PatientController::class);
    Route::apiResource('get-lab-result', PatientController::class);
    Route::apiResource('get-imaging-result', PatientController::class);
    Route::apiResource('get-pathology', PatientController::class);
    Route::apiResource('get-pathology-category', PatientController::class);
    Route::apiResource('get-pathology-parameter', PatientController::class);
    Route::apiResource('get-radiology', PatientController::class);
    Route::apiResource('get-radiology-category', PatientController::class);
    Route::apiResource('get-icd10', PatientController::class);
    Route::apiResource('get-medication', PatientController::class);
    Route::apiResource('get-medicine', PatientController::class);
    Route::apiResource('get-symptoms', PatientController::class);

    Route::apiResource('create-symptom', PatientController::class);
    Route::apiResource('update-symptom', PatientController::class);
    Route::apiResource('create-prescription', PatientController::class);
    Route::apiResource('create-pharmcy-medicine', PatientController::class);
    Route::apiResource('create-pharmcy-category', PatientController::class);
    Route::apiResource('create-pharmcy-supplier', PatientController::class);
    Route::apiResource('get-pharmcy-category', PatientController::class);
    Route::apiResource('get-pharmcy-supplier', PatientController::class);
    Route::apiResource('create-nurse-note', PatientController::class);
    Route::apiResource('get-nurse-note', PatientController::class);
    Route::apiResource('get-designation-list', PatientController::class);

    Route::apiResource('create-doctor-order-row', PatientController::class);
    Route::apiResource('get-doctor-order', PatientController::class);
    Route::apiResource('create-health-monitor', PatientController::class);
    Route::apiResource('get-health-monitor', PatientController::class);
    Route::apiResource('get-health-monitor-by-id', PatientController::class);
    Route::apiResource('delete-health-monitor', PatientController::class);

    // Eye Center
    Route::apiResource('get-eyecenter-list', EyeCenterController::class);
    Route::apiResource('create-eyecenter-appointment', EyeCenterController::class);
    Route::apiResource('update-eyecenter-appointment', EyeCenterController::class);

    //Pathology
    Route::apiResource('create-pathology-category', PathologyController::class);
    Route::apiResource('create-pathology-parameter', PathologyController::class);
    Route::apiResource('create-pathology-test', PathologyController::class);
    Route::apiResource('get-pathology-category-list', PatientController::class);
    Route::apiResource('update-pathology-test', PathologyController::class);
    Route::apiResource('update-pathology-parameter', PathologyController::class);
    Route::apiResource('update-pathology-category', PathologyController::class);

    //Radiology
    Route::apiResource('create-radiology-category', RadiologyController::class);
    Route::apiResource('create-radiology', RadiologyController::class);
    Route::apiResource('update-radiology', RadiologyController::class);
    Route::apiResource('update-radiology-category', RadiologyController::class);

    // bed management
    Route::apiResource('bed-management', BedController::class);
    Route::apiResource('get-bed-list', BedController::class);
    Route::apiResource('get-bed-floor', BedController::class);
    Route::apiResource('get-bed-group', BedController::class);
    Route::apiResource('get-bed-type', BedController::class);
    Route::apiResource('create-bed-floor', BedController::class);
    Route::apiResource('create-bed-group', BedController::class);
    Route::apiResource('create-bed-type', BedController::class);
    Route::apiResource('create-bed', BedController::class);

    Route::apiResource('update-bed-floor', BedController::class);
    Route::apiResource('update-bed-group', BedController::class);
    Route::apiResource('update-bed-type', BedController::class);
    Route::apiResource('update-bed-list', BedController::class);

    // hospital charges
    Route::apiResource('charge-list', HospitalChargeController::class);
    Route::apiResource('create-hosptl-charge', HospitalChargeController::class);
    Route::apiResource('create-hosptl-charge-type', HospitalChargeController::class);
    Route::apiResource('create-hosptl-charge-cat', HospitalChargeController::class);
    Route::apiResource('create-hosptl-phy-opd', HospitalChargeController::class);
    Route::apiResource('create-hosptl-phy-er', HospitalChargeController::class);
    Route::apiResource('get-hosptl-charge', HospitalChargeController::class);
    Route::apiResource('get-hosptl-charge-type', HospitalChargeController::class);
    Route::apiResource('get-hosptl-charge-category', HospitalChargeController::class);
    Route::apiResource('update-hospital-charge', HospitalChargeController::class);
    Route::apiResource('update-hospital-charge-type', HospitalChargeController::class);
    Route::apiResource('update-hospital-charge-category', HospitalChargeController::class);
    Route::apiResource('update-hospital-physician-charge', HospitalChargeController::class);
    Route::apiResource('update-hospital-charge-opd', HospitalChargeController::class);
    // Inventory
    Route::apiResource('get-inventory-stock-list', InventoryController::class);
    Route::apiResource('get-inventory-issue', InventoryController::class);
    Route::apiResource('get-item-status', InventoryController::class);
    Route::apiResource('get-item-category', InventoryController::class);
    Route::apiResource('create-inventory-stock-list', InventoryController::class);
    Route::apiResource('create-inventory-category', InventoryController::class);
    Route::apiResource('create-inventory-issue', InventoryController::class);

    // doh
    Route::apiResource('doh-report', DOHController::class);
    Route::apiResource('get-info-classification', DOHController::class);

    Route::apiResource('submit-ic', DOHController::class);
    Route::apiResource('submit-iqm', DOHController::class);
    Route::apiResource('submit-ibc', DOHController::class);
    Route::apiResource('submit-hosp', DOHController::class);
    Route::apiResource('submit-hods', DOHController::class);
    Route::apiResource('submit-hodm', DOHController::class);
    Route::apiResource('submit-hodnd', DOHController::class);
    Route::apiResource('submit-hodopv', DOHController::class);
    Route::apiResource('submit-hodopd', DOHController::class);
    Route::apiResource('submit-hosder', DOHController::class);
    Route::apiResource('submit-hosdev', DOHController::class);
    Route::apiResource('submit-hosdt', DOHController::class);
    Route::apiResource('submit-hood', DOHController::class);
    Route::apiResource('submit-homd', DOHController::class);
    Route::apiResource('submit-hohai', DOHController::class);
    Route::apiResource('submit-homajopt', DOHController::class);
    Route::apiResource('submit-hominopt', DOHController::class);
    Route::apiResource('submit-stafptern', DOHController::class);
    Route::apiResource('submit-dohexpen', DOHController::class);
    Route::apiResource('submit-dohrev', DOHController::class);
    Route::apiResource('submit-sreport', DOHController::class);
});


// Route::get('logout', [AuthController::class, 'logout']);