@extends('layouts.application')
@section('content')
    <div class="card-body">
        <span class="card-title ">
         <h5>البعثات الحالية</h5>
        </span>

        <div class="card-body">
            <table class="table table-hover" style="text-align: right">
                <thead>
                <tr>
                    <th scope="col"> الشروط </th>
                    <th scope="col">اخر موعد</th>
                    <th scope="col"> عدد  </th>
                    <th scope="col"> الدرجة العلمية</th>
                    <th scope="col"> التخصص</th>
                    <th scope="col"> الجامعة </th>
                    <th scope="col">الدولة </th>
                    <th scope="col">رقم </th>

                </tr>
                </thead>
                <tbody>

                @foreach($missions as $mission)
                    <tr>
                        <td><a href="{{asset($mission->manual)}}" target="_blank" class="btn btn-sm btn-success">عرض الشروط</a></td>
                        <td>{{$mission->endDate}}</td>
                        <td>{{$mission->vacanciesNumber}}</td>
                        <td>{{$mission->degree}}</td>
                        <td>{{$mission->study->alias}}</td>
                        <td>{{$mission->source}}</td>
                        <td>{{$mission->country->name}}</td>
                        <td>{{$mission->id}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
