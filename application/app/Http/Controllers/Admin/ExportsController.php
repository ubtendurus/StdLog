<?php

namespace App\Http\Controllers\admin;
use DB;
use App\Classes\table;
use App\Classes\permission;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class ExportsController extends Controller
{
		
	function school(Request $request) 
	{
		if (permission::permitted('school')=='fail'){ return redirect()->route('denied'); }

		$date = date('Y-m-d');
        $time = date('h-i-sa');
		$file = 'companies-'.$date.'T'.$time.'.csv';

		$c = table::school()->get();

		Storage::put($file, '', 'private');

		foreach ($c as $d) 
		{
		    Storage::prepend($file, $d->id .','. $d->school);
		}

		Storage::prepend($file, '"ID"' .','. 'school');

		return Storage::download($file);
    }

	function grade(Request $request) 
	{
		if (permission::permitted('grades')=='fail'){ return redirect()->route('denied'); }

		$d = table::grade()->get();

		$date = date('Y-m-d');
        $time = date('h-i-sa');
		$file = 'grades-'.$date.'T'.$time.'.csv';

		Storage::put($file, '', 'private');

		foreach ($d as $i) 
		{
		    Storage::prepend($file, $i->id .','. $i->grade);
		}

		Storage::prepend($file, '"ID"' .','. 'grade');

		return Storage::download($file);
    }

	function jobtitle(Request $request) 
	{
		if (permission::permitted('jobtitles')=='fail'){ return redirect()->route('denied'); }

		$j = table::jobtitle()->get();

		$date = date('Y-m-d');
        $time = date('h-i-sa');
		$file = 'jobtitles-'.$date.'T'.$time.'.csv';

		Storage::put($file, '', 'private');

		foreach ($j as $d) 
		{
		    Storage::prepend($file, $d->id .','. $d->jobtitle .','. $d->dept_code);
		}

		Storage::prepend($file, '"ID"' .','. 'grade' .','. 'grade CODE');

		return Storage::download($file);
    }

	function leavetypes(Request $request) 
	{
		if (permission::permitted('leavetypes')=='fail'){ return redirect()->route('denied'); }
		
		$l = table::leavetypes()->get();

		$date = date('Y-m-d');
        $time = date('h-i-sa');
		$file = 'leavetypes-'.$date.'T'.$time.'.csv';

		Storage::put($file, '', 'private');

		foreach ($l as $d) 
		{
		    Storage::prepend($file, $d->id .','. $d->leavetype .','. $d->limit .','. $d->percalendar);
		}

		Storage::prepend($file, '"ID"' .','. 'LEAVE TYPE' .','. 'LIMIT' .','. 'TYPE');

		return Storage::download($file);
    }

	function studentList() 
	{
		if (permission::permitted('reports')=='fail'){ return redirect()->route('denied'); }

		$p = table::people()->get();

		$date = date('Y-m-d');
        $time = date('h-i-sa');
		$file = 'student-lists-'.$date.'T'.$time.'.csv';

		Storage::put($file, '', 'private');

		foreach ($p as $d) 
		{
		    Storage::prepend($file, $d->id .','. $d->lastname.' '.$d->firstname.' '.$d->mi .','. $d->age .','. $d->gender .','. $d->civilstatus .','. $d->mobileno .','. $d->emailaddress .','. $d->stdtype .','. $d->stdstatus);
		}

		Storage::prepend($file, '"ID"' .','. 'student' .','. 'AGE' .','. 'GENDER' .','. 'CIVILSTATUS' .','. 'MOBILE NUMBER' .','. 'EMAIL ADDRESS' .','. 'std TYPE' .','. 'std STATUS');

		return Storage::download($file);
	}

	function attendanceReport(Request $request) 
	{
		if (permission::permitted('reports')=='fail'){ return redirect()->route('denied'); }
		$id = $request->emp_id;
		$datefrom = $request->datefrom;
		$dateto = $request->dateto;

		if ($id == null AND $datefrom == null AND $dateto == null) 
		{
			$data = table::attendance()->get();
			$date = date('Y-m-d');
			$time = date('h-i-sa');
			$file = 'attendance-reports-'.$date.'T'.$time.'.csv';

			Storage::put($file, '', 'private');

			foreach ($data as $d) 
			{
				Storage::prepend($file, $d->id .','. $d->idno .','. $d->date .','. '"'.$d->student.'"' .','. $d->timein .','. $d->timeout .','. $d->totalhours .','. $d->status_timein .','. $d->status_timeout);
			}

			Storage::prepend($file, '"ID"' .','. 'IDNO' .','. 'DATE' .','. 'student' .','. 'TIME IN' .','. 'TIME OUT' .','. 'TOTAL HOURS' .','. 'STATUS-IN' .','. 'STATUS-OUT');
			
			return Storage::download($file);
		}

		if ($id !== null AND $datefrom !== null AND $dateto !== null) 
		{
			$data = table::attendance()->where('idno', $id)->whereBetween('date', [$datefrom, $dateto])->get();
			$date = date('Y-m-d');
			$time = date('h-i-sa');
			$file = 'attendance-reports-'.$date.'T'.$time.'.csv';

			Storage::put($file, '', 'private');

			foreach ($data as $d) 
			{
				Storage::prepend($file, $d->id .','. $d->idno .','. $d->date .','. '"'.$d->student.'"' .','. $d->timein .','. $d->timeout .','. $d->totalhours .','. $d->status_timein .','. $d->status_timeout);
			}

			Storage::prepend($file, '"ID"' .','. 'IDNO' .','. 'DATE' .','. 'student' .','. 'TIME IN' .','. 'TIME OUT' .','. 'TOTAL HOURS' .','. 'STATUS-IN' .','. 'STATUS-OUT');
			
			return Storage::download($file);
		}

		if($id !== null AND $datefrom == null AND $dateto == null ) 
		{
			$data = table::attendance()->where('idno', $id)->get();
			$date = date('Y-m-d');
			$time = date('h-i-sa');
			$file = 'attendance-reports-'.$date.'T'.$time.'.csv';

			Storage::put($file, '', 'private');

			foreach ($data as $d) 
			{
				Storage::prepend($file, $d->id .','. $d->idno .','. $d->date .','. '"'.$d->student.'"' .','. $d->timein .','. $d->timeout .','. $d->totalhours .','. $d->status_timein .','. $d->status_timeout);
			}

			Storage::prepend($file, '"ID"' .','. 'IDNO' .','. 'DATE' .','. 'student' .','. 'TIME IN' .','. 'TIME OUT' .','. 'TOTAL HOURS' .','. 'STATUS-IN' .','. 'STATUS-OUT');
			
			return Storage::download($file);
		} 

		if ($id == null AND $datefrom !== null AND $dateto !== null) 
		{
			$data = table::attendance()->whereBetween('date', [$datefrom, $dateto])->get();
			$date = date('Y-m-d');
			$time = date('h-i-sa');
			$file = 'attendance-reports-'.$date.'T'.$time.'.csv';

			Storage::put($file, '', 'private');

			foreach ($data as $d) 
			{
				Storage::prepend($file, $d->id .','. $d->idno .','. $d->date .','. '"'.$d->student.'"' .','. $d->timein .','. $d->timeout .','. $d->totalhours .','. $d->status_timein .','. $d->status_timeout);
			}

			Storage::prepend($file, '"ID"' .','. 'IDNO' .','. 'DATE' .','. 'student' .','. 'TIME IN' .','. 'TIME OUT' .','. 'TOTAL HOURS' .','. 'STATUS-IN' .','. 'STATUS-OUT');
			
			return Storage::download($file);
		}

		return redirect('reports/student-attendance')->with('error',  trans("Whoops! Please provide date range or select student."));
	}

	function leavesReport(Request $request) 
	{
		if (permission::permitted('reports')=='fail'){ return redirect()->route('denied'); }
		$id = $request->emp_id;
		$datefrom = $request->datefrom;
		$dateto = $request->dateto;

		if ($id == null AND $datefrom == null AND $dateto == null) 
		{
			$data = table::leaves()->get();
			$date = date('Y-m-d');
			$time = date('h-i-sa');
			$file = 'leave-reports-'.$date.'T'.$time.'.csv';

			Storage::put($file, '', 'private');

			foreach ($data as $d) 
			{
				Storage::prepend($file, $d->id .','. $d->idno .','. '"'.$d->student.'"' .','. $d->type .','. $d->leavefrom .','. $d->leaveto .','. $d->reason .','. $d->status);
			}

			Storage::prepend($file, '"ID"' .','. 'IDNO' .','. 'student' .','. 'TYPE' .','. 'LEAVE FROM' .','. 'LEAVE TO' .','. 'REASON' .','. 'STATUS');
			
			return Storage::download($file);
		}

		if ($id !== null AND $datefrom !== null AND $dateto !== null) 
		{
			$data = table::leaves()->where('idno', $id)->whereBetween('leavefrom', [$datefrom, $dateto])->get();
			$date = date('Y-m-d');
			$time = date('h-i-sa');
			$file = 'leave-reports-'.$date.'T'.$time.'.csv';

			Storage::put($file, '', 'private');

			foreach ($data as $d) 
			{
				Storage::prepend($file, $d->id .','. $d->idno .','. '"'.$d->student.'"' .','. $d->type .','. $d->leavefrom .','. $d->leaveto .','. $d->reason .','. $d->status);
			}

			Storage::prepend($file, '"ID"' .','. 'IDNO' .','. 'student' .','. 'TYPE' .','. 'LEAVE FROM' .','. 'LEAVE TO' .','. 'REASON' .','. 'STATUS');
			
			return Storage::download($file);
		}

		if($id !== null AND $datefrom == null AND $dateto == null ) 
		{
			$data = table::leaves()->where('idno', $id)->get();
			$date = date('Y-m-d');
			$time = date('h-i-sa');
			$file = 'leave-reports-'.$date.'T'.$time.'.csv';

			Storage::put($file, '', 'private');

			foreach ($data as $d) 
			{
				Storage::prepend($file, $d->id .','. $d->idno .','. '"'.$d->student.'"' .','. $d->type .','. $d->leavefrom .','. $d->leaveto .','. $d->reason .','. $d->status);
			}

			Storage::prepend($file, '"ID"' .','. 'IDNO' .','. 'student' .','. 'TYPE' .','. 'LEAVE FROM' .','. 'LEAVE TO' .','. 'REASON' .','. 'STATUS');
			
			return Storage::download($file);
		} 

		if ($id == null AND $datefrom !== null AND $dateto !== null) 
		{
			$data = table::leaves()->whereBetween('leavefrom', [$datefrom, $dateto])->get();
			$date = date('Y-m-d');
			$time = date('h-i-sa');
			$file = 'leave-reports-'.$date.'T'.$time.'.csv';

			Storage::put($file, '', 'private');

			foreach ($data as $d) 
			{
				Storage::prepend($file, $d->id .','. $d->idno .','. '"'.$d->student.'"' .','. $d->type .','. $d->leavefrom .','. $d->leaveto .','. $d->reason .','. $d->status);
			}

			Storage::prepend($file, '"ID"' .','. 'IDNO' .','. 'student' .','. 'TYPE' .','. 'LEAVE FROM' .','. 'LEAVE TO' .','. 'REASON' .','. 'STATUS');
			
			return Storage::download($file);
		}

		return redirect('reports/student-leaves')->with('error', trans("Whoops! Please provide date range or select student."));
	}

	function birthdaysReport() 
	{
		if (permission::permitted('reports')=='fail'){ return redirect()->route('denied'); }
		$c = table::people()->join('tbl_school_data', 'tbl_people.id', '=', 'tbl_school_data.reference')->get();

		$date = date('Y-m-d');
		$time = date('h-i-sa');
		$file = 'student-birthdays-'.$date.'T'.$time.'.csv';

		Storage::put($file, '', 'private');

		foreach ($c as $d) 
		{
		    Storage::prepend($file, $d->idno .','. $d->lastname.' '.$d->firstname.' '.$d->mi .','. $d->grade .','. $d->jobposition .','. $d->birthday .','. $d->mobileno);
		}

		Storage::prepend($file, '"ID"' .','. 'student NAME' .','. 'grade' .','. 'POSITION' .','. 'BIRTHDAY' .','. 'MOBILE NUMBER' );

		return Storage::download($file);
	}

	function accountReport() 
	{
		if (permission::permitted('reports')=='fail'){ return redirect()->route('denied'); }
		$u = table::users()->get();

		$date = date('Y-m-d');
		$time = date('h-i-sa');
		$file = 'student-accounts-'.$date.'T'.$time.'.csv';

		Storage::put($file, '', 'private');

		foreach ($u as $a) 
		{
			if($a->acc_type == 2) 
			{
				$a_type = 'Admin';
			} else {
				$a_type = 'student';
			}
			Storage::prepend($file, $a->name .','. $a->email .','. $a_type);
			Storage::prepend($file, 'student NAME' .','. 'EMAIL' .','. 'ACCOUNT TYPE');

			return Storage::download($file);
		}
	}

	function scheduleReport(Request $request) 
	{
		if (permission::permitted('reports')=='fail'){ return redirect()->route('denied'); }
		$id = $request->emp_id;

		if ($id == null) 
		{
			$data = table::schedules()->get();
			$date = date('Y-m-d');
			$time = date('h-i-sa');
			$file = 'schedule-reports-'.$date.'T'.$time.'.csv';

			Storage::put($file, '', 'private');

			foreach ($data as $d) 
			{
				Storage::prepend($file, $d->idno .',"'. $d->student .'",'. $d->intime .','. '"'.$d->outime.'"' .','. $d->datefrom .','. $d->dateto .','. $d->hours .',"'. $d->restday .'",'. $d->archive);
			}

			Storage::prepend($file, '"IDNO"' .','. 'student' .','. 'START TIME' .','. 'OFF TIME' .','. 'DATE FROM' .','. 'DATE TO' .','. 'HOURS' .','. 'RESTDAY' .','. 'STATUS');
			
			return Storage::download($file);
		}

		if ($id !== null) 
		{
			$data = table::schedules()->where('idno', $id)->get();
			$date = date('Y-m-d');
			$time = date('h-i-sa');
			$file = 'schedule-reports-'.$date.'T'.$time.'.csv';

			Storage::put($file, '', 'private');

			foreach ($data as $d) 
			{
				Storage::prepend($file, $d->idno .',"'. $d->student .'",'. $d->intime .','. '"'.$d->outime.'"' .','. $d->datefrom .','. $d->dateto .','. $d->hours .',"'. $d->restday .'",'. $d->archive);
			}

			Storage::prepend($file, '"IDNO"' .','. 'student' .','. 'START TIME' .','. 'OFF TIME' .','. 'DATE FROM' .','. 'DATE TO' .','. 'HOURS' .','. 'RESTDAY' .','. 'STATUS');
			
			return Storage::download($file);
		}

		return redirect('reports/student-schedule')->with('error', trans("Whoops! Please select student."));
	}

}
