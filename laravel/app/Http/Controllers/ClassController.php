<?php

namespace App\Http\Controllers;

use App\Models\Claass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function show($id)
    {
        return Claass::findOrFail($id);
    }

    public function index()
    {
        $classes = Claass::all();

        return response()->json($classes);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:lophocs,name'

        ], [
            'name.required' => 'Please enter class name',
            'name.unique' => 'Class already exists',

        ]);

        $data = $validated;

        Claass::create($data);

    }

    public function edit($id){
        $classes = Claass::find($id);

        return response()->json([
            "lophocs" => $classes,

        ]);
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|unique:lophocs,name,'.$id.',id'

        ], [
            'name.required' => 'Please enter class name',
            'name.unique' => 'Class already exists',
        ]);

           Claass::find($id)->update([
            "name" => $request["name"],
           ]);
    }

    public function destroy($id){

            $classes = Claass::find($id);

            $classes->delete();

            return response()->json(['message' => 'Class deleted successfully']);
    }

    public function searchByName(Request $request)
    {
        $name = $request->input('name');

        $classes = Claass::where('name', 'like', "%$name%")->get();

        return response()->json($classes);
    }

}
