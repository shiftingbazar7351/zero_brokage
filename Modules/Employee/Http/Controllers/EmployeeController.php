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
use Illuminate\Support\Facades\Mail;
use Modules\Employee\Entities\Companie;
use Modules\Employee\Entities\HrName;
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

        $hr_names = HrName::where('status', 1)->where('designation', 'HR Head')->get();
        $hr_exe = HrName::where('status', 1)->where('designation', 'HR Executive')->get();
        $companies = Companie::where('status', 1)->get();
        return view('employee::employee.create', compact('roles', 'companies', 'hr_names', 'hr_exe'));
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
            'email' => 'nullable|email|unique:employees,email',
            // 'user_type' => 'nullable|string|max:191',
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

        try {
            // Format the designation for the role name and title
            $designation = $validatedData['designation'];
            $roleName = strtolower(str_replace(' ', '_', $designation)); // e.g., "frontend_developer"
            $roleTitle = $designation; // e.g., "Frontend Developer"

            // Check if the designation exists in the roles table
            $role = Role::firstOrCreate(
                ['name' => $roleName],
                ['title' => $roleTitle]
            );

            // Generate a password: Capitalize first name and append '123'
            $firstName = explode(' ', $validatedData['name'])[0]; // Get the first name from the full name
            $passwordString = ucfirst(strtolower($firstName)) . '@123'; // First letter capitalized, then '123'
            $hashedPassword = Hash::make($passwordString); // Hash the generated password

            $employmentCode = $this->generateEmploymentCode();
            // Create the employee with validated data
            $employee = new User();
            $employee->fill($validatedData);
            $employee->password = $hashedPassword;
            $employee->user_type = $role->id;
            $employee->employee_code = $employmentCode;
            $employee->status = 1;
            $employee->created_by = auth()->user()->id;
            $employee->save();

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

            // Send email with the credentials
            $toUser = $validatedData['email'];
            $subject = 'Employee Account Credentials';

            Mail::send('emails.user-credential', [
                'email' => $validatedData['email'],
                'password' => $passwordString
            ], function ($message) use ($toUser, $subject) {
                $message->to($toUser)
                    ->subject($subject);
            });

            // Redirect with success message
            return redirect()->route('employee.index')->with(['message' => 'Employee created and credentials sent successfully.', 'alert-type' => 'success']);

        } catch (Exception $e) {
            // Log error and return with error message
            Log::error('Employee creation error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the employee: ' . $e->getMessage()]);
        }
    }

    private function generateEmploymentCode()
    {
        $prefix = 'ZBE';
        $datePart = '150820'; // Fixed date part as per your requirement

        // Get the last employee to find the highest employment code
        $lastEmployee = User::where('employee_code', 'LIKE', $prefix . $datePart . '%')
                            ->orderBy('employee_code', 'desc')
                            ->first();

        if ($lastEmployee) {
            // Extract the numeric part of the last employment code
            $lastCodeNumber = intval(substr($lastEmployee->employee_code, -1)); // Get the last digit
            $newCodeNumber = $lastCodeNumber + 1; // Increment the code number
        } else {
            $newCodeNumber = 1; // Start from 1 if no employees exist
        }

        // Format the new employment code with the incremented number
        return $prefix . $datePart . $newCodeNumber; // No need for padding since we are using a single digit for the increment
    }





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
        $roles = Role::get();
        $hr_names = HrName::where('status', 1)->where('designation', 'HR Head')->get();
        $hr_exe = HrName::where('status', 1)->where('designation', 'HR Executive')->get();
        return view('employee::employee.edit', compact('employee', 'roles', 'hr_names', 'hr_exe'));
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
            'name' => 'required|string|max:191',
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
