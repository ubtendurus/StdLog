@extends('layouts.default')

    @section('meta')
        <title>Students | Log Tracker</title>
        <meta name="description" content="Log Tracker students, view all students, add, edit, delete, and archive students.">
    @endsection

    @section('content')

    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title uppercase">{{ __('Students') }}
                <a class="ui positive button mini offsettop5 float-right" href="{{ url('students/new') }}"><i class="ui icon plus"></i>{{ __('Add') }}</a>
            </h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                <table width="100%" class="table table-striped table-hover" id="dataTables-example" data-order='[[ 0, "desc" ]]'>
                    <thead>
                        <tr>
                            <th>{{ __('ID') }}</th> 
                            <th>{{ __('Student') }}</th> 
                            <th>{{ __('School') }}</th>
                            <th>{{ __('Grade') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th class=""></th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($data)
                        @foreach ($data as $student)
                            <tr class="">
                            <td>{{ $student->idno }}</td>
                            <td>{{ $student->lastname }}, {{ $student->firstname }}</td>
                            <td>{{ $student->school }}</td>
                            <td>{{ $student->grade }}</td>
                            <td>@if($student->stdstatus == 'Active') Active @else Archived @endif</td>
                            <td class="align-right">
                            <a href="{{ url('/profile/view/'.$student->reference) }}" class="ui circular basic icon button tiny"><i class="file alternate outline icon"></i></a>
                            <a href="{{ url('/profile/edit/'.$student->reference) }}" class="ui circular basic icon button tiny"><i class="edit outline icon"></i></a>
                            <a href="{{ url('/profile/delete/'.$student->reference) }}" class="ui circular basic icon button tiny"><i class="trash alternate outline icon"></i></a>
                            <a href="{{ url('/profile/archive/'.$student->reference) }}" class="ui circular basic icon button tiny"><i class="archive icon"></i></a>
                            </td>
                            </tr>
                        @endforeach
                        @endisset
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        
    </div>

    @endsection

    @section('scripts')
    <script type="text/javascript">
    $('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,ordering: true});
    </script>
    @endsection