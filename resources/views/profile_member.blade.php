<?php Use Carbon\Carbon; ?> 
@extends('layouts.master')

@section('css')
<style>
	#map-canvas{
		width: 100%;
		height: 300px;
	}

</style>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBT4GRmRnmCdikdUOz0HJkJ7YuZJo2NdLc&libraries=places" type="text/javascript"></script>
@stop

@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">ข้อมูลส่วนตัวสมาชิก <span style="font-size: 14px;"> ระบบจัดการสมาชิก  </span></h3>
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">หน้าแรก</a></li> 
		<li><a href="{{url('member')}}">ระบบจัดการสมาชิก</a></li>
		<li class="active"> ข้อมูลส่วนตัวสมาชิก</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>
</div>
<div class="form-group">
	<div class="row">
		<div class="col-lg-4" style="border-right:1px solid #EBEDEF;">

			<!-- Profile links -->
			<div class="block">

				<div class="block">
					<div class="thumbnail">
						<div class="thumb">
							<img src="@if($member->member_picture != null) {{ url('images/'. $member->member_picture) }} @else https://www.shearwater.com/wp-content/plugins/lightbox/images/No-image-found.jpg @endif " style=" object-fit: cover; width: 200px; height: 200px; border-radius: 5px; ">
						</div>
						<div class="caption text-center">
							<h6 style="font-size: 16px;">{{$member->member_name}} <small>{{$member->users_name}}</small></h6>
						</div>
					</div>
				</div>
			</div>
			<!-- /profile links -->
			<table class="table table-condensed table-hover">
				<thead>
					<tr>
						<th colspan="3">ข้อมูลส่วนตัวสมาชิก</th>
					</tr>
				</thead>
				<tbody style="font-size: 13px;">
					<tr>
						<td>ชื่อ</td>
						<td>{{$member->member_name}}</td>
					</tr>
					<tr>
						<td>ที่อยู่</td>
						<td>{{$member->member_address}}</td>
					</tr>
					<tr>
						<td>ชุมชน</td>
						<td><a href="{{url('community/'.$member->users_id)}}">{{$member->users_name}}</a></td>
					</tr>
				</tbody>
			</table>
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
							<td>{{$member->member_phone}}</td>
						</tr>
						<tr>
							<td>อีเมลล์</td>
							<td>{{$member->member_email}}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="form-group">
				<div id="map-canvas"></div>
			</div>
		</div>

		<div class="col-lg-8" >
			
			<div class="tabbable page-tabs">
				<ul class="nav nav-pills nav-justified">
					<li class="active"><a href="#cow" data-toggle="tab"><i class="icon-paragraph-justify2"></i> ข้อมูลประชากรโคทั้งหมด </a></li>
					<li><a href="#grass" data-toggle="tab"><i class="icon-stats2"></i> ข้อมูลหญ้าเนียร์เปียร์ </a></li>
					<li><a href="#dung" data-toggle="tab"><i class="icon-bubbles3"></i> ข้อมูลมูลโค</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active fade in" id="cow">
						<div class="form-group">
							<div class="panel panel-default" style="height: 90px;">
								<div class="panel-body">
									<div class="block">
										<ul class="statistics list-justified">
											<?php 
											foreach ($member_cows as $cow) {
												if ($cow->cow_status==1) {
													if (Carbon::parse($cow->dob)->diff(Carbon::now())->format('%y%m')< '8') {
														$a = $a+1;
													}
												}

											}

											foreach ($member_cows as $cow) {
												if ($cow->cow_status==1) {
													if (Carbon::parse($cow->dob)->diff(Carbon::now())->format('%y%m') > '8' && Carbon::parse($cow->dob)->diff(Carbon::now())->format('%y%m') < '16' ) {
														$b = $b+1;
													}
												}
											}

											foreach ($member_cows as $cow) {
												if ($cow->cow_status==1) {
													if($cow->breeder_m_id==null&&$cow->breeder_f_id==null){
														if (Carbon::parse($cow->dob)->diff(Carbon::now())->format('%y%m') > '16') {
															$c = $c+1;
														}

													}
												}

											}
											?>
											
											<li>
												<div class="statistics-info">
													<a href="#" title="" class="bg-primary"><i class="icon-link6"></i></a>
													<strong>{{$breeder_m+$breeder_f}}</strong>
												</div>
												<div class="progress progress-micro">
													<div class="progress-bar progress-bar-primary" role="progressbar" style="width: @if($breeder_m!=null||$breeder_f!=null){{($breeder_m + $breeder_f)*(100 /$cow_count)}}%; @endif">
													</div>
												</div>
												<span>โคพ่อพันธุ์และโคแม่พันธุ์</span>
											</li>
											<li>
												<div class="statistics-info">
													<a href="#" title="" class="bg-warning"><i class="icon-point-up"></i></a>
													<strong>{{$a}} </strong>
												</div>
												<div class="progress progress-micro">
													<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuemax="100" style="width: @if($a!=null){{$a * 100 /$cow_count}}%; @endif">
													</div>
												</div>
												<span>ประชากรลูกโค</span>
											</li>
											<li>
												<div class="statistics-info">
													<a href="#" title="" class="bg-info"><i class="icon-cart-plus"></i></a>
													<strong>{{$b}}</strong>
												</div>
												<div class="progress progress-micro">
													<div class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: @if($b!=null){{$b * 100 /$cow_count}}%; @endif">
													</div>
												</div>
												<span>ประชากรโคขุน</span>
											</li>
											<li>
												<div class="statistics-info">
													<a href="#" title="" class="bg-danger"><i class="icon-coin"></i></a>
													<strong>{{$c}}</strong>
												</div>
												<div class="progress progress-micro">
													<div class="progress-bar progress-bar-danger" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: @if($c!=null){{$c * 100 /$cow_count}}%; @endif">
													</div>
												</div>
												<span>โคพร้อมจำหน่าย</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<span class="label label-primary">คำอธิบาย</span> &nbsp;&nbsp;<img src="{{url('images/Circle_Green.png')}}">  โคที่มีสถานะอยู่กับเจ้าของ &nbsp;&nbsp;<img src="{{url('images/Circle_Red.png')}}">   โคที่มีสถานะถูกขายหรือตายไปแล้ว
						</div>
						<div class="datatable">
							<table class="table table-striped ">
								<thead >
									<tr>
										<th width="30" class="center" style="background-color: #283747; color: #FFF;">ลำดับ</th>
										<th width="170" style="background-color: #283747; color: #FFF;">รายการ</th>
										<th width="100" class="center" style="background-color: #283747; color: #FFF;">อายุ</th>
										<th width="120" class="center" style="background-color: #283747; color: #FFF;">ประเภท</th>
										<th width="30" class="center" style="background-color: #283747; color: #FFF;">สถานะ</th>
										<th  width="100" class="center" style="background-color: #283747; color: #FFF;">จัดการ</th>
									</tr>
								</thead>
								<tbody>
									@foreach($member_cows as $cow)
									<tr>
										<td class="center">{{$i++}}</td> 
										<td><a href="{{url('profile_cow/'.$cow->cow_id)}}" target="_blank">{{$cow->qrcode}} - {{$cow->name}}</a></td> 
										<td>{{Carbon::parse($cow-> dob)->diff(Carbon::now())->format('%y ปี %m เดือน')}}</td>  
										<td class="center">
											@if($cow->breeder_f_id != null || $cow->breeder_m_id != null)
											@if($cow->breeder_f_id == null)
											<span class="label label-primary">โคพ่อพันธุ์</span> 
											@else
											<span class="label label-default">โคแม่พันธุ์</span> 
											@endif  
											@else 
											@if(Carbon::parse($cow-> dob)->diff(Carbon::now())->format('%y%m')
											< '8') <span class="label label-info"> ลูกโค</span>
											@elseif(Carbon::parse($cow-> dob)->diff(Carbon::now())->format('%y%m')
											< '16') <span class="label label-success"> โคขุน</span>
											@elseif(Carbon::parse($cow-> dob)->diff(Carbon::now())->format('%y%m') > '16')
											<span class="label label-warning"> พร้อมจำหน่าย</span> 
											@endif 
											@endif
										</td> 
										<td class="center">
											@if($cow->cow_status==1)
											<img src="{{url('images/Circle_Green.png')}}">
											@else
											<img src="{{url('images/Circle_Red.png')}}"> 
											@endif
										</td>  
										<td class="center">
											<div class="visible-md visible-lg hidden-sm hidden-xs">
												<a href="{{url('profile_cow/'.$cow->cow_id)}}" style="color: #1B2631;"><i class="icon-search3"></i></a>&nbsp;&nbsp;
												<a href="#edit_{{$cow->qrcode}}" style="color: #1B2631;"><i class="icon-pencil2"></i></a>&nbsp;&nbsp;
												<a href="#delete_{{$cow->qrcode}}" data-toggle="modal" style="color: #1B2631;"><i class="icon-remove2"></i></a>
											</div>
										</td> 
									</tr>
									@endforeach
								</tbody>
							</table>

						</div>
					</div>
					<div class="tab-pane" id="grass">
							<div class="form-group">
							<span class="label label-primary">คำอธิบาย</span> &nbsp;&nbsp;<img src="{{url('images/Circle_Green.png')}}">  พื้นที่ที่มีหญ้าปลูกอยู่ &nbsp;&nbsp;<img src="{{url('images/Circle_Red.png')}}">   พื้นที่ไม่ได้ปลูกหญ้า
						</div>
						<div class="form-group">
	<div class="datatable">
		<table class="table table-striped">
			<thead >
				<tr style="background-color: #283747; color: #FFF;">
					<th width="10" class="center" style="background-color: #283747;">ลำดับ</th>
					<th style="background-color: #283747;">พื้นที่/ไร่</th>
					<th style="background-color: #283747;">วันที่ปลูก</th>
					<th style="background-color: #283747;">วันที่เก็บ</th>
					<th style="background-color: #283747;">สถานะ</th>
					<th style="background-color: #283747;" class="center">จัดการ</th>					
				</tr>
			</thead>
			<tbody>
				@foreach($grass as $list)
				<tr>
					<td>{{$no++}}</td>
					<td>{{$list->area}}</td>
					<td>{{ \Carbon\Carbon::parse($list->start_date)->format('d-m-Y')}}</td>
					<td>{{ \Carbon\Carbon::parse($list->end_date)->format('d-m-Y')}}</td>
					<td>
						@if($list->status == 1)
						<img src="{{url('images/Circle_Green.png')}}">
						@else
						<img src="{{url('images/Circle_Red.png')}}">
						@endif
					</td>
					<td class="center">
						<div class="visible-md visible-lg hidden-sm hidden-xs">
							<a href="{{url('profile_member/'.$list->member_id)}}" style="color: #1B2631;"><i class="icon-search3"></i></a>&nbsp;&nbsp;
							<a href="#edit_{{$list->member_id}}" data-toggle="modal" style="color: #1B2631;"><i class="icon-pencil2"></i></a>&nbsp;&nbsp;
							<a href="#delete_{{$list->member_id}}" style="color: #1B2631;" data-toggle="modal"><i class="icon-remove2"></i></a>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		
		</table>
	</div>
</div>
					</div>
					<div class="tab-pane" id="dung">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@foreach($member_cows as $list)
<div id="delete_{{$list->qrcode}}" class="modal fade" tabindex="-1" role="dialog">
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
					คุณต้องการลบข้อมูลรายการ "<span class="text-danger">{{$list->name}}</span>" ใช่หรือไม่?
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
							<a data-toggle="modal" href="#edit_{{$list->cow_id}}" >
								<button type="button" class="btn btn-xs btn-default" data-dismiss="modal" style="">แก้ไขรายการ</button>
							</a>
							<form style="display: inline;" action="{{url('delete_cow')}}" method="post">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{$list->cow_id}}">
								<button type="submit" class="btn btn-xs btn-success" style="background-color: #1A5276; border-color: #1A5276;"> ลบรายการ</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach
@foreach($member_cows as $list)
<div id="edit_{{$list->qrcode}}" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="panel panel-default">
			<form method="post" action="{{url('update_cow')}}" enctype="multipart/form-data">
				<input type="hidden" name="id" value="{{$list->cow_id}}">
				{{ csrf_field() }}
				<div class="panel-body">
					<div style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">แก้ไขข้อมูลประวัติโค <p style="font-size: 14px;">กรุณาระบุข้อมูลให้ถูกต้องและครบถ้วนเพื่อความสมบูรณ์ของข้อมูล โดยช่องที่มีเครื่องหมาย<span class="text-danger"> * </span> ไม่สามารถเว้นว่างได้</p></div>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">
											รหัสประจำตัวโค <span class="symbol required"></span>
										</label>
										<input type="text" class="form-control" name="id" value="{{$list->qrcode}}" disabled="disabled">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">
											ชื่อ <span class="symbol required"></span>
										</label>
										<input type="text" class="form-control" name="name" value="{{$list->cow_name}}">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">
									รายละเอียดเพิ่มเติม <span class="symbol required"></span>
								</label>
								<textarea class="form-control" name="detail">{{$list->cow_detail}}</textarea>
							</div>
							<div class="form-group">
								<label class="control-label">
									วันเกิด<span class="symbol required"></span>
								</label>
								<input class="form-control" type="date" name="dob" value="{{$list->cow_dob}}">
							</div>
							<div class="form-group">
								<label class="control-label">
									เพศ <span class="symbol required"></span>
								</label>
								<div class="radio">
									<label class="radio-inline " >
										<input type="radio" id="f_{{$list->cow_id}}" name="gender" class="styled " value="f">
										เพศเมีย
									</label>
									<label class="radio-inline">
										<input type="radio" id="m_{{$list->cow_id}}" name="gender" class="styled" value="m">
										เพศผู้
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>
									รูปภาพประกอบ
								</label>
								<input type="file" class="styled" name="picture">
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="form-field-select-3">
											โคพ่อพันธุ์
										</label>
										<select class="select-full" name="breeder_m">
											<option value="">&nbsp;</option>
											@foreach($breeder_cows as $l)
											<option value="{{$l->cow_id}}"  @if($l->cow_id==$list->breeder_m) selected='selected' @endif>{{$l->qrcode}} - {{$l->name}} </option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="form-field-select-3">
											โคแม่พันธุ์
										</label>
										<select class="select-full" name="breeder_f">
											<option value="">&nbsp;</option>
											@foreach($breeder_cows as $l)
											<option value="{{$l->cow_id}}"  @if($l->cow_id==$list->breeder_f) selected='selected' @endif>{{$l->qrcode}} - {{$l->name}} </option>
											@endforeach
										</select>
									</div>
								</div>
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
				</div>
			</div>
		</form>
	</div>
</div>
@endforeach

<script>
	$(document).ready(function(){
		@foreach($member_cows as $list)
		@if($list->cow_gender == 'm')
		$('#m_{{$list->cow_id}}').prop('checked', true);
		$.uniform.update('#m_{{$list->cow_id}}');
		@else
		$('#f_{{$list->cow_id}}').prop('checked', true);
		$.uniform.update('#f_{{$list->cow_id}}');
		@endif
		@endforeach
	});

	var lat = {{$member->member_lat}};
	var lng = {{$member->member_long}};
	var img = "{{url('images/home.png')}}";

	var map = new google.maps.Map(document.getElementById('map-canvas'),{
		center:{
			lat: lat,
			lng: lng
		},
		zoom: 15
	});
	
	var marker = new google.maps.Marker({
		position:{
			lat:lat,
			lng: lng
		},
		map:map,
		icon: img,
		label: "{{$member->member_address}}"
    	


	});

</script>

@stop