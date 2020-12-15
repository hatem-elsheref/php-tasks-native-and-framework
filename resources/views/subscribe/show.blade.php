@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb" class="paths-nav">
        <ol class="breadcrumb breadcrumb-inverse">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}">{{__('backend.home')}}</a>
            </li>

            <li class="breadcrumb-item active" aria-current="page">{{__('backend.all_subscription')}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom justify-content-between" >
                    <h2>{{__('backend.ended_subscriptions_table')}} ({{count($all_subscriptions)}})</h2>
                    <a href="{{route('Subscribe.create')}}" class="btn btn-sm btn-primary"><i class="mdi mdi-plus"></i> {{__('backend.create_subscription')}}</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover ">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('backend.status')}}</th>
                            <th scope="col">{{__('backend.service_name')}}</th>
                            <th scope="col">{{__('backend.service_provider')}}</th>
                            <th scope="col">{{__('backend.service_type')}}</th>
                            <th scope="col">{{__('backend.service_capacity')}}</th>
                            <th scope="col">{{__('backend.service_cost')}}</th>
                            <th scope="col">{{__('backend.service_start')}}</th>
                            <th scope="col">{{__('backend.service_end')}}</th>
                            <th scope="col">{{__('backend.service_ended_from')}}</th>
                            <th scope="col">{{__('backend.control')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all_subscriptions as $subscribe)
                            <tr>
                                <td scope="row">{{$subscribe->id}}</td>
                                <td>
                                    <i class="{{$subscribe->status?'text-success':'text-danger'}} mdi mdi-circle"></i>
                                </td>
                                <td>{{$subscribe->serviceName}}</td>
                                <td>{{$subscribe->serviceProvider}}</td>
                                <td>{{__($subscribe->serviceType)}}</td>
                                <td>{{$subscribe->serviceCapacity}}</td>
                                <td>{{$subscribe->serviceCost}}</td>
                                <td>{{$subscribe->startDate}}</td>
                                <td>{{$subscribe->endDate}}</td>
                                <td>{{$subscribe->days}}</td>
                                <td class="text-right">

                                    <button class="btn btn-sm btn-danger" onclick="RemoveItem('item-{{$subscribe->id}}')"><i class="mdi mdi-trash-can"></i></button>
                                    <a  href="{{route('Subscribe.edit',$subscribe->id)}}" class="btn btn-sm btn-success"><i class="mdi mdi-playlist-edit text-white"></i></a>

                                </td>
                                <form action="{{route('Subscribe.destroy',$subscribe->id)}}" id="item-{{$subscribe->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $all_subscriptions->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection



