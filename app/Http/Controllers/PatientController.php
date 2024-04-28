<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use App\Models\Symptom;
use App\Models\DohICD10;
use App\Models\Identity;
use App\Models\Medicine;
use App\Models\OrderList;
use App\Models\Pathology;
use App\Models\Radiology;
use App\Models\PatientOPD;
use App\Models\DoctorOrder;
use App\Models\DohPosition;
use App\Models\MedicineForm;
use App\Models\PatientVital;
use Illuminate\Http\Request;
use App\Models\HealthMonitor;
use App\Models\ProgressNotes;
use App\Models\PatientIvfluid;
use App\Models\ApprovalHistory;
use App\Models\PatientApproval;
use App\Models\PatientImgResult;
use App\Models\PatientLabResult;
use App\Models\PatientNurseNote;
use App\Models\PharmacyCategory;
use App\Models\PharmacySupplier;
use App\Services\PatientService;
use App\Models\MedicineFrequency;
use App\Models\PathologyCategory;
use App\Models\PatientMedication;
use App\Models\RadiologyCategory;
use App\Models\PathologyParameter;
use App\Models\PersonalInformation;
use App\Http\Resources\GenericResource;
use App\Models\HospitalPhysicianCharge;
use App\Http\Resources\GenericeResourceCollection;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $slug = $request->input('slug');
        switch($slug) {
            case 'all-personal-information':
                return PersonalInformation::all();

            case 'all-symptoms':
                return Symptom::all();

            case 'doctor-order':
                return $this->fetchDoctorOrders($request);

            case 'symptoms':
                return $this->fetchAllSymptoms($request);

            case 'designation':
                return DohPosition::all();

            case 'detail-information':
                return Patient::detailInformationById($request)->first();

            case 'nurse-note':
                return $this->fetchNurseNote($request);

            case 'medicine-filter':
                return $this->fetchMedicine($request);

            case 'medicine':
                // return Medicine::all();
                return $this->fetchAllMedicine();

            case 'pharmacy-category':
                return $this->fetchAllPharmacyCategory($request);

            case 'pharmacy-supplier':
                return $this->fetchAllPharmacySupplier($request);

            case 'imaging':
                return PatientImgResult::hasInformation($request)->get;

            case 'imaging-result-list':
                return $this->fetchAllImagingResult($request);

            case 'laboratory':
                return PatientLabResult::hasInformation($request)->get();

            case 'medication':
                return PatientMedication::hasMedicine($request)->get();

            case 'emergency-room':
                return $this->fetchPatient($request);

            case 'out-patient':
                return $this->fetchOutPatient($request);

            case 'in-patient':
                return $this->fetchInPatient($request);

            case 'patient-approval':
                return $this->fetchPatientApproval($request);
                // return PatientApproval::hasApprove()->get();

            case 'physician':
                return $this->fetchPhysician($request);

            case 'physician-charge':
                return HospitalPhysicianCharge::all();

            case 'pathology':
                return Pathology::hasCategory()->get();

            case 'pathology-category-list':
                return PathologyCategory::all();

            case 'pathology-category':
                return $this->fetchPathologyCategory($request);

            case 'pathology-list':
                return $this->fetchPathology($request);

            case 'pathology-parameter':
                return PathologyParameter::all();

            case 'pathology-parameter-list':
                return $this->fetchPathologyParameter($request);

            case 'radiology':
                return Radiology::hasCategory()->get();

            case 'radiology-category':
                return RadiologyCategory::all();

            case 'radiology-category-list':
                return $this->fetchRadiologyCategory($request);

            case 'radiology-list':
                return $this->fetchRadiology($request);

            case 'icd10':
                return DohICD10::all();

            case 'total-patient':
                return PatientApproval::where('is_approved', "Pending")->count();

            case 'doctor-order-list':
                return $this->fetchDoctorOrderList($request);

            case 'progress-notes-list':
                return $this->fetchDoctorOrderList($request);

            case 'health-monitor':
                return HealthMonitor::all();

            case 'health-monitor-by-id':
                return $this->fetchHealthMonitor($request);

            default:
                return response()->json(['message' => 'Invalid Slug'], 400);
        }
    }

    private function fetchDoctorOrders() {
        return DoctorOrder::orderByCreatedAt()->hasScope();
    }

    function fetchDoctorOrderList($request)
    {
         DoctorOrder::where('patient_id', $request->patient_id);
    }

    function fetchHealthMonitor($request)
    {
         HealthMonitor::where('health_monitor_id', $request->id);
    }

    function fetchProgressNotes($request)
    {
        return ProgressNotes::where('patient_id', $request->patient_id);
    }

    function fetchAllMedicine()
    {
        $data = [
            'medicines' => Medicine::all(),
            'medForm' => MedicineForm::all(),
            'medFrequency' => MedicineFrequency::all(),
        ];

        return response()->json($data,200);
    }

    private function fetchNurseNote($request) {
        $data = [
            'nurse_notes' => PatientNurseNote::where('patient_id', $request->patient_id)->get(),
            'vitals' => PatientVital::where('patient_id', $request->patient_id)->get(),
            'ivfluids' => PatientIvfluid::where('patient_id', $request->patient_id)->get()
        ];

        return response()->json($data, 200);
    }

    function fetchMedicine($request) {
        switch($request->tabs) {
            case 'tab1':
                $query = Medicine::query();
                break;

            case 'tab2':
                $query = MedicineForm::query();
                break;

            case 'tab3':
                $query = MedicineFrequency::query();
                break;

            default:
                return response()->json(['message' => 'Invalid Slug'], 400);
        }

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $medicineList = $query->paginate($request->items);

            $data = new GenericeResourceCollection($medicineList);
            if($request->tabs === 'tab1') {
                $data->setTableName('medicines');
                $data->setDisplayFields([
                    'quantity',
                    'duration_from',
                    'duration_to',
                    'amount',
                    'brand_name',
                    'generic_name',
                    'dosage',
                    'created_at',
                    'frequency'
                ]);
            } else if($request->tabs === 'tab2') {
                $data->setTableName('medicine_forms');
                $data->setDisplayFields([
                    'name',
                    'created_at',
                ]);
            } else if($request->tabs === 'tab3') {
                $data->setTableName('medicine_frequencies');
                $data->setDisplayFields([
                    'name',
                    'created_at',
                ]);
            }
            $data->set24HourFormat(false);
        } else {
            $medicineList = $query->get();
            $data = GenericResource::collection($medicineList)->map(function ($patient) use($request) {
                if($patient) {
                    $resource = new GenericResource($patient);
                    $resource->set24HourFormat(false);
                    return $resource->toArray($request);
                }
                return [];
            });
        }
        return response()->json($data, 200);
    }

    function fetchPatient($request) {
        $query = Patient::detailInformation();
        switch($request->slug) {
            case 'out-patient':
                $query->where('type_visit', '=', 'new_opd')->orWhere('type_visit', '=', 'revisit_opd');
                break;
            case 'in-patient':
                $query->where('type_visit', '=', 'former_opd')->orWhere('type_visit', '=', 'new_ipd');
                break;
            case 'emergency-room':
                $query->where('type_visit', '=', 'new_er');
                break;
            default:
                return null;
        }

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $patientList = $query->paginate($request->items);

            $data = new GenericeResourceCollection($patientList);
            $data->setTableName('patients');
            if($request->slug === 'out-patient') {
                $data->setDisplayFields([
                    'id',
                    'admitting_physician',
                    'patient_id',
                    'created_at',
                ]);
            } else if($request->slug === 'in-patient') {
                $data->setDisplayFields([
                    'id',
                    'admitting_physician',
                    'bed_id',
                    'patient_id',
                    'created_at',
                ]);
            } else if($request->slug === 'emergency-room') {
                $data->setDisplayFields([
                    'id',
                    'admitting_physician',
                    'bed_id',
                    'patient_id',
                    'chief_complain',
                    'created_at',
                ]);
            }
            $data->set24HourFormat(true);
        } else {
            $patientList = $query->get();
            $data = GenericResource::collection($patientList)->map(function ($patient) use($request) {
                if($patient) {
                    $resource = new GenericResource($patient);
                    $resource->set24HourFormat(true);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    private function fetchAllSymptoms($request) {
        $query = Symptom::query();
        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $symptomsList = $query->paginate($request->items);

            $data = new GenericeResourceCollection($symptomsList);
            $data->setTableName('symptoms');
            $data->setDisplayFields([
                'name',
                'code'
            ]);
            $data->set24HourFormat(false);
        } else {
            $symptomsList = $query->get();
            $data = GenericResource::collection($symptomsList)->map(function ($patient) use($request) {
                if($patient) {
                    $resource = new GenericResource($patient);
                    $resource->set24HourFormat(false);
                    return $resource->toArray($request);
                }
                return [];
            });
        }
        return response()->json($data, 200);
    }

    private function fetchOutPatient($request) {
        $query = Patient::detailInformation();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if($request->has('slug') && $request->slug === 'out-patient') {
            $query->where('type_visit', '=', 'new_opd')
                  ->orWhere('type_visit', '=', 'revisit_opd')
                  ->whereIn('is_approved', ["Approved", "Pending"]);
        }

        if ($request->has('items')) {
            $patientList = $query->paginate($request->items);

            $data = new GenericeResourceCollection($patientList);
            $data->setTableName('patients');
            $data->setDisplayFields([
                'id',
                'admitting_physician',
                'bed_id',
                'patient_id',
                'created_at',
            ]);
            $data->set24HourFormat(true);
        } else {
            $patientList = $query->get();
            $data = GenericResource::collection($patientList)->map(function ($patient) use($request) {
                if($patient) {
                    $resource = new GenericResource($patient);
                    $resource->set24HourFormat(true);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    public function fetchInPatient($request) {
        $query = Patient::detailInformation();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('slug') && $request->slug === 'in-patient') {
            $query->where('type_visit', '=', 'former_opd')
                  ->orWhere('type_visit', '=', 'new_ipd')
                  ->orWhere('type_visit', '=', 'revisit_ipd')
                  ->whereIn('is_approved', ["Approved", "Pending"]);
        }

        if ($request->has('items')) {
            $patientList = $query->paginate($request->items);

            $data = new GenericeResourceCollection($patientList);
            $data->setTableName('patients');
            $data->setDisplayFields([
                'id',
                'admitting_physician',
                'bed_id',
                'patient_id',
                'created_at',
            ]);
            $data->set24HourFormat(true);
        } else {
            $patientList = $query->get();
            $data = GenericResource::collection($patientList)->map(function ($patient) use($request) {
                if ($patient) {
                    $resource = new GenericResource($patient);
                    $resource->set24HourFormat(true);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    private function fetchPhysician($request) {
        $data = User::userByRoles($request)->get();
        return response()->json($data, 200);
    }

    private function fetchPathology($request)
    {
        $query = Pathology::hasCategory();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $pathology = $query->paginate($request->items);

            $data = new GenericeResourceCollection($pathology);
            $data->setTableName('pathologies');
            $data->setDisplayFields([
                'test_name',
                'short_name',
                'patho_param_id',
                'patho_category_id',
                'unit',
                'sub_category',
                'report_days',
                'methods',
                'charge'
            ]);
        } else {
            $pathology = $query->get();
            $data = GenericResource::collection($pathology)->map(function ($charge) use($request) {
                if($charge) {
                    $resource = new GenericResource($charge);
                    $resource->set24HourFormat(false);
                    // $resource->setAlwaysVisibleFields(['patient_id']);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    private function fetchPathologyCategory($request)
    {
        $query = PathologyCategory::query();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        $data = [];

        if ($request->has('items')) {
            $pathology = $query->paginate($request->items);

            $data = new GenericeResourceCollection($pathology);
            $data->setTableName('pathology_categories');
            $data->setDisplayFields([
                'category_name',
                'description'
            ]);
        }else {
            $pathology = $query->get();
            $data = GenericResource::collection($pathology)->map(function ($charge) use($request) {
                if($charge) {
                    $resource = new GenericResource($charge);
                    $resource->set24HourFormat(false);
                    // $resource->setAlwaysVisibleFields(['patient_id']);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    private function fetchPathologyParameter($request)
    {
        $query = PathologyParameter::query();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        $data = [];

        if ($request->has('items')) {
            $parameter = $query->paginate($request->items);

            $data = new GenericeResourceCollection($parameter);
            $data->setTableName('pathology_parameters');
            $data->setDisplayFields([
                'param_name',
                'test_value',
                'ref_range',
                'unit',
                'description'
            ]);
        }else {
            $parameter = $query->get();
            $data = GenericResource::collection($parameter)->map(function ($charge) use($request) {
                if($charge) {
                    $resource = new GenericResource($charge);
                    $resource->set24HourFormat(false);
                    // $resource->setAlwaysVisibleFields(['patient_id']);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    private function fetchRadiology($request)
    {
        $query = Radiology::hasCategory();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $radiology = $query->paginate($request->items);

            $data = new GenericeResourceCollection($radiology);
            $data->setTableName('radiologies');
            $data->setDisplayFields([
                'test_name',
                'test_type',
                'radio_cat_id',
                'charge'
            ]);
        } else {
            $radiology = $query->get();
            $data = GenericResource::collection($radiology)->map(function ($charge) use($request) {
                if($charge) {
                    $resource = new GenericResource($charge);
                    $resource->set24HourFormat(false);
                    // $resource->setAlwaysVisibleFields(['patient_id']);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    private function fetchRadiologyCategory($request){
        $query = RadiologyCategory::query();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $radiology = $query->paginate($request->items);

            $data = new GenericeResourceCollection($radiology);
            $data->setTableName('radiology_categories');
            $data->setDisplayFields([
                'category_name',
                'description'
            ]);
        } else {
            $radiology = $query->get();
            $data = GenericResource::collection($radiology)->map(function ($charge) use($request) {
                if($charge) {
                    $resource = new GenericResource($charge);
                    $resource->set24HourFormat(false);
                    // $resource->setAlwaysVisibleFields(['patient_id']);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    private function fetchAllImagingResult($request)
    {
        $query = PatientImgResult::query();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $imaging = $query->paginate($request->items);

            $data = new GenericeResourceCollection($imaging);
            $data->setTableName('patient_img_results');
            $data->setDisplayFields([
                'patient_id',
                'physician_id',
                'test_name',
                'imaging_src',
                'comparison',
                'indication',
                'findings',
                'impressions'
            ]);
        } else {
            $imaging = $query->get();
            $data = GenericResource::collection($imaging)->map(function ($charge) use($request) {
                if($charge) {
                    $resource = new GenericResource($charge);
                    $resource->set24HourFormat(false);
                    // $resource->setAlwaysVisibleFields(['patient_id']);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    private function fetchPatientApproval($request){
        $query = PatientApproval::hasApprove();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $approval = $query->paginate($request->items);

            $data = new GenericeResourceCollection($approval);
            $data->setTableName('patient_approvals');
            $data->setDisplayFields([
                'admitting_clerk',
                'admitting_physician',
                'patient_id',
                'status',
                'type_approval',
                'is_approved'
            ]);
        } else {
            $approval = $query->get();
            $data = GenericResource::collection($approval)->map(function ($charge) use($request) {
                if($charge) {
                    $resource = new GenericResource($charge);
                    $resource->set24HourFormat(false);
                    // $resource->setAlwaysVisibleFields(['patient_id']);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }
    private function fetchAllPharmacyCategory($request){
        $query = PharmacyCategory::query();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $approval = $query->paginate($request->items);

            $data = new GenericeResourceCollection($approval);
            $data->setTableName('pharmacy_categories');
            $data->setDisplayFields([
                'category_name'
            ]);
        } else {
            $approval = $query->get();
            $data = GenericResource::collection($approval)->map(function ($charge) use($request) {
                if($charge) {
                    $resource = new GenericResource($charge);
                    $resource->set24HourFormat(false);
                    // $resource->setAlwaysVisibleFields(['patient_id']);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    private function fetchAllPharmacySupplier($request){
        $query = PharmacySupplier::query();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $approval = $query->paginate($request->items);

            $data = new GenericeResourceCollection($approval);
            $data->setTableName('pharmacy_suppliers');
            $data->setDisplayFields([
                'supplier_name'
            ]);
        } else {
            $approval = $query->get();
            $data = GenericResource::collection($approval)->map(function ($charge) use($request) {
                if($charge) {
                    $resource = new GenericResource($charge);
                    $resource->set24HourFormat(false);
                    // $resource->setAlwaysVisibleFields(['patient_id']);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PatientService $service) {
        return $service->createBulkAction($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, PatientService $service)
    {
        return $service->updateBulkAction($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $actionType = $request->input('actionType');
        switch($actionType) {
            case 'deleteDoctorOrderById':
                $item = DoctorOrder::find($id);
                $item->delete();
                break;

            case 'deleteApprovedPatient':
                $approved = PatientApproval::find($id);
                $approved->delete();
                break;

            case 'deletePatientMedicationById':
                $item = PatientMedication::find($id);
                $item->delete();
                break;

            case 'deleteHealthMonitorById':
                $items = HealthMonitor::where('health_monitor_id', $id)->get();
                foreach ($items as $item) {
                    $item->delete();
                }
                break;

            default:
                return null;

        }

        return response()->json(['success' => true], 200);
    }
}