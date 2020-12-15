@extends('layouts.auth')

@section('form')

    <h4 class="text-dark mb-5 text-center">{{__('backend.sign_in')}}</h4>
    <form action="{{route('login')}}" method="post">
        @csrf
        @method('POST')
        <div class="row">
            <div class="form-group col-md-12 mb-4">
                <input type="email" required name="email" class="form-control @error('email') is-invalid @enderror  input-lg" value="{{ old('email') }}" id="email" aria-describedby="email" placeholder="{{__('backend.form_email')}}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-md-12 ">
                <input type="password" required  name="password" class="form-control @error('password') is-invalid @enderror input-lg" id="password" placeholder="{{__('backend.form_password')}}">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


            </div>
            <div class="col-md-12">
                <div class="d-flex my-2 justify-content-end">
                    @if (Route::has('password.request'))
                        <p><a class="text-blue" href="{{ route('password.request') }}">{{__('backend.forget_password')}}</a></p>
                    @endif
                    <div class="d-inline-block mr-3 ">
                        <label class="control control-checkbox">{{__('backend.remember_me')}}
                            <input type="checkbox" name="remember" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                            <div class="control-indicator"></div>
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">{{__('backend.sign_in')}}</button>
                <p>{{__('backend.do_not_you_have_an_account')}}
                    <a class="text-blue" href="{{route('register')}}">{{__('backend.sign_up')}}</a>
                </p>
            </div>

        </div>
    </form>

@endsection
