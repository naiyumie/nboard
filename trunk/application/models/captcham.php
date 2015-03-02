<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	캡챠 모델

**************************************************************************************************/
class Captcham extends CI_Model {
	/********************************
		생성자
	********************************/
		function __construct()
		{
			parent::__construct();
		}


	/**************************************************************************************************

		캡차 DB 연동

	**************************************************************************************************/
		/********************************
			밸리데이션 할 정보 저장
		********************************/
			public function save_validate_data($model_data)
			{
				$query = $this->db->insert_string('captcha', $model_data);
				$this->db->query($query);
			}

		/********************************
			밸리데이션
		********************************/
			public function validation($model_data)
			{
				# Two hour limit
				$expiration = time()-7200;
				$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);

				# Then see if a captcha exists:
				$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
				$binds = array($model_data['captcha'], $this->input->ip_address(), $expiration);
				$query = $this->db->query($sql, $binds);
				$row = $query->row();
				//print_R($query->result_array());
				$ret = FALSE;
				if ($row->count > 0) {
					$ret = TRUE;
				}
				return $ret;
			}

}

/* End of file */