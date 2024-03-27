<nav class="pcoded-navbar font-prompt">
	<div class="nav-list">
		<div class="pcoded-inner-navbar main-menu">
			<div class="pcoded-navigation-label">Navigation</div>
			<ul class="pcoded-item pcoded-left-item">
				<li class="{{ (request()->is('dashboard') || request()->is('/')) ? 'active' : '' }}">
					<a href="{{ route('d506.dashboard.index') }}" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="fa fa-dashboard"></i>
						</span>
						<span class="pcoded-mtext">แดชบอร์ด</span>
					</a>
				</li>
				@canany(['isAdmin', 'isStaff'])
					<li class="{{ (request()->is('config/create')) ? 'active' : '' }}">
						<a href="{{ route('d506.config.create') }}" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="fa fa-cog"></i>
							</span>
							<span class="pcoded-mtext">ตั้งค่า APIs</span>
						</a>
					</li>
					<li class="{{ (request()->is('send*')) ? 'active' : '' }}">
						<a href="{{ route('d506.send.create') }}" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="fa fa-send"></i>
							</span>
							<span class="pcoded-mtext">ส่งข้อมูล</span>
						</a>
					</li>

					{{-- <li class="pcoded-hasmenu active pcoded-trigger">
						<a href="javascript:void(0)" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="feather icon-box"></i>
							</span>
							<span class="pcoded-mtext">Basic</span>
						</a>
						<ul class="pcoded-submenu">
							<li class="">
								<a href="alert.html" class="waves-effect waves-dark">
									<span class="pcoded-mtext">Alert</span>
								</a>
							</li>
							<li class="">
								<a href="breadcrumb.html" class="waves-effect waves-dark">
									<span class="pcoded-mtext">Breadcrumbs</span>
								</a>
							</li>
						</ul>
					</li> --}}


					<li class="{{ (request()->is('report*')) ? 'active' : '' }}">
						<a href="{{ route('d506.report.index') }}" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="fa fa-database"></i>
							</span>
							<span class="pcoded-mtext">รายงานการส่งข้อมูล</span>
						</a>
					</li>
				@endcanany
			</ul>
		</div>
	</div>
</nav>
