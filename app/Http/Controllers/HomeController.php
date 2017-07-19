<?php

namespace App\Http\Controllers;

use Request;
use App\Member;
use App\News;

class HomeController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$members = Member::all();
		$last = News::join('users','users.id','=','news.users_id')
		->join('type_news','type_news.id','news.type_news_id')
		->select('*','users.id as users_id','news.id as news_id','news.name as news_name','users.name as users_name','news.picture as news_picture','news.created_at as news_created_at','news.updated_at as news_updated_at','type_news.name as type_news_name')
		->orderBy('news.created_at','desc')
		->limit(10)
		->get();
		return view('index')->with(['members'=>$members,'last'=>$last]);
	}
}
