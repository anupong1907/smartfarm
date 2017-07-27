<?php Use Carbon\Carbon; ?> 
@extends('layouts.master')

@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">{{$community_name->name}} <span style="font-size: 14px;">SmartFarming</span></h3>
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">หน้าแรก</a></li>
		<li class="active">{{$community_name->name}}</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>
</div>
<!-- /breadcrumbs line -->
<div class="form-group">
	<div class="row">
		<div class="col-md-8" style="border-right:1px solid #EBEDEF;">
			<h5 style="font-family: 'Prompt', sans-serif; font-size: 16px;">รายชื่อสมาชิกทั้งหมดภายใน{{$community_name->name}}จำนวน {{$member_count}} รายการ</h5>
			<div class="form-group">
				<div class="datatable">
					<table class="table table-striped">
						<thead >
							<tr style="background-color: #283747; color: #FFF;">
								<th width="10" class="center" style="background-color: #283747;">ลำดับ</th>
								<th style="background-color: #283747;">ชื่อ-สกุล</th>
								<th style="background-color: #283747;">ที่อยู่</th>
								<th style="background-color: #283747;">หมายเลขโทรศัพท์</th>				
							</tr>
						</thead>
						<tbody>
							@foreach($member as $list)
							<tr>
								<td class="text-center">{{$i++}}</td>
								<td>{{$list->name}}</td>
								<td>{{$list->address}}</td>
								<td>{{$list->phone}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<hr>
			<h5 style="font-family: 'Prompt', sans-serif; font-size: 16px;">จำนวนประชากรโคทั้งหมดภายใน{{$community_name->name}}จำนวน {{$cow_count}} รายการ</h5>
			<div class="form-group">
				<!-- Page statistics -->
				<ul class="page-stats list-justified block">
					<li class="bg-default">
						<div class="page-stats-showcase">
							<span>โคพ่อพันธุ์และแม่พันธุ์</span>
							<h2>22.504</h2>
						</div>	    		</li>
						<li class="bg-default">
							<div class="page-stats-showcase">
								<span>โคพร้อมจำหน่าย</span>
								<h2>$16.290</h2>
							</div>
						</li>
						<li class="bg-default">
							<div class="page-stats-showcase">
								<span>โคขุน</span>
								<h2>22.504</h2>
							</div>
						</li>
						<li class="bg-default">
							<div class="page-stats-showcase">
								<span>ลูกโค</span>
								<h2>$16.290</h2>
							</div>
						</li>
					</ul>
					<!-- /page statistics -->
				</div>
				<div class="form-group">
					<div class="datatable">
						<table class="table table-striped">
							<thead style="background-color: #283747; color: #FFF;">
								<tr >
									<th width="30" class="center" style="background-color: #283747; color: #FFF;">ลำดับ</th>
									<th width="140" style="background-color: #283747; color: #FFF;">รายการ</th>
									<th width="30"  class="center" style="background-color: #283747; color: #FFF;">เพศ</th>
									<th width="100" class="center" style="background-color: #283747; color: #FFF;">อายุ</th>
									<th width="100" class="center" style="background-color: #283747; color: #FFF;">ประเภท</th>
									<th width="150" class="center" style="background-color: #283747; color: #FFF;">เจ้าของ</th>
								</tr>
							</thead>
							<tbody class="center">
								@foreach($cow as $list)
								<tr>
									<td class="center">{{$x++}}</td>
									<td><a href="{{url('profile_cow/'.$list->cow_id)}}">{{$list->qrcode}} - {{$list->cow_name}}</a></td>
									<td>
										@if($list->gender == 'f')
										<span style="color: #E74C3C;"><i class="icon-female"></i></span>
										@else
										<span style="color: #3498DB;"> <i class="icon-male"></i></span>
										@endif
									</td>
									<td class="center">
										{{Carbon::parse($list-> cow_dob)->diff(Carbon::now())->format('%y ปี %m เดือน')}}
									</td>
									<td class="center">
										@if($list->breeder_f_id != null || $list->breeder_m_id != null)
										@if($list->breeder_f_id == null)
										<span class="label label-primary">โคพ่อพันธุ์</span> 
										@else
										<span class="label label-default">โคแม่พันธุ์</span> 
										@endif 
										@else 
										@if(Carbon::parse($list-> cow_dob)->diff(Carbon::now())->format('%y%m')< '8') 
										<span class="label label-info"> ลูกโค</span>
										@elseif(Carbon::parse($list-> cow_dob)->diff(Carbon::now())->format('%y%m') < '16') 
										<span class="label label-success"> โคขุน</span>
										@elseif(Carbon::parse($list-> cow_dob)->diff(Carbon::now())->format('%y%m') > '16')
										<span class="label label-warning"> พร้อมจำหน่าย</span> 
										@endif 
										@endif
									</td>
									<td class="center">{{$list->member_name}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>		
		<div class="col-md-4">
			<div class="form-group">
				<div class="block">

				<div class="block">
					<div class="thumbnail">
						<div class="thumb">
							<img src="@if($community_name->picture != null) {{ url('images/'. $community_name->picture) }} @else https://www.shearwater.com/wp-content/plugins/lightbox/images/No-image-found.jpg @endif " style=" object-fit: cover; width: 200px; height: 200px; border-radius: 5px; ">
						</div>
						<div class="caption text-center">
							<h6 style="font-size: 16px;">{{$community_name->officer}} <small>เจ้าหน้าที่{{$community_name->name}}</small></h6>
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="form-group">
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th colspan="3">ข้อมูลการติดต่อ</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>เบอร์โทร</td>
							<td>{{$community_name->phone}}</td>
						</tr>
						<tr>
							<td>อีเมลล์</td>
							<td>{{$community_name->email}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		</div>
	</div>
	@stop
