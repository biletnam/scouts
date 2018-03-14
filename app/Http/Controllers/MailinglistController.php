<?php

namespace App\Http\Controllers;

use App\Services\MailchimpService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

/**
 * @property MailchimpService mailchimpService
 */
class MailinglistController extends Controller
{
	public function __construct()
	{
		$this->mailchimpService = new MailchimpService();
	}

	/**
	 * @return View
	 */
	public function index()
	{
		$lists = $this->mailchimpService->getLists();
    	return view('mailinglists.index')->withLists($lists);
    }

	/**
	 * @return View
	 */
	public function show(string $id)
	{
		$list = $this->mailchimpService->getList($id);
    	return view('mailinglists.show')->withList($list);
    }

    public function newCampaign($list = null)
    {
		if ($list === null) {
			$lists = $this->mailchimpService->getLists();
			return view('mailinglists.campaign-create')->with(['lists' => $lists]);
		}
		return view('mailinglists.campaign-create')->with(['list' => $list]);
    }

    public function sendCampaign(Request $request)
    {
		$this->validate($request, [
			'subject'   => 'required|max:255',
			'body'      => 'required',
			'list'      => 'required'
		]);

		$input = $request->all();
		$callback = $this->mailchimpService->sendCampaign($input['body'],$input['subject'], $input['list']);

		if ($callback === false) {
			Session::flash('success', 'Mailcampagne verzonden!');
		} else {
			Session::flash('error', 'Er is iets fout gelopen bij het verzenden van de mail.');
		}
		return redirect()->route('mailinglijst.index');
    }

    public function testCampaign(Request $request)
    {
    	$this->validate($request, [
		    'subject'  => 'required|max:255',
		    'body' => 'required',
		    'emails' => 'required',
		    'emails.*' => 'email'
	    ]);

    	$input = $request->all();
		$callback = $this->mailchimpService->testCampaign($input['body'],$input['subject'], $input['list'], $input['emails']);

	    if ($callback === false) {
		    Session::flash('success', 'Mailcampagne verzonden!');
	    } else {
		    Session::flash('error', 'Er is iets fout gelopen bij het verzenden van de mail.');
	    }
	    return json_encode($callback);
    }

    public function addSubscriber(Request $request, string $list)
    {
    	$this->mailchimpService->subscribe($request->get('email'), $list);
    	return redirect()->back();
    }

    public function removeSubscriber(Request $request, string $list)
    {
    	$this->mailchimpService->unsubscribe($request->get('email'), $list);
    }
}
