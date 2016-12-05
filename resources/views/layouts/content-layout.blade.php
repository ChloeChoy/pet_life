<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ URL::to('src/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/search.css') }}">
    <script src="{{ URL::to('src/js/Chart.bundle.js') }}"></script>
    <script src="{{ URL::to('src/js/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ URL::to('src/js/jquery.magnific-popup.js') }}"></script>
</head>
<body>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=942200332520167";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    @include('includes.header')
    
    @yield('content')

    <!-- main search form -->
    <section class="main-search" style="display:none;">
        <div class="container">
            <div class="row">
                <form class="search-form col s11" action="{{ route('search') }}" method="get">
                    <div class="input-field">
                        <input id="pl-search" type="search" name="q" required autofocus>
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
        function previewFiles(fileId, previewId) {
          var preview = document.querySelector('#' + previewId);
          var files   = document.querySelector('#' + fileId).files;

          function readAndPreview(file) {

            // Make sure `file.name` matches our extensions criteria
            if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
              var reader = new FileReader();

              reader.addEventListener("load", function () {
                var previewItem = document.createElement("div");
                previewItem.className = "preview-item";
                var image = new Image();
                image.height = 100;
                image.name = file.name;
                image.src = this.result;
                previewItem.appendChild( image );
                var para = document.createElement("a");
                var node = document.createTextNode("Delete");
                para.appendChild(node);
                previewItem.appendChild( para );
                preview.appendChild(previewItem);
                para.addEventListener("click", function(){
                    this.parentNode.remove();
                    // this.previousElementSibling.remove();
                    // this.remove();
                });
              }, false);

              reader.readAsDataURL(file);
            }

          }

          if (files) {
            [].forEach.call(files, readAndPreview);
          }

        }
    </script>

    <script src="{{ URL::to('src/js/materialize.min.js') }}"></script>
    <script src="{{ URL::to('src/js/jquery-migrate-3.0.0.min.js') }}"></script>
    <script src="{{ URL::to('src/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('src/js/app.js') }}"></script>
    <script src="{{ URL::to('src/js/main.js') }}"></script>
    <script src="{{ URL::to('src/js/jquery.autocomplete.js') }}"></script>
    <script src="{{ URL::to('users.js') }}"></script>

    <!-- Go to www.addthis.com/dashboard to customize your tools --> 
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-582f0bca1f9d7459"></script> 

    <!-- Search scrift start --> 
    <script>
        // var searchplus = <?php //echo json_encode($productList);?>;
        var resultLimit = 5;
        var visibleImage = 1;
        var minSearchChars = 1;
        //  var minSearchChars = '2';
    </script>
    <script>
         // function ($) {
            $('#pl-search').autocomplete({
                lookup: searchplus,
                lookupLimit: resultLimit,
                maxHeight: 2000,
                minChars: minSearchChars,
                //      onSelect: function (suggestion) {
                //          window.location.href = suggestion.productUrl;
                //      },
                formatResult: function (suggestion, currentValue) {
                    return ("<a href='" + suggestion.url + "'><div class='suggestion-left'><img class='responsive-img' src='" + ( visibleImage == 1 ? suggestion.image : '') + "' alt='user avatar'" + "/></div>" + "<div class='suggestion-right'><div class='product-line product-name'>" + suggestion.value + "</div></div></a>");
                },
                onSearchComplete: function (query, suggestion) {
                    $('.autocomplete-suggestions').append("<div id='view_all'><a href='{{ route('search') }}?q="+$('#pl-search').val()+"'>View all</a></div>");
                }
            });
        // };
    </script>
    <!-- Search scrift end --> 
</body>
</html>
