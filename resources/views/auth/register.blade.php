@extends('layouts.auth')

@section('form')
    <h4 class="text-dark mb-5 text-center">{{__('backend.sign_up')}}</h4>
    <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row">
            <div class="form-group col-md-12 mb-4">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror input-lg" value="{{ old('name') }}" id="name" aria-describedby="name" placeholder="{{__('backend.form_name')}}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-12 mb-4">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{__('backend.form_email')}}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-md-12 mb-4">
                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror input-lg" value="{{ old('phone') }}" id="phone" aria-describedby="phone" placeholder="{{__('backend.form_phone')}}">
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-12 mb-4">
                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror input-lg" value="{{ old('city') }}" id="city" aria-describedby="city" placeholder="{{__('backend.form_city')}}">
                @error('city')
                <span class="text-danger">* {{ $message }}</span>
                @enderror
            </div>

{{--            <div class="form-group col-md-12 mb-4">--}}
{{--                <select name="country_id" class="form-control @error('country_id') is-invalid @enderror"  id="country">--}}
{{--                    <option disabled selected>{{__('backend.select_option')}}</option>--}}
{{--                    @foreach($countries as $country)--}}
{{--                        <option value="{{$country->id}}" {{old('country_id') == $country->id ?'selected':''}}>{{$country->name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}

{{--                @error('country_id')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                    <strong>{{ $message }}</strong>--}}
{{--                </span>--}}
{{--                @enderror--}}
{{--            </div>--}}



            <div class="form-group col-md-12 ">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{__('backend.form_password')}}">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-12 ">
                <input type="password" name="password_confirmation" class="form-control input-lg" id="password_confirmation" placeholder="{{__('backend.form_password_confirmation')}}">
            </div>
{{--            <div class="form-group col-md-12">--}}
{{--                <div class="custom-file mb-1">--}}
{{--                    <input type="file" class="custom-file-input" name="avatar" id="coverImage" >--}}
{{--                    <label class="custom-file-label" for="coverImage">{{__('backend.choice_file')}}</label>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @error('avatar')--}}
{{--            <span>--}}
{{--                    <strong>{{ $message }}</strong>--}}
{{--                </span>--}}
{{--            @enderror--}}

            <div class="col-md-12">
                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">{{__('backend.sign_in')}}</button>
                <p>{{__('backend.do_you_have_an_account')}}
                    <a class="text-blue" href="{{route('login')}}">{{__('backend.sign_in')}}</a>
                </p>
            </div>

        </div>
    </form>


@endsection


