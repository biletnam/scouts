<?php
	class Member extends MY_Model {
		static $table = 'members';
		static $pk = 'id';
		static $order_by = 'firstname ASC';
		static $timestamps = FALSE;

		static $rules = array(
			'firstname' => array(
				'field' => 'firstname',
				'label' => 'Voornaam',
				'rules' => 'trim|required'
			),
			'name' => array(
				'field' => 'name',
				'label' => 'Achternaam',
				'rules' => 'trim|required'
			),
			'birthdate' => array(
				'field' => 'birthdate',
				'label' => 'Geboortedatum',
				'rules' => 'trim|required|exact_length[10]'
			),
			'address' => array(
				'field' => 'address',
				'label' => 'Adres',
				'rules' => 'trim|required'
			),
			'zip' => array(
				'field' => 'zip',
				'label' => 'Postcode',
				'rules' => 'trim|required'
			),
			'city' => array(
				'field' => 'city',
				'label' => 'Plaats',
				'rules' => 'trim|required'
			),
			'tel' => array(
				'field' => 'tel',
				'label' => 'tel',
				'rules' => 'trim'
			),
			'gsm' => array(
				'field' => 'gsm',
				'label' => 'GSM',
				'rules' => 'trim'
			),
			'email' => array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email'
			),
			'tak' => array(
				'field' => 'tak',
				'label' => 'tak',
				'rules' => 'trim|required'
			)
		);

		public function __construct() { parent::__construct(); }
		
		static function get_new() {
			$member = new stdClass();
			$member->firstname = '';
			$member->name = '';
			$member->birthdate = '';
			$member->address = '';
			$member->zip = '';
			$member->city = '';
			$member->tel = '';
			$member->gsm = '';
			$member->email = '';
			$member->tak = '';
			$member->paid = '';
			
			return $member;
		}

		static function get_all() {
			$CI =& get_instance();

			$kapoen = $CI->db->get('vwkapoen')->result();
			$welp = $CI->db->get('vwwelp')->result();
			$jojo = $CI->db->get('vwjojo')->result();
			$giver = $CI->db->get('vwgiver')->result();
			$jin = $CI->db->get('vwjin')->result();
			$leiding = $CI->db->get('vwleiding')->result();

			$data = array(
				'kapoenen' => $kapoen,
				'welpen' => $welp,
				'jojos' =>$jojo,
				'givers' => $giver,
				'jins' => $jin,
				'leiding' => $leiding
			);

			return $data;
		}

		static function get_by_tak($tak = null) {
			$CI =& get_instance();
			switch ($tak) {
				case 'kapoenen':
					$CI->db->get('vwKapoen')->result();
					break;
				case 'welpen':
					$CI->db->get('vwWelp')->result();
					break;
				case 'jojos':
					$CI->db->get('vwJojo')->result();
					break;
				case 'givers':
					$CI->db->get('vwGiver')->result();
					break;
				case 'jins':
					$CI->db->get('vwJin')->result();
					break;
				case 'leiding':
					$CI->db->get('vwLeiding')->result();
					break;
				default:
					self::get_all();
					break;
			}
		}

		static function toggle_paid($id) {
			$CI =& get_instance();
			$member = self::get($id);

			if (isset($member)) {
				$data = array('paid' => !$member->paid);
				$CI->db
					->where('id', $id)
					->update('members', $data);

				return TRUE;
			}
			else {
				return FALSE;
			}
		}

		public function excelify() {
			$CI =& get_instance();
			$members = self::get_views();

			//load PHPExcel library
			$CI->load->library('PHPExcel');
			$CI->load->library('PHPExcel/IOFactory');

			$objPHPExcel = new PHPExcel();
			//activate worksheet number 1
			$objPHPExcel->setActiveSheetIndex(0);
			//name the worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Ledenlijst');
			
			//set cell B1 content with some text
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Ledenlijst '.date('d-m-Y'));
			//change the font size
			$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
			//make the font become bold
			$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
			//merge cell B1 until E1
			$objPHPExcel->getActiveSheet()->mergeCells('B1:E1');

			//set aligment to center for that merged cell (A1 to D1)
			//$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$i=3;

			foreach ($members as $takname => $tak) {
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, ucfirst($takname));
				$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(16);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':E'.$i);

				$i+=2;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, 'Voornaam');
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, 'Achternaam');
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, 'Geboortedatum');
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, 'Adres');
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, 'Postcode');
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, 'Plaats');
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, 'Tel.');
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, 'GSM');
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, 'E-mailadres');
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i, 'Jaar');

				$objPHPExcel->getActiveSheet()->getStyle($i.':'.$i)->getFont()->setBold(true);

				foreach ($tak as $member) {
					$i++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $member->voornaam);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $member->achternaam);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $member->geboortedatum);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $member->adres);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $member->postcode);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $member->plaats);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $member->tel);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, $member->gsm);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, $member->email);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i, $member->year);
				}
				$i+=2;
			}

			$objPHPExcel->setActiveSheetIndex(0);

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
    		
			$filename='Ledenlijst_'.date('d-m-Y').'.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');
		}

		public function overgang() {
			$CI =& get_instance();
			$members = self::get_views();

			foreach ($members as $tak) {
				switch ($tak[0]['tak']) {
					case 'Kapoenen':
						$years = 2;
					break;
					case 'Welpen':
					case 'Jojo\'s':
					case 'Givers':
						$years = 3;
					break;
					case 'Jins':
						$years = 1;
					break;
					default:
						$years = 0;
					break;
				}
				foreach ($tak as $member) {
					if ($member->year == $years) {
						switch($member->tak) {
							case 'Kapoenen':
								$member->tak = 'Welpen';
							break;
							case 'Welpen':
								$member->tak = 'Jojo\'s';
							break;
							case 'Jojo\'s':
								$member->tak = 'Givers';
							break;
							case 'Givers':
								$member->tak = 'Jins';
							break;
							case 'Jins':
								$member->tak = 'Leiding';
							break;
						}
						$member->year = 1;
					}
					else {
						$member->year++;
					}
					$CI->db
						->where('id', $member->id)
						->update('members', $member);
				}
			}
			$this->onbetaald();
		}

		public function undo_overgang() {
			$members = self::get_all();

			foreach ($members as $tak) {
				foreach ($tak as $member) {
					if($member->year == 1) {
						switch($member->tak) {
							case 'Welpen':
								$member->tak = 'Kapoenen';
							break;
							case 'Jojo\'s':
								$member->tak = 'Welpen';
							break;
							case 'Givers':
								$member->tak = 'Jojo\'s';
							break;
							case 'Jins':
								$member->tak = 'Givers';
							break;
						}
						if ($member->tak != 'Kapoenen') {
							$member->year = 3;
						}
						else {
							$member->year = 2;
						}
					}
					else {
						$member->year--;
					}
					$this->db->where('id', $member->id);
					$this->db->update('members', $member);
				}
			}
		}

		public function onbetaald() {
			$CI =& get_instance();
			$data = array('paid' => 0);
			$CI->db->update('members', $data);
		}

		static function get_rules() { return self::$rules; }

		static function format_phone($number, $mobile = FALSE) {
			if (substr($number, 0, 3) == '+32') {
				str_replace('+32', '0', $number);
			}
			$number = preg_replace('/\D/', '', $number);
			if ($mobile) {
				$prefix = substr($number, 0, 4);
				$formated = $prefix.'/'.substr($number, 4, 2).' '.substr($number, 6, 2).' '.substr($number, 8, 2);
			} else {
				$double = ['02', '03', '04', '09'];
				$triple = ['01', '05', '06', '07', '08'];		
				
				if (in_array(substr($number, 0, 2), $double)) {
					$formated = substr($number, 0, 2).'/'.substr($number, 2, 3).' '.substr($number, 5, 2).' '.substr($number, 7, 2);
				}
				elseif (in_array(substr($number, 0, 2), $triple)) {
					$formated = substr($number, 0, 3).'/'.substr($number, 3, 2).' '.substr($number, 5, 2).' '.substr($number, 7, 2);
				}
			}
			return $formated;
		}
	}
?>