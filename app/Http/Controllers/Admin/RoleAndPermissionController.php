<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.user.role._table', compact('roles'));
    }

    public function add()
    {
        $permissions = Permission::all();
        return view('admin.user.role._create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'role_name'   => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        // Create the new role
        $role = Role::create([
            'name' => 'editor',
            'guard_name' => 'admin',
        ]);

        // Assign selected permissions to the role
        if (!empty($validatedData['permissions'])) {
            $role->syncPermissions($validatedData['permissions']);
        }

        // Redirect with success message
        return redirect()->route('admin.user.roles.index')
                        ->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        try {
            // Find the role or throw a ModelNotFoundException if not found
            $role = Role::findOrFail($id);

            // Get all available permissions
            $permissions = Permission::all();

            // Return the edit view with the role and permissions data
            return view('admin.user.role._edit', compact('role', 'permissions'));
        } catch (ModelNotFoundException $e) {
            // Handle case where the role is not found
            return redirect()->route('admin.user.roles.index')->with('error', 'Role not found.');
        } catch (\Exception $e) {
            // Handle unexpected errors
            return redirect()->route('admin.user.roles.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'role_name'   => 'required|string|max:255|unique:roles,name,' . $id,
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        try {
            $role = Role::findOrFail($id);
            $role->update(['name' => $validatedData['role_name']]);

            // Sync permissions
            $role->syncPermissions($validatedData['permissions']);

            return redirect()->route('admin.user.roles.index')->with('success', 'Role updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.user.roles.index')->with('error', 'Role not found.');
        } catch (\Exception $e) {
            return redirect()->route('admin.user.roles.index')->with('error', 'Failed to update role: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Find the role or throw a ModelNotFoundException
            $role = Role::findOrFail($id);

            // Delete the role
            $role->delete();

            // Redirect back with a success message
            return back()->with('success', 'Role deleted successfully.');
        } catch (ModelNotFoundException $e) {
            // Handle case where the role is not found
            return back()->with('error', 'Role not found.');
        } catch (\Exception $e) {
            // Handle any other exceptions
            return back()->with('error', 'Failed to delete role: ' . $e->getMessage());
        }
    }

    public function p_index()
    {
        $permissions = Permission::get();
        return view('admin.user.permission._table', compact('permissions'));
    }

    public function p_add()
    {
        return view('admin.user.permission._create');
    }

    public function p_store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'permission_name' => 'required|string|max:255|unique:permissions,name', // Correct table name
        ]);

        try {
            // Create the new permission
            Permission::create([
                'name' => $validatedData['permission_name'], // Use validated data
                'guard_name' => 'admin',
            ]);

            // Redirect with success message
            return redirect()->route('admin.user.permissions.index')
                            ->with('success', 'Permission created successfully.');
        } catch (\Exception $e) {
            // Redirect with error message
            return redirect()->route('admin.user.permissions.index')
                            ->with('error', 'Failed to create permission: ' . $e->getMessage());
        }
    }

    public function p_destroy($id)
    {
        try {
            $permission = Permission::findOrFail($id); // Use findOrFail for better error handling
            $permission->delete();

            // Redirect with success message
            return back()->with('success', 'Permission deleted successfully.');
        } catch (ModelNotFoundException $e) {
            // Handle case where the permission is not found
            return back()->with('error', 'Permission not found.');
        } catch (\Exception $e) {
            // Handle other exceptions
            return back()->with('error', 'Failed to delete permission: ' . $e->getMessage());
        }
    }

}
