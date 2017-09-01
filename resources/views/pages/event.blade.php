@extends('layout.master')

@section('content')

    <!-- page content -->
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Events</h3>
                <div class="alert alert-info alert-dismissable">
                    {{$events->total()}} {{$severity}} events found
                </div>
            </div>

            <div class="title_right">
                <form class="" method="get">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <select name="severity" class="form-control">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                            <span class="input-group-btn">
                      <button class="btn btn-success" type="submit" style="color:#fff">Go!</button>
                    </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Events</h2>
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
                        @if($events->count()>0)
                            <table class="table table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Signature</th>
                                    <th>Source Ip Address</th>
                                    <th>Source Port</th>
                                    <th>Destination IP Address</th>
                                    <th>Destination Port</th>
                                    <th>Priority</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i =1;
                                @endphp
                                @foreach($events as $event)
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-default btn-circle">{{$i++}}</button>
                                        </th>
                                        <td>{{$event->signature}}</td>
                                        <td>{{$event->src_ip}}</td>
                                        <td>    {{$event->src_port}}</td>
                                        <td>{{$event->dst_ip}}</td>
                                        <td>{{$event->dst_port}}</td>
                                        <td>
                                            @if($event->priority==1)
                                                <span class="label label-danger">High</span>
                                                @elseif($event->priority==2)
                                                <span class="label label-warning">Medium</span>
                                            @elseif($event->priority==3)
                                                <span class="label label-info">Low</span>

                                            @endif
                                        </td>
                                        <td>{{$event->timestamp}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="row">
                                <div class="pagination">
                                    {{ $events->links() }}
                                </div>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


