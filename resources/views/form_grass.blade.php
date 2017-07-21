@extends('layouts.master')
@section('css')
<style>
	#map-canvas{
		width: auto;
		height: 300px;
	}
</style>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBT4GRmRnmCdikdUOz0HJkJ7YuZJo2NdLc&libraries=places" type="text/javascript"></script>
@stop
@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">เพิ่มข้อมูลการปลูกหญ้าเนียร์เปียร์ <br><br><p style="font-size: 14px;">กรุณาระบุข้อมูลให้ถูกต้องและครบถ้วนเพื่อความสมบูรณ์ของข้อมูล โดยช่องที่มีเครื่องหมาย<span class="text-danger"> * </span> ไม่สามารถเว้นว่างได้</p></h3>
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">หน้าหลัก</a></li>
		<li><a href="{{url('grass')}}">ระบบจัดการหญ้าเนียร์เปียร์</a></li>
		<li class="active">เพิ่มข้อมูลการหญ้าเนียร์เปียร์</li>
	</ul>
</div>
<!-- /breadcrumbs line -->
<div class="panel panel-default" >  
<form method="post" action="{{url('post_grass')}}">
	{{ csrf_field() }}
	<div class="panel-body">
		
		<div class="row">
			<div class="col-md-5">
				<ul class="media-list">
					<li class="media">
						<a class="pull-left" href="#">
							<img class="media-object" src="@if($m->picture != null) {{ url('images/'. $m->picture) }} @else https://www.shearwater.com/wp-content/plugins/lightbox/images/No-image-found.jpg @endif " style=" object-fit: cover; width: 40px; height: 40px; border-radius: 5px;">
						</a>
						<div class="media-body">
							<div class="clearfix">
								<a href="{{url('profile_member/'.$m->id)}}" class="media-heading">{{$m->name}}</a>
							</div>
							{{$m->address}}
						</div>
					</li>
				</ul>
				<hr>
				<div class="form-group">
						<label class="control-label">
							ขนาดพื้นที่ในการปลูกหญ้า / ไร่<span class="symbol required"></span>
						</label>
						<input type="text" class="form-control" name="area">
					</div>
					<div class="form-group">
				<label class="control-label">
					วันที่ปลูก<span class="symbol required"></span>
				</label>
				<input class="form-control" type="date" name="start">
			</div>
			<div class="form-group">
				<label class="control-label">
					วันที่คาดว่าจะสามารถตัดได้<span class="symbol required"></span>
				</label>
				<input class="form-control" type="date" name="end">
			</div>

			</div>
			<div class="col-md-7">
				<div class="form-group">
					<span class="label label-primary">คำอธิบาย</span> <span> <img src="{{url('images/pin.png')}}"> เลื่อนตำแหน่งพิกัดตำแหน่งที่ปลูกหญ้าเนียร์เปียร์</span> <span style="color: #EC7063;"> *ตำแหน่งไม่สามารถซ้ำกับตำแหน่งที่อยู่บ้านได้</span>
				</div>

				<div id="map-canvas"></div>
				<input type="hidden"  name="lat" id="lat">
				<input type="hidden"  name="long" id="lng">
				<input type="hidden" name="member_id" value="{{$m->id}}">
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-8">
				<p>
					หากต้องการดูข้อมูลสมาชิก กรุณาย้อนกลับไปที่หน้าระบบจัดการสมาชิก หรือคลิกที่แท็บข่าวสารประชาสัมพันธ์ด้านบน
				</p>
			</div>
			<div class="col-md-4">
				<button class="btn btn-block" type="submit" style="background: #44A504; border-color: #3D9107; color: #fff;">
					เพิ่มข้อมูล <i class="fa fa-arrow-circle-right"></i>
				</button>
			</div>
		</div>
	</div>
</form>
</div>
<script>

	

	var map = new google.maps.Map(document.getElementById('map-canvas'),{
		center:{
			lat: {{$m->lat}},
			lng: {{$m->long}}
		},
		zoom:17
	});

	var marker = new google.maps.Marker({
		position: {
			lat: {{$m->lat}},
			lng: {{$m->long}}
		},
		map: map,
		draggable: true
	});
	google.maps.event.addListener(marker,'position_changed',function(){

		var lat = marker.getPosition().lat();
		var lng = marker.getPosition().lng();

		$('#lat').val(lat);
		$('#lng').val(lng);

	});

	var img = "{{url('images/home.png')}}";
	var img1 = "{{url('images/grass.png')}}";
	var marker1 = new google.maps.Marker({
		position:{
			lat: {{$m->lat}},
			lng: {{$m->long}}
		},
		map:map,
		icon: img
	});

	@foreach($grass as $list)
		var marker2 = new google.maps.Marker({
			position:{
				lat:{{$list->lat}},
				lng: {{$list->long}}
			},
			map:map,
			icon: img1
		});
		@endforeach


</script>
@stop
