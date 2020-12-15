@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb" class="paths-nav">
        <ol class="breadcrumb breadcrumb-inverse">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}">{{__('backend.home')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('studies.index')}}">البعثات</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">اضافه بعثة جديده</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom justify-content-between" >
                    <h2>فتح بعثة جديده</h2>
                    <a href="{{route('mission.index')}}" class="btn btn-sm btn-primary"><i class="mdi mdi-refresh"></i> عرض البعثات </a>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('mission.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="country">{{__('backend.country')}}</label>
                                <select name="country" id="country"   class="form-control   @error('country') is-invalid  @enderror">
                                    <option disabled selected>{{__('backend.select')}}</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" @if(old('country') == $country->id) selected @endif>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="university">الجامعة المانحه</label>
                                <input type="text" name="university" value="{{old('university')}}" placeholder="ادخل اسم الجامعه" class="form-control @error('university') is-invalid @enderror" >

                                @error('university')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="studies">التخصص</label>
                                <select name="studies" id="studies"   class="form-control   @error('studies') is-invalid  @enderror">
                                    <option disabled selected>{{__('backend.select')}}</option>
                                    @foreach($studies as $study)
                                        <option value="{{$study->id}}" @if(old('studies') == $study->id) selected @endif>{{$study->alias}}</option>
                                    @endforeach
                                </select>
                                @error('studies')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="type">   عدد الفرص</label>
                                <input type="number" name="number" placeholder="عدد الفرص" value="{{old('number')}}" class="form-control @error('number') is-invalid @enderror" >
                                @error('number')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="type">   الدرجة العلمبة </label>
                                <input type="text" name="degree" value="{{old('degree')}}" placeholder="ادخل الدرجة العلمية" class="form-control @error('degree') is-invalid @enderror" >
                                @error('degree')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>


                            <div class="col-md-4 mb-3">
                                <label for="type"> اخر موعد للتقديم</label>
                                <input type="date" name="endDate" value="{{old('endDate')}}" class="form-control @error('endDate') is-invalid @enderror" >
                                @error('endDate')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="type" > اختر ملف الشروط</label>
                                <div class="custom-file mb-1 ">
                                    <input type="file" class=" @error('manual') is-invalid @enderror custom-file-input" name="manual" id="manual" >
                                    <label class="custom-file-label " for="manual">{{__('backend.choice_file')}}</label>
                                </div>
                                @error('manual')
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
