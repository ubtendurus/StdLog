<?php

namespace App\Classes;

use DB;

Class table {

	public static function people() 
	{
    	$people = DB::table('tbl_people');
    	return $people;
  	}

	public static function schooldata() 
	{
    	$schooldata = DB::table('tbl_school_data');
    	return $schooldata;
  	}

	public static function attendance() 
	{
    	$attendance = DB::table('tbl_people_attendance');
    	return $attendance;
  	}

	public static function reportviews() 
	{
    	$reportviews = DB::table('tbl_report_views');
    	return $reportviews;
  	}

	public static function permissions() 
	{
    	$permissions = DB::table('users_permissions');
    	return $permissions;
  	}

	public static function roles() 
	{
    	$roles = DB::table('users_roles');
    	return $roles;
  	}

	public static function users() 
	{
    	$users = DB::table('users')->select('id', 'reference', 'idno', 'name', 'email', 'role_id', 'acc_type', 'status');
    	return $users;
  	}

	public static function school() 
	{
    	$school = DB::table('tbl_form_school');
    	return $school;
  	}

	public static function grade() 
	{
    	$grade = DB::table('tbl_form_grade');
    	return $grade;
  	}

	   
	public static function settings() 
	{
    	$settings = DB::table('settings');
    	return $settings;
  	}

}