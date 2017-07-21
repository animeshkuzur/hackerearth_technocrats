<?php

use Illuminate\Database\Seeder;
use App\Answer;
class AnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ans = new Answer();
	    $ans->user_id = 2;
	    $ans->question_id = 1;
	    $ans->answer = 'Obviously Python buddy!';
	    $ans->created = '2017-07-12 10:02:00';
	    $ans->save();

        $ans = new Answer();
        $ans->user_id = 1;
        $ans->question_id = 1;
        $ans->answer = "It all depends upon the kind of work you're doing. PHP is good for small and quick web development solution, while Python stands its ground in large scale projects.";
        $ans->created = '2017-07-15 11:12:00';
        $ans->save();

        $ans = new Answer();
        $ans->user_id = 1;
        $ans->question_id = 2;
        $ans->answer = "As of now, they only aired the first episode so there's not enough data to draw a justifiable conclusion.";
        $ans->created = '2017-07-16 17:45:00';
        $ans->save();
    }
}
