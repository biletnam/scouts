<?php

namespace App\Http\Controllers;

use App\Schakeltje;
use Illuminate\Http\Request;
use Session;

class SchakeltjeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('schakeltjes.index')->with(['schakeltjes' => Schakeltje::where('archived', 0)->orderBy('created_at', 'desc')->get()]);
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
        	'title' => 'max:255',
        	'file'  => 'required|mimetypes:application/pdf|max:16384'
        ]);

	    $file = $request->file('file');

	    $filename = $request->get('title');

	    if ($filename != '' && $filename != null) {
	    	$file->move(public_path('schakeltjes/'), $filename.'.pdf');
	    } else {
	    	$filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file->getClientOriginalName());
		    $file->move(public_path('schakeltjes'), $file->getClientOriginalName());
	    }

	    $url = asset('schakeltjes/'.$filename) . '.'.$file->getClientOriginalExtension();

	    $schakeltje = new Schakeltje([
	    	'title' => $filename,
			'url'    => $url
	    ]);
	    $schakeltje->save();

	    Session::flash('success', 'Schakeltje toegevoegd');
	    return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schakeltje  $schakeltje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schakeltje $schakeltje)
    {

	    $schakeltje = Schakeltje::find($schakeltje);

	    $file = new File(asset($schakeltje->url));
	    $file->move(asset('schakeltjes/archive'));

	    $schakeltje->archived = 1;
	    $schakeltje->url = str_replace('schakeltjes', 'schakeltjes/archive', $schakeltje->url);
	    $schakeltje->save();

	    Schakeltje::destroy($schakeltje->id);

	    Session::flash('success', 'Schakeltje gearchiveerd');
	    return redirect()->back();
    }
}
