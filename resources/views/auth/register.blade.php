<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">
        <title>{{env('APP_NAME')}}</title>
        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
        <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
        <!-- PLUGINS CSS STYLE -->
        <link href="{{backendAssets('plugins/nprogress/nprogress.css')}}" rel="stylesheet" />
        <!-- SLEEK CSS -->
        <link id="sleek-css" rel="stylesheet" href="{{backendAssets('css/sleek.rtl.css')}}" />
        <!-- FAVICON -->
        <link href="{{backendAssets('img/favicon.png')}}" rel="shortcut icon" />
        <!--
          HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
        -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="{{backendAssets('plugins/nprogress/nprogress.js')}}"></script>
        <style>
            input{
                text-align: end;
            }
        </style>
    </head>

</head>
<body class="" id="body">
<div class="container d-flex flex-column justify-content-between vh-100">
    <div class="row justify-content-center mt-5">
        <div class="col-xl-5 col-lg-6 col-md-10">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="app-brand" style="margin-left: 35%">
                        <a href="{{route('dashboard')}}">
                            <span class="brand-name">{{ env('APP_NAME') }}</span>
                            <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33"
                                 viewBox="0 0 30 33">
                                <g fill="none" fill-rule="evenodd">
                                    <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                                </g>
                            </svg>

                        </a>
                    </div>
                </div>
                <div class="card-body p-5">

                    <h4 class="text-dark mb-5 text-center">{{__('backend.sign_up')}}</h4>
                    <form action="{{route('register')}}" method="post">
                        @csrf
                        @method('POST')
                        <div class="row">

                            <div class="form-group col-md-12 mb-4">
                                <input type="text" name="name" class="form-control input-lg" value="{{ old('name') }}" id="name" aria-describedby="name" placeholder="{{__('backend.form_name')}}">
                                @error('name')
                                <span class="text-danger">* {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 mb-4">
                                <input type="tel" name="phone" class="form-control input-lg" value="{{ old('phone') }}" id="phone" aria-describedby="phone" placeholder="{{__('backend.form_phone')}}">
                                @error('phone')
                                <span class="text-danger">* {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 mb-4">
                                <input type="email" name="email" class="form-control input-lg" value="{{ old('email') }}" id="email" aria-describedby="email" placeholder="{{__('backend.form_email')}}">
                                @error('email')
                                <span class="text-danger">* {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 mb-4">
                                <input type="text" name="city" class="form-control input-lg" value="{{ old('city') }}" id="city" aria-describedby="city" placeholder="{{__('backend.form_city')}}">
                                @error('city')
                                <span class="text-danger">* {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12 ">
                                <input type="password" name="password" class="form-control input-lg" id="password" placeholder="{{__('backend.form_password')}}">
                                @error('password')
                                <span class="text-danger">* {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 ">
                                <input type="password" name="password_confirmation" class="form-control input-lg" id="password_confirmation" placeholder="{{__('backend.form_password_confirmation')}}">
                                @error('password_confirmation')
                                <span class="text-danger">* {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">{{__('backend.sign_in')}}</button>
                                <p>{{__('backend.do_you_have_an_account')}}
                                    <a class="text-blue" href="{{route('login')}}">{{__('backend.sign_in')}}</a>
                                </p>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright pl-0">
        <p class="text-center">&copy; {{date('Y',time())}} {{__(config('app.footer.message'))}}
            <a class="text-primary" href="{{config('app.footer.ownerUrl')}}" target="_blank">{{config('app.footer.ownerName')}}</a>.
        </p>
    </div>
</div>

</body>
</html>
