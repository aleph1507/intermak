<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Image;
use Storage;
use App\Article;
use Auth;
use App\Administrator;
//use Auth;

class ArticlesController extends Controller
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
        $articles = Article::orderBy('id','desc')->paginate(5);
        return view('articles.index')->withArticles($articles)->withRole($this->role());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if($this->role() == "administrator")
            return view('articles.create')->withRole($this->role());
        else
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
                'title' => 'required|max:255',
                'body' => 'required',
                'featured_image' => 'sometimes|image'
            ]);

        $article = new Article();
        $article->title = $request->title;
        $article->body = $request->body;

        if($request->hasFile('featured_image')){
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('/images/article_images/' . $filename);
            $location_thumbnail = public_path('/images/article_images/thumbnails/' . $filename);
            Image::make($image)->fit(800, 400)->save($location);
            Image::make($image)->fit(100, 100)->save($location_thumbnail);

            $article->image = $filename;
        }

        $article->save();

        Session::flash('success', 'Article saved.');

        return redirect()->route('articles.show', $article->id)->withRole($this->role());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return view('articles.show')->withArticle($article)->withRole($this->role());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($this->role() == "administrator"){
                $article = Article::find($id);
                return view('articles.edit')->withArticle($article)->withRole($this->role());
            }else{
                return view('notauth')->withRole($this->role());
            }
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
                'title' => 'required|max:255',
                'body' => 'required',
                'featured_image' => 'sometimes|image'
            ]);

        $article = Article::find($id);

        $article->title = $request->title;
        $article->body = $request->body;

        if($request->hasFile('featured_image')){
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/article_images/' . $filename);
            Image::make($image)->resize(800,400)->save($location);

            Storage::delete(public_path('images/article_images/' . $article->image));

            $article->image = $filename;
        }

        $article->save();

        Session::flash('success', 'Article Updated');

        return redirect()->route('articles.show', $article->id)->withRole($this->role());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
 
        Storage::delete(public_path() . '/images/article_images/' . $article->image);

        $article->delete();

        Session::flash('success', 'Article Deleted');

        return redirect()->route('articles.index')->withRole($this->role());
    }
}
