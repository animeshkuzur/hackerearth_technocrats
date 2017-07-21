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
        $role_user = new Role();
	    $role_user->name = 'driver';
	    $role_user->save();

	    $role_advertiser = new Role();
	    $role_advertiser->name = 'administrator';
	    $role_advertiser->save();
    }
}
