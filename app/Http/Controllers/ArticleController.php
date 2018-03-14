<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('articles.index')->with(['articles' => Article::orderBy('created_at', 'desc')->get()]);
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
		$this->validate($request, [
			'title' => 'required',
			'body' => 'required'
		]);

		$input = $request->all();

		$article = new Article($input);
		$article->save();

		Session::flash('success', 'Artikel toegevoegd');
		return redirect()->route('nieuws.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\View\View
     */
    public function show(Article $article)
    {
        return view('articles.show')->with(['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\View\View
     */
    public function edit(Article $article)
    {
        return view('articles.edit')->with(['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
	    $this->validate($request, [
		    'title' => 'required',
		    'body' => 'required'
	    ]);

	    $input = $request->all();

	    $article->title = $input['title'];
	    $article->body = $input['body'];
	    $article->save();

	    Session::flash('success', 'Wijzigingen opgeslagen');
	    return redirect()->route('nieuws.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        Article::destroy($article);
        return redirect()->route('nieuws.index');
    }
}
