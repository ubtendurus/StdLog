@extends('layouts.default')

    @section('meta')
        <title>Profile | Log Tracker</title>
        <meta name="description" content="Log Tracker view student profile, edit student profile, update student profile">
    @endsection

    @section('content')
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __('Student Profile') }}
                    <a href="{{ url('students') }}" class="ui basic blue button mini offsettop5 float-right"><i class="ui icon chevron left"></i>{{ __('Return') }}</a>
                </h2>
            </div>    
        </div>

        <div class="row">
            <div class="col-md-4 float-left">
                <div class="box box-success">
                    <div class="box-body student-info">
                        <div class="author">
                        @if($i != null)
                            <img class="avatar border-white" src="{{ asset('/assets/faces/'.$i) }}" alt="profile photo"/>
                        @else
                            <img class="avatar border-white" src="{{ asset('/assets/images/faces/default_user.jpg') }}" alt="profile photo"/>
                        @endif
                        </div>
                        <p class="description text-center">
                            <h4 class="title">@isset($p->firstname) {{ $p->firstname }} @endisset @isset($p->lastname) {{ $p->lastname }} @endisset</h4>
                            <table style="width: 100%" class="profile-tbl">
                                <tbody>
                                    <tr>
                                        <td>{{ __('Email') }}</td>
                                        <td><span class="p_value">@isset($p->emailaddress) {{ $p->emailaddress }} @endisset</span></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Phone no.') }}</td>
                                        <td><span class="p_value">@isset($p->mobileno) {{ $p->mobileno }} @endisset</span></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('ID no.') }}</td>
                                        <td><span class="p_value">@isset($c->idno) {{ $c->idno }} @endisset</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-8 float-left">
                <div class="box box-success">
                    <div class="box-header with-border">{{ __('Personal Information') }}</div>
                    <div class="box-body student-info">
                            <table class="tablelist">
                                <tbody>
								<tr>
                                        <td><p>{{ __('Age') }}</p></td>
                                        <td><p>@isset($p->age) {{ $p->age }} @endisset</p></td>
                                    </tr>
                                    <!--<tr>
                                        <td><p>{{ __('Civil Status') }}</p></td>
                                        <td><p>@isset($p->civilstatus) {{ $p->civilstatus }} @endisset</p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('Height') }} <span class="help">(cm)</span></p></td>
                                        <td><p>@isset($p->height) {{ $p->height }} @endisset</p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('Weight') }} <span class="help">(pounds)</span></p></td>
                                        <td><p>@isset($p->weight) {{ $p->weight }} @endisset</p></td>
                                    </tr>-->
                                    <tr>
                                        <td><p>{{ __('Gender') }}</p></td>
                                        <td><p>@isset($p->gender) {{ $p->gender }} @endisset</p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('Date of Birth') }}</p></td>
                                        <td>
                                            <p>
                                                @isset($p->birthday) 
                                                    @php echo e(date("F d, Y", strtotime($p->birthday))) @endphp
                                                @endisset
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('Place of Birth') }}</p></td>
                                        <td><p>@isset($p->birthplace) {{ $p->birthplace }} @endisset</p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('Address') }}</p></td>
                                        <td><p>@isset($p->homeaddress) {{ $p->homeaddress }} @endisset</p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('ID') }}</p></td>
                                        <td><p>@isset($p->nationalid) {{ $p->nationalid }} @endisset</p></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h4 class="ui dividing header">{{ __('Designation') }}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('School') }}</td>
                                        <td>@isset($c->school) {{ $c->school }} @endisset</td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('Grade') }}</p></td>
                                        <td><p>@isset($c->grade) {{ $c->grade }} @endisset</p></td>
                                    </tr>
                                    <!--<tr>
                                        <td>{{ __('Position') }}</td>
                                        <td>@isset($c->jobposition) {{ $c->jobposition }} @endisset</td>
                                    </tr>-->
                                    <tr>
                                        <td>{{ __('Leave Privilege') }}</td>
                                        <td>
                                            @isset($leavetype)
                                                @isset($leavegroup) 
                                                    @isset($c->leaveprivilege)
                                                        @foreach($leavegroup as $lg)
                                                            @if($lg->id == $c->leaveprivilege)
                                                                @php
                                                                    $lp = explode(",", $lg->leaveprivileges);
                                                                @endphp
                                                                @foreach($lp as $rights) 
                                                                    @foreach($leavetype as $lt)
                                                                        @if($lt->id == $rights) {{ $lt->leavetype }}, @endif
                                                                    @endforeach
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endisset
                                                @endisset
                                            @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('Enrollment Type') }}</p></td>
                                        <td><p>@isset($p->stdtype) {{ $p->stdtype }} @endisset</p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('Employement Status') }}</p></td>
                                        <td><p>@isset($p->stdstatus) {{ $p->stdstatus }} @endisset</p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('Enrollment Date') }}</p></td>
                                        <td>
                                            <p>
                                            @isset($c->startdate) 
                                                @php echo e(date("F d, Y", strtotime($c->startdate))) @endphp
                                            @endisset
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('Date Regularized') }}</p></td>
                                        <td>
                                            <p>
                                            @isset($c->dateregularized) 
                                                @php echo e(date("F d, Y", strtotime($c->dateregularized))) @endphp
                                            @endisset
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
    





