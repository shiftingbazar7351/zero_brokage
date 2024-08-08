<?php

namespace App\Http\Controllers;

use App\Models\MetaDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MetaDescripConroller extends Controller
{
    public function index()
    {
        $descriptions = MetaDescription::all();
        return view('backend.meta.description', compact('descriptions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'desc' => 'required|string|min:10|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $desc = new MetaDescription();
        $desc->description = $request->desc;
        $desc->save();

        return response()->json(['success' => true, 'message' => 'Description created successfully']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'desc' => 'required|string|min:10|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $description = MetaDescription::findOrFail($id);
        $description->description = $request->desc;
        $description->save();

        return response()->json(['success' => true, 'message' => 'Description updated successfully']);
    }
}
