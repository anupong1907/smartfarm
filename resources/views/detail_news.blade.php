@extends('layouts.master')

@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">ข่าวสารประชาสัมพันธ์ <span style="font-size: 14px;">SmartFarming</span></h3>
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">หน้าหลัก</a></li>
		<li><a href="{{url('news')}}">ข่าวสารประชาสัมพันธ์</a></li>
		<li class="active">รายละเอียดข่าวสารประชาสัมพันธ์</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>
</div>
<!-- /breadcrumbs line -->
<div class="form-group">
	<div class="row">
	<div class="col-md-8" style="border-right:1px solid #EBEDEF;">
		<div class="form-group">
			<h1 style="margin-top: 0;"><i class="icon-stack"></i> {{$news_detail->news_name}} <span class="label label-success">{{$news_detail->type_news_name}}</span> <small class="display-block">เผยแพร่ข่าวสารโดย : {{$news_detail->users_name}}</small></h1>
			<div class="form-group">

				<img src="@if($news_detail->news_picture != null) {{ url('images/'. $news_detail->news_picture) }} @else http://www.shoshinsha-design.com/wp-content/uploads/2016/10/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88-2016-10-08-23.33.04-705x460.png @endif " style="object-fit: cover; 
				width: 100%; 
				height: 300px; 
				filter: brightness(0.90); ">
			</div>
			<p style="font-size: 16px;">{{$news_detail->detail}}</p>
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
</div>
@stop
