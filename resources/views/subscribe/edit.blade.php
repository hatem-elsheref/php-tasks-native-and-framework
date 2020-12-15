@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb" class="paths-nav">
        <ol class="breadcrumb breadcrumb-inverse">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}">{{__('backend.home')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('Subscribe.index')}}">{{__('backend.all_subscription')}}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{__('backend.create_subscription')}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom justify-content-between" >
                    <h2>{{__('backend.create_subscription')}}</h2>
                    <a href="{{route('Subscribe.index')}}" class="btn btn-sm btn-primary"><i class="mdi mdi-refresh"></i> {{__('backend.all_subscription')}}</a>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('Subscribe.update',$subscribe->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="service_name">{{__('backend.service_name')}}</label>
                                <input type="text" name="service_name" value="{{$subscribe->serviceName}}" class="form-control @error('service_name') is-invalid  @enderror" id="service_name" placeholder="{{__('backend.enter')}} {{__('backend.service_name')}}">
                                @error('service_name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="service_provider">{{__('backend.service_provider')}}</label>
                                <input type="text" class="form-control @error('service_provider') is-invalid  @enderror"  name="service_provider" value="{{$subscribe->serviceProvider}}"  id="service_provider" placeholder="{{__('backend.enter')}} {{__('backend.service_provider')}}">
                                @error('service_provider')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="service_type">{{__('backend.service_type')}}</label>
                                <select name="service_type" id="service_type"   class="form-control   @error('service_type') is-invalid  @enderror">
                                    <option disabled selected>{{__('backend.select_option')}}</option>
                                    @foreach($types as $type)
                                        <option value="{{$type['name']}}" @if($subscribe->serviceType == $type['name']) selected @endif>{{__($type['name'])}}</option>
                                    @endforeach
                                </select>
                                @error('service_type')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="service_capacity">{{__('backend.service_capacity')}}</label>
                                <input type="number" name="service_capacity" value="{{$subscribe->serviceCapacity}}" class="form-control @error('service_capacity') is-invalid  @enderror" id="service_capacity" placeholder="{{__('backend.enter')}} {{__('backend.service_capacity')}}">
                                @error('service_capacity')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="service_cost">{{__('backend.service_cost')}}</label>
                                <input type="number" name="service_cost"  value="{{$subscribe->serviceCost}}" class="form-control @error('service_cost') is-invalid  @enderror" id="service_cost" placeholder="{{__('backend.enter')}} {{__('backend.service_cost')}}" >
                                @error('service_cost')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="service_start">{{__('backend.service_start')}}</label>
                                <input type="text" name="service_start" data-mask="00/00/0000"  value="{{Carbon\Carbon::parse($subscribe->startDate)->format('d-m-Y')}}" placeholder="dd/mm/yyyy" aria-label="" autocomplete="off" maxlength="10" class="form-control @error('service_start') is-invalid  @enderror" id="service_name">
                                @error('service_start')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="service_end">{{__('backend.service_end')}}</label>

                                <input type="text" data-mask="00/00/0000" name="service_end"  value="{{Carbon\Carbon::parse($subscribe->endDate)->format('d-m-Y')}}" placeholder="dd/mm/yyyy" aria-label="" autocomplete="off" maxlength="10" class="form-control @error('service_end') is-invalid  @enderror" id="service_end">
                                @error('service_end')
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




