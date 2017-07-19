@extends('layouts.master')

@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">ข้อมูลการจำหน่ายโคทั้งหมด <span style="font-size: 14px;">ระบบการจำหน่ายโค</span></h3>
	</div>
	<div class="header-buttons">
		<a type="button" href="{{url('form_trading')}}" class="btn btn-success"><i class="icon-plus"></i> |เพิ่มข้อมูล </a> 
		<button type="button" class="btn btn-info" style="background: #FFCC66; border-color: #FFCC66;"><i class="icon-file-pdf"></i> | รายงานข้อมูลประชากรโค</button>
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">หน้าหลัก</a></li>
		<li class="active">ข้อมูลการจำหน่ายโคทั้งหมด</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>
</div>
<!-- /breadcrumbs line -->
<div class="form-group">
	<div class="datatable">
		<table class="table table-striped">
			<thead style="background-color: #283747;">
				<tr style="color: #fff;">
					<th width="30" class="center" style="background-color: #283747; color: #FFF;">ลำดับ</th>
					<th width="120" class="center" style="background-color: #283747; color: #FFF;">ชื่อผู้ซื้อ</th>
					<th width="150" class="center" style="background-color: #283747; color: #FFF;">ข้อมูลโค</th>
					<th width="100" class="center" style="background-color: #283747; color: #FFF;">วันที่</th>
					<th width="100" class="right" style="background-color: #283747; color: #FFF;">ราคา (บาท)</th>
					<th width="100" class="center" style="background-color: #283747; color: #FFF;">จัดการ</th>
				</tr>
			</thead>
			<tbody class="center">
				@foreach($trading as $data)
				<tr>
					<td class="center">{{$i++}}</td>
					<td class="center">{{$data->customer_name}}</td>
					<td class="center">{{$data->qrcode}} - {{$data->cow_name}}</td>
					<td class="center">{{$data->trading_date}}</td>
					<td class="right">{{number_format($data->price,2)}}</td>
					<td class="center">
						<a href="#" type="button" class="btn btn-info btn-xs btn-icon"><i class="icon-search3"></i></a>
						<a href="#" type="button" class="btn btn-danger btn-xs btn-icon" data-toggle="modal"><i class="icon-cancel-circle"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop
