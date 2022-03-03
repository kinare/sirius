<?php

namespace App\Listeners;

use App\Student;
//use App\Events\StudentCreated;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class StudentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function handle(Student $student)
    {
        try{
            $user = new User();
            $user->password = Hash::make("allowme@1");
            $user->email = $student->E_mail ? $student->E_mail : $student->No;
            $user->name = "$student->Other_Names $student->SurName";
            $user->save();

            $student->user_id = $user->id;
            $student->save();
        }catch (\Exception $e){
            print($e->getMessage());
        }


//        $credentials = ['email' => $user->email];
//       $response = Password::sendResetLink($credentials);



//        switch ($response) {
//            case Password::RESET_LINK_SENT:
//                $user->activation_link_sent = true;
//                $user->save();
//                return true;
//            default:
//                return false;
//
//        }
    }
}

