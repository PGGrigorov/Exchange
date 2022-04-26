<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $admin = User::find($id);
        $users = User::latest()->paginate(100);

        if ($admin->is_admin == 1) return view('admin.admin_home', compact('admin', 'users'));
        else
         return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin_user_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);

    
        $user = new User;
        $user->name = $request->name;
        $user->email =  $request->email;
        
        // Check if passwords match
        if ($request->password != $request->password_confirmation) return back();
        else 
        $user->password = Hash::make($request->password); 

        $user->save();

        return redirect()->route('admin.home', [auth()->user()->id]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Promote user
    public function promote($id) {
        $user = User::find($id);
        
        $user->is_admin = 1;
        $user->save();
       
        return back();
    }

    // Demote user
    public function demote($id) {
        $user = User::find($id);

        $user->is_admin = 0;
        $user->save();

        return back();
    }

    // Delete user
    public function delete_user($id) {
        DB::table('users')->where('id', $id)->delete();
        return back();
    }

    // Block user
    public function block($id) {

        $user = User::find($id);
        $user->is_blocked = 1;

        $user->save();
        return back();
    }

    // Unblock user
    public function unblock($id) {
        $user = User::find($id);
        $user->is_blocked = 0;

        $user->save();
        return back();
    }


    // User view
    public function user_view($id) {
        $user = User::find($id);
        
        return view('user.user_view', compact('user'));
    }

}
