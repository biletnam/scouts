<?php
	class Article extends MY_Model {

		static $table = 'articles';
		static $pk = 'id';
		static $order_by = 'created DESC';
		static $timestamps = TRUE;

		static $rules = array (
			'title' => array(
				'field' => 'title',
				'label' => 'Title',
				'rules' => 'trim|required|max_length[100]'
			),
			'body' => array(
				'field' => 'body',
				'label' => 'Body',
				'rules' => 'trim|required'
			)
		);

		public function __construct() { parent::__construct(); }

		static function get_new() {
			$article = new stdClass();
			$article->title = '';
			$article->body = '';
			
			return $article;
		}

		static function get_frontpage() {
			$CI =& get_instance();

			return $CI->db
				->from(self::$table)
				->order_by(self::$order_by)
				->limit(2)
				->get()->result();
		}

		static function get_rules() {
			return self::$rules;
		}
	}
?>