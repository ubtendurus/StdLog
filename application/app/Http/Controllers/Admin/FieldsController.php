<?php

namespace App\Http\Controllers\admin;
use DB;
use App\Classes\table;
use App\Classes\permission;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;

class FieldsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | school
    |--------------------------------------------------------------------------
    */
    public function school() 
    {
      if (permission::permitted('school')=='fail'){ return redirect()->route('denied'); }

      $data = table::school()->get();
      return view('admin.fields.school', compact('data'));
    }

    public function addschool(Request $request)
    {
      if (permission::permitted('school-add')=='fail'){ return redirect()->route('denied'); }

      $v = $request->validate([
        'school' => 'required|alpha_dash_space|max:100',
      ]);

      $school = mb_strtoupper($request->school);

      table::school()->insert([
        ['school' => $school],
      ]);

      return redirect('fields/school')->with('success', trans("New school has been added!"));
    }

    public function deleteschool($id, Request $request)
    {
      if (permission::permitted('school-delete')=='fail'){ return redirect()->route('denied'); }

      table::school()->where('id', $id)->delete();

      return redirect('fields/school')->with('success', trans("Deleted!"));
    }

    /*
    |--------------------------------------------------------------------------
    | grade
    |--------------------------------------------------------------------------
    */
    public function grade() 
    {
      if (permission::permitted('grades')=='fail'){ return redirect()->route('denied'); }

      $data = table::grade()->get();
      return view('admin.fields.grade', compact('data'));
    }

    public function addgrade(Request $request)
    {
      if (permission::permitted('grades-add')=='fail'){ return redirect()->route('denied'); }

      $v = $request->validate([
        'grade' => 'required|alpha_dash_space|max:100',
      ]);

      $grade = mb_strtoupper($request->grade);

      table::grade()->insert([
        ['grade' => $grade],
      ]);

      return redirect('fields/grade')->with('success', trans("New grade has been added!"));
    }

    public function deletegrade($id, Request $request)
    {
      if (permission::permitted('grades-delete')=='fail'){ return redirect()->route('denied'); }

      table::grade()->where('id', $id)->delete();

      return redirect('fields/grade')->with('success', trans("Deleted!"));
    }

    
} 