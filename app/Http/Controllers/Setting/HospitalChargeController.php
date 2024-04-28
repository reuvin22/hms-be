<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Models\HospitalCharge;
use App\Services\PatientService;
use App\Services\SettingService;
use App\Models\HospitalChargeType;
use App\Http\Controllers\Controller;
use App\Models\HospitalChargeCategory;
use App\Http\Resources\GenericResource;
use App\Models\HospitalPhysicianCharge;
use App\Http\Resources\GenericeResourceCollection;


class HospitalChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tab = $request->input('tabs');
        switch($tab) {
            case 'tab1':
                return $this->fetchCharges($request);

            case 'tab2':
                return $this->fetchChargeCategory($request);

            case 'tab3':
                return $this->fetchDoctorOPDCharge($request);

            case 'tab4':
                return $this->fetchDoctorEmergencyCharge($request);

            case 'tab5':
                return $this->fetchChargeType($request);

            case 'hosptl-charge':
                return HospitalCharge::charges()->get();

            case 'hosptl-charge-type':
                return HospitalChargeType::all();

            case 'hosptl-charge-category':
                return HospitalChargeCategory::all();

            // case :

            default:
        }
    }

    private function fetchCharges($request)
    {
        $query = HospitalCharge::charges();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $hospitalCharge = $query->paginate($request->items);

            $data = new GenericeResourceCollection($hospitalCharge);
            $data->setTableName('hospital_charges');
            $data->setDisplayFields([
                'id',
                'charge_category_id',
                'charge_type_id',
                'code'
            ]);
        } else {
            $hospitalCharge = $query->get();
            $data = GenericResource::collection($hospitalCharge)->map(function ($charge) use($request) {
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

    private function fetchChargeCategory($request)
    {
        $query = HospitalChargeCategory::hasChargeType();
        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $hospitalCharge = $query->paginate($request->items);

            $data = new GenericeResourceCollection($hospitalCharge);
            $data->setTableName('hospital_charge_categories');
            $data->setDisplayFields([
                'name',
                'description',
                'charge_type_id'
            ]);
        } else {
            $hospitalCharge = $query->get();
            $data = GenericResource::collection($hospitalCharge)->map(function ($charge) use($request) {
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

    private function fetchDoctorOPDCharge($request)
    {
        $query = HospitalPhysicianCharge::physicianOPDCharge();
        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $hospitalCharge = $query->paginate($request->items);

            $data = new GenericeResourceCollection($hospitalCharge);
            $data->setTableName('hospital_physician_charges');
            $data->setDisplayFields([
                'id',
                'doctor_id',
                'standard_charge',
            ]);
        } else {
            $hospitalCharge = $query->get();
            $data = GenericResource::collection($hospitalCharge)->map(function ($charge) use($request) {
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

    private function fetchDoctorEmergencyCharge($request)
    {
        $query = HospitalPhysicianCharge::physicianERCharge();
        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $hospitalCharge = $query->paginate($request->items);

            $data = new GenericeResourceCollection($hospitalCharge);
            $data->setTableName('hospital_physician_charges');
            $data->setDisplayFields([
                'id',
                'doctor_id',
                'standard_charge',
            ]);
        } else {
            $hospitalCharge = $query->get();
            $data = GenericResource::collection($hospitalCharge)->map(function ($charge) use($request) {
                if($charge) {
                    $resource = new GenericResource($charge);
                    $resource->set24HourFormat(false);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    private function fetchChargeType($request)
    {
        $query = HospitalChargeType::query();
        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $hospitalCharge = $query->paginate($request->items);

            $data = new GenericeResourceCollection($hospitalCharge);
            $data->setTableName('hospital_charge_types');
            $data->setDisplayFields([
                'id',
                'name'
            ]);
        } else {
            $hospitalCharge = $query->get();
            $data = GenericResource::collection($hospitalCharge)->map(function ($charge) use($request) {
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
    public function store(Request $request, SettingService $service)
    {
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
    public function update(Request $request, string $id, PatientService $service)
    {
        return $service->updateBulkAction($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
