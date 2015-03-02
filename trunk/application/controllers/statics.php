<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	Statics
	로직이 필요 없는 디스플레이 위주의 디자인 페이지를 랩핑 한다.

**************************************************************************************************/
class Statics extends CI_Controller {
	/********************************
		선언
	********************************/
		# 전역 view_data
		var $view_data = array();


	/********************************
		생성자
	********************************/
		public function __construct()
		{
			parent::__construct();
			# 라이브러리 & 헬퍼
			$this->load->library('auth');

			# sign 체크
			$this->load->library('auth');
			$this->view_data['signed'] = $this->auth->is_signed();
			$this->view_data['admin_signed'] = $this->auth->is_admin_signed();

			# 사인인 후의 유저 정보
			$this->view_data['signed_data'] = $this->auth->get_user_info();
		}


	/********************************
		인덱스
	********************************/
		public function index()
		{
			show_404(); # 404 이지만 서브메인이 존재 할 경우 이곳에 기술 될 수 있다.
		}


	/********************************
		스태틱 페이지
	********************************/
		public function page($page_view_name)
		{
			if (empty($page_view_name)) {
				# 인자가 없으면 404
				show_404();
			} else {
				# 인자가 있으면 해당파일을 뷰 호출.
				$view_file_name = (string) $page_view_name;
				$this->load->view($view_file_name, $this->view_data);
			}
		}
}
/* End of file */