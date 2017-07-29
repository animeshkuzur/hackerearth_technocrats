<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPreference;
use App\User;
use App\Category;
use App\Question;
use App\Answer;
use App\QuestionUpvote;
use App\AnswerUpvote;

class ProfileController extends Controller
{
    public function preference(Request $request){
    	try{
            if(\Auth::check()){
    		$list=array();
    		$data =	$request->input('category');
    		$user_pref = UserPreference::where('user_id',\Auth::user()->id)->delete();
    		foreach($data as $dat){
    			$temp = ['user_id'=>\Auth::user()->id,'category_id'=>$dat];
    			array_push($list,$temp);

    		}
    		$user_preference = \DB::table('user_preferences')->insert($list);
    		return redirect('/home');
    		//$data = UserPreference::where('user_id',\Auth::user()->id)->get();
    		//return view('home',)
            }
            else{
                return redirect('/');
            }

    	}
    	catch(Exception $e){

    	}
    }

    public function get($id){
    	try{
            $ans_upvote = 0;
            $quest_upvote = 0;
    		$data = User::where('id',$id)->get()->first();
            
            $no_quest = Question::where('user_id',$id)->count();
            $no_ans = Answer::where('user_id',$id)->count();
            $quest = Question::where('user_id',$id)->leftJoin('categories','categories.id','=','questions.category_id')->get(['questions.id','questions.description','questions.title','questions.answer_id','questions.created','categories.name']);
            $ans = Answer::where('answers.user_id',$id)->leftJoin('questions','questions.id','=','answers.question_id')->leftJoin('categories','categories.id','=','questions.category_id')->get(['questions.title','questions.answer_id','questions.description','questions.created','categories.name','questions.id','answers.question_id']);
            foreach($ans as $answer){
                $ans_upvote = $ans_upvote+AnswerUpvote::where('answer_id',$answer->id)->count();
            }
            foreach($quest as $question){
                $quest_upvote = $quest_upvote+QuestionUpvote::where('question_id',$question->id)->count();
            }
            
    		return view('pages.profile',['profile'=>$data,'no_quest'=>$no_quest,'no_ans'=>$no_ans,'questions'=>$quest,'answers'=>$ans,'ans_upvote'=>$ans_upvote,'quest_upvote'=>$quest_upvote]);
    	}	
    	catch(Exception $e){

    	}

    }
}
