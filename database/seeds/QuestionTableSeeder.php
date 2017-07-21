<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $quest = new Question();
	    $quest->user_id = 1;
	    $quest->title = 'Which programming language is better for a webserver, PHP or Python?';
	    $quest->description = 'PHP or Python, somebody decide!';
        $quest->category_id = 1;
	    $quest->created = '2017-06-10 10:00:00';
	    $quest->save();

        $quest = new Question();
        $quest->user_id = 2;
        $quest->title = 'How do you rate the new Game of Thrones season 7?';
        $quest->description = 'Taking the past 6 seasons into consideration, did the Game of Thrones hype live up to its expectations?';
        $quest->category_id = 8;
        $quest->created = '2017-06-12 09:30:00';
        $quest->save();
    }
}
