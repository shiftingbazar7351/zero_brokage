<?php

namespace App\Http\Controllers;

use App\Models\MetaUrl;
use Illuminate\Http\Request;

class MetaUrlController extends Controller
{
    public function index()
    {
        $urls = MetaUrl::get();
        // $hasDescription = $descriptions->isNotEmpty();
       
        return view('backend.meta.url', compact('urls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required',
        ]);
        // dd($request->url);
        $desc = new MetaUrl();
        $desc->url = $request->url;

        $desc->save();

        return redirect()->back()->with('success', 'Url created successfully.');
    }
}
