@extends('layouts.personal')

    @section('meta')
        <title>My Dashboard | Log Tracker</title>
        <meta name="description" content="Log Tracker my dashboard, view recent logs, view recent leave of absence, and view previous schedules">
    @endsection

    @section('content')
    
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <h2 class="page-title">{{ __("Dashboard") }}</h2>
            </div>    
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ui icon clock outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><span class="uppercase">{{ __("Logs (Current Month)") }}</span></span>
                        <div class="progress-group">
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width: 100%"></div>
                            </div>
                            <div class="stats_d">
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td>{{ __("Tardies") }}</td>
                                            <td><span class="bolder">@isset($la) {{ $la }} @endisset</span></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __("Early Leaves") }}</td>
                                            <td><span class="bolder">@isset($ed) {{ $ed }} @endisset</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

            <!--<div class="col-sm-12 col-md-6 col-lg-4">
                <div class="info-box">
                    <span class="info-box-icon bg-orange"><i class="ui icon home"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text uppercase">{{ __("Leaves") }}</span>
                        <div class="progress-group">
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-orange" style="width: 100%"></div>
                            </div>
                            <div class="stats_d">
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td>{{ __("Approved") }} </td>
                                            <td><span class="bolder">@isset($al){{ $al }}@endisset</span></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __("Pending") }} </td>
                                            <td><span class="bolder">@isset($pl){{ $pl }}@endisset</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>

        <div class="row">

            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __("Recent logs") }}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">{{ __("Date") }}</th>
                                <th class="text-left">{{ __("Time") }}</th>
                                <th class="text-left">{{ __("Description") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($a)
                            @foreach($a as $v)

                            @if($v->timein != '' && $v->timeout == '')
                            <tr>
                                <td>
                                    @php echo e(date('M d, Y', strtotime($v->date))); @endphp
                                </td>
                                <td>
                                    @php
                                        if($tf == 1) {
                                            echo e(date("h:i:s A", strtotime($v->timein)));
                                        } else {
                                            echo e(date("H:i:s", strtotime($v->timein)));
                                        }
                                    @endphp
                                </td>
                                <td>Time-In</td>
                            </tr>
                            @endif
                            
                            @if($v->timein != '' && $v->timeout != '')
                            <tr>
                                <td>
                                    @php echo e(date('M d, Y', strtotime($v->date))); @endphp
                                </td>
                                <td>
                                    @php
                                        if($tf == 1) {
                                            echo e(date("h:i:s A", strtotime($v->timeout)));
                                        } else {
                                            echo e(date("H:i:s", strtotime($v->timeout)));
                                        }
                                    @endphp
                                </td>
                                <td>Time-Out</td>
                            </tr>
                            @endif

                            @if($v->timein != '' && $v->timeout != '')
                            <tr>
                                <td>
                                    @php echo e(date('M d, Y', strtotime($v->date))); @endphp
                                </td>
                                <td>
                                    @php
                                        if($tf == 1) {
                                            echo e(date("h:i:s A", strtotime($v->timein)));
                                        } else {
                                            echo e(date("H:i:s", strtotime($v->timein)));
                                        }
                                    @endphp
                                </td>
                                <td>Time-In</td>
                            </tr>
                            @endif

                            @endforeach
                            @endisset
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
            
            <!--<div class="col-sm-12 col-md-6 col-lg-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __("Recent Leaves") }}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                    <table class="table table-striped nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">{{ __("Description") }}</th>
                                <th class="text-left">{{ __("Date") }}</th>
                            </tr>
                        </thead>
                            <tbody>
                                @isset($ald)
                                @foreach($ald as $l)
                                <tr>
                                    <td>{{ $l->type }}</td>
                                    <td>
                                        @php
                                            $fd = date('M', strtotime($l->leavefrom));
                                            $td = date('M', strtotime($l->leaveto));

                                            if($fd == $td){
                                                $var = date('M d', strtotime($l->leavefrom)) .' - '. date('d, Y', strtotime($l->leaveto));
                                            } else {
                                                $var = date('M d', strtotime($l->leavefrom)) .' - '. date('M d, Y', strtotime($l->leaveto));
                                            }
                                        @endphp
                                        {{ $var }}
                                    </td>
                                </tr>
                                @endforeach
                                @endisset
                            </tbody>
                    </table>
                    </div>
                </div>
            </div>-->

        </div>
    </div>

    @endsection
    