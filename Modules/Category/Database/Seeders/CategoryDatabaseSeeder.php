<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Permissions;
use Modules\Admin\Entities\Roles;
class CategoryDatabaseSeeder extends Seeder
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
                'group' => "Category",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "category.index",
                'status' => 0,
            ],
            [
                'name' => "Table",
                'group' => "Category",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "category.show",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Category",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "category.create",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Category",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "category.store",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Category",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "category.edit",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Category",
                'group_control' => "update",
                'guard_name' => "web",
                'module' => "category.update",
                'status' => 0,
            ],
            [
                'name' => "Delete",
                'group' => "Category",
                'group_control' => "destroy",
                'guard_name' => "web",
                'module' => "category.destroy",
                'status' => 0,
            ],
        ];
        foreach ($permision as $row){
            Permissions::create($row);
        }

        // $this->call("OthersTableSeeder");
    }
}