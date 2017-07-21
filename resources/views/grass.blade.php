@extends('layouts.master')

@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">ข้อมูลการปลูกหญ้าเนียร์เปียร์ <span style="font-size: 14px;">SmartFarming</span></h3>
	</div>
	<div class="header-buttons">
		<a type="button" href="#add"" data-toggle="modal" class="btn btn-success" style="background: #44A504; border-color: #3D9107; color: #fff;"><i class="icon-plus"></i> |เพิ่มข้อมูล </a> 
		<button type="button" class="btn btn-info" style="background: #FFCC66; border-color: #FFCC66;"><i class="icon-file-pdf"></i> | รายงานข้อมูลสมาชิก</button>
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">หน้าหลัก</a></li>
		<li class="active">ระบบจัดการหญ้าเนียร์เปียร์</li>
	</ul>
</div>
<!-- /breadcrumbs line -->
<div class="form-group">
<span class="label label-primary">คำอธิบาย</span>&nbsp;&nbsp;<img src="{{url('images/Circle_Green.png')}}"> โคที่มีสถานะอยู่กับเจ้าของ &nbsp;&nbsp;<img src="{{url('images/Circle_Red.png')}}">  โคที่มีสถานะถูกขายหรือตายไปแล้ว
</div>
<div class="form-group">
	<div class="datatable">
		<table class="table table-striped">
			<thead >
				<tr style="background-color: #283747; color: #FFF;">
					<th width="10" class="center" style="background-color: #283747;">ลำดับ</th>
					<th style="background-color: #283747;">ชื่อ-สกุล</th>
					<th style="background-color: #283747;">จำนวนพื้นที่ในการปลูก / ไร่</th>
					<th style="background-color: #283747;">วันที่ปลูก</th>
					<th style="background-color: #283747;">วันที่เก็บ</th>
					<th style="background-color: #283747;">สถานะ</th>
					<th style="background-color: #283747;" class="center">จัดการ</th>					
				</tr>
			</thead>
			<tbody>
				@foreach($grass as $list)
				<tr>
					<td>{{$i++}}</td>
					<td>{{$list->name}}</td>
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
<div id="add" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog ">
		<div class="panel panel-default">
			<div class="panel-heading" >
				<h6 class="panel-title">รายชื่อสมาชิก</h6>
				<div class="panel-icons-group">
					<a href="#" data-dismiss="modal" class="btn btn-link btn-icon"><i class="icon-cancel-circle"></i></a>
				</div>
			</div>
			<form action="{{url('form_grass')}}" method="get">
				<div class="panel-body">
					<select class="select-full"  name="member_id">
						@foreach($member as $list)
						<option value="{{$list->member_id}}">{{$list->member_name}} - {{$list->users_name}}</option>
						@endforeach
					</select>
					<hr>
					<div class="text-right">
						<button type="button" name="export_pdf" class="btn btn-xs btn-default" data-dismiss="modal">ยกเลิก</button>
						<button class="btn btn-xs" type="submit" style="background: #44A504; border-color: #3D9107; color: #fff;">
							ค้นหาข้อมูล
						</button>
					</div>
				</div>
				{{ csrf_field() }}
			</form>
		</div>
	</div>
</div>
@stop
