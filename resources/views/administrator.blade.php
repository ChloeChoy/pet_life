@extends('layouts.content-layout')

@section('title')
    Administrator
@endsection

@section('content')

<!-- content -->

	<section class="main-content">
		<div class="container">
			<div class="row">
				<!-- menu admin -->
				<nav class="menu-admin">
					<div class="nav-wrapper">
						<ul>
							<li><a href="#">Dashboard</a></li>
							<li>
								<a class="manage-user-btn" href="#">Manage Users<i class="material-icons right">arrow_drop_down</i></a>
								<ul id="manage-users" class="dropdown-content">
								  <li><a href="">Add user</a></li>
								  <li><a href="{{route('remove.users')}}">List user</a></li>
								</ul>
							</li>
							<li><a href="#">Manage Posts</a></li>
						</ul>
					</div>
				</nav>
				<!-- end menu admin -->

				<div class="col s12 adminCharts z-depth-1">
					<span class="title">Dashboard</span>
					<div class="row chart-content">
						<div class="col s12">
							<div class="posts graph">
								<span class="graph-title">Posts</span>
								<canvas id="postChart"></canvas>
							</div>
						</div>
						<div class="col s12 m6">
							<div class="users graph">
								<span class="graph-title">Users</span>
								<canvas id="userChart"></canvas>
							</div>
						</div>
						<div class="col s12 m6">
							<div class="user-onl graph">
								<span class="graph-title">Users online</span>
								<canvas id="userOnlChart"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	
<!-- end content -->

@endsection