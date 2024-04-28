<?php

namespace App\Http\Controllers\Setting;

use App\Models\BedList;
use App\Models\BedType;
use App\Models\BedFloor;
use App\Models\BedGroup;
use Illuminate\Http\Request;
use App\Services\PatientService;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Http\Resources\GenericResource;
use App\Http\Resources\GenericeResourceCollection;

class BedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tab = $request->input('tabs');

        switch($tab) {
            case 'tab5':
                return $this->fetchBedFloor($request);

            case 'tab4':
                return $this->fetchBedGroup($request);

            case 'tab3':
                return $this->fetchBedType($request);

            case 'tab2':
                return $this->fetchBedList($request);

            case 'bed-list':
                return BedList::hasBedList()->get();

            case 'floor':
                return BedFloor::all();

            case 'type':
                return BedType::all();

            case 'group':
                return BedGroup::hasBedFloor()->get();

            default:
                return response()->json(['message' => 'Invalid type'], 400);
        }
    }

    private function fetchBedFloor($request)
    {
        $query = BedFloor::query();
        // if($request->has('q')) {
        //     $query->where('name', 'ILIKE', "%$request->q%")
        //         ->orWhere('email', 'ILIKE', "%$request->q%")
        //         ->orWhere('user_id', 'ILIKE', "%$request->q%");
        // }

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $bed = $query->paginate($request->items);

            $data = new GenericeResourceCollection($bed);
            $data->setTableName('bed_floors');
            $data->setDisplayFields([
                'id',
                'floor',
                'description'
            ]);
        } else {
            $bed = $query->get();
            $data = GenericResource::collection($bed)->map(function ($item) use($request) {
                if($item) {
                    $resource = new GenericResource($item);
                    $resource->set24HourFormat(false);
                    // $resource->setAlwaysVisibleFields(['patient_id']);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    private function fetchBedGroup($request)
    {
        $query = BedGroup::hasBedFloor();
        // if($request->has('q')) {
        //     $query->where('name', 'ILIKE', "%$request->q%")
        //         ->orWhere('email', 'ILIKE', "%$request->q%")
        //         ->orWhere('user_id', 'ILIKE', "%$request->q%");
        // }

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $bed = $query->paginate($request->items);

            $data = new GenericeResourceCollection($bed);
            $data->setTableName('bed_groups');
            $data->setDisplayFields([
                'id',
                'name',
                'floor_id',
                'description'
            ]);
        } else {
            $bed = $query->get();
            $data = GenericResource::collection($bed)->map(function ($item) use($request) {
                if($item) {
                    $resource = new GenericResource($item);
                    $resource->set24HourFormat(false);
                    // $resource->setAlwaysVisibleFields(['patient_id']);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    private function fetchBedType($request)
    {
        $query = BedType::query();
        // if($request->has('q')) {
        //     $query->where('name', 'ILIKE', "%$request->q%")
        //         ->orWhere('email', 'ILIKE', "%$request->q%")
        //         ->orWhere('user_id', 'ILIKE', "%$request->q%");
        // }

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $bed = $query->paginate($request->items);

            $data = new GenericeResourceCollection($bed);
            $data->setTableName('bed_types');
            $data->setDisplayFields([
                'id',
                'name',
            ]);
        } else {
            $bed = $query->get();
            $data = GenericResource::collection($bed)->map(function ($item) use($request) {
                if($item) {
                    $resource = new GenericResource($item);
                    $resource->set24HourFormat(false);
                    // $resource->setAlwaysVisibleFields(['patient_id']);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    private function fetchBedList($request)
    {
        $query = BedList::hasBedList();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $bed = $query->paginate($request->items);

            $data = new GenericeResourceCollection($bed);
            $data->setTableName('bed_lists');
            $data->setDisplayFields([
                'name',
                'bed_type_id',
                'bed_group_id',
                'is_active'
            ]);
        } else {
            $bed = $query->get();
            $data = GenericResource::collection($bed)->map(function ($charge) use($request) {
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
