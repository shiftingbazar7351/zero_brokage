<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employee\Entities\HeadOffice;
use Modules\Employee\Entities\Department;
use Modules\Employee\Entities\Salary;
use App\Models\User;

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
        return view('employee::salary.index',compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
         $departments = Department::where('status',1)
        ->orderByDesc('created_at')
        ->get();

        return view('employee::salary.create',compact('departments'));
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
        return view('employee::salary.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $salary = Salary::findOrFail($id);
        return view('employee::salary.edit', compact('salary'));
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
    $department = $request->get('department');
    $designation = $request->get('designation');

    return $employees = User::where('department', $department)
                    ->where('designation', $designation)
                    ->where('status', 1) // assuming status 1 means active
                    ->orderBy('name')
                    ->get(['id', 'name']); // fetching only id and name for dropdown

    return response()->json($employees);

    }

}
