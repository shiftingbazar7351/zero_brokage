<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //code here
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $view = view('role-permission.form-role')->render();
        return response()->json(['data' =>  $view, 'status' => true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status'=>'required'
        ]);
        try {
            $modifiedTitle = strtolower(str_replace(' ', '_', $request->title));
            Role::create(['title' => $request->title, 'name' => $modifiedTitle, 'status' => $request->status]);
            return back()->with('success', 'Role Added Successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //code here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('roles')->where('id', $id)->first();
        $view = view('role-permission.edit-form-role', compact('data'))->render();
        return response()->json(['data' =>  $view, 'status' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
        try {
            $modifiedTitle = strtolower(str_replace(' ', '_', $request->title));
            $role = Role::findOrFail($id)->update(['title' => $request->title, 'name' => $modifiedTitle, 'status' => $request->status]);
            return back()->with('success', 'Role updated successfully.');
        } catch (\Exception $e) {
            return  back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = DB::table('roles')->where('id', $id)->delete();
        if ($deleted) {
            return response()->json(['status' => true, 'message' => 'Role deleted successfully'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Role not found or not deleted'], 404);
        }
    }
}
