@extends('layouts.master')

@section('css')

<style>
	#map-canvas{
		width: auto;
		height: 300px;
	}
	#chartdiv {
		width: 100%;
		height: 500px;
		font-size: 11px;
	}

	.amcharts-pie-slice {
		transform: scale(1);
		transform-origin: 50% 50%;
		transition-duration: 0.3s;
		transition: all .3s ease-out;
		-webkit-transition: all .3s ease-out;
		-moz-transition: all .3s ease-out;
		-o-transition: all .3s ease-out;
		cursor: pointer;
	}

	.amcharts-pie-slice:hover {
		transform: scale(1.1);
	}	
</style>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBT4GRmRnmCdikdUOz0HJkJ7YuZJo2NdLc&libraries=places" type="text/javascript"></script>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
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
	<div class="col-md-8" >
		<div class="form-group">
			<!-- Page statistics -->
	    	<ul class="page-stats list-justified block">
	    		<li class="bg-default">
	    			<div class="page-stats-showcase">
	    				<span>รายการข่าวสารทั้งหมด</span>
	    				<h2>22.504</h2>
	    			</div>	    		</li>
	    		<li class="bg-default">
	    			<div class="page-stats-showcase">
	    				<span>จำนวนสมาชิกทั้งหมด</span>
	    				<h2>$16.290</h2>
	    			</div>
	    		</li>
	    		<li class="bg-default">
	    			<div class="page-stats-showcase">
	    				<span>จำนวนประชากรโค</span>
	    				<h2>22.504</h2>
	    			</div>
	    		</li>
	    		<li class="bg-default">
	    			<div class="page-stats-showcase">
	    				<span>จำนวนมูลโคทั้งหมด</span>
	    				<h2>$16.290</h2>
	    			</div>
	    		</li>
	    	</ul>
	    	<!-- /page statistics -->
		</div>
		<h5 style="font-family: 'Prompt', sans-serif; font-size: 16px;">รายงานสถิติการเลี้ยงโคในแต่ละชุมชนรัฐวิสาหกิจ</h5>
		<div class="form-group">
			<div id="chartdiv"></div>	
		</div>
		
	</div>
	<div class="col-md-4" style="border-left:1px solid #EBEDEF;">
	<h5 style="font-family: 'Prompt', sans-serif; font-size: 16px;">รายการการเพิ่มข้อมูลโคล่าสุด </h5>
		@foreach($last as $news)
		<div class="form-group" style="border-bottom:1px solid #EBEDEF;">
			<h6><i class="icon-new" style="color: #BE0101;"></i> <a href="{{url('detail_news/'.$news->news_id)}}">{{$news->news_name}} </a>
				<small class="display-block">{{$news->news_created_at}} - เผยแพร่ข่าวสารโดย : {{$news->users_name}}</small></h6>
			</div>
			@endforeach
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
		<h5 style="font-family: 'Prompt', sans-serif; font-size: 16px;">รายงานสถิติการเลี้ยงโคในแต่ละชุมชนรัฐวิสาหกิจ</h5>
			<div class="form-group">
				<div id="map-canvas"></div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var lat = 10.3671;
		var lng = 99.2438;
		var img = "{{url('images/cow.png')}}";
		var img1 = "{{url('images/grass.png')}}";

		var map = new google.maps.Map(document.getElementById('map-canvas'),{
			center:{
				lat: lat,
				lng: lng
			},
			zoom: 10
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

		@foreach($grass as $list)
		var marker = new google.maps.Marker({
			position:{
				lat:{{$list->lat}},
				lng: {{$list->long}}
			},
			map:map,
			icon: img1
		});
		@endforeach

		var chart = AmCharts.makeChart("chartdiv", {
			"type": "pie",
			"startDuration": 0,
			"theme": "light",
			"addClassNames": true,
			
			"innerRadius": "30%",
			"defs": {
				"filter": [{
					"id": "shadow",
					"width": "200%",
					"height": "200%",
					"feOffset": {
						"result": "offOut",
						"in": "SourceAlpha",
						"dx": 0,
						"dy": 0
					},
					"feGaussianBlur": {
						"result": "blurOut",
						"in": "offOut",
						"stdDeviation": 5
					},
					"feBlend": {
						"in": "SourceGraphic",
						"in2": "blurOut",
						"mode": "normal"
					}
				}]
			},
			"dataProvider": [
			@foreach($commu as $list)
			{
				"country": "{{$list->users_name}}",
				"litres": "{{$list->cow_count}}"
			},
			@endforeach
			],
			"valueField": "litres",
			"titleField": "country",
			"export": {
				"enabled": true
			}
		});

		chart.addListener("init", handleInit);

		chart.addListener("rollOverSlice", function(e) {
			handleRollOver(e);
		});

		function handleInit(){
			chart.legend.addListener("rollOverItem", handleRollOver);
		}

		function handleRollOver(e){
			var wedge = e.dataItem.wedge.node;
			wedge.parentNode.appendChild(wedge);
		}

	</script>
	@stop
