<?php

use Illuminate\Database\Seeder;

class QuestionUpvoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
        	['user_id' => 1,'question_id'=>1,'created'=>'2017-07-18 17:45:00'],
        	['user_id' => 1,'question_id'=>2,'created'=>'2017-07-18 17:45:00'],
        	['user_id' => 2,'question_id'=>1,'created'=>'2017-07-18 17:45:00']
        );
        DB::table('question_upvotes')->insert($data);
    }
}
