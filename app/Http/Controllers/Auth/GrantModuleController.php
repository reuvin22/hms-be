<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Grant;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrantModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('auth_id')) {
            $identityId = Auth::user()->user_id;  
        } else {
            $identityId = $request->user_id; 
        }

        $modules = Module::orderBy('sort', 'asc')->get();
        $userGrants = Grant::where('identity_id', $identityId)
                            ->pluck('permission_id')
                            ->toArray();

        $modules = $modules->map(function($module) use ($userGrants) {
            $module->isToggled = in_array($module->module_id, $userGrants);
            return $module;
        });

        $filteredModules = [];
        foreach($modules as $module) {
            if(!isset($filteredModules[$module->module_id])) {
                $filteredModules[$module->module_id] = $module;
            }
        }

        return response()->json([
            'module' => array_values($filteredModules)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
