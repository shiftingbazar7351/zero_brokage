<?php

namespace Modules\Holiday\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Holiday\Entities\Holiday;
use Illuminate\Routing\Controller;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index(Request $request)
    {
        $query = Holiday::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('festival_name', 'like', '%' . $request->search . '%');
        }
        // Paginate the users (adjust pagination number as needed)
        $holidays = $query->orderByDesc('created_at')->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('holiday::holiday.partials.holiday-index', compact('holidays'))->render();
        }
        return view('holiday::holiday.index',compact('holidays'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('holiday::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'festival_name' => 'required',
            'start_date' => 'required',
            'end_date'=> 'required',
            'festival_types'=> 'required',
            'Number_of_days'=> 'required'
        ]);


        $holiday = new Holiday();
        $holiday->festival_name = $request->festival_name;
        $holiday->start_date = $request->start_date;
        $holiday->end_date = $request->end_date;
        $holiday->festival_types = $request->festival_types;
        // $holiday->Number_of_days = $request->Number_of_days;
        $holiday->Number_of_days = (new \DateTime($request->start_date))->diff(new \DateTime($request->end_date))->days;



        $holiday->save();

        return response()->json(['success' => true, 'message' => 'holiday created successfully.']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('holiday::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $holiday = Holiday::find($id);
        return response()->json(['holiday' => $holiday]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'festival_name' => 'required',
            'start_date' => 'required',
            'end_date'=> 'required',
            'festival_types'=> 'required',
            'Number_of_days'=> 'required'
        ]);


        $holiday = Holiday::findOrFail($id);
        $holiday->festival_name = $request->festival_name;
        $holiday->start_date = $request->start_date;
        $holiday->end_date = $request->end_date;
        $holiday->festival_types = $request->festival_types;
        $holiday->Number_of_days = $request->Number_of_days;


        $holiday->save();

        return response()->json(['success' => true, 'message' => 'holiday created successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $holiday = Holiday::findOrFail($id);
        $holiday->delete();

        return redirect(route('holiday.index'))->with('success', ' Deleted Successfully!');
    }

    public function HolidayStatus(Request $request)
    {
        $item = Holiday::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();
            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }
}
