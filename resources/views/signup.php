
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Create account on pets life">
		<meta name="keywords" content="Sign in, log in, create account, sign up">
		<meta name="title" content="Sign up Pets life">
		<title>Sign up Pets life</title>
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
								<span class="signin-title">Sign up with</span>
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
								<h5>Sign up</h5>
								<div class="input-field">
							        <i class="material-icons prefix">account_circle</i>
							        <input id="signup_username" type="text" name="signup_username" class="validate">
							        <label for="signup_username">Username</label>
						        </div>
							    <div class="input-field">
							    	<i class="material-icons prefix">email</i>
							        <input id="signup-email" name="signup_email" type="email" class="validate">
							        <label for="signup-email" data-error="invalid email format">Email</label>
							    </div>
							    <div class="input-field">
							    	<i class="material-icons prefix">lock</i>
								    <input id="signup-pwd" type="password" name="signup_pass" class="validate">
							        <label for="signup-pwd">Password</label>
							    </div>
							    <div class="field-small" style="padding-left: 5px;">
							    	Gender:
							    	<p>
								        <input class="with-gap" name="gender" type="radio" id="male"  />
								        <label for="male">Male</label>
								    </p>
								    <p>
								        <input class="with-gap" name="gender" type="radio" id="female"  />
								        <label for="female">Female</label>
								    </p>
							    </div>
							    <div class="input-field" style="padding-left: 44px;">
							    	<button class="waves-effect waves-light btn">Sign up</button>
							    </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>



		<script type="text/javascript" src="../laravel/public/js/jquery-3.0.0.min.js"></script>
		<script type="text/javascript" src="../laravel/public/js/materialize.min.js"></script>
	</body>
</html>