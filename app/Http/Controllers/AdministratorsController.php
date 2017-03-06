<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Administrator;
use App\User;
use Auth;
use Session;
use DB;

class AdministratorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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

    public function index()
    {
        $administrators = Administrator::all();
        $users = User::all();
        $errors=[];

        if($this->role() == "administrator")
            return view('administrators.index')->withAdministrators($administrators)->withUsers($users)->withRole($this->role());
        else{
            return view('notauth')->withRole($this->role());
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'email' => 'required|unique:administrators|email'
            ]);

        $admin = new Administrator;
        $admin->email = $request->email;

        $admin->save();

        Session::flash('success', 'New administrator added.');
        return redirect()->route('administrators.index')->withRole($this->role());
    }

    public function destroy($id)
    {
        $admin = Administrator::find($id);
        $admin->delete();
        Session::flash('success', 'Administrator Removed');
        return redirect()->route('administrators.index')->withRole($this->role());
    }

    public function confirmUser($userhash)
    {
        $email = DB::select('select email from hashes where hash = ?', [$userhash]);
        if(empty($email)){
            $errors = ['User already activated, or non-existant.'];
            return redirect('/')->withErrors($errors)->withRole($this->role());
        } 
        
        //echo $email[0]->email;
        //dd($email);
        $user = User::where('email',$email[0]->email)->first();
        //dd($user);
        $user->activated = true;
        $user->save();
        Session::flash('success', "User activated.");
        DB::delete('delete from hashes where email = ?', [$email[0]->email]);
        return redirect('/')->withRole($this->role());
    }

    public function delete_user(Request $request)
    {
        $amail = User::find($request->id)->email;
        $admin = Administrator::where('email', $amail);
        if($admin != null)
            $admin->delete();
        $id = $request->id;
        User::destroy($id);
        Session::flash('success', 'User Deleted');
        return redirect('/administrators')->withRole($this->role());
    }
}
