<?php

namespace App\Http\Controllers;

use Request;
use Carbon\Carbon;
use App\Cow;
use App\Member;
use App\Users;
use App\Cow_history;
use App\Customer;
use App\Trading;
use App\Type_breed;
use App\Breed;
use App\Breeder_m;
use App\Breeder_f;

class CowController extends Controller
{
    public function cow(){
        $cow = Cow_history::join('cow','cow.qrcode','cow_history.cow_id')
        ->join('member','member.id','cow_history.member_id')
        ->join('users','users.id','member.users_id')
        ->leftjoin('breeder_m','breeder_m.cow_id','cow.id')
        ->leftjoin('breeder_f','breeder_f.cow_id','cow.id')
        ->where('cow_history.status',1)
        ->where('cow.status',1)
        ->select('*','cow.id as cow_id','users.name as users_name','member.name as member_name','cow.name as cow_name','cow.picture as cow_picture','cow.dob as cow_dob','breeder_m.id as breeder_m_id','breeder_f.id as breeder_f_id')
        ->get();
        $member = Users::join('member','member.users_id','=','users.id')
        ->select('member.name as member_name','users.name as users_name','member.id as member_id')
        ->get();
        $i = 1;
        $cow_m = Cow::join('breeder_m','breeder_m.cow_id','cow.id')
        ->where('cow.status',1)
        ->select('*','cow.id as cow_id')
        ->get();
        $cow_f = Cow::join('breeder_f','breeder_f.cow_id','cow.id')
        ->where('cow.status',1)
        ->select('*','cow.id as cow_id')
        ->get();
        return view('cow')->with(['cow'=>$cow,'i'=>$i,'member'=>$member,'cow_m'=>$cow_m,'cow_f'=>$cow_f]);
    }

    public function breeder(){
        $cow_breeder_m = Cow::join('breeder_m','breeder_m.cow_id','cow.id')
        ->join('cow_history','cow_history.cow_id','cow.qrcode')
        ->join('member','member.id','cow_history.member_id')
        ->where('cow_history.status',1)
        ->where('cow.status',1)
        ->select('*','cow.name as cow_name','member.name as member_name','cow.id as cow_id')
        ->get();
        $cow_breeder_f = Cow::join('breeder_f','breeder_f.cow_id','cow.id')
        ->join('cow_history','cow_history.cow_id','cow.qrcode')
        ->join('member','member.id','cow_history.member_id')
        ->where('cow_history.status',1)
        ->where('cow.status',1)
        ->select('*','cow.name as cow_name','member.name as member_name','cow.id as cow_id')
        ->get();
        $cows_list = Cow::join('cow_history','cow_history.cow_id','cow.qrcode')
        ->leftjoin('breeder_m','breeder_m.cow_id','cow.id')
        ->leftjoin('breeder_f','breeder_f.cow_id','cow.id')
        ->where('cow_history.status',1)
        ->where('cow.status',1)
        ->get();
        $i = 1;
        $cow = Cow_history::join('cow','cow.qrcode','cow_history.cow_id')
        ->join('member','member.id','cow_history.member_id')
        ->join('users','users.id','member.users_id')
        ->where('cow_history.status',1)
        ->where('cow.status',1)
        ->orderBy('cow.created_at','desc')
        ->select('*','cow.id as cow_id','users.name as users_name','member.name as member_name','cow.name as cow_name','cow.picture as cow_picture','cow.dob as cow_dob','cow.created_at as cow_created_at')
        ->get();
        $cow_m = Cow::join('breeder_m','breeder_m.cow_id','cow.id')
        ->where('cow.status',1)
        ->select('*','cow.id as cow_id')
        ->get();
        $cow_f = Cow::join('breeder_f','breeder_f.cow_id','cow.id')
        ->where('cow.status',1)
        ->select('*','cow.id as cow_id')
        ->get();
        return view('breeder')->with(['cow_breeder_m'=>$cow_breeder_m,'i'=>$i,'cows_list'=>$cows_list,'cow_breeder_f'=>$cow_breeder_f,'cow'=>$cow,'cow_m'=>$cow_m,'cow_f'=>$cow_f]);
    }

    
    
    public function form_cow(){
        $cow_m = Cow::join('breeder_m','breeder_m.cow_id','cow.id')
        ->where('cow.status',1)
        ->select('*','cow.id as cow_id')
        ->get();
        $cow_f = Cow::join('breeder_f','breeder_f.cow_id','cow.id')
        ->where('cow.status',1)
        ->select('*','cow.id as cow_id')
        ->get();
        $member = Users::join('member','member.users_id','=','users.id')
        ->select('member.name as member_name','users.name as users_name','member.id as member_id')
        ->get();
        return view('form_cow')->with(['cow_m'=>$cow_m,'member'=>$member,'cow_f'=>$cow_f]);
    }
    public function post_cow(Request $request){
        do {
            $randomNumber = rand(100000, 999999);
            $numberInTempTable = Cow::where('qrcode',Carbon::now()->format('Y'). $randomNumber)->get();
        }while(!$numberInTempTable->isEmpty());

        $cow = new Cow();
        $cow->qrcode=Carbon::now()->format('Y'). $randomNumber;
        $cow->name = $request::get('name');
        $cow->detail = $request::get('detail');
        $cow->gender = $request::get('gender');
        $cow->dob = $request::get('dob');
        $cow->breeder_m = $request::get('breeder_m');
        $cow->breeder_f = $request::get('breeder_f');
        $cow->status = '1';

        if($request::hasFile('picture')) {
            $picture = 'picture'.Carbon::now()->toDateString().str_random().'.jpg';
            $destination = public_path().'/images/';
            $request::file('picture')->move($destination, $picture);

            $cow->picture=$picture;
        }
        $cow->save();

        $history = new Cow_history();
        $history->cow_id = Carbon::now()->format('Y'). $randomNumber;
        $history->member_id = $request::get('member_id');
        $history->status = '1';
        $history->save();
        return back();
    }

    public function post_breeder(Request $request){
        if($request::get('gender')=='m'){
            $breeder = new Breeder_m();
        }else{
            $breeder = new Breeder_f();
        }
        
        $breeder->cow_id = $request::get('cow_id');
        $breeder->save();
        return back();
    }

    public function young_cow(){
        $cow = Cow_history::join('cow','cow.qrcode','cow_history.cow_id')
        ->join('member','member.id','cow_history.member_id')
        ->join('users','users.id','member.users_id')
        ->where('cow_history.status',1)
        ->where('cow.status',1)
        ->orderBy('cow.created_at','desc')
        ->select('*','cow.id as cow_id','users.name as users_name','member.name as member_name','cow.name as cow_name','cow.picture as cow_picture','cow.dob as cow_dob','cow.created_at as cow_created_at')
        ->get();
        $member = Users::join('member','member.users_id','=','users.id')
        ->select('member.name as member_name','users.name as users_name','member.id as member_id')
        ->get();
        $cow_m = Cow::join('breeder_m','breeder_m.cow_id','cow.id')
        ->where('cow.status',1)
        ->select('*','cow.id as cow_id')
        ->get();
        $cow_f = Cow::join('breeder_f','breeder_f.cow_id','cow.id')
        ->where('cow.status',1)
        ->select('*','cow.id as cow_id')
        ->get();
        $i = 1;
        return view('young_cow')->with(['cow'=>$cow,'i'=>$i,'member'=>$member,'cow_m'=>$cow_m,'cow_f'=>$cow_f]);
    }
    public function kokun(){
        $cow = Cow_history::join('cow','cow.qrcode','cow_history.cow_id')
        ->join('member','member.id','cow_history.member_id')
        ->join('users','users.id','member.users_id')
        ->where('cow_history.status',1)
        ->where('cow.status',1)
        ->orderBy('cow.created_at','desc')
        ->select('*','cow.id as cow_id','users.name as users_name','member.name as member_name','cow.name as cow_name','cow.picture as cow_picture','cow.dob as cow_dob','cow.created_at as cow_created_at')
        ->get();
        $member = Users::join('member','member.users_id','=','users.id')
        ->select('member.name as member_name','users.name as users_name','member.id as member_id')
        ->get();
        $cow_m = Cow::join('breeder_m','breeder_m.cow_id','cow.id')
        ->where('cow.status',1)
        ->select('*','cow.id as cow_id')
        ->get();
        $cow_f = Cow::join('breeder_f','breeder_f.cow_id','cow.id')
        ->where('cow.status',1)
        ->select('*','cow.id as cow_id')
        ->get();
        $i = 1;
        return view('kokun')->with(['cow'=>$cow,'i'=>$i,'member'=>$member,'cow_m'=>$cow_m,'cow_f'=>$cow_f]);
    }

    public function ready_cow(){
        $cow = Cow_history::join('cow','cow.qrcode','cow_history.cow_id')
        ->join('member','member.id','cow_history.member_id')
        ->join('users','users.id','member.users_id')
        ->where('cow_history.status',1)
        ->where('cow.status',1)
        ->orderBy('cow.created_at','desc')
        ->select('*','cow.id as cow_id','users.name as users_name','member.name as member_name','cow.name as cow_name','cow.picture as cow_picture','cow.dob as cow_dob','cow.created_at as cow_created_at')
        ->get();
        $member = Users::join('member','member.users_id','=','users.id')
        ->select('member.name as member_name','users.name as users_name','member.id as member_id')
        ->get();
        $cow_m = Cow::join('breeder_m','breeder_m.cow_id','cow.id')
        ->where('cow.status',1)
        ->select('*','cow.id as cow_id')
        ->get();
        $cow_f = Cow::join('breeder_f','breeder_f.cow_id','cow.id')
        ->where('cow.status',1)
        ->select('*','cow.id as cow_id')
        ->get();
        $i = 1;
        return view('ready_cow')->with(['cow'=>$cow,'i'=>$i,'member'=>$member,'cow_m'=>$cow_m,'cow_f'=>$cow_f]);
    }

    public function delete_breeder(Request $request){
        $breeder = Breeder::find($request::get('id'));
        $breeder->delete();
        return back();
    }

    public function delete_cow(Request $request){
        $cow = Cow::find($request::get('id'));
        $cow->delete();
        return back();
    }

    public function profile_cow($id){
        $cow = Cow::leftjoin('breeder_m','breeder_m.cow_id','cow.id')
        ->leftjoin('breeder_f','breeder_f.cow_id','cow.id')
        ->join('cow_history','cow_history.cow_id','cow.qrcode')
        ->join('member','member.id','cow_history.member_id')
        ->join('users','users.id','member.users_id')
        ->where('cow.id',$id)
        ->where('cow_history.status','1')
        ->select('*','member.address as member_address','cow.id as cow_id','users.name as users_name','member.name as member_name','cow.name as cow_name','cow.picture as cow_picture','cow.dob as cow_dob','member.id as member_id','breeder_m.id as breeder_m_id','breeder_f.id as breeder_f_id')
        ->get();
        $c = Cow_history::join('cow','cow.qrcode','cow_history.cow_id')
        ->join('member','member.id','cow_history.member_id')
        ->where('cow.id',$id)
        ->orderBy('cow_history.date', 'desc')
        ->select('*','member.name as member_name','cow_history.date as cow_history_date','cow_history.id as cow_history_id')
        ->get();
        $cow_breeder = Cow::all();
        $breeder_f = Cow::join('cow_history','cow_history.cow_id','cow.qrcode')
        ->join('breeder_f','breeder_f.cow_id','cow.id')
        ->select('*','cow.id as cow_id')
        ->where('cow_history.status',1)
        ->get();

        $breeder_m = Cow::join('cow_history','cow_history.cow_id','cow.qrcode')
        ->join('breeder_m','breeder_m.cow_id','cow.id')
        ->select('*','cow.id as cow_id')
        ->where('cow_history.status',1)
        ->get();
        $l = $cow[0];
        $i = 1;
        $members = Member::all();
        $type_breeds = Type_breed::all();
        $breeds = Breed::join('type_breed','type_breed.id','breed.type_breed_id')
        ->where('breeder_f_id',$id)
        ->orWhere('breeder_m_id',$id)
        ->get();
        $x = 1;

        return view('profile_cow')->with(['l'=>$l,'c'=>$c,'members'=>$members,'i'=>$i,'cow_breeder'=>$cow_breeder,'breeder_f'=>$breeder_f,'breeder_m'=>$breeder_m,'type_breeds'=>$type_breeds,'breeds'=>$breeds,'x'=>$x]);
    }

    public function post_history_cow(Request $request){
        $history = Cow_history::where('cow_id',$request::get('cow_id'))
        ->update(['status'=> 0]);

        $cow = new Cow_history();
        $cow->cow_id = $request::get('cow_id');
        $cow->member_id = $request::get('member_id');
        $cow->status = '1';
        $cow->date = Carbon::now();
        $cow->save();

        return back();
    }



    public function form_trading(){
        $customer = Customer::all();
        $list = Cow::where('status',1)->get();
        return view('form_trading')->with(['customer'=>$customer,'list'=>$list]);
    }

    public function post_customer(Request $request){
        $customer = New Customer();
        $customer->iden = $request::get('iden');
        $customer->name = $request::get('name');
        $customer->address = $request::get('address');
        $customer->email = $request::get('email');
        $customer->phone = $request::get('phone');
        $customer->save();

        return back();
    }

    public function post_trading(Request $request){

        $cow = Cow::where('id',$request::get('cow_id'))
        ->update(['status'=> 0]);

        $trading = New Trading();
        $trading->customer_id = $request::get('customer_id');
        $trading->cow_id = $request::get('cow_id');
        $trading->trading_date = $request::get('trading_date');
        $trading->weight = $request::get('weight');
        $trading->price = $request::get('price');
        $trading->save();

        return back();
    }
    
    public function delete_cow_history(Request $request){
        $cow = Cow_history::find($request::get('id'));
        $cow->delete();
        return back();
    }
    public function update_cow(Request $request){
        $cow = Cow::find($request::get('id'));
        $cow->name = $request::get('name');
        $cow->detail = $request::get('detail');
        $cow->gender = $request::get('gender');
        $cow->dob = $request::get('dob');
        $cow->breeder_m = $request::get('breeder_m');
        $cow->breeder_f = $request::get('breeder_f');

        if($request::hasFile('picture')) {
            $picture = 'picture'.Carbon::now()->toDateString().str_random().'.jpg';
            $destination = public_path().'/images/';
            $request::file('picture')->move($destination, $picture);

            $cow->picture=$picture;
        }
        $cow->save();
        return back();
    }

    public function post_breed(Request $request){
        $breeder = New Breed();
        $breeder->breeder_f_id = $request::get('breeder_f');
        $breeder->breeder_m_id = $request::get('breeder_m');
        $breeder->type_breed_id = $request::get('type_breed_id');
        $breeder->breed_date = $request::get('breed_date');
        $breeder->save();

        return back();
    }

    public function trading(){
        $trading = Trading::join('cow','cow.id','trading.cow_id')
        ->join('customer','customer.id','trading.customer_id')
        ->select('*','customer.name as customer_name','cow.name as cow_name')
        ->get();
        $communitys = Users::all();
        $i = 1;
        return view('trading')->with(['trading'=>$trading,'i'=>$i,'communitys'=>$communitys]);
    }

    public function result_trading(Request $request){
        
        if($request::get('community')!=null){
        $trading = Cow::join('trading','trading.cow_id','cow.id')
        ->join('customer','customer.id','trading.customer_id')
        ->join('cow_history','cow_history.cow_id','cow.qrcode')
        ->join('member','member.id','cow_history.member_id')
        ->where('cow_history.status',1)
        ->whereIn('users_id',$request::get('community'))
        ->whereBetween('trading.trading_date',[$request::get('start'),$request::get('end')])
        ->select('*','customer.name as customer_name','cow.name as cow_name')
        ->get();
        }else{
        $trading = Cow::join('trading','trading.cow_id','cow.id')
        ->join('customer','customer.id','trading.customer_id')
        ->join('cow_history','cow_history.cow_id','cow.qrcode')
        ->join('member','member.id','cow_history.member_id')
        ->where('cow_history.status',1)
        ->whereBetween('trading.trading_date',[$request::get('start'),$request::get('end')])
        ->select('*','customer.name as customer_name','cow.name as cow_name')
        ->get();
        }
        $c = $request::get('community');
        $start = $request::get('start');
        $end = $request::get('end');
        $i = 1;

        
        return view('result_trading')->with(['trading'=>$trading,'i'=>$i,'c'=>$c,'start'=>$start,'end'=>$end]);
    }
}
