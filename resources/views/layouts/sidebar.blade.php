<div class="sidebar" >
	<div class="sidebar-content">
		<div class="user-menu dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<img src="http://placehold.it/300" alt="">
				<div class="user-info">
					{{ Auth::user()->name }}<span>Web Developer</span>
				</div>
			</a>
			<div class="popup dropdown-menu dropdown-menu-right">
				<div class="thumbnail">
					<div class="thumb">
						<img alt="" src="http://placehold.it/300">
						<div class="thumb-options">
							<span>
								<a href="#" class="btn btn-icon btn-success"><i class="icon-pencil"></i></a>
								<a href="#" class="btn btn-icon btn-success"><i class="icon-remove"></i></a>
							</span>
						</div>
					</div>

					<div class="caption text-center">
						<h6>Madison Gartner <small>Front end developer</small></h6>
					</div>
				</div>

				<ul class="list-group">
					<li class="list-group-item"><i class="icon-pencil3 text-muted"></i> My posts <span class="label label-success">289</span></li>
					<li class="list-group-item"><i class="icon-people text-muted"></i> Users online <span class="label label-danger">892</span></li>
					<li class="list-group-item"><i class="icon-stats2 text-muted"></i> Reports <span class="label label-primary">92</span></li>
					<li class="list-group-item"><i class="icon-stack text-muted"></i> Balance <h5 class="pull-right text-danger">$45.389</h5></li>
				</ul>
			</div>
		</div>
		<!-- Main navigation -->
		<ul class="navigation" style="font-family: 'Prompt', sans-serif; font-size: 14px;">
			<li class="@if(Request::is('/') == '/') active @endif">
				<a href="{{url('/')}}">
					<span >หน้าแรก</span> <i class="icon-home5"></i>
				</a>
			</li>
			<li class="@foreach($news_list as $data) @if(Request::is('news') == 'news'||Request::is('form_news') == 'form_news'||Request::is('detail_news/'.$data->id) == 'detail_news/'.$data->id) active @endif @endforeach">
				<a href="{{url('news')}}">
					<span >ข่าวประชาสัมพันธ์</span> <i class="icon-feed2"></i>
				</a>
			</li>
			<li class="@foreach($members as $data) @if(Request::is('member') == 'member'||Request::is('profile_member/'.$data->id) == 'profile_member/'.$data->id||Request::is('form_member') == 'form_member') active @endif @endforeach">
				<a href="{{url('member')}}">
					<span >ระบบจัดการสมาชิก</span> <i class="icon-users2"></i>
				</a>
			</li>
			<li>
				<a href="#"><span >ระบบจัดการประชากรโค</span> <i class="icon-archive"></i></a>
				<ul>
					<li class="@foreach($cows as $list) @if(Request::is('cow') == 'cow'||Request::is('profile_cow/'.$list->id)||Request::is('form_cow') == 'form_cow') active @endif @endforeach">
						<a href="{{url('cow')}}" >ประชากรโคทั้งหมด</a>
					</li>
					<li class="@if(Request::is('young_cow')=='young_cow') active @endif">
						<a href="{{url('young_cow')}}">ฟาร์มลูกโค</a>
					</li>
					<li class="@if(Request::is('breeder')=='breeder') active @endif">
						<a href="{{url('breeder')}}">โคพ่อพันธุ์และแม่พันธุ์</a>
					</li>
					<li class="@if(Request::is('kokun')=='kokun') active @endif">
						<a href="{{url('kokun')}}">ฟาร์มโคขุน</a>
					</li>
					<li class="@if(Request::is('ready_cow')=='ready_cow') active @endif">
						<a href="{{url('ready_cow')}}">โคพร้อมจำหน่าย</a>
					</li>
				</ul>
			</li>
			<li class="@if(Request::is('trading') == 'trading'||Request::is('form_trading') == 'form_trading') active @endif">
				<a href="{{url('trading')}}">
					<span >ระบบการจำหน่ายโค</span> <i class="icon-cart-checkout"></i>
				</a>
			</li>
			<li class="@if(Request::is('grass')=='grass') active @endif">
				<a href="{{url('grass')}}">
					<span >ระบบหญ้าเนียร์เปียร์</span> 
					<i class="icon-leaf"></i>
				</a>
			</li>
			<li><a href="index.html"><span >ระบบจัดการมูลโค</span> <i class="icon-truck"></i></a></li>
			<li>
				<a href="#"><span >รัฐวิสาหกิจชุมชน</span> <i class="icon-share2"></i></a>
				<ul>
					@foreach($communitys as $data)
					<li class="@if(Request::is('community/'.$data->id) == 'community/'.$data->id) active open @endif">
						<a href="{{url('community/'.$data->id)}}">
							<span class="title">{{$data->name}}</span>
						</a>
					</li>
					@endforeach
				</ul>
			</li>
		</ul>
		<!-- /main navigation -->

	</div>
</div>