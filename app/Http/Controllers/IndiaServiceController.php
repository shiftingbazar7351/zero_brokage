<?php

namespace App\Http\Controllers;

use App\Models\IndiaServiceDescription;
use Illuminate\Http\Request;

class IndiaServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $services = IndiaServiceDescription::get();
        return view('backend.india-service-description.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('backend.india-service-description.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        IndiaServiceDescription::create($request->all());
        return redirect(route('india-services.index'))->with('success', 'Added successfully');
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
        $services = IndiaServiceDescription::findOrFail($id);
        return view('backend.india-service-description.edit', compact('services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required'
        ]);
        IndiaServiceDescription::findOrFail($id)->update($request->all());
        return redirect(route('india-services.index'))->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $service = IndiaServiceDescription::find($id);

        if ($service) {
            $service->delete();
            return redirect()->back()->with('success', 'Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Service not found');
        }
    }

}
