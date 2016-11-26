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

				<div class="col s12 admin-adduser z-depth-1">
					<span class="title">Add User</span>
					<div class="adduser row">
						<span class="add-msg"></span>
						<form class="col s12 l6" id="admin-create-form" action="{{route('admin.adduser')}}" method="post">
							<div class="input-field {{ $errors->has('name') ? 'has-error' : '' }}">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="signup_username" type="text" name="name" class="validate" value="{{ Request::old('first_name') }}">
                                <label for="signup_username">Username</label>
                            </div>
                            <div class="input-field {{ $errors->has('email') ? 'has-error' : '' }}">
                                <i class="material-icons prefix">email</i>
                                <input id="signup-email" name="email" type="email" class="validate" value="{{ Request::old('email') }}">
                                <label for="signup-email" data-error="invalid email format">Email</label>
                            </div>
                            <div class="input-field {{ $errors->has('password') ? 'has-error' : '' }}">
                                <i class="material-icons prefix">lock</i>
                                <input id="signup-pwd" type="password" name="password" class="validate" value="{{ Request::old('password') }}">
                                <label for="signup-pwd">Password</label>
                            </div>
                            <div class="field-small" style="padding-left: 5px;">
                                Gender:
                                <p>
                                    <input class="with-gap" name="gender" type="radio" id="male" value="1" />
                                    <label for="male">Male</label>
                                </p>
                                <p>
                                    <input class="with-gap" name="gender" type="radio" id="female" value="0" />
                                    <label for="female">Female</label>
                                </p>
                            </div>
                            <div class="input-field">
                            	<button type="submit" class="btn" id="addmin-add">Add</button>
                            </div>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
						</form>
					</div>
				</div>

			</div>
	</div>
</section>
<script type="text/javascript">
	var adminCreate = '{{route('admin.adduser')}}';
	var token = '{{ Session::token() }}';
</script>

@endsection