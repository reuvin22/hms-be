<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Models\Grant;
use Illuminate\Http\Request;
use App\Services\SettingService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SettingService $service)
    {  
        return $service->grantModules($request);
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

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                return response()->json(['message' => 'Incorrect credentials'], 401); // Unauthorized
            }

            // $icdToken = $service->ICDToken();
            
            $user = User::where('email', $request->email)->first();
            return response()->json([
                'token' => $user->createToken('api-token')->plainTextToken,
                'session' => session('selected_database')
                // 'icd_token' => $icdToken
            ], 200);

        } catch(Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500); 
        }
    }
    
    public function user(Request $request) {
        // $user = User::where('email',Auth::user()->email)->first();
        // $user = User::userDetails($request)->get();
        // return response()->json([
        //         'data' => $user
        //     ], 200
        // );
        return User::personalInformation()->first();
    }
    
    public function logout(Request $request) {
        Auth::user()->tokens()->delete();
        
        if ($request->hasSession()) {
            $request->session()->forget('selected_database');
            $request->session()->flush();
        }

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
