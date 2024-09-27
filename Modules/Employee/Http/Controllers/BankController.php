<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employee\Entities\Bank;
use App\Models\User;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = Bank::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
            ->orderByDesc('created_at');
        }
        // Paginate the users (adjust pagination number as needed)
        $banks = $query->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('employee::bank.partials.bank-index', compact('banks'))->render();
        }
        return view('employee::bank.index',compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('employee::bank.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // Validate the form inputs
        $validatedData = $request->validate([
            'emp_id' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'bank_name'=> 'required',
            'permanent_acc_number' => 'required|string|max:255',
            // 'employee_type' => 'required|string|max:255',
            'band' => 'required|string|max:255',
            'uan' => 'required|string|max:255',
        ]);

        // Create a new Bank instance with the validated data
        $bank = new Bank($validatedData);

        // Set the created_by field to the authenticated user's ID
        $bank->created_by = auth()->user()->id;

        // Save the bank data to the database
        $bank->save();

        // Redirect back to the index page with a success message
        return redirect()->route('employee-bank.index')->with([
            'message' => 'Bank added successfully',
            'alert-type' => 'success'
        ]);
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('employee::bank.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
         $bank = Bank::with('usern')->findOrFail($id);

        return view('employee::bank.edit', compact('bank', ));
    }



    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        // Validate the form inputs
        $validatedData = $request->validate([
            'emp_id' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'bank_name'=> 'required',
            'permanent_acc_number' => 'required|string|max:255',
            // 'employee_type' => 'required|string|max:255',
            'band' => 'required|string|max:255',
            'uan' => 'required|string|max:255',
        ]);

        // Find the bank record by its ID
        $bank = Bank::findOrFail($id);

        // Update the bank record with the validated data
        $bank->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('employee-bank.index')->with([
            'message' => 'Bank updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        // Find the bank record by its ID
        $bank = Bank::findOrFail($id);

        // Delete the bank record
        $bank->delete();

        // Redirect back with a success message
        return redirect()->route('employee-bank.index')->with([
            'message' => 'Bank deleted successfully',
            'alert-type' => 'success'
        ]);
    }

    public function BankStatus(Request $request)
    {
        $item = Bank::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();
            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }

}
