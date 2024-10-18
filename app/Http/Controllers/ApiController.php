<?php

namespace App\Http\Controllers;
use App\Models\Address;
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
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;



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

            $mobileNumber = $request->mobile_number;

            if (strlen($mobileNumber) === 10) {
                $otp = $mobileNumber[0] . $mobileNumber[2] . $mobileNumber[4] . $mobileNumber[7];
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid mobile number format.'
                ], Response::HTTP_BAD_REQUEST);
            }

            if ($existingEnquiry) {
                $otpValidDuration = 30; // 5 seconds
                $otpGeneratedAt = strtotime($existingEnquiry->otp_created_at);
                $currentTime = time();

                if ($currentTime - $otpGeneratedAt < $otpValidDuration) {
                    return response()->json([
                        'success' => false,
                        'message' => 'OTP recently sent. Please wait before requesting a new OTP.'
                    ], Response::HTTP_CONFLICT);
                }

                $existingEnquiry->otp = $otp;
                $existingEnquiry->otp_created_at = now();
                $existingEnquiry->save();
            } else {
                Enquiry::create([
                    'mobile_number' => $request->mobile_number,
                    'country_code' => $request->country_code,
                    'otp' => $otp,
                    'name' => $request->name,
                    'otp_created_at' => now(),
                ]);
            }

            $message = "Dear User, Your OTP for login to ZeroBrokage is {$otp}. Valid for 30 seconds. Please do not share this OTP. Regards, Team ZeroBrokage";
            $encodedMessage = urlencode($message);

            $apiUrl = "https://cerf.cerfgs.com/multicpaas";
            $token = 'O3chuztXPZayQp7Rm7JE6GWaH90OqWXh';
            $from = 'ZRBRKG';
            $dltContentId = '1707172872636147832';

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
                $otpValidDuration = 30;
                $otpGeneratedAt = strtotime($enquiry->otp_created_at);
                $currentTimestamp = time();

                if (($currentTimestamp - $otpGeneratedAt) <= $otpValidDuration) {
                    $enquiry->update(['otp_verified_at' => now()]);

                    return response()->json([
                        'success' => true,
                        'message' => 'OTP verified successfully.',
                        'otp_verified_at' => $enquiry->otp_verified_at,
                    ], Response::HTTP_OK);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'OTP has expired. Please request a new one.',
                    ], Response::HTTP_UNAUTHORIZED);
                }
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

        $mobileNumber = $request->mobile_number;
        $otp = $mobileNumber[0] . $mobileNumber[2] . $mobileNumber[4] . $mobileNumber[7];

        $existingEnquiry->update([
            'otp' => $otp,
            'otp_created_at' => now(),
        ]);

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

public function bookingList()
{
    try {
        $enquiries = Enquiry::select('id', 'name', 'email', 'mobile_number')->get();

        $addresses = Address::select('enquiries_id', 'address1')->get()->keyBy('enquiries_id');

        $bookingList = $enquiries->map(function ($enquiry) use ($addresses) {
            $enquiryId = $enquiry->id;

            \Log::info("Enquiry ID: $enquiryId");
            if ($addresses->has($enquiryId)) {
                \Log::info("Matching address found for Enquiry ID: $enquiryId");
            } else {
                \Log::info("No address found for Enquiry ID: $enquiryId");
            }

            return [
                'name' => $enquiry->name,
                'email' => $enquiry->email,
                'mobile_number' => $enquiry->mobile_number,
                'location' => $addresses->has($enquiryId) ? $addresses[$enquiryId]->address1 : null, // Fetch address1 as location
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $bookingList,
        ]);
    } catch (ModelNotFoundException $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Data not found.',
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'An unexpected error occurred: ' . $e->getMessage(),
        ], 500);
    }
}


// POST request ke liye function
public function createBooking(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'mobile_number' => 'required|string|max:15',
        'location' => 'required|string|max:255',
    ]);

    try {
        $enquiry = Enquiry::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'mobile_number' => $validatedData['mobile_number'],
        ]);

        Address::create([
            'enquiry_id' => $enquiry->id,
            'address1' => $validatedData['location'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Booking created successfully.',
            'data' => [
                'enquiry_id' => $enquiry->id,
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'mobile_number' => $validatedData['mobile_number'],
                'location' => $validatedData['location'],
            ],
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'An unexpected error occurred: ' . $e->getMessage(),
        ], 500);
    }
}


public function addressList()
{
    try {
        $addresses = Address::all();

        return response()->json([
            'status' => 'success',
            'data' => $addresses,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'An unexpected error occurred: ' . $e->getMessage(),
        ], 500);
    }
}
public function getSavedAddresses(Request $request): JsonResponse
    {
        try {
            $cacheKey = 'saved_addresses';

            $addresses = Cache::remember($cacheKey, 60, function () {
                return Address::select(
                    'addresses.type',
                    'addresses.pincode',
                    'addresses.city',
                    'addresses.state',
                    'addresses.house_number',
                    'addresses.building_name',
                    'addresses.road_name',
                    'addresses.area_colony',
                    'enquiries.name',
                     'enquiries.email',
                    'enquiries.mobile_number'
                )
                ->join('enquiries', 'addresses.enquiries_id', '=', 'enquiries.id')
                ->get();
            });

            if ($addresses->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No addresses found.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $addresses,
                'message' => 'Addresses retrieved successfully.',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving addresses.',
            ], 500);
        }
    }

    public function updateAddress(Request $request, $id): JsonResponse
    {
        try {
            $validated = $request->validate([
                'type' => 'required|string|in:home,work',
                'pincode' => 'required|string|max:20',
                'city' => 'required|string|max:50',
                'state' => 'required|string|max:50',
                'house_number' => 'sometimes|string|max:50',
                'building_name' => 'sometimes|string|max:100',
                'road_name' => 'sometimes|string|max:100',
                'area_colony' => 'sometimes|string|max:100',
                'name' => 'required|string|max:50',
                'email' => 'sometimes|email|max:100',
                'mobile_number' => 'required|string|max:15',
            ]);

            $address = Address::findOrFail($id);

            $address->update($validated);

            $enquiry = Enquiry::findOrFail($address->enquiries_id);
            $enquiry->update([
                'name' => $validated['name'],
                'email' => $validated['email'] ?? $enquiry->email,
                'mobile_number' => $validated['mobile_number'],
            ]);

            Cache::forget('saved_addresses');

            return response()->json([
                'success' => true,
                'data' => $address,
                'message' => 'Address and enquiry updated successfully.',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Address or Enquiry not found.',
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the address.',
            ], 500);
        }
    }
}
