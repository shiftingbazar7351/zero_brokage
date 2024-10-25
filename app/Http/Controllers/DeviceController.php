<?php

namespace App\Http\Controllers;

use App\Models\Enquiry; // Ensure you include the model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    public function handleDeviceId(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'id' => 'required|string|unique:enquiries,device_id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Process the device ID and store it in the enquiries table
            $deviceId = $request->input('id');

            // Create a new record in the enquiries table
            Enquiry::create(['device_id' => $deviceId]);

            return response()->json([
                'status' => 'success',
                'message' => 'Device ID processed and stored successfully',
                'data' => [
                    'device_id' => $deviceId,
                ],
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
