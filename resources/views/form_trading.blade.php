@extends('layouts.master')

@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">เพิ่มข้อมูลการจำหน่ายโค <br><br><p style="font-size: 14px;">กรุณาระบุข้อมูลให้ถูกต้องและครบถ้วนเพื่อความสมบูรณ์ของข้อมูล โดยช่องที่มีเครื่องหมาย<span class="text-danger"> * </span> ไม่สามารถเว้นว่างได้</p></h3>
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">หน้าหลัก</a></li>
		<li><a href="{{url('trading')}}">ข้อมูลการจำหน่ายโคทั้งหมด</a></li>
		<li class="active">เพิ่มข้อมูลการจำหน่ายโค</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>
</div>
<!-- /breadcrumbs line -->
<div class="row">
	<div class="col-md-6">
		<form method="post" action="{{url('post_trading')}}">
			{{ csrf_field() }}
			<div class="form-group">
				<label class="control-label">
					รายชื่อผู้ซื้อ  <span class="symbol required"></span>
				</label>
				<select class="select-full" name="customer_id">
					<option value="">&nbsp;</option>
					@foreach($customer as $cus)
					<option value="{{$cus->id}}">{{$cus->iden}} - {{$cus->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">
					รายชื่อโค  <span class="symbol required"></span>
				</label>
				<select class="select-full" name="cow_id">
					<option value="">&nbsp;</option>
					@foreach($list as $cow)
					<option value="{{$cow->id}}">{{$cow->qrcode}} - {{$cow->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">
					วันที่ซื้อ<span class="symbol required"></span>
				</label>
				<input class="form-control" type="date" name="trading_date">
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							น้ำหนักโค (กิโลกรัม) <span class="symbol required"></span>
						</label>
						<input type="text" class="form-control" name="weight">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							จำนวนเงิน (บาท) <span class="symbol required"></span>
						</label>
						<input type="text" class="form-control" name="price">
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-8">
					<p>
						หากต้องการดูข้อมูล กรุณาย้อนกลับไปที่หน้าแสดงข้อมูล หรือคลิกที่แท็บเพิ่มข้อมูลการจำหน่ายโค
					</p>
				</div>
				<div class="col-md-4">
					<button class="btn btn-yellow btn-block" type="submit" style="background: #44A504; border-color: #3D9107; color: #fff;" >
						เพิ่มข้อมูล <i class="fa fa-arrow-circle-right"></i>
					</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-title">เพิ่มข้อมูลประวัติของลูกค้า</h6>
				<div class="panel-icons-group">
					<a href="#" data-panel="collapse" class="btn btn-link btn-icon"><i class="icon-arrow-up9"></i></a>
				</div>
			</div>
			<div class="panel-body" style="display: block;">
				<form method="post" action="{{url('post_customer')}}">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="control-label">
							หมายเลขประจำตัวประชาชน <span class="symbol required"></span>
						</label>
						<input type="text" class="form-control" name="iden">
					</div>
					<div class="form-group">
						<label class="control-label">
							ชื่อ-สกุล <span class="symbol required"></span>
						</label>
						<input type="text" class="form-control" name="name">
					</div>
					<div class="form-group">
						<label class="control-label">
							ที่อยู่ <span class="symbol required"></span>
						</label>
						<textarea class="form-control" name="address"></textarea>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">
									หมายเลขโทรศัพท์ <span class="symbol required"></span>
								</label>
								<input type="text" class="form-control" name="phone">
							</div>

						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">
									อีเมลล์ <span class="symbol required"></span>
								</label>
								<input type="text" class="form-control" name="email">
							</div>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-dark-grey btn-block" type="submit">
							เพิ่มข้อมูล <i class="fa fa-arrow-circle-right"></i>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop
