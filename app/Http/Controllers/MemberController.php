<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Excel;
use Session;

use App\Contact;
use App\Member;
use App\Tak;

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
		return view($view)->withMembers($members);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create($tak)
	{
		$tak = Tak::where('name', 'LIKE', '%'.$tak.'%')->first();
		return view('members.create')->withTak($tak);
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
			'firstname'         => 'required',
			'name'              => 'required|max:255',
			'birthdate'         => 'required|max:255',
			'address'           => 'required|max:255',
			'zip'               => 'required|max:10',
			'city'              => 'required|max:255',
			'tel'               => 'min:9',
			'gsm'               => 'min:10',
			'contact[email]'    => 'email',
			'tak_id'            => 'required',
			'year'              => 'required|max:255'
		]);

		$input = $request->all();

		$contact = $input['contact'];
		unset($input['contact']);

		$member = new Member($input);
		$member->save();

		if ($input['own_contact'] === 1) {
			$input['email'] = $contact['email'];
			$input['tel'] = $contact['tel'];
			$input['gsm'] = $contact['gsm'];
		} else {
			$contact = new Contact($contact);
			$contact->member_id = $member->id;
			$contact->save();

			$member->contacts()->attach($contact->id);
		}

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
		return view('members.show')->withMember($member);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Member  $member
	 * @return \Illuminate\View\View
	 */
	public function edit(Member $member)
	{
		return view('members.edit')->with(['member' => $member, 'takken' => Tak::get()]);
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
			'firstname'	=> 'required',
			'name'		=> 'required|max:255',
			'birthdate'	=> 'required|max:255',
			'address'	=> 'required|max:255',
			'zip'		=> 'required|max:10',
			'city'		=> 'required|max:255',
			'tak_id'	=> 'required',
			'year'		=> 'required'
		]);

		$input = $request->all();

		$member->firstname	= $input['firstname'];
		$member->name		= $input['name'];
		$member->birthdate	= $input['birthdate'];
		$member->address	= $input['address'];
		$member->zip		= $input['zip'];
		$member->city		= $input['city'];
		$member->tel		= $input['tel'];
		$member->gsm		= $input['gsm'];
		$member->email		= $input['email'];
		$member->tak_id		= $input['tak_id'];
		$member->year		= $input['year'];
		$member->paid		= isset($input['paid']);

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

	/**
	 * Get the Select2 options based on query
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return string
	**/
	public function getAjax(Request $request) {
		return Member::getAjax($request->get('q'));
	}

	public function print(Request $request, string $tak) {
		if ($tak === 'jojos') { $tak = 'Jojo\'s'; }
		else { $tak = ucfirst($tak); }

		if ($_SERVER['REQUEST_METHOD'] === 'POST') { $args = $request->only('birthdate', 'email', 'tel', 'gsm', 'year'); }
		else { $args = []; }

		$tak = Tak::where('name', $tak)->first();
		return view('members.print')->with(['tak' => $tak, 'args' => $args]);
	}
}
