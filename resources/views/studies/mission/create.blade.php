@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb" class="paths-nav">
        <ol class="breadcrumb breadcrumb-inverse">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}">{{__('backend.home')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('StudyMission.index')}}">البعثات</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">تسجيل بعثة</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom justify-content-between" >
                    <h2>تسجيل بعثة</h2>
                    <a href="{{route('StudyMission.index')}}" class="btn btn-sm btn-primary"><i class="mdi mdi-refresh"></i>البعثات</a>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('StudyMission.store')}}"  enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="studentName">الاسم </label>
                                <input type="text" name="studentName" id="studentName" placeholder="الاسم" value="{{old('studentName')}}"  class="form-control   @error('studentName') is-invalid  @enderror">
                                @error('studentName')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="studentEmail"> البريد الالكترونى</label>
                                <input type="email" name="studentEmail" id="studentEmail" value="{{old('studentEmail')}}" placeholder="الايميل"  class="form-control   @error('studentEmail') is-invalid  @enderror">
                                @error('studentEmail')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="studentPhone">الجوال </label>
                                <input type="text" name="studentPhone" id="studentPhone" value="{{old('studentPhone')}}" placeholder="الجوال"  class="form-control   @error('studentPhone') is-invalid  @enderror">
                                @error('studentPhone')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="studentCity">المدينة </label>
                                <input type="text" name="studentCity" id="studentCity" placeholder="المدينة" value="{{old('studentCity')}}"  class="form-control   @error('studentCity') is-invalid  @enderror">
                                @error('studentCity')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="mission">البعثات المتاحة</label>
                                <select name="mission" id="mission"   class="form-control   @error('mission') is-invalid  @enderror">
                                    <option disabled selected>{{__('backend.select')}}</option>
                                    @foreach($missions as $mission)
                                        <option value="{{$mission->id}}" @if(old('mission') == $mission->id) selected @endif>{{$mission->alias()}}</option>
                                    @endforeach
                                </select>
                                @error('mission')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="department">ثانوية عامة شعبة</label>
                                <select name="department" id="department"   class="form-control   @error('department') is-invalid  @enderror">
                                    <option disabled selected>{{__('backend.select')}}</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department}}" @if(old('department') == $department) selected @endif>
                                            {{$department}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="type">سنة التخرج</label>
                                <input type="date" name="graduation_date" value="{{old('graduation_date')}}" class="form-control @error('graduation_date') is-invalid @enderror" >
                                @error('graduation_date')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="id_card" >   بطاقة الهوية</label>
                                <div class="custom-file mb-1 ">
                                    <input type="file" class=" @error('id_card') is-invalid @enderror custom-file-input" name="id_card" id="manuid_cardal" >
                                    <label class="custom-file-label " for="id_card">{{__('backend.choice_file')}}</label>
                                </div>
                                @error('id_card')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="school_certificate" > شهادة الثانوية</label>
                                <div class="custom-file mb-1 ">
                                    <input type="file" class=" @error('school_certificate') is-invalid @enderror custom-file-input" name="school_certificate" id="school_certificate" >
                                    <label class="custom-file-label " for="school_certificate">{{__('backend.choice_file')}}</label>
                                </div>
                                @error('school_certificate')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="birthdate_certificate" >   شهادة الميلاد</label>
                                <div class="custom-file mb-1 ">
                                    <input type="file" class=" @error('birthdate_certificate') is-invalid @enderror custom-file-input" name="birthdate_certificate" id="birthdate_certificate" >
                                    <label class="custom-file-label " for="birthdate_certificate">{{__('backend.choice_file')}}</label>
                                </div>
                                @error('birthdate_certificate')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">{{__('backend.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
