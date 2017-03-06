        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img src={{ asset("images/logo.png")}} alt="logo"></a>
                </div>
                
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('/') ? "active" : "" }}"><a href="/">Home</a></li>
                        <li class="{{ Request::is('about') ? "active" : "" }}"><a href="/about">About Us</a></li>
                        <li class="{{ Request::is('contact') ? "active" : "" }}"><a href="/faq">FAQ</a></li>
                        <li class="{{ Request::is('contact') ? "active" : "" }}"><a href="/contact">Contact</a></li> 
                        <li class="dropdown {{ Request::is('products') ? "active" : "" }} }}">
                            <a href="{{ route('products.index') }}">Shop <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('products.index', 'selectgender=Male') }}">Men</a></li>
                                <li><a href="{{ route('products.index', 'selectgender=Female') }}">Women</a></li>
                                <li><a href="{{ route('products.index') }}">Both Sexes</a></li>
                            </ul>
                        </li>
                        
                        {{--<li class="{{ Request::is('products') ? "active" : "" }}"><a href="/products">Products</a></li>--}}
                        <li class="{{ Request::is('articles') ? "active" : "" }}"><a href="/articles">Articles</a></li>
                        <li><a href="{{ route('cart.show') }}">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a></li>
                        @if(Auth::check())
                            @if($role=="administrator")
                                <li class="dropdown {{ (Request::is('administrators') || Request::is('categories')) ? "active" : "" }}"><a>Admins <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="{{ Request::is('administrators') ? "active" : "" }}"><a href="/administrators">Users and Administrators</a></li>
                                        <li class="{{ Request::is('categories') ? "active" : "" }}"><a href="/categories">Categories</a></li>
                                    </ul>
                                </li>
                                
                            @endif

                            <li class="dropdown {{ Request::is('account') ? "active" : "" }}"><a>Account <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('profiles.index') }}">Profile</a></li>
                                    <li><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                </ul>
                            </li>
                        @else
                            <li class="{{ Request::is('login') ? "active" : "" }}"><a href="/login">Login</a></li>
                            <li class="{{ Request::is('register') ? "active" : "" }}"><a href="/register">Register</a></li>
                        @endif
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>                 
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->