<?php

namespace App\Http\Controllers;

use Request;
use App\Users;
use App\Member;
use Carbon\Carbon;
use App\Cow;
use App\Cow_history;
use App\Breeder_m;
use App\Breeder_f;

class MemberController extends Controller
{
    public function member(){
        $member = Member::join('users','users.id','=','member.users_id')
        ->select('*','member.id as member_id','member.name as member_name','users.name as users_name','member.email as member_email','member.phone as member_phone','member.picture as member_picture','member.phone as member_phone','member.address as member_address','member.email as member_email','users.id as usres_id')
        ->get();
        $i = 1;
        $community = Users::all();
        return view('member')->with(['member'=>$member,'i'=>$i,'community'=>$community]);
    }
    public function form_member(){
    	$community = Users::all();
    	return view('form_member')->with(['community'=>$community]);
    }
    public function post_member(Request $request){
    	$member = new Member();
    	$member->name = $request::get('name');
    	$member->users_id = $request::get('usres_id');
    	$member->address = $request::get('address');
    	$member->phone = $request::get('phone');
    	$member->email = $request::get('email');
    	$member->username = $request::get('username');
    	$member->password = $request::get('password');
        $member->lat = $request::get('lat');
        $member->long = $request::get('long');
    	if($request::hasFile('picture')) {
            $picture = 'picture'.Carbon::now()->toDateString().str_random().'.jpg';
            $destination = public_path().'/images/';
            $request::file('picture')->move($destination, $picture);

            $member->picture=$picture;
        }
        $member->save();
        return back();
    }

    public function delete_member(Request $request){
        $news=Member::find($request::get('id'));
        $news->delete();
        return back();
    }

    public function update_member(Request $request){
        $member = Member::find($request::get('id'));
        $member->name = $request::get('name');
        $member->users_id = $request::get('usres_id');
        $member->address = $request::get('address');
        $member->phone = $request::get('phone');
        $member->email = $request::get('email');
        if($request::hasFile('picture')) {
            $picture = 'picture'.Carbon::now()->toDateString().str_random().'.jpg';
            $destination = public_path().'/images/';
            $request::file('picture')->move($destination, $picture);

            $member->picture=$picture;
        }
        $member->save();
        return back();
    }

    public function profile_member($id){
        $breeder_cows = Cow::leftjoin('breeder_m','breeder_m.cow_id','cow.id')
        ->leftjoin('breeder_f','breeder_f.cow_id','cow.id')
        ->where('cow.status',1)
        ->select('*','cow.id as cow_id','breeder_m.id as breeder_m_id','breeder_f.id as breeder_f_id')
        ->get();

        $members = Member::join('users','users.id','member.users_id')
        ->select('*','member.id as member_id','member.name as member_name','users.name as users_name','member.email as member_email','member.phone as member_phone','member.picture as member_picture','member.phone as member_phone','member.address as member_address','member.email as member_email','users.id as users_id','member.lat as member_lat','member.long as member_long')
        ->where('member.id',$id)
        ->get();

        $member = $members[0];

        $i = 1;

        $member_cows = Cow::join('cow_history','cow_history.cow_id','cow.qrcode')
        ->leftjoin('breeder_m','breeder_m.cow_id','cow.id')
        ->leftjoin('breeder_f','breeder_f.cow_id','cow.id')
        ->where('cow_history.status',1)
        ->where('cow_history.member_id',$id)
        ->select('*','cow.status as cow_status','cow.id as cow_id','cow.name as cow_name','cow.detail as cow_detail','cow.dob as cow_dob','cow.gender as cow_gender','cow.picture as cow_picture','breeder_m.id as breeder_m_id','breeder_f.id as breeder_f_id')
        ->get();

        $breeder_m = Cow::join('cow_history','cow_history.cow_id','cow.qrcode')
        ->join('breeder_m','breeder_m.cow_id','cow.id')
        ->where('cow_history.status',1)
        ->where('cow_history.member_id',$id)
        ->count();

        $breeder_f = Cow::join('cow_history','cow_history.cow_id','cow.qrcode')
        ->join('breeder_f','breeder_f.cow_id','cow.id')
        ->where('cow_history.status',1)
        ->where('cow_history.member_id',$id)
        ->count();

        $cow_count = Cow::join('cow_history','cow_history.cow_id','cow.qrcode')
        ->where('cow_history.status',1)
        ->where('cow_history.member_id',$id)
        ->count();
        $a = 0;
        $b = 0;
        $c = 0;
        return view('profile_member')->with(['member'=>$member,'i'=>$i,'member_cows'=>$member_cows,'breeder_m'=>$breeder_m,'breeder_f'=>$breeder_f,'cow_count'=>$cow_count,'a'=>$a,'b'=>$b,'c'=>$c,'breeder_cows'=>$breeder_cows]);
    }
}
