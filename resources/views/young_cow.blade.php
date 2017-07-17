<?php Use Carbon\Carbon; ?> 
@extends('layouts.master')

@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
	<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">ฟาร์มลูกโค <span style="font-size: 14px;">ระบบจัดการประชากรโค</span></h3>
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
	<div class="datatable">
		<table class="table table-striped">
			<thead>
                <tr style="color: #fff;">
                    <th width="30" class="center" style="background-color: #283747; ">ลำดับ</th>
                    <th width="120" class="center" style="background-color: #283747; ">รหัสประจำตัว</th>
                    <th width="150" class="center" style="background-color: #283747; ">ชื่อ</th>
                    <th width="100" class="center" style="background-color: #283747; ">อายุ</th>
                    <th width="200" class="center" style="background-color: #283747; ">เจ้าของ</th>
                    <th width="100" class="center" style="background-color: #283747; ">จัดการ</th>
                </tr>
            </thead>
            <tbody class="center">
                @foreach($cow as $list)
                @if(Carbon::parse($list-> cow_dob)->diff(Carbon::now())->format('%y%m') < '8')
                <tr>
                    <td class="center">{{$i++}}</td>
                    <td class="center">{{$list->qrcode}}</td>
                    <td class="center">{{$list->cow_name}}</td>
                    <td class="center">
                        {{Carbon::parse($list-> cow_dob)->diff(Carbon::now())->format('%y ปี %m เดือน')}}
                    </td>
                    <td class="center">{{$list->member_name}}</td>
                    <td class="center">
                        <div class="visible-md visible-lg hidden-sm hidden-xs">
                            <a href="{{url('profile_cow/'.$list->cow_id)}}" type="button" class="btn btn-info btn-xs btn-icon"><i class="icon-search3"></i></a>
                            <a href="#edit_{{$list->cow_id}}" type="button" class="btn btn-success btn-xs btn-icon" data-toggle="modal" style="background: #FFCC66; border-color: #FFCC66; color: #FFFFFF;"><i class="icon-pencil2"></i></a>
                            <a href="#delete_{{$list->cow_id}}" type="button" class="btn btn-danger btn-xs btn-icon" data-toggle="modal"><i class="icon-remove2"></i></a>
                        </div>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
		</table>
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