@extends('layouts.master')
@section('css')
<style>
	#map-canvas{
		width: auto;
		height: 350px;
	}
</style>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBT4GRmRnmCdikdUOz0HJkJ7YuZJo2NdLc&libraries=places" type="text/javascript"></script>
@stop
@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">เพิ่มสมาชิก <br><br><p style="font-size: 14px;">กรุณาระบุข้อมูลให้ถูกต้องและครบถ้วนเพื่อความสมบูรณ์ของข้อมูล โดยช่องที่มีเครื่องหมาย<span class="text-danger"> * </span> ไม่สามารถเว้นว่างได้</p></h3>
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">หน้าหลัก</a></li>
		<li><a href="{{url('member')}}">ระบบจัดการสมาชิก</a></li>
		<li class="active">เพิ่มสมาชิก</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>
</div>
<!-- /breadcrumbs line -->
<div class="panel panel-default" >  <!-- style="border-top:5px solid #44A504;" -->
	<div class="panel-body">
		<form method="post" action="{{url('post_member')}}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							ชื่อ - นามสกุล<span class="symbol required"></span>
						</label>
						<input type="text"  class="form-control" name="name">
					</div>

					<div class="form-group">
						<label class="control-label">
							ที่อยู่ <span class="symbol required"></span>
						</label>
						<textarea type="text"  class="form-control" name="address"></textarea>
					</div>
					<div class="form-group">
						<label class="control-label">
							หมายเลขโทรศัพท์<span class="symbol required"></span>
						</label>
						<input type="text"  class="form-control" name="phone">
					</div>
					<div class="form-group">
						<label class="control-label">
							อีเมลล์<span class="symbol required"></span>
						</label>
						<input type="text"  class="form-control" name="email">
					</div>


				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>
							รูปภาพประกอบ
						</label>
						<input type="file" class="styled" name="picture">
					</div>
					<div class="form-group">
						<label for="form-field-select-3">
							รัฐวิสาหกิจชุมชน
						</label>
						<select class="select-full" name="usres_id">
							<option value="">&nbsp;</option>
							@foreach($community as $list)
							<option value="{{$list->id}}">{{$list->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label class="control-label">
									ชื่อผู้ใช้งานระบบ<span class="symbol required"></span>
								</label>
								<input type="text"  class="form-control" name="username">
							</div>
							<div class="col-md-6">
								<label class="control-label">
									รหัสผ่าน<span class="symbol required"></span>
								</label>
								<input type="password"  class="form-control" name="password">
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<label class="control-label">
						พิกัดที่อยู่
					</label>
					<div class="form-group">
						<input type="text" id="searchmap" class="form-control">
					</div>
					<div id="map-canvas"></div>
					<input type="hidden" class="form-control input-sm" name="lat" id="lat">
					<input type="hidden" class="form-control input-sm" name="long" id="lng">
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
		</form>	
	</div>
</div>

<script>


	var map = new google.maps.Map(document.getElementById('map-canvas'),{
		center:{
			lat: 13.7563309,
			lng: 100.50176510000006
		},
		zoom:20
	});

	var marker = new google.maps.Marker({
		position: {
			lat: 13.7563309,
			lng: 100.50176510000006
		},
		map: map,
		draggable: true,
		title:"เลื่อนไปยังตำแหน่งที่ตั้งบ้านของคุณ"
	});

	var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));

	google.maps.event.addListener(searchBox,'places_changed',function(){

		var places = searchBox.getPlaces();
		var bounds = new google.maps.LatLngBounds();
		var i, place;

		for(i=0; place=places[i];i++){
			bounds.extend(place.geometry.location);
  			marker.setPosition(place.geometry.location); //set marker position new...
  		}

  		map.fitBounds(bounds);
  		map.setZoom(15);

  	});

	google.maps.event.addListener(marker,'position_changed',function(){

		var lat = marker.getPosition().lat();
		var lng = marker.getPosition().lng();

		$('#lat').val(lat);
		$('#lng').val(lng);

	});

</script>
@stop
