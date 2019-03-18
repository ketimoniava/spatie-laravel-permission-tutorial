<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = Role::where('name', 'writer')->first();
	    $role_manager  = Role::where('name', 'editor')->first();
	    $role_admin  = Role::where('name', 'admin')->first();
	    
	    $employee = new User();
	    $employee->name = 'Katie Moniava';
	    $employee->email = 'ketimoniava88@gmail.com';
	    $employee->password = bcrypt('secret');
	    $employee->save();
	    $employee->roles()->attach($role_employee);
	    
	    $manager = new User();
	    $manager->name = 'Ketevan Moniava';
	    $manager->email = 'ketimoniava@gmail.com';
	    $manager->password = bcrypt('secret');
	    $manager->save();
	    $manager->roles()->attach($role_manager);

	    $manager = new User();
	    $manager->name = 'Ketevan Moniava';
	    $manager->email = 'katie.moniava@gmail.com';
	    $manager->password = bcrypt('secret');
	    $manager->save();
	    $manager->roles()->attach($role_admin);
    }
}
