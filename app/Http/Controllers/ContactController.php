<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;
use App\Member;

class ContactController extends Controller
{
	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  Member  $member
	 * @return \Illuminate\Http\View
	 */
	public function create(Member $member)
	{
		return view('contacts.create')->with(['member' => $member]);
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
			'name'	=> 'required|max:255',
			'email'	=> 'email'
		]);

		$input = $request->all();
		$contact = new Contact($input);
		$contact->save();

		return redirect()->route('ledenlijst.edit', [$contact->member_id]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Contact  $contact
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Contact $contact)
	{
		return view('contacts.edit')->withContact($contact);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  Contact  $contact
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Contact $contact)
	{
		$this->validate($request, [
			'name'	=> 'required|max:255',
			'email'	=> 'email'
		]);

		$input = $request->all();

		$contact->name = $input['name'];
		$contact->tel = $input['tel'];
		$contact->gsm = $input['gsm'];
		$contact->email = $input['email'];
		$contact->save();

		return redirect()->route('ledenlijst.edit', [$contact->member_id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Contact  $contact
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Contact $contact)
	{
		$contact->delete();
		return redirect()->back();
	}
}
