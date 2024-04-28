<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Resources\GenericResource;
use App\Services\SettingService;
use Illuminate\Http\Request;
use App\Helpers\CustomPagination;
use App\Http\Resources\GenericeResourceCollection;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if($request->has('q')) {
            $query->where('name', 'ILIKE', "%$request->q%")
                ->orWhere('email', 'ILIKE', "%$request->q%")
                ->orWhere('user_id', 'ILIKE', "%$request->q%");
        }

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $userList = $query->paginate($request->items);

            $data = new GenericeResourceCollection($userList);
            $data->setTableName('users');
            $data->setDisplayFields([
                'user_id',
                'name',
                'email',
                'roles',
            ]);
        } else {
            $userList = $query->get();
            $data = GenericResource::collection($userList)->map(function ($user) use($request) {
                if($user) {
                    $resource = new GenericResource($user);
                    $resource->set24HourFormat(false);
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
        return $service->createBulkUser($request);
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

    public function getById(Request $request)
    {
        $user_id = User::userDetailById($request)->get();
        return response()->json(['user' => $user_id], 200);
    }
}
