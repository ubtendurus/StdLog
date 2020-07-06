<?php

namespace App\Http\Controllers\admin;
use DB;
use DateTimeZone;
use DateTime;
use App\Classes\table;
use App\Classes\permission;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
	public function index() 
	{
		if (permission::permitted('reports')=='fail'){ return redirect()->route('denied'); }
		$lastviews = table::reportviews()->get();

    	return view('admin.reports', ['lastviews' => $lastviews]);
    }

	public function empList(Request $request) 
	{
		if (permission::permitted('reports')=='fail'){ return redirect()->route('denied'); }
		
		$today = date('M, d Y');
		$empList = table::people()->get();
		table::reportviews()->where('report_id', 1)->update(['last_viewed' => $today]);

		return view('admin.reports.report-student-list', compact('empList'));
	}

	public function empAtten(Request $request) 
	{
		if (permission::permitted('reports')=='fail'){ return redirect()->route('denied'); }
		
		$today = date('M, d Y');
		$empAtten = table::attendance()->get();
		$student = table::people()->join('tbl_school_data', 'tbl_people.id', '=', 'tbl_school_data.reference')->where('tbl_people.stdstatus', 'Active')->get();
		table::reportviews()->where('report_id', 2)->update(array('last_viewed' => $today));
        $tf = table::settings()->value("time_format");

		return view('admin.reports.report-student-attendance', compact('empAtten', 'student', 'tf'));
	}

	public function orgProfile(Request $request) 
	{
		if (permission::permitted('reports')=='fail'){ return redirect()->route('denied'); }
		
		$today = date('M, d Y');
		$ed = table::people()->join('tbl_school_data', 'tbl_people.id', '=', 'tbl_school_data.reference')->where('tbl_people.stdstatus', 'Active')->get();
		
		$age_5_7 = table::people()->where([['age', '>=', '5'], ['age', '<=', '7']])->count();
		$age_8_10 = table::people()->where([['age', '>=', '8'], ['age', '<=', '10']])->count();
		$age_11_13 = table::people()->where([['age', '>=', '11'], ['age', '<=', '13']])->count();
		$age_14_16 = table::people()->where([['age', '>=', '14'], ['age', '<=', '16']])->count();
		$age_17_100 = table::people()->where('age', '>=', '17')->count();
		
		if($age_5_7 == null) {$age_5_7 = 0;};
		if($age_8_10 == null) {$age_8_10 = 0;};
		if($age_11_13 == null) {$age_11_13 = 0;};
		if($age_14_16 == null) {$age_14_16 = 0;};
		if($age_17_100 == null) {$age_17_100 = 0;};	

		$age_group = $age_5_7.','.$age_8_10.','.$age_11_13.','.$age_14_16.','.$age_17_100;
		$dcc = null; 
		$dpc = null;
		$dgc = null;
		$csc = null;
		$yhc = null;

		foreach ($ed as $c) { $comp[] = $c->school; $dcc = array_count_values($comp); }
		$cc = ($dcc == null) ? null : implode($dcc, ', ') . ',' ;

		foreach ($ed as $d) { $dept[] = $d->grade; $dpc = array_count_values($dept); }
		$dc = ($dpc == null) ? null : implode($dpc, ', ') . ',' ;

		foreach ($ed as $g) { $gender[] = $g->gender; $dgc = array_count_values($gender); }
		$gc = ($dgc == null) ? null : implode($dgc, ', ') . ',' ;

		
		$orgProfile = table::schooldata()->get();
		table::reportviews()->where('report_id', 5)->update(array('last_viewed' => $today));

		return view('admin.reports.report-organization-profile', compact('orgProfile', 'age_group', 'gc', 'dgc', 'csc', 'yhc', 'dc', 'dpc', 'dcc', 'cc'));
	}

	public function empBday(Request $request) 
	{
		if (permission::permitted('reports')=='fail'){ return redirect()->route('denied'); }
		
		$today = date('M, d Y');
		$empBday = table::people()->join('tbl_school_data', 'tbl_people.id', '=', 'tbl_school_data.reference')->get();
		table::reportviews()->where('report_id', 7)->update(['last_viewed' => $today]);

		return view('admin.reports.report-student-birthdays', compact('empBday'));
	}

	public function userAccs(Request $request) 
	{
		if (permission::permitted('reports')=='fail'){ return redirect()->route('denied'); }
		
		$today = date('M, d Y');
		$userAccs = table::users()->get();
		table::reportviews()->where('report_id', 6)->update(['last_viewed' => $today]);

		return view('admin.reports.report-user-accounts', compact('userAccs'));
	}

	public function getEmpAtten(Request $request) 
	{
		if (permission::permitted('reports')=='fail'){ return redirect()->route('denied'); }
		
		$id = $request->id;
		$datefrom = $request->datefrom;
		$dateto = $request->dateto;
		
		if ($id == null AND $datefrom == null AND $dateto == null) 
		{
			$data = table::attendance()->select('idno', 'date', 'student', 'timein', 'timeout', 'totalhours','strike')->get();
			return response()->json($data);
		}

		if($id !== null AND $datefrom == null AND $dateto == null ) 
		{
		 	$data = table::attendance()->where('idno', $id)->select('idno', 'date', 'student', 'timein', 'timeout', 'totalhours','strike')->get();
			return response()->json($data);
		} elseif ($id !== null AND $datefrom !== null AND $dateto !== null) {
			$data = table::attendance()->where('idno', $id)->whereBetween('date', [$datefrom, $dateto])->select('idno', 'date', 'student', 'timein', 'timeout', 'totalhours','strike')->get();
			return response()->json($data);
		} elseif ($id == null AND $datefrom !== null AND $dateto !== null) {
			$data = table::attendance()->whereBetween('date', [$datefrom, $dateto])->select('idno', 'date', 'student', 'timein', 'timeout', 'totalhours','strike')->get();
			return response()->json($data);
		} 
	}


}
