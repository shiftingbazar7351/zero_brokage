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
            'desc' => 'required',
        ]);

        $desc = new MetaDescription();
        $desc->description = $request->desc;

        $desc->save();

        return redirect()->back()->with('success', 'Description created successfully.');
    }
}
