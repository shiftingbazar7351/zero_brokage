<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
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
        $view = view('role-permission.form-permission')->render();
        return response()->json(['data' =>  $view, 'status' => true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);
        try {
            $modifiedTitle = strtolower(str_replace(' ', '-', $request->title));
            Permission::create(['title' => $request->title, 'name' => $modifiedTitle]);
            return back()->with(['message' => 'Permission Added Successfully','alert-type'=>'success']);

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
        $data = DB::table('permissions')->where('id', $id)->first();
        $view = view('role-permission.edit-form-permission', compact('data'))->render();
        return response()->json(['data' =>  $view, 'status' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        try {
            $modifiedTitle = strtolower(str_replace(' ', '-', $request->title));
            $role = Permission::findOrFail($id)->update(['title' => $request->title, 'name' => $modifiedTitle]);
            return back()->with(['message' => 'Permission updated successfully.','alert-type'=>'success']);

        } catch (Exception $e) {
            return back()->with('error', 'SomeThing Went Wrong');
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
        $deleted = DB::table('permissions')->where('id', $id)->delete();
        if ($deleted) {
            return response()->json(['status' => true, 'message' => 'Permission deleted successfully'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Permission not found or not deleted'], 404);
        }
    }
}
