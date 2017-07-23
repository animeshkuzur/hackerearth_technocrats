<?php

use Illuminate\Database\Seeder;

class AnswerUpvoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
        	['user_id' => 1,'answer_id'=>1,'created'=>'2017-07-18 17:45:00'],
        	['user_id' => 1,'answer_id'=>2,'created'=>'2017-07-18 17:45:00'],
        	['user_id' => 2,'answer_id'=>1,'created'=>'2017-07-18 17:45:00']
        );
        DB::table('answer_upvotes')->insert($data);
    }
}
