<?php
	class MY_model extends CI_Model {

		static $table = '';
		static $pk = '';
		static $primary_filter = 'intval';
		static $order_by = '';
		static $timestamps = FALSE;

		public function __construct() { parent::__construct(); }

		static function array_from_post($fields) {
			$CI =& get_instance();

			$data = array();
			foreach ($fields as $field) {
				$data[$field] = $CI->input->post($field);
			}
			return $data;
		}

		static function get($id = NULL, $single = FALSE){
			$CI =& get_instance();

			if ($id != NULL) {
				$filter = static::$primary_filter;
				$id = $filter($id);
				$CI->db->where(static::$pk, $id);
				$method = 'row';
			}
			elseif ($single == TRUE) {
				$method = 'row';
			}
			else {
				$method = 'result';
			}

			return $CI->db
				->order_by(static::$order_by)
				->get(static::$table)
				->$method();
		}

		static function get_by($where, $single = FALSE) {
			$CI =& get_instance();
			$CI->db->where($where);
			return self::get(NULL, $single);
		}

		static function save($data, $id = NULL) {
			$CI =& get_instance();

			//Timestamps
			if (static::$timestamps == TRUE) {
				$id || $data['created'] = date('Y-m-d H:i:s');
				//$data['modified'] = date('Y-m-d H:i:s');
			}
			//if id = null -> method = CREATE / if id =/= null -> method = UPDATE
			//CREATE
			if ($id == NULL) {
				
				!isset($data[static::$pk]) || $data[$this->pk] = NULL;
				$CI->db
					->set($data)
					->insert(static::$table); 
				$id = $CI->db->insert_id();
			}
			//UPDATE
			else {
				$filter = static::$primary_filter;
				$id = $filter($id);
				$CI->db
					->where(static::$pk, $id)
					->set($data)
					->update(static::$table);
			}

			return $id;
		}

		static function delete($id) {
			$CI =& get_instance();

			$filter = self::$primary_filter;
			$id = $filter($id);

			if (!$id) {
				//added for extra security -> no id? no action!
				return FALSE;
			}
			else {
				$CI->db
					->where(static::$pk, $id)
					->limit(1)
					->delete(static::$table);
			}
		}

		static function limitResult($limit, $start) {
			$CI =& get_instance();
			$CI->db->limit($limit, $start);
		}

		static function count_all($where = NULL) {
			$CI =& get_instance();
			$query = $CI->db->get_where(self::$table, $where);
			
			return $query->num_rows();
		}
	}
?>