<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $newsletters = Newsletter::orderByDesc('created_at')->paginate(10);
        return view('backend.newsletter.index',compact('newsletters'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        Newsletter::create($request->all());
        return redirect()->back()->with(['message' => 'Email Saved Successfully', 'alert-type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();
        return redirect()->back()->with(['message' => 'Deleted Successfully', 'alert-type' => 'success']);
    }
}
