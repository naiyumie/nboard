<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	Manual

**************************************************************************************************/
class Manual extends CI_Controller {
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
			$this->load->helper('n');
			$this->load->helper('alert');
			$this->load->helper('file');

			# 모델

			# sign 체크
			$this->load->library('auth');
			$this->view_data['signed'] = $this->auth->is_signed();
			$this->view_data['admin_signed'] = $this->auth->is_admin_signed();
			$this->auth->check_admin_signed();

		}

	/********************************
		인덱스
	********************************/
		public function index()
		{
			show404();
		}

	/********************************
		매뉴얼을 읽어 준다.
	********************************/
		public function read()
		{
			$filename = $this->uri->segment(3, 0);
			$fileext = '.txt';
			$string = read_file('./manual_assets/'.$filename.$fileext);
			$this->view_data['contents'] = nl2br($string);
			$this->load->view('admin_manual', $this->view_data);
		}
}
/* End of file */