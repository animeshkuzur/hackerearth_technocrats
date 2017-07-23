<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Question;
use App\Tag;
use App\Answer;

class QuestionController extends Controller
{

	public function getadd(){
		return view('addquestion');
	}

    public function add(Request $request){
    	try{
    		$tag_data = array();
    		$data = $request->all();
    		$this->validate($request, Question::$question_validation_rules);
    		$question = new Question();
    		$question->user_id = \Auth::user()->id;
    		$question->title = $data['title'];
    		$question->description = $data['description'];
    		$question->category_id = $data['category'];
    		$question->created = Carbon::now('Asia/Kolkata');
    		$tags = explode(",",$data['tags']);
    		if($question->save()){
    			foreach($tags as $tag){
    				$temp = ['question_id' => $question->id,'tag' => $tag];
    				array_push($tag_data, $temp);
    			}
    			$save_tag = Tag::insert($tag_data);
    			return redirect('/question/'.$question->id);
    		}

    	}
    	catch(Exception $e){

    	}
    }

    public function update(Request $request,$id){
    	try{

    	}
    	catch(Exception $e){

    	}
    }

    public function get($id){
    	try{
    		$question_data = Question::where('questions.id',$id)->join('categories','categories.id','=','questions.category_id')->join('users','users.id','=','questions.user_id')->leftJoin('answers','answers.id','=','questions.answer_id')->get(['questions.title','questions.description','categories.name as category_name','users.name as user_question','answers.answer','questions.created as question_created','questions.id as question_id','questions.user_id as question_user_id','questions.user_id as user_id','questions.answer_id as solution'])->first();
    		$tag_data = Tag::where('question_id',$id)->leftJoin('analysed_tags','analysed_tags.tag_id','=','tags.id')->get();
    		$answer_data = Answer::where('question_id',$id)->join('users','users.id','=','answers.user_id')->get(['answer','users.name as user_answer','answers.created as answer_created','answers.user_id as answer_user_id','answers.id as answer_id','users.id as user_id']);

    		return view('question',['question_data' => $question_data,'answer_data' => $answer_data,'tag_data' => $tag_data]);

    		
    	}
    	catch(Exception $e){

    	}
    }

    public function delete($id){
    	try{
            $solution = Question::where('id',$id)->update(['answer_id'=>NULL]);
            $tags = Tag::where('question_id',$id)->delete();
    		$answers = Answer::where('question_id',$id)->delete();
    		$question = Question::where('id',$id)->delete();
    		if($question){
    			return redirect('/home');
    		}
    		return 'an error occured';
    	}
    	catch(Exception $e){

    	}
    }

    public function remove_solution($id){
        try{
            $solution = Question::where('id',$id)->update(['answer_id'=>NULL]);
            if($solution){
                return redirect('/question/'.$id);
            }
            return 'an error occured';
        }
        catch(Exception $e){

        }
    }
}
