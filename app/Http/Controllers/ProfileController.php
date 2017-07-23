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
    	catch(Exception $e){

    	}
    }

    public function get($id){
    	try{
            $ans_upvote = 0;
            $quest_upvote = 0;
    		$data = User::where('id',$id)->get()->first();
    		$cat = Category::all();
            $pref = array();
            $user_pref = UserPreference::where('user_id',\Auth::user()->id)->join('categories','categories.id','=','user_preferences.category_id')->get(['categories.name as name','categories.id as id']);
            foreach($cat as $categories){
                $flag=0;
                for($i=0;$i<sizeof($user_pref);$i++){
                    if($categories->id == $user_pref[$i]->id){
                        $flag = 1;
                    }
                }
                if($flag==1){
                    array_push($pref,1);
                }
                else{
                    array_push($pref,0);
                }
            }
            $no_quest = Question::where('user_id',$id)->count();
            $no_ans = Answer::where('user_id',$id)->count();
            $quest = Question::where('user_id',$id)->get();
            $ans = Answer::where('user_id',$id)->get();
            foreach($ans as $answer){
                $ans_upvote = $ans_upvote+AnswerUpvote::where('answer_id',$answer->id)->count();
            }
            foreach($quest as $question){
                $quest_upvote = $quest_upvote+QuestionUpvote::where('question_id',$question->id)->count();
            }
            
    		return view('profile',['pref'=>$pref,'cat'=>$cat,'profile'=>$data,'no_quest'=>$no_quest,'no_ans'=>$no_ans,'questions'=>$quest,'answers'=>$ans,'ans_upvote'=>$ans_upvote,'quest_upvote'=>$quest_upvote]);
    	}	
    	catch(Exception $e){

    	}

    }
}
