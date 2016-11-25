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

				<div class="col s12 adminCharts z-depth-1">
					<span class="title">Dashboard</span>
					<div class="row chart-content">
						<div class="col s12">
							<div class="posts graph">
								<span class="graph-title">Posts ({{count($posts)}})</span>
								<canvas id="postChart"></canvas>
							</div>
						</div>
						<div class="col s12 m6">
							<div class="users graph">
								<span class="graph-title">Users ({{count($users)}})</span>
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

	<script type="text/javascript">
        //users chart
        var users = document.getElementById("userChart");
        var userChart = new Chart(users, {
            type: 'pie',
            data: {
                labels: ["Male", "Female"],
                datasets: [{
                    label: 'User chart',
                    data: [{{$male}}, {{$female}}],
                    backgroundColor: [
                        '#f44265',
                        '#3333ff',
                    ],
                }]
            },
            options: {
                responsive: true
            }
        });
        //end users chart

        // users online chart
        var userOnl = document.getElementById("userOnlChart");
        var userChart = new Chart(userOnl, {
            type: 'pie',
            data: {
                labels: ["Online", "Offline"],
                datasets: [{
                    label: 'User online chart',
                    data: [1, 10],
                    backgroundColor: [
                        '#00cc99',
                        '#eee',
                    ],
                }]
            },
            options: {
                responsive: true
            }
        });
        //end users online chart

        // post chart
        var posts = document.getElementById("postChart");
        var postChart = new Chart(posts, {
            type: 'line',
            data: {
                labels: ["Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Total posts",
                    backgroundColor: '#f44265',
                    borderColor: '#f44268',
                    data: [{{$sep}}, {{$oct}}, {{$nov}}, {{$dec}}],
                    fill: false,
                    pointRadius: 10,
                    pointHoverRadius: 15,
                    showLine: false // no line shown
                }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                },
                legend: {
                    display: false
                },
                elements: {
                    point: {
                    }
                }
            }

        });
        // end post chart
    </script>

<!-- end content -->

@endsection