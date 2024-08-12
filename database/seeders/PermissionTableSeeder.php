<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'role', 'title' => 'Role', 'guard_name' => 'web'],
            ['name' => 'role-add', 'title' => 'Role Add', 'guard_name' => 'web'],
            ['name' => 'role-list', 'title' => 'Role List', 'guard_name' => 'web'],
            ['name' => 'permission', 'title' => 'Permission', 'guard_name' => 'web'],
            ['name' => 'permission-add', 'title' => 'Permission Add', 'guard_name' => 'web'],
            ['name' => 'permission-list', 'title' => 'Permission List', 'guard_name' => 'web'],
            ['name' => 'user-list', 'title' => 'User List', 'guard_name' => 'web'],
            ['name' => 'user-create', 'title' => 'User Create', 'guard_name' => 'web'],
            ['name' => 'user-edit', 'title' => 'User Edit', 'guard_name' => 'web'],
            ['name' => 'user-delete', 'title' => 'User Delete', 'guard_name' => 'web'],
            ['name' => 'user-show', 'title' => 'User Show', 'guard_name' => 'web'],


            ['name' => 'category-list', 'title' => 'category List', 'guard_name' => 'web'],
            ['name' => 'category-create', 'title' => 'category Create', 'guard_name' => 'web'],
            ['name' => 'category-edit', 'title' => 'category Edit', 'guard_name' => 'web'],
            ['name' => 'category-delete', 'title' => 'category Delete', 'guard_name' => 'web'],
            ['name' => 'category-show', 'title' => 'category Show', 'guard_name' => 'web'],

        ];
        Permission::insert($permissions);
    }
}
