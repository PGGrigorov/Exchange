<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

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
    public function demote($id) {
        $user = User::find($id);

        $user->is_admin = 0;
        $user->save();

        return back();
    }

    public function promote($id) {
        $user = User::find($id);
        
        $user->is_admin = 1;
        $user->save();
       
        return back();
    }


    public function delete_user($id) {
        DB::table('users')->where('id', $id)->delete();
        return back();
    }

    public function user_view($id) {

        $user = User::find($id);
        
        return view('user.user_view', compact('user'));
    }

}
