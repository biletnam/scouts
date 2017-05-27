<?php

namespace App\Http\Controllers;

use App\Services\MailchimpService;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * @property MailchimpService mailchimpService
 */
class MailinglistController extends Controller
{
	public function __construct() {
		$this->mailchimpService = new MailchimpService();
	}

	/**
	 * @return View
	 */
	public function index() {
		$lists = $this->mailchimpService->getLists();
    	return view('mailinglists.index')->withLists($lists);
    }

	/**
	 * @return View
	 */
	public function show(string $id) {
		$list = $this->mailchimpService->getList($id);
    	return view('mailinglists.show')->withList($list);
    }
}
