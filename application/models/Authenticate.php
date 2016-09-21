<?php
	class Authenticate extends MY_Model {
		
		static $table = 'leaders';
		static $pk = 'id';
		static $primary_filter = 'intval';
		static $order_by = 'id ASC';

		static $rules = array (
			'username' => array (
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'trim|required|valid_email'
			),
			'password' => array (
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required'
			)
		);

		static function validate($username, $password) {
			$CI =& get_instance();

			$user = self::get_by(array (
				'username'	=> $username,
				'password' 	=> self::hash($password),
			), TRUE, self::$table); //Limit to 1 user

			if (count($user)) {
				//log in user
				$leader = Leader::get_one($user->id);
				$data = array (
					'id'			=> $leader->id,
					'username'		=> $leader->username,
					'firstname'		=> $leader->firstname,
					'type'			=> $leader->type,
					'loggedin'		=> TRUE
				);
				$CI->session->set_userdata($data);
				return TRUE;
			}
			return FALSE;
		}

		static function is_logged_in() { 
			$CI =& get_instance();
			return (bool) $CI->session->userdata('loggedin');
		}

		static function logout() {
			$CI =& get_instance();
			$CI->session->sess_destroy();
			redirect('home');
		}

		static function hash($string) { return hash('sha512', $string.config_item('encryption_key')); }

		static function check_password($password, $username) {
			$CI =& get_instance();
			$data = $CI->db->query("SELECT password FROM leiding WHERE username='".$username."'")->result();
			
			$hash = self::hash($password);

			if($hash == $data[0]->password) {
				return TRUE;
			}
			else {
				return FALSE;
			}
		}

		static function reset_password($email, $newPass) {
			$ci =& get_instance();

			$new_hash = self::hash($newPass);
			$data = array('password' => $new_hash);

			$result = $CI->db
				->select('email')
				->from('Leiding')
				->where('email', $email)
				->get();

			if($result->num_rows() == 1)
			{
				$CI->db
					->where('email', $email)
					->update('leiding', $data);
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}

		static function get_rules() {
			return self::$rules;
		}
	}
?>