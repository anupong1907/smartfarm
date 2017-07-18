<?php
// Start CommunityController
Route::get('community/{id}','CommunityController@community');
// End CommunityController

Route::get('/','HomeController@index');

// Start NewsController
Route::get('news','NewsController@news');
Route::get('form_news','NewsController@form_news');
Route::post('post_news','NewsController@post_news');
Route::post('delete_news','NewsController@delete_news');
Route::post('update_news','NewsController@update_news');
Route::get('detail_news/{id}','NewsController@detail_news');
// End NewsController

//start MemberController
Route::get('member','MemberController@member');
Route::get('form_member','MemberController@form_member');
Route::post('post_member','MemberController@post_member');
Route::post('delete_member','MemberController@delete_member');
Route::get('profile_member/{id}','MemberController@profile_member');
Route::post('update_member','MemberController@update_member');
//end MemberController

// Start CowController
Route::get('cow','CowController@cow');
Route::get('profile_cow/{id}','CowController@profile_cow');
Route::get('breeder','CowController@breeder');
Route::get('form_cow','CowController@form_cow');
Route::post('post_cow','CowController@post_cow');
Route::get('young_cow','CowController@young_cow');
Route::get('ready_cow','CowController@ready_cow');
Route::post('post_breeder','CowController@post_breeder');
Route::post('delete_breeder','CowController@delete_breeder');
Route::post('delete_cow','CowController@delete_cow');
Route::post('post_history_cow','CowController@post_history_cow');
Route::get('trading','CowController@trading');
Route::get('form_trading','CowController@form_trading');
Route::post('post_customer','CowController@post_customer');
Route::post('post_trading','CowController@post_trading');
Route::post('delete_cow_history','CowController@delete_cow_history');
Route::post('update_cow','CowController@update_cow');
Route::post('post_breed','CowController@post_breed');
Route::get('kokun','CowController@kokun');
// End CowController

//Start GrassController
Route::get('grass','GrassController@grass');
//End GrassController

//Start DungController
Route::get('dung','DungController@dung');
//End DungController



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
