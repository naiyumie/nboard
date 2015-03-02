<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	Admin_board_manage
	관리자용 게시판 카테고리 관리 컨트롤러 이다.
	게시판 카테고리와 appearance

**************************************************************************************************/
class Admin_board_manage extends CI_Controller {
	/********************************
		선언
	********************************/
		# 전역 view_data
		var $view_data = array();
		# 컨텍스트
		var $context = 'admin_board_manage';
		# 매뉴얼 전용 컨텍스트
		var $manual_context = 'admin_board';


	/********************************
		생성자
	********************************/
		public function __construct()
		{
			parent::__construct();

			# 라이브러리 & 헬퍼
			$this->load->library('pagination');
			$this->load->helper('url');
			$this->load->helper('alert');
			$this->load->helper('n');
			$this->load->helper('form');

			# 모델
			$this->load->model('commonm');
			$this->load->model('boardm');
			$this->load->model('memberm');

			# sign 체크
			$this->load->library('auth');
			$this->view_data['signed'] = $this->auth->is_signed();
			$this->view_data['admin_signed'] = $this->auth->is_admin_signed();
			$this->auth->check_admin_signed();

			# 사인인 후의 유저 정보
			$this->view_data['signed_data'] = $this->auth->get_user_info();

			# 폼 밸리데이션
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="fail help-inline">', '</span>');

			# appearance
			$this->view_data['appearence'] = $this->commonm->get_enum_type('board_category','appearance');

			# 컨텍스트를 view에 넘김
			$this->view_data['context'] = $this->context;
			$this->view_data['manual_context'] = $this->manual_context;
		}

	/********************************
		인덱스
	********************************/
		public function index()
		{
			show_404();
		}

	/********************************
		R 목록
	********************************/
		public function lists()
		{
			# 게시판 카테고리 목록
			$this->view_data['lists'] = $this->boardm->get_board_categories();
			$this->load->view($this->context.'_list', $this->view_data);
		}

	/********************************
		R&U 조회, 수정을 위한 조회 - 웹플로우
	********************************/
		public function retrieve_and_update()
		{
			# 조회 부분 게시물을 얻는다.
			$model_data = array(
				'category'=>$this->uri->segment(3, 0)
			);
			$retrieve = $this->boardm->get_category_data($model_data);
			$this->view_data['r'] = $retrieve;

			# 뷰 호출
			$this->load->view($this->context.'_retrieve_and_update', $this->view_data);
		}

	/********************************
		U 수정 처리 - 웹플로우
	********************************/
		public function update_proc()
		{
			# 밸리데이션
			$this->form_validation->set_rules('category', '카테고리 PK', 'trim|alpha_dash|required|xss_clean');
			$this->form_validation->set_rules('names', '카테고리 이름', 'trim|required|xss_clean');
			$this->form_validation->set_rules('appearance', '모양새', 'required');
			$form_validate = $this->form_validation->run();

			# 조회 부분 게시물을 얻는다.
			$model_data = array(
				'category'=>$this->uri->segment(3, 0)
			);
			$retrieve = $this->boardm->get_category_data($model_data);
			$this->view_data['r'] = $retrieve;

			# 밸리데이션 체크 실패 | 성공
			if ($form_validate == FALSE) {
				$this->load->view($this->context.'_retrieve_and_update', $this->view_data);
			} else {
				$model_data = $this->input->post();
				if ($this->boardm->category_updates($model_data) == TRUE) {
					redirect('/'.$this->context.'/lists/0/');
				}
				$this->load->view($this->context.'_retrieve_and_update', $this->view_data);
			}
		}

	/********************************
		C 생성 - 웹플로우
	********************************/
		public function board_create()
		{
			$this->load->view($this->context.'_create', $this->view_data);
		}

	/********************************
		C 생성 처리 - 웹플로우
	********************************/
		public function board_create_proc()
		{
			# 밸리데이션
			$this->form_validation->set_rules('category', '카테고리 PK', 'trim|alpha_dash|is_unique[board_category.category]|required|xss_clean');
			$this->form_validation->set_rules('names', '카테고리 이름', 'trim|required|xss_clean');
			$this->form_validation->set_rules('appearance', '모양새', 'required');
			$form_validate = $this->form_validation->run();

			# 밸리데이션 체크 실패 | 성공
			if ($form_validate == FALSE) {
				$this->load->view($this->context.'_create', $this->view_data);
			} else {
				$model_data = $this->input->post();
				if ($this->boardm->category_create($model_data) == TRUE) {
					redirect('/'.$this->context.'/lists/');
				}
				$this->load->view($this->context.'_create', $this->view_data);
			}
		}

	/********************************
		D 삭제 - 싱글
	********************************/
		public function delete_proc()
		{
			$check = $this->input->post('chk');
			if (empty($check)) {
				alert_back('삭제할 항목을 선택 하여 주십시오.');
			}
			foreach($check as $k=>$v) {
				$model_data = array(
					'category' => $v
				);
				$this->boardm->category_deletes($model_data);
			}
			alert_back('삭제 되었습니다.', '/'.$this->context.'/lists/');
		}
}
/* End of file */