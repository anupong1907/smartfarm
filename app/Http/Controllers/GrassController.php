<?php

namespace App\Http\Controllers;

use Request;
use App\Users;
use App\Member;
use App\Area;

class GrassController extends Controller
{
    public function grass(){
    	$member = Users::join('member','member.users_id','=','users.id')
        ->select('member.name as member_name','users.name as users_name','member.id as member_id')
        ->get();
        $i = 1;
        $grass = Area::join('member','member.id','area.member_id')->get();
    	return view('grass')->with(['member'=>$member,'i'=>$i,'grass'=>$grass]);

    }
    
    public function form_grass(Request $request){
    	$member = Member::where('id',$request::get('member_id'))->get();
    	$m = $member[0];

        $grass = Member::join('area','area.member_id','member.id')
        ->where('member.id',$request::get('member_id'))
        ->select('*','member.id as member_id')
        ->get();
    	 
    	return view('form_grass')->with(['m'=>$m,'grass'=>$grass]);
    }
    
    public function post_grass(Request $request){
        $grass = new Area();
        $grass->area = $request::get('area');
        $grass->lat = $request::get('lat');
        $grass->long = $request::get('long');
        $grass->start_date = $request::get('start'); 
        $grass->end_date = $request::get('end');
        $grass->member_id = $request::get('member_id');
        $grass->status = '1';
        $grass->save();

        return back();
    }
}
