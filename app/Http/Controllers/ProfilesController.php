<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Administrator;
use App\User;
use Session;

class ProfilesController extends Controller
{

    public function role(){
        $role = "guest";
        if(Auth::check())
        {
            $role="user";
            $loggedEmail = Auth::user()->email;
            if(Administrator::where('email', $loggedEmail)->exists())
                $role="administrator";
        }
            return $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::check())
            return view('notauth')->withRole($this->role());

        $user=User::find(Auth::user()->id);
        return view('profiles.index')->withUser($user)->withRole($this->role());

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
        $user=User::find(Auth::user()->id);
        return view('profiles.index')->withUser($user)->withRole($this->role());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find(Auth::user()->id);
        return view('profiles.index')->withUser($user)->withRole($this->role());
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
        $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'creditcard' => 'sometimes|integer'
            ]);

        if($request->creditcard=="")
            $request->creditcard=NULL;

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(isset($request->phone))
            $user->phone = $request->phone;
        if(isset($request->address))
            $user->address = $request->address;
        if(isset($request->creditcard))
            $user->creditcard = $request->creditcard;

        $user->save();

        Session::flash('success', 'User profile successfully updated.');
        return view('profiles.index')->withUser($user)->withRole($this->role());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $admin = Administrator::where('email', $user->email);
        if($admin!=null)
            $admin->delete();

        $user->delete();
        Session::flash('success', 'Profile deleted.');
        return redirect('/');

    }
}
