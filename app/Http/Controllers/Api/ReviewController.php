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
        // Senior developer note: Standardizing on 'Review' model which maps to 'driver_reviews' table
        $reviews = Review::with(['driver', 'passenger'])->latest()->paginate($request->get('per_page', 10));

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

        $review = Review::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Review created successfully',
            'data' => $review
        ], 201);
    }

    /**
     * Delete review
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Review deleted successfully'
        ]);
    }
}
