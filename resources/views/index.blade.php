<?php
use App\Models\Review;

$walkers = User::where('role', 'provider')->get();

// attach rating
foreach ($walkers as $walker) {
    $reviews = Review::where('provider_id', $walker->id)->get();

    $walker->average_rating = $reviews->count() > 0 
        ? round($reviews->avg('rating'), 1) 
        : 0;

    $walker->total_reviews = $reviews->count();
}