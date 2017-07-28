<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Socialite;

use App\User;
use App\SocialAccount;
use App\UserPreference;
use App\Question;
use App\Category;
use App\QuestionUpvote;

class AuthController extends Controller
{
    public function auth(){
        if(Auth::check()){
            return redirect('/');    
        }
    	return redirect('/');
    }

    public function register(){
        if(Auth::check()){
            return redirect('/');    
        }
    	return redirect('/');
    }

    public function logout(){
        if(Auth::check()){
            Auth::logout();    
        }
        return redirect('/');
    }

    public function home(){
        $feed = array();
        $upvote = array();
        $cat = Category::all();
        $pref = array();
        if(Auth::check()){
            $user_pref = UserPreference::where('user_id',\Auth::user()->id)->join('categories','categories.id','=','user_preferences.category_id')->get(['categories.name as name','categories.id as id']);
            foreach($cat as $categories){
                $flag=0;
                for($i=0;$i<sizeof($user_pref);$i++){
                    if($categories->id == $user_pref[$i]->id){
                        $flag = 1;
                    }
                }
                if($flag==1){
                    $data = Question::where('category_id',$categories->id)->join('categories','categories.id','=','questions.category_id')->get(['questions.id as quest_id','categories.name as name','categories.id as id','questions.title as title','questions.answer_id as answer_id','questions.description as description','questions.created as time']);
                    //$dat = \DB::select(\DB::raw('select questions.id as quest_id,categories.name as name,categories.id as id,questions.title as title,questions.answer_id as answer_id,count(question_upvotes.user_id) as votes from questions left join categories on categories.id=questions.category_id left join question_upvotes on question_upvotes.question_id = questions.id group by questions.id,categories.name,categories.id,questions.title,questions.answer_id'));
                    array_push($pref,1);
                    if($data){
                        foreach($data as $dat){
                            array_push($feed,$dat);                            
                        }    
                    }
                }
                else{
                    array_push($pref,0);
                }
            }
            return view('pages.dashboard',['pref'=>$pref,'feeds'=>$feed,'cat'=>$cat]);    
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
                    $data = Question::where('category_id',$categories->id)->join('categories','categories.id','=','questions.category_id')->get(['questions.id as quest_id','categories.name as name','categories.id as id','questions.title as title','questions.answer_id as answer_id','questions.description as description','questions.created as time']);
                    //$dat = \DB::select(\DB::raw('select questions.id as quest_id,categories.name as name,categories.id as id,questions.title as title,questions.answer_id as answer_id,count(question_upvotes.user_id) as votes from questions left join categories on categories.id=questions.category_id left join question_upvotes on question_upvotes.question_id = questions.id group by questions.id,categories.name,categories.id,questions.title,questions.answer_id'));
                    array_push($pref,1);
                    if($data){
                        foreach($data as $dat){
                            array_push($feed,$dat);                            
                        }
    
                    }
                }
                else{
                    array_push($pref,0);
                }
            }
            return view('pages.dashboard',['pref'=>$pref,'feeds'=>$feed,'cat'=>$cat]);
        }
    }

    public function email(Request $request){
    	try{
    		$this->validate($request, User::$login_validation_rules);
    		$data = $request->only('email','password');
    		if (Auth::attempt($data)){
            	return redirect('/home');
        	}
        	else{
            	return back()->withInput()->withErrors(['password' => 'Your password is invalid']);
        	}
    	}
    	catch(Exception $e){

    	}
    }

    public function emailregister(Request $request){
    	try{
    		$this->validate($request, User::$register_validation_rules);
    		$data = $request->only('name','email','password');
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $dat = array(
                ['user_id' => $user->id,'category_id' => 1],
                ['user_id' => $user->id,'category_id' => 2],
                ['user_id' => $user->id,'category_id' => 3],
                ['user_id' => $user->id,'category_id' => 4],
                ['user_id' => $user->id,'category_id' => 5],
                ['user_id' => $user->id,'category_id' => 6],
                ['user_id' => $user->id,'category_id' => 7],
                ['user_id' => $user->id,'category_id' => 8]
            );
            \DB::table('user_preferences')->insert($dat);
            if($user){
                if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'] ])){
                    return redirect('/home');
                } 
            }
    	}
    	catch(Exception $e){

    	}
    }

    public function password_email(){
        try{
            return view('auth.passwords.email');
        }
        catch(Exception $e){

        }
    }

    public function password_request(Request $request){
        try{
            //return view('auth.passwords.email');
        }
        catch(Exception $e){

        }
    }

    public function password_reset(){
        try{
            return view('auth.passwords.reset');
        }
        catch(Exception $e){

        }
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try{
            $user = Socialite::driver($provider)->user();


            if ($authUser = SocialAccount::where('provider_id', $user->id)->first()) {
                $temp_user = User::where('email',$user->email)->first();
            	Auth::login($temp_user, true);
        		return redirect('home');
        	}
            elseif($fuser = User::where('email',$user->email)->first()){
                return redirect('/auth')->with('email', 'User email already registered!');
            }
        	else{
                $new_user = new User();
                $new_user->name = $user->name;
                $new_user->email = $user->email;
                $new_user->save();
   				$new_user->socialAccounts()->create(
   					['provider_id' => $user->id, 'provider' => $provider]
   				);
                $dat = array(
                    ['user_id' => $new_user->id,'category_id' => 1],
                    ['user_id' => $new_user->id,'category_id' => 2],
                    ['user_id' => $new_user->id,'category_id' => 3],
                    ['user_id' => $new_user->id,'category_id' => 4],
                    ['user_id' => $new_user->id,'category_id' => 5],
                    ['user_id' => $new_user->id,'category_id' => 6],
                    ['user_id' => $new_user->id,'category_id' => 7],
                    ['user_id' => $new_user->id,'category_id' => 8]
                );
                \DB::table('user_preferences')->insert($dat);

   				Auth::login($new_user, true);
        		return redirect()->route('login');
        	}
        }
        catch(Exception $e){
            return redirect('home');
        }
    }
}
