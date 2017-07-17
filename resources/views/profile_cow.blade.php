<?php Use Carbon\Carbon; ?> 
@extends('layouts.master')

@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">ประวัติข้อมูลโค <span style="font-size: 14px;"> ระบบจัดการประชากรโค </span></h3>
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">หน้าแรก</a></li>
		<li><a href="{{url('cow')}}">ประชากรโคทั้งหมด</a></li>
		<li class="active">ประวัติข้อมูลโค</li>
	</ul>
</div>
<!-- /breadcrumbs line -->
<div class="form-group">
	<div class="row">
		<div class="col-lg-4" style="border-right:1px solid #EBEDEF;">

			<!-- Profile links -->
			<div class="block">

				<div class="block">
					<div class="thumbnail">
						<div class="thumb">
							<img src="@if($l->cow_picture != null) {{ url('images/'. $l->cow_picture) }} @else https://www.shearwater.com/wp-content/plugins/lightbox/images/No-image-found.jpg @endif ">
						</div>
						<table class="table table-condensed table-hover">
							<thead>
								<tr>
									<th colspan="3" style="font-size: 16px; font-family: 'Prompt', sans-serif;">ข้อมูลเบื้องต้น</th>
								</tr>
							</thead>
							<tbody style="font-size: 13px;" >
								<tr style="text-align: left;">
									<td >รหัสประจำตัว</td>
									<td >{{$l->qrcode}}</td>
								</tr>
								<tr style="text-align: left;">
									<td>ชื่อ</td>
									<td>{{$l->cow_name}}</td>
								</tr>
								<tr style="text-align: left;">
									<td>อายุ</td>
									<td>{{Carbon::parse($l-> cow_dob)->diff(Carbon::now())->format('%y ปี %m เดือน')}}</td>
								</tr>
								<tr style="text-align: left;">
									<td>ประเภท</td>
									<td>
										@if($l->breeder_f_id != null || $l->breeder_m_id != null)
										@if($l->breeder_f_id == null)
										<span class="label label-primary">โคพ่อพันธุ์</span>
										@else
										<span class="label label-primary">โคแม่พันธุ์</span>
										@endif
										@else
										@if(Carbon::parse($l-> cow_dob)->diff(Carbon::now())->format('%y%m') < '8')
										<span class="label label-primary">ลูกโค</span>
										@elseif(Carbon::parse($l-> cow_dob)->diff(Carbon::now())->format('%y%m') < '16')
										<span class="label label-primary"> โคขุน</span>
										@elseif(Carbon::parse($l-> cow_dob)->diff(Carbon::now())->format('%y%m') > '16')
										<span class="label label-primary"> พร้อมจำหน่าย</span> 
										@endif
										@endif

									</td>
								</tr>
								<tr style="text-align: left;">
									<td>เจ้าของ</td>
									<td>
										<a href="{{url('profile_member/'.$l->member_id)}}" target="_blank">{{$l->member_name}}</a>
									</td>
								</tr>
								<tr style="text-align: left;">
									<td>ที่อยู่</td>
									<td>{{$l->member_address}}</td>
								</tr>
								<tr style="text-align: left;">
									<td>ชุมชน</td>
									<td>{{$l->users_name}}</td>
								</tr>
							</tbody>
						</table>
						@if($l->breeder_m != null && $l->breeder_f != null)
						<table class="table table-condensed table-hover">
							<thead>
								<tr> 
									<th colspan="3" style="font-size: 16px; font-family: 'Prompt', sans-serif;" >ข้อมูลการกำเนิด</th>
								</tr>
							</thead>
							<tbody style="font-size: 13px;" >
								@foreach($cow_breeder as $list)
								@if($l->breeder_m == $list->id)
								<tr style="text-align: left;">
									<td>โคพ่อพันธุ์</td>
									<td>
										<a href="{{url('profile_cow/'.$list->id)}}" target="_blank">{{$list->qrcode}} - {{$list->name}}</a>
									</td>
								</tr>
								@endif
								@endforeach
								@foreach($cow_breeder as $list)
								@if($l->breeder_f == $list->id)
								<tr style="text-align: left;">
									<td>โคแม่พันธุ์</td>
									<td>
										<a href="{{url('profile_cow/'.$list->id)}}" target="_blank">{{$list->qrcode}} - {{$list->name}}</a>
									</td>
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
						@endif
					</div>
				</div>
			</div>
			<!-- /profile links -->

		</div>

		<div class="col-lg-8">
			<div class="form-group">
				<a class="btn btn-success" type="button" style="background: #44A504; border-color: #3D9107; color: #fff;" data-toggle="modal" href="#add_transfer"> <i class="icon-transmission"></i> | โอนย้ายการเป็นเจ้าของ</a>
				<a class="btn btn-success" type="button" style="background: #F39C12; border-color: #D68910; color: #fff;" data-toggle="modal" href="#add_breed"> <i class="icon-arrow-right9"></i> | เพิ่มข้อมูลการผสมพันธุ์</a>
				<form method="post" action="{{url('post_breeder')}}" style='display:inline;'>
					{{ csrf_field() }}
					@if(Carbon::parse($l-> cow_dob)->diff(Carbon::now())->format('%y%m') > '20' && $l->breeder_m_id == null && $l->breeder_f_id == null )
					@if($l->gender == 'm')
					<input type="hidden" name="gender" value="{{$l->gender}}">
					<input type="hidden" name="cow_id" value="{{$l->cow_id}}">
					<button type="submit" class="btn" style="background: #AC0832; border-color: #95052A; color: #fff;"><i class="icon-male"></i> | เปลี่ยนสถานะเป็นโคพ่อพันธุ์</button>
					@else
					<input type="hidden" name="gender" value="{{$l->gender}}">
					<input type="hidden" name="cow_id" value="{{$l->cow_id}}">
					<button type="submit" class="btn" style="background: #AC0832; border-color: #95052A; color: #fff;"><i class="icon-female"></i> | เปลี่ยนสถานะเป็นโคแม่พันธุ์</button>
					@endif
					@endif
				</form>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading"><h6 class="panel-title"><i class="icon-menu5"></i> การโอนย้ายการเป็นเจ้าของ</h6></div>
				<div class="panel-body">
					
					<table class="table table-hover" >
						<thead style="background-color: #283747;">
							<tr style="color: #fff;">
								<th class="center">ลำดับ</th>
								<th>ชื่อเจ้าของ</th>
								<th class="hidden-xs">วันที่</th>
								<th class="center">จัดการ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($c as $list) 
							<tr>
								<td class="center">{{$i++}}</td>
								<td>{{$list->member_name}}</td>
								<td>{{$list->cow_history_date}}</td>
								<td class="center">
									<a href="#delete_{{$list->cow_history_id}}" type="button" class="btn btn-danger btn-xs btn-icon" data-toggle="modal"><i class="icon-remove2"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			@if($l->breeder_f_id != null || $l->breeder_m_id != null)
			<div class="panel panel-default">
				<div class="panel-heading"><h6 class="panel-title"><i class="icon-menu5"></i> ข้อมูลการผสมพันธุ์</h6></div>
				<div class="panel-body">
					<table class="table table-hover" >
						<thead style="background-color: #283747;">
							<tr style="color: #fff;">
								<th class="center">ลำดับ</th>
								<th>คู่ผสมพันธุ์</th>
								<th>วันที่ผสมพันธุ์</th>
								<th class="hidden-xs">ประเภท</th>
								<th class="center">จัดการ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($breeds as $breed)
							<tr>
								<td class="center">{{$x++}}</td>
								@if($l->gender == 'm')
								<td class="center">

									@foreach($cow_breeder as $list)
									@if($breed->breeder_f_id == $list->id)
									<a href="{{url('profile_cow/'.$list->id)}}">
										{{$list->qrcode}} - {{$list->name}}
									</a>
									@endif
									@endforeach

								</td>
								@else
								<td class="center">
									
									@foreach($cow_breeder as $list)
									@if($breed->breeder_m_id == $list->id)
									<a href="{{url('profile_cow/'.$list->id)}}">
										{{$list->qrcode}} - {{$list->name}}
									</a>
									@endif
									@endforeach
									
								</td>
								@endif
								<td>
									{{$breed->breed_date}}
								</td>
								<td>
									{{$breed->name}}
								</td>
								<td>
									<a href="#" type="button" class="btn btn-danger btn-xs btn-icon" data-toggle="modal"><i class="icon-remove2"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>

@foreach($c as $list)
<div id="delete_{{$list->cow_history_id}}" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog ">
		<div class="panel panel-default">
			<div class="panel-heading" >
				<h6 class="panel-title">ข้อมูลที่เกี่ยวข้องกับรายการนี้จะถูกลบไปด้วย</h6>
				<div class="panel-icons-group">
					<a href="#" data-dismiss="modal" class="btn btn-link btn-icon"><i class="icon-cancel-circle"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<p>
					คุณต้องการลบข้อมูลรายการ "<span class="text-danger">{{$list->member_name}} - {{$list->cow_history_date}}</span>" ใช่หรือไม่?
				</p>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="text-left">
							<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">ยกเลิก</button>
						</div>
					</div>
					<div class="col-md-6">
						<div class="text-right">
							<form style="display: inline;" action="{{url('delete_cow_history')}}" method="post">
								<input type="hidden" name="id" value="{{$list->cow_history_id}}">
								<button type="submit" class="btn btn-xs btn-primary">ยืนยัน</button> {{ csrf_field() }}
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach
<div id="add_transfer" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog ">
		<div class="panel panel-default">
			<div class="panel-heading" >
				<h6 class="panel-title">โอนย้ายการเป็นเจ้าของโค</h6>
				<div class="panel-icons-group">
					<a href="#" data-dismiss="modal" class="btn btn-link btn-icon"><i class="icon-cancel-circle"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<form method="post" action="{{url('post_history_cow')}}">
					{{ csrf_field() }}
					<input type="hidden" name="cow_id" value="{{$l->qrcode}}">
					<div class="form-group">
						<div class="row">
							<div class="col-md-9">
								<select data-placeholder="รายชื่อสมาชิก" class="select-full" tabindex="2" name="member_id">
									<option value=""></option> 
									@foreach($members as $member)
									@if($l->member_id != $member->id)
									<option value="{{$member->id}}">{{$member->name}}</option>
									@endif
									@endforeach
								</select>
							</div>
							<div class="col-md-3">
								<button class="btn btn-block btn-primary" type="submit" style="background: #212F3D; border-color: #283747; color: #fff;">บันทึกข้อมูล</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="add_breed" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog ">
		<div class="panel panel-default">
			<div class="panel-heading" >
				<h6 class="panel-title">โอนย้ายการเป็นเจ้าของโค</h6>
				<div class="panel-icons-group">
					<a href="#" data-dismiss="modal" class="btn btn-link btn-icon"><i class="icon-cancel-circle"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<form method="post" action="{{url('post_breed')}}">
					{{ csrf_field() }}
					@if($l->gender == 'm')
					<input type="hidden" name="breeder_m" value="{{$l->cow_id}}">
					@else
					<input type="hidden" name="breeder_f" value="{{$l->cow_id}}">
					@endif
					<div class="form-group">
						<div class="row">
							<div class="col-md-3">
								<label>คู่ผสมพันธุ์ :</label>
							</div>
							<div class="col-md-9">
								@if($l->gender == 'm')
								<select data-placeholder="รายชื่อสมาชิก" class="select-full" tabindex="2" name="breeder_f">
									<option value=""></option> 
									@foreach($breeder_f as $breeder)
									@if($breeder->gender == 'f')
									<option value="{{$breeder->cow_id}}">{{$breeder->qrcode}} - {{$breeder->name}}</option>
									@endif
									@endforeach
								</select>
								@else
								<select data-placeholder="รายชื่อสมาชิก" class="select-full" tabindex="2" name="breeder_m">
									<option value=""></option> 
									@foreach($breeder_m as $breeder)
									@if($breeder->gender == 'm')
									<option value="{{$breeder->cow_id}}">{{$breeder->qrcode}} - {{$breeder->name}}</option>
									@endif
									@endforeach
								</select>
								@endif
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-3">
								<label>ประเภทการผสมพันธุ์ : </label>
							</div>
							<div class="col-md-9">
								<select data-placeholder="ประเภทการผสมพันธุ์" class="select-full" tabindex="2" name="type_breed_id">
									<option value=""></option>
									@foreach($type_breeds as $type_breed)
									<option value="{{$type_breed->id}}">{{$type_breed->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-3">
								<label>วันที่ผสมพันธุ์ : </label>
							</div>
							<div class="col-md-9">
								<input class="form-control" type="date" name="breed_date">
							</div>
						</div>
					</div>
					<hr>
					<div class="text-right">
						<button type="button" name="export_pdf" class="btn btn-xs btn-default" data-dismiss="modal">ยกเลิก</button>
						<button class="btn btn-xs" type="submit" style="background: #44A504; border-color: #3D9107; color: #fff;">
							เพิ่มข้อมูล 
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop
