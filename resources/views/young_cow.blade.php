<?php Use Carbon\Carbon; ?> 
@extends('layouts.master')

@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">ฟาร์มลูกโค <span style="font-size: 14px;">ระบบจัดการประชากรโค</span></h3>
	</div>
	<div class="header-buttons">
		<a type="button" href="{{url('form_cow')}}" class="btn btn-success" style="background: #44A504; border-color: #3D9107; color: #fff;"><i class="icon-plus"></i> |เพิ่มข้อมูล </a> 
		<button type="button" class="btn btn-info" style="background: #FFCC66; border-color: #FFCC66;"><i class="icon-file-pdf"></i> | รายงานข้อมูลประชากรโค</button>
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="index.html">หน้าหลัก</a></li>
		<li class="active">ฟาร์มลูกโค</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>
</div>
<!-- /breadcrumbs line -->

<div class="form-group">
	<div class="row">
		<div class="col-md-9" style="border-right:1px solid #EBEDEF;">
			<div class="form-group">
				<span class="label label-primary">คำอธิบาย</span> <span style="color: #E74C3C;"><i class="icon-female"></i></span> โคเพศเมีย &nbsp;&nbsp;<span style="color: #3498DB;"> <i class="icon-male"></i></span>  โคเพศผู้ &nbsp; (ลูกโค : แรกเกิด - 8 เดือน)
			</div>
			<div class="form-group">
				<div class="datatable">
					<table class="table table-striped">
						<thead>
							<tr style="color: #fff;">
								<th width="30" class="center" style="background-color: #283747; ">ลำดับ</th>
								<th width="120" style="background-color: #283747; ">รายการ</th>
								<th width="30"  class="center" style="background-color: #283747; color: #FFF;">เพศ</th>
								<th width="80" class="center" style="background-color: #283747; ">อายุ</th>
								<th width="220" class="center" style="background-color: #283747; ">เจ้าของ</th>
								<th width="100" class="center" style="background-color: #283747; ">จัดการ</th>
							</tr>
						</thead>
						<tbody class="center">
							@foreach($cow as $list)
							@if(Carbon::parse($list-> cow_dob)->diff(Carbon::now())->format('%y%m') < '8')
							<tr>
								<td class="center">{{$i++}}</td>
								<td><a href="{{url('profile_cow/'.$list->cow_id)}}">{{$list->qrcode}} - {{$list->cow_name}}</a></td>
								<td class="center">
									@if($list->gender == 'f')
									<span style="color: #E74C3C;"><i class="icon-female"></i></span>
									@else
									<span style="color: #3498DB;"> <i class="icon-male"></i></span>
									@endif
								</td>
								<td class="center">
									{{Carbon::parse($list-> cow_dob)->diff(Carbon::now())->format('%y ปี %m เดือน')}}
								</td>
								<td class="center">{{$list->member_name}} | {{$list->users_name}}</td>
								<td class="center">
									<div class="visible-md visible-lg hidden-sm hidden-xs">
										<a href="{{url('profile_cow/'.$list->cow_id)}}" style="color: #1B2631;"><i class="icon-search3"></i></a>&nbsp;&nbsp;
										<a href="#edit_{{$list->cow_id}}" data-toggle="modal" style="color: #1B2631;"><i class="icon-pencil2"></i></a>&nbsp;&nbsp;
										<a href="#delete_{{$list->cow_id}}" data-toggle="modal" style="color: #1B2631;"><i class="icon-remove2"></i></a>
									</div>
								</td>
							</tr>
							@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-3">
		<h5 style="font-family: 'Prompt', sans-serif; font-size: 16px;">รายการการเพิ่มข้อมูลโคล่าสุด </h5>
			<ul class="media-list">	
				@foreach($cow->slice(0, 7) as $list)
				<li class="media" >
					<a class="pull-left" href="#">
						<img class="media-object" src="@if($list->cow_picture != null) {{ url('images/'. $list->cow_picture) }} @else https://www.shearwater.com/wp-content/plugins/lightbox/images/No-image-found.jpg @endif " style=" object-fit: cover; width: 40px; height: 40px; border-radius: 5px;">
					</a>
					<div class="media-body">
						<div class="clearfix">
							<a href="{{url('profile_cow/'.$list->cow_id)}}" class="media-heading"><i class="icon-new" style="color: #BE0101;"></i> {{$list->qrcode}} - {{$list->cow_name}}</a>
						</div>
						เจ้าของ : {{$list->member_name}} 
					</div>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@foreach($cow as $list)
<div id="delete_{{$list->cow_id}}" class="modal fade" tabindex="-1" role="dialog">
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
					คุณต้องการลบข้อมูลรายการ "<span class="text-danger">{{$list->cow_name}}</span>" ใช่หรือไม่?
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
								<input type="hidden" name="id" value="{{$list->cow_id}}">
								<button type="submit" class="btn btn-xs btn-success" style="background-color: #1A5276; border-color: #1A5276;">ลบรายการ</button>
								{{ csrf_field() }}
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach
@foreach($cow as $list)
<div id="edit_{{$list->cow_id}}" class="modal fade" tabindex="-1" role="dialog">
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
								<textarea class="form-control" name="detail">{{$list->detail}}</textarea>
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
											@foreach($cow_m as $l)
											<option value="{{$l->cow_id}}"  @if($l->cow_id==$list->breeder_m) selected='selected' @endif>{{$l->qrcode}} - {{$l->name}}</option>
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
											@foreach($cow_f as $l)
											<option value="{{$l->cow_id}}" @if($l->cow_id==$list->breeder_f) selected='selected' @endif>{{$l->qrcode}} - {{$l->name}}</option>
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
		@foreach($cow as $list)
		@if($list->gender == 'm')
		$('#m_{{$list->cow_id}}').prop('checked', true);
		$.uniform.update('#m_{{$list->cow_id}}');
		@else
		$('#f_{{$list->cow_id}}').prop('checked', true);
		$.uniform.update('#f_{{$list->cow_id}}');
		@endif
		@endforeach
	});
</script>

@stop
