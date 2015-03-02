<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	Auth
	권한및 세션관련 라이브러리 이다.

**************************************************************************************************/
class Auth {
	/********************************
		선언
	********************************/
		var $ci;

	/********************************
		생성자
	********************************/
		public function __construct()
		{
			$this->ci =& get_instance();
			$this->ci->load->library('session');
			$this->ci->load->helper('n');
			$this->ci->load->model('memberm');
		}

	/********************************
		sign 체크
	********************************/
		public function is_signed()
		{
			$ret = FALSE;
			if ($this->ci->session->userdata('sign_state') == TRUE) {
				//echo "signed";
				$ret = TRUE;
			} else {
				//echo "unsigned";
				$ret = FALSE;
			}
			return $ret;
		}

	/********************************
		관리자 여부 체크
	********************************/
		public function is_admin_signed()
		{
			$ret = FALSE;
			# 인증 되어 있지 않을 경우 | 되어 있으면서 type이 관리자인 경우
			if ($this->ci->session->userdata('sign_state') == FALSE) {
				$ret = FALSE;
			} else {
				$signed_data = $this->ci->session->userdata('signed_data');
				if ($signed_data['type'] == 'admin') {
					$ret = TRUE;
				}
			}
			return $ret;
		}
	/********************************
		관리자 여부 체크-리디렉션
	********************************/
		public function check_admin_signed()
		{
			# 인증 되어 있지 않을 경우 목록으로 리디렉션
			if ($this->ci->session->userdata('sign_state') == FALSE ) {
				home();
			} else {
				$signed_data = $this->ci->session->userdata('signed_data');
				if ($signed_data['type'] != 'admin') {
					home();
				}
			}
		}

	/********************************
		사인인 후의 유저 정보
	********************************/
		public function get_user_info()
		{
			if ($this->is_signed()) {
				# 유저 데이터를 조회 한다.
				$model_data = array(
					'signed_id' => $this->ci->session->userdata('signed_id')
				);
				$signed_user_data = $this->ci->memberm->get_user_data($model_data);
				unset($signed_user_data['introduce']);
				unset($signed_user_data['user_pw']);
				$this->ci->session->set_userdata('signed_data', $signed_user_data); # 배열을 그대로 넣음.

				$ret = $this->ci->session->userdata('signed_data');
				$ret['type_kr'] = get_signed_type_kr($ret['type']);
				$ret['dates'] = dash_to_point($ret['dates']);
				$ret['signed_dates'] = dash_to_point($ret['signed_dates']);

				$ret['count_signed'] = number_format($ret['count_signed']);
				$ret['count_write_article'] = number_format($ret['count_write_article']);
				$ret['count_write_comment'] = number_format($ret['count_write_comment']);
				return $ret;
			}
		}
}

/* End of file */