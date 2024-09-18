<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'super_admin',
                'title' => 'Super Admin',
                'status' => 1,
                'permissions' => [
                    'role',
                    'role-add',
                    'role-list',
                    'permission',
                    'permission-add',
                    'permission-list' .
                    'user-list',
                    'user-create',
                    'user-edit',
                    'user-delete',
                    'user-show',
                    'user-status'
                ]
            ],
        ];

        foreach ($roles as $key => $value) {
            $permission = $value['permissions'];
            unset($value['permissions']);
            $role = Role::create($value);
            $role->givePermissionTo($permission);
        }
    }
}
