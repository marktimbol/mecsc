<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
			</div>

			<div class="pull-left info">
				<p>{{ $currentUser->name }}</p>
			</div>
		</div>

		<form method="POST" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search..." />
				<span class="input-group-btn">
					<button type="submit" name="search" id="search-btn" class="btn btn-flat">
						<i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>

		<ul class="sidebar-menu">
			<li class="header">
				Main Navigation
			</li>
			<li class="active_">
				<a href="{{ route('dashboard') }}">
					<i class="fa fa-dashboard"></i>
					<span>Dashboard</span>
				</a>
			</li>

			<li>
				<a href="{{ route('dashboard.users.index') }}">
					<i class="fa fa-user"></i>
					<span>Users</span>
				</a>
			</li>

			<li>
				<a href="{{ route('dashboard.schedules.index') }}">
					<i class="fa fa-dashboard"></i>
					<span>Schedules</span>
				</a>
			</li>

			<li>
				<a href="{{ route('dashboard.agendas.index') }}">
					<i class="fa fa-dashboard"></i>
					<span>Agenda</span>
				</a>
			</li>

			<li>
				<a href="{{ route('dashboard.speakers.index') }}">
					<i class="fa fa-users"></i>
					<span>Speakers</span>
				</a>
			</li>

			<li>
				<a href="{{ route('dashboard.exhibitors.index') }}">
					<i class="fa fa-users"></i>
					<span>Exhibitors</span>
				</a>
			</li>

			<li>
				<a href="{{ route('dashboard.medias.index') }}">
					<i class="fa fa-users"></i>
					<span>Media Partners</span>
				</a>
			</li>

			<li>
				<a href="{{ route('dashboard.companies.index') }}">
					<i class="fa fa-users"></i>
					<span>Companies</span>
				</a>
			</li>
		</ul>
	</section>
</aside>