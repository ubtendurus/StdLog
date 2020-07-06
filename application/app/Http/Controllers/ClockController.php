<?php

namespace App\Http\Controllers;
use DB;
use Carbon\Carbon;
use App\Classes\table;
use App\Classes\permission;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClockController extends Controller
{
    
    public function clock()
    {
        $data = table::settings()->where('id', 1)->first();
        $cc = $data->clock_comment;
        $tz = $data->timezone;
        $tf = $data->time_format;
        //$ms = $data->max_strike;

        return view('clock', compact('cc', 'tz', 'tf'));
    }

    public function add(Request $request)
    {
        
        
        if ($request->idno == NULL || $request->type == NULL) 
        {
            return response()->json([
                "error" => trans("Please enter your ID.")
            ]);
        }

        if(strlen($request->idno) >= 20 || strlen($request->type) >= 20) 
        {
            return response()->json([
                "error" => trans("Invalid student ID.")
            ]);
        }

        $idno = strtoupper($request->idno);
        $type = $request->type;
        $date = date('Y-m-d');
        $time = date('h:i:s A');
        $comment = strtoupper($request->clockin_comment);
        $ip = $request->ip();

        // Check-in comment feature
        $clock_comment = table::settings()->value('clock_comment');
        $tf = table::settings()->value('time_format');
        $time_val = ($tf == 1) ? $time : date("H:i:s", strtotime($time)) ;

        if ($clock_comment == "on") 
        {
            if ($comment == NULL) 
            {
                return response()->json([
                    "error" => trans("Please provide your comment!")
                ]);
            }
        }

        // ip resriction
        $iprestriction = table::settings()->value('iprestriction');
        if ($iprestriction != NULL) 
        {
            $ips = explode(",", $iprestriction);

            if(in_array($ip, $ips) == false) 
            {
                $msge = trans("Whoops! You are not allowed to Clock In or Out from your IP address")." ".$ip;
                return response()->json([
                    "error" => $msge,
                ]);
            }
        } 

        $student_id = table::schooldata()->where('idno', $idno)->value('reference');
        
        if($student_id == null) {
            return response()->json([
                "error" => trans("You enter an invalid ID.")
            ]);
        }

        $emp = table::people()->where('id', $student_id)->first();
        $lastname = $emp->lastname;
        $firstname = $emp->firstname;
        $mi = $emp->mi;
        $student = mb_strtoupper($lastname.', '.$firstname.' '.$mi);
        
    

        if ($type == 'timein') 
        {
            $has = table::attendance()->where([['idno', $idno],['date', $date]])->exists();
            $has2 = table::attendance()->where([['idno', $idno],['date', $date]])->orderBy('strike','desc')->value('strike');
            $last_in_notimeout = table::attendance()->where([['idno', $idno],['timeout', NULL]])->count();
            $maxstrike = table::settings()->where('id', 1)->value('max_strike');
            
            //TODO ADD MAX AMOUNT OF STRIKE TO THE SETTINGS
            if ($has2 >= $maxstrike){
            return response()->json([
                    "student" => $student,
                    "error" => trans("You reached Max. amount of Strike for today"),
                    //"error" => trans("You already Checked In today at")." ".$hti_24." ".trans("and your strike is")." ".$has2,
                    //"error" => trans("You already Checked In today at")." ".$hti_24.$strike,
                ]);
            }
            
            if ($has == 1 && $has2 > 0 && $last_in_notimeout < 1) 
            {
                $hti = table::attendance()->where([['idno', $idno],['date', $date]])->orderBy('strike','desc')->value('timein');
                $hti = date('h:i A', strtotime($hti));
                $hti_24 = ($tf == 1) ? $hti : date("H:i", strtotime($hti)) ;
                
                $status_in = "Ok";
                
                $strike_in = $has2 + 1;
                
                table::attendance()->insert([
                            [
                                'idno' => $idno,
                                'reference' => $student_id,
                                'date' => $date,
                                'student' => $student,
                                'timein' => $date." ".$time,
                                'status_timein' => $status_in,
                                'comment' => $comment,
                                'strike' => $strike_in,
                            ],
                            ]);
                
                                
                return response()->json([
                    "student" => $student,
                    "error" => trans("You already Checked In today at")." ".$hti_24." ".trans("and your strike is")." ".$has2,
                    //"error" => trans("You already Checked In today at")." ".$hti_24.$strike,
                ]);

                
            
            } else {
                
                $has2 = table::attendance()->where([['idno', $idno],['date', $date]])->orderBy('strike','desc')->value('strike');
                
                
                
                if($last_in_notimeout >= 1)
                {
                    return response()->json([
                        "error" => trans("Please Check Out from your last Check In.")
                    ]);

                } else {

                        //TODO
                        
                        /* Scheduled in time 
                        @3 min. or 10 min. interval for breaks*/
                        
                        //$sched_clock_in_time_24h = date("H.i", strtotime($sched_in_time));
                        //$time_in_24h = date("H.i", strtotime($time));
                        $status_in = 'Ok';
                        /*if ($time_in_24h <= $sched_clock_in_time_24h) 
                        {
                            $status_in = 'In Time';
                        } else {
                            $status_in = 'Late In';
                        }*/
                    

                    if($clock_comment == "on" && $comment != NULL) 
                    {
                        $strike = 1;
                        table::attendance()->insert([
                            [
                                'idno' => $idno,
                                'reference' => $student_id,
                                'date' => $date,
                                'student' => $student,
                                'timein' => $date." ".$time,
                                'status_timein' => $status_in,
                                'comment' => $comment,
                                'strike' => $strike,
                            ],
                        ]);
                    } else {
                        table::attendance()->insert([
                            [
                                'idno' => $idno,
                                'reference' => $student_id,
                                'date' => $date,
                                'student' => $student,
                                'timein' => $date." ".$time,
                                'status_timein' => $status_in,
                            ],
                        ]);
                    }

                    return response()->json([
                        "type" => $type,
                        "time" => $time_val,
                        "date" => $date,
                        "lastname" => $lastname,
                        "firstname" => $firstname,
                        "mi" => $mi,
                    ]);
                }
                
            }
        } 
  
        if ($type == 'timeout') 
        {
            //$lastcheckin = table::attendance()->where([['idno', $idno], ['timeout' , NULL]])->orderBy('strike',desc)->take(1);
            
            $hasout2 = table::attendance()->where([['idno', $idno],['date', $date]])->value('strike');
            $timeIN = table::attendance()->where([['idno', $idno], ['timeout', NULL]])->value('timein');
            $clockInDate = table::attendance()->where([['idno', $idno],['timeout', NULL]])->value('date');
            $hasout = table::attendance()->where([['idno', $idno],['date', $date]])->value('timeout');
            $timeOUT = date("Y-m-d h:i:s A", strtotime($date." ".$time));
            $status_out = "Ok";
            
            if($timeIN == NULL) 
            {
                return response()->json([
                    "error" => trans("Please Check In before Checking Out.")
                ]);
            } 

            if ($hasout != NULL && $hasout2 == 3) 
            {
                $hto = table::attendance()->where([['idno', $idno],['date', $date]])->value('timeout');
                $hto = date('h:i A', strtotime($hto));
                $hto_24 = ($tf == 1) ? $hto : date("H:i", strtotime($hto)) ;
                
                
                
                return response()->json([
                    "student" => $student,
                    "error" => trans("You already Check Out today at")." ".$hto_24,
                ]);

            } else {

                $time1 = Carbon::createFromFormat("Y-m-d h:i:s A", $timeIN); 
                $time2 = Carbon::createFromFormat("Y-m-d h:i:s A", $timeOUT); 
                $th = $time1->diffInHours($time2);
                $tm = floor(($time1->diffInMinutes($time2) - (60 * $th)));
                $totalhour = $th.".".$tm;

                table::attendance()->where([['idno', $idno],['date', $clockInDate]])->update(array(
                    'timeout' => $timeOUT,
                    'totalhours' => $totalhour,
                    'status_timeout' => $status_out)
                );
                
                return response()->json([
                    "type" => $type,
                    "time" => $time_val, 
                    "date" => $date,
                    "lastname" => $lastname,
                    "firstname" => $firstname,
                    "mi" => $mi,
                ]);
            }
        }
    }
}
