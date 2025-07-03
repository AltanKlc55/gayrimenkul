<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\User;
use Modules\Admin\Entities\Permissions;
use Modules\Admin\Entities\Roles;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();

       // User::factory()->count(1)->create();
        $admin_permision = [
            [
                'name' => "View",
                'group' => "Admin",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "admin.index",
                'status' => 0,
            ],
            [
                'name' => "Table",
                'group' => "Admin",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "admin.show",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Admin",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "admin.create",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Admin",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "admin.store",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Admin",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "admin.edit",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Admin",
                'group_control' => "update",
                'guard_name' => "web",
                'module' => "admin.update",
                'status' => 0,
            ],
            [
                'name' => "Delete",
                'group' => "Admin",
                'group_control' => "destroy",
                'guard_name' => "web",
                'module' => "admin.destroy",
                'status' => 0,
            ],
        ];
        foreach ($admin_permision as $row){
            Permissions::create($row);
        }

        // Roles          View  - Edit - Add - Delete
        $roles_permision = [
            [
                'name' => "View",
                'group' => "Roles",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "roles.index",
                'status' => 0,
            ],
            [
                'name' => "Table",
                'group' => "Roles",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "roles.show",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Roles",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "roles.create",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Roles",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "roles.store",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Roles",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "roles.edit",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Roles",
                'group_control' => "update",
                'guard_name' => "web",
                'module' => "roles.update",
                'status' => 0,
            ],
            [
                'name' => "Delete",
                'group' => "Roles",
                'group_control' => "destroy",
                'guard_name' => "web",
                'module' => "roles.destroy",
                'status' => 0,
            ],
        ];
        foreach ($roles_permision as $Rol){
            Permissions::create($Rol);
        }


    }
}