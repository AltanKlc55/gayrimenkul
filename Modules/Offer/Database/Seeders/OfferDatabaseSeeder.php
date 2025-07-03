<?php

namespace Modules\Offer\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Permissions;
use Modules\Admin\Entities\Roles;
class OfferDatabaseSeeder extends Seeder
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
                'group' => "Offer",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "offer.index",
                'status' => 0,
            ],
            [
                'name' => "Table",
                'group' => "Offer",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "offer.show",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Offer",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "offer.create",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Offer",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "offer.store",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Offer",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "offer.edit",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Offer",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "offer.update",
                'status' => 0,
            ],
            [
                'name' => "Delete",
                'group' => "Offer",
                'group_control' => "destroy",
                'guard_name' => "web",
                'module' => "offer.destroy",
                'status' => 0,
            ],
        ];
        foreach ($permision as $row){
            Permissions::create($row);
        }
    }
}
