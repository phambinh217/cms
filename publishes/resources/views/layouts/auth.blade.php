<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js' ) }}"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js' ) }}"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>{{ $title or config( 'app.name' ) }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="" name="author" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ url( 'assets/admin/global/plugins/font-awesome/css/font-awesome.min.css' ) }}" rel="stylesheet" type="text/css" />
        <link href="{{ url( 'assets/admin/global/plugins/simple-line-icons/simple-line-icons.min.css' ) }}" rel="stylesheet" type="text/css" />
        <link href="{{ url( 'assets/admin/global/plugins/bootstrap/css/bootstrap.min.css' ) }}" rel="stylesheet" type="text/css" />
        <link href="{{ url( 'assets/admin/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css' ) }}" rel="stylesheet" type="text/css" />
        <link href="{{ url( 'assets/admin/global/css/components.css' ) }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ url( 'assets/admin/global/css/plugins.css' ) }}" rel="stylesheet" type="text/css" />
        <link href="{{ url( 'assets/admin/pages/css/login-3.css' ) }}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{{ url( 'favicon.ico' ) }} " />
    </head>

    <body class=" login">
        <div class="logo">
            <a href="{{ url( '/' ) }}">
                <img src="{{ setting('logo', url( 'logo.png' )) }}" alt="" style="width: 200px" />
            </a>
        </div>
        <div class="content">
            @yield( 'content' )
        </div>
        <div style="padding: 30px"></div>
        <!--[if lt IE 9]>
        <script src="{{ url( 'assets/admin/global/plugins/respond.min.js' ) }}"></script>
        <script src="{{ url( 'assets/admin/global/plugins/excanvas.min.js' ) }}"></script> 
        <script src="{{ url( 'assets/admin/global/plugins/ie8.fix.min.js' ) }}"></script> 
        <![endif]-->
        <script src="{{ url( 'assets/admin/global/plugins/jquery.min.js' ) }}" type="text/javascript"></script>
        <script src="{{ url( 'assets/admin/global/plugins/bootstrap/js/bootstrap.min.js' ) }}" type="text/javascript"></script>
</body>
</html>