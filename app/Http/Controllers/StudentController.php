<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(){
        $students =Student::all();
        return view('index',compact('students'));
    }

   public function store(Request $request){

   $request->validate([
    'name'=>'required',
    'email'=>'required',
    'address'=>'min:3'
   ]);

    $student = new Student();

    $student->name = $request->name;
    $student->email = $request->email;
    $student->address = $request->address;
    $student->save();

    return redirect('/student');

   
}
}



