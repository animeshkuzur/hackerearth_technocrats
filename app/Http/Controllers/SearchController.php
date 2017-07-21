<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class SearchController extends Controller
{
    public function search(Request $request){
    	try{
    		$q = $request->only('q');
    		if($q){
    			$quest = new Question();
    			$results = $quest->where('title', 'LIKE', '%'. $q['q'] .'%')
					->orWhere('description', 'LIKE', '%'. $q['q'] .'%')
                    ->join('categories','categories.id','=','questions.category_id')
        			->get(['categories.name as name','questions.id as quest_id','questions.title as title']);
        		if(empty($results)){
        			return view('search');
        		}	
                return view('search',['results' => $results]);
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

