<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth',['as' => 'login','uses' => 'AuthController@auth']);
Route::post('/auth/email',['as' => 'emailauth','uses' => 'AuthController@email']);

Route::get('auth/{provider}', 'AuthController@redirect');
Route::get('auth/{provider}/callback', 'AuthController@callback');

Route::get('/register',['as' => 'register', 'uses' => 'AuthController@register']);
Route::post('/register/email',['as' => 'emailregister','uses' => 'AuthController@emailregister']);

Route::post('/logout',['as' => 'logout', 'uses' => 'AuthController@logout']);

Route::get('/auth/password/email',['as' => 'password_email','uses' => 'AuthController@password_email']);
Route::post('/auth/password/email',['as' => 'password_request','uses' => 'AuthController@password_request']);
Route::get('/auth/password/reset',['as' => 'password_reset','uses' => 'AuthController@password_reset']);

Route::group(['middleware' => ['auth']], function(){
	Route::get('/home', ['as' => 'home', 'uses' => 'AuthController@home']);
	Route::get('/search', ['as' => 'search', 'uses' => 'SearchController@search']);
	Route::post('/profile/preference',['as' => 'preference','uses' => 'ProfileController@preference']);
	Route::get('/question/add', ['as' => 'getadd_question', 'uses' => 'QuestionController@getadd']);
	Route::post('/question/add', ['as' => 'add_question', 'uses' => 'QuestionController@add']);
	Route::post('/question/{id}/update', ['as' => 'update_question', 'uses' => 'QuestionController@update']);
	
	Route::get('/question/{id}', ['as' => 'get_question', 'uses' => 'QuestionController@get']);
	Route::post('/question/{id}/answer/add', ['as' => 'add_answer', 'uses' => 'AnswerController@add']);
	Route::post('/question/{id}/answer/{answer_id}/update', ['as' => 'update_answer', 'uses' => 'AnswerController@update']);
	Route::get('/user/{id}',['as' => 'profile','uses' => 'ProfileController@get']);
	Route::get('/question/{id}/upvote',['as'=>'question_upvote','uses'=>'UpvoteController@question_upvote']);
	Route::get('/question/{id}/downvote',['as'=>'question_downvote','uses'=>'UpvoteController@question_downvote']);
	Route::get('/question/{id}/answer/{answer_id}/upvote',['as'=>'answer_upvote','uses'=>'UpvoteController@answer_upvote']);
	Route::get('/question/{id}/answer/{answer_id}/downvote',['as'=>'answer_downvote','uses'=>'UpvoteController@answer_downvote']);
});

Route::group(['middleware' => ['auth','question.owner']], function(){
	Route::get('/question/{id}/delete', ['as' => 'delete_question', 'uses' => 'QuestionController@delete']);
	Route::get('/question/{id}/remove-solution',['as' => 'remove_solution','uses' => 'QuestionController@remove_solution']);
	Route::get('/question/{id}/answer/{answer_id}/solution',['as' => 'profile','uses' => 'AnswerController@solution']);
});

Route::group(['middleware' => ['auth','answer.owner']], function(){
	Route::get('/question/{id}/answer/{answer_id}/delete', ['as' => 'delete_answer', 'uses' => 'AnswerController@delete']);
});