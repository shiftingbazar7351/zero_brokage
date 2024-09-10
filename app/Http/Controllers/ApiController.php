<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    public function categoryList()
    {
        try {
            $subcategories = Subcategory::select('id', 'name', 'slug', 'icon', 'background_image', 'featured', 'trending')
                ->where('status', 1)
                ->get()
                ->map(function ($subcategory) {
                    // Include the URLs in the response
                    $subcategory->icon = $subcategory->icon_url; // This will call the accessor for the URL
                    $subcategory->background_image = $subcategory->background_image_url; // This will call the accessor for the URL
                    return $subcategory;
                });

            // Check if subcategories are found
            if ($subcategories->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No subcategories found.',
                    'data' => []
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'message' => 'Subcategories retrieved successfully.',
                'data' => $subcategories
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error retrieving subcategories: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving subcategories.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
