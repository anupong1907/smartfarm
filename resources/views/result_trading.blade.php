@extends('layouts.master')

@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">ข้อมูลการจำหน่ายโค <span style="font-size: 14px;">ระบบการจำหน่ายโค</span></h3>
	</div>
	<div class="header-buttons">
		<a type="button" href="{{url('form_trading')}}" class="btn btn-success" style="background: #44A504; border-color: #3D9107; color: #fff;"><i class="icon-plus"></i> |เพิ่มข้อมูล </a> 
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
</div>
<!-- /breadcrumbs line -->

<div class="form-group">
	<div class="row" >
		<div class="col-md-9" style="border-right:1px solid #EBEDEF;">
			<div class="form-group">
				<div class="well">
					<form method="get" action="{{url('result_trading')}}">
						{{ csrf_field() }}
						<div class="form-group">
							<label class="control-label">เลือกชุมชนรัฐวิสาหกิจที่ต้องการ: </label>
							<select id="select_all" data-placeholder="เลือกชุมชนรัฐวิสาหกิจ" class="select-multiple" multiple="multiple" tabindex="2" name="community[]">
								@foreach($communitys as $list)
								@if($c!=null)
								<option value="{{$list->id}}" @foreach($c as $cc) @if($list->id == $cc) selected="selected" @endif @endforeach >{{$list->name}}</option>
								@else
								<option value="{{$list->id}}" >{{$list->name}}</option>
								@endif
								@endforeach
							</select> 

						</div>
						<div class="form-group" >
							<div class="row">
								<div class="col-md-6">
									<label class="control-label">วันที่เริ่มต้น: </label>
									<input class="form-control" type="date" name="start" value="{{$start}}">
								</div>
								<div class="col-md-6">
									<label class="control-label">วันที่สิ้นสุด: </label>
									<input class="form-control" type="date" name="end" value="{{$end}}">
								</div>
							</div>
						</div>
						<div class="form-group text-left">
							<button type="submit" class="btn btn-info"><i class="icon-search3"></i>ค้นหาข้อมูล</button>
						</div>
					</form>
				</div>
			</div>
			<div class="form-group">
				<table class="table table-striped">
					<thead style="background-color: #283747;">
						<tr style="color: #fff;">
							<th width="30" class="center" style="background-color: #283747; color: #FFF;">ลำดับ</th>
							<th width="150" class="center" style="background-color: #283747; color: #FFF;">รายการข้อมูลโค</th>
							<th width="120" class="center" style="background-color: #283747; color: #FFF;">ชื่อผู้ซื้อ</th>
							<th width="100" class="center" style="background-color: #283747; color: #FFF;">วันที่</th>
							<th width="100"  style="background-color: #283747; color: #FFF; text-align: right;">ราคา (บาท)</th>
						</tr>
					</thead>
					<?php $sum = 0; ?>
					<tbody class="center">
						@foreach($trading as $data)
						<tr>
							<td class="center">{{$i++}}</td>
							<td class="center">{{$data->qrcode}} - {{$data->cow_name}}</td>
							<td class="center">{{$data->customer_name}}</td>
							<td class="center">{{ \Carbon\Carbon::parse($data->trading_date)->format('d-m-Y')}}</td>
							<td style="text-align: right;">{{number_format($data->price,2)}}</td>
						</tr>
						<?php $sum = $sum + $data->price; ?>
						@endforeach
					</tbody>
				</table>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-7">
						</div>

						<div class="col-sm-5">
							<table class="table">
								<tbody>
									<tr>
										<th>ยอดรวมสุทธิ:</th>
										<td class="text-danger" style="text-align: right;"><h6>{{number_format($sum,2)}} บาท</h6></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<h5 style="font-family: 'Prompt', sans-serif; font-size: 16px;">รายการข้อมูลการจำหน่ายโคล่าสุด</h5>
		</div>
	</div>

</div>




@stop
