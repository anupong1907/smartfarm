<?php

namespace App\Http\Controllers;

use Request;
use App\Users;


class CommunityController extends Controller
{
    public function community($id){
    	$community = Users::where('id',$id)->get();
    	$list = $community[0];
    	return view('community')->with(['list'=>$list]);
    }
}