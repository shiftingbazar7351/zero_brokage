<?php

namespace App\Http\Controllers;

use App\Models\MetaUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MetaUrlController extends Controller
{
    public function index()
    {
        $metas = MetaUrl::paginate(10);
        return view('backend.meta.index', compact('metas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required',
            'title' => 'required',
            'keyword' => 'required',
            'description' => 'required',
        ]);


        $meta = new MetaUrl($request->all());
        $meta->created_by = auth()->id();
        $meta->url = $request->url;
        $meta->title = $request->title;
        $meta->keyword = $request->keyword;
        $meta->description = $request->description;
        $meta->save();

    return response()->json(['success' => true, 'message' => 'Meta created successfully']);
    }

    public function edit($id)
    {
        $meta = MetaUrl::findOrFail($id);
        return response()->json($meta);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'url' => 'required',
            'title' => 'required',
            'keyword' => 'required',
            'description' => 'required',
        ]);

        $meta = MetaUrl::findOrFail($id);
        $meta->url = $request->url;
        $meta->title = $request->title;
        $meta->keyword = $request->keyword;
        $meta->description = $request->description;
        $meta->update();

        return redirect()->back()->with(['message' => 'Updated Successfully', 'alert-type' => 'success']);
    }

    public function destroy(MetaUrl $meta)
    {
        $meta->delete();

        return redirect()->back()->with(['message' => 'Deleted Successfully', 'alert-type' => 'success']);
    }
}
