<?php
	class Leader extends MY_model{
		static $order_by = 'id';
		static $table = 'leaders';
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

		static $reset_rules = array (
			'emailadres' => array (
				'field' => 'emailadres',
				'label' => 'E-mailadres',
				'rules' => 'trim|required|xss_clean|valid_email|match[bevestig_emailadres]'
			),
			'bevestig_emailadres' => array (
				'field' => 'bevestig_emailadres',
				'label' => 'Bevestig e-mailadres',
				'rules' => 'trim|required|xss_clean|valid_email|match[email]'
			)
		);

		static $pw_rules = array (
			'huidig_wachtwoord' => array (
				'field' => 'huidig_wachtwoord',
				'label' => 'Huidig wachtwoord',
				'rules' => 'trim'
			),
			'nieuw_wachtwoord' => array (
				'field' => 'nieuw_wachtwoord',
				'label' => 'Nieuw wachtwoord',
				'rules' => 'trim|matches[bevestig_wachtwoord]'
			),
			'bevestig_wachtwoord' => array (
				'field' => 'bevestig_wachtwoord',
				'label' => 'Bevestig wachtwoord',
				'rules' => 'trim|matches[nieuw_wachtwoord]'
			)
		);


		public function __construct() { parent::__construct(); $this->load->model('member'); }

		static function get_all() {
			$CI =& get_instance();
			$query = $CI->db
				->select('l.id, l.username, l.nickname, l.show_nick, l.active, l.member_id, l.img, m.firstname, m.name, m.gsm, m.tak')
				->from('leaders l')
				->join('members m', 'l.member_id = m.id', 'left')
				->where('l.member_id > 0')
				->order_by('m.firstname ASC')
				->get();

			$leaders = $query->result();

			foreach ($leaders as $leader) {
				$leader->grl = self::has_role('groepsleiding', $leader->id);
			}

			return $leaders;
		}

		static function get_users() {
			$leaders = self::get_all();

			$users = array (
				'admins' => array(),
				'webmasters' => array(),
				'leiding' => array()
			);

			foreach ($leaders as $leader) {
				switch ($leader->type) {
					case 'webmaster':
						$users['webmasters'][] = $leader;
						break;
					case 'admin':
						$users['admins'][] = $leader;
						break;
					default:
						$users['leiding'][] = $leader;
						break;
				}
			}

			return $users;
		}

		static function get_one($id) {
			$CI =& get_instance();

			$user = $CI->db
				->select('id, username, type, member_id, nickname, show_nick')
				->order_by(self::$order_by)
				->from(self::$table)
				->where('id', $id)
				->get()->row();

			$member = Member::get($user->member_id);
			if (count($member) != 0) {
				$user = (object) array (
					'id' => $user->id,
					'firstname' => $member->firstname,
					'name' => $member->name,
					'username' => $user->username,
					'nickname' => $user->nickname,
					'show_nick' => $user->show_nick,
					'type' => $user->type,
					'member_id' => $user->member_id,
				);
			}

			return $user;
		}

		static function get_by_tak($tak_id) {
			$CI =& get_instance();

			$query = $CI->db
				->select('l.id, l.username, l.nickname, l.show_nick, l.type, l.member_id, l.active, l.img, m.firstname, m.name, m.address, m.zip, m.city, m.gsm, m.tak')
				->from('leaders l')
				->join('members m', 'l.member_id = m.id', 'left')
				->where('l.member_id > 0')
				->where('l.tak_id', $tak_id)
				->order_by('m.firstname ASC')
				->get();

			$leaders = $query->result();

			foreach ($leaders as $leader) {
				$leader->takleiding = self::has_role('takleiding', $leader->id);
			}

			return $leaders;
		}

		static function get_rules() { return self::$edit_rules; }

		static function get_new() {
			$user = new stdClass();
			$user->name = '';
			$user->email = '';
			$user->account = '';
			$user->description = '';
		}

		static function get_permissions($id = false) {
			$CI =& get_instance();
			$CI->load->library('session');

			$id = intval($CI->session->userdata('id'));

			echo $id;
			exit();

			$roles = self::get_roles($id);
			$permissions = array();

			foreach ($roles as $role) {
				$rp = self::get_role_permissions($role->id);
				foreach ($rp as $p) {
					if (!in_array($p->name, $permissions)) {
						$permissions[] = $p->name;
					}
				}
			}

			return $permissions;
		}

		static function get_roles($id = false) {
			$CI =& get_instance();

			if (!$id) {  }

			$query = $CI->db
				->select('r.id, r.name, r.description')
				->from('roles r')
				->join('leader_roles lr', 'lr.role_id = r.id', 'left')
				->where('lr.leader_id', $id)
				->get();

			$roles = $query->result();

			return $roles;
		}
		
		static function has_permission($permission) {
			$CI =& get_instance();
			$CI->load->library('session');

			$id = $CI->session->userdata('id');

			$roles = self::get_roles($id);
			$permissions = array();

			foreach ($roles as $role) {
				$rp = self::get_role_permissions($role->id);
				foreach ($rp as $p) {
					if (!in_array($p->name, $permissions)) {
						$permissions[] = $p->name;
					}
				}
			}

			if (in_array($permission, $permissions)) { return TRUE; }
			else { return FALSE; }
		}

		static function has_role($role, $id = false) {
			$CI =& get_instance();
			if (!$id) { $id = $CI->session->userdata('id'); }

			$roles = self::get_roles($id);

			foreach ($roles as $r) {
				if ($r->name == $role) {
					return TRUE;
				}
			}
			return FALSE;
		}

		static function get_role_permissions($id) {
			$CI =& get_instance();

			$query = $CI->db
				->select('p.id, p.name, p.description')
				->from('permissions p')
				->join('role_permissions rp', 'rp.permission_id = p.id', 'left')
				->where('rp.role_id', $id)
				->get();

			$permissions = $query->result();

			return $permissions;
		}
	}
?>