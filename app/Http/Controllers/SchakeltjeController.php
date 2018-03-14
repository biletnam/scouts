<?php

namespace App\Http\Controllers;

use App\Schakeltje;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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

	    $url = 'schakeltjes/'.$filename . '.'.$file->getClientOriginalExtension();

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
    	if ($schakeltje->archived) {
    		if (file_exists(public_path($schakeltje->url))) {
			    unlink(public_path($schakeltje->url));
		    }
    		$schakeltje->delete();
	    }
	    return redirect()->back();
    }

    public function archive(string $folder = '')
    {
    	$folders = Storage::disk('schakeltjes')->directories();
    	$schakeltjes = [];
    	foreach ($folders as $folder) {
    		$schakeltjes[$folder] = Schakeltje::where([['archived', '=', 1], ['url', 'LIKE', 'schakeltjes/' . $folder . '/%']])
		                                        ->orderBy('created_at', 'desc')->get();
	    }
    	return view('schakeltjes.archive')->with(['schakeltjes' => $schakeltjes]);
    }

    public function doArchive(Schakeltje $schakeltje)
    {
	    $year = $schakeltje->getStartingYear();

	    $file = new File(public_path($schakeltje->url));
	    Storage::makeDirectory(public_path('schakeltjes/' . $year . '-' . ($year+1)));
	    $file->move(public_path('schakeltjes/' . $year . '-' . ($year+1)));

	    $schakeltje->archived = 1;
	    $schakeltje->url = str_replace('schakeltjes', 'schakeltjes/' . $year . '-' . ($year+1), $schakeltje->url);
	    $schakeltje->save();

	    Session::flash('success', 'Schakeltje gearchiveerd');
	    return redirect()->back();
    }
}
