<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        return view('index', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'address' => 'min:3'
        ]);

        $student = new Student();

        $student->name = $request->name;
        $student->email = $request->email;
        $student->address = $request->address;
        $student->save();

       
        return response()->json([
            'status' => 'success',
            'msg' => 'Student added successfully'
        ]);
    }

    public function edit($id)
{
    $student = Student::findOrFail($id);

    return response()->json($student);
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'address' => 'required|min:3',
    ]);

    $student = Student::findOrFail($id);

    $student->update([
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
    ]);

    return response()->json([
        'status' => 'success',
        'msg' => 'Student Updated Successfully'
    ]);
}

public function destroy($id)
{
    Student::findOrFail($id)->delete();

    return response()->json([
        'status' => 'success',
        'msg' => 'Student Deleted Successfully'
    ]);
}
}