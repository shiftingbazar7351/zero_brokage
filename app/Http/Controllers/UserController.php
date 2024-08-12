<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Helpers\AuthHelper;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roles = Role::where('status', 1)->where('name','!=','super_admin')->get()->pluck('title', 'id');
        // return view('users.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all());
        $user->assignRole($request->user_role ?? 'user');
        if ($request->hasFile('profile_picture')) {
            $filename = $this->fileUploadService->uploadImage('images/user/', $request->file('profile_picture'));
            $user->update(['profile_picture'=>$filename]);
        }
        return redirect()->route('user.index')->withSuccess(trans('users.store', ['name' => __('users.store')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::with('userProfile', 'roles')->findOrFail($id);

        $profileImage = getSingleMedia($data, 'profile_image');

        $user = User::where('id', Auth::user()->id)->first();

        return view('users.profile', compact('data', 'profileImage', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles =null;
       $data = User::with('roles')->findOrFail($id);

        $data['user_type'] = $data->roles->pluck('id')[0] ?? null;
        if($id != auth()->user()->id){
            $roles = Role::where('status', 1)->where('name','!=','super_admin')->get()->pluck('title', 'id');
        }
        if($data && $data->profile_picture){
            $profileImage =config('app.url').$data->profile_picture;
        }else{
            $profileImage = getSingleMedia($data, 'profile_image');
        }
        return view('users.form', compact('data', 'id', 'roles', 'profileImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::with('userProfile')->findOrFail($id);

        $role = Role::find($request->user_role);
        if($role){
            $user->assignRole($role->name);
        }
        $user->fill($request->except('profile_picture'))->save();
        if ($request->hasFile('profile_picture')) {
            $filename = $this->fileUploadService->uploadImage('images/user/', $request->file('profile_picture'));
             $this->fileUploadService->removeImage('images/user/', $user->profile_picture);
            $user->update(['profile_picture' => $filename]);
        }
        // Redirect the user back to the appropriate route with a success message
        if (auth()->check()) {
            return redirect()->route('user.index')->withSuccess(trans('users.update', ['name' => __('message.user')]));
        }

        return redirect()->back()->withSuccess(trans('users.update', ['name' => 'My Profile']));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $status = 'errors';
        $message = __('global-message.delete_form', ['form' => __('users.title')]);

        if ($user != '') {
            $user->delete();
            $status = 'success';
            $message = __('global-message.delete_form', ['form' => __('users.title')]);
        }

        if (request()->ajax()) {
            return response()->json(['status' => true, 'message' => $message, 'datatable_reload' => 'dataTable_wrapper']);
        }

        return redirect()->back()->with($status, $message);
    }


}
