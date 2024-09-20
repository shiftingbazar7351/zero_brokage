<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $query = Review::query();
        // Filter based on search query
        if ($request->has('search')) {
            $searchTerm = $request->search;

            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%')
                    ->orWhere('profession', 'like', '%' . $searchTerm . '%')
                    ->orWhere('created_at', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('createdBy', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%'); // assuming 'name' is a column in 'createdBy' relationship
                    });
            })->orderByDesc('created_at');
        }

        // Paginate the users (adjust pagination number as needed)
        $reviews = $query->orderByDesc('created_at')->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('backend.review.partials.review-index', compact('reviews'))->render();
        }
        return view('backend.review.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        // return view('backend.review.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'profession' => 'required',
        ]);

        $review = new Review($request->all());
        $review->created_by = auth()->id();
        $review->save();
        return redirect()->back()->with(['message' => 'Added Successfully', 'alert-type' => 'success']);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return response()->json($review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'profession' => 'required',
        ]);

        $review = Review::findOrFail($id);

        // Update the FAQ with the new data
        $review->update($request->only(['name', 'description', 'profession']));

        // Redirect back with a success message
        return redirect()->back()->with(['message' => 'Updated Successfully', 'alert-type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->back()->with(['message' => 'Deleted Successfully', 'alert-type' => 'success']);
    }

    public function reviewStatus(Request $request)
    {
        $item = Review::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }
}
