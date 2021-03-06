<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Tak;
use App\User;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.index')->with(['articles' => Article::orderBy('created_at', 'desc')->limit(2)->get()]);
    }

    public function inschrijven()
    {
    	return view('pages.inschrijven');
    }

    public function den18()
    {
    	return view('den18.index')->with([
    		'takken' => Tak::where('active', 1)->get(),
		    'leaders' => User::where('username', '!=', 'leiding@18bp.be')->get()]);
    }

    public function geschiedenis()
    {
    	return view('den18.geschiedenis');
    }

    public function uniform()
    {
    	return view('den18.uniform');
    }

    public function drankdrugs()
    {
    	return view('den18.drankendrugs');
    }

    public function contact()
    {
    	return view('pages.contact');
    }

    public function dashboard()
    {
    	return view('pages.dashboard');
    }

    public function nuttig()
    {
    	return view('pages.nuttig');
    }
}
