@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb" class="paths-nav">
        <ol class="breadcrumb breadcrumb-inverse">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}">{{__('backend.home')}}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">ادارة الطلبات الخاصة بالبعثات</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom justify-content-between" >
                    <h2>  ادارة الطلبات</h2>
                </div>
                <div class="card-body">
                    <table class="table table-hover ">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">الصورة</th>
                            <th scope="col">الاسم </th>
                            <th scope="col">البريد </th>
                            <th scope="col"> الجوال</th>
                            <th scope="col"> المدينة</th>
                            <th scope="col"> الجامعة</th>
                            <th scope="col"> الشعبة</th>
                            <th scope="col"> طلب بعثة فى</th>
                            <th scope="col"> سنة التخرج</th>
                            <th scope="col"> تفاصيل اخرى</th>
                            <th scope="col">  حالة الطلب</th>
                            <th scope="col">{{__('backend.control')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($applications as $application)
                            <tr>
                                <td>{{$application->id}}</td>
                                <td><img src="{{uploads($application->user->avatar)}}" width="50px" height="50px" alt="{{$application->user->name}} avatar"></td>
                                <td>{{$application->studentName}}</td>
                                <td>{{$application->studentEmail}}</td>
                                <td>{{$application->studentPhone}}</td>
                                <td>{{$application->studentCity}}</td>
                                <td>{{$application->mission->source}}</td>
                                <td>{{$application->department}}</td>
                                <td>{{$application->mission->study->alias}}</td>
                                <td>{{$application->graduation}}</td>
                                <td><button class="btn btn-sm btn-info" data-toggle="modal" data-target="#mission-request-details-{{$application->id}}">تفصيلي</button></td>

                                <td>
                                    @if($application->status === 'pending')
                                        <span class="text-primary">تحت المراجعه</span>
                                    @elseif($application->status === 'canceled')
                                        <span class="text-danger">مرفوض</span>
                                    @else
                                        <span class="text-success">مقبول</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    @if($application->status === 'pending')
                                        <button class="btn btn-sm btn-danger" onclick="document.getElementById('item-{{$application->id}}-refuse').submit()">رفض الطلب</button>
                                        <button class="btn btn-sm btn-success" onclick="document.getElementById('item-{{$application->id}}-accept').submit()">قبول الطلب</button>

                                    @elseif($application->status === 'canceled')
                                        <button class="btn btn-sm btn-danger" onclick="RemoveItem('item-{{$application->id}}')">حذف</button>

                                    @else
                                        <button class="btn btn-sm btn-danger" onclick="RemoveItem('item-{{$application->id}}')">حذف</button>
                                    @endif
                                </td>

                                @if($application->status === 'pending')
                                    <form action="{{route('application.status.accept',[$application->id,'mission'])}}" id="item-{{$application->id}}-accept" method="POST">@csrf</form>
                                    <form action="{{route('application.status.refuse',[$application->id,'mission'])}}" id="item-{{$application->id}}-refuse" method="POST">@csrf</form>

                                @elseif($application->status === 'canceled')
                                    <form action="{{route('application.destroy',[$application->id,'mission'])}}" id="item-{{$application->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @else
                                    <form action="{{route('application.destroy',[$application->id,'mission'])}}" id="item-{{$application->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif


                                <div class="modal fade" id="mission-request-details-{{$application->id}}" tabindex="-1" role="dialog" aria-labelledby="mission-request-details-{{$application->id}}-label"  aria-modal="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="mission-request-details-{{$application->id}}-label">تفاصيل الملفات المرفقة</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @php $id_card=explode('.',$application->id_card) @endphp
                                                @if(end($id_card) != 'pdf')
                                                    <img src="{{asset($application->id_card)}}" width="100%" height="400px">
                                                @else
                                                    <a href="{{asset($application->id_card)}}" target="_blank" class="btn btn-sm btn-warning">معاينة بطاقة الهوية</a>
                                                    <br>
                                                @endif
                                                @php $school_certificate=explode('.',$application->school_certificate) @endphp
                                                @if(end($school_certificate) != 'pdf')
                                                    <img src="{{asset($application->school_certificate)}}" width="100%" height="400px">
                                                @else
                                                    <a href="{{asset($application->school_certificate)}}" target="_blank" class="btn btn-sm btn-warning">معاينة شهادة الثانوية</a>
                                                    <br>
                                                @endif
                                                @php $birthdate_certificate=explode('.',$application->birthdate_certificate) @endphp
                                                @if(end($birthdate_certificate) != 'pdf')
                                                    <img src="{{asset($application->birthdate_certificate)}}" width="100%" height="400px">
                                                @else
                                                    <a href="{{asset($application->birthdate_certificate)}}" target="_blank" class="btn btn-sm btn-warning">معاينة شهادة الميلاد</a>
                                                    <br>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
@endsection
