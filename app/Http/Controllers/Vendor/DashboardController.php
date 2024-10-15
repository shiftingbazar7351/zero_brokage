<?php

namespace App\Http\Controllers;

use App\Models\ServiceBooking;
use App\Models\Notification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the vendor dashboard with booking statistics.
     */
    public function index()
    {
        // Get the currently authenticated vendor's ID
        $vendorId = auth()->user()->id;

        // Fetch total, pending, completed, and canceled bookings for the vendor
        $totalBookings = ServiceBooking::where('vendor_id', $vendorId)->count();
        $pendingBookings = ServiceBooking::where('vendor_id', $vendorId)->where('status', 'pending')->count();
        $completedBookings = ServiceBooking::where('vendor_id', $vendorId)->where('status', 'completed')->count();
        $canceledBookings = ServiceBooking::where('vendor_id', $vendorId)->where('status', 'canceled')->count();

        // Fetch unread notifications for the vendor
        $unreadNotifications = Notification::where('vendor_id', $vendorId)->where('status', 'unread')->count();

        // Pass the data to the dashboard view
        return view('vendor.dashboard', compact('totalBookings', 'pendingBookings', 'completedBookings', 'canceledBookings', 'unreadNotifications'));
    }
}
