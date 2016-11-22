@extends('layouts.content-layout')

@section('title')
    Administrator remove users
@endsection

@section('content')

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

				<!-- list users -->
				<div class="col s12 z-depth-1 list-users">
					<span class="title">List users</span>
					<div class="row">
						<!-- inline search user -->
						<div class="col s12 search-user">
							<form class="inline-search">
						        <div class="input-field">
						            <input id="search-user" type="search" placeholder="Search users" required>
						            <label for="search-user"><i class="material-icons">search</i></label>
						        </div>
						    </form>
						</div>
						<!-- end search user -->

						<div class="col s12 main-list-user">
							<table class="bordered">
						        <thead>
						          <tr>
						              <th class="table-title" data-field="id">Username</th>
						              <th class="table-title" data-field="name">Email</th>
						              <th class="table-title" data-field="delete">Delete</th>
						          </tr>
						        </thead>

						        <tbody>
						        @for($i = 0; $i < 10; $i++)
						          <tr class="row-user" data-userid="{{$i}}">
						            <td>
						            	<img class="responsive-img" alt="user-avatar" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}">
										<span>Username {{$i + 1}}</span>
						            </td>
						            <td>Example@gmail.com</td>
						            <td>
						            	<a class="remove-user" title="Delete"><i class="material-icons">delete</i></a>
						            </td>
						          </tr>
						        @endfor
						        </tbody>
						    </table>

						    <!-- pagination -->
						    <ul class="pagination">
							    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
							    <li class="active"><a href="#!">1</a></li>
							    <li class="waves-effect"><a href="#!">2</a></li>
							    <li class="waves-effect"><a href="#!">3</a></li>
							    <li class="waves-effect"><a href="#!">4</a></li>
							    <li class="waves-effect"><a href="#!">5</a></li>
							    <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
							</ul>
						    <!-- end pagination -->
						</div>
					</div>
				</div>
				<!-- end list user -->
			</div>

			<!-- <div class="preloader-wrapper active" style="display: none;">
				<div class="spinner-layer spinner-green-only">
			      	<div class="circle-clipper left">
			        	<div class="circle"></div>
			      	</div>
			      	<div class="gap-patch">
			        	<div class="circle"></div>
			        </div>
			        <div class="circle-clipper right">
			           <div class="circle"></div>
			        </div>
				</div>
			</div> -->
	</div>
</section>

@endsection