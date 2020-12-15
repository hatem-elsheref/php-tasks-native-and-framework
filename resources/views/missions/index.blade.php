@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb" class="paths-nav">
        <ol class="breadcrumb breadcrumb-inverse">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}">{{__('backend.home')}}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">عرض لكل البعثات المتاحه</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom justify-content-between" >
                    <h2> البعثات المتاحه حاليا </h2>
                </div>
                <div class="card-body">
                    <table class="table table-hover ">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">الدولة </th>
                            <th scope="col"> لجامعة </th>
                            <th scope="col"> التخصص</th>
                            <th scope="col"> الدرجة العلمية</th>
                            <th scope="col"> عدد الفرص المتوفرة</th>
                            <th scope="col">اخر موعد</th>
                            <th scope="col"> الشروط </th>
                            <th scope="col">{{__('backend.control')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($missions as $mission)
                            <tr>
                                <td>{{$mission->id}}</td>
                                <td>{{$mission->country->name}}</td>
                                <td>{{$mission->source}}</td>
                                <td>{{$mission->study->alias}}</td>
                                <td>{{$mission->degree}}</td>
                                <td>{{$mission->vacanciesNumber}}</td>
                                <td>{{$mission->endDate}}</td>
                                <td><a href="{{asset($mission->manual)}}" target="_blank" class="btn btn-sm btn-success">عرض الشروط</a></td>
                                <td class="text-right">
                                    <a href="{{route('mission.edit',$mission->id)}}" class="btn btn-sm btn-success"><i class="mdi mdi-square-edit-outline"></i></a>
                                    <button class="btn btn-sm btn-danger" onclick="RemoveItem('item-{{$mission->id}}')"><i class="mdi mdi-trash-can"></i></button>
                                </td>
                                <form action="{{route('mission.destroy',$mission->id)}}" id="item-{{$mission->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
