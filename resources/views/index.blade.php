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
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">หน้าแรก <span style="font-size: 14px;">SmartFarming</span></h3>
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="index.html">Home</a></li>
		<li class="active">Dashboard</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>
</div>
<!-- /breadcrumbs line -->
<div class="row">
	<div class="col-md-8">
		<div class="form-group">
	<div id="map-canvas"></div>
</div>
	</div>
	<div class="col-md-4">
		@foreach($last as $news)
		<div class="form-group" style="border-bottom:1px solid #EBEDEF;">
			<h6><i class="icon-new" style="color: #BE0101;"></i> <a href="{{url('detail_news/'.$news->news_id)}}">{{$news->news_name}} </a>
			<small class="display-block">{{$news->news_created_at}} - เผยแพร่ข่าวสารโดย : {{$news->users_name}}</small></h6>
		</div>
	@endforeach
	</div>
</div>

<script type="text/javascript">
	var lat = 10.3671;
	var lng = 99.2438;
	var img = "{{url('images/cow.png')}}";

	var map = new google.maps.Map(document.getElementById('map-canvas'),{
		center:{
			lat: lat,
			lng: lng
		},
		zoom: 13
	});
	
	@foreach($members as $list)
	var marker = new google.maps.Marker({
		position:{
			lat:{{$list->lat}},
			lng: {{$list->long}}
		},
		map:map,
		icon: img
	});
	@endforeach

</script>
@stop
