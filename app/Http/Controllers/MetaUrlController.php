<?php

namespace App\Http\Controllers;

use App\Models\MetaUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MetaUrlController extends Controller
{
    public function index()
    {
        $urls = MetaUrl::all();
        return view('backend.meta.url', compact('urls'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $url = new MetaUrl();
        $url->url = $request->url;
        $url->save();

        return response()->json(['success' => true, 'message' => 'URL created successfully', 'url' => $url]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $url = MetaUrl::findOrFail($id);
        $url->url = $request->url;
        $url->save();

        return response()->json(['success' => true, 'message' => 'URL updated successfully', 'url' => $url]);
    }

    public function destroy($id)
    {
        $url = MetaUrl::findOrFail($id);
        $url->delete();

        return response()->json(['success' => true, 'message' => 'URL deleted successfully']);
    }
}
