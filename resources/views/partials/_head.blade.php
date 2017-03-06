
    <meta charset="utf-8">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title') | Intermak</title>
    
    <!-- core CSS -->
    <link href={{ asset("css/bootstrap.min.css")}} rel="stylesheet">
    <link href={{ asset("css/font-awesome.min.css")}} rel="stylesheet">
    <link href={{ asset("css/animate.min.css")}} rel="stylesheet">
    <link href={{ asset("css/prettyPhoto.css")}} rel="stylesheet">
    <link href={{ asset("css/main.css")}} rel="stylesheet">
    <link href={{ asset("css/responsive.css")}} rel="stylesheet">
    <link href={{ asset("css/style_articles.css")}} rel="stylesheet">
    <link href={{ asset("css/style_forms.css")}} rel="stylesheet">
    <link href={{ asset("css/style_products.css")}} rel="stylesheet">
    <link href={{ asset("css/style_cart.css")}} rel="stylesheet">
    <link href={{ asset("css/style_showslider.css") }}rel="stylesheet" type="text/css">
    <link href={{ asset("css/style_categories.css") }} rel="stylesheet" type="text/css">
    <script src={{ asset("js/jquery.js")}}></script>
    <script src={{ asset("js/jquery.prettyPhoto.js")}}></script>
    <script src={{ asset("js/jquery.isotope.min.js")}}></script>
    <script src={{ asset("js/jquery.creditCardValidator.js") }}></script>
    <script src={{ asset("js/jssor.slider-21.1.6.mini.js") }}></script>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href={{ asset("images/ico/favicon.ico")}}>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href={{ asset("images/ico/apple-touch-icon-144-precomposed.png")}}>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href={{ asset("images/ico/apple-touch-icon-114-precomposed.png")}}>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href={{ asset("images/ico/apple-touch-icon-72-precomposed.png")}}>
    <link rel="apple-touch-icon-precomposed" href={{ asset("images/ico/apple-touch-icon-57-precomposed.png")}}>
    <script src="https://use.fontawesome.com/8c24a3099d.js"></script>
      <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    <script>
        tinymce.init({
         selector: '.tmcetext'
    });
    </script>