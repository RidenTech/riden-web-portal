<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * List all reviews
     */
    public function index(Request $request)
    {
        $type = $request->get('type', 'driver'); // 'driver' or 'passenger'

        $reviews = Review::ofType($type)
            ->with(['driver', 'passenger'])
            ->latest()
            ->paginate($request->get('per_page', 10));

        return response()->json([
            'status' => 'success',
            'data' => $reviews
        ]);
    }

    /**
     * Store new review
     */
    public function store(Request $request)
    {
        $type = $request->get('type', 'driver');

        if ($type === 'passenger') {
            return $this->storePassenger($request);
        }

        $validator = Validator::make($request->all(), [
            'driver_id' => 'required|exists:drivers,id',
            'passenger_id' => 'nullable|exists:passengers,id',
            'reviewer_name' => 'nullable|string|max:255',
            'rating' => 'required|numeric|min:1|max:5',
            'review_text' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['review_type'] = 'driver';
        $review = Review::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Driver review created successfully',
            'data' => $review
        ], 201);
    }

    private function storePassenger(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'passenger_id' => 'required|exists:passengers,id',
            'driver_id' => 'nullable|exists:drivers,id',
            'reviewer_name' => 'nullable|string|max:255',
            'rating' => 'required|numeric|min:1|max:5',
            'review_text' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['review_type'] = 'passenger';
        $review = Review::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Passenger review created successfully',
            'data' => $review
        ], 201);
    }

    /**
     * Delete review
     */
    public function destroy(Request $request, $id)
    {
        // For security/clarity we could check the type but findOrFail is sufficient
        $review = Review::findOrFail($id);
        $type = $review->review_type;
        $review->delete();

        return response()->json([
            'status' => 'success',
            'message' => ucfirst($type) . ' review deleted successfully'
        ]);
    }
}
