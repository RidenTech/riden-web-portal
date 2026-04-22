<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSupportApiController extends Controller
{
    /**
     * List all support tickets
     */
    public function index()
    {
        // Senior developer note: If model doesn't exist yet, return structured empty data 
        // to help the React developer build the UI.
        return response()->json([
            'status' => 'success',
            'data' => [
                'tickets' => [],
                'counts' => [
                    'open' => 0,
                    'closed' => 0,
                    'pending' => 0
                ]
            ]
        ]);
    }

    /**
     * Get ticket detail
     */
    public function show($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $id,
                'subject' => 'Issue with booking',
                'messages' => []
            ]
        ]);
    }

    /**
     * Reply to ticket
     */
    public function reply(Request $request, $id)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Reply sent successfully'
        ]);
    }
}
