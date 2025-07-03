<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Permissions;
use Modules\Admin\Entities\Roles;
class ProductDatabaseSeeder extends Seeder
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
                'group' => "Product",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "product.index",
                'status' => 0,
            ],
            [
                'name' => "Table",
                'group' => "Product",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "product.show",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Product",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "product.create",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Product",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "product.store",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Product",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "product.edit",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Product",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "product.update",
                'status' => 0,
            ],
            [
                'name' => "Delete",
                'group' => "Product",
                'group_control' => "destroy",
                'guard_name' => "web",
                'module' => "product.destroy",
                'status' => 0,
            ],
            [
                'name' => "View",
                'group' => "Product Set",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "productset.index",
                'status' => 0,
            ],
            [
                'name' => "Table",
                'group' => "Product Set",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "productset.show",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Product Set",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "productset.create",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Product Set",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "productset.store",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Product Set",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "productset.edit",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Product Set",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "productset.update",
                'status' => 0,
            ],
            [
                'name' => "Delete",
                'group' => "Product Set",
                'group_control' => "destroy",
                'guard_name' => "web",
                'module' => "productset.destroy",
                'status' => 0,
            ],




            [
                'name' => "Edit",
                'group' => "Product Set",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "productset.create_child",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Product Set",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "productset.edit_child",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Product Set",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "productset.store_child",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Product Set",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "productset.update_child",
                'status' => 0,
            ],    [
                'name' => "Edit",
                'group' => "Product Set",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "productset.show_child",
                'status' => 0,
            ],
            [
                'name' => "Delete",
                'group' => "Product Set",
                'group_control' => "destroy",
                'guard_name' => "web",
                'module' => "productset.destroy_child",
                'status' => 0,
            ],

            [
                'name' => "View",
                'group' => "Create Link",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "createlink.index",
                'status' => 0,
            ],
            [
                'name' => "Table",
                'group' => "Create Link",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "createlink.show",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Create Link",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "createlink.create",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Create Link",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "createlink.store",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Create Link",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "createlink.edit",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Create Link",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "createlink.update",
                'status' => 0,
            ],
            [
                'name' => "Delete",
                'group' => "Create Link",
                'group_control' => "destroy",
                'guard_name' => "web",
                'module' => "createlink.destroy",
                'status' => 0,
            ],
        ];
        foreach ($permision as $row){
            Permissions::create($row);
        }

        // $this->call("OthersTableSeeder");
    }
}