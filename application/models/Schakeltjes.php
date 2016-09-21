<?php
	class Schakeltjes extends MY_Model
	{
		static $table = 'schakeltjes';
		static $primary_key = 'id';
		static $order_by = 'created desc';
		static $timestamps = TRUE;

		public function __construct() { parent::__construct(); }

		static function get_all() {
			$CI =& get_instance();
			$query = $CI->db->select('*')
				->from(self::$table)
				->order_by(self::$order_by)
				->get();

			return $query->result();
		}

		static function add($name)
		{
			$data['name'] = $name;
			self::save($data);
		}
		static function delete_schakel($id) {
			$CI =& get_instance();

			$folder = base_url().'Schakeltje/'.date('Y');
			if (!file_exists($folder)) {
				mkdir($folder);
			}

			$result = $CI->db->select('naam')
				->from($_table_name)
				->where('pk_schakel_id', $id)
				>get()->result();
			$naam = $result[0]->naam;

			$CI->load->library('ftp');
			$CI->ftp->move(base_url().'Schakeltje/'.$naam.'.pdf', $folder.'/'.$naam.'.pdf');
			//unlink('./Schakeltje/'.$name.'.pdf');
			self::delete($id);
		}
	}
?>