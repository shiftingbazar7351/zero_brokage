<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verified;

class VerifiedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $verifieds = Verified::orderByDesc('created_at')->get();
        return view("backend.vendor.verified", compact("verifieds"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
        ]);

        $review = new Verified($request->all());
        $review->created_by = auth()->id();
        $review->save();
        return redirect()->back()->with('success', ' Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Verified::findOrFail($id);
        return response()->json($review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
        ]);

        $review = Verified::findOrFail($id);

        // Update the FAQ with the new data
        $review->update($request->only(['name', 'image']));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verified $verified)
    {
        $verified->delete();

        return redirect()->back()->with('success', 'Deleted successfully.');
    }
}
