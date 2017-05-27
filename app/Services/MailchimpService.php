<?php

namespace App\Services;

use Newsletter;
use App\Tak;

class MailchimpService
{
	private const LIST_GENERAL = 'general';
	private const LIST_SCHAKELTJE = 'schakeltje';
	
	public function __construct() {	}

	/**
	 * @param string $email
	 * @param Tak $tak
	 **/
	private function addContact($email, Tak $tak) {
		$tak = ($tak->name == 'Jojo\'s') ? 'jojos' : strtolower($tak->name);
		Newsletter::subscribe($email, self::LIST_GENERAL);
		Newsletter::subscribe($email, self::LIST_SCHAKELTJE);
		Newsletter::subscribe($email, $tak);
	}

	/**
	 * @param string $email
	 * @param Tak $tak
	 */
	protected function removeContact($email, Tak $tak) {
		$tak = ($tak->name == 'Jojo\'s') ? 'jojos' : strtolower($tak->name);
		Newsletter::unsubscribe($email, self::LIST_GENERAL);
		Newsletter::unsubscribe($email, self::LIST_SCHAKELTJE);
		Newsletter::unsubscribe($email, $tak);
	}

	/**
	 * @param string $email
	 * @param string $list
	 **/
	protected function subscribe($email, $list) {
		Newsletter::subscribe($email, $list);
	}

	/**
	 * @param string $email
	 * @param string $list
	 **/
	protected function unsubscribe($email, $list) {
		Newsletter::unsubscribe($email, $list);
	}
}
