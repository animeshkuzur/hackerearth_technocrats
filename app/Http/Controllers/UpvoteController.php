<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\QuestionUpvote;
use App\AnswerUpvote;

class UpvoteController extends Controller
{
    public function question_upvote($id){
    	try{
    		$check = QuestionUpvote::where('question_id',$id)->where('user_id',\Auth::user()->id)->get()->first();
    		if(empty($check)){
    			$upvote = new QuestionUpvote();
    			$upvote->question_id = $id;
    			$upvote->user_id = \Auth::user()->id;
    			$upvote->created = Carbon::now('Asia/Kolkata');
    			if($upvote->save()){
    				return redirect('/question/'.$id);
    			}
    		}
    		return redirect('/question/'.$id);
    	}
    	catch(Exception $e){

    	}
    }

    public function question_downvote($id){
    	try{
    		$check = QuestionUpvote::where('question_id',$id)->where('user_id',\Auth::user()->id)->get()->first();
    		if(!empty($check)){
    			$downvote = QuestionUpvote::where('question_id',$id)->where('user_id',\Auth::user()->id)->delete();
    			if($downvote){
    				return redirect('/question/'.$id);
    			}
    		}
    		return redirect('/question/'.$id);
    	}
    	catch(Exception $e){

    	}
    }
    
    public function answer_upvote($id,$answer_id){
    	try{
    		$check = AnswerUpvote::where('answer_id',$answer_id)->where('user_id',\Auth::user()->id)->get()->first();
    		if(empty($check)){
    			$upvote = new AnswerUpvote();
    			$upvote->answer_id = $answer_id;
    			$upvote->user_id = \Auth::user()->id;
    			$upvote->created = Carbon::now('Asia/Kolkata');
    			if($upvote->save()){
    				return redirect('/question/'.$id);
    			}
    		}
    		return redirect('/question/'.$id);
    	}
    	catch(Exception $e){

    	}
    }

    public function answer_downvote($id,$answer_id){
    	try{
    		$check = AnswerUpvote::where('answer_id',$answer_id)->where('user_id',\Auth::user()->id)->get()->first();
    		if(!empty($check)){
    			$downvote = AnswerUpvote::where('answer_id',$answer_id)->where('user_id',\Auth::user()->id)->delete();
    			if($downvote){
    				return redirect('/question/'.$id);
    			}
    		}
    		return redirect('/question/'.$id);
    	}
    	catch(Exception $e){

    	}
    }
}
