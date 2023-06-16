<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewsResource;
use App\Models\reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{

        public function __construct() {
        $this->middleware('auth:sanctum');
        $this->middleware('PemilikReview')->only('update','delete');
    }

        public function store(Request $request) {

        $request['user_id'] = auth()->id();

        $validated = $request->validate([
            'user_id' => 'required',
            'product_id' => 'required|exists:products,id',
            'review_content' => 'required',
        ]);

        $review = reviews::create($request->all());

        return new ReviewsResource($review);
    }


    public function update(Request $request, $id) {

        $request->validate([
            'review_content' => 'required'
        ]);

        $review = reviews::findOrFail($id);
        $review->update($request->all());

        return new ReviewsResource($review);

    }

    public function delete($id) {

        $review = reviews::findOrFail($id);
        $review->delete();

        return response()->json(['Review anda sudah di hapus']);

    }

}
