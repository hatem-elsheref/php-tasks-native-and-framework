<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{env('APP_NAME')}}</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" id="bootstrap-css">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <!-- Custom styles for this template -->
    <link href="{{myAssets('css/main.css')}}" rel="stylesheet">
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <!------ Include the above in your HEAD tag ---------->
    <style></style>
</head>
<body>
<div class="container" style="margin-top: 100px;">
</div>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ">
                <li class="nav-item active"><a class="nav-link" href="{{route('application')}}">الرئيسية</a></li>
            </ul>
        </div>
        <a class="navbar-brand" href="#">{{env('APP_NAME')}}</a>
    </div>
</nav>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-9" style="text-align: end">
            <div class="card mb-4">
                @yield('content')
            </div>
        </div>
        <div class="col-md-3" style="margin-top: -25px">


            <!-- Categories Widget -->
            <div class="card my-3" style="text-align: end">
                <h5 class="card-header text-white bg-secondary  text-white" style="text-align: end;"> التسجيل</h5>

                <div class="list-group">
                    @guest
                        <a href="{{route('login')}}" class="list-group-item list-group-item-action"> تسجيل الدخول </a>
                        <a href="{{route('register')}}" class="list-group-item list-group-item-action"> تسجيل حساب جديد </a>
                    @else
                        <a href="{{route('home')}}" class="list-group-item list-group-item-action">لوحة التحكم</a>
                            <a href="javascript:void(0)"  class="list-group-item list-group-item-action" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">  {{__('backend.logout')}} </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="card my-3" style="text-align: end">
                <h5 class="card-header text-white bg-default text-dark" style="text-align: end;">القائمة الرئيسية</h5>

                <div class="list-group">
                    <a href="{{route('application')}}" class="list-group-item list-group-item-action">الصفحة الرئيسية</a>
                    <a href="{{route('available')}}" class="list-group-item list-group-item-action">البعثات المتوفره حاليا</a>
                    <a href="{{route('guide')}}" class="list-group-item list-group-item-action">دليل تعبئت الطلبات</a>
                    <a href="{{route('faq')}}" class="list-group-item list-group-item-action">الاكثر تكرارا</a>
                    <a href="{{route('advice')}}" class="list-group-item list-group-item-action"> نصائح وارشادات</a>
                    <a href="{{route('contact')}}" class="list-group-item list-group-item-action"> اتصل بنا </a>
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->
</div>
<!-- /.container -->


<!-- Bootstrap core JavaScript -->
<script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"></script>
</body>
</html>
