<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
        	['name' => 'Programming'],
        	['name' => 'Lifestyle'],
        	['name' => 'Financial'],
        	['name' => 'Art'],
        	['name' => 'Gaming'],
        	['name' => 'Business'],
        	['name' => 'Politics'],
        	['name' => 'Entertainment']
        );
        DB::table('categories')->insert($data);
    }
}
