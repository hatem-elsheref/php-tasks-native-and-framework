@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb" class="paths-nav">
        <ol class="breadcrumb breadcrumb-inverse">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}">{{__('backend.home')}}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{__('backend.settings')}}</li>
        </ol>
    </nav>
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>{{__('backend.general_settings')}}</h2>
        </div>
        <div class="card-body">
        </div>
    </div>
@endsection
