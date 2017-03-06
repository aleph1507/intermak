<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;
use App\Product;
use Session;
use Mail;
use App\User;
use App\Administrator;
use Auth;

class PagesController extends Controller
{

    /*public function test() {
        var_dump('id:', \Session::getId());
    }*/

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

    public function getIndex(){
    	$articles = Article::orderBy('created_at', 'desc')->limit(6)->get();
    	$products = Product::orderBy('created_at', 'desc')->limit(8)->get();
        //$this->test();
    	return view("welcome")->withArticles($articles)->withProducts($products)->withRole($this->role());
    }

    public function getAbout(){
    	return view("about-us")->withRole($this->role());
    }

    public function getFAQ(){
        return view('faq')->withRole($this->role());
    }

    public function getContact(){
    	return view('contact-us')->withRole($this->role());
    }

    public function postContact(Request $request){
    	$this->validate($request, [
    			'email' => 'required|email',
    			'subject' => 'required|max:255',
    			'message' => 'required|min:10'
    		]);

    	$data = array(
    			'email' => $request->email,
    			'subject' => $request->subject,
    			'bodyMessage' => $request->message
    		);

    	Mail::send('emails.contact', $data, function($message) use ($data){
    		$message->from($data['email']);
    		$message->to('contact@exploremk.com');
    		$message->subject($data['subject']);
    	});

    	Session::flush('success', 'Email sent');

    	return redirect('/')->withRole($this->role());
    }


    public function profile(Request $request)
    {
        if(!Auth::check())
            return view('notauth')->withRole($this->role());
        $user = User::find($request->id);
        return view('profile')->withRole($this->role());
    }
}
