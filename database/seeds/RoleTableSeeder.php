<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $role_employee = new Role();
        $role_employee->slug = 'writer';
	    $role_employee->name = 'writer';
	    $role_employee->description = 'A Writer User';
	    $role_employee->save();
	    
	    $role_manager = new Role();
        $role_manager->slug = 'editor';
	    $role_manager->name = 'editor';
	    $role_manager->description = 'A Editor User';
	    $role_manager->save();

        $role_manager = new Role();
        $role_manager->slug = 'admin';
        $role_manager->name = 'admin';
        $role_manager->description = 'A Admin User';
        $role_manager->save();
    }
}
