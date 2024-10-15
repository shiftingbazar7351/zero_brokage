<?php

namespace App\Http\Controllers;

use App\Models\MetaUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MetaUrlController extends Controller
{
    public function index(Request $request)
    {

        $query = MetaUrl::query();

        // Filter based on search query
        if ($request->has('search')) {
            $query->where('url', 'like', '%' . $request->search . '%')
                  ->orWhere('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('keyword', 'like', '%' . $request->search . '%');
        }

        // Paginate the users (adjust pagination number as needed)
        $metas = $query->paginate(10);

        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('backend.meta.partials.meta-index', compact('metas'))->render();
        }
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

        Session()->flash('message','Added Successfully');
        Session()->flash('alert-type','success');
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
