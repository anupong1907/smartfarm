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
		<div class="col-md-9">
			<div class="well">
				<form method="get" action="{{url('result_trading')}}">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="control-label">เลือกชุมชนรัฐวิสาหกิจที่ต้องการ: </label>
						<select id="select_all" data-placeholder="เลือกชุมชนรัฐวิสาหกิจ" class="select-multiple" multiple="multiple" tabindex="2" name="community[]">
							@foreach($communitys as $list)
							<option value="{{$list->id}}" >{{$list->name}}</option>
							@endforeach
						</select> 

					</div>
					<div class="form-group" >
						<div class="row">
							<div class="col-md-6">
								<label class="control-label">วันที่เริ่มต้น: </label>
								<input class="form-control" type="date" name="start">
							</div>
							<div class="col-md-6">
								<label class="control-label">วันที่สิ้นสุด: </label>
								<input class="form-control" type="date" name="end">
							</div>
						</div>
					</div>
					<div class="form-group text-left">
						<button type="submit" class="btn btn-info"><i class="icon-search3"></i>ค้นหาข้อมูล</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>


@stop
