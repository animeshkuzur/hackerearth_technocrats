<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Category;
use App\UserPreference;

class SearchController extends Controller
{
    public function search(Request $request){
    	try{
    		$q = $request->only('q');
    		

        $cat = Category::all();
        $pref = array();
        if(\Auth::check()){
            $user_pref = UserPreference::where('user_id',\Auth::user()->id)->join('categories','categories.id','=','user_preferences.category_id')->get(['categories.name as name','categories.id as id']);
            foreach($cat as $categories){
                $flag=0;
                for($i=0;$i<sizeof($user_pref);$i++){
                    if($categories->id == $user_pref[$i]->id){
                        $flag = 1;
                    }
                }
                if($flag==1){
                    //$dat = Question::where('category_id',$categories->id)->join('categories','categories.id','=','questions.category_id')->get(['questions.id as quest_id','categories.name as name','categories.id as id','questions.title as title','questions.answer_id as answer_id','questions.description as description','questions.created as time'])->first();
                    //$dat = \DB::select(\DB::raw('select questions.id as quest_id,categories.name as name,categories.id as id,questions.title as title,questions.answer_id as answer_id,count(question_upvotes.user_id) as votes from questions left join categories on categories.id=questions.category_id left join question_upvotes on question_upvotes.question_id = questions.id group by questions.id,categories.name,categories.id,questions.title,questions.answer_id'));
                    array_push($pref,1);
                }
                else{
                    array_push($pref,0);
                }
            }
            //return view('pages.dashboard',['pref'=>$pref,'feeds'=>$feed,'cat'=>$cat]);    
        }
        else{
            $user_pref = Category::all();
            foreach($cat as $categories){
                $flag=0;
                for($i=0;$i<sizeof($user_pref);$i++){
                    if($categories->id == $user_pref[$i]->id){
                        $flag = 1;
                    }
                }
                if($flag==1){
                    //$dat = Question::where('category_id',$categories->id)->join('categories','categories.id','=','questions.category_id')->get(['questions.id as quest_id','categories.name as name','categories.id as id','questions.title as title','questions.answer_id as answer_id','questions.description as description','questions.created as time'])->first();
                    //$dat = \DB::select(\DB::raw('select questions.id as quest_id,categories.name as name,categories.id as id,questions.title as title,questions.answer_id as answer_id,count(question_upvotes.user_id) as votes from questions left join categories on categories.id=questions.category_id left join question_upvotes on question_upvotes.question_id = questions.id group by questions.id,categories.name,categories.id,questions.title,questions.answer_id'));
                    array_push($pref,1);
                }
                else{
                    array_push($pref,0);
                }
            }
            //return view('pages.dashboard',['pref'=>$pref,'feeds'=>$feed,'cat'=>$cat]);
        }
        if($q){
                $quest = new Question();
                $results = $quest->where('title', 'LIKE', '%'. $q['q'] .'%')
                    ->orWhere('description', 'LIKE', '%'. $q['q'] .'%')
                    ->join('categories','categories.id','=','questions.category_id')
                    ->get(['categories.name as name','questions.id as quest_id','questions.title as title','questions.created as time','questions.description as description']);
                if(empty($results)){
                    return view('search');
                }   
                return view('pages.dashboard',['pref' => $pref,'feeds'=>$results,'cat'=>$cat]);
            }
            else{
                $results = Question::all();
                return view('search',['results' => $results]);
            }
            return view('search');



    	}
    	catch(Exception $e){

    	}
    }
}

