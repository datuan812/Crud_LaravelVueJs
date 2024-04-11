<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function show($id)
    {
        return Student::findOrFail($id);
    }

    public function index()
    {
        $students = Student::
        join('lophocs', 'sinhviens.lophoc_id', '=', 'lophocs.id')
        ->join('khoahocs', 'sinhviens.khoahoc_id', '=', 'khoahocs.id')
        ->select(
            'sinhviens.*',
            'lophocs.name as class',
            'khoahocs.name as course'
              )
        ->get();
        return response()->json($students);
    }

    public function create(){
        $lophocs = DB::table("lophocs")
        ->select(
            "id as value",
            "name as label",
        )
        ->get();

        $khoahocs = DB::table("khoahocs")
        ->select(
            "id as value",
            "name as label",
        )
        ->get();

        return response()->json([
            "lophocs" => $lophocs,
            "khoahocs" => $khoahocs
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:sinhviens,email',
            'phone' => [
                'required',
                'regex:/^[0-9]{10}$/',
                'unique:sinhviens,phone'
            ],
            'address' => 'required',
            'lophoc_id' => 'required',
            'khoahoc_id' => 'required'
        ], [
            'name.required' => 'Please enter student name',
            'email.required' => 'Please enter email',
            'email.email' => 'Invalid email',
            'email.unique' => 'Email number already exists',
            'phone.required' => 'Please enter phone number',
            'phone.unique' => 'Phone number already exists',
            'phone.regex' => 'Invalid phone',
            'address.required' => 'Please enter address',
            'lophoc_id.required' => 'Please select a class ',
            'khoahoc_id.required' => 'Please select a course ',
        ]);

        $data = $validated;

        Student::create($data);

    }

    public function edit($id){
        $students = Student::find($id);

        $lophocs = DB::table("lophocs")
        ->select(
            "id as value",
            "name as label",
        )
        ->get();

        $khoahocs = DB::table("khoahocs")
        ->select(
            "id as value",
            "name as label",
        )
        ->get();

        return response()->json([
            "sinhviens" => $students,
            "lophocs" => $lophocs,
            "khoahocs" => $khoahocs
        ]);
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => [
                'required',
                'regex:/^[0-9]{10}$/',
                'unique:sinhviens,phone,'.$id.',id'
            ],
            'address' => 'required',
            'lophoc_id' => 'required',
            'khoahoc_id' => 'required'
        ], [
            'name.required' => 'Please enter student name',
            'email.required' => 'Please enter name',
            'email.email' => 'Invalid email',
            'phone.required' => 'Please enter phone number',
            'phone.unique' => 'Phone number already exists',
            'phone.regex' => 'Invalid phone',
            'address.required' => 'Please enter address',
            'lophoc_id.required' => 'Please select a class ',
            'khoahoc_id.required' => 'Please select a course ',
        ]);

           Student::find($id)->update([
            "name" => $request["name"],
            "email" => $request["email"],
            "phone" => $request["phone"],
            "address" => $request["address"],
            "lophoc_id" => $request["lophoc_id"],
            "khoahoc_id" => $request["khoahoc_id"]
           ]);
    }

    public function destroy($id){

            $student = Student::find($id);

            $student->delete();

            return response()->json(['message' => 'Student deleted successfully']);
    }

    public function searchByName(Request $request)
    {
        $name = $request->input('name');

        $student = Student::where('name', 'like', "%$name%")->get();

        return response()->json($student);
    }



}
