<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = User::where('user_id', Auth::user()->user_id)->first();

        if($user) {
            $notifications = $user->notifications()->orderBy('created_at', 'desc')->get();

            $formattedNotif = $notifications->map(function ($notification) {
                $data = $notification->data;
                return [
                    'title' => $data['title'],
                    'action' => $data['action'],
                    'iconUrl' => $data['iconUrl'],
                    'message' => $data['message'],
                    'timestamp' => $data['timestamp'],
                    'isRead' => $notification->pivot->read_at != null
                ];
            });
    
            return response()->json([
                'notifications' => $formattedNotif
            ], 200);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }

        
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
