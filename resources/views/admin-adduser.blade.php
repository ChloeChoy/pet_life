@extends('layouts.content-layout')

@section('title')
    Administrator add user
@endsection

@section('content')

<section class="main-content">
	<div class="container">
			<div class="row">
				<!-- menu admin -->
				<nav class="menu-admin">
					<div class="nav-wrapper">
						<ul>
							<li><a href="{{route('administrator')}}">Dashboard</a></li>
							<li>
								<a class="manage-user-btn" href="#">Manage Users<i class="material-icons right">arrow_drop_down</i></a>
								<ul id="manage-users" class="dropdown-content">
								  <li><a href="{{route('adduser')}}">Add user</a></li>
								  <li><a href="{{route('remove.users')}}">List user</a></li>
								</ul>
							</li>
							<li><a href="#">Manage Posts</a></li>
						</ul>
					</div>
				</nav>
				<!-- end menu admin -->

			</div>
	</div>
</section>


@endsection