<?php

namespace App\Http\Controllers\admin;
use DB;
use App\Classes\table;
use App\Classes\permission;
use App\Http\Requests;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function view($id, Request $request)
    {
		if (permission::permitted('students-view')=='fail'){ return redirect()->route('denied'); }
		
		$p = table::people()->where('id', $id)->first();
		$c = table::schooldata()->where('reference', $id)->first();
		$i = table::people()->select('avatar')->where('id', $id)->value('avatar');

        return view('admin.profile-view', compact('p', 'c', 'i'));
    }

   	public function delete($id, Request $request)
    {
		if (permission::permitted('students-delete')=='fail'){ return redirect()->route('denied'); }

		return view('admin.delete-student', compact('id'));
   	}

	public function clear(Request $request) 
	{
		if (permission::permitted('students-delete')=='fail'){ return redirect()->route('denied'); }
		
		$id = $request->id;
		table::people()->where('id', $id)->delete();
		table::schooldata()->where('reference', $id)->delete();
		table::attendance()->where('reference', $id)->delete();
		table::users()->where('reference', $id)->delete();

		return redirect('students')->with('success', trans("student information has been deleted!"));
	}

   	public function archive($id, Request $request)
    {
		if (permission::permitted('students-archive')=='fail'){ return redirect()->route('denied'); }

		$id = $request->id;
		table::people()->where('id', $id)->update(['stdstatus' => 'Archived']);
		table::users()->where('reference', $id)->update(['status' => '0']);

    	return redirect('students')->with('success', trans("student information has been archived!"));
   	}

	public function editPerson($id)
    {
		if (permission::permitted('students-edit')=='fail'){ return redirect()->route('denied'); }

		$school_details = table::schooldata()->where('id', $id)->first();
		$person_details = table::people()->where('id', $id)->first();
		$school = table::school()->get();
		$grade = table::grade()->get();
		$e_id = ($person_details->id == null) ? 0 : Crypt::encryptString($person_details->id) ;

        return view('admin.edits.edit-personal-info', compact('school_details', 'person_details', 'school', 'grade', 'e_id'));
    }

    public function updatePerson(Request $request)
    {
		if (permission::permitted('students-edit')=='fail'){ return redirect()->route('denied'); }

		$v = $request->validate([
			'id' => 'required|max:200',
			'lastname' => 'required|alpha_dash_space|max:155',
			'firstname' => 'required|alpha_dash_space|max:155',
			'emailaddress' => 'required|email|max:155',
			'idno' => 'required|max:155',
			'stdstatus' => 'required|alpha_dash_space|max:155',
		]);

		$id = Crypt::decryptString($request->id);
		$lastname = mb_strtoupper($request->lastname);
		$firstname = mb_strtoupper($request->firstname);
		$mi = mb_strtoupper($request->mi);
		$age = $request->age;
		$gender = mb_strtoupper($request->gender);
		$emailaddress =  mb_strtolower($request->emailaddress);
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

		$file = $request->file('image');
		if ($file != null) 
		{
			$name = $request->file('image')->getClientOriginalName();
			$destinationPath = public_path() . '/assets/faces/';
			$file->move($destinationPath, $name);
		} else {
			$name = table::people()->where('id', $id)->value('avatar');
		}
		
		table::people()->where('id', $id)->update([
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
		]);

		table::schooldata()->where('reference', $id)->update([
			'school' => $school,
			'grade' => $grade,
			'schoolemail' => $schoolemail,
			'idno' => $idno,
			'startdate' => $startdate,
		]);
		
    	return redirect('profile/edit/'.$id)->with('success', trans("Student information has been updated!"));
   	}

	public function viewProfile(Request $request) 
	{
		$id = \Auth::user()->id;
		$myuser = table::users()->where('id', $id)->first();
		$myrole = table::roles()->where('id', $myuser->role_id)->value('role_name');

		return view('admin.update-profile', compact('myuser', 'myrole'));
	}

	public function viewPassword() 
	{
		return view('admin.update-password');
	}

	public function updateUser(Request $request) 
	{

		$v = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
		]);
		
		$id = \Auth::id();
		$name = mb_strtoupper($request->name);
		$email = mb_strtolower($request->email);

		if($id == null) 
        {
            return redirect('personal/update-user')->with('error', trans("Whoops! Please fill the form completely."));
		}
		
		table::users()->where('id', $id)->update([
			'name' => $name,
			'email' => $email,
		]);

		return redirect('update-profile')->with('success', trans("Updated!"));
	}

	public function updatePassword(Request $request) 
	{

		$v = $request->validate([
            'currentpassword' => 'required|max:100',
            'newpassword' => 'required|min:8|max:100',
            'confirmpassword' => 'required|min:8|max:100',
		]);

		$id = \Auth::id();
		$p = \Auth::user()->password;
		$c_password = $request->currentpassword;
		$n_password = $request->newpassword;
		$c_p_password = $request->confirmpassword;

		if($id == null) 
        {
            return redirect('personal/update-user')->with('error', trans("Whoops! Please fill the form completely."));
		}

		if($n_password != $c_p_password) 
		{
			return redirect('update-password')->with('error', trans("New password does not match!"));
		}

		if(Hash::check($c_password, $p)) 
		{
			table::users()->where('id', $id)->update([
				'password' => Hash::make($n_password),
			]);

			return redirect('update-password')->with('success', trans("Updated!"));
		} else {
			return redirect('update-password')->with('error', trans("Oops! current password does not match."));
		}
	}


} 
