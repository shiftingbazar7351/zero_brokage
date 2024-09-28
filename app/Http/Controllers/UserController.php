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
use Illuminate\Support\Facades\Storage;
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
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter based on search query
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

        // Apply user_type filter and paginate the results
        $users = $query->where('user_type', '!=', 1)->paginate(10);

        // Check if it's an AJAX request
        if ($request->ajax()) {
            return view('backend.user.partials.users_list', compact('users'))->render();
        }

        // Fetch roles that are not 'super_admin'
        $roles = Role::where('name', '!=', 'super_admin')->orderByDesc('created_at')->get();

        return view('backend.user.index', compact('users', 'roles'));
    }


    /**
     * Show the form for creating a new resource.
     *
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
     */


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
     */
    public function show($id)
    {
        // $data = User::with('userProfile', 'roles')->findOrFail($id);

        // $profileImage = getSingleMedia($data, 'profile_image');

        // $user = User::where('id', Auth::user()->id)->first();

        // return view('users.profile', compact('data', 'profileImage', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user); // Return user data as JSON
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lname' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone_number' => 'nullable|string|max:15',
            'current_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $user = Auth::user();

        // Update user information
        $user->name = $request->name;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->current_address = $request->current_address;
        $user->permanent_address = $request->permanent_address;

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $filename = $this->fileUploadService->uploadImage('profile_picture/', $request->file('profile_picture'));
            $user->profile_picture = $filename;
        }


        $user->save();

        return redirect()->back()->with(['message' => 'profile updated successfully', 'alert-type' => 'success']);
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
    public function userStatus(Request $request)
    {
        $item = User::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();
            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }

    public function profile()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('backend.profile', compact('user'));
    }


}
