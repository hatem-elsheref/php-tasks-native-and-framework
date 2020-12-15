@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb" class="paths-nav">
        <ol class="breadcrumb breadcrumb-inverse">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}">{{__('backend.home')}}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{__('backend.statistics')}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="media widget-media p-4 bg-white border">
                <div class="icon rounded-circle mr-4 bg-success">
                    <i class="mdi mdi-playlist-check text-white "></i>
                </div>
                <div class="media-body align-self-center">
                    <h4 class="text-primary mb-2">{{$studies}}</h4>
                    <p>المنح المتاحة</p>

                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="media widget-media p-4 bg-white border">
                <div class="icon rounded-circle mr-4 bg-danger">
                    <i class="mdi mdi-airplane-takeoff text-white "></i>
                </div>
                <div class="media-body align-self-center">
                    <h4 class="text-primary mb-2">{{$missions}}</h4>
                    <p>البعثات المتاحة</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="media widget-media p-4 bg-white border">
                <div class="icon rounded-circle mr-4 bg-warning">
                    <i class="mdi mdi-account-group-outline text-white "></i>
                </div>
                <div class="media-body align-self-center">
                    <h4 class="text-primary mb-2">{{$menahCount}}</h4>
                    <p>الطلاب المتقمين لطلب منحة</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="media widget-media p-4 bg-white border">
                <div class="icon rounded-circle mr-4 bg-primary">
                    <i class="mdi mdi-account-group-outline text-white "></i>
                </div>
                <div class="media-body align-self-center">
                    <h4 class="text-primary mb-2">{{$missionsCount}}</h4>
                    <p> الطلاب المتقدمين لطلب بعثة </p>
                </div>
            </div>
        </div>
    </div>
@endsection





