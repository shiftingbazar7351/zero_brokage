<?php

namespace App\Http\Controllers;

use App\Models\MetaTitle;
use Illuminate\Http\Request;

class MetaTitleController extends Controller
{
    public function index()
    {
        $titles = MetaTitle::get();
        // $hasDescription = $descriptions->isNotEmpty();
       
        return view('backend.meta.title', compact('titles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        // dd($request->url);
        $desc = new MetaTitle();
        $desc->title = $request->title;

        $desc->save();

        return redirect()->back()->with('success', 'Url created successfully.');
    }
}
