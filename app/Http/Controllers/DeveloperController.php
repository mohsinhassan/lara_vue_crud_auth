<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Developer;
class DeveloperController extends Controller
{
    public function index()
    {
        $developers = Developer::all()->toArray();
        return array_reverse($developers);      
    }

    public function add(Request $request)
    {
        $Developer = new Developer([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'address' => $request->input('address')
        ]);
        $Developer->save();

        return response()->json('The developer successfully added');
    }

    public function store(Request $request)
    {
        $developer = new Developer([
            'name' => $request->input('name'),
            'detail' => $request->input('detail')
        ]);
        $developer->save();

        return response()->json('Developer created!');
    }

    public function edit($id)
    {
        $Developer = Developer::find($id);
        return response()->json($Developer);
    }

    // public function show($id)
    // {
    //     $developer = Developer::find($id);
    //     return response()->json($developer);
    // }

    public function update($id, Request $request)
    {
        $developer = Developer::find($id);
        $developer->update($request->all());

        return response()->json('Developer updated!');
    }

    public function delete($id)
    {
        $developer = Developer::find($id);
        $developer->delete();

        return response()->json('Developer deleted!');
    }
}
