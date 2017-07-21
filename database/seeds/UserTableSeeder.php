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
        $role_user = Role::where('name', 'user')->first();
    	$role_admin  = Role::where('name', 'administrator')->first();

	    $user = new User();
	    $user->name = 'John Doe';
	    $user->email = 'john.doe@gmail.com';
	    $user->password = bcrypt('password');
	    $user->verified = 1;
	    $user->save();
	    $user->roles()->attach($role_user);

	    $admin = new User();
	    $admin->name = 'Seth Rogen';
	    $admin->email = 'seth.rogen@gmail.com';
	    $admin->password = bcrypt('password');
	    $admin->verified = 1;
	    $admin->save();
	    $admin->roles()->attach($role_admin);
    }
}
