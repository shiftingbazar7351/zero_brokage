<?php

namespace App\Http\Controllers;

use App\Models\MetaTitle;
use Illuminate\Http\Request;

class MetaTitleController extends Controller
{
    public function index()
    {
        $titles = MetaTitle::all();
        return view('backend.meta.title', compact('titles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $title = new MetaTitle();
        $title->title = $request->title;
        $title->save();

        return response()->json(['success' => true, 'message' => 'Meta title added successfully']);
    }

    public function update(Request $request, MetaTitle $metaTitle)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $metaTitle->title = $request->title;
        $metaTitle->save();

        return response()->json(['success' => true, 'message' => 'Meta title updated successfully']);
    }

    public function destroy(MetaTitle $metaTitle)
    {
        $metaTitle->delete();

        return response()->json(['success' => true, 'message' => 'Meta title deleted successfully']);
    }
}
