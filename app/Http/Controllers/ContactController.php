<?php

namespace App\Http\Controllers;

use App\Services\MailchimpService;
use Illuminate\Http\Request;

use App\Contact;
use App\Member;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  Member  $member
	 * @return \Illuminate\View\View
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
			'name'	=> 'required_if:existing,0|max:255'
		]);

		$input = $request->all();
		$member = Member::find($input['member_id']);
		$mailchimpService = new MailchimpService();

		if ($input['existing']) {
			if (!is_array($input['contacts'])) {
				$input['contacts'] = [$input['contacts']];
			}
			foreach ($input['contacts'] as $contactId) {
				$contact = Contact::find($contactId);
				$member->contacts()->attach($contact->id);
				$mailchimpService->addContact($contact->email, $member->tak);
			}
		} else {
			$contact = new Contact($input);
			$contact->save();

			$member->contacts()->attach($contact->id);
			$mailchimpService->addContact($contact->email, $member->tak);
		}

		return redirect()->route('ledenlijst.edit', [$member->id]);
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

		return redirect()->route('ledenlijst.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Contact  $contact
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Contact $contact)
	{
		$mailchimpService = new MailchimpService();
		$mailchimpService->removeContact($contact->email);

		$contact->delete();
		return redirect()->back();
	}

	public function getContactsByMemberId($memberId)
	{
		/** @var Member $member */
		$member = Member::find($memberId);
		return json_encode($member->contacts);
	}
}
