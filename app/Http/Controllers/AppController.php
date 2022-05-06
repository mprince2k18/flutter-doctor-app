<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\User;
<<<<<<< HEAD
use Carbon\Carbon;
use Exception;
=======
use App\Models\DoctorProfile;
>>>>>>> 72b745478a63e1b89d184f2d5599bd37d8d0b324

class AppController extends Controller
{
    // all_doctors
    public function all_doctors()
    {
        $doctors = User::where('role', 'doctor')->get();
        return response()->json(['doctors'=>$doctors]);
    }

    //doctors_profile
    public function doctors_profile($user_id)
    {
        $doctor = User::where('id', $user_id)->first();
        return response()->json($doctor);
    }

    //doctors_profile_update
    public function doctors_profile_update($user_id, Request $request)
    {
        $doctor = DoctorProfile::where('id', $user_id)->first();
        if ($doctor) {
            $doctor->speciality = $request->speciality;
            $doctor->qualification = $request->qualification;
            $doctor->experience = $request->experience;
            $doctor->address = $request->address;
            $doctor->phone = $request->phone;
        }else{
            $doctor = new DoctorProfile();
            $doctor->user_id = $user_id;
            $doctor->speciality = $request->speciality;
            $doctor->qualification = $request->qualification;
            $doctor->experience = $request->experience;
            $doctor->address = $request->address;
            $doctor->phone = $request->phone;
        }
        $doctor->save();
        return response()->json($doctor);
    }

    //all_patient
    public function all_patient()
    {
        $patients = User::where('role', 'patient')->get();
        return response()->json($patients);
    }

    //make_appointment
    public function make_appointment(Request $request)
    {
<<<<<<< HEAD
        // return $request;
    //   try
    //   {
        $appointment = new Appointment();
        $appointment->patient_id = $request->user_id;
=======
        $appointment = new \App\Models\Appointment;
        $appointment->patient_id = $request->patient_id;
>>>>>>> 72b745478a63e1b89d184f2d5599bd37d8d0b324
        $appointment->doctor_id = $request->doctor_id;
        $appointment->date = Carbon::parse($request->time);
        // $appointment->time = Carbon::parse($request->time);
        $appointment->subject = $request->subject;
        $appointment->desc = $request->desc;
        $appointment->status = 0;
        $appointment->save();
        return response()->json(['message'=>'Submited successfully']);
    //   }catch(Exception $e){
       
    //     return response()->json(['message'=>'try again']);
    //   }
        
    }

    // accept_appointment
    public function accept_appointment($appointment_id)
    {
        $appointment = \App\Models\Appointment::where('id', $appointment_id)->first();
        $appointment->status = 1;
        $appointment->save();
        return response()->json($appointment);
    }

    // appointment_list
    public function appointment_list()
    {
        $appointments = \App\Models\Appointment::all();
        return response()->json($appointments);
    }

    // appointment_list_doctor
    public function appointment_list_doctor($user_id)
    {
        $appointments = \App\Models\Appointment::where('doctor_id', $user_id)->get();
        return response()->json(['appointments'=>$appointments]);
    }

    // appointment_list_patient
    public function appointment_list_patient($user_id)
    {
        $appointments = \App\Models\Appointment::where('patient_id', $user_id)->get();
        return response()->json(['appointments'=>$appointments]);
    }

    // appointment_list_patient_doctor
    public function appointment_list_patient_doctor($user_id)
    {
        $appointments = \App\Models\Appointment::where('patient_id', $user_id)->orWhere('doctor_id', $user_id)->get();
        return response()->json($appointments);
    }

    // give_prescription
    public function give_prescription(Request $request)
    {
        // return $request;
        $prescription = new \App\Models\Prescription;
        $prescription->appointment_id = $request->appointment_id;
        $prescription->patient_id = $request->patient_id;
        $prescription->doctor_id = $request->doctor_id;
        $prescription->date = Carbon::now();
        // $table->string('date');
        $prescription->medicine = $request->medicine;
        $prescription->dosage = $request->dosage;
        $prescription->instruction = $request->instruction;
        $prescription->date = $request->date;
        $prescription->save();
        return response()->json(['message'=>'Submited successfully']);

    }

    //prescription_list
    public function prescription_list($id)
    {
        // return $id;
        $prescriptions = Prescription::where('appointment_id',$id)->get();
        return response()->json(['prescriptions'=>$prescriptions]);
    }

    //ENDS
}
