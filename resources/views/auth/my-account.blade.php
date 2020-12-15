@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb" class="paths-nav">
        <ol class="breadcrumb breadcrumb-inverse">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">{{__('backend.home')}}</a>
            </li>

            <li class="breadcrumb-item active" aria-current="page">{{__('backend.profile')}}</li>
        </ol>
    </nav>

    @php
        $COUNTRY=auth()->user()->country;
    @endphp


    <div class="bg-white border rounded">
        <div class="row no-gutters">
            <div class="col-lg-4 col-xl-3">
                <div class="profile-content-left pt-5 pb-3 px-3 px-xl-5">
                    <div class="card text-center widget-profile px-0 border-0">
                        <div class="card-img mx-auto rounded-circle">
                            <img src="{{ uploads(auth('web')->user()->avatar)}}" style="width:100px;height:100px" alt="{{ auth('web')->user()->name }} avatar">
                        </div>
                        <div class="card-body">
                            <h4 class="py-2 text-dark">{{ ucwords(auth('web')->user()->name) }}</h4>
                            <p>{{ auth('web')->user()->email }}</p>

                        </div>
                    </div>

                    <hr class="w-100">
                    <div class="contact-info pt-4">
                        <h5 class="text-dark mb-1">{{__('backend.account_information')}}</h5>
                        <p class="text-dark font-weight-medium pt-4 mb-2">{{__('backend.form_name')}}</p>
                        <p>{{ auth('web')->user()->name }}</p>
                        <p class="text-dark font-weight-medium pt-4 mb-2">{{__('backend.form_email')}}</p>
                        <p>{{ auth('web')->user()->email }}</p>
                        <p class="text-dark font-weight-medium pt-4 mb-2">{{__('backend.form_phone')}}</p>
                        <p>{{ auth('web')->user()->phone }}</p>
                        <p class="text-dark font-weight-medium pt-4 mb-2">{{__('backend.form_country')}}</p>
                        <p>{{ $COUNTRY->name }}</p>
                        <p class="text-dark font-weight-medium pt-4 mb-2">{{__('backend.form_city')}}</p>
                        <p>{{ auth('web')->user()->city }}</p>
                        <p class="text-dark font-weight-medium pt-4 mb-2">{{__('backend.created_at')}}</p>
                        <p>{{ auth('web')->user()->created_at->format('Y-m-d @ h:i:s a') }}</p>

                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-9">
                <div class="profile-content-right py-5">
                    <div class="row">
                        <div class="col-lg-10 m-auto">
                            <ul class="nav nav-pills nav-justified nav-style-fill" id="myTab" role="tablist">
                                <li class="nav-item" id="general_settings">
                                    <a class="nav-link active" id="home3-tab" data-toggle="tab" href="#home3" role="tab" aria-controls="home3" aria-selected="true">{{__('backend.general_settings')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="profile3-tab" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile3" aria-selected="false">{{__('backend.security_settings')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent4">
                                <div class="tab-pane pt-3 fade active show" id="home3" role="tabpanel" aria-labelledby="home3-tab">
                                    <div class="mt-5">
                                        <form method="POST" action="{{ route('my-account.update') }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="tab" value="information">
                                            <div class="form-group row">
                                                <label for="coverImage" class="col-sm-4 col-lg-2 ">{{__('backend.form_avatar')}}</label>
                                                <div class="col-sm-6 col-lg-9">
                                                    <div class="custom-file mb-1">
                                                        <input type="file" class="custom-file-input" name="avatar" id="coverImage" >
                                                        <label class="custom-file-label" for="coverImage">{{__('backend.choice_file')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-lg-1">
                                                    <img style="width: 60px;height:60px" id="img-preview" class="img-responsive  img-fluid" src="{{ uploads(auth('web')->user()->avatar)}}">
                                                </div>


                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-12">
                                                    <label for="name">{{__('backend.form_name')}}</label>
                                                    <input type="text" name="name" class="form-control @error('name') is-invalid   @enderror" id="name" value="{{ auth('web')->user()->name }}" >
                                                    @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-lg-12">
                                                    <label for="email">{{__('backend.form_email')}}</label>
                                                    <input type="text" name="email" class="form-control @error('email') is-invalid   @enderror" id="email" value="{{ auth('web')->user()->email }}" >
                                                    @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

{{--                                            <div class="row mb-2">--}}
{{--                                                <div class="col-lg-12">--}}
{{--                                                    <label for="email">{{__('backend.country')}}</label>--}}
{{--                                                    <select name="country_id" class="form-control @error('country_id') is-invalid @enderror"  id="country">--}}
{{--                                                        <option disabled selected>{{__('backend.select_option')}}</option>--}}
{{--                                                        @foreach($countries as $country)--}}
{{--                                                            <option value="{{$country->id}}" {{ $COUNTRY->id== $country->id ?'selected':''}}>{{$country->name}}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                    @error('country_id')--}}
{{--                                                    <div class="invalid-feedback">--}}
{{--                                                        {{ $message }}--}}
{{--                                                    </div>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}


                                            <div class="row mb-2">
                                                <div class="col-lg-12">
                                                    <label for="city">{{__('backend.form_city')}}</label>
                                                    <input type="text" name="city" class="form-control @error('city') is-invalid   @enderror" id="city" value="{{ auth('web')->user()->city }}" >
                                                    @error('city')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-12">
                                                    <label for="phone">{{__('backend.form_phone')}}</label>
                                                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid   @enderror" id="phone" value="{{ auth('web')->user()->phone }}" >
                                                    @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>



{{--                                            <div class="row mb-2">--}}
{{--                                                <div class="col-lg-12">--}}
{{--                                                    <label for="city">{{__('backend.form_city')}}</label>--}}
{{--                                                    <input type="text" name="city" class="form-control @error('city') is-invalid   @enderror" id="city" value="{{ auth('web')->user()->city }}" >--}}
{{--                                                    @error('city')--}}
{{--                                                    <div class="invalid-feedback">--}}
{{--                                                        {{ $message }}--}}
{{--                                                    </div>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}






                                            <div class="d-flex justify-content-end mt-5">
                                                <button type="submit" class="btn btn-primary mb-2">{{__('backend.save')}}</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane pt-3 fade " id="profile3" role="tabpanel" aria-labelledby="profile3-tab">
                                    <div class="mt-5">
                                        <form   method="POST" action="{{ route('my-account.reset') }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="tab" value="security">

                                            <div class="form-group mb-4">
                                                <label for="old_password">{{__('backend.old_password')}}</label>
                                                @error('invalid_old_password')
                                                <div class="text-danger">*  {{ $message }} </div>
                                                @enderror
                                                <input type="password" name="old_password" class="form-control @error('old_password') is-invalid   @enderror" id="old_password">
                                                @error('old_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="password">{{__('backend.new_password')}}</label>
                                                <input type="password" class="form-control @error('new_password') is-invalid   @enderror"  name="new_password" value="{{ old('new_password') }}" id="password">
                                                @error('new_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="password_confirmation">{{__('backend.form_password_confirmation')}}</label>
                                                <input type="password" class="form-control @error('new_password') is-invalid   @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" id="password_confirmation">
                                                @error('new_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="d-flex justify-content-end mt-5">
                                                <button type="submit" class="btn btn-primary mb-2">{{__('backend.save')}}</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection


@section('js')
    @if(old('tab') != null)
        <script>
            @if(old('tab') == 'information')
            $(document).ready(function (){
                $('#home3-tab').addClass('active').attr('aria-selected',true);
                $('#home3').addClass('active show');
                $('#profile3-tab').removeClass('active').attr('aria-selected',false);
                $('#profile3').removeClass('active show');
            })
            @endif

            @if(old('tab') == 'security')
            $(document).ready(function (){
                $('#profile3-tab').addClass('active').attr('aria-selected',true);
                $('#profile3').addClass('active show');
                $('#home3-tab').removeClass('active').attr('aria-selected',false);
                $('#home3').removeClass('active show');
            })
            @endif
        </script>

    @endif
@endsection
