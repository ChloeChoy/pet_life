<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ URL::to('src/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/magnific-popup.css') }}">
</head>
<body>
    @include('includes.header')
    
    @yield('content')

    <!-- main search form -->
    <section class="main-search" style="display:none;">
        <div class="container">
            <div class="row">
                <form class="search-form col s11">
                    <div class="input-field">
                        <input id="pl-search" type="search" required autofocus>
                        <button class="search-icon" type="submit"><i class="material-icons">search</i></button>
                        <button type="reset" class="reset-search" style="display:none"><i class="material-icons">close</i></button>
                    </div>
                </form>
                <div class="col s1">
                    <button class="close-main-search btn waves-effect waves-light"><i class="material-icons">close</i></button>
                </div>
            </div>
        </div>
    </section>
    <!-- end main search form -->

    <!-- Go to www.addthis.com/dashboard to customize your tools --> 
    <div id="pl-share-post" class="addthis_inline_share_toolbox z-depth-1" style="display:none"></div>
 

    <script type="text/javascript">
        function previewFiles() {
          var preview = document.querySelector('#preview');
          var files   = document.querySelector('#att-files').files;
          // var fileRemoves = document.querySelector('#mp-remove-files');

          function readAndPreview(file) {

            // Make sure `file.name` matches our extensions criteria
            if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
              var reader = new FileReader();

              reader.addEventListener("load", function () {
                var image = new Image();
                image.height = 100;
                image.name = file.name;
                image.src = this.result;
                preview.appendChild( image );
                var para = document.createElement("a");
                //var para = "<a class='remove-preview'>Delete</a>";
                var node = document.createTextNode("Delete");
                para.appendChild(node);
                preview.appendChild( para );
                para.addEventListener("click", function(){
                    // fileRemoves.value += this.previousElementSibling.getAttribute('name') + ',';
                    this.previousElementSibling.remove();
                    this.remove();
                });
              }, false);

              reader.readAsDataURL(file);
            }

          }

          if (files) {
            [].forEach.call(files, readAndPreview);
            //deletePreview();
          }

        }
    </script>

    <script src="{{ URL::to('src/js/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ URL::to('src/js/materialize.min.js') }}"></script>
    <script src="{{ URL::to('src/js/dropzone.js') }}"></script>
    <script src="{{ URL::to('src/js/jquery-migrate-3.0.0.min.js') }}"></script>
    <script src="{{ URL::to('src/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('src/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ URL::to('src/js/app.js') }}"></script>
    <script src="{{ URL::to('src/js/main.js') }}"></script>
    <script src="{{ URL::to('src/js/Chart.bundle.js') }}"></script>
    <!-- Go to www.addthis.com/dashboard to customize your tools --> 
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-582f0bca1f9d7459"></script> 

    <script type="text/javascript">
        //users chart
        var users = document.getElementById("userChart");
        var userChart = new Chart(users, {
            type: 'pie',
            data: {
                labels: ["Male", "Female"],
                datasets: [{
                    label: '# of Votes',
                    data: [1000, 800],
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
                    label: '# of Votes',
                    data: [1000, 800],
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
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    backgroundColor: '#f44265',
                    borderColor: '#f44268',
                    data: [10, 23, 5, 99, 67, 43, 0],
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
</body>
</html>
