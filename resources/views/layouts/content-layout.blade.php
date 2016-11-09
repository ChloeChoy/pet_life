<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ URL::to('src/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/font-awesome.min.css') }}">
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

    <script src="{{ URL::to('src/js/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ URL::to('src/js/materialize.min.js') }}"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="{{ URL::to('src/js/app.js') }}"></script>
    <script src="{{ URL::to('src/js/main.js') }}"></script>
</body>
</html>
