<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

use Modules\Employee\Entities\CompanyName;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $companies = CompanyName::orderByDesc('created_at')->paginate(10);
        return view('employee::company.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('employee::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([         
            'name' => 'required|unique:company_names|max:255',
        ]);


        $company = new CompanyName();
        $company->name = $request->name;     

        $company->save();

        return response()->json(['success' => true, 'message' => 'company created successfully.']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('employee::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */


    public function edit($id)
    {
        $company = CompanyName::find($id);
        return response()->json(['company' => $company]);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);
    
            // Find the company by ID or fail if not found
            $company = CompanyName::findOrFail($id);
    
            // Update the company record with validated data
            $company->update($validatedData);
    
            // Return a JSON response on success
            return response()->json(['success' => true, 'message' => 'Company updated successfully']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors
            return response()->json(['success' => false, 'errors' => $e->errors()]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Return not found error
            return response()->json(['success' => false, 'message' => 'Company not found']);
        } catch (\Exception $e) {
            // Return a general error message
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again.']);
        }
    }
    

    
    
    

    /**
     * Remove the specified company from storage.
     */
    public function destroy($id)
    {
        $company = CompanyName::findOrFail($id);
        $company->delete();

        return redirect()->back()->with('success' , 'Deleted Successfully');
    }
}
