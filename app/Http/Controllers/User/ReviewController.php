<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $newsId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        $news = News::findOrFail($newsId);

        // Create the review
        $review = new Review();
        $review->user_id = Auth::id(); // Assuming user is logged in
        $review->news_id = $news->id;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->save();

        return back()->with('success', 'Your review has been submitted!');
        // Route::post('/news/{newsId}/review', [ReviewController::class, 'store'])->name('review.store');
    }
}
