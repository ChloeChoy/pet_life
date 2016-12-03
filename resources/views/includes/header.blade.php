
<!-- main section navbar -->
<section class="main-nav">
    <div class="container">
        <div class="row">
            <nav class="main-menu">
                <div class="nav-wrapper row">
                    <div class="col l2">
                        <a class="brand-logo" href="{{ route('dashboard') }}">Pets Life</a>
                        <a href="#" data-activates="mobile-navbar" class="button-collapse"><i class="material-icons">menu</i></a>
                    </div>
                    <ul class="right">
                        <li class="main-menu-items"><a id="menu-message" href="#"><i class="material-icons">message</i></a></li>
                        <li class="main-menu-items"><a id="menu-noti" href="#"><i class="fa fa-globe" aria-hidden="true"></i></a></li>
                    </ul>
                    <ul class="right hide-on-med-and-down">
                        <li class="main-menu-items"><a href="{{route('post.news')}}">News</a></li>
                        <li class="main-menu-items"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li id="link-sub-menu" class="main-menu-items">
                            <a href="#">
                                @if(Auth::user()->avatar)
                                <img class="responsive-img" alt="avatar" src="{{URL::to('post-images/'.Auth::user()->avatar)}}">
                                @else
                                <img class="responsive-img" alt="avatar" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}">
                                @endif
                            </a>
                            <ul id="sub-menu-account">
                                <?php 
                                    if(Auth::user()->email == 'khanhpkk@gmail.com'){
                                        echo '<li><a href="'.route('administrator').'">Administrator</a></li> ';
                                    }
                                ?>
                               <li><a href="{{ route('account') }}">Profile</a></li> 
                               <li><a href="#">Settings</a></li> 
                               <li><a href="{{ route('logout') }}">Log out</a></li> 
                            </ul>
                        </li>
                    </ul>
                    <ul class="right">
                        <li class="main-menu-items"><a id="display-main-search"><i class="material-icons left">search</i></a></li>
                    </ul>
                    <ul id="mobile-navbar" class="side-nav">
                        <li>
                            <div class="userView">
                              <div class="background">
                                @if(Auth::user()->cover_photo)
                                <img id="side-nav-cover" src="{{URL::to('post-images/'.Auth::user()->cover_photo)}}">
                                @else
                                <img id="side-nav-cover" src="{{ URL::to('src/images/default-wall.jpg') }}">
                                @endif
                              </div>
                              <a href="{{route('account')}}">
                                @if(Auth::user()->avatar)
                                    <img class="circle" src="{{URL::to('post-images/'.Auth::user()->avatar)}}">
                                @else
                                    <img class="circle" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}">
                                @endif
                                </a>
                              <a href="{{route('account')}}"><span class="white-text name">{{ Auth::user()->name }}</span></a>
                            </div>
                        </li>
                        <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i>Home</a></li>
                        <li><a href="{{ route('photos') }}"><i class="material-icons">photo_library</i>Media</a></li>
                        <li><div class="divider"></div></li>
                        <li><a href="#"><i class="material-icons">chat</i>Chat</a></li>
                        <li><a href="#"><i class="material-icons">settings</i>Setting</a></li>
                        @if(Auth::user()->email == 'khanhpkk@gmail.com')
                            <li><a href="{{ route('administrator') }}"><i class="material-icons">person</i>Administrator</a></li> 
                        @endif
                        <li><div class="divider"></div></li>
                        <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 26px;margin-left: 3p;position: relative;left: 4px;"></i>Log out</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</section>
<!-- end navbar -->

