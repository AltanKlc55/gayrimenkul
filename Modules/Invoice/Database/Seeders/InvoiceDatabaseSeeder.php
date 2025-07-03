<?php

namespace Modules\Invoice\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Permissions;
use Modules\Admin\Entities\Roles;
class InvoiceDatabaseSeeder extends Seeder
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
                'group' => "Invoice",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "invoice.index",
                'status' => 0,
            ],
            [
                'name' => "Table",
                'group' => "Invoice",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "invoice.show",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Invoice",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "invoice.create",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Invoice",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "invoice.store",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Invoice",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "invoice.edit",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Invoice",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "invoice.update",
                'status' => 0,
            ],
            [
                'name' => "Delete",
                'group' => "Invoice",
                'group_control' => "destroy",
                'guard_name' => "web",
                'module' => "invoice.destroy",
                'status' => 0,
            ],
        ];
        foreach ($permision as $row){
            Permissions::create($row);
        }
    }
}
