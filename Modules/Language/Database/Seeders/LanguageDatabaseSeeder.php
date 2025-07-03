<?php

namespace Modules\Language\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Permissions;
use Modules\Admin\Entities\Roles;
class LanguageDatabaseSeeder extends Seeder
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
                'group' => "Language",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "language.index",
                'status' => 0,
            ],
            [
                'name' => "Table",
                'group' => "Language",
                'group_control' => "show",
                'guard_name' => "web",
                'module' => "language.show",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Language",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "language.create",
                'status' => 0,
            ],
            [
                'name' => "Add",
                'group' => "Language",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "language.store",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Language",
                'group_control' => "edit",
                'guard_name' => "web",
                'module' => "language.edit",
                'status' => 0,
            ],
            [
                'name' => "Edit",
                'group' => "Language",
                'group_control' => "update",
                'guard_name' => "web",
                'module' => "language.update",
                'status' => 0,
            ],
            [
                'name' => "Delete",
                'group' => "Language",
                'group_control' => "destroy",
                'guard_name' => "web",
                'module' => "language.destroy",
                'status' => 0,
            ],
            [
                'name' => "Adding Words, Editing",
                'group' => "Language",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "language.edit_words",
                'status' => 0,
            ],
            [
                'name' => "Adding Words, Editing",
                'group' => "Language",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "language.make_default",
                'status' => 0,
            ],
            [
                'name' => "Adding Words, Editing",
                'group' => "Language",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "language.add.new.string",
                'status' => 0,
            ],
            [
                'name' => "Adding Words, Editing",
                'group' => "Language",
                'group_control' => "create",
                'guard_name' => "web",
                'module' => "language.words.update",
                'status' => 0,
            ],
        ];
        foreach ($permision as $row){
            Permissions::create($row);
        }
    }
}