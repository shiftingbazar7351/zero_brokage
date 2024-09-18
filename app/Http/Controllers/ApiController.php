<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Menu;
use App\Models\Review;
use App\Models\SubCategory;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

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


    public function subMenuList($id)
    {
        try {
            // Fetch the subcategory by ID
            $subcategory = SubCategory::select('id')->find($id);

            // Check if the subcategory exists
            if (!$subcategory) {
                return response()->json([
                    'success' => false,
                    'message' => 'Subcategory not found.',
                    'data' => null
                ]);
            }

            // Fetch the menus associated with the subcategory
            $menus = Menu::select('id', 'name', 'image', 'slug', 'subcategory_id')
                ->where('subcategory_id', $subcategory->id)
                ->where('status', 1)
                ->orderByDesc('created_at')
                ->get();

            // Fetch the submenus associated with the subcategory
            $submenus = SubMenu::join('menus', 'sub_menus.menu_id', '=', 'menus.id')
                ->where('sub_menus.subcategory_id', $subcategory->id)
                ->where('sub_menus.status', 1)
                ->orderByDesc('menus.created_at')
                ->select(
                    'sub_menus.id as submenu_id',
                    'sub_menus.id',
                    'sub_menus.name',
                    'sub_menus.image',
                    'sub_menus.slug',
                    'sub_menus.total_price',
                    'sub_menus.discounted_price',
                    'sub_menus.discount',
                    'sub_menus.subcategory_id',
                    'sub_menus.menu_id',
                    'sub_menus.city_id',
                    'sub_menus.description',
                    'sub_menus.details'
                )
                ->paginate(10);

            // Fetch the cities
            $cities = City::paginate(10);

            return response()->json([
                'success' => true,
                'message' => 'Subcategory details retrieved successfully.',
                'data' => [
                    'subcategory' => $subcategory,
                    'menus' => $menus,
                    'submenus' => [
                        'pagination' => [
                            'total' => $submenus->total(),
                            'per_page' => $submenus->perPage(),
                            'current_page' => $submenus->currentPage(),
                            'last_page' => $submenus->lastPage(),
                            'next_page_url' => $submenus->nextPageUrl(),
                            'prev_page_url' => $submenus->previousPageUrl(),
                        ],
                        'submenu_data' => $submenus->items() // Submenu data
                    ],
                    'cities' => [
                        'pagination' => [
                            'total' => $cities->total(),
                            'per_page' => $cities->perPage(),
                            'current_page' => $cities->currentPage(),
                            'last_page' => $cities->lastPage(),
                            'next_page_url' => $cities->nextPageUrl(),
                            'prev_page_url' => $cities->previousPageUrl(),
                        ],
                        'cities_data' => $cities->items() // Cities data
                    ]
                ]
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error retrieving subcategory details: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving subcategory details.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function menuList($id)
    {
        try {
            $menus = Menu::select('id', 'name', 'subcategory_id', 'image')
        ->where('subcategory_id', $id)
        ->where('status', 1)
        ->get()
        ->map(function ($menu) {
            // Include the image URL as icon in the response
            $menu->icon = $menu->icon_url; // This will call the accessor for the image URL and map it to 'icon'
            unset($menu->image); // Optionally remove the 'image' field if you don't want it in the response
            return $menu;
        });

            // Check if menus are found
            if ($menus->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No menus found.',
                    'data' => []
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'message' => 'menus retrieved successfully.',
                'data' => $menus
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error retrieving menus: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving menus.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function reviews()
    {
        try {
            $reviews = Review::where('status', 1)
                ->orderByDesc('created_at')
                ->get(['id', 'name', 'description', 'profession']);

            // Check if reviews are found
            if ($reviews->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No reviews found.',
                    'data' => []
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'message' => 'Reviews retrieved successfully.',
                'data' => $reviews
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error retrieving reviews: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving reviews.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
