<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OtpController extends Controller
{
    public function getOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_number' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Generate OTP
        $otp = rand(1000, 9999);

        // Store data in the enquiries table
        Enquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'otp' => $otp,
        ]);

        return response()->json(['success' => true]);
    }

    public function verifyOtp(Request $request)
    {
        // Validate the OTP
        $validator = Validator::make($request->all(), [
            'otp' => 'required|digits:4',
            'mobile_number' => 'required|string|digits:10', // Validate mobile number as well
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Find the enquiry with the given mobile number
        $enquiry = Enquiry::where('mobile_number', $request->mobile_number)->first();
        $enquiry->otp_verified_at = now();
        $enquiry->save();

        if (!$enquiry) {
            return response()->json(['success' => false, 'errors' => ['mobile_number' => ['Mobile number not found.']]], 404);
        }

        // Verify if the OTP matches
        if ($enquiry->otp !== $request->otp) {
            return response()->json(['success' => false, 'errors' => ['otp' => ['Invalid OTP.']]], 422);
        }

        // OTP is correct, proceed with further logic
        // For example, mark the enquiry as verified or proceed to the next step

        return response()->json(['success' => true]);
    }

}
