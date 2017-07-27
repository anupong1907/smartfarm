<?php

namespace App\Http\Controllers;

use Request;
use App\Users;
use App\Member;
use App\Cow;
use App\Cow_history;
use App\Breeder_m;
use App\Breeder_f;



class CommunityController extends Controller
{
    public function community($id){
    	$community = Users::where('id',$id)->get();
    	$community_name = $community[0];
    	$member = Member::where('users_id',$id)->get();
    	$member_count = Member::where('users_id',$id)->count();
    	$i = 1;
    	$x = 1;
    	$cow = Cow::join('cow_history','cow_history.cow_id','cow.qrcode')
    	->join('member','member.id','cow_history.member_id')
    	->join('users','users.id','member.users_id')
    	->leftjoin('breeder_m','breeder_m.cow_id','cow.id')
        ->leftjoin('breeder_f','breeder_f.cow_id','cow.id')
    	->where('cow_history.status',1)
        ->where('cow.status',1)
        ->where('users.id',$id)
        ->select('*','cow.id as cow_id','users.name as users_name','member.name as member_name','cow.name as cow_name','cow.picture as cow_picture','cow.dob as cow_dob','breeder_m.id as breeder_m_id','breeder_f.id as breeder_f_id')
    	->get();
    	$cow_count = Cow::join('cow_history','cow_history.cow_id','cow.qrcode')
    	->join('member','member.id','cow_history.member_id')
    	->join('users','users.id','member.users_id')
    	->leftjoin('breeder_m','breeder_m.cow_id','cow.id')
        ->leftjoin('breeder_f','breeder_f.cow_id','cow.id')
    	->where('cow_history.status',1)
        ->where('cow.status',1)
        ->where('users.id',$id)
        ->count();
    	return view('community')->with(['community_name'=>$community_name,'member'=>$member,'i'=>$i,'member_count'=>$member_count,'cow'=>$cow,'x'=>$x,'cow_count'=>$cow_count]);
    }
}