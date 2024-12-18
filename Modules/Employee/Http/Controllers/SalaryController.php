<?php

namespace Modules\Employee\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employee\Entities\Department;
use Modules\Employee\Entities\HeadOffice;
use Modules\Employee\Entities\HrName;
use Modules\Employee\Entities\Salary;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = Salary::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orderByDesc('created_at');
        }
        // Paginate the users (adjust pagination number as needed)
        $salaries = $query->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('employee::salary.partials.salary-index', compact('salaries'))->render();
        }

        return view('employee::salary.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $departments = Department::where('status', 1)
            ->orderByDesc('created_at')
            ->get();
        $hrs = HrName::where('designation', 'HR Head')->get(['id', 'name']);

        return view('employee::salary.create', compact('departments', 'hrs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // Validate the input data according to your migration structure
        $validatedData = $request->validate([
            'basic_salary' => 'required|string|max:255',
            'house_rent_allowance' => 'required|string|max:255',
            'conveyance_allowance' => 'required|string|max:255',
            'other_allowance' => 'required|string|max:255',
            'personal_pay' => 'required|string|max:255',
            'food_allowance' => 'required|string|max:255',
            'medical_allowance' => 'required|string|max:255',
            'telephone_allowance' => 'required|string|max:255',
            'provident_fund' => 'required|string|max:255',
            'voluntary_provident_fund' => 'required|string|max:255',
            'professional_tax' => 'required|string|max:255',
            'personal_loan_principal' => 'required|string|max:255',
            'personal_loan_interest' => 'required|string|max:255',
            'food_relief' => 'required|string|max:255',
        ]);

        $salary = new Salary($request->all());

        $salary->created_by = auth()->user()->id;
        $salary->save();

        return redirect(route('employee-salary.index'))->with([
            'message' => 'Salary added successfully',
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
        $salary = Salary::findOrFail($id);
        return view('employee::salary.show',compact('salary'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $users = User::orderByDesc('created_at')->get(['id', 'department', 'designation', 'name']);
        $salary = Salary::findOrFail($id);
        $hrs = HrName::where('designation', 'HR Head')->get(['id', 'name']);
        return view('employee::salary.edit', compact('salary', 'users', 'hrs'));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'basic_salary' => 'nullable|string|max:255',
            'house_rent_allowance' => 'nullable|string|max:255',
            'conveyance_allowance' => 'nullable|string|max:255',
            'other_allowance' => 'nullable|string|max:255',
            'personal_pay' => 'nullable|string|max:255',
            'food_allowance' => 'nullable|string|max:255',
            'medical_allowance' => 'nullable|string|max:255',
            'telephone_allowance' => 'nullable|string|max:255',
            'provident_fund' => 'nullable|string|max:255',
            'voluntary_provident_fund' => 'nullable|string|max:255',
            'professional_tax' => 'nullable|string|max:255',
            'personal_loan_principal' => 'nullable|string|max:255',
            'personal_loan_interest' => 'nullable|string|max:255',
            'food_relief' => 'nullable|string|max:255',
            'hr_head' => 'nullable'
        ]);

        $salary = Salary::findOrFail($id);

        $salary->update($validatedData);

        $salary->created_by = auth()->user()->id;
        $salary->save();

        return redirect(route('employee-salary.index'))->with([
            'message' => 'Salary updated successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();

        return back()->with(['message' => 'Salary deleted successfully.', 'alert-type' => 'success']);
    }

    public function getEmployees(Request $request)
    {
        $department = $request->query('department');
        $designation = $request->query('designation');

        // Fetch employees based on department and designation
        $employees = User::where('department', $department)
                          ->where('designation', $designation)
                          ->get(['id', 'name']); // Return only the ID and name

        return response()->json($employees);
    }

    public function SalaryStatus(Request $request)
    {
        $item = Salary::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();
            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }

}
