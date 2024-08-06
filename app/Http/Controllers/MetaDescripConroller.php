<?php

namespace App\Http\Controllers;
use App\Models\MetaDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        // $request->validate([
        //     'desc' => 'required|string|min:10|max:255',
        // ]);

        $validator = Validator::make($request->all(), [
         'desc' => 'required|string|min:10|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $desc = new MetaDescription();
        $desc->description = $request->desc;

        $desc->save();
        session()->flash('success', 'Submitted Successfully');

        // session()->flash('alert-type', 'success');

        // Return redirect response

        return response()->json(['redirect' => url()->previous()]);


    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|min:10|max:255',
           ]);
   
           if ($validator->fails()) {
               return response()->json(['errors' => $validator->errors()], 422);
           }
        // dd( $request->input('desc'));
        $description = MetaDescription::findOrFail($id);
        $description->description = $request->input('description');

        $description->save();
        session()->flash('success', 'Submitted Successfully');
        return response()->json(['redirect' => url()->previous()]);

        // return redirect()->back()->with('success', 'Description updated successfully.');
    }
}
