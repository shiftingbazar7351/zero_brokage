<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\Employee\Entities\Employees;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\FileUploadService;
use Validator;
use Exception;

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
    public function index()
    {
        $employees = Employees::orderByDesc('created_at')->paginate(10);
        return view('employee::employee.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('employee::employee.create');
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
            'fname' => 'required|string|max:191',
            'lname' => 'required|string|max:191',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'email' => 'required|email|unique:employees,email',
            'role' => 'nullable|string|max:191',
            'password' => 'required|string|min:8',
            'country' => 'nullable|string|max:191',
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
            'character_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'medical_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'previous_ref_name' => 'nullable|string|max:191',
            'previous_ref_email' => 'nullable|email|max:191',
            'previous_ref_number' => 'nullable|string|max:191',
            'previous_ref_designation' => 'nullable|string|max:191',
        ]);

        // Create a new employee
        $employee = Employees::create( $validatedData);

        // Set created_by to the current authenticated user
        $employee->created_by = auth()->user()->id;

        // Handle file uploads
        if ($request->hasFile('high_school_certificate')) {
            $filename = $this->fileUploadService->uploadImage('employee/high_school_certificate/', $request->file('high_school_certificate'));
            $employee->high_school_certificate = $filename;
        }
        if ($request->hasFile('intermediate_certificate')) {
            $filename = $this->fileUploadService->uploadImage('employee/intermediate_certificate/', $request->file('intermediate_certificate'));
            $employee->intermediate_certificate = $filename;
        }
        if ($request->hasFile('graduation_certificate')) {
            $filename = $this->fileUploadService->uploadImage('employee/graduation_certificate/', $request->file('graduation_certificate'));
            $employee->graduation_certificate = $filename;
        }

        if ($request->hasFile('experience_letter')) {
            $filename = $this->fileUploadService->uploadImage('employee/experience_letter/', $request->file('experience_letter'));
            $employee->experience_letter = $filename;
        }
        if ($request->hasFile('relieving_letter')) {
            $filename = $this->fileUploadService->uploadImage('employee/relieving_letter/', $request->file('relieving_letter'));
            $employee->relieving_letter = $filename;
        }
        if ($request->hasFile('offer_letter')) {
            $filename = $this->fileUploadService->uploadImage('employee/offer_letter/', $request->file('offer_letter'));
            $employee->offer_letter = $filename;
        }
        if ($request->hasFile('salary_slip')) {
            $filename = $this->fileUploadService->uploadImage('employee/salary_slip/', $request->file('salary_slip'));
            $employee->salary_slip = $filename;
        }
        if ($request->hasFile('bank_statement')) {
            $filename = $this->fileUploadService->uploadImage('employee/bank_statement/', $request->file('bank_statement'));
            $employee->bank_statement = $filename;
        }
        if ($request->hasFile('character_certificate')) {
            $filename = $this->fileUploadService->uploadImage('employee/character_certificate/', $request->file('character_certificate'));
            $employee->character_certificate = $filename;
        }
        if ($request->hasFile('medical_certificate')) {
            $filename = $this->fileUploadService->uploadImage('employee/medical_certificate/', $request->file('medical_certificate'));
            $employee->medical_certificate = $filename;
        }

        $employee->save();

        // Redirect with success message
        return redirect()->route('employee.index')->with(['message'=> 'Employee created successfully.','alert-type'=>'success']);
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
        $employee = Employees::findOrFail($id);
        return view('employee::employee.edit',compact('employee'));
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
            'role' => 'nullable|string|max:191',
            'password' => 'required|string|min:8',
            'country' => 'nullable|string|max:191',
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

        $employee = Employees::findOrFail($id);

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
            $employee = Employees::findOrFail($id);

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
