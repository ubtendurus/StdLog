@extends('layouts.personal')

    @section('meta')
        <title>My Profile | Log Tracker</title>
        <meta name="description" content="Log Tracker my profile, view my profile, and update my personal information">
    @endsection

    @section('content')
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __("Profile") }}
                    <a href="{{ url('personal/profile/edit') }}" class="ui basic blue button mini offsettop5 float-right"><i class="ui icon edit"></i>{{ __("Edit") }}</a>
                </h2>
            </div>    
        </div>

        <div class="row">
            <div class="col-md-4 float-left">
                <div class="box box-success">
                    <div class="box-body student-info">
                            <div class="author">
                            @if($profile_photo != null)
                                <img class="avatar border-white" src="{{ asset('/assets/faces/'.$profile_photo) }}" alt="profile photo"/>
                            @else
                                <img class="avatar border-white" src="{{ asset('/assets/images/faces/default_user.jpg') }}" alt="profile photo"/>
                            @endif
                            </div>
                            <p class="description text-center">
                                <h4 class="title">@isset($profile->firstname) {{ $profile->firstname }} @endisset @isset($profile->lastname) {{ $profile->lastname }} @endisset</h4>
                                <table style="width: 100%" class="profile-tbl">
                                    <tbody>
                                        <tr>
                                            <td>{{ __("Email") }}</td>
                                            <td><span class="p_value">@isset($profile->emailaddress) {{ $profile->emailaddress }} @endisset</span></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __("Contact no.") }}</td>
                                            <td><span class="p_value">@isset($profile->mobileno) {{ $profile->mobileno }} @endisset</span></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __("ID no.") }}</td>
                                            <td><span class="p_value">@isset($school_data->idno) {{ $school_data->idno }} @endisset</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </p>
                    </div>
                </div>
            </div>

            <div class="col-md-8 float-left">
                <div class="box box-success">
                    <div class="box-header with-border">{{ __("Personal Information") }}</div>
                    <div class="box-body student-info">
                        <table class="tablelist">
                            <tbody>
                                <tr>
                                    <td><p>{{ __("Age") }}</p></td>
                                    <td><p>@isset($profile->age) {{ $profile->age }} @endisset</p></td>
                                </tr>
                                
                                <tr>
                                    <td><p>{{ __("Gender") }}</p></td>
                                    <td><p>@isset($profile->gender) {{ $profile->gender }} @endisset</p></td>
                                </tr>
                                <tr>
                                    <td><p>{{ __("Date of Birth") }}</p></td>
                                    <td><p>
                                        @isset($profile->birthday) 
                                            @php echo e(date("F d, Y", strtotime($profile->birthday))) @endphp
                                        @endisset
                                    </p></td>
                                </tr>
                                <tr>
                                    <td><p>{{ __("Place of Birth") }}</p></td>
                                    <td><p>@isset($profile->birthplace) {{ $profile->birthplace }} @endisset</p></td>
                                </tr>
                                <tr>
                                    <td><p>{{ __("Home Address") }}</p></td>
                                    <td><p>@isset($profile->homeaddress) {{ $profile->homeaddress }} @endisset</p></td>
                                </tr>
                                <tr>
                                    <td><p>{{ __("National ID") }}</p></td>
                                    <td><p>@isset($profile->nationalid) {{ $profile->nationalid }} @endisset</p></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h4 class="ui dividing header">{{ __("School Info") }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __("School") }}</td>
                                    <td>@isset($school_data->school) {{ $school_data->school }} @endisset</td>
                                </tr>
                                <tr>
                                    <td><p>{{ __("Grade") }}</p></td>
                                    <td><p>@isset($school_data->grade) {{ $school_data->grade }} @endisset</p></td>
                                </tr>
                                
                                
                                <tr>
                                    <td><p>{{ __("Enrollment Type") }}</p></td>
                                    <td><p>@isset($profile->stdtype) {{ $profile->stdtype }} @endisset</p></td>
                                </tr>
                                <tr>
                                    <td><p>{{ __("Enrollment Status") }}</p></td>
                                    <td><p>@isset($profile->stdstatus) {{ $profile->stdstatus }} @endisset</p></td>
                                </tr>
                                <tr>
                                    <td><p>{{ __("Enrollment Date") }}</p></td>
                                    <td><p>
                                        @isset($school_data->startdate) 
                                            @php echo e(date("F d, Y", strtotime($school_data->startdate))) @endphp
                                        @endisset
                                    </p></td>
                                </tr>
                                <
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection




