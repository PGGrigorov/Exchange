<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = User::find($id);

        // Avatar
        if ($request->avatar) {
            $name = $request->avatar->getClientOriginalName();
            $request->avatar->move('storage/avatars/', time().'_'.$user->name.'_'.$name);
            $user->avatar = time().'_'.$user->name.'_'.$name;
        }

        // Name
        if ($request->name) 
            $user->name = $request->name;
        
        // Email
        if ($request->email) 
            $user->email = $request->email;

        // Checks if there is a new email typed
        if ($request->email)
        // Checks if there is a confirm email typed
        if (!$request->check_email) return back();
        else 
         // Checks if the email and the confirmation are matching
         if ($request->email == $request->check_email) 
             // Changes the email with the new email
             $user->email = $request->email;     
        

         // Checks if there is a new password typed
         if ($request->password)
            // Checks if there is a confirm password typed
            if (!$request->password_confirm) return back();
            else 
             // Checks if the password and the confirmation are matching
             if ($request->password == $request->password_confirm) 
                 // Changes the password with the new password ( Hashed )
                 $user->password = Hash::make($request->password); 

        
        $user->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
