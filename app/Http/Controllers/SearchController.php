<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\GenericResource;
use App\Http\Resources\UserResource;
use App\Models\DohICD10;
use App\Models\DohSurgery;
use App\Models\User;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = $request->input('type');
        switch($type) {
            case 'icd10_code':
                return $this->searchForIcdCode($request);

            case 'popt_proc':
            case 'oopt_proc':
                return $this->searchForOptProcedure($request);
            default:
                return response()->json(['message' => 'Invalid Type Model'], 400);
        }
    }

    private function searchForIcdCode($request)
    {
        $keywords = strtolower($request->q);
        $data = DohICD10::where(function ($query) use ($keywords) {
            $query->whereRaw('LOWER(icd10_code) LIKE ?', ["%{$keywords}%"])
                    ->orWhereRaw('LOWER(icd10_desc) LIKE ?', ["%{$keywords}%"]);
        })->get();

        return response()->json($data, 200);
    }

    private function searchForOptProcedure($request)
    {
        $keywords = strtolower($request->q);
        $data = DohSurgery::where(function ($query) use($keywords) {
            $query->whereRaw('LOWER(proc_code) LIKE ?', ["%{$keywords}%"])
                    ->orWhereRaw('LOWER(proc_desc) LIKE ?', ["%{$keywords}%"]);
        })->get();
        
        return response()->json($data, 200);
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

    // public function waiting() {
    //     $search = User::search($request);

    //     if ($request->has('items')) {
    //         $perPage = $request->items;
    //         $userList = $search->paginate($perPage);
    //         $userListResource = GenericResource::collection($userList);
    //         $paginationData = [
    //             'currentPage' => $userList->currentPage(),
    //             'totalPages' => $userList->lastPage(),
    //             'perPage' => $userList->perPage(),
    //             'totalItems' => $userList->total(),
    //         ];

        
    //         // Add previous page link if available
    //         if ($userList->currentPage() > 1) {
    //             $prevPage = $userList->currentPage() - 1;
    //             $paginationData['prevPageUrl'] = $userList->url($prevPage);
    //         }

    //         // Add next page link if available
    //         if ($userList->hasMorePages()) {
    //             $nextPage = $userList->currentPage() + 1;
    //             $paginationData['nextPageUrl'] = $userList->url($nextPage);
    //         }

    //         $responseData = [
    //             'searchResults' => $userListResource,
    //             'pagination' => $paginationData,
    //         ];
    //     } else {
    //         $userList = $search->get();
    //         $userListResource = GenericResource::collection($userList);
    //         $responseData = [
    //             'userList' => $userListResource,
    //         ];
    //     }
        
    //     return response()->json($responseData, 200);
    // }
}
