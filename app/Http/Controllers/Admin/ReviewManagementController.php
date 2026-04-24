<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DriverReview;
use App\Models\Driver;
use Illuminate\Http\Request;

class ReviewManagementController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'drivers');
        
        if ($tab === 'drivers') {
            $drivers = Driver::all();
            $reviews = DriverReview::with('driver')->latest()->get();
            
            $totalReviews = $reviews->count();
            $averageRating = $totalReviews > 0 ? number_format($reviews->avg('rating'), 1) : 0;
            
            // Calculate rating distribution
            $ratingCounts = [
                5 => $reviews->where('rating', '>=', 4.5)->count(),
                4 => $reviews->where('rating', '>=', 3.5)->where('rating', '<', 4.5)->count(),
                3 => $reviews->where('rating', '>=', 2.5)->where('rating', '<', 3.5)->count(),
                2 => $reviews->where('rating', '>=', 1.5)->where('rating', '<', 2.5)->count(),
                1 => $reviews->where('rating', '<', 1.5)->count(),
            ];
            
            $ratingProgress = [];
            foreach ($ratingCounts as $stars => $count) {
                $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                $ratingProgress[$stars] = [
                    'label' => $stars . ' star',
                    'count' => $count,
                    'percentage' => $percentage
                ];
            }

            return view('admin.reviews.index', compact('tab', 'drivers', 'reviews', 'totalReviews', 'averageRating', 'ratingProgress'));
        }

        return view('admin.reviews.index', compact('tab'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'reviewer_name' => 'required|string|max:255',
            'rating' => 'required|numeric|min:1|max:5',
            'review_text' => 'required|string'
        ]);

        DriverReview::create([
            'driver_id' => $request->driver_id,
            'reviewer_name' => $request->reviewer_name,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
        ]);

        return redirect()->back()->with('success', 'Review added successfully!');
    }

    public function destroy($id)
    {
        $review = DriverReview::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully!');
    }
}
