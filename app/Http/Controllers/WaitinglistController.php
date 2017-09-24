<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Excel;
use Session;

use App\Waitinglist;

class WaitinglistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('waitinglist.index')->with(['waitinglist' => Waitinglist::byTak()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request, string $tak)
    {
    	$priority = $request->get('p');
    	$tak = ($tak === 'jojos') ? 'Jojo\'s' : ucfirst($tak);
        return view('waitinglist.create')->with(['tak' => $tak, 'priority' => $priority]);
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
            'firstname' => 'required',
            'name'      => 'required|max:255',
            'birthdate' => 'required|max:255',
            'address'   => 'required|max:255',
            'zip'       => 'required|max:10',
            'city'      => 'required|max:255',
            'tel'       => 'min:9',
            'gsm'       => 'min:10',
            'email'     => 'email',
            'tak'       => 'required|max:255',
            'year'      => 'required|max:255'
        ]);

        $input = $request->all();

        $waitinglist = new Waitinglist($input);
        $waitinglist->save();

        Session::flash('success', $waitinglist->firstname.' '.$waitinglist->name.' toegevoegd');
        return redirect()->route('wachtlijst.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Waitinglist  $waitinglist
     * @return \Illuminate\View\View
     */
    public function show(Waitinglist $waitinglist)
    {
        return view('waitinglist.show')->with(['kid' => $waitinglist]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Waitinglist  $waitinglist
     * @return \Illuminate\View\View
     */
    public function edit(Waitinglist $waitinglist)
    {
        return view('waitinglist.edit')->with(['kid' => $waitinglist]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Waitinglist  $waitinglist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Waitinglist $waitinglist)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'name'      => 'required|max:255',
            'birthdate' => 'required|max:255',
            'address'   => 'required|max:255',
            'zip'       => 'required|max:10',
            'city'      => 'required|max:255',
            'tel'       => 'min:9',
            'gsm'       => 'min:10',
            'email'     => 'email',
            'tak'       => 'required|max:255',
            'year'      => 'required|max:255'
        ]);

        $input = $request->all();

        $waitinglist->firstname  = $input['firstname'];
        $waitinglist->name       = $input['name'];
        $waitinglist->birthdate  = $input['birthdate'];
        $waitinglist->address    = $input['address'];
        $waitinglist->zip        = $input['zip'];
        $waitinglist->city       = $input['city'];
        $waitinglist->tel        = $input['tel'];
        $waitinglist->gsm        = $input['gsm'];
        $waitinglist->email      = $input['email'];
        $waitinglist->tak        = $input['tak'];
        $waitinglist->year       = $input['year'];

        $waitinglist->save();

        Session::flash('success', $waitinglist->firstname.' '.$waitinglist->name.' gewijzigd');
        return redirect()->route('wachtlijst.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Waitinglist  $waitinglist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Waitinglist $waitinglist)
    {
        $waitinglist->delete();
        Session::flash('success', $waitinglist->firstname.' '.$waitinglist->name.' verwijderd');
        return redirect()->route('wachtlijst.index');
    }

    public function excelify() {
	    Excel::create('wachtlijst '.date('d m Y'), function ($excel) {

		    // Set the title
		    $excel->setTitle('wachtlijst');
		    // Chain the setters
		    $excel->setCreator('18bp.be')
			    ->setCompany('18BP');
		    // Call them separately
		    $excel->setDescription('Up-to-date wachtlijst');

		    $excel->sheet('wachtlijst', function ($sheet) {
			    $members = Waitinglist::byTak();
			    $sheet->loadView('excel.waitinglist')->with('members', $members);
		    });
	    })->export('xls');
    }

	public function doOvergang() {
		if (Auth::user()->hasPermission('administratie')) {
			$waitinglists = Waitinglist::get();
			foreach ($waitinglists as $waitinglist) {
				/** @var Member $member */
				switch ($waitinglist->year) {
					case 2:
						if ($waitinglist->tak === 'Kapoenen') {
							$waitinglist->toNextTak();
						} else {
							$waitinglist->year++;
							$waitinglist->save();
						}
						break;
					case 3:
						$waitinglist->toNextTak();
						break;
					default:
						$waitinglist->year++;
						$waitinglist->save();
						break;
				}
			}
			return redirect()->route('wachtlijst.index');
		} else {
			abort(404);
		}
	}

	public function undoOvergang() {
		if (Auth::user()->hasPermission('administratie')) {
			$waitinglists = Waitinglist::get();
			foreach ($waitinglists as $waitinglist) {
				/** @var Member $member */
				if ($waitinglist->year === 1) {
					$waitinglist->toPreviousTak();
				} else {
					$waitinglist->year--;
					$waitinglist->save();
				}
			}
			return redirect()->route('wachtlijst.index');
		} else {
			abort(404);
		}
	}
}
