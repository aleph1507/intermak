<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cart;
use App\Product;
use App\User;
use Session;
use Auth;
use DB;
use App\Administrator;

class CartController extends Controller
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

    public function auc() // attach user cart
    {
        
        $user = Auth::user();
        $cart = new Cart;
        $cart->save();
        $user->cart()->save($cart);
            return $cart;
    }

    public function agc(Request $request) // attach guest cart (to session)
    {
        $cart = new Cart;
        $cart->save();
        $request->session()->put('cart',$cart);
        //dd($cart->id);
        return $cart;
        
    }
    

    public function get_cart(Request $request)
    {
        if(Auth::check())
            if(Auth::user()->cart==null)
                return $this->auc();
            else
                return Auth::user()->cart;
        else
            if(Session::has('cart'))
                return Session::get('cart');
            else
                return $this->agc($request);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // administruranje cartovi i statistika
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // kreiraj i zakaci go za user_id ili guest
        //$cart = new Cart;
        if(!Auth::check()) // guest; kreiraj i zakaci za sesija
             $this->agc();
         else
            if(Auth::user()->cart==null) //user bez cart; kreiraj i zakaci za user
                $uid = $this->auc();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // safeuvaj nov kreiran cart
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // pokazi go cartot na userot, editiraj proizvodi vo cart, izbrisi proizvodi od cart i plati
        $cart = $this->get_cart($request);
        return view('carts.show')->withCart(Cart::find($cart->id))->withRole($this->role());
        /*if(Auth::check()){ 
                $user=Auth::user();
                if($user->cart==null){
                    $cart = $this->create();
                    return view('carts.show')->withCart(new Cart)->withUser($user)->withRole($this->role());
                }
        
                $cart = $user->cart;
                    return view('carts.show')->withCart($cart)->withUser($user)->withRole($this->role());
        }*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // del od show
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function addProduct(Request $request, $pid)
    {
        /*if(!Auth::check())
            return "guest";

        //dd($request);
        $user = Auth::user();
        $cart = $user->cart;*/

       // if(Session::has('cart'))
       //     dd('session has cart '. Session::get('cart')->id);
        $cart = $this->get_cart($request);
        $product = Product::find($pid);
        $cart->products()->attach($product);
        //dd($cart->id);
        if($cart->total_price==null)
            $cart->total_price=0;
        $int_price = intval(preg_replace('/[^0-9]+/','',$product->price), 10);
        $cart->total_price+=$int_price;
        //dd($int_price);
        $cart->save();
        Session::flash('success', 'Product added to cart.');
        //dd(Cart::find(15)->products);
        return redirect()->back();

        //dd(Session::getId());

        /*
        */

    }

    public function removeProduct(Request $request, $pid)
    {
        //if(!Auth::check())
        //    return "guest";

        /*$user=Auth::user();
        $cart=$user->cart;*/
        $cart = $this->get_cart($request);
        //dd($cart->id);
        if($cart->products->contains($pid))
        {
            if($cart->total_price==null)
                $cart->total_price=0;
            $price = Product::find($pid)->price;
            $int_price = intval(preg_replace('/[^0-9]+/','',$price), 10);
            $cart->total_price-=$int_price;
            DB::delete('DELETE FROM cart_product WHERE cart_id = ? AND product_id = ? LIMIT 1',[$cart->id, $pid]);
            //$cart->products()->detach($pid);
            $cart->save();
            Session::flash('success', 'Product removed from cart.');
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // safeuvaj editiran cart
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // izbrisi gi site proizvodi od cart
    }
}
