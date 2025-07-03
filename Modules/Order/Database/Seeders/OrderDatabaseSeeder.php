<?php

namespace Modules\Order\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Permissions;
use Modules\Admin\Entities\Roles;
class OrderDatabaseSeeder extends Seeder
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
                'group' => "Order",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "order.index",
                'status' => 0,
            ],
            [
                'name' => "Table",
                'group' => "Order",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "order.show",
                'status' => 0,
            ],

            [
                'name' => "Edit",
                'group' => "Order",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "order.edit",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Order",
                'group_control' => "update",
                'guard_name' => "web",
                'module' => "order.update",
                'status' => 0,
            ],
            [
                'name' => "Delete",
                'group' => "Order",
                'group_control' => "destroy",
                'guard_name' => "web",
                'module' => "order.destroy",
                'status' => 0,
            ],
        ];
        foreach ($permision as $row){
            Permissions::create($row);
        }
    }
}
