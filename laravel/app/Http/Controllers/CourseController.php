<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show($id)
    {
        return Course::findOrFail($id);
    }

    public function index()
    {
        $courses = Course::all();

        return response()->json($courses);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:khoahocs,name'

        ], [
            'name.required' => 'Please enter course name',
            'name.unique' => 'Course already exists',

        ]);

        $data = $validated;

        Course::create($data);

    }

    public function edit($id){
        $courses = Course::find($id);

        return response()->json([
            "khoahocs" => $courses,

        ]);
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|unique:khoahocs,name,'.$id.',id'

        ], [
            'name.required' => 'Please enter course name',
            'name.unique' => 'Course already exists',
        ]);

        Course::find($id)->update([
            "name" => $request["name"],
           ]);
    }

    public function destroy($id){

            $courses = Course::find($id);

            $courses->delete();

            return response()->json(['message' => 'Course deleted successfully']);
    }

    public function searchByName(Request $request)
    {
        $name = $request->input('name');

        $courses = Course::where('name', 'like', "%$name%")->get();

        return response()->json($courses);
    }
}
