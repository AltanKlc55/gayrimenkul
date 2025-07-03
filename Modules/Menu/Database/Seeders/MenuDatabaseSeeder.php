<?php

namespace Modules\Menu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Permissions;
use Modules\Admin\Entities\Roles;
class MenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permision = [
            [
                'name' => "View",
                'group' => "Menu",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "menu.index",
                'status' => 0,
            ],
            [
                'name' => "Table",
                'group' => "Menu",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "menu.show",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Menu",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "menu.create",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Menu",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "menu.store",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Menu",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "menu.edit",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Menu",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "menu.update",
                'status' => 0,
            ],
            [
                'name' => "Delete",
                'group' => "Menu",
                'group_control' => "destroy",
                'guard_name' => "web",
                'module' => "menu.destroy",
                'status' => 0,
            ],
        ];
        foreach ($permision as $row){
            Permissions::create($row);
        }
    }
}