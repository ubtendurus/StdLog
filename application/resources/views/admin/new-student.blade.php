@extends('layouts.default')

    @section('meta')
        <title>New Student | Log Tracker</title>
        <meta name="description" content="Log Tracker add new student, delete student, edit student">
    @endsection

    @section('styles')
        <link href="{{ asset('/assets/vendor/air-datepicker/dist/css/datepicker.min.css') }}" rel="stylesheet">
    @endsection

    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __('Student Profile') }}</h2>
            </div>    
        </div>

        <div class="row">
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
            <form id="add_student_form" action="{{ url('student/add') }}" class="ui form custom" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            @csrf
                <div class="col-md-6 float-left">
                    <div class="box box-success">
                        <div class="box-header with-border">{{ __('Personal Information') }}</div>
                        <div class="box-body">
                            <div class="two fields">
                                <div class="field">
                                    <label>{{ __('First Name') }}</label>
                                    <input type="text" class="uppercase" name="firstname" value="">
                                </div>
                                <div class="field">
                                    <label>{{ __('Middle Name') }}</label>
                                    <input type="text" class="uppercase" name="mi" value="">
                                </div>
                            </div>
                            <div class="field">
                                <label>{{ __('Last Name') }}</label>
                                <input type="text" class="uppercase" name="lastname" value="">
                            </div>
                            <div class="field">
                                <label>{{ __('Gender') }}</label>
                                <select name="gender" class="ui dropdown uppercase">
                                    <option value="">Select Gender</option>
                                    <option value="MALE">MALE</option>
                                    <option value="FEMALE">FEMALE</option>
                                </select>
                            </div>
                            
                            <div class="two fields">
                            <div class="field">
                                <label>{{ __('Email Address (Personal)') }}</label>
                                <input type="email" name="emailaddress" value="" class="lowercase">
                            </div>
                            <div class="field">
                                <label>{{ __('Contact Number') }}</label>
                                <input type="text" class="" name="mobileno" value="">
                            </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label>{{ __('Age') }}</label>
                                    <input type="number" name="age" value="" placeholder="00">
                                </div>
                                <div class="field">
                                    <label>{{ __('Date of Birth') }}</label>
                                    <input type="text" name="birthday" value="" class="airdatepicker" data-position="top right" placeholder="Date"> 
                                </div>
                            </div>
                            <div class="field">
                                <label>{{ __('ID') }}</label>
                                <input type="text" class="uppercase" name="nationalid" value="" placeholder="">
                            </div>
                            <div class="field">
                                <label>{{ __('Place of Birth') }}</label>
                                <input type="text" class="uppercase" name="birthplace" value="" placeholder="City, Province, Country">
                            </div>
                            <div class="field">
                                <label>{{ __('Home Address') }}</label>
                                <input type="text" class="uppercase" name="homeaddress" value="" placeholder="House/Unit Number, Building, Street, City, Province, Country">
                            </div>
                            <div class="field">
                                <label>{{ __('Upload Profile photo') }}</label>
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
                            <h4 class="ui dividing header">{{ __('Designation') }}</h4>
                            <div class="field">
                                <label>{{ __('School') }}</label>
                                <select name="school" class="ui search dropdown uppercase">
                                    <option value="">Select School</option>
                                    @isset($school)
                                        @foreach ($school as $data)
                                            <option value="{{ $data->school }}"> {{ $data->school }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div class="field">
                                <label>{{ __('Grade') }}</label>
                                <select name="grade" class="ui search dropdown uppercase grade">
                                    <option value="">Select Grade</option>
                                    @isset($grade)
                                        @foreach ($grade as $data)
                                            <option value="{{ $data->grade }}"> {{ $data->grade }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            
                            <div class="field">
                                <label>{{ __('School ID') }}</label>
                                <input type="text" class="uppercase" name="idno" value="">
                            </div>
                            <div class="field">
                                <label>{{ __('Email Address (school)') }}</label>
                                <input type="email" name="schoolemail" value="" class="lowercase">
                            </div>
                            
                            <h4 class="ui dividing header">{{ __('Enrollment Information') }}</h4>
                            <div class="field">
                                <label>{{ __('Student Type') }}</label>
                                <select name="stdtype" class="ui dropdown uppercase">
                                    <option value="">Select Type</option>
                                    <option value="Regular">Regular</option>
                                    <option value="504-IEP">504-IEP</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>{{ __('Enrollment Status') }}</label>
                                <select name="stdstatus" class="ui dropdown uppercase">
                                    <option value="">Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Archived">Archived</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>{{ __('Enrollment Date') }}</label>
                                <input type="text" name="startdate" value="" class="airdatepicker uppercase" data-position="top right" placeholder="Date">
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
                        <button type="submit" name="submit" class="ui green button small"><i class="ui checkmark icon"></i>{{ __('Save') }}</button>
                        <a href="{{ url('students') }}" class="ui grey button small"><i class="ui times icon"></i>{{ __('Cancel') }}</a>
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
    $('.airdatepicker').datepicker({ language: 'en', dateFormat: 'yyyy-mm-dd', autoClose: true });
    
    
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
    </script>
    @endsection