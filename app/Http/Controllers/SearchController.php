<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory; // Import your model here

class SearchController extends Controller
{
    // public function search(Request $request)
    // {
    //     // Validate search input
    //     $request->validate([
    //         'query' => 'required|string|max:255',
    //     ]);

    //     // Get the search query
    //     $query = $request->input('query');

    //     // Search logic (adjust this according to your model and fields)
    //     $results = SubCategory::where('name', 'LIKE', "%{$query}%")
    //                         ->orWhere('description', 'LIKE', "%{$query}%")
    //                         ->get();

    //     // Return the results as a JSON response
    //     return response()->json([
    //         'success' => true,
    //         'data' => $results
    //     ]);
    // }


    public function search(Request $request)
    {
        $query = $request->input('query');

        // Fetch the subcategories that match the query
        $subcategories = SubCategory::where('name', 'LIKE', "%{$query}%")
                        ->orWhereHas('categoryName', function ($q) use ($query) {
                            $q->where('name', 'LIKE', "%{$query}%");
                        })
                        ->with('categoryName') // Eager load category name
                        ->get();

        return response()->json([
            'success' => true,
            'data' => $subcategories
        ]);
    }


}
