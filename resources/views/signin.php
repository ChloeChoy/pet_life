<!DOCTYPE HTML>
<html>
	<head>
		<!-- <link rel="stylesheet" type="text/css" href="../laravel/resources/assets/less/app.less"> -->
		<link rel="stylesheet" type="text/css" href="../laravel/public/css/style.css">
		<link rel="stylesheet" type="text/css" href="../laravel/public/css/materialize.min.css">
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
							<form class="signin-form" action="#" method="post">
								<span class="signin-title">Sign in</span>
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
							    <div class="input-field">
							    	<button class="waves-effect waves-light btn">Sign in</button>
							    </div>
							</form>
							<span class="signin-divide">OR</span>
							<div class="social-signin">
								<span class="signin-title">Sign in with</span>
								<a id="signin-fb" class="waves-effect waves-light btn">Sign in with facebook</a>
								<a id="signin-gg" class="waves-effect waves-light btn">Sign in with google+</a>
								<a id="signin-twt" class="waves-effect waves-light btn">Sign in with Twitter</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>



		<script type="text/javascript" src="../laravel/public/js/jquery-3.0.0.min.js"></script>
		<script type="text/javascript" src="../laravel/public/js/materialize.min.js"></script>
	</body>
</html>