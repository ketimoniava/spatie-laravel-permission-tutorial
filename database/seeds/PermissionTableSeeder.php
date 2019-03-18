<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::where('slug','admin')->first();
		$manager_role = Role::where('slug', 'editor')->first();

		$createTasks = new Permission();
		$createTasks->slug = 'create-post';
		$createTasks->name = 'Create post';
		$createTasks->save();
		$createTasks->roles()->attach($admin_role);

		$editUsers = new Permission();
		$editUsers->slug = 'edit-post';
		$editUsers->name = 'Edit post';
		$editUsers->save();
		$editUsers->roles()->attach($manager_role);
    }
}
