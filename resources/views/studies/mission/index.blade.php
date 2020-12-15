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
            <li class="breadcrumb-item active" aria-current="page">عرض تفاصيل البعثة </li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom justify-content-between" >
                    <h2>التفاصيل</h2>
                </div>
                <div class="card-body">

                    @if($application)
                        <div class="form-row">

                            <div class="col-md-4 mb-3">
                                <label for="name">الاسم</label>
                                <input value="{{$application->studentName}}" class="form-control" disabled>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="email">البريد</label>
                                <input value="{{$application->studentEmail}}" class="form-control" disabled>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="phone">الجوال</label>
                                <input value="{{$application->studentPhone}}" class="form-control" disabled>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="city">المدينة</label>
                                <input value="{{$application->studentCity}}" class="form-control" disabled>
                            </div>


                            <div class="col-md-4 mb-3">
                                <label for="country">{{__('backend.country')}}</label>
                                <select  class="form-control" disabled>
                                    <option disabled selected>{{$application->mission->country->name}}</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="university">الجامعة</label>
                                <input value="{{$application->mission->source}}" class="form-control" disabled>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="studies">التخصص</label>
                                <select  class="form-control" disabled>
                                    <option disabled selected>{{$application->mission->study->alias}}</option>
                                </select>

                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="department">ثانوية عامة شعبة</label>
                                <select  id="department"   class="form-control" disabled>
                                    @foreach($departments as $department)
                                        @if($application->department == $department)
                                            <option disabled selected>{{$department}} </option>
                                            @break
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="type">سنة التخرج</label>
                                <input type="text" disabled  value="{{\Carbon\Carbon::createFromDate($application->graduation)->format('m/d/Y')}}" class="form-control" >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="type"> تاريخ الطلب</label>
                                <input type="text" disabled  value="{{$application->created_at->format('m/d/Y')}}" class="form-control" >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="type">  الدرجة العلمية</label>
                                <input type="text" disabled  value="{{$application->mission->degree}}" class="form-control" >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="type">  حالة الطلب</label>
                                @if($application->status == 'approved')
                                    <input type="text" disabled  value="تمت الموافقة" class="form-control bg-success ">
                                @elseif($application->status == 'pending')
                                    <input type="text" disabled  value=" تحت المراجعة" class="form-control bg-primary text-white">
                                @else
                                    <input type="text" disabled  value="  تم رفض طلبك " class="form-control bg-danger text-white">
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="studies">بطاقة الهوية</label>
                                @php $var=explode('.',$application->id_card) @endphp
                                @if(end($var) != 'pdf')
                                    <img  src="{{asset($application->id_card)}}" width="200px" height="300px">
                                @else
                                    <a href="{{asset($application->id_card)}}" target="_blank" class="btn btn-sm btn-warning">معاينة</a>
                                @endif

                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="studies"> شهادة الثانوية</label>
                                @php $var=explode('.',$application->school_certificate) @endphp
                                @if(end($var) != 'pdf')
                                    <img src="{{asset($application->school_certificate)}}" width="200px" height="300px">
                                @else
                                    <a href="{{asset($application->school_certificate)}}" target="_blank" class="btn btn-sm btn-warning">معاينة</a>
                                @endif

                            </div>
                            <div class="col-md-4 mb-3">

                                <label for="studies"> شهادة الميلاد</label>
                                @php $var=explode('.',$application->birthdate_certificate) @endphp
                                @if(end($var) != 'pdf')
                                    <img src="{{asset($application->birthdate_certificate)}}" width="200px" height="300px">
                                @else
                                    <a href="{{asset($application->birthdate_certificate)}}" target="_blank" class="btn btn-sm btn-warning">معاينة</a>
                                @endif
                            </div>

                        </div>

                    @else
                        لم يتم التسجيل فى بعثات من قبل
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
