@extends('layouts.master')

@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">ข่าวสารประชาสัมพันธ์</h3>
	</div>
	<div class="header-buttons">
		<a type="button" href="{{url('form_news')}}" class="btn btn-success" style="background: #44A504; border-color: #3D9107; color: #fff;"><i class="icon-plus"></i> |เพิ่มข้อมูล </a> 
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">หน้าหลัก</a></li>
		<li class="active">ข่าวสารประชาสัมพันธ์</li>
	</ul>
</div>
<!-- /breadcrumbs line -->
<div class="form-group">
	<div class="tabbable page-tabs">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#all-tasks" data-toggle="tab"><i class="icon-paragraph-justify2"></i>ข่าวประชาสัมพันธ์</a></li>
			<li><a href="#active" data-toggle="tab"><i class="icon-stack"></i> ประกาศทางวิชาการ</a></li>
			<li><a href="#closed" data-toggle="tab"><i class="icon-bubbles3"></i> เกร็ดความรู้ </a></li>
		</ul>

		<div class="tab-content">

			<!-- First tab -->
			<div class="tab-pane active fade in" id="all-tasks">

				<div class="datatable-tasks">
					<table class="table ">
						<thead >
							<tr style="color: #fff;">
								<th width="20" style="background-color: #283747;">ลำดับ</th>
								<th width="300" style="background-color: #283747;">หัวข้อข่าวสาร</th>
								<th style="background-color: #283747;">ผู้ลงข่าว</th>
								<th style="background-color: #283747;">วันที่เพิ่มรายการ</th>
								<th style="background-color: #283747;">วันที่แก้ไขล่าสุด</th>
								<th style="background-color: #283747;">จัดการ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($news as $list)
							@if($list->type_news_id==1)
							<tr>
								<td class="text-center">{{$i++}}</td>
								<td><a href="{{url('detail_news/'.$list->news_id)}}">{{$list->news_name}}</a></td>
								<td>{{$list->users_name}}</td>
								<td>{{$list->news_created_at}}</td>
								<td>{{$list->news_updated_at}}</td>
								<td class="text-center">
									<a href="#edit_{{$list->news_id}}" type="button" class="btn btn-success btn-xs btn-icon" data-toggle="modal" style="background: #FFCC66; border-color: #FFCC66; color: #FFFFFF;"><i class="icon-pencil2"></i></a>
									<a  href="#delete_{{$list->news_id}}" type="button" class="btn btn-danger btn-xs btn-icon" data-toggle="modal"><i class="icon-remove2"></i></a>
								</td>
							</tr>
							@endif
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
			<!-- /first tab -->


			<!-- Second tab -->
			<div class="tab-pane fade" id="active">
				<div class="datatable-tasks">
					<table class="table ">
						<thead >
							<tr style="color: #fff;">
								<th width="20" style="background-color: #283747;">ลำดับ</th>
								<th width="300" style="background-color: #283747;">หัวข้อข่าวสาร</th>
								<th style="background-color: #283747;">ผู้ลงข่าว</th>
								<th style="background-color: #283747;">วันที่เพิ่มรายการ</th>
								<th style="background-color: #283747;">วันที่แก้ไขล่าสุด</th>
								<th style="background-color: #283747;">จัดการ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($news as $list)
							@if($list->type_news_id==2)
							<tr>
								<td class="text-center">{{$i++}}</td>
								<td><a href="{{url('detail_news/'.$list->news_id)}}">{{$list->news_name}}</a></td>
								<td>{{$list->users_name}}</td>
								<td>{{$list->news_created_at}}</td>
								<td>{{$list->news_updated_at}}</td>
								<td class="text-center">
									<a href="#edit_{{$list->news_id}}" type="button" class="btn btn-success btn-xs btn-icon" data-toggle="modal" style="background: #FFCC66; border-color: #FFCC66; color: #FFFFFF;"><i class="icon-pencil2"></i></a>
									<a  href="#delete_{{$list->news_id}}" type="button" class="btn btn-danger btn-xs btn-icon" data-toggle="modal"><i class="icon-remove2"></i></a>
								</td>
							</tr>
							@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- /second tab -->


			<!-- Third tab -->
			<div class="tab-pane fade" id="closed">
				<div class="datatable-tasks">
					<table class="table ">
						<thead >
							<tr style="color: #fff;">
								<th width="20" style="background-color: #283747;">ลำดับ</th>
								<th width="300" style="background-color: #283747;">หัวข้อข่าวสาร</th>
								<th style="background-color: #283747;">ผู้ลงข่าว</th>
								<th style="background-color: #283747;">วันที่เพิ่มรายการ</th>
								<th style="background-color: #283747;">วันที่แก้ไขล่าสุด</th>
								<th style="background-color: #283747;">จัดการ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($news as $list)
							@if($list->type_news_id==3)
							<tr>
								<td class="text-center">{{$i++}}</td>
								<td><a href="{{url('detail_news/'.$list->news_id)}}">{{$list->news_name}}</a></td>
								<td>{{$list->users_name}}</td>
								<td>{{$list->news_created_at}}</td>
								<td>{{$list->news_updated_at}}</td>
								<td class="text-center">
									<a href="#edit_{{$list->news_id}}" type="button" class="btn btn-success btn-xs btn-icon" data-toggle="modal" style="background: #FFCC66; border-color: #FFCC66; color: #FFFFFF;"><i class="icon-pencil2"></i></a>
									<a  href="#delete_{{$list->news_id}}" type="button" class="btn btn-danger btn-xs btn-icon" data-toggle="modal"><i class="icon-remove2"></i></a>
								</td>
							</tr>
							@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- /third tab -->

		</div>
	</div>
</div>
@foreach($news as $list)
<div id="delete_{{$list->news_id}}" class="modal fade" tabindex="-1" role="dialog">
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
					คุณต้องการลบข้อมูลรายการ "<span class="text-danger">{{$list->news_name}}</span>" ใช่หรือไม่?
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
							<a data-toggle="modal" href="#edit_{{$list->news_id}}" >
								<button type="button" class="btn btn-xs btn-default" data-dismiss="modal" style="">แก้ไขรายการ</button>
							</a>
							<form style="display: inline;" action="{{url('delete_news')}}" method="post">
								<input type="hidden" name="id" value="{{$list->news_id}}">
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
@foreach($news as $list)
<div id="edit_{{$list->news_id}}" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="panel panel-default">
			<form method="post" action="{{url('update_news')}}" enctype="multipart/form-data">
				<input type="hidden" name="id" value="{{$list->news_id}}">
				{{ csrf_field() }}
				<div class="panel-body">
					<div style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">แก้ไขข้อมูลข่าวสารประชาสัมพันธ์ <p style="font-size: 14px;">กรุณาระบุข้อมูลให้ถูกต้องและครบถ้วนเพื่อความสมบูรณ์ของข้อมูล โดยช่องที่มีเครื่องหมาย<span class="text-danger"> * </span> ไม่สามารถเว้นว่างได้</p></div>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">
									หัวข้อข่าว <span class="symbol required"></span>
								</label>
								<input type="text"  class="form-control" id="list" name="list" value="{{$list->news_name}}">
							</div>
							<div class="form-group">
								<label class="control-label">
									รายละเอียด <span class="symbol required"></span>
								</label>
								<textarea type="text"  class="form-control" id="detail" name="detail">{{$list->detail}}</textarea>
							</div>
							<div class="form-group">
								<label for="form-field-select-1">
									ประเภทข่าวสาร
								</label>
								<select class="select-full" name="type_news_id">
									@foreach($type as $l)
									<option value="{{$l->id}}" @if($list->type_news_id==$l->id) selected='selected' @endif>{{$l->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<label>
								รูปภาพประกอบ
							</label>
							<input type="file" class="styled" name="picture">
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
</div>
@endforeach
@stop
