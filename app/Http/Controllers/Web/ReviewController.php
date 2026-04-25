<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\PassengerReview;
use App\Models\Driver;
use App\Models\Passenger;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'drivers');
        
        if ($tab === 'drivers') {
            $drivers = Driver::all();
            $reviews = Review::with('driver')->latest()->get();
            
            $totalReviews = $reviews->count();
            $averageRating = $totalReviews > 0 ? number_format($reviews->avg('rating'), 1) : 0;
            
            $ratingProgress = $this->calculateRatingProgress($reviews, $totalReviews);

            return view('admin.reviews.index', compact('tab', 'drivers', 'reviews', 'totalReviews', 'averageRating', 'ratingProgress'));
        } else {
            $passengers = Passenger::all();
            $reviews = PassengerReview::with('passenger')->latest()->get();
            
            $totalReviews = $reviews->count();
            $averageRating = $totalReviews > 0 ? number_format($reviews->avg('rating'), 1) : 0;
            
            $ratingProgress = $this->calculateRatingProgress($reviews, $totalReviews);

            return view('admin.reviews.index', compact('tab', 'passengers', 'reviews', 'totalReviews', 'averageRating', 'ratingProgress'));
        }
    }

    private function calculateRatingProgress($reviews, $totalReviews)
    {
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
        return $ratingProgress;
    }

    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'reviewer_name' => 'required|string|max:255',
            'rating' => 'required|numeric|min:1|max:5',
            'review_text' => 'required|string'
        ]);

        $review = Review::create([
            'driver_id' => $request->driver_id,
            'reviewer_name' => $request->reviewer_name,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
        ]);

        return redirect()->route('admin.reviews.ratings')->with('status', 'Review added successfully!');
    }

    public function storePassenger(Request $request)
    {
        $request->validate([
            'passenger_id' => 'required|exists:passengers,id',
            'reviewer_name' => 'required|string|max:255',
            'rating' => 'required|numeric|min:1|max:5',
            'review_text' => 'required|string'
        ]);

        PassengerReview::create([
            'passenger_id' => $request->passenger_id,
            'reviewer_name' => $request->reviewer_name,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
        ]);

        return redirect()->route('admin.reviews.ratings', ['tab' => 'passengers'])->with('status', 'Passenger review added successfully!');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.reviews.ratings', ['tab' => 'drivers'])->with('status', 'Driver review deleted successfully!');
    }

    public function destroyPassenger($id)
    {
        $review = PassengerReview::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.reviews.ratings', ['tab' => 'passengers'])->with('status', 'Passenger review deleted successfully!');
    }
}

