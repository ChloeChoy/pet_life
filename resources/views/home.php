
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Your home page on pets life. You can post your video, image about pets.">
		<meta name="title" content="Pets life home page">
		<title>Pets Life</title>
		<link rel="stylesheet" type="text/css" href="../laravel/public/css/style.css">
		<link rel="stylesheet" type="text/css" href="../laravel/public/css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../laravel/public/css/font-awesome.min.css">
	</head>
	<body>
		<section class="main-nav">
			<div class="container">
				<div class="row">
					<nav class="main-menu">
					    <div class="nav-wrapper row">
					    	<div class="col l2">
					        	<a href="#" class="brand-logo">Pets Life</a>
					        	<a href="#" data-activates="mobile-navbar" class="button-collapse"><i class="material-icons">menu</i></a>
					        </div>
						    <ul class="right hide-on-med-and-down">
						    <li><a href="#"><i class="material-icons left">search</i></a></li>
						        <li><a href="#">News</a></li>
						        <li><a href="#">Home</a></li>
						        <li><a href="#">Avatar</a></li>
						        <li><a href="#">Message</a></li>
						        <li><a href="#">Notification</a></li>
						    </ul>
						    <ul class="side-nav" id="mobile-navbar">
						        <li><a href="#">News</a></li>
						        <li><a href="#">Home</a></li>
						        <li><a href="#">Avatar</a></li>
						        <li><a href="#">Message</a></li>
						        <li><a href="#">Notification</a></li>
						    </ul>
						    <form class="search-form col s8">
						        <div class="input-field">
						            <input id="pl-search" type="search" required>
						            <label for="pl-search"><i class="material-icons">search</i></label>
						            <button type="reset" class="reset-search" style="display:none"><i class="material-icons">close</i></button>
						        </div>
						    </form>
					    </div>
					</nav>
				</div>
			</div>
		</section>




		<script type="text/javascript" src="../laravel/public/js/jquery-3.0.0.min.js"></script>
		<script type="text/javascript" src="../laravel/public/js/materialize.min.js"></script>

		<script type="text/javascript">
			$( document ).ready(function(){
				$(".button-collapse").sideNav();
			});

			$(document).ready(function(){
				$('#pl-search').focus(function(){
					$('.reset-search').css({'left' : ($(this).outerWidth() - 40).toString() + 'px'}).show();
				}).blur(function(){
					$('.reset-search').hide();
				});
			});
		</script>
	</body>
</html>