<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
        	['question_id' => 1,'tag' => 'PHP'],
        	['question_id' => 1,'tag' => 'Python'],
        	['question_id' => 2,'tag' => 'Game of Thrones season 7']
        );
        DB::table('tags')->insert($data);
    }
}
