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
    public function index()
    {
        $ipaddresses = IpAddress::paginate(10);
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

        return redirect()->back()->with('success', 'IP Address added successfully');
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

        return redirect()->back()->with('success', 'IP Address updated successfully');
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
            return redirect(route('ipaddress.index'))->with('success', 'Ip Address deleted successfully!');
        }
        return redirect(route('ipaddress.index'))->with('error', 'Ip Address not found!');
    }
}
