<?php

namespace App\Http\Controllers\admin;
use DB;
use App\Classes\table;
use App\Classes\permission;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index(Request $request) 
    {
        if (permission::permitted('dashboard')=='fail'){ return redirect()->route('denied'); }
        
        $datenow = date('Y-m-d'); 
        $is_online = table::attendance()->where([['date', $datenow],['timeout', NULL]])->pluck('idno');
        //$is_online_merge = table::attendance()->where('date', $datenow)->orderBy('idno')->;
        $is_online_arr = json_decode(json_encode($is_online), true);
        $is_online_now = count($is_online); 

        $emp_ids = table::schooldata()->pluck('idno');
        $emp_ids_arr = json_decode(json_encode($emp_ids), true); 
        $is_offline_now = count(array_diff($emp_ids_arr, $is_online_arr));
        $tf = table::settings()->value("time_format");
        
		$emp_all_type = table::people()
        ->join('tbl_school_data', 'tbl_people.id', '=', 'tbl_school_data.reference')
        ->where('tbl_people.stdstatus', 'Active')
        ->orderBy('tbl_school_data.startdate', 'desc')
        ->take(8)
        ->get();

		$emp_typeR = table::people()
        ->where('stdtype', 'Regular')
        ->where('stdstatus', 'Active')
        ->count();

		$emp_typeT = table::people()
        ->where('stdtype', '504-IEP')
        ->where('stdstatus', 'Active')
        ->count();

		$emp_allActive = table::people()
        ->where('stdstatus', 'Active')
        ->count();

        $a = table::attendance()
        ->latest('date')
        ->take(4)
        ->get();
        
        $b = table::attendance()
        ->latest('strike')
        ->take(4)
        ->get();


        return view('admin.dashboard', compact('tf', 'emp_typeR', 'emp_typeT', 'emp_allActive', 'emp_all_type','a' , 'b' , 'is_online_now', 'is_offline_now'));
    }
}
