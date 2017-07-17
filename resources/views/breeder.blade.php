@extends('layouts.master')

@section('content')
<!-- Page header -->
<div class="page-header">
	<div class="page-title">
		<h3 style="font-family: 'Prompt', sans-serif; font-size: 36px; color: #5F6A6A;">โคพ่อพันธ์ุและแม่พันธ์ุ <span style="font-size: 14px;">ระบบจัดการประชากรโค</span></h3>
	</div>
</div>
<!-- /page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">หน้าหลัก</a></li>
		<li class="active">โคพ่อพันธ์ุและแม่พันธ์ุ</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>
</div>
<!-- /breadcrumbs line -->
<div class="form-group">
	<div class="datatable">
				<table class="table table-striped">
					<thead style="background-color: #283747;">
						<tr style="color: #fff;">
							<th width="30" class="center" style="background-color: #283747;">ลำดับ</th>
							<th width="140" class="center" style="background-color: #283747;">รหัสประจำตัว</th>
							<th width="150" class="center" style="background-color: #283747;">ชื่อ</th>
							<th width="80" class="center" style="background-color: #283747;">ประเภท</th>
							<th width="180" class="center" style="background-color: #283747;">เจ้าของ</th>
							<th width="120" class="center" style="background-color: #283747;">จัดการ</th>
						</tr>
					</thead>
					<tbody class="center">
						@foreach($cow_breeder_m as $data)
						<tr>
							<td>
								{{$i++}}
							</td>
							<td>
								{{$data->qrcode}}
							</td>
							<td>
								{{$data->cow_name}}
							</td>
							<td>
								@if($data->gender == 'm')
								<span class="label label-info"> โคพ่อพันธ์ุ </span> 
								@else
								<span class="label label-warning"> โคแม่พันธ์ุ </span> 
								@endif
							</td>
							<td>
								{{$data->member_name}}
							</td>
							<td>
								<div class="visible-md visible-lg hidden-sm hidden-xs">
									<a href="#" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="View" data-toggle="modal"><i class="clip-search"></i></a>
									<a href="#edit_{{$data->breeder_id}}" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit" data-toggle="modal"><i class="fa fa-edit"></i></a>
									<a href="#delete_{{$data->breeder_id}}" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove" data-toggle="modal"><i class="fa fa-times fa fa-white"></i></a>
								</div>
							</td>
						</tr>
						@endforeach
						@foreach($cow_breeder_f as $data)
						<tr>
							<td>
								{{$i++}}
							</td>
							<td>
								{{$data->qrcode}}
							</td>
							<td>
								{{$data->cow_name}}
							</td>
							<td>
								@if($data->gender == 'm')
								<span class="label label-info"> โคพ่อพันธ์ุ </span> 
								@else
								<span class="label label-warning"> โคแม่พันธ์ุ </span> 
								@endif
							</td>
							<td>
								{{$data->member_name}}
							</td>
							<td>
								<div class="visible-md visible-lg hidden-sm hidden-xs">
									<a href="#" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="View" data-toggle="modal"><i class="clip-search"></i></a>
									<a href="#edit_{{$data->breeder_id}}" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit" data-toggle="modal"><i class="fa fa-edit"></i></a>
									<a href="#delete_{{$data->breeder_id}}" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove" data-toggle="modal"><i class="fa fa-times fa fa-white"></i></a>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
</div>
@stop
