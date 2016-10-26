<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../laravel/public/css/style.css">
		<link rel="stylesheet" type="text/css" href="../laravel/public/css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../laravel/public/css/font-awesome.min.css">
	</head>
	<body>
		
		<section class="main-nav">
			<div class="container">
				<div class="row">
					<nav class="main-menu">
					    <div class="nav-wrapper">
					        <a href="#" class="brand-logo">Pets Life</a>
					    </div>
					</nav>
				</div>
			</div>
		</section>

		<section class="main-signin">
			<div class="container">
				<div class="row">
					<div class="col s12 m8 l6">
						<div class="col-signin">
							<div class="social-signin row">
								<span class="signin-title">Sign in with</span>
								<div class="col s4">
									<a id="signin-fb" class="waves-effect waves-light btn"><i class="fa fa-facebook"></i></a>
								</div>
								<div class="col s4">
									<a id="signin-gg" class="waves-effect waves-light btn" title="Sign in with google+"><i class="fa fa-google-plus"></i></a>
								</div>
								<div class="col s4">
									<a id="signin-twt" class="waves-effect waves-light btn"><i class="fa fa-twitter"></i></a>
								</div>
							</div>
							<form class="signin-form" action="#" method="post">
								<h5>Sign in</h5>
							    <div class="input-field">
							    	<i class="material-icons prefix">email</i>
							        <input id="signin-email" type="email" class="validate">
							        <label for="signin-email" data-error="invalid email format">Email</label>
							    </div>
							    <div class="input-field">
							    	<i class="material-icons prefix">lock</i>
								    <input id="signin-pwd" type="password" class="validate">
							        <label for="signin-pwd">Password</label>
							    </div>
							    <div class="field-small">
							    	<p>
								      <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />
								      <label for="filled-in-box">Remember me</label>
								    </p>
								    <a id="forgot-pass" href="#">Forgot password</a>
							    </div>
							    <div class="input-field">
							    	<button class="waves-effect waves-light btn">Sign in</button>
							    </div>
							</form>
							<a class="create-acc" href="#0">Create account here</a>
						</div>
					</div>
				</div>
			</div>
		</section>



		<script type="text/javascript" src="../laravel/public/js/jquery-3.0.0.min.js"></script>
		<script type="text/javascript" src="../laravel/public/js/materialize.min.js"></script>
	</body>
</html>