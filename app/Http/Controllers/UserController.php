<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Helpers\AuthHelper;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\FileUploadService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

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
        $users = User::orderByDesc('created_at')->get();
        $roles = Role::orderByDesc('created_at')->get();
        return view('backend.user.index', compact('users', 'roles'));
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
    // public function store(Request $request)
    // {
    //     // Validate the request data
    //     $validated = $request->validate([
    //         'name' => 'required|max:20',
    //         'email' => 'required|email|max:100|unique:users,email',
    //         'phone_number' => 'required|digits:10',
    //         'user_type' => 'required',
    //     ]);

    //     try {
    //         // Generate password: Capitalize first name and append '123'
    //         $firstName = explode(' ', $validated['name'])[0]; // Get the first name from the full name
    //         $passwordString = ucfirst(strtolower($firstName)) . '@123'; // First letter capitalized, then '123'
    //         $hashedPassword = Hash::make($passwordString); // Hash the generated password

    //         // Create new user
    //         $user = new User();
    //         $user->name = $validated['name'];
    //         $user->email = $validated['email'];
    //         $user->password = $hashedPassword;
    //         $user->phone_number = $validated['phone_number'];
    //         $user->user_type = $validated['user_type'];
    //         $user->created_by = Auth::user()->id;
    //         $user->status = 1;
    //         $user->save();

    //         // Send email with the credentials
    //         $toUser = $validated['email'];
    //         $subject = 'ZERO BROKAGE LOGIN CREDENTIAL';

    //         Mail::send('emails.user-credential', ['email' => $validated['email'], 'password' => $passwordString], function ($message) use ($toUser, $subject) {
    //             $message->to($toUser)
    //                 ->subject($subject);
    //         });

    //         // Return JSON success response with redirect URL
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'User Added Successfully !!',
    //             'redirectUrl' => route('user.index') // URL to redirect after success
    //         ]);

    //     } catch (Exception $e) {
    //         // Log error and return JSON error response
    //         Log::error('User creation error: ' . $e->getMessage());
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An error occurred while creating the user: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email|max:100|unique:users,email',
            'phone_number' => 'required|digits:10',
            'user_type' => 'required',
        ]);

        try {
            // Generate password: Capitalize first name and append '123'
            $firstName = explode(' ', $validated['name'])[0]; // Get the first name from the full name
            $passwordString = ucfirst(strtolower($firstName)) . '@123'; // First letter capitalized, then '123'
            $hashedPassword = Hash::make($passwordString); // Hash the generated password

            // Create new user
            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->password = $hashedPassword;
            $user->phone_number = $validated['phone_number'];
            $user->user_type = $validated['user_type'];
            $user->created_by = Auth::user()->id;
            $user->status = 1;
            $user->save();

            // Send email with the credentials
            $toUser = $validated['email'];
            $subject = 'ZERO BROKAGE LOGIN CREDENTIAL';


            session()->flash('message', 'User Added Successfully ');
            session()->flash('alert-type', 'Success ');


            Mail::send('emails.user-credential', ['email' => $validated['email'], 'password' => $passwordString], function ($message) use ($toUser, $subject) {
                $message->to($toUser)
                    ->subject($subject);
            });
            // Return JSON success response with redirect URL
            return response()->json([
                'success' => true,
                'message' => 'User Added Successfully !!',
                'redirectUrl' => route('user.index') // URL to redirect after success
            ]);

        } catch (Exception $e) {
            // Log error and return JSON error response
            Log::error('User creation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the user: ' . $e->getMessage()
            ], 500);
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
        $roles = null;
        $data = User::with('roles')->findOrFail($id);

        $data['user_type'] = $data->roles->pluck('id')[0] ?? null;
        if ($id != auth()->user()->id) {
            $roles = Role::where('status', 1)->where('name', '!=', 'super_admin')->get()->pluck('title', 'id');
        }
        if ($data && $data->profile_picture) {
            $profileImage = config('app.url') . $data->profile_picture;
        } else {
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
        if ($role) {
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
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User Deleted Successfully');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }


}
