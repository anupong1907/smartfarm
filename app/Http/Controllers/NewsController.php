<?php

namespace App\Http\Controllers;

use Request;
use App\News;
use Carbon\Carbon;
use App\Users;
use App\Type_news;

class NewsController extends Controller
{
    public function news(){
    	$news = News::join('users','users.id','=','news.users_id')
    					->select('*','users.id as users_id','news.id as news_id','news.name as news_name','users.name as users_name','news.picture as news_picture','news.created_at as news_created_at','news.updated_at as news_updated_at')
                        ->orderBy('news.created_at','desc')
    					->get();
        $type = Type_news::all();
    	$i = 1;
        
    	return view('news')->with(['news'=>$news,'i'=>$i,'type'=>$type]);
    }
    public function form_news(){
        $type = Type_news::all();
    	return view('form_news')->with(['type'=>$type]);
    }
    public function delete_news(Request $request){
        $news=News::find($request::get('id'));
        $news->delete();
        return back();
    }

    public function post_news(Request $request){
        $news = new News();
        $news->name = $request::get('list');
        $news->detail = $request::get('detail');
        $news->type_news_id =$request::get('type_news_id');
        $news->users_id =$request::get('users_id');

        if($request::hasFile('picture')) {
            $picture = 'picture'.Carbon::now()->toDateString().str_random().'.jpg';
            $destination = public_path().'/images/';
            $request::file('picture')->move($destination, $picture);

            $news->picture=$picture;
        }

        $news->save();
        return back();
    }
    public function update_news(Request $request){
        $news=News::find($request::get('id'));
        $news->name = $request::get('list');
        $news->detail = $request::get('detail');
        $news->type_news_id =$request::get('type_news_id');

        if($request::hasFile('picture')) {
            $picture = 'picture'.Carbon::now()->toDateString().str_random().'.jpg';
            $destination = public_path().'/images/';
            $request::file('picture')->move($destination, $picture);

            $news->picture=$picture;
        }

        $news->save();
        return back();

    }
    public function detail_news($id){
        $news = News::join('users','users.id','=','news.users_id')
                        ->join('type_news','type_news.id','news.type_news_id')
                        ->select('*','users.id as users_id','news.id as news_id','news.name as news_name','users.name as users_name','news.picture as news_picture','news.created_at as news_created_at','news.updated_at as news_updated_at','type_news.name as type_news_name')
                        ->where('news.id',$id)
                        ->get();
         $last = News::join('users','users.id','=','news.users_id')
                        ->join('type_news','type_news.id','news.type_news_id')
                        ->select('*','users.id as users_id','news.id as news_id','news.name as news_name','users.name as users_name','news.picture as news_picture','news.created_at as news_created_at','news.updated_at as news_updated_at','type_news.name as type_news_name')
                        ->orderBy('news.created_at','desc')
                        ->limit(10)
                        ->get();
        $news_detail = $news['0'];
        
        return view('detail_news')->with(['news'=>$news,'news_detail'=>$news_detail,'last'=>$last]);
    }
}
