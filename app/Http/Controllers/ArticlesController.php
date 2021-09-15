<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at','desc')->paginate(2);
        return view('articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

            'title' => 'required',

            'body' => 'required|max:3500',

            'image' => 'nullable|image|max:1999',
        ],
        [
            'title.required' => 'Enter a descriptive heading for your Article',

            'body.required' => 'The content section is required',
        ]);
        if ($request->hasFile('image')) {

           $file = $request->file('image')->getClientOriginalName();

           $name = $file.'.'.time();

           $path = $request->file('image')->storeAs('articles',$name,'public');
        }
        else {
            $name = 'noimage.jpg';
        }
        $article = new Article();

        $article->title = Str::of($request->input('title'))->trim()->ucfirst();

        $article->body = Str::of($request->input('body'))->trim()->ucfirst();

        $article->user_id = Auth::user()->id;

        $article->image = $name;

        $article->save();

        return redirect('/articles')->with('success','Article created successfully');
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
        return view('articles.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('articles.edit',compact('article'));
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
        $this->validate($request,[

            'title' => 'required',

            'body' => 'required|max:3500',

            'image' => 'nullable|image|max:1999',
        ],
        [
            'title.required' => 'Enter a descriptive heading for your Article',

            'body.required' => 'The content section is required',
        ]);
        if ($request->hasFile('image')) {

           $file = $request->file('image')->getClientOriginalName();

           $name = $file.'.'.time();

           $path = $request->file('image')->storeAs('articles',$name,'public');
        }
        else {
            $name = 'noimage.jpg';
        }
        $article = Article::find($id);

        $article->title = Str::of($request->input('title'))->trim()->ucfirst();

        $article->body = Str::of($request->input('body'))->trim()->ucfirst();

        $article->user_id = Auth::user()->id;

            if ($request->hasFile('image')) {

                $article->image =$name;
            }
        $article->save();
        return redirect('/articles')->with('success','Article upated successfully');



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
            if (Auth::user()->id === $article->user->id) {
            Storage::delete('storage/articles/'.$article->image);
              $article->delete();
            }
            else {
                return back();
            }
            return redirect()->route('home');
    }
}
