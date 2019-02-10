@extends('layouts.master')

@section('content')

 <!-- Page Heading -->
 <h1 class="my-4">@lang('layout.title')
    <small>@lang('layout.subtitle')</small>
</h1>

<div class="row">

    @foreach($cities as $city)
    <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
            <img class="card-img-top" src={{$city->map()}} alt="">
            <div class="card-body">
                <div class="row"> <!-- header cityname score-->
                    <div class="col-6">
                        <h4 class="card-title">
                        {{$city->name}}
                        </h4>
                    </div>
                    <div class="col-6">
                        @if($city->lastPrevision()->score()>5)
                            <span class="badge badge-success"> @lang('prevision.reallynice') </span>
                        @elseif($city->lastPrevision()->score()>1)
                            <span class="badge badge-success"> @lang('prevision.nice') </span>
                        @elseif($city->lastPrevision()->score()>-1) 
                            <span class="badge badge-success"> @lang('prevision.notsonice') </span>
                        @elseif($city->lastPrevision()->score()>-4)
                            <span class="badge badge-danger"> @lang('prevision.sucks') </span>
                        @else
                            <span class="badge badge-danger"> @lang('prevision.stayhome') </span>
                        @endif
                    </div> 
                    <div class="col-12">
                        @if($city->id == $best->id)
                            <span class="badge badge-primary">@lang('layout.recomended')</span>
                        @endif
                    </div>
                </div> <!-- CLOSE header cityname score-->

                @foreach($city->lastPrevision()->weathers()->get() as $weather)
                    <div class="row section"> <!-- temp-->
                        <div class="col-12 weather_descr">
                            <h5>{{ucfirst ($weather->description)}}</h5> 
                        </div>
                    </div> <!-- CLOSE temp-->
                @endforeach

                <div class="row section"> <!-- temp-->
                    <div class="col-4 sub_title">
                        <h6>@lang('prevision.tempactual')</h6>
                        <b>{{$city->lastPrevision()->temp}}</b> @lang('prevision.centigrad')
                    </div>
                    <div class="col-4 sub_title">
                        <h6>@lang('prevision.tempmax')</h6>
                        <b>{{$city->lastPrevision()->temp_max}}</b> @lang('prevision.centigrad')
                    </div>
                    <div class="col-4 sub_title">
                        <h6>@lang('prevision.tempmin')</h6>
                        <b>{{$city->lastPrevision()->temp_min}}</b> @lang('prevision.centigrad')
                    </div>
                </div> <!-- CLOSE temp-->

                <div class="row section"> <!-- wind-->
                    <div class="col-4 sub_title" >
                        <h6>@lang('prevision.windspeed')</h6>
                        <b>{{$city->lastPrevision()->wind_speed}}</b> @lang('prevision.windspeedunits')
                    </div>
                    <div class="col-4 sub_title">
                        <h6>@lang('prevision.winddeg')</h6>
                        <b>{{$city->lastPrevision()->wind_deg}}</b> @lang('prevision.winddegunits')
                    </div>
                </div> <!-- CLOSE wind-->

                <div class="row section"> <!-- others-->
                    <div class="col-4 sub_title" >
                        <h6>@lang('prevision.pressure')</h6>
                        <b>{{$city->lastPrevision()->pressure}}</b> @lang('prevision.pressureunits')
                    </div>
                    <div class="col-4 sub_title">
                        <h6>@lang('prevision.humidity')</h6>
                        <b>{{$city->lastPrevision()->humidity}}</b> @lang('prevision.humidityunits')
                    </div>
                </div> <!-- CLOSE others-->
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection