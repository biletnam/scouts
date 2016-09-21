<?php
	class Tak extends MY_model{
		static $order_by = 'id';
		static $table = 'takken';
		static $pk = 'id';

		static $edit_rules = array (
			'username' => array (
				'field' => 'username',
				'label' => 'Gebruikersnaam',
				'rules' => 'trim|required|valid_email'
			),
			'nickname' => array (
				'field' => 'nickname',
				'label' => 'Kapoenen -of welpennaam',
				'rules' => 'trim'
			),
			'type' => array (
				'field' => 'type',
				'label' => 'type',
				'rules' => 'trim|required'
			)
		);


		public function __construct() { parent::__construct(); $this->load->model('member'); }

		static function get_all() {
			$CI =& get_instance();
			$query = $CI->db
				->select('*')
				->from('takken')
				->get();

			$takken = $query->result();

			foreach ($takken as $tak) {
				$tak->leaders = Leader::get_by_tak($tak->id);
			}

			return $takken;
		}

		static function get_rules() { return self::$edit_rules; }

		static function get_new() {
			$user = new stdClass();
			$user->voornaam = '';
			$user->naam = '';
			$user->gebruikersnaam = '';
			$user->wachtwoord = '';
			$user->type = '';
		}
	}
?>