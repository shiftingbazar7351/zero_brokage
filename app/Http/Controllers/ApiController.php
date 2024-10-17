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
        // dd(1);
        try {
            $subcategories = Subcategory::select('id', 'name', 'slug', 'icon', 'background_image', 'featured', 'trending')
                ->where('status', 1)
                ->orderByDesc('created_at')
                ->get()
                ->map(function ($subcategory) {
                    $subcategory->icon = $subcategory->icon_url;
                    $subcategory->background_image = $subcategory->background_image_url;
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
                'data' => !empty($subcategories)?$subcategories:[],
            ], Response::HTTP_OK);

        } catch (\Exception $e) {


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
            $subcategory = SubCategory::select('id')->orderByDesc('created_at')->find($id);

            if (!$subcategory) {
                return response()->json([
                    'success' => false,
                    'message' => 'Subcategory not found.',
                    'data' => null
                ]);
            }

            $menus = Menu::select('id', 'name', 'image', 'slug', 'subcategory_id')
                ->where('subcategory_id', $subcategory->id)
                ->where('status', 1)
                ->orderByDesc('created_at')
                ->get();

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
                        'submenu_data' => $submenus->items()
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
                        'cities_data' => $cities->items()
                    ]
                ]
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
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
            $menu = Menu::select('id', 'name', 'image', 'slug', 'subcategory_id')
                ->where('id', $id)
                ->where('status', 1)
                ->orderByDesc('created_at')
                ->first();

            if (!$menu) {
                return response()->json([
                    'success' => false,
                    'message' => 'Menu not found.',
                    'data' => null
                ]);
            }

            $submenus = SubMenu::where('menu_id', $menu->id)
                ->where('status', 1)
                ->orderByDesc('created_at')
                ->select('id', 'name', 'image', 'total_price', 'discounted_price', 'menu_id', 'city_id', 'description', 'details')
                ->get()
                ->map(function ($submenus) {
                    $submenus->image = $submenus->image_url;
                    return $submenus;
                });

            $submenus = $submenus->map(function ($submenu) {
                $city = City::find($submenu->city_id);
                $state = $city ? $city->state : null;

                $cityState = $city && $state ? $city->name . ', ' . $state->name : null;

                return [
                    'id' => $submenu->id,
                    'name' => $submenu->name,
                    'image' => $submenu->image,
                    'total_price' => $submenu->total_price,
                    'discounted_price' => $submenu->discounted_price,
                    'menu_id' => $submenu->menu_id,
                    'city' => $cityState,
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
                    $menu->icon = $menu->icon_url;
                    unset($menu->image);
                    return $menu;
                });

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



    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'country_code' => 'required|regex:/^\+?\d{1,3}$/',
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
            $existingEnquiry = Enquiry::where('mobile_number', $request->mobile_number)->first();

            if ($existingEnquiry) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP already sent. Please use the resend OTP feature.'
                ], Response::HTTP_CONFLICT);
            }

            $otp = rand(100000, 999999);

            Enquiry::create([
                'mobile_number' => $request->mobile_number,
                'country_code' => $request->country_code,
                'otp' => $otp,
                'name' => $request->name,
            ]);

            $message = "Dear User, Your OTP for login to ZeroBrokage is {$otp}. Valid for 2 minutes. Please do not share this OTP. Regards, Team ZeroBrokage";
            $encodedMessage = urlencode($message);

            $apiUrl = "https://cerf.cerfgs.com/multicpaas";
            $token = 'O3chuztXPZayQp7Rm7JE6GWaH90OqWXh';
            $from = 'ZRBRKG';
            $dltContentId = '1707172872636147832';

            $postFields = http_build_query([
                'unicode' => 'false',
                'token' => $token,
                'from' => $from,
                'to' => $request->country_code . $request->mobile_number,
                'text' => $encodedMessage,
                'dltContentId' => $dltContentId,
            ]);

            $mobile = $request->country_code . $request->mobile_number;
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://cerf.cerfgs.com/multicpaas?unicode=false&token=O3chuztXPZayQp7Rm7JE6GWaH90OqWXh&from=ZRBRKG&");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "to=$mobile&dltContentId=$dltContentId&text=$encodedMessage");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $apiResponse = curl_exec($ch);

            if (curl_errno($ch)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send OTP via SMS.',
                    'error' => curl_error($ch)
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode == 200) {
                return response()->json([
                    'success' => true,
                    'message' => 'OTP sent successfully.',
                    'otp' => $otp,
                    'name' => $request->name,
                    'country_code' => $request->country_code,
                    'mobile_number' => $request->mobile_number,
                    'api_response' => $apiResponse
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send OTP via the external API.',
                    'api_response' => $apiResponse
                ], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $e) {
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
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|digits:10',
            'otp' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $enquiry = Enquiry::where('mobile_number', $request->mobile_number)
                ->orderByDesc('created_at')
                ->first();

            if (!$enquiry) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mobile number not found.'
                ], Response::HTTP_NOT_FOUND);
            }

            if ($enquiry->otp == $request->otp) {
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
    $validator = Validator::make($request->all(), [
        'country_code' => 'required|regex:/^\+?\d{1,3}$/',
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
        $existingEnquiry = Enquiry::where('mobile_number', $request->mobile_number)->first();

        if (!$existingEnquiry) {
            return response()->json([
                'success' => false,
                'message' => 'No OTP found for this mobile number. Please request a new OTP.'
            ], Response::HTTP_NOT_FOUND);
        }

        $otp = $existingEnquiry->otp;

        $message = "Dear User, Your OTP for login to ZeroBrokage is {$otp}. Valid for 2 minutes. Please do not share this OTP. Regards, Team ZeroBrokage";
        $encodedMessage = urlencode($message);

        $apiUrl = "https://cerf.cerfgs.com/multicpaas";
        $token = 'O3chuztXPZayQp7Rm7JE6GWaH90OqWXh';
        $from = 'ZRBRKG';
        $dltContentId = '1707172872636147832';

        $mobile = $request->country_code . $request->mobile_number;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://cerf.cerfgs.com/multicpaas?unicode=false&token=$token&from=$from&");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "to=$mobile&dltContentId=$dltContentId&text=$encodedMessage");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $apiResponse = curl_exec($ch);

        if (curl_errno($ch)) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to resend OTP via SMS.',
                'error' => curl_error($ch)
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {

            $existingEnquiry->update([
                'country_code' => $request->country_code,
                'otp' => $otp,
                'mobile_number' => $request->mobile_number,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'OTP resent successfully.',
                'otp' => $otp,
                'country_code' => $request->country_code,
                'mobile_number' => $request->mobile_number,
                'api_response' => $apiResponse
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to resend OTP via the external API.',
                'api_response' => $apiResponse
            ], Response::HTTP_BAD_REQUEST);
        }
    } catch (\Exception $e) {
        Log::error('Error resending OTP: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'An error occurred while resending OTP.',
            'error' => $e->getMessage()
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
}
