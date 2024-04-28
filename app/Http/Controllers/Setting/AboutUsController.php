<?php

namespace App\Http\Controllers\Setting;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Services\PatientService;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Http\Resources\GenericResource;
use App\Http\Resources\GenericeResourceCollection;
use App\Models\PatientApproval;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $slug = $request->input('slug');
        switch($slug) {
            case 'get-about-us-list':
                return $this->fetchAboutUs($request);
            break;
            case 'get-about-us-info':
                return AboutUs::all();

            default:
            break;
        }
    }

        private function fetchAboutUs($request)
        {
            $query = AboutUs::query();

            if ($request->has('sort') && $request->sort === 'created_at') {
                $query->orderBy('created_at', 'desc');
            }

            if ($request->has('items')) {
                $aboutUs = $query->paginate($request->items);

                $data = new GenericeResourceCollection($aboutUs);
                $data->setTableName('about_us');
                $data->setDisplayFields([
                    'hci_name',
                    'accreditation_no',
                    'province_name',
                    'municipality_name',
                    'city_name',
                    'barangay_name',
                    'street',
                    'subdivision_village',
                    'building_no',
                    'blk',
                    'postal_code'
                ]);
            } else {
                $aboutUs = $query->get();
                $data = GenericResource::collection($aboutUs)->map(function ($charge) use($request) {
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
            case 'deletePatientApproval':
                $item = PatientApproval::find($id);
                $item->delete();
                break;

            default:
                return null;

        }

        return response()->json(['success' => true], 200);
    }
}
