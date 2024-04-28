<?php
namespace App\Services;

use App\Models\User;
use App\Models\Grant;
use App\Models\AboutUs;
use App\Models\BedList;
use App\Models\BedType;
use App\Models\Patient;
use App\Models\BedFloor;
use App\Models\BedGroup;
use App\Models\Identity;
use App\Models\Pathology;
use App\Models\Radiology;
use App\Services\Service;
use App\Models\HospitalCharge;
use App\Models\InventoryIssue;
use App\Models\PathologyCategory;
use App\Models\RadiologyCategory;
use App\Models\HospitalChargeType;
use App\Models\PathologyParameter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\InventoryItemCategory;
use App\Models\HospitalChargeCategory;
use App\Models\InventoryItemStockList;
use App\Models\HospitalPhysicianCharge;
use App\Models\Module;

class SettingService extends Service {
    function createBulkUser($request) {
        DB::beginTransaction();
        try {
            $dataArray = $request->input('data');

            foreach($dataArray as $keys => $data) {
                $userId[$keys] = $this->generateTxnID("QSO");

                // var_dump($fields);

                $this->createUser($userId[$keys], $data['email'], Hash::make($data['password']),  $data['roles'] );
                // $this->createUser($userId[$keys], $fields['email'], Hash::make($fields['password']));

                // $this->createIdentity($user->user_id);
                $this->grantUser('dashboard',  $userId[$keys], 'dashboard');
                $this->grantUser('dashboard',  $userId[$keys], 'settings');
                $this->grantUser('settings',  $userId[$keys], 'settings');
                $this->grantUser('settings',  $userId[$keys], 'dashboard');

            }

            DB::commit();

            return response()->json([
                'message' => 'Successfully created',
                'status' => 'success'
            ], 200);
        } catch(\Exception $ex) {
            DB::rollback();

            //return error
            return response()->json(
                [
                    'message' => $ex->getMessage()
                ], 500
            );
        }
    }

    function createBulkAction($request) {
        DB::beginTransaction();
        try {
            $actionType = $request->input('actionType');
            $dataArray = $request->input('data');
            switch($actionType) {
                case 'createModule':
                    foreach($dataArray as $keys => $data) {
                        $this->insertModule(
                            $data['module_id'],
                            $data['type'],
                            $data['name'],
                            $data['menu_group']);
                            // $data['sort'],
                            // $data['icon'],
                            // $data['description']);
                    }
                    break;

                case 'createHosptlCharge':
                    foreach($dataArray as $keys => $data) {
                        $this->insertHosptlCharge(
                            $data['charge_type'],
                            $data['charge_category'],
                            $data['code'],
                            $data['standard_charge']
                        );
                    }
                    break;

                case 'createHosptlChargeCat':
                    foreach($dataArray as $keys => $data) {
                        $this->insertHosptlChargeCat(
                            $data['name'],
                            $data['description'],
                            $data['charge_type']
                        );
                    }
                    break;

                case 'createHosptlPhyChargeOpd':
                    foreach($dataArray as $keys => $data) {
                        $this->insertHosptlPhyChargeOpd(
                            $data['doctor_id'],
                            $data['standard_charge']
                        );
                    }
                    break;

                case 'createHosptlPhyChargeEr':
                    foreach($dataArray as $keys => $data) {
                        $this->insertHosptlPhyChargeEr(
                            $data['doctor_id'],
                            $data['standard_charge']
                        );
                    }
                    break;

                case 'createHosptlChargeType':
                    foreach($dataArray as $keys => $data) {
                        $this->insertHosptlChargeType(
                            $data['name']
                        );
                    }
                    break;

                case 'createBedFloor':
                    foreach($dataArray as $keys => $data) {
                        $this->insertBedFloor(
                            $data['name'],
                            $data['description']);
                    }
                    break;

                case 'createBedGroup':
                    foreach($dataArray as $keys => $data) {
                        $this->insertBedGroup(
                            $data['name'],
                            $data['description'],
                            $data['bed_floor']);
                    }
                    break;

                case 'createBedType':
                    foreach($dataArray as $keys => $data) {
                        $this->insertBedType(
                            $data['name']);
                    }
                    break;

                case 'createBed':
                    foreach($dataArray as $keys => $data) {
                        $this->insertBed(
                            $data['name'],
                            $data['bed_type'],
                            $data['bed_group']);
                    }
                    break;

                case 'createPathologyCategory':
                    foreach($dataArray as $keys => $data) {
                        $this->insertPathologyCategory(
                            $data['category_name'],
                            $data['description']
                        );
                    }
                    break;

                case 'createPathologyTest':
                    foreach($dataArray as $keys => $data) {
                        $this->insertPathology(
                            $data['test_name'],
                            $data['short_name'],
                            $data['patho_category_id'],
                            $data['patho_param_id'],
                            $data['unit'],
                            $data['sub_category'],
                            $data['report_days'],
                            $data['methods'],
                            $data['charge'],
                        );
                    }
                    break;

                case 'createPathologyParameter':
                    foreach($dataArray as $keys => $data) {
                        $this->insertPathologyParameter(
                            $data['param_name'],
                            $data['test_value'],
                            $data['ref_range'],
                            $data['unit'],
                            $data['description']);
                    }
                    break;

                case 'createRadiology':
                    foreach($dataArray as $keys => $data) {
                        $this->insertRadiologyTest(
                            $data['test_name'],
                            $data['test_type'],
                            $data['radio_cat_id'],
                            $data['charge']
                        );
                    }
                    break;

                case 'createRadiologyCategory':
                    foreach($dataArray as $keys => $data) {
                        $this->insertRadiologyCategory(
                            $data['category_name'],
                            $data['description']
                        );
                    }
                    break;

                case 'createInventoryStockList':
                    foreach($dataArray as $keys => $data) {
                        $this->insertInventoryStockList(
                            $data['item'],
                            $data['category_id'],
                            $data['supplier'],
                            $data['date'],
                            $data['qty'],
                            $data['purchase_price'],
                        );
                    }
                    break;

                case 'createInventoryCategory':
                    foreach($dataArray as $keys => $data) {
                        $this->insertInventoryCategory(
                            $data['category_name']
                        );
                    }
                    break;

                case 'createInventoryIssue':
                    foreach($dataArray as $keys => $data){
                        $this->insertInventoryIssue(
                            $data['usert_type_id'],
                            $data['status_id'],
                            $data['issue_to'],
                            $data['issue_by'],
                            $data['issue_date'],
                            $data['return_date'],
                            $data['note'],
                            $data['category_id'],
                            $data['item_id'],
                            $data['qty']
                        );
                    }
                    break;

                case 'createAboutUs':
                    $this->insertAboutUs(
                       $dataArray['hci_name'],
                       $dataArray['accreditation_no'],
                       $dataArray['province'],
                       $dataArray['province_name'],
                       $dataArray['city'] ?? '',
                       $dataArray['city_name'] ?? '',
                       $dataArray['municipality'] ?? '',
                       $dataArray['municipality_name'] ?? '',
                       $dataArray['barangay'],
                       $dataArray['barangay_name'],
                       $dataArray['street'],
                       $dataArray['subdivision_village'],
                       $dataArray['building_no'],
                       $dataArray['blk'],
                       $dataArray['postal_code']
                    );
                    break;

                case 'createApprovePatient':
                    $this->insertPatientApprove(
                       $dataArray['patient_id'],
                       $dataArray['admitting_physician'],
                       $dataArray['admitting_clerk'],
                    );
                    break;

                default:
                    return "error";
            }

            DB::commit();

            return response()->json([
                'message' => 'Successfully created',
                'status' => 'success'
            ], 200);
        } catch(\Exception $ex) {
            DB::rollback();

            //return error
            return response()->json(
                [
                    'message' => $ex->getMessage()
                ], 500
            );
        }
    }

    private function insertHosptlCharge($chargeType, $chargeCategory, $code, $standardCharge) {
        HospitalCharge::create([
            'charge_type_id' => $chargeType,
            'charge_category_id' => $chargeCategory,
            'code' => $code,
            'standard_charge' => $standardCharge,
        ]);
    }

    private function insertHosptlChargeCat($name, $description, $chargeType) {
        HospitalChargeCategory::create([
            'name' => $name,
            'description' => $description,
            'charge_type_id' => $chargeType
        ]);
    }

    private function insertHosptlPhyChargeOpd($doctorId, $standardCharge) {
        HospitalPhysicianCharge::create([
            'doctor_id' => $doctorId,
            'standard_charge' => $standardCharge,
            'standard_charge_type' => 'opd'
        ]);
    }

    private function insertHosptlPhyChargeEr($doctorEr, $standardCharge) {
        HospitalPhysicianCharge::create([
            'doctor_id' => $doctorEr,
            'standard_charge' => $standardCharge,
            'standard_charge_type' => 'er'
        ]);
    }

    private function insertHosptlChargeType($name) {
        HospitalChargeType::create([
            'name' => $name
        ]);
    }

    private function insertBedFloor($name, $description) {
        BedFloor::create([
            'floor' => $name,
            'description' => $description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function insertBedGroup($name, $description, $bedFloor) {
        BedGroup::create([
            'name' => $name,
            'description' => $description,
            'floor_id' => $bedFloor,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function insertBedType($name) {
        BedType::create([
            'name' => $name
        ]);
    }

    private function insertBed($name, $bedType, $bedGroup) {
        BedList::create([
            'name' => $name,
            'bed_type_id' => $bedType,
            'bed_group_id' => $bedGroup,
        ]);
    }

    private function insertPathology($testName, $shortName, $categoryId, $paramId, $unit, $subCategory, $reportDays, $methods, $charge) {
        Pathology::create([
            'test_name' => $testName,
            'short_name' => $shortName,
            'patho_category_id' => $categoryId,
            'patho_param_id' => $paramId,
            'unit' => $unit,
            'sub_category' => $subCategory,
            'report_days' => $reportDays,
            'methods' => $methods,
            'charge' => $charge
        ]);
    }

    private function insertPathologyCategory($name, $description) {
        PathologyCategory::create([
            'category_name' => $name,
            'description' => $description
        ]);
    }

    private function insertPathologyParameter($paramName, $testValue, $refRange, $unit, $description) {
        PathologyParameter::create([
            'param_name' => $paramName,
            'test_value' => $testValue,
            'ref_range' => $refRange,
            'unit' => $unit,
            'description' => $description
        ]);
    }

    private function insertRadiologyCategory($name, $description) {
        RadiologyCategory::create([
            'category_name' => $name,
            'description' => $description,
        ]);
    }

    private function insertRadiologyTest($testName, $testType, $catId, $charge) {
        Radiology::create([
            'test_name' => $testName,
            'test_type' => $testType,
            'radio_cat_id' => $catId,
            'charge' => $charge
        ]);
    }

    private function insertInventoryStockList($item, $category_id, $supplier, $date, $qty, $purchasePrice) {
        InventoryItemStockList::create([
            'item' => $item,
            'category_id' => $category_id,
            'supplier' => $supplier,
            'date' => $date,
            'qty' => $qty,
            'purchase_price' => $purchasePrice
        ]);
    }

    private function insertInventoryCategory($name) {
        InventoryItemCategory::create([
            'category_name' => $name,
        ]);
    }

    private function insertInventoryIssue($userTypeId, $statusId, $issueTo, $issueBy, $issueDate, $returnData, $note, $categoryId, $itemId, $qty) {
        InventoryIssue::create([
            'usert_type_id' => $userTypeId,
            'status_id' => $statusId,
            'issue_to' => $issueTo,
            'issue_by' => $issueBy,
            'issue_date' => $issueDate,
            'return_date' => $returnData,
            'note' => $note,
            'category_id' => $categoryId,
            'item_id' => $itemId,
            'qty' => $qty
        ]);
    }

    private function insertAboutUs($hci, $accreditation_no, $province, $provinceName, $city, $cityName, $municipality, $municipalityName, $barangay, $barangayName, $street, $subdivision_village, $building_no, $blk, $postalCode) {
        AboutUs::create([
            'hci_name' => $hci,
            'accreditation_no' => $accreditation_no,
            'province' => $province,
            'province_name' => $provinceName,
            'city' => $city,
            'city_name' => $cityName,
            'municipality' => $municipality,
            'municipality_name' => $municipalityName,
            'barangay' => $barangay,
            'barangay_name' => $barangayName,
            'street' => $street,
            'subdivision_village' => $subdivision_village,
            'building_no' => $building_no,
            'blk' => $blk,
            'postal_code' => $postalCode
        ]);
    }

    private function insertModule($module_id, $type, $name, $menu_group) {
        Module::create([
            'module_id' => $module_id,
            'type' => $type,
            'name'=> $name,
            'menu_group' => $menu_group
            // 'sort' => $sort,
            // 'icon' => $icon,
            // 'description' => $description
        ]);
    }

    function grantModules($request) {
        DB::beginTransaction();
        try {
            $dataArray = $request->input('data');
            $identity_id = $dataArray['identity_id'] ?? null;
            $toggleData = $dataArray['toggleData'] ?? [];

            Grant::where('identity_id', $identity_id)->delete();
            Grant::insert($toggleData);

            DB::commit();

            return response()->json([
                'status' => 'success'
            ], 200);
        } catch(\Exception $ex) {
            DB::rollback();

            //return error
            return response()->json(
                [
                    'message' => $ex->getMessage()
                ], 500
            );
        }
    }

    public function grantUser($module, $identity_id, $menuGroup) {
        Grant::create([
            'permission_id' => $module,
            'identity_id' => $identity_id,
            'menu_group' => $menuGroup,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function createUser($userId, $email, $password, $roles) {
        User::create([
            'user_id' => $userId,
            'email' => $email,
            'password' => $password,
            'roles' => $roles
        ]);

        Identity::create([
            'user_id' => $userId
        ]);
    }

    public function createIdentity($userId) {
        Identity::create([
            'user_id' => $userId
        ]);
    }

    private function insertPatientApprove($patientId, $physicianId, $clerkId) {
        Patient::create([
            'patient_id' => $patientId,
            'admitting_physician' => $physicianId,
            'admitting_clerk' => $clerkId,
            'is_approved' => 1
        ]);
    }
}
