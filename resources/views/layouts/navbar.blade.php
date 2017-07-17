<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="navbar-header">
			<a class="navbar-brand" href="#" style="font-size: 24px; color: #1A5276;  ">SMART FARMING</a>
		</div>

		<ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">
			

			<li class="user dropdown" >
				<a class="dropdown-toggle" data-toggle="dropdown" style="color: #17202A">
					<strong>ชื่อผู้ใช้งานระบบ : </strong><span >{{ Auth::user()->name }}</span>
					<i class="caret" ></i>
				</a>
				<ul class="dropdown-menu dropdown-menu-right icons-right">
					<li><a href="#"><i class="icon-user"></i> Profile</a></li>
					<li><a href="#"><i class="icon-bubble4"></i> Messages</a></li>
					<li><a href="#"><i class="icon-cog"></i> Settings</a></li>
					<li>
						<a href="{{ url('/logout') }}"
						onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						Logout
					</a>

					<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</ul>
			</li>
		</ul>
	</div>