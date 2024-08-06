<?php

namespace App\Http\Controllers;
use App\Models\MetaDescription;
use Illuminate\Http\Request;

class MetaDescripConroller extends Controller
{
    public function index()
    {
        $descriptions = MetaDescription::get();
        $hasDescription = $descriptions->isNotEmpty();
       
        return view('backend.meta.description', compact('descriptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'desc' => 'required|string|min:10|max:255',
        ]);

        $desc = new MetaDescription();
        $desc->description = $request->desc;

        $desc->save();

        return redirect()->back()->with('success', 'Description created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'desc' => 'required|string|min:10|max:255',
        ]);
        // dd( $request->input('desc'));
        $description = MetaDescription::findOrFail($id);
        $description->description = $request->input('desc');

        $description->save();

        return redirect()->back()->with('success', 'Description updated successfully.');
    }
}
