<?php

namespace Modules\Content\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Permissions;
use Modules\Admin\Entities\Roles;
class ContentDatabaseSeeder extends Seeder
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
                'group' => "Content",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "content.index",
                'status' => 0,
            ],
            [
                'name' => "Table",
                'group' => "Content",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "content.show",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Content",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "content.create",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Content",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "content.store",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Content",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "content.edit",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Content",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "content.update",
                'status' => 0,
            ],
            [
                'name' => "Delete",
                'group' => "Content",
                'group_control' => "destroy",
                'guard_name' => "web",
                'module' => "content.destroy",
                'status' => 0,
            ],
        ];
        foreach ($permision as $row){
            Permissions::create($row);
        }
    }
}