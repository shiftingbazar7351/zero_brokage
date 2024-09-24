<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Faq::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        // Paginate the users (adjust pagination number as needed)
        $faqs = $query->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('backend.faq.partials.faq-index', compact('faqs'))->render();
        }
        return view('backend.faq.index', compact('faqs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        // Save FAQ data
        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'created_by' => auth()->id(),
        ]);

        Session()->flash('message', 'Added Successfully');
        Session()->flash('alert-type', 'success');
        // Return a JSON response for successful addition
        return response()->json(['message' => 'FAQ added successfully!'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return response()->json($faq);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        // Find the FAQ by ID
        $faq = Faq::findOrFail($id);

        // Update the FAQ with the new data
        $faq->update($request->only(['question', 'answer']));

        // Redirect back with a success message
        return redirect()->back()->with(['message' => 'Updated Successfully', 'alert-type' => 'success']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->back()->with(['message' => 'Faq Deleted successfully.', 'alert-type' => 'success']);

    }

    public function faqStatus(Request $request)
    {
        $item = Faq::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }

}
