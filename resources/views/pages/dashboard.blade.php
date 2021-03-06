@extends('layout.master')
@section('title','Dashboard')

@section('content')
    <div class="row col-md-12">
        <div class="x_panel">

            <div class="x_content">
                <div class="row">
                    <p class="text-center">Events from {{$min_date}} to {{$max_date}} </p><br/>

                </div>
                <div class="stepwizard">
                    <div class="stepwizard-row">
                        <div class="stepwizard-step">
                            <a href="{{url('/?timeline=today')}}" class="btn {{isset($selected) && $selected=='today'?'btn-success':'btn-default' }} btn-circle">1</a>
                            <p>Today</p>
                        </div>
                        <div class="stepwizard-step">
                            <a  href="{{url('/?timeline=yesterday')}}" class="btn {{isset($selected) && $selected=='yesterday'?'btn-success':'btn-default' }} btn-circle">2</a>
                            <p>Yesterday</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="{{url('/?timeline=thisweek')}}" class="btn {{isset($selected) && $selected=='thisweek'?'btn-success':'btn-default' }} btn-circle">3</a>
                            <p>This week</p>
                        </div>

                        <div class="stepwizard-step">
                            <a href="{{url('/?timeline=thismonth')}}" class="btn {{isset($selected) && $selected=='thismonth'?'btn-success':'btn-default' }} btn-circle" >4</a>
                            <p>This month</p>
                        </div>

                        <div class="stepwizard-step">
                            <a href="{{url('/?timeline=thisquarter')}}" class="btn {{isset($selected) && $selected=='thisquarter'?'btn-success':'btn-default' }} btn-circle" >5</a>
                            <p>This quarter</p>
                        </div>

                        <div class="stepwizard-step">
                            <a href="{{url('/?timeline=thisyear')}}" class="btn {{isset($selected) && $selected=='thisyear'?'btn-success':'btn-default' }} btn-circle">6</a>
                            <p>This year</p>
                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row top_tiles">
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-bug"></i></div>
                <div class="count text-danger">{{$high}}</div>
                <h3>Critical Events</h3>
                <p>Total number of critical events.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-bug"></i></div>
                <div class="count text-warning">{{$medium}}</div>
                <h3>Medium events</h3>
                <p>Total number of medium events.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-bug"></i></div>
                <div class="count text-info">{{$low}}</div>
                <h3>Low Events</h3>
                <p>Total number of low events.</p>
            </div>
        </div>
    </div>
    <div class="row">


        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Events per day within the date selected </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div id="dashboard_barchart" style="height:350px;"></div>

                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Events Severity</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div id="event_piechart" style="height:350px;"></div>

                </div>
            </div>
        </div>


        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Top Source Ip</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>

                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    @if($src_ip->count()>0)
                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>IP ADDRESS</th>
                                <th>EVENT COUNT</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($src_ip as $ip)
                                <tr>
                                    <th scope="row">
                                        <button class="btn btn-circle btn-default">{{$i++}}</button>
                                    </th>
                                    <td>{{$ip->src_ip}}</td>
                                    <td>{{$ip->count}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            <p>No records found</p>
                        </div>
                    @endif


                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Top Signature</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    @if($signature->count()>0)
                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>SIGNATURE</th>
                                <th>EVENT COUNT</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($signature as $row)
                                <tr>
                                    <th scope="row">
                                        <button class="btn btn-circle btn-default">{{$i++}}</button>
                                    </th>
                                    <td>{{$row->signature}}</td>
                                    <td>{{$row->count}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            <p>No records found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <input id="visur__current__selected__timeline"  type="hidden" value="{{\Illuminate\Support\Facades\Request::get('timeline')}}"/>
@endsection
@section('scripts')
    <script src="vendors/echarts/dist/echarts.js"></script>
    <script src="js/dashboard.js"></script>

@endsection
