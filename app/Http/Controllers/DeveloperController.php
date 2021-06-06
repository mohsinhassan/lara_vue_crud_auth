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
        
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $file_name = "";

        if($request->file()) {
            $pic = $request->file('avatar');
            $file_name = time().$pic->getClientOriginalName();
            $file_path = $pic->storeAs('uploads', $file_name, 'public');
            $pic->move(base_path('\public\uploads'), $file_name);
        }
        $Developer = new Developer([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'avatar' => '/uploads/'.$file_name 
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

    public function update($id, Request $request)
    {
        $developer = Developer::find($id);

        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $file_name = "";

        $form_data = array(
            'fname'       =>   $request->fname,
            'lname'        =>   $request->lname,
            'email'            =>  $request->email,
            'phone_number'            =>  $request->phone_number,
            'address'            =>  $request->address
        );


        if($request->file()) {
            $pic = $request->file('avatar');
            $file_name = time().$pic->getClientOriginalName();
            $file_path = $pic->storeAs('uploads', $file_name, 'public');
            $pic->move(base_path('\public\uploads'), $file_name);
        }
        if(!empty($file_name)){
            $form_data = array(
                'fname'       =>   $request->fname,
                'lname'        =>   $request->lname,
                'email'            =>  $request->email,
                'phone_number'            =>  $request->phone_number,
                'address'            =>  $request->address,
                'avatar'            =>  '/uploads/'.$file_name 
            );
        }

        $developer->update($form_data);

        return response()->json('Developer updated!');
    }

    public function delete($id)
    {
        $developer = Developer::find($id);
        $developer->delete();

        return response()->json('Developer deleted!');
    }
}
