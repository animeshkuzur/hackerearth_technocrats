<?php

use Illuminate\Database\Seeder;

class UserPreferenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
        	['user_id' => 1,'category_id' => 1],
        	['user_id' => 1,'category_id' => 2],
        	['user_id' => 1,'category_id' => 3],
        	['user_id' => 1,'category_id' => 4],
        	['user_id' => 1,'category_id' => 5],
        	['user_id' => 1,'category_id' => 6],
        	['user_id' => 1,'category_id' => 7],
        	['user_id' => 1,'category_id' => 8],

        	['user_id' => 2,'category_id' => 1],
        	['user_id' => 2,'category_id' => 2],
        	['user_id' => 2,'category_id' => 3],
        	['user_id' => 2,'category_id' => 4],
        	['user_id' => 2,'category_id' => 5],
        	['user_id' => 2,'category_id' => 6],
        	['user_id' => 2,'category_id' => 7],
        	['user_id' => 2,'category_id' => 8]
        );
        DB::table('user_preferences')->insert($data);
    }
}
