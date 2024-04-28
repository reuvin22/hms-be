<?php

namespace App\Http\Controllers;

use App\Models\EyeCenter;
use App\Services\PatientService;
use Illuminate\Http\Request;

class EyeCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $slug = $request->input('slug');
        switch($slug) {
            case 'eyecenter-appointment-list':
              return EyeCenter::all();
              break;
            default:
              break;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PatientService $service)
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
    public function destroy(string $id)
    {
        //
    }
}
