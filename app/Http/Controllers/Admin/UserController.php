<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function add()
    {

        $roles = Role::all();

        // Pass data to the view
        return view('admin.user._add', compact('roles'));
    }

    public function index()
    {
        $users = Admin::with('roles')->get();
        // $user = App\Models\User::find(1); // Replace with your user ID
        // $user->assignRole('Admin'); // Replace 'Admin' with an actual role name

        // Check if the role was assigned
        // dd($users->roles);
        return view('admin.user._table', compact('users'));
    }




    public function edit($id)
    {
        // Find the user by ID
        $user = Admin::findOrFail($id);

        // Get all roles to display in the dropdown
        $roles = Role::all();

        // Pass data to the view
        return view('admin.user._edit', compact('user', 'roles'));
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:active,inactive',
            'roles' => 'required|array',  // Ensure roles are selected
        ]);

        // Find the user
        $user = new Admin();

        // Update basic details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;
        $user->date_of_birth = $request->dob;
        $user->status = $request->status;
        $user->password = Hash::make('password123');
        $user->created_by = auth('admin')->user()->id;

        // Handle profile photo upload if exists
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if it exists
            if ($user->profile_photo && Storage::exists('public/uploads/profile_photos/'.$user->profile_photo)) {
                Storage::delete('public/uploads/profile_photos/'.$user->profile_photo);
            }

            // Upload new profile photo
            $path = $request->file('profile_photo')->store('uploads/profile_photos', 'public');
            $user->profile_photo = $path;
        }
        // dd($request->roles);
        // Sync the roles selected by the user
        $user->syncRoles($request->roles);

        // Save user data
        $user->save();

        // Redirect with success message
        return redirect()->route('admin.user.index')->with('success', 'User Created successfully.');
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:active,inactive',
            'roles' => 'required|array',  // Ensure roles are selected
        ]);

        // Find the user
        $user = Admin::findOrFail($id);

        // Update basic details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;
        $user->date_of_birth = $request->dob;
        $user->status = $request->status;

        // Handle profile photo upload if exists
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if it exists
            if ($user->profile_photo && Storage::exists('public/uploads/profile_photos/'.$user->profile_photo)) {
                Storage::delete('public/uploads/profile_photos/'.$user->profile_photo);
            }

            // Upload new profile photo
            $path = $request->file('profile_photo')->store('uploads/profile_photos', 'public');
            $user->profile_photo = $path;
        }
        // dd($request->roles);
        // Sync the roles selected by the user
        $user->syncRoles($request->roles);

        // Save user data
        $user->save();

        // Redirect with success message
        return redirect()->route('admin.user.index')->with('success', 'User updated successfully.');
    }

    public function profileUpdate(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'linkdin' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'biography' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Find the user by ID
            $user = Admin::findOrFail(auth('admin')->user()->id);

            // Update user details
            $user->name = $request->name;
            $user->date_of_birth = $request->dob;
            $user->gender = $request->gender;
            $user->email = $request->email;
            $user->phone_number = $request->phone;
            $user->details()->updateOrCreate(
                [],
                [
                    'address' => $request->address,
                    'twitter' => $request->twitter,
                    'facebook' => $request->facebook,
                    'linkdin' => $request->linkdin,
                    'github' => $request->github,
                    'biography' => $request->biography,
                ]
            );

            // Save user data
            $user->save();

            // Return success response
            return response()->json(['message' => 'Profile updated successfully.']);
        } catch (\Exception $e) {
            // dd($e);
            // Return error response
            return response()->json(['error' => 'An error occurred while updating the profile.'], 500);
        }
    }

    public function profile()
    {
        // Find the user by ID
        $user = Admin::with('details')->findOrFail(auth('admin')->user()->id);

        // Get all roles to display in the dropdown
        $roles = Role::all();
        $data = [
            'news_count' => News::where('created_by', $user->id)->isActive()->count()
        ];
        // dd($data);
        // Pass data to the view
        return view('admin.user._profile', compact('user', 'roles','data'));
    }

    public function assignRolesIfEmpty()
    {
        // Get the user (replace 1 with the actual user ID)
        $user = User::find(1);

        if (!$user) {
            return "User not found.";
        }

        // Check if the user has roles
        if ($user->roles->isEmpty()) {
            // Assign a role if none exists
            $roleName = 'Admin'; // Replace 'Admin' with the role name you want to assign

            // Ensure the role exists in the database
            $role = Role::where('name', $roleName)->first();

            if (!$role) {
                return "Role '$roleName' does not exist.";
            }

            // Assign the role to the user
            $user->assignRole($roleName);

            return "Role '$roleName' assigned to user {$user->name}.";
        }

        return "User {$user->name} already has roles assigned: " . $user->roles->pluck('name')->join(', ');
    }
}
