<?php

namespace App\Http\Middleware;

use Closure;
use App\Answer;
use App\Question;

class CheckAnswerOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_id = \Auth::user()->id;
        $id=$request->route('id');
        $ans_id=$request->route('answer_id');
        $check_id = Answer::where('question_id',$id)->where('id',$ans_id)->get(['user_id'])->first();
        if($user_id != $check_id->user_id){
            return redirect('/question/'.$id)->withErrors(['error'=>'not authorized.']);
        }
        return $next($request);
    }
}
