<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Enquiry;
use App\Models\Faq;
use App\Models\Menu;
use App\Models\Review;
use App\Models\SubCategory;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function categoryList()
    {

        return response()->json([
            'success' => true,
            'message' => 'No subcategories found.',
            'data' => []
        ]);

        try {
            $subcategories = Subcategory::select('id', 'name', 'slug', 'icon', 'background_image', 'featured', 'trending')
                ->where('status', 1)
                ->orderByDesc('created_at')
                ->get()
                ->map(function ($subcategory) {
                    // Include the URLs in the response
                    $subcategory->icon = $subcategory->icon_url; // This will call the accessor for the URL
                    $subcategory->background_image = $subcategory->background_image_url; // This will call the accessor for the URL
                    return $subcategory;
                });

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
            $subcategory = SubCategory::select('id')->orderByDesc('created_at')->find($id);

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


    public function subMenu($id)
    {
        try {
            // Fetch the menu by ID
            $menu = Menu::select('id', 'name', 'image', 'slug', 'subcategory_id')
                ->where('id', $id)
                ->where('status', 1)
                ->orderByDesc('created_at')
                ->first();

            // Check if the menu exists
            if (!$menu) {
                return response()->json([
                    'success' => false,
                    'message' => 'Menu not found.',
                    'data' => null
                ]);
            }

            // Fetch the submenus associated with the menu without pagination
            $submenus = SubMenu::where('menu_id', $menu->id)
                ->where('status', 1)
                ->orderByDesc('created_at')
                ->select('id', 'name', 'image', 'total_price', 'discounted_price', 'menu_id', 'city_id', 'description', 'details')
                ->get()
                ->map(function ($submenus) {
                    // Include the URLs in the response
                    $submenus->image = $submenus->image_url; // This will call the accessor for the URL
                    return $submenus;
                });

            // Fetch city and state for each submenu
            $submenus = $submenus->map(function ($submenu) {
                // Fetch the city and its state
                $city = City::find($submenu->city_id);
                $state = $city ? $city->state : null; // Assuming City model has a relation to State

                // Format city and state name
                $cityState = $city && $state ? $city->name . ', ' . $state->name : null;

                return [
                    'id' => $submenu->id,
                    'name' => $submenu->name,
                    'image' => $submenu->image,
                    'total_price' => $submenu->total_price,
                    'discounted_price' => $submenu->discounted_price,
                    'menu_id' => $submenu->menu_id,
                    'city' => $cityState, // Adding the city and state here
                    'description' => $submenu->description,
                    'details' => $submenu->details,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'SubMenu details retrieved successfully.',
                'submenus_data' => $submenus,

            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error retrieving SubMenu details: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving SubMenu details.',
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
                ->orderByDesc('created_at')
                ->get()
                ->map(function ($menu) {
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


    public function faqs()
    {
        try {
            $faqs = Faq::select('id', 'question', 'answer')
                ->orderByDesc('created_at')
                ->where('status', 1)
                ->get();


            // Check if faqs are found
            if ($faqs->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No faqs found.',
                    'data' => []
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'message' => 'faqs retrieved successfully.',
                'faqs_data' => $faqs
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error retrieving faqs: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving faqs.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // public function sendOtp(Request $request)
    // {
    //     // Validate the incoming request
    //     $validator = Validator::make($request->all(), [
    //         'mobile_number' => 'required|digits:10',
    //         'name' => 'required|string|max:255',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Validation errors',
    //             'errors' => $validator->errors()
    //         ], Response::HTTP_UNPROCESSABLE_ENTITY);
    //     }

    //     try {
    //         // Generate a new OTP
    //         $otp = rand(1000, 9999);

    //         // Find the enquiry by mobile number or create a new one
    //         $enquiry = Enquiry::updateOrCreate(
    //             ['mobile_number' => $request->mobile_number],
    //             [
    //                 'name' => $request->name,
    //                 'otp' => $otp,
    //                 ''
    //             ]
    //         );
    //         return response()->json([
    //             'success' => true,
    //             'message' => $enquiry->wasRecentlyCreated ? 'OTP created and sent successfully.' : 'OTP updated successfully.',
    //             'name' => $request->name,
    //             'otp' => $otp,
    //             'mobile_number' => $request->mobile_number,
    //             'otp_verified_at' => $enquiry->otp_verified_at
    //         ], Response::HTTP_OK);

    //     } catch (\Exception $e) {
    //         // Log the exception for debugging
    //         Log::error('Error sending OTP: ' . $e->getMessage());

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An error occurred while sending OTP.',
    //             'error' => $e->getMessage()
    //         ], Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }


    public function sendOtp(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|digits:10',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            // Generate a new OTP
            $otp = rand(1000, 9999);

            // Ensure mobile number is treated as a number (integer)
            $mobileNumber = (int) $request->mobile_number;

            // Find the enquiry by mobile number or create a new one
            $enquiry = Enquiry::updateOrCreate(
                ['mobile_number' => $mobileNumber],
                [
                    'name' => $request->name,
                    'otp' => $otp,
                ]
            );

            return response()->json([
                'success' => true,
                'message' => $enquiry->wasRecentlyCreated ? 'OTP created and sent successfully.' : 'OTP updated successfully.',
                'name' => $request->name,
                'otp' => $otp,
                'mobile_number' => $mobileNumber, // mobile_number as integer
                'otp_verified_at' => $enquiry->otp_verified_at
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error sending OTP: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while sending OTP.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function verifyOtp(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|digits:10',
            'otp' => 'required|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            // Find the enquiry by mobile number
            $enquiry = Enquiry::where('mobile_number', $request->mobile_number)
                ->orderByDesc('created_at')
                ->first();

            if (!$enquiry) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mobile number not found.'
                ], Response::HTTP_NOT_FOUND);
            }

            // Check if the OTP matches
            if ($enquiry->otp == $request->otp) {
                // Update the otp_verified_at timestamp
                $enquiry->update([
                    'otp_verified_at' => now(),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'OTP verified successfully.',
                    'otp_verified_at' => $enquiry->otp_verified_at,
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid OTP.',
                ], Response::HTTP_UNAUTHORIZED);
            }

        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error verifying OTP: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while verifying OTP.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function resendOtp(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            // Find the enquiry by mobile number
            $enquiry = Enquiry::where('mobile_number', $request->mobile_number)->first();

            if (!$enquiry) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mobile number not found.'
                ], Response::HTTP_NOT_FOUND);
            }

            // Resend the existing OTP
            $otp = $enquiry->otp;

            return response()->json([
                'success' => true,
                'message' => 'OTP resent successfully.',
                'otp' => $otp,
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error resending OTP: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while resending OTP.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
