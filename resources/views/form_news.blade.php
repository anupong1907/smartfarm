@extends('layouts.master')

@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">เพิ่มข่าวสารประชาสัมพันธ์ <br><br><p style="font-size: 14px;">กรุณาระบุข้อมูลให้ถูกต้องและครบถ้วนเพื่อความสมบูรณ์ของข้อมูล โดยช่องที่มีเครื่องหมาย<span class="text-danger"> * </span> ไม่สามารถเว้นว่างได้</p></h3>
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">หน้าหลัก</a></li>
		<li><a href="{{url('news')}}">ข่าวสารประชาสัมพันธ์</a></li>
		<li class="active">เพิ่มข่าวสารประชาสัมพันธ์</li>
	</ul>
</div>
<!-- /breadcrumbs line -->
<div class="panel panel-default" >
	<div class="panel-body">
		<form method="post" action="{{url('post_news')}}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							หัวข้อข่าว <span class="symbol required"></span>
						</label>
						<input type="text"  class="form-control" id="list" name="list">
					</div>
					<div class="form-group">
						<label class="control-label">
							รายละเอียด <span class="symbol required"></span>
						</label>
						<textarea type="text"  class="form-control" id="detail" name="detail"></textarea>
					</div>
					<div class="form-group">
						<label for="form-field-select-1">
							ประเภทข่าวสาร
						</label>
						<select class="select-full" name="type_news_id">
							@foreach($type as $list)
							<option value="{{$list->id}}">{{$list->name}}</option>
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
			<div class="row">
				<div class="col-md-8">
					<p>
						หากต้องการดูข่าวสาร กรุณาย้อนกลับไปที่หน้าแสดงข่าวสาร หรือคลิกที่แท็บข่าวสารประชาสัมพันธ์ด้านบน
					</p>
				</div>
				<div class="col-md-4">
					<button class="btn btn-yellow btn-block" type="submit"  style="background: #44A504; border-color: #3D9107; color: #fff;">
						เพิ่มข้อมูล <i class="fa fa-arrow-circle-right"></i>
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
@stop
