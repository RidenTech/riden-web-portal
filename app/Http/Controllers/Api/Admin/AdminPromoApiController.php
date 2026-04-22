<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPromoApiController extends Controller
{
    /**
     * List all promo codes
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'promo_codes' => []
            ]
        ]);
    }

    /**
     * Get promo detail
     */
    public function show($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $id,
                'code' => 'WELCOME50',
                'discount' => '50%',
                'status' => 'active'
            ]
        ]);
    }

    /**
     * Create Promo
     */
    public function store(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Promo code created successfully'
        ]);
    }
}
