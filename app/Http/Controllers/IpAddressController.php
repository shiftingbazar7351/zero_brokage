<?php

namespace App\Http\Controllers;

use App\Models\IpAddress;
use Illuminate\Http\Request;

class IpAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $query = IpAddress::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        // Paginate the users (adjust pagination number as needed)
        $ipaddresses = $query->orderByDesc('created_at')->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('backend.ip-address.partials.ip-address-index', compact('ipaddresses'))->render();
        }
        return view('backend.ip-address.index', compact('ipaddresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'ip_address' => 'required|unique:ip_addresses'
        ]);

        IpAddress::create([
            'ip_address' => $request->input('ip_address'),
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->back()->with(['message' => 'Added Successfully', 'alert-type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $ipAddress = IpAddress::find($id);

        if ($ipAddress) {
            return response()->json($ipAddress);
        } else {
            return response()->json(['error' => 'IP Address not found'], 404);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, IpAddress $ipAddress)
    {
        $request->validate([
            'ip_address' => ['required', 'regex:/^\d{1,3}\.\d{1,3}\.\d{1,3}\.$/']
        ]);

        $ipAddress->update([
            'ip_address' => $request->input('ip_address'),
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->back()->with(['message' => 'Updated Successfully', 'alert-type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $ipaddress = IpAddress::find($id);
        if ($ipaddress) {
            $ipaddress->delete();
            return redirect(route('ipaddress.index'))->with(['message' => 'Deleted Successfully', 'alert-type' => 'success']);
        }
        return redirect(route('ipaddress.index'))->with('error', 'Ip Address not found!');
    }
}
