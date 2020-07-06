<?php

namespace App\Http\Controllers\admin;
use DB;
use App\Classes\table;
use App\Classes\permission;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class StudentsController extends Controller
{

	public function index() 
	{
        if (permission::permitted('students')=='fail'){ return redirect()->route('denied'); }

		$emp_typeR = table::people()
		->where('stdtype', 'Regular')
		->where('stdstatus', 'Active')
		->count();

		$emp_typeT = table::people()
		->where('stdtype', '504-IEP')
		->where('stdstatus', 'Active')
		->count();

		$emp_genderM = table::people()
		->where('gender', 'Male')
		->count();

		$emp_genderR = table::people()
		->where('gender', 'Female')
		->count();

		$emp_allActive = table::people()
		->where('stdstatus', 'Active')
		->count();

		$emp_allArchive = table::people()
		->where('stdstatus', 'Archive')
		->count();

		$data = table::people()
		->join('tbl_school_data', 'tbl_people.id', '=', 'tbl_school_data.reference')
		->get();

		$emp_file = table::people()->count();
		
		if($emp_allArchive != null OR $emp_allActive != null OR $emp_allArchive >= 1 OR $emp_allActive >= 1)
		{
			$number1 = $emp_allArchive / $emp_allActive * 100;
		} else {
			$number1 = null;
		}
		
	    return view('admin.students', compact('data', 'emp_typeR', 'emp_typeT', 'emp_genderM', 'emp_genderR', 'emp_allActive', 'emp_file', 'emp_allArchive'));
	}

	public function new() 
	{
		if (permission::permitted('students-add')=='fail'){ return redirect()->route('denied'); }
		
		$students = table::people()->get();
		$school = table::school()->get();
		$grade = table::grade()->get();
		//$jobtitle = table::jobtitle()->get();
		//$leavegroup = table::leavegroup()->get();

	    return view('admin.new-student', compact('school', 'grade', 'students'));
	}
	
    public function add(Request $request)
    {
		if (permission::permitted('students-add')=='fail'){ return redirect()->route('denied'); }
		
		$v = $request->validate([
			'lastname' => 'required|alpha_dash_space|max:155',
			'firstname' => 'required|alpha_dash_space|max:155',
			'emailaddress' => 'required|email|max:155',
			'idno' => 'required|max:155',
			'stdstatus' => 'required|alpha_dash_space|max:155',
		]);
	  
		$lastname = mb_strtoupper($request->lastname);
		$firstname = mb_strtoupper($request->firstname);
		$mi = mb_strtoupper($request->mi);
		$age = $request->age;
		$gender = mb_strtoupper($request->gender);
		$emailaddress = mb_strtolower($request->emailaddress);
		$mobileno = $request->mobileno;
		$birthday = date("Y-m-d", strtotime($request->birthday));
		$nationalid = mb_strtoupper($request->nationalid);
		$birthplace = mb_strtoupper($request->birthplace);
		$homeaddress = mb_strtoupper($request->homeaddress);
		$school = mb_strtoupper($request->school);
		$grade = mb_strtoupper($request->grade);
		$schoolemail = mb_strtolower($request->schoolemail);
		$idno = mb_strtoupper($request->idno);
		$stdtype = $request->stdtype;
		$stdstatus = $request->stdstatus;
		$startdate = date("Y-m-d", strtotime($request->startdate));

		$is_idno_taken = table::schooldata()->where('idno', $idno)->exists();

		if ($is_idno_taken == 1) 
		{
			return redirect('students-new')->with('error', trans("Whoops! the ID Number is already taken."));
		}

		$file = $request->file('image');

		if($file != null) 
		{
			$name = $request->file('image')->getClientOriginalName();
			$destinationPath = public_path() . '/assets/faces/';
			$file->move($destinationPath, $name);
		} else {
			$name = '';
		}
		
    	table::people()->insert([
    		[
				'lastname' => $lastname,
				'firstname' => $firstname,
				'mi' => $mi,
				'age' => $age,
				'gender' => $gender,
				'emailaddress' => $emailaddress,
				'mobileno' => $mobileno,
				'birthday' => $birthday,
				'birthplace' => $birthplace,
				'nationalid' => $nationalid,
				'homeaddress' => $homeaddress,
				'stdtype' => $stdtype,
				'stdstatus' => $stdstatus,
				'avatar' => $name,
            ],
    	]);

		$refId = DB::getPdo()->lastInsertId();
		
    	table::schooldata()->insert([
    		[
    			'reference' => $refId,
				'school' => $school,
				'grade' => $grade,
				'schoolemail' => $schoolemail,
				'idno' => $idno,
				'startdate' => $startdate,
            ],
    	]);

    	return redirect('students')->with('success', trans("New student has been added!"));
    }
}
