<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar'?'rtl':'ltr' }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{env('APP_NAME')}}</title>
    <!-- GOOGLE FONTS -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <!-- PLUGINS CSS STYLE -->
    <link href="{{myAssets('plugins/nprogress/nprogress.css')}}" rel="stylesheet" />
    <link href="{{myAssets('plugins/flag-icons/css/flag-icon.min.css')}}" rel="stylesheet" />
    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="{{myAssets('css/sleek.css')}}" />
    <!-- FAVICON -->
    <link href="{{myAssets('img/favicon.png')}}" rel="shortcut icon" />
    <!--
      HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{myAssets('plugins/nprogress/nprogress.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css">
    <!-- global custom design -->
    <link id="sleek-css" rel="stylesheet" href="{{myAssets('css/system-design.css')}}" />
    @yield('css')
</head>


<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">

<script>
    NProgress.configure({ showSpinner: false });
    NProgress.start();
</script>

<div class="wrapper">

