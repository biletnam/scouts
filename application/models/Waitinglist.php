<?php
	class Waitinglist extends MY_Model {
		static $table = 'waitinglist';
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
				'rules' => 'trim'
			),
			'zip' => array(
				'field' => 'zip',
				'label' => 'Postcode',
				'rules' => 'trim'
			),
			'city' => array(
				'field' => 'city',
				'label' => 'Plaats',
				'rules' => 'trim'
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
				'label' => 'e-mail',
				'rules' => 'trim|required|valid_email'
			),
			'tak' => array(
				'field' => 'tak',
				'label' => 'tak',
				'rules' => 'trim|required'
			),
			'year' => array(
				'field' => 'year',
				'field' => 'jaar',
				'rules' => 'trim|required'
			),
		);

		public function __construct() { parent::__construct(); }
		
		static function get_new() {
			$kid = new stdClass();
			$kid->firstname = '';
			$kid->name = '';
			$kid->birthdate = '';
			$kid->address = '';
			$kid->zip = '';
			$kid->city = '';
			$kid->tel = '';
			$kid->gsm = '';
			$kid->email = '';
			$kid->tak = '';
			
			return $kid;
		}

		static function get_all() {
			$CI =& get_instance();

			$kapoen['priority'] = $CI->db->get('wlkapoen_p')->result();
			$kapoen['regular'] = $CI->db->get('wlkapoen')->result();
			
			$welp['priority'] = $CI->db->get('wlwelp_p')->result();
			$welp['regular'] = $CI->db->get('wlwelp')->result();
			
			$jojo['priority'] = $CI->db->get('wljojo_p')->result();
			$jojo['regular'] = $CI->db->get('wljojo')->result();
			
			$giver['priority'] = $CI->db->get('wlgiver_p')->result();
			$giver['regular'] = $CI->db->get('wlgiver')->result();

			$data = array(
				'kapoenen' => $kapoen,
				'welpen' => $welp,
				'jojos' =>$jojo,
				'givers' => $giver
			);

			return $data;
		}

		static function get_by_tak($tak = null) {
			$CI =& get_instance();
			switch ($tak) {
				case 'kapoenen':
					$CI->db->get('wlKapoen_p')->result();
					break;
				case 'welpen':
					$CI->db->get('wlWelp_p')->result();
					break;
				case 'jojos':
					$CI->db->get('wlJojo_p')->result();
					break;
				case 'givers':
					$CI->db->get('wlGiver_p')->result();
					break;
				default:
					self::get_all();
					break;
			}
		}

		static function add_member($id) {

			$kid = self::get($id);

			$member = array(
				'firstname' => $kid->firstname,
				'name' => $kid->name,
				'birthdate' => $kid->birthdate,
				'address' => $kid->address,
				'zip' => $kid->zip,
				'city' => $kid->city,
				'tel' => $kid->tel,
				'gsm' => $kid->gsm,
				'email' => $kid->email,
				'tak' => $kid->tak,
				'paid' => 0
			);

			Member::save($member);
			/*$member = Member::get();
			if (isset($member->$id)) {
				Waitinglist::delete($id);
			}*/
		}

		static function excelify() {
			$CI =& get_instance();
			$kids = self::get_views();

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

			foreach ($kids as $takname => $tak) {
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

				foreach ($tak as $kid) {
					$i++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $kid->voornaam);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $kid->achternaam);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $kid->geboortedatum);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $kid->adres);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $kid->postcode);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $kid->plaats);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $kid->tel);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, $kid->gsm);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, $kid->email);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i, $kid->year);
				}
				$i+=2;
			}

			$objPHPExcel->setActiveSheetIndex(0);

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
    		
			$filename='Wachtlijst_'.date('d-m-Y').'.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');
		}

		public function overgang() {
			$CI =& get_instance();
			$waitinglist = self::get_views();

			foreach ($waitinglist as $tak) {
				switch ($tak[0]['tak']) {
					case 'Kapoenen':
						$years = 2;
						break;
					case 'Welpen':
					case 'Jojo\'s':
					case 'Givers':
						$years = 3;
						break;
					default:
						$years = 0;
						break;
				}
				foreach ($tak as $kid) {
					if ($kid->year == $years) {
						switch($kid->tak) {
							case 'Kapoenen':
								$kid->tak = 'Welpen';
								break;
							case 'Welpen':
								$kid->tak = 'Jojo\'s';
								break;
							case 'Jojo\'s':
								$kid->tak = 'Givers';
								break;
						}
						$kid->year = 1;
					}
					else {
						$kid->year++;
					}

					if ($kid->year == $years && $kid->tak != 'Givers') {
						$CI->db
							->where('id', $kid->id)
							->update('waitinglist', $kid);
					} else {
						self::delete($kid->id);
					}
				}
			}
		}

		public function undo_overgang() {
			$waitinglist = self::get_all();

			foreach ($waitinglist as $tak) {
				foreach ($tak as $kid) {
					if($kid->year == 1) {
						switch($kid->tak) {
							case 'Welpen':
								$kid->tak = 'Kapoenen';
								break;
							case 'Jojo\'s':
								$kid->tak = 'Welpen';
								break;
							case 'Givers':
								$kid->tak = 'Jojo\'s';
								break;
							case 'Jins':
								$kid->tak = 'Givers';
								break;
						}
						if ($kid->tak != 'Kapoenen') {
							$kid->year = 3;
						}
						else {
							$kid->year = 2;
						}
					}
					else {
						$kid->year--;
					}
					$this->db->where('id', $kid->id);
					$this->db->update('waitinglist', $kid);
				}
			}
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