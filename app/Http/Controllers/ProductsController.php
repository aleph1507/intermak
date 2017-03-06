<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use Session;
use Image;
use Storage;
use App\Category;
use App\Administrator;
use Auth;
use File;

class ProductsController extends Controller
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

    public function index(Request $request)
    {

        $categories = Category::all();
        $cat_all = Category::where('name', 'All')->first();
        $products = Product::all();
        $sex="both";
        $selectedcategory=$cat_all->id;
        if(isset($request->selectgender)&&($request->selectgender!='Unisex')){ 
            $sex = $request->selectgender;
            //$products = Product::where('gender', $sex)->orderBy('id','desc')->paginate(6);
            if(isset($request->selectcategory)&&($request->selectcategory!=$cat_all->id)){
                $cat = Category::find($request->selectcategory);
                $selectedcategory = $cat->id;
                $products = Product::whereIn('gender', [$sex, 'Unisex'])->where('category_id', $cat->id)->orderBy('id','desc')->paginate(6);
            }
            else{
                $products = Product::whereIn('gender', [$sex, 'Unisex'])->orderBy('id','desc')->paginate(6);
            }
        } else {
            if(isset($request->selectcategory)&&($request->selectcategory!=$cat_all->id)){
                $cat = Category::find($request->selectcategory);
                $selectedcategory = $cat->id;
                $products = Product::where('category_id', $cat->id)->orderBy('id','desc')->paginate(6);
            } else {
                $products = Product::orderBy('id', 'desc')->paginate(6);
            }
        }

        //$products = Product::where('gender', $sex)->orderBy('id','desc')->paginate(6);
        //

        //if(isset($request->selectcategory)){
            //$cat = Category::find($request->selectcategory);
            //$products = $products->where('category_id', $cat->id);
            /*$tp=[];
            $i=0;
            $categories=Category::find($request->category);

            foreach($products as $product){
                if($product->category_id == $categories->category_id)
                    $tp[$i++] = $product;
            }

            $products = $tp;*/
        //}

            

        return view('products.index')->withProducts($products)->withSelected($sex)->withCategories($categories)->withSelectedcategory($selectedcategory)->withRole($this->role());
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->role() == "administrator"){
                $categories = Category::all();
                return view('products.create')->withCategories($categories)->withRole($this->role());
            }else
                return view('notauth')->withRole($this->role());
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
                'name' => 'required|max:255',
                'gender' => 'required',
                'price' => 'required',
                'category_id' => 'required|integer',
                'product_image' => 'sometimes|image'
            ]);


        //277x291 index
        //200x171 thumbnail
        //550x550 product
        $product = new Product();
        $product->name = $request->name;
        $product->gender = $request->gender;
        $product->category_id = $request->category_id;
        if($request->description != null)
            $product->description = $request->description;
        if($request->hasFile('product_image')){
            $image = $request->file('product_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('/images/product_images/' . $filename);
            $location_thumbnail = public_path('/images/product_images/product_thumbnails/' . $filename);
            $location_index_tn = public_path('/images/product_images/product_indextn/' . $filename);
            //Image::make($image)->resize(700,600)->save($location);
            Image::make($image)->fit(550,550)->save($location);
            Image::make($image)->fit(200,171)->save($location_thumbnail);
            Image::make($image)->fit(277,291)->save($location_index_tn);

            $product->image = $filename;
        }

        $gallery_images = $request->file('gallery_images');
        $gallery_count = 0;

        if(count($gallery_images)>0)
        {
            foreach($gallery_images as $gi){
                $filename = $gallery_count++ . time() . '.' . $gi->getClientOriginalExtension();
                File::exists('images/product_images/' . $product->name . '/') or 
                    File::makeDirectory('images/product_images/' . $product->name . '/');
                $location = public_path('images/product_images/' . $product->name . '/' . $filename);
                Image::make($gi)->fit(800,356)->save($location);
                File::exists('images/product_thumbnail_images/' . $product->name . '/') or 
                    File::makeDirectory('images/product_thumbnail_images/' . $product->name . '/');
                $location = public_path('images/product_thumbnail_images/' . $product->name . '/' . $filename);
                Image::make($gi)->fit(72,72)->save($location);
            }
        }

        $product->price = $request->price;

        if(isset($request->oldprice))
            $product->oldprice = $request->oldprice;

        $product->save();

        Session::flash('success', 'New Product Added');

        return redirect()->route('products.show', $product->id)->withRole($this->role());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $product = Product::find($id);
            $product_directory = 'images/product_images/' . $product->name;
            $product_thumbs = 'images/product_thumbnail_images/' . $product->name;
            if(File::exists($product_directory))
                $images = File::allFiles($product_directory);
            else
                $images = null;
            
            if(File::exists($product_thumbs))
                $thumbs = File::allFiles($product_thumbs);
            else
                $thumbs = $images;
            return view('products.show')->withProduct($product)->withImages($images)->withThumbs($thumbs)->withRole($this->role());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($this->role()=="administrator"){
                $categories = Category::all();
                /*$cats = [];
                foreach($categories as $category){
                    $cats[$category->id] = $category->name;
                }*/
                $product = Product::find($id);
                $cid = $product->category_id;
                return view('products.edit')->withProduct($product)->withCategories($categories)->withCid($cid)->withRole($this->role());
            }else
                return view('notauth')->withRole($this->role());
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
                'name' => 'required|max:255',
                'gender' => 'required',
                'price' => 'required',
                'category_id' => 'required|integer',
                'product_image' => 'sometimes|image'
            ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->gender = $request->gender;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        if($request->hasFile('product_image')){
            $image = $request->file('product_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('/images/product_images/' . $filename);
            Image::make($image)->resize(700,600)->save($location);

            Storage::delete(public_path('images/product_images/' . $product->image));

            $product->image = $filename;
        }

        if(isset($request->oldprice))
            $product->oldprice = $request->oldprice;

        $gallery_images = $request->file('gallery_images');
        $gallery_count = 0;

        if(count($gallery_images) > 0)
            if(File::exists('images/product_images/' . $product->name . '/'))
                File::deleteDirectory('images/product_images/' . $product->name . '/');

        foreach($gallery_images as $gi){
            $filename = $gallery_count++ . time() . '.' . $gi->getClientOriginalExtension();
            
            File::exists('images/product_images/' . $product->name . '/') or 
                File::makeDirectory('images/product_images/' . $product->name . '/');
            $location = public_path('images/product_images/' . $product->name . '/' . $filename);
            Image::make($gi)->fit(800,356)->save($location);
        }

        $product->save();

        Session::flash('success', 'Product information updated');

        return redirect()->route('products.show', $product->id)->withRole($this->role());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        //Storage::delete(public_path() . '/images/product_images/' . $product->image);
        //dd(public_path() . '\images\product_images\\' . $product->image);
        Storage::delete(public_path() . '\images\product_images\\' . $product->image);
        Storage::delete(public_path() . '\images\product_images\product_indextn\\' . $product->image);
        Storage::delete(public_path() . '\images\product_images\product_thumbnails\\' . $product->image);

        $product->delete();

        Session::flash('success', 'Product Deleted');

        return redirect()->route('products.index')->withRole($this->role());
    }
}
