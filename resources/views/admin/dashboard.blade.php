@extends('layouts.default')

    @section('meta')
        <title>Dashboard | Log Tracker</title>
        <meta name="description" content="Log Tracker dashboard, view recent attendance, recent leaves of absence, and newest students">
    @endsection

    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <h2 class="page-title">{{ __('Dashboard') }}</h2>
            </div>    
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ui icon user circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text uppercase">{{ __('Students') }}</span>
                        <div class="progress-group">
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 100%"></div>
                            </div>
                            <div class="stats_d">
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td>{{ __('Regular') }}</td>
                                            <td>@isset($emp_typeR) {{ $emp_typeR }} @endisset</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('504-IEP') }}</td>
                                            <td>@isset($emp_typeT) {{ $emp_typeT }} @endisset</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ui icon clock outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('Logs') }}</span>
                        <div class="progress-group">
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width: 100%"></div>
                            </div>
                            <div class="stats_d">
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td>{{ __('Online') }}</td>
                                            <td>@isset($is_online_now) {{ $is_online_now }} @endisset</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Offline') }}</td>
                                            <td>@isset($is_offline_now) {{ $is_offline_now }} @endisset</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('Newest Users') }}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                    <table class="table responsive nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">{{ __('Name') }}</th>
                                <th class="text-left">{{ __('Type') }}</th>
                                <th class="text-left">{{ __('Start Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($emp_all_type)
                                @foreach ($emp_all_type as $data)
                                <tr>
                                    <td class="text-left name-title">{{ $data->lastname }}, {{ $data->firstname }}</td>
                                    <td class="text-left">{{ $data->stdtype }}</td>
                                    <td class="text-left">@php echo e(date('M d, Y', strtotime($data->startdate))) @endphp</td>
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('Recent Logs') }}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table responsive nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">{{ __('Date') }}</th>
                                <th class="text-left">{{ __('Name') }}</th>
                                <th class="text-left">{{ __('Type') }}</th>
                                <th class="text-left">{{ __('Time') }}</th>
                                <th class="text-left">{{ __('Strike') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tbody>
                            
                            @isset($b)
                                @foreach($b as $v)
                                @if($v->timein != null && $v->timeout == null)
                                <tr>
                                    <td>{{ $v->date }}</td>
                                    <td class="name-title">{{ $v->student }}</td>
                                    <td>Check-In</td>
                                    <td>
                                        @php
                                            if($tf == 1) {
                                                echo e(date('h:i:s A', strtotime($v->timein))); 
                                            } else {
                                                echo e(date('H:i:s', strtotime($v->timein))); 
                                            }
                                        @endphp
                                    </td>
                                    <td>{{ $v->strike }}</td>
                                </tr>
                                @endif
                                
                                @if($v->timein != null && $v->timeout != null)
                                <tr>
                                    <td>{{ $v->date }}</td>
                                    <td class="name-title">{{ $v->student }}</td>
                                    <td>Check-Out</td>
                                    <td>
                                        @php
                                            if($tf == 1) {
                                                echo e(date('h:i:s A', strtotime($v->timeout))); 
                                            } else {
                                                echo e(date('H:i:s', strtotime($v->timeout))); 
                                            }
                                        @endphp
                                    </td>
                                    <td>{{ $v->strike }}</td>
                                </tr>
                                @endif
                                
                                <!-- CHECK IN -->
                                <!--@if($v->timein != null && $v->timeout != null)
                                <tr>
                                    <td class="name-title">{{ $v->student }}</td>
                                    <td>Check-In</td>
                                    <td>
                                        @php
                                            if($tf == 1) {
                                                echo e(date('h:i:s A', strtotime($v->timein))); 
                                            } else {
                                                echo e(date('H:i:s', strtotime($v->timein))); 
                                            }
                                        @endphp
                                    </td>
                                </tr>
                                @endif-->
                                @endforeach
                            @endisset
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
            
        </div>
    </div>

    @endsection
    
