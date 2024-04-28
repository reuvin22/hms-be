<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\AboutUs;
use App\Models\BedList;
use App\Models\BedType;
use App\Models\Patient;
use App\Models\Symptom;
use App\Models\BedFloor;
use App\Models\BedGroup;
use App\Models\Identity;
use App\Models\Medicine;
use App\Models\EyeCenter;
use App\Models\OrderList;
use App\Models\Pathology;
use App\Models\Radiology;
use App\Services\Service;
use App\Models\PatientOPD;
use App\Models\DoctorOrder;
use App\Models\PatientTest;
use App\Models\MedicineForm;
use App\Models\Notification;
use App\Models\PatientVital;
use App\Models\HealthMonitor;
use App\Models\ProgressNotes;
use App\Models\HospitalCharge;
use App\Models\PatientBilling;
use App\Models\PatientHistory;
use App\Models\PatientIvfluid;
use App\Events\NewNotification;
use App\Models\DoctorOrderItem;
use App\Models\PatientApproval;
use App\Models\PatientImgResult;
use App\Models\PatientLabResult;
use App\Models\PatientNurseNote;
use App\Models\PharmacyCategory;
use App\Models\PharmacySupplier;
use App\Models\MedicineFrequency;
use App\Models\PathologyCategory;
use App\Models\PatientMedication;
use App\Models\RadiologyCategory;
use App\Models\HospitalChargeType;
use App\Models\PathologyParameter;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\HospitalChargeCategory;
use App\Models\HospitalPhysicianCharge;

class PatientService extends Service {
    function createBulkAction($request) {
        DB::beginTransaction();
        try {
            $userIds = [];
            $userHRNs = [];
            $bedIdsToUpdate = [];
            $patientType = $request->input('patientType');
            $actionType = $request->input('actionType');
            $nurseId = $request->input('nurseId');
            $patientId = $request->input('patientId');
            $physicianId = $request->input('physicianId');
            $data = $request->input('data');

            switch($actionType) {
                case 'createDoctorOrderNewRow':
                    $do = DoctorOrder::create([
                        'patient_id' => $data['patientId'],
                        'physician_id' => $data['physicianId'],
                        'date_time' => now(),
                        'nurse_incharge' => $data['nurseId'],
                    ]);

                    if($do) {
                        DoctorOrderItem::create([
                            'do_id' => $do->id
                        ]);
                    }
                    break;

                case 'createDoctorOrders':
                        $this->insertDoctorOrders(
                            $data['progress_notes']
                        );
                    break;

                case 'createSymptom':
                    foreach($data as $key => $value) {
                        Symptom::create([
                            'name' => $value['name'],
                            // 'code' => $value['code']
                        ]);
                    }
                    break;
                case 'createMedicine':
                case 'createMedicineForm':
                case 'createMedicineFrequency':
                    foreach($data as $keys => $value) {
                        if($actionType === 'createMedicine') {
                            $this->insertMedicine(
                                $value['brand_name'],
                                $value['generic_name'],
                                $value['dosage'],
                                $value['duration_from'],
                                $value['duration_to'],
                                $value['amount'],
                                $value['quantity']
                            );
                        } else if($actionType === 'createMedicineForm') {
                            MedicineForm::create([
                                'name' => $value['name']
                            ]);
                        } else if($actionType === 'createMedicineFrequency') {
                            MedicineFrequency::create([
                                'name' => $value['name']
                            ]);
                        }
                    }
                    break;

                case 'createOutPatient':
                    $notifTitle = $request->input('title');
                    $notifMessage = $request->input('message');
                    $notifAction = $request->input('action');

                    foreach($data as $keys => $value) {
                        $userId[$keys] = $this->generateTxnID("QSO");
                        $userHRN[$keys] = $this->generateHRN();

                        $notificationData = [
                            'title' => $value['last_name'].' Added as new OPD',
                            'message' => $notifMessage,
                            'iconUrl' => 'https://i.imgur.com/r5pe7aJ.png',
                            'action' => $notifAction,
                            'timestamp' => Carbon::now(),
                            // 'link' => $request->input('')
                        ];

                        $notification = new Notification();
                        $notification->type = 'New';
                        $notification->data = $notificationData;
                        $notification->save();

                        // broadcast notifications
                        // event(new NewNotification($notification));

                        $userUid = $value['admitting_physician'];
                        $user = User::where('user_id', $userUid)->first();
                        if($user) {
                            $user->notifications()->attach($notification->id, ['read_at' => null]);
                        }

                        $this->insertPatient(
                            $userId[$keys],
                            $userHRN[$keys],
                            $value['admitting_physician'],
                            Auth::user()->user_id,
                            $patientType
                        );

                        $this->insertInformation(
                            $userId[$keys],
                            $value['last_name'],
                            $value['first_name'],
                            $value['middle_name'],
                            $value['birth_date'],
                            $value['age'],
                            $value['gender']
                        );

                        $this->insertPatientBill(
                            $userId[$keys],
                            $value['admitting_physician'],
                            $value['standard_charge'],
                        );
                    }
                    break;

                    case 'createInPatient':
                        foreach ($data as $keys => $value) {
                            $patientCheck = PersonalInformation::where('first_name', $value['first_name'])
                            ->where('middle_name', $value['middle_name'])
                            ->where('last_name', $value['last_name'])
                            ->where('birth_date', $value['birth_date'])
                            ->count();
                            if($patientCheck > 0) {
                                return response()->json([
                                    'message' => 'Patient already exists'
                                ]);
                            }
                            // Generate unique IDs
                            $userId = $this->generateTxnID("QSO");
                            $userHRN = $this->generateHRN();

                            // Collect bed IDs to update the status later
                            if (!empty($value['bed'])) {
                                $bedIdsToUpdate[] = $value['bed'];
                            }

                            // Insert new patient
                            $this->insertPatient(
                                $userId,
                                $userHRN,
                                $value['admitting_physician'],
                                Auth::user()->user_id,
                                $patientType,
                                $value['bed']
                            );

                            // Insert patient information
                            $this->insertInformation(
                                $userId,
                                $value['last_name'],
                                $value['first_name'],
                                $value['middle_name'],
                                $value['birth_date'],
                                $value['age'],
                                $value['gender']
                            );

                            // Insert patient bill
                            $this->insertPatientBill(
                                $userId,
                                $value['admitting_physician'],
                                $value['standard_charge']
                            );
                        }

                        if (!empty($bedIdsToUpdate)) {
                            BedList::whereIn('id', $bedIdsToUpdate)->update(['is_active' => false]);
                        }
                        break;

                case 'createDoctorRequest':
                    foreach($data as $keys => $value) {
                        $pathology = Pathology::where('id' , $value['test_id'])->first();
                        $radiology = Radiology::where('id' , $value['test_id'])->first();

                        $this->insertPatientTest(
                            $value['patient_id'],
                            $value['physician_id'],
                            $value['test_id'],
                            $value['lab_category'],
                            $value['charge']
                        );

                        if($value['lab_category'] === 'pathology') {
                            PatientLabResult::create([
                                'patient_id' => $value['patient_id'],
                                'physician_id' => $value['physician_id'],
                                'test_name' => $pathology->test_name
                            ]);
                        } else if($value['lab_category'] === 'radiology') {
                            PatientImgResult::create([
                                'patient_id' => $value['patient_id'],
                                'physician_id' => $value['physician_id'],
                                'test_name' => $radiology->test_name,
                            ]);
                        }
                    }
                    break;

                case 'createPrescription':
                    $prescribeData = $request->input('data.data');
                    $medicines = Medicine::find($prescribeData['id']);

                    $this->insertPatientMedication(
                        $data['patientId'],
                        // $data['physicianId'],
                        Auth::user()->user_id, //this will catch the user who furnished the data
                        $prescribeData['id'],
                        $prescribeData['dosage'],
                        $prescribeData['form'],
                        $prescribeData['qty'],
                        $prescribeData['frequency'],
                        $prescribeData['sig'],
                    );

                    // update quantity on medicines
                    if($medicines) {
                        $total = $medicines->quantity - $prescribeData['qty'];
                        $medicines->quantity = $total;
                        $medicines->save();
                    }

                    break;

                case 'createNurseNote':
                    $patient_id = $request->input('patientId');
                    foreach($data as $keys => $value) {
                        $this->insertPatientNurseNote(
                            $patient_id,
                            Auth::user()->user_id,
                            $value['no_notes']
                        );
                    }
                    break;

                case 'createNurseIVF':
                    $patient_id = $request->input('patientId');
                    foreach($data as $keys => $value) {
                        $this->insertPatientIvFluid(
                            $patient_id,
                            Auth::user()->user_id,
                            $value['ivf_bottle_no'],
                            $value['ivf_type_iv'],
                            $value['ivf_volumn_ml'],
                            $value['ivf_rate_flow'],
                            $value['ivf_date_time_start'],
                            $value['ivf_date_time_end'],
                            $value['ivf_nurse_duty'],
                            $value['ivf_remarks'],
                        );
                    }
                    break;
                case 'createNurseVitalS':
                    $patient_id = $request->input('patientId');
                    foreach($data as $keys => $value) {
                        $this->insertPatientVitalSign(
                            $patient_id,
                            Auth::user()->user_id,
                            $value['vs_bp'],
                            $value['vs_hr'],
                            $value['vs_temp'],
                            $value['vs_o2sat'],
                            $value['vs_height'],
                            $value['vs_weight'],
                            $value['vs_bmi']
                        );
                    }
                    break;

                case 'createHealthMonitor':
                    $this->insertHealthMonitor(
                        $data['health_monitor_id'],
                        $data['patient_id'],
                        $data['date'],
                        $data['hour'],
                        $data['respiratory_rate'],
                        $data['pulse_rate'],
                        $data['temperature']
                    );
                break;

                case 'createEyeCenterAppointment':
                    foreach($data as $keys => $value) {
                        $this->insertEyeCenterAppointment(
                            $value['patient_name'],
                            $value['doctors_agenda'],
                            $value['appointment_date'],
                            $value['appointment_color']
                        );
                    }
                    break;

                case 'createPharmacyCategory':
                    foreach($data as $keys => $value) {
                        $this->insertPharmacyCategory(
                            $value['category_name']
                        );
                    }
                    break;

                case 'createPharmacySupplier':
                    foreach($data as $keys => $value) {
                        $this->insertPharmacySupplier(
                            $value['supplier_name']
                        );
                    }
                    break;

                case 'createOrderList':
                        $this->insertOrderList(
                            $data['order_id'],
                            $data['patient_id'],
                            $data['physician_id'],
                            $data['nurse_incharge'],
                            $data['name'],
                            $data['description']
                        );
                    break;

                case 'createProgressNotes':
                    $this->insertProgressNotes(
                        $data['order_id'],
                        $data['patient_id'],
                        $data['physician_id'],
                        $data['progress_notes'],
                        $data['nurse_incharge']
                    );
                break;

                default:
                    return null;

            }

            DB::commit();

            return response()->json([
                'status' => 'success'
            ], 200);

        } catch(\Exception $ex) {
            DB::rollback();

            return response()->json(
                [
                    'message' => $ex->getMessage()
                ], 500
            );
        }
    }

    function deleteAction($request, $id) {
        DB::beginTransaction();
        try {
            $actionType = $request->input('actionType');
            switch($actionType) {
                case 'deleteDoctorOrderById':
                    $item = DoctorOrder::find($id);
                    $item->delete();
                    break;

                default:
                    return null;

            }
        } catch(\Exception $ex) {
            DB::rollback();

            return response()->json(
                [
                    'message' => $ex->getMessage()
                ], 500
            );
        }
    }

    function updateBulkAction($request, $id) {
        DB::beginTransaction();
        try {
            $data = $request->input('data');
            $actionType = $request->input('actionType');
            switch ($actionType) {
                case 'updateMedication':
                    $patientMedication = PatientMedication::find($id);
                    $medicines = Medicine::find($id);
                    // update patient medication
                    if($patientMedication) {
                        if($patientMedication->status !== 'ps') {
                            // $patientMedication->dose = $data['dose'];
                            $patientMedication->form = $data['form'];
                            $patientMedication->qty = $data['qty'];
                            $patientMedication->frequency = $data['frequency'];
                            $patientMedication->sig = $data['sig'];
                            $patientMedication->status = 'ps'; //ps -> prescribe
                            $patientMedication->save();
                        } else {
                            return response()->json([
                                'message' => $patientMedication->generic_name .' already prescribed'
                            ], 400);
                        }
                    }

                    // update quantity on medicines
                    if($medicines) {
                        $total = $medicines->quantity - $data['qty'];
                        $medicines->quantity = $total;
                        $medicines->save();
                    }
                    break;

                case 'updatePhysicianOrder':
                    $physicianOrder = DoctorOrder::find($id);
                    if($physicianOrder) {
                        $physicianOrder->physician_order = "Published";
                        $physicianOrder->save();
                    }
                    break;

                case 'updateMedicines':
                    $medicines = Medicine::find($id);
                    if($medicines) {
                        $medicines->quantity += $data['quantity'];
                        $medicines->created_at = now();
                        $medicines->save();
                    }
                    break;

                case 'updatePathologyTest':
                    $pathologies = Pathology::find($id);
                    if($pathologies) {
                        $pathologies->test_name = $data['test_name'];
                        $pathologies->short_name = $data['short_name'];
                        $pathologies->patho_category_id = $data['patho_category_id'];
                        $pathologies->sub_category = $data['sub_category'];
                        $pathologies->patho_param_id = $data['patho_param_id'];
                        $pathologies->unit = $data['unit'];
                        $pathologies->methods = $data['methods'];
                        $pathologies->charge = $data['charge'];
                        $pathologies->save();
                    }
                    break;

                case 'updatePathologyParameter':
                    $pathologies = PathologyParameter::find($id);
                    if($pathologies) {
                        $pathologies->param_name = $data['param_name'];
                        $pathologies->test_value = $data['test_value'];
                        $pathologies->ref_range = $data['ref_range'];
                        $pathologies->unit = $data['unit'];
                        $pathologies->description = $data['description'];
                        $pathologies->save();
                    }
                    break;
                //
                case 'updatePathologyCategory':
                    $pathologies = PathologyCategory::find($id);
                    if($pathologies) {
                        $pathologies->category_name = $data['category_name'];
                        $pathologies->description = $data['description'];
                        $pathologies->save();
                    }
                    break;

                case 'updateRadiology':
                    $radiology = Radiology::find($id);
                    if($radiology) {
                        $radiology->test_name = $data['test_name'];
                        $radiology->test_type = $data['test_type'];
                        $radiology->radio_cat_id = $data['radio_cat_id'];
                        $radiology->charge = $data['charge'];
                        $radiology->save();
                    }
                    break;

                case 'updateRadiologyCategory':
                    $radiologyCategory = RadiologyCategory::find($id);
                    if($radiologyCategory) {
                        $radiologyCategory->category_name = $data['category_name'];
                        $radiologyCategory->description = $data['description'];
                        $radiologyCategory->save();
                    }
                    break;

                case 'updateSymptom':
                    $symptoms = Symptom::find($id);
                    if($symptoms) {
                        $symptoms->name = $data['name'];
                        // $symptoms->code = $data['code'];
                        $symptoms->save();
                    }
                    break;

                case 'updateHospitalCharge':
                    $hospitalCharge = HospitalCharge::find($id);
                    if($hospitalCharge) {
                        $hospitalCharge->charge_type_id = $data['charge_type_id'];
                        $hospitalCharge->charge_category_id = $data['charge_category_id'];
                        $hospitalCharge->code = $data['code'];
                        $hospitalCharge->save();
                    }
                    break;

                case 'updateHospitalChargeType':
                    $chargeType = HospitalChargeType::find($id);
                    if($chargeType) {
                        $chargeType->name = $data['name'];
                        $chargeType->save();
                    }
                    break;

                case 'updateHospitalPhysicianCharge':
                    $doctor = HospitalPhysicianCharge::find($id);
                    if($doctor) {
                        $doctor->doctor_id = $data['doctor_id'];
                        $doctor->standard_charge = $data['standard_charge'];
                        $doctor->save();
                    }
                    break;

                case 'updateHospitalChargeCategory':
                    $hostpitalChargeCategory = HospitalChargeCategory::find($id);
                    if($hostpitalChargeCategory) {
                        $hostpitalChargeCategory->name = $data['name'];
                        $hostpitalChargeCategory->description = $data['description'];
                        $hostpitalChargeCategory->charge_type_id = $data['charge_type_id'];
                        $hostpitalChargeCategory->save();
                    }
                    break;

                case 'updateBedType':
                    $bedType = BedType::find($id);
                    if($bedType) {
                        $bedType->name = $data['name'];
                        $bedType->save();
                    }
                    break;

                case 'updateBedGroup':
                    $bedGroup = BedGroup::find($id);
                    if($bedGroup) {
                        $bedGroup->name = $data['name'];
                        $bedGroup->description = $data['description'];
                        $bedGroup->floor_id = $data['floor_id'];
                        $bedGroup->save();
                    }
                    break;

                case 'updateBedFloor':
                    $bedFloor = BedFloor::find($id);
                    if($bedFloor) {
                        $bedFloor->floor = $data['floor'];
                        $bedFloor->description = $data['description'];
                        $bedFloor->save();
                    }
                    break;

                case 'updateBedList':
                    $bedList = BedList::find($id);
                    if($bedList) {
                        $bedList->name = $data['name'];
                        $bedList->bed_type_id = $data['bed_type_id'];
                        $bedList->bed_group_id = $data['bed_group_id'];
                        $bedList->save();
                    }
                    break;

                case 'updateAboutUs':
                    $aboutUs = AboutUs::find($id);
                    if($aboutUs) {
                        $aboutUs->hci_name = $data['hci_name'];
                        $aboutUs->accreditation_no = $data['accreditation_no'];
                        $aboutUs->province = $data['province'];
                        $aboutUs->province_name = $data['province_name'];
                        $aboutUs->city = $data['city'];
                        $aboutUs->city_name = $data['city_name'];
                        $aboutUs->municipality = $data['municipality'];
                        $aboutUs->municipality_name = $data['municipality_name'];
                        $aboutUs->barangay = $data['barangay'];
                        $aboutUs->barangay_name = $data['barangay_name'];
                        $aboutUs->street = $data['street'];
                        $aboutUs->subdivision_village = $data['subdivision_village'];
                        $aboutUs->building_no = $data['building_no'];
                        $aboutUs->blk = $data['blk'];
                        $aboutUs->postal_code = $data['postal_code'];
                        $aboutUs->save();
                    }
                    break;

                case 'updateIsApprove':
                    $isApprove = Patient::find($id);
                    if($isApprove) {
                        $isApprove->is_approved = "Approved";
                        $isApprove->save();
                    }
                    break;

                case 'updateHospitalChargeEr':
                    $chargeOpd = HospitalPhysicianCharge::find($id);
                    if($chargeOpd) {
                        $chargeOpd->doctor_id = $data['doctor_id'];
                        $chargeOpd->standard_charge = $data['standard_charge'];
                        $chargeOpd->save();
                    }
                    break;

                case 'updatePatientSymptoms':
                    Patient::where('patient_id', $id)->update(['cr_symptoms' => null]);
                    $patientInformation = Patient::where('patient_id', $id)->first();
                    if($patientInformation) {
                        $patientInformation->cr_symptoms = implode(',', $data) ?? null;
                        $patientInformation->save();
                    }
                    break;

                case 'updateDoctorOrders':
                    $doctorOrderProgressNotes = DoctorOrder::find($id);
                    if($doctorOrderProgressNotes) {
                        $doctorOrderProgressNotes->progress_notes = $data['progress_notes'];
                        $doctorOrderProgressNotes->save();
                    }
                    break;

                case 'updatePatientHeent':
                    Patient::where('patient_id', $id)->update(['cr_heent' => null]);
                    $patientInformation = Patient::where('patient_id', $id)->first();
                    if($patientInformation) {
                        $patientInformation->cr_heent = implode(',', $data) ?? null;
                        $patientInformation->save();
                    }
                    break;

                case 'updatePatientChestLung':
                    Patient::where('patient_id', $id)->update(['cr_chest_lungs' => null]);
                    $patientInformation = Patient::where('patient_id', $id)->first();
                    if($patientInformation) {
                        $patientInformation->cr_chest_lungs = implode(',', $data) ?? null;
                        $patientInformation->save();
                    }
                    break;

                case 'updatePatientCvs':
                    Patient::where('patient_id', $id)->update(['cr_cvs' => null]);
                    $patientInformation = Patient::where('patient_id', $id)->first();
                    if($patientInformation) {
                        $patientInformation->cr_cvs = implode(',', $data) ?? null;
                        $patientInformation->save();
                    }
                    break;

                case 'updatePatientAbdomen':
                    Patient::where('patient_id', $id)->update(['cr_abdomen' => null]);
                    $patientInformation = Patient::where('patient_id', $id)->first();
                    if($patientInformation) {
                        $patientInformation->cr_abdomen = implode(',', $data) ?? null;
                        $patientInformation->save();
                    }
                    break;

                case 'updatePatientGuIe':
                    Patient::where('patient_id', $id)->update(['cr_gu_ie' => null]);
                    $patientInformation = Patient::where('patient_id', $id)->first();
                    if($patientInformation) {
                        $patientInformation->cr_gu_ie = implode(',', $data) ?? null;
                        $patientInformation->save();
                    }
                    break;

                case 'updatePatientSkinExtremities':
                    Patient::where('patient_id', $id)->update(['cr_skin_extremities' => null]);
                    $patientInformation = Patient::where('patient_id', $id)->first();
                    if($patientInformation) {
                        $patientInformation->cr_skin_extremities = implode(',', $data) ?? null;
                        $patientInformation->save();
                    }
                    break;

                case 'updatePatientNeuron':
                    Patient::where('patient_id', $id)->update(['cr_neurological_exam' => null]);
                    $patientInformation = Patient::where('patient_id', $id)->first();
                    if($patientInformation) {
                        $patientInformation->cr_neurological_exam = implode(',', $data) ?? null;
                        $patientInformation->save();
                    }
                    break;

                case 'updatePatientDetails':
                    $personalInformation = PersonalInformation::where('personal_id', $id)->first();
                    $patientInformation = Patient::where('patient_id', $id)->first();

                    $type = isset($data['type']) ? $data['type'] : null; // Use null or a default value

                    if($personalInformation || $patientInformation) {
                        $personalInformation->fill(array_filter([
                            'last_name' => $data['last_name'] ?? null,
                            'first_name' => $data['first_name'] ?? null,
                            'middle_name' => $data['middle_name'] ?? null,
                            'suffix' => $data['suffix'] ?? null,
                            'email' => $data['email'] ?? null,
                            'birth_date' => $data['birth_date'] ?? null,
                            'birth_place' => $data['birth_place'] ?? null,
                            'gender' => $data['gender'] ?? null,
                            'civil_status' => $data['civil_status'] ?? null,
                            'contact_no' => $data['contact_no'] ?? null,
                            'telephone_no' =>$data['telephone_no'] ?? null,
                            'age' => $data['age'] ?? null,
                            'province' => $data['province'] ?? null,
                            'city_of' => $data['city_of'] ?? null,
                            'municipality' => $data['municipality'] ?? null,
                            'zip_code' => $data['zip_code']?? null,
                            'barangay' => $data['barangay'] ?? null,
                            'subdivision_village' => $data['subdivision_village'] ?? null,
                            'street' => $data['street'] ?? null,
                            'no_blk_lot' => $data['no_blk_lot'] ?? null,
                            'nationality' => $data['nationality'] ?? null,
                            'religion' => $data['religion'] ?? null,
                            'occupation' => $data['occupation'] ?? null,
                            'employer_name' => $data['employer_name'] ?? null,
                            'employer_address' => $data['employer_address'] ?? null,
                            'employer_contact' => $data['employer_contact'] ?? null,
                            'father_name' => $data['father_name'] ?? null,
                            'father_address' => $data['father_address'] ?? null,
                            'father_contact' => $data['father_contact'] ?? null,
                            'mother_name' => $data['mother_name'] ?? null,
                            'mother_address' => $data['mother_address'] ?? null,
                            'mother_contact' => $data['mother_contact'] ?? null,
                            'spouse_name' => $data['spouse_name'] ?? null,
                            'spouse_address' => $data['spouse_address'] ?? null,
                            'spouse_contact' => $data['spouse_contact'] ?? null
                        ]));

                        $patientInformation->fill(array_filter([
                            'admission_date' => $data['admission_date'] ?? null,
                            'discharge_date' => $data['discharge_date'] ?? null,
                            'total_no_day' => $data['total_no_day'] ?? null,
                            'referred_by' => $data['referred_by'] ?? null,
                            'soc_serv_classification' => $data['soc_serv_classification'] ?? null,
                            'allergic_to' => $data['allergic_to'] ?? null,
                            'hospitalization_plan' => $data['hospitalization_plan'] ?? null,
                            'health_insurance_name' => $data['health_insurance_name'] ?? null,
                            'phic' => $data['phic'] ?? null,
                            'data_furnished_by' => $data['data_furnished_by'] ?? null,
                            'address_of_informant' => $data['address_of_informant'] ?? null,
                            'relation_to_patient' => $data['relation_to_patient'] ?? null,
                            'admission_diagnosis' => $data['admission_diagnosis'] ?? null,
                            'discharge_diagnosis' => $data['discharge_diagnosis'] ?? null,
                            'principal_opt_code' => $type === 'popt_proc' ? $data['code'] : null,
                            'principal_opt_desc' => $type === 'popt_proc' ? $data['description'] : null,
                            'other_opt_code' => $type === 'oopt_proc' ? $data['code'] : null,
                            'other_opt_desc' => $type === 'oopt_proc' ? $data['description'] : null,
                            'accident_injury_poison' => $data['accident_injury_poison'] ?? null,
                            'icd10_code' => $type === 'icd10_code' ? $data['code'] : null,
                            'icd10_desc' => $type === 'icd10_code' ? $data['description'] : null,
                            'disposition' => $data['disposition'] ?? null,

                            // clinical record
                            'cr_chief_complain' => $data['cr_chief_complain'] ?? null,
                            'cr_history_present_ill' => $data['cr_history_present_ill'] ?? null,
                            'cr_ob_history' => $data['cr_ob_history'] ?? null,
                            'cr_past_med_history' => $data['cr_past_med_history'] ?? null,
                            'cr_personal_soc_history' => $data['cr_personal_soc_history'] ?? null,
                            'cr_family_history' => $data['cr_family_history'] ?? null,
                            'cr_general_survey' => $data['cr_general_survey'] ?? null,

                            // vital sign
                            'vital_bp' => $data['vital_bp'] ?? null,
                            'vital_hr' => $data['vital_hr'] ?? null,
                            'vital_temp' => $data['vital_temp'] ?? null,
                            'vital_o2sat' => $data['vital_o2sat'] ?? null,
                            'vital_height' => $data['vital_height'] ?? null,
                            'vital_weight' => $data['vital_weight'] ?? null,
                            'vital_bmi' => $data['vital_bmi'] ?? null,
                        ]));
                    }

                    DB::transaction(function () use ($personalInformation, $patientInformation) {
                        $personalInformation->save();
                        $patientInformation->save();
                    });

                    break;

                case 'updateEyeCenterAppointment':
                    $eyeCenter = EyeCenter::find($id);
                    if($eyeCenter) {
                        $eyeCenter->patient_name = $data['patient_name'];
                        $eyeCenter->doctors_agenda = $data['doctors_agenda'];
                        $eyeCenter->appointment_date = $data['appointment_date'];
                        $eyeCenter->appointment_color = $data['appointment_color'];
                        $eyeCenter->save();
                    }
                    break;

                default:
                    # code...
                    break;
            }

            DB::commit();
            return response()->json([
                'status' => 'success'
            ], 200);
        } catch(\Exception $ex) {
            DB::rollBack();
            return response()->json(
                [
                    'message' => $ex->getMessage()
                ], 500
            );
        }
    }

    function insertMedicine($genericName, $brandName,  $dosage, $durationFrom, $durationTo, $amount, $quantity)
    {
        Medicine::create([
            'generic_name' => $genericName,
            'brand_name' => $brandName,
            'dosage' => $dosage,
            'duration_from' => $durationFrom,
            'duration_to' => $durationTo,
            'amount' => $amount,
            'quantity' => $quantity,
            'is_active' => true
        ]);
    }
    function insertPatientVitalSign($patientId, $nurseId, $bp, $hr, $temp, $o2sat, $height, $weight, $bmi) {
        PatientVital::create([
            'patient_id' => $patientId,
            'nurse_id' => $nurseId,
            'bp' => $bp,
            'hr' => $hr,
            'temp' => $temp,
            'o2_sat' => $o2sat,
            'height' => $height,
            'weight' => $weight,
            'bmi' => $bmi,
        ]);
    }

    function insertPatientIvFluid($patientId, $nurseId, $bottleId, $typeIv, $vol, $rof, $dStart, $dEnd, $nurseDuty, $remarks) {
        PatientIvfluid::create([
            'patient_id' => $patientId,
            'nurse_id' => $nurseId,
            'bottle_no' => $bottleId,
            'type_of_iv' => $typeIv,
            'volume' => $vol,
            'rate_of_flow' => $rof,
            'datetime_start' => $dStart,
            'datetime_end' => $dEnd,
            'nurse_on_duty' => $nurseDuty,
            'remarks' => $remarks
        ]);
    }

    function insertPatientNurseNote($patientId, $nurseId, $remarks) {
        PatientNurseNote::create([
            'patient_id' => $patientId,
            'nurse_id' => $nurseId,
            'remarks' => $remarks,
        ]);
    }

    private function insertPatientMedication($patientId, $physicianId, $medicineId,  $dosage, $form, $qty, $frequency, $sig) {
        PatientMedication::create([
            'patient_id' => $patientId,
            'physician_id' => $physicianId,
            'medicine_id' => $medicineId,
            'dosage' => $dosage,
            'form' => $form,
            'qty' => $qty,
            'frequency' => $frequency,
            'sig' => $sig,
            'status' => 'ps', //ps -> prescibe
        ]);
    }

    private function insertPatientTest($patientId, $physicianId, $testId, $labCategory, $charge) {
        PatientTest::create([
            'patient_id' => $patientId,
            'physician_id' => $physicianId,
            'test_id' => $testId,
            'lab_category' => $labCategory,
            // 'status',
            'charge' => $charge
        ]);
    }

    // private function insertIpd() {
    //     Patient::create([
    //         'patient_id' => $id,
    //         'patient_hrn' => $patientHrn,
    //         'admitting_physician' => $physicianId,
    //         'admitting_clerk' => $clerkId,
    //         'type_visit' => $patientType,
    //         'date_visit' => Carbon::now()
    //     ]);
    // }

    private function insertPatient($patientId, $patientHrn, $physicianId, $clerkId, $patientType, $bedId = null, $isApproved = "Pending") {
        Patient::create([
            'patient_id' => $patientId,
            'patient_hrn' => $patientHrn,
            'admitting_physician' => $physicianId,
            'admitting_clerk' => $clerkId,
            'type_visit' => $patientType,
            'date_visit' => Carbon::now(),
            'data_furnished_by' => Auth::user()->user_id,
            'bed_id' => $bedId,
            'is_approved' => $isApproved
        ]);
    }

    private function insertInformation($id, $last, $first, $middle, $birth, $age, $gender) {

        // new update
        PersonalInformation::create([
            'personal_id' => $id,
            'last_name' => $last,
            'first_name' => $first,
            'middle_name' => $middle,
            'birth_date' => $birth,
            'age' => $age,
            'gender' => $gender
        ]);
    }

    private function insertPatientBill($patientId, $physicianId, $charge) {
        PatientBilling::create([
            'patient_id' => $patientId,
            'physician_id' => $physicianId,
            'physician_charge' => $charge
        ]);
    }

    private function insertPharmacyCategory($pharmacyCategory) {
        PharmacyCategory::create([
            'category_name' => $pharmacyCategory,
        ]);
    }

    private function insertPharmacySupplier($pharmacySupplier) {
        PharmacySupplier::create([
            'supplier_name' => $pharmacySupplier,
        ]);
    }

    private function insertDoctorOrders($progressNotes){
        DoctorOrder::create([
            'progress_notes' => $progressNotes,
        ]);
    }

    private function insertOrderList($orderId, $patientId, $physicianId, $nurseIncharge, $name, $description) {
        OrderList::create([
            'order_id' => $orderId,
            'patient_id' => $patientId,
            'physician_id' => $physicianId,
            'nurse_incharge' => $nurseIncharge,
            'name' => $name,
            'description' => $description
        ]);
    }

    private function insertProgressNotes($orderId, $patientId, $physicianId, $progressNotes, $nurseId) {
        ProgressNotes::create([
            'order_id' => $orderId,
            'patient_id' => $patientId,
            'physician_id' => $physicianId,
            'progress_notes' => $progressNotes,
            'nurse_incharge' => $nurseId
        ]);
    }

    private function insertEyeCenterAppointment($patientName, $doctorsAgenda, $appointmentDate, $appointmentColor) {
        EyeCenter::create([
            'patient_name' => $patientName,
            'doctors_agenda' => $doctorsAgenda,
            'appointment_date' => $appointmentDate,
            'appointment_color' => $appointmentColor
        ]);
    }

    private function insertHealthMonitor($monitoringId, $patientId, $date, $hour, $respiratoryRate, $pulseRate, $temperature) {
        HealthMonitor::create([
            'health_monitor_id' => $monitoringId,
            'patient_id' => $patientId,
            'date' => Carbon::parse($date),
            'hour' => $hour,
            'respiratory_rate' => $respiratoryRate,
            'pulse_rate' => $pulseRate,
            'temperature' => $temperature
        ]);
    }
}