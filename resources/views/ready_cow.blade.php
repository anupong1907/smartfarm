@extends('layouts.master')

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
@stop
