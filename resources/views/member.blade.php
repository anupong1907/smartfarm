@extends('layouts.master')

@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">ระบบจัดการสมาชิก</h3>
	</div>
	<div class="header-buttons">
		<a type="button" href="{{url('form_member')}}" class="btn btn-success" style="background: #44A504; border-color: #3D9107; color: #fff;"><i class="icon-plus"></i> |เพิ่มข้อมูล </a> 
		<button type="button" class="btn btn-info" style="background: #FFCC66; border-color: #FFCC66;"><i class="icon-file-pdf"></i> | รายงานข้อมูลสมาชิก</button>
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">หน้าหลัก</a></li>
		<li class="active">ระบบจัดการสมาชิก</li>
	</ul>
</div>
<!-- /breadcrumbs line -->
<div class="form-group">
	<div class="datatable">
		<table class="table table-striped">
			<thead >
				<tr style="background-color: #283747; color: #FFF;">
					<th width="10" class="center" style="background-color: #283747;">ลำดับ</th>
					<th style="background-color: #283747;">ชื่อ-สกุล</th>
					<th style="background-color: #283747;">ที่อยู่</th>
					<th style="background-color: #283747;">หมายเลขโทรศัพท์</th>
					<th style="background-color: #283747;">อีเมล</th>
					<th style="background-color: #283747;">รัฐวิสาหกิจชุมชน</th>	
					<th style="background-color: #283747;" class="center">จัดการ</th>					
				</tr>
			</thead>
			<tbody>
				@foreach($member as $list)
				<tr>
					<td class="text-center">{{$i++}}</td>
					<td><a href="{{url('profile_member/'.$list->member_id)}}">{{$list->member_name}}</a></td>
					<td>{{$list->member_address}}</td>
					<td format="999-999-9999">{{$list->member_phone}}</td>
					<td>{{$list->member_email}}</td>
					<td>{{$list->users_name}}</td>
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
@foreach($member as $list)
<div id="edit_{{$list->member_id}}" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="panel panel-default">
			<form method="post" action="{{url('update_member')}}" enctype="multipart/form-data" >
			{{ csrf_field() }}
			<input type="hidden" name="id" value="{{$list->member_id}}">
				<div class="panel-body">
					<div style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">แก้ไขข้อมูลประวัติสมาชิก<p style="font-size: 14px;">กรุณาระบุข้อมูลให้ถูกต้องและครบถ้วนเพื่อความสมบูรณ์ของข้อมูล โดยช่องที่มีเครื่องหมาย<span class="text-danger"> * </span> ไม่สามารถเว้นว่างได้</p></div>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">
									ชื่อ - นามสกุล<span class="symbol required"></span>
								</label>
								<input type="text"  class="form-control" name="name" value="{{$list->member_name}}">
							</div>

							<div class="form-group">
								<label class="control-label">
									ที่อยู่ <span class="symbol required"></span>
								</label>
								<textarea type="text"  class="form-control" name="address">{{$list->member_address}}</textarea>
							</div>
							<div class="form-group">
								<label class="control-label">
									หมายเลขโทรศัพท์<span class="symbol required"></span>
								</label>
								<input type="text"  class="form-control" name="phone" value="{{$list->member_phone}}">
							</div>
							<div class="form-group">
								<label class="control-label">
									อีเมลล์<span class="symbol required"></span>
								</label>
								<input type="text"  class="form-control" name="email" value="{{$list->member_email}}" >
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
									@foreach($community as $l)
									<option value="{{$l->id}}" @if($list->usres_id == $l->id) selected @endif>{{$l->name}}</option>
									@endforeach
								</select>
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
			</form>
		</div>
	</div>
</div>
@endforeach
@foreach($member as $list)
<div id="delete_{{$list->member_id}}" class="modal fade" tabindex="-1" role="dialog">
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
					คุณต้องการลบข้อมูลรายการ "<span class="text-danger">{{$list->member_name}}</span>" ใช่หรือไม่?
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
							<form style="display: inline;" action="{{url('delete_member')}}" method="post">
								<input type="hidden" name="id" value="{{$list->member_id}}">
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
@stop
