<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPreference;
use App\User;
use App\Category;

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
    		return view('profile',['pref'=>$pref,'cat'=>$cat,'profile'=>$data,'no_quest'=>sizeof(\DB::table('questions')->where('user_id',$id)->get()),'no_ans'=>sizeof(\DB::table('answers')->where('user_id',$id)->get())]);
    	}	
    	catch(Exception $e){

    	}

    }
}
