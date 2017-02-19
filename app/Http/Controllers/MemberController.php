<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('members.index')->with(['members' => Member::byTak()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
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

        $member = new Member($input);
        $member->save();

        Session::flash('success', 'Lid succesvol toegevoegd');
        return redirec()->route('members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
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

        $member = new Member($input);
        $member->save();

        Session::flash('success', 'Lid succesvol toegevoegd');
        return redirec()->route('members.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        Member::destroy($member);
        return redirect()->route('members.index');
    }
}
