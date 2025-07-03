<?php

namespace Modules\Bill\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Permissions;
use Modules\Admin\Entities\Roles;
class BillDatabaseSeeder extends Seeder
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
                'group' => "Bill",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "bill.index",
                'status' => 0,
            ],
            [
                'name' => "Table",
                'group' => "Bill",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "bill.show",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Bill",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "bill.create",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Bill",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "bill.store",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Bill",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "bill.edit",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Bill",
                'group_control' => "update",
                'guard_name' => "web",
                'module' => "bill.update",
                'status' => 0,
            ],
            [
                'name' => "Delete",
                'group' => "Bill",
                'group_control' => "destroy",
                'guard_name' => "web",
                'module' => "bill.destroy",
                'status' => 0,
            ],
        ];
        foreach ($permision as $row){
            Permissions::create($row);
        }
    }
}
