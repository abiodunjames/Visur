@extends('layout.master')

@section('styles')


@endsection

@section('content')

    <!-- page content -->
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Events</h3>
            </div>

        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                <p class="text-muted font-13 m-b-30">
                <div class="radio">
                    <div class="radio">
                            <div class="alert alert-defualt">
                            <h3>{{$events->total()}} Event(s)</h3>
                            </div>
                            @foreach($filters as $filter)
                               Filtered By : <button>{{$filter}}</button> <br/>
                                @endforeach
                    </div>
                </div>
                {{$events->total()}}
                </p>
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th></th>
                        <th>CID</th>
                        <th>SIGNATURE</th>
                        <th>SOURCE IP</th>
                        <th>DESTINATION IP</th>
                        <th>SOURCE PORT</th>
                        <th>DESTINATION PORT</th>
                        <th>EVENT DATE</th>
                        <th>SEVERITY</th>
                    </tr>
                    </thead>


                    <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach($events as $event)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$event->cid}}</td>
                            <td>{{$event->signature}}</td>
                            <td><a href="{{url('event/filter?signature='.$event->src_ip)}}">{{$event->src_ip}}</a></td>
                            <td><a href="{{url('event/filter?signature='.$event->dst_ip)}}">{{$event->dst_ip}}</a></td>
                            <td><a href="{{url('event/filter?signature='.$event->src_port)}}">{{$event->src_port}}</a></td>
                            <td><a href="{{url('event/filter?signature='.$event->dst_port)}}">{{$event->dst_port}}</a></td>
                            <td>{{$event->timestamp}}</td>
                            <td>
                                @if($event->priority==1)
                                    <span class="label label-danger">High</span>
                                @elseif($event->priority==2)
                                    <span class="label label-warning">Medium</span>
                                @elseif($event->priority==3)
                                    <span class="label label-info">Low</span>

                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="row">
                    <div class="pagination">
                        {{ $events->links() }}
                    </div>
                </div>
            </div>

@endsection


@section('scripts')

@endsection
