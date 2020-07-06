@extends('layouts.default')
    
    @section('meta')
        <title>Edit Student Profile | Log Tracker</title>
        <meta name="description" content="Log Tracker edit student profile.">
    @endsection 

    @section('styles')
        <link href="{{ asset('/assets/vendor/air-datepicker/dist/css/datepicker.min.css') }}" rel="stylesheet">
    @endsection

    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __('Edit Student Profile') }}
                    <a href="{{ url('students') }}" class="ui basic blue button mini offsettop5 float-right"><i class="ui icon chevron left"></i>{{ __('Return') }}</a>
                </h2>
            </div>    
        </div>

        <div class="col-md-12">
            @if ($errors->any())
            <div class="ui error message">
                <i class="close icon"></i>
                <div class="header">{{ __('There were some errors with your submission') }}</div>
                <ul class="list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <div class="row">
            <form id="edit_student_form" action="{{ url('profile/update') }}" class="ui form custom" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 float-left">
                    <div class="box box-success">
                        <div class="box-header with-border">{{ __('Personal Information') }}</div>
                        <div class="box-body">
                            <div class="two fields">
                                <div class="field">
                                    <label>{{ __('First Name') }}</label>
                                    <input type="text" class="uppercase" name="firstname" value="@isset($person_details->firstname){{ $person_details->firstname }}@endisset">
                                </div>
                                <div class="field">
                                    <label>{{ __('Middle Name') }}</label>
                                    <input type="text" class="uppercase" name="mi" value="@isset($person_details->mi){{ $person_details->mi }}@endisset">
                                </div>
                            </div>
                            <div class="field">
                                <label>{{ __('Last Name') }}</label>
                                <input type="text" class="uppercase" name="lastname" value="@isset($person_details->lastname){{ $person_details->lastname }}@endisset">
                            </div>
                            <div class="field">
                                <label>{{ __('Gender') }}</label>
                                <select name="gender" class="ui dropdown uppercase">
                                    <option value="">Select Gender</option>
                                    <option value="MALE" @isset($person_details->gender) @if($person_details->gender == 'MALE') selected @endif @endisset>MALE</option>
                                    <option value="FEMALE" @isset($person_details->gender) @if($person_details->gender == 'FEMALE') selected @endif @endisset>FEMALE</option>
                                </select>
                            </div>
                                                        <div class="two fields">
                            <div class="field">
                                <label>{{ __('Email Address (Personal)') }}</label>
                                <input type="email" name="emailaddress" value="@isset($person_details->emailaddress){{ $person_details->emailaddress }}@endisset" class="lowercase">
                            </div>
                            <div class="field">
                                <label>{{ __('Contact Number') }}</label>
                                <input type="text" class="uppercase" name="mobileno" value="@isset($person_details->mobileno){{ $person_details->mobileno }}@endisset">
                            </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label>{{ __('Age') }}</label>
                                    <input type="text" name="age" value="@isset($person_details->age){{ $person_details->age }}@endisset" placeholder="00">
                                </div>
                                <div class="field">
                                    <label>{{ __('Date of Birth') }}</label>
                                    <input type="text" name="birthday" value="@isset($person_details->birthday){{ $person_details->birthday }}@endisset" class="airdatepicker" placeholder="Date">
                                </div>
                            </div>
                            <div class="field">
                                <label>{{ __('National ID') }}</label>
                                <input type="text" class="uppercase" name="nationalid" value="@isset($person_details->nationalid){{ $person_details->nationalid }}@endisset" placeholder="">
                            </div>
                            <div class="field">
                                <label>{{ __('Place of Birth') }}</label>
                                <input type="text" class="uppercase" name="birthplace" value="@isset($person_details->birthplace){{ $person_details->birthplace }}@endisset" placeholder="City, Province, Country">
                            </div>
                            <div class="field">
                                <label>{{ __('Home Address') }}</label>
                                <input type="text" class="uppercase" name="homeaddress" value="@isset($person_details->homeaddress){{ $person_details->homeaddress }}@endisset" placeholder="House/Unit Number, Building, Street, City, Province, Country">
                            </div>
                            <div class="field">
                                <label>{{ __('Upload photo') }}</label>
                                <input class="ui file upload" value="" id="imagefile" name="image" type="file" accept="image/png, image/jpeg, image/jpg" onchange="validateFile()">
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 float-left">
                    <div class="box box-success">
                        <div class="box-header with-border">{{ __('Student Details') }}</div>
                        <div class="box-body">
                            <h4 class="ui dividing header">{{ __('School Info') }}</h4>
                            <div class="field">
                                <label>{{ __('School') }}</label>
                                <select name="school" class="ui search dropdown uppercase">
                                    <option value="">Select school</option>
                                    @isset($school)
                                        @foreach ($school as $data)
                                            <option value="{{ $data->school }}" @if($data->school == $school_details->school) selected @endif> {{ $data->school }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div class="field">
                                <label>{{ __('Grade') }}</label>
                                <select name="grade" class="ui search dropdown uppercase grade">
                                    <option value="">Select grade</option>
                                    @isset($grade)
                                        @foreach ($grade as $data)
                                            <option value="{{ $data->grade }}" @if($data->grade == $school_details->grade) selected @endif> {{ $data->grade }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            
                            <div class="field">
                                <label>{{ __('ID Number') }}</label>
                                <input type="text" class="uppercase" name="idno" value="@isset($school_details->idno){{ $school_details->idno }}@endisset">
                            </div>
                            <div class="field">
                                <label>{{ __('Email Address (school)') }}</label>
                                <input type="email" name="schoolemail" value="@isset($school_details->schoolemail){{ $school_details->schoolemail }}@endisset" class="lowercase">
                            </div>
                            
                            <h4 class="ui dividing header">{{ __('Enrollment Information') }}</h4>
                            <div class="field">
                                <label>{{ __('Enrollment Type') }}</label>
                                <select name="stdtype" class="ui dropdown uppercase">
                                    <option value="">Select Type</option>
                                    <option value="Regular" @isset($person_details->stdtype) @if($person_details->stdtype == 'Regular') selected @endif @endisset>Regular</option>
                                    <option value="504-IEP" @isset($person_details->stdtype) @if($person_details->stdtype == '504-IEP') selected @endif @endisset>504-IEP</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>{{ __('Enrollment Status') }}</label>
                                <select name="stdstatus" class="ui dropdown uppercase">
                                    <option value="">Select Status</option>
                                    <option value="Active" @isset($person_details->stdstatus) @if($person_details->stdstatus == 'Active') selected @endif @endisset>Active</option>
                                    <option value="Archived" @isset($person_details->stdstatus) @if($person_details->stdstatus == 'Archived') selected @endif @endisset>Archived</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>{{ __('Enrollment Date') }}</label>
                                <input type="text" name="startdate" value="@isset($school_details->startdate){{ $school_details->startdate }}@endisset" class="airdatepicker" placeholder="Date">
                            </div>
                                                        <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 float-left">
                    <div class="ui error message">
                        <i class="close icon"></i>
                        <div class="header"></div>
                        <ul class="list">
                            <li class=""></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 float-left">
                    <div class="action align-right">
                        <input type="hidden" name="id" value="@isset($e_id){{ $e_id }}@endisset">
                        <button type="submit" name="submit" class="ui green button small"><i class="ui checkmark icon"></i> {{ __('Update') }}</button>
                        <a href="{{ url('students') }}" class="ui grey button small"><i class="ui times icon"></i> {{ __('Cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @endsection

    @section('scripts')
    <script src="{{ asset('/assets/vendor/air-datepicker/dist/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/air-datepicker/dist/js/i18n/datepicker.en.js') }}"></script>
    
    <script type="text/javascript">
        $('.airdatepicker').datepicker({ language: 'en', dateFormat: 'yyyy-mm-dd' });
        $('.ui.dropdown.grade').dropdown({ onChange: function(value, text, $selectedItem) {
            $('.jobposition .menu .item').addClass('hide');
            $('.jobposition .text').text('');
            $('input[name="jobposition"]').val('');
            $('.jobposition .menu .item').each(function() {
                var dept = $(this).attr('data-dept');
                if(dept == value) {$(this).removeClass('hide');};
            });
        }});

        function validateFile() {
            var f = document.getElementById("imagefile").value;
            var d = f.lastIndexOf(".") + 1;
            var ext = f.substr(d, f.length).toLowerCase();
            if (ext == "jpg" || ext == "jpeg" || ext == "png") { } else {
                document.getElementById("imagefile").value="";
                $.notify({
                icon: 'ui icon times',
                message: "Please upload only jpg/jpeg and png image formats."},
                {type: 'danger',timer: 400});
            }
        }

        var selected = "@isset($school_details->leaveprivilege){{ $school_details->leaveprivilege }}@endisset";
        var items = selected.split(',');
        $('.ui.dropdown.multiple.leaves').dropdown('set selected', items);
    </script>
    @endsection