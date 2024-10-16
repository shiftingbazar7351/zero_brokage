<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermission extends Controller
{

    public function index(Request $request)
    {
        dd(1);
        $roles = Role::get();
        $permissions = Permission::get();
        return view('backend.role-permission.permissions', compact('roles', 'permissions'));
    }

    // public function store(Request $request)
    // {
    //     foreach ($request->permission as $roleId => $permissions) {
    //         // Fetch the current permissions from the database for the given role
    //         $currentPermissions = DB::table('role_has_permissions')
    //             ->where('role_id', $roleId)
    //             ->pluck('permission_id')
    //             ->toArray();

    //         // If the count or the permissions themselves differ, update them
    //         if (count($currentPermissions) !== count($permissions) || array_diff($currentPermissions, $permissions)) {
    //             // Delete the old permissions
    //             DB::table('role_has_permissions')
    //                 ->where('role_id', $roleId)
    //                 ->delete();

    //             // Insert the new permissions
    //             $newPermissions = [];
    //             foreach ($permissions as $permissionId) {
    //                 $newPermissions[] = [
    //                     'role_id' => $roleId,
    //                     'permission_id' => $permissionId
    //                 ];
    //             }
    //             DB::table('role_has_permissions')->insert($newPermissions);
    //         }
    //     }

    //     return back()->with(['success' => 'Permissions updated successfully']);
    // }

    public function store(Request $request)
    {
        // Start a transaction to ensure atomicity
        DB::beginTransaction();

        try {
            foreach ($request->permission as $roleId => $permissions) {
                // Fetch the current permissions from the database for the given role
                $currentPermissions = DB::table('role_has_permissions')
                    ->where('role_id', $roleId)
                    ->pluck('permission_id')
                    ->toArray();

                // Calculate permissions to be added and removed
                $newPermissions = array_diff($permissions, $currentPermissions);
                $permissionsToRemove = array_diff($currentPermissions, $permissions);

                // Delete the removed permissions
                if (!empty($permissionsToRemove)) {
                    DB::table('role_has_permissions')
                        ->where('role_id', $roleId)
                        ->whereIn('permission_id', $permissionsToRemove)
                        ->delete();
                }

                // Insert new permissions
                if (!empty($newPermissions)) {
                    $insertData = [];
                    foreach ($newPermissions as $permissionId) {
                        $insertData[] = [
                            'role_id' => $roleId,
                            'permission_id' => $permissionId
                        ];
                    }
                    DB::table('role_has_permissions')->insert($insertData);
                }
            }

            // Commit the transaction
            DB::commit();
            return redirect()->back()->with(['message' => 'Permissions updated successfully','alert-type' => 'success']);
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollback();

            return back()->with(['error' => 'Failed to update permissions']);
        }
    }

}
