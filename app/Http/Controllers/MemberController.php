<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Excel;
use Session;

use App\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $view = 'members.tak';
        if (Auth::user()->hasPermission('administratie')) {
            $members = Member::byTak();
            $view = 'members.index';
        }
        else { $members = Member::where(['tak_id' => Auth::user()->member()->tak_id, 'leiding' => 0])->get(); }
        return view($view)->with(['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($tak)
    {
    	$tak = Tak::where('name', 'LIKE', '%'.$tak.'%')->first();
        return view('members.create')->with(['tak' => $tak]);
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
            'tak_id'    => 'required',
            'year'      => 'required|max:255'
        ]);

        $input = $request->all();

        $member = new Member($input);
        $member->save();

        Session::flash('success', 'Lid succesvol toegevoegd');
        return redirect()->route('ledenlijst.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\View\View
     */
    public function show(Member $member)
    {
        return view('members.show')->with(['member' => $member]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('members.edit')->with(['member' => $member]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'name' => 'required|max:255',
            'birthdate' => 'required|max:255',
            'address' => 'required|max:255',
            'zip' => 'required|max:10',
            'city' => 'required|max:255',
            'tel' => 'min:9',
            'gsm' => 'min:10',
            'email' => 'email',
            'tak' => 'required|max:255',
            'year' => 'required|max:255'
        ]);

        $input = $request->all();

        $member->firstname  = $input['firstname'];
        $member->name       = $input['name'];
        $member->birthdate  = $input['birthdate'];
        $member->address    = $input['address'];
        $member->zip        = $input['zip'];
        $member->city       = $input['city'];
        $member->tel        = $input['tel'];
        $member->gsm        = $input['gsm'];
        $member->email      = $input['email'];
        $member->tak        = $input['tak'];
        $member->year       = $input['year'];

        $member->save();

        Session::flash('success', 'Lid succesvol gewijzigd');
        return redirect()->route('ledenlijst.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('ledenlijst.index');
    }

    public function togglePaid(Request $request, $id) {
        $member = Member::find($id);
        $member->paid = !$member->paid;
        $member->save();
    }

    public function excelify() {
        Excel::create('Ledenlijst '.date('d m Y'), function ($excel) {

            // Set the title
            $excel->setTitle('Ledenlijst');
            // Chain the setters
            $excel->setCreator('18bp.be')
                ->setCompany('18BP');
            // Call them separately
            $excel->setDescription('Up-to-date ledenlijst');

            $excel->sheet('Ledenlijst', function ($sheet) {
                $members = Member::byTak();
                $sheet->loadView('excel.members')->with('members', $members);
            });
        })->export('xls');
    }
}
