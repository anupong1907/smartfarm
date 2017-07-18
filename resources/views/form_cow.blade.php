@extends('layouts.master')

@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">เพิ่มข้อมูลประชากรโค <br><br><p style="font-size: 14px;">กรุณาระบุข้อมูลให้ถูกต้องและครบถ้วนเพื่อความสมบูรณ์ของข้อมูล โดยช่องที่มีเครื่องหมาย<span class="text-danger"> * </span> ไม่สามารถเว้นว่างได้</p></h3>
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">หน้าแรก</a></li>
		<li><a href="{{url('cow')}}">ประชากรโคทั้งหมด</a></li>
		<li class="active">เพิ่มข้อมูลประชากรโค</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>
</div>
<!-- /breadcrumbs line -->
<div class="panel panel-default">
	<div class="panel-body">

			<form method="post" action="{{url('post_cow')}}" enctype="multipart/form-data" id="myForm">
				{{ csrf_field() }}
				<input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
				<div class="form-group">
					<label class="control-label">
						เจ้าของโค <span class="symbol required"></span>
					</label>
					<select class="select-full"  name="member_id">
						<option value="">&nbsp;</option>
						@foreach($member as $list)
						<option value="{{$list->member_id}}">{{$list->member_name}} - {{$list->users_name}}</option>
						@endforeach
					</select>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								ชื่อ <span class="symbol required"></span>
							</label>
							<input type="text"  class="form-control" name="name">
						</div>
						<div class="form-group">
							<label class="control-label">
								รายละเอียดเพิ่มเติม <span class="symbol required"></span>
							</label>
							<textarea class="form-control" name="detail"></textarea>
						</div>
						<div class="form-group">
							<label class="control-label">
								วันเกิด<span class="symbol required"></span>
							</label>
								<input class="form-control" type="date" name="dob">
						</div>
						<div class="form-group">
							<label class="control-label">
								เพศ <span class="symbol required"></span>
							</label>
							<div>
								<label class="radio-inline">
									<input type="radio" name="gender" class="styled" value="f">
									เพศเมีย
								</label>
								<label class="radio-inline">
									<input type="radio" name="gender" class="styled" value="m">
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
										@foreach($cow_m as $list)
										<option value="{{$list->cow_id}}">{{$list->qrcode}} - {{$list->name}}</option>
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
										@foreach($cow_f as $list)
										<option value="{{$list->cow_id}}">{{$list->qrcode}} - {{$list->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-8">
						<p>
							หากต้องการดูข้อมูล กรุณาย้อนกลับไปที่หน้าแสดงข้อมูล หรือคลิกที่แท็บประชากรโคทั้งหมดด้านบน
						</p>
					</div>
					<div class="col-md-4">
						<button class="btn btn-block" type="submit" style="background: #44A504; border-color: #3D9107; color: #fff;">
							เพิ่มข้อมูล 
						</button>
					</div>
				</div>
			</form>
		</div>
</div>

@stop
