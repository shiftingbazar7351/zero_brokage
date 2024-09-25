<?php

namespace Modules\Employee\Http\Controllers;

use App\Models\User;

use App\Services\FileUploadService;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Modules\Employee\Entities\Companie;
use Spatie\Permission\Models\Role;
use Validator;

class EmployeeController extends Controller
{

    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $query = User::query();
        // Filter based on search query
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('company', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }
        // Paginate the users (adjust pagination number as needed)
        $employees = $query->orderByDesc('created_at')->paginate(10);
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('employee::employee.partials.employee-index', compact('employees'))->render();
        }
        // $employees = User::orderByDesc('created_at')->paginate(10);
        return view('employee::employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $roles = Role::where('name', 'employee')->get();
        $role = Role::where('name', 'employee')->first();
        $employee = User::where('status', 1)
            ->where('user_type', $role->id ?? '')
            ->get();
        $companies = Companie::where('status', 1)->get();
        return view('employee::employee.create', compact('roles', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request)
    {
        // Validation for the form inputs
        $validatedData = $request->validate([
            'employee_code' => 'nullable|string|max:191',
            'name' => 'required|string|max:191',
            'lname' => 'nullable|string|max:191',
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'nullable|date',
            'password' => 'nullable',
            'email' => 'nullable|email|unique:employees,email',
            'user_type' => 'nullable|string|max:191',
            'number' => 'nullable|string|max:191',
            'joining_date' => 'nullable|date',
            'company' => 'nullable|string|max:191',
            'no_of_experience' => 'nullable|string|max:191',
            'department' => 'nullable|string|max:191',
            'designation' => 'nullable|string|max:191',
            'office_shift' => 'nullable|string|max:191',
            'reporting_head' => 'nullable|string|max:191',
            'hr_head' => 'nullable|string|max:191',
            'hr_executive' => 'nullable|string|max:191',
            'official_mobile' => 'nullable|string|max:191',
            'official_email' => 'nullable|email|max:191',
            'experience_letter' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'relieving_letter' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'offer_letter' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'salary_slip' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'bank_statement' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'current_address' => 'nullable|string|max:191',
            'permanent_address' => 'nullable|string|max:191',
        ]);

        // Format the designation for the role name and title
        $designation = $validatedData['designation'];
        $roleName = strtolower(str_replace(' ', '_', $designation)); // e.g., "frontend_developer"
        $roleTitle = $designation; // e.g., "Frontend Developer"

        // Check if the designation exists in the roles table
        $role = Role::firstOrCreate(
            ['name' => $roleName],
            ['title' => $roleTitle]
        );
        // Set a default password
        $validatedData['password'] = Hash::make('123456');
        // Create the employee with validated data
        $employee = User::create($validatedData);
        $employee->user_type = $role->id;
        if ($employee->user_type != $role->id) {
            // Debugging: Log error message if the user_type is not set correctly
            Log::error('Role ID not stored in user_type', ['role_id' => $role->id, 'user_type' => $employee->user_type]);
        }

        // Set created_by to the current authenticated user
        $employee->created_by = auth()->user()->id;

        // Handle file uploads
        $fileFields = [
            'high_school_certificate' => 'employee/high_school_certificate/',
            'intermediate_certificate' => 'employee/intermediate_certificate/',
            'graduation_certificate' => 'employee/graduation_certificate/',
            'experience_letter' => 'employee/experience_letter/',
            'relieving_letter' => 'employee/relieving_letter/',
            'offer_letter' => 'employee/offer_letter/',
            'salary_slip' => 'employee/salary_slip/',
            'bank_statement' => 'employee/bank_statement/',
            'character_certificate' => 'employee/character_certificate/',
            'medical_certificate' => 'employee/medical_certificate/',
        ];

        foreach ($fileFields as $field => $path) {
            if ($request->hasFile($field)) {
                $filename = $this->fileUploadService->uploadImage($path, $request->file($field));
                $employee->$field = $filename;
            }
        }

        $employee->save();

        // Redirect with success message
        return redirect()->route('employee.index')->with(['message' => 'Employee created successfully.', 'alert-type' => 'success']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('employee::employee.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $employee = User::findOrFail($id);
        return view('employee::employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        // Validation for the form inputs
        $validatedData = $request->validate([
            'employee_code' => 'nullable|string|max:191',
            'fname' => 'required|string|max:191',
            'lname' => 'required|string|max:191',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'email' => 'required|email|unique:employees,email,' . $id, // Allow current email
            'user_type' => 'nullable|string|max:191',
            'number' => 'nullable|string|max:191',
            'joining_date' => 'required|date',
            'company' => 'nullable|string|max:191',
            'no_of_experience' => 'nullable|string|max:191',
            'department' => 'nullable|string|max:191',
            'designation' => 'nullable|string|max:191',
            'office_shift' => 'nullable|string|max:191',
            'reporting_head' => 'nullable|string|max:191',
            'hr_head' => 'nullable|string|max:191',
            'hr_executive' => 'nullable|string|max:191',
            'official_mobile' => 'nullable|string|max:191',
            'official_email' => 'nullable|email|max:191',
            'experience_letter' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'relieving_letter' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'offer_letter' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'salary_slip' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'bank_statement' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'current_address' => 'nullable|string|max:191',
            'permanent_address' => 'nullable|string|max:191',
            // 'character_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            // 'medical_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            // 'previous_ref_name' => 'nullable|string|max:191',
            // 'previous_ref_email' => 'nullable|email|max:191',
            // 'previous_ref_number' => 'nullable|string|max:191',
            // 'previous_ref_designation' => 'nullable|string|max:191',
        ]);
        // return $request->all();

        $employee = User::findOrFail($id);

        $employee->update($validatedData);

        $employee->created_by = auth()->user()->id;

        if ($request->hasFile('experience_letter')) {
            if ($employee->experience_letter) {
                $this->fileUploadService->removeImage('employee/experience_letter/', $employee->experience_letter);
            }
            $filename = $this->fileUploadService->uploadImage('employee/experience_letter/', $request->file('experience_letter'));
            $employee->experience_letter = $filename;
        }
        if ($request->hasFile('relieving_letter')) {
            if ($employee->relieving_letter) {
                $this->fileUploadService->removeImage('employee/relieving_letter/', $employee->relieving_letter);
            }
            $filename = $this->fileUploadService->uploadImage('employee/relieving_letter/', $request->file('relieving_letter'));
            $employee->relieving_letter = $filename;
        }
        if ($request->hasFile('offer_letter')) {
            if ($employee->offer_letter) {
                $this->fileUploadService->removeImage('employee/offer_letter/', $employee->offer_letter);
            }
            $filename = $this->fileUploadService->uploadImage('employee/offer_letter/', $request->file('offer_letter'));
            $employee->offer_letter = $filename;
        }
        if ($request->hasFile('salary_slip')) {
            if ($employee->salary_slip) {
                $this->fileUploadService->removeImage('employee/salary_slip/', $employee->salary_slip);
            }
            $filename = $this->fileUploadService->uploadImage('employee/salary_slip/', $request->file('salary_slip'));
            $employee->salary_slip = $filename;
        }
        if ($request->hasFile('bank_statement')) {
            if ($employee->bank_statement) {
                $this->fileUploadService->removeImage('employee/bank_statement/', $employee->bank_statement);
            }
            $filename = $this->fileUploadService->uploadImage('employee/bank_statement/', $request->file('bank_statement'));
            $employee->bank_statement = $filename;
        }
        if ($request->hasFile('character_certificate')) {
            if ($employee->character_certificate) {
                $this->fileUploadService->removeImage('employee/character_certificate/', $employee->character_certificate);
            }
            $filename = $this->fileUploadService->uploadImage('employee/character_certificate/', $request->file('character_certificate'));
            $employee->character_certificate = $filename;
        }
        if ($request->hasFile('medical_certificate')) {
            if ($employee->medical_certificate) {
                $this->fileUploadService->removeImage('employee/medical_certificate/', $employee->medical_certificate);
            }
            $filename = $this->fileUploadService->uploadImage('employee/medical_certificate/', $request->file('medical_certificate'));
            $employee->medical_certificate = $filename;
        }

        // Save updated employee data
        // return $employee;
        $employee->save();

        // Redirect with success message
        return redirect()->route('employee.index')->with(['message' => 'Employee updated successfully.', 'alert-type' => 'success']);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $employee = User::findOrFail($id);

            $imageFields = [
                'medical_certificate' => 'employee/medical_certificate/',
                'character_certificate' => 'employee/character_certificate/',
                'bank_statement' => 'employee/bank_statement/',
                'salary_slip' => 'employee/salary_slip/',
                'offer_letter' => 'employee/offer_letter/',
                'relieving_letter' => 'employee/relieving_letter/',
                'experience_letter' => 'employee/experience_letter/',
                'graduation_certificate' => 'employee/graduation_certificate/',
                'intermediate_certificate' => 'employee/intermediate_certificate/',
                'high_school_certificate' => 'employee/high_school_certificate/',
            ];

            // Delete the vendor
            $employee->delete();

            // Remove associated images
            foreach ($imageFields as $field => $path) {
                $image = $employee->$field; // Get the image name from the vendor object
                if ($image) {
                    $this->fileUploadService->removeImage($path, $image);
                }
            }

            return redirect(route('employee.index'))->with(['message' => 'Deleted Successfully', 'alert-type' => 'success']);

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
