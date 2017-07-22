<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use Carbon\Carbon;
use App\Question;

class AnswerController extends Controller
{
    public function add($id,Request $request){
    	try{
    		$data=$request->all();
    		$this->validate($request, Answer::$answer_validation_rules);
    		$answer = new Answer();
    		$answer->answer = $data['answer'];
    		$answer->question_id = $id;
    		$answer->user_id = \Auth::user()->id;
    		$answer->created = Carbon::now('Asia/Kolkata');
    		if($answer->save()){
    			return redirect('/question/'.$id);
    		}
    	}
    	catch(Exception $e){

    	}
    }

    public function update(){

    }

    public function delete($id,$answer_id){
    	try{
            $check = Question::where('id',$id)->get(['answer_id'])->first();
            if(!empty($check->answer_id)){
                return redirect('/question/'.$id);
                //$solution = Question::where('id',$id)->update(['answer_id'=>NULL]);
            }
    		$answers = Answer::where('question_id',$id)->where('id',$answer_id)->delete();
    		if($answers){
    			return redirect('/question/'.$id);
    		}
    		return 'an error occured';
    	}
    	catch(Exception $e){

    	}
    }

    public function solution($id,$answer_id){
        try{
            $quest = Question::where('id',$id)->update(['answer_id'=>$answer_id]);
            if($quest){
                return redirect('/question/'.$id);
            }
            return 'an error occured';
        }
        catch(Exception $e){

        }
    }
}
