
<!-- main section navbar -->
<section class="main-nav">
    <div class="container">
        <div class="row">
            <nav class="main-menu">
                <div class="nav-wrapper row">
                    <div class="col l2">
                        <a href="#" class="brand-logo" href="{{ route('dashboard') }}">Pets Life</a>
                        <a href="#" data-activates="mobile-navbar" class="button-collapse"><i class="material-icons">menu</i></a>
                    </div>
                    <ul class="right">
                        <li class="main-menu-items"><a id="menu-message" href="#"><i class="material-icons">message</i></a></li>
                        <li class="main-menu-items"><a id="menu-noti" href="#"><i class="fa fa-globe" aria-hidden="true"></i></a></li>
                    </ul>
                    <ul class="right hide-on-med-and-down">
                        <li class="main-menu-items"><a href="#">News</a></li>
                        <li class="main-menu-items"><a href="#">Home</a></li>
                        <li id="link-sub-menu" class="main-menu-items">
                            <a href="#">Account</a>
                            <ul id="sub-menu-account">
                               <li><a href="{{ route('account') }}">Profile</a></li> 
                               <li><a href="#">Settings</a></li> 
                               <li><a href="{{ route('logout') }}">Log out</a></li> 
                            </ul>
                        </li>
                    </ul>
                    <ul class="right">
                        <li class="main-menu-items"><a id="display-main-search" href="#"><i class="material-icons left">search</i></a></li>
                    </ul>
                    <ul class="side-nav" id="mobile-navbar">
                        <li><a href="#">Avatar</a></li>
                        <li><a href="#">News</a></li>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Chat</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Log out</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</section>
<!-- end navbar -->

