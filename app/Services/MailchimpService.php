<?php

namespace App\Services;

use App\Tak;
use Newsletter;

/**
 * @property  mailchimp
 */
class MailchimpService
{
	const LIST_SCHAKELTJE = 'schakeltje';
	const TEMPLATE_ID = 69399;

	public function __construct() {
		$this->mailchimp = Newsletter::getApi();
		$this->test = config('laravel-newsletter.lists.test.id');
		$this->general = config('laravel-newsletter.lists.general.id');
		$this->schakeltje = config('laravel-newsletter.lists.schakeltje.id');
		$this->kapoenen = config('laravel-newsletter.lists.kapoenen.id');
		$this->welpen = config('laravel-newsletter.lists.welpen.id');
		$this->jojos = config('laravel-newsletter.lists.jojos.id');
		$this->givers = config('laravel-newsletter.lists.givers.id');
	}

	/**
	 * @param string $email
	 * @param Tak $tak
	 **/
	public function addContact($email, Tak $tak) {
		$tak = ($tak->name == 'Jojo\'s') ? 'jojos' : strtolower($tak->name);
		Newsletter::subscribe($email);
		Newsletter::subscribe($email, [], self::LIST_SCHAKELTJE);
		if ($tak != 'leiding' && $tak != 'jins') {
			Newsletter::subscribe($email, [], $tak);
		}
	}

	/**
	 * @param string $email
	 * @param Tak $tak
	 */
	public function removeContact($email) {
		foreach (config('laravel-newsletter.lists') as $list => $list_id) {
			Newsletter::unsubscribe($email, $list);
		}
	}

	/**
	 * @param string $email
	 * @param string $list
	 **/
	public function subscribe($email, $list) {
		Newsletter::subscribe($email, [], $list);
	}

	/**
	 * @param string $email
	 * @param string $list
	 **/
	public function unsubscribe($email, $list) {
		Newsletter::unsubscribe($email, $list);
	}

	/**
	 * @return array
	 */
	public function getLists() {
		$lists = [
			self::getList($this->general),
			self::getList($this->test),
			self::getList($this->schakeltje),
			self::getList($this->kapoenen),
			self::getList($this->welpen),
			self::getList($this->jojos),
			self::getList($this->givers)
		];
		foreach ($lists as $key => $list) {
			$lists[$key] = self::getMembersForList($list);
		}
		return $lists;
	}

	/**
	 * @return array
	 */
	public function getList($id) {
		$list = self::getMembersForList($this->mailchimp->get('lists/'.$id.'?sort_field=date_created'));
		return $list;
	}

	protected function getMembersForList($list) {
		$list['members'] = $this->mailchimp->get('lists/'.$list['id'].'/members')['members'];
		return $list;
	}

	public function makeCmpaign($list, $subject) {
		$list_senders = [
			$this->general      => 'groepsleiding@18bp.be',
			$this->test         => 'groepsleiding@18bp.be',
			$this->schakeltje   => 'redactie@18bp.be',
			$this->kapoenen     => 'kapoenenleiding@18bp.be',
			$this->welpen       => 'welpenleiding@18bp.be',
			$this->jojos        => 'jojoleiding@18bp.be',
			$this->givers       => 'giverleiding@18bp.be',
		];

		$data = [
			'type' => 'regular',
			'recipients' => ['list_id' => $list],
			'settings' => [
				'subject_line' => $subject,
				'title' => $subject,
				'from_name' => '18BP Corneel Mayné',
				'reply_to' => $list_senders[$list],
				'auto_footer' => false,
			]
		];

		return $this->mailchimp->post('campaigns', $data);
	}

	public function sendCampaign(string $body, string $subject, $list) {
		$campaign = self::makeCmpaign($list,$subject);
		$data = [
			'template' => [
				'id' => self::TEMPLATE_ID,
				'sections' => [
					'body' => $body,
					'header' => '<h2 style="text-align: right; color: #fff;">'.$subject.'</h2>'
				]
			],
		];
		$this->mailchimp->put('campaigns/'.$campaign['id'].'/content', $data);
		return $this->mailchimp->post('campaigns/'.$campaign['id'].'/actions/send');
	}
}
