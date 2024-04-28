<?php

namespace App\Http\Controllers\Setting;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Http\Resources\GenericResource;
use App\Http\Resources\GenericeResourceCollection;

class SystemConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tab = $request->input('tabs');

        switch($tab) {
            case 'tab6':
                return $this->fetchModuleList($request);

            case 'module':
                return $this->Module::all();

            default:
                return response()->json(['message' => 'Invalid type'], 400);
        }
    }

    private function fetchModuleList($request)
    {
        $query = Module::query();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $module = $query->paginate($request->items);

            $data = new GenericeResourceCollection($module);
            $data->setTableName('modules');
            $data->setDisplayFields([
                'module_id',
                'type',
                'name',
                'menu_group',
                'sort',
                'icon',
                'description'
            ]);
        } else {
            $module = $query->get();
            $data = GenericResource::collection($module)->map(function ($item) use($request) {
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
