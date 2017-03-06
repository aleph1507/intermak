<!DOCTYPE html>
<html>
<head>
    @include('partials._head')
</head>
	
<body class="homepage">

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=293177404041236";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>


    <div id="header">
        @include('partials._header')
        @include('partials._navbar')
    </div>

    @yield('top_scripts')

    @yield('styles')

    @include('partials._messages')

    @yield('content')

    @include('partials._footer')

    @include('partials._javascript')

    @yield('scripts')

</body>
</html>