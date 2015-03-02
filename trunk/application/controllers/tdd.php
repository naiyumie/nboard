<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	Tdd
	테스트용 컨트롤러 이다.

**************************************************************************************************/
class Tdd extends CI_Controller {
	/********************************
		선언
	********************************/
		var $view_data = array();


	/********************************
		생성자
	********************************/
		public function __construct()
		{
			parent::__construct();

			# 개발단계가 아니면 404
			if (ENVIRONMENT != 'development') show404();

			$this->load->library('auth');
			$this->load->helper('url');
			$this->load->helper('n');

			# sign 체크
			$this->load->library('auth');
			$this->view_data['signed'] = $this->auth->is_signed();
			$this->view_data['admin_signed'] = $this->auth->is_admin_signed();
			$this->load->model('memberm');
		}
		public function index()
		{
			$signed_data = $this->session->userdata('signed_data');
			$signed_data = $this->session->all_userdata();
			print_r($signed_data);

			$str = 'naiyumie';
			echo marked_text($str);
		}

		public function mailtest()
		{
			# 메일 폼의 모조 변수를 파싱.
			$this->load->library('parser');
			$data = array(
				'user_id' => 'your_id',
				'url' => base_url()
			);
			$mailform = $this->parser->parse('mailform', $data, TRUE);
			//$to = $this->input->post('email');
			$to = 'naiyumie@gmail.com';

			# 라이브러리 로드
			$this->load->library('email');

			# 메일 보내는 사람의 메일주소와 이름을 설정
			$this->email->from('naiyumie@gmail.com', '나이유미');

			# 수신자의 이메일주소를 설정, 하나이상의 주소를 설정할수있으며 , 여러개를 설정할때는 콤마(,)로 구분하여 설정하거나, 배열로 넘겨줄수도 있다.
			$this->email->to($to);

			# 메일 제목을 설정
			$this->email->subject('나이유미 게시판 - 요청하신 아이디 정보를 알려 드립니다.');

			# 이메일 내용을 설정
			$this->email->message($mailform);
			$this->email->set_mailtype("html");

			# 이메일을 발송
			$this->email->send();
			print_R($mailform);
		}
}
/* End of file */