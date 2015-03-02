<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	Admin_member
	멤버를 관리하는 컨트롤러 이다.

**************************************************************************************************/
class Admin_member extends CI_Controller {
	/********************************
		선언
	********************************/
		# 전역 view_data
		var $view_data = array();
		# 컨텍스트
		var $context = 'admin_member';


	/********************************
		생성자
	********************************/
		public function __construct()
		{
			parent::__construct();

			# 라이브러리 & 헬퍼
			$this->load->helper('url');
			$this->load->helper('alert');
			$this->load->helper('n');
			$this->load->helper('form');
			$this->load->library('pagination');

			# 모델
			$this->load->model('commonm');
			$this->load->model('memberm');

			# 폼 밸리데이션
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="fail">', '</span>');

			# sign 체크
			$this->load->library('auth');
			$this->view_data['signed'] = $this->auth->is_signed();
			$this->auth->check_admin_signed();

			# 사인인 후의 유저 정보
			$this->view_data['signed_data'] = $this->auth->get_user_info();

			# 쿼리스트링
			$querystring = $_SERVER['QUERY_STRING'];
			$this->view_data['query_string'] = $querystring;

			# pagination 환경 설정
			$this->pagination_config = $this->config->item('pagination');
			$this->pagination_config['total_rows'] = $this->memberm->get_counts(array()); # 총 멤버 수
			$this->pagination_config['per_page'] = 10; # 페이지당 표시할 멤버수
			$this->pagination_config['uri_segment'] = 3; # 페이지 번호가 지정될 세그먼트 번호
			$this->pagination_config['num_links'] = 5; # 표시될 페이지수 / 2 (5면 10개씩 표시됨)
			$this->pagination_config['base_url'] = site_url($this->context.'/lists/');
			$this->pagination_config['suffix'] = '?'.$querystring;

			# 전체 수
			$this->view_data['counts'] = $this->memberm->get_counts(array());

			# 컨텍스트를 view에 넘김
			$this->view_data['context'] = $this->context;
		}


	/********************************
		인덱스
	********************************/
		public function index()
		{
			show_404(); # 404 이지만 서브메인이 존재 할 경우 이곳에 기술 될 수 있다.
		}


	/********************************
		멤버 목록
	********************************/
		public function lists()
		{
			# 모델 데이터 세팅
			$model_data = array();

			# 페이지네이션 초기화
			$this->pagination->initialize($this->pagination_config);

			# 검색 값 추출
			$search_key = $this->input->get('search_key'); //echo $search_key;
			$search_value = $this->input->get('search_value'); //echo $search_value;
			$search_value_start = $this->input->get('search_value_start'); //echo $search_value_start;
			$search_value_end = $this->input->get('search_value_end'); //echo $search_value_end;

			# 검색 조건
			if (empty($search_key) !== TRUE) {
				# 일반 값 검색일 경우
				if (empty($search_value) !== TRUE) {
					$model_data['search_key'] = $search_key;
					$model_data['search_value'] = $search_value;
					$total_rows = $this->memberm->get_counts($model_data); # 총 카운트 수
					$this->view_data['counts'] = $total_rows;
					$this->pagination_config['total_rows'] = $total_rows;
					$this->pagination->initialize($this->pagination_config);
				}
				# dates 검색일 경우
				if (empty($search_value_start) !== TRUE && empty($search_value_end) !== TRUE) {
					//echo "date 검색";
					$model_data['search_key'] = $search_key;
					$model_data['search_value_start'] = $search_value_start;
					$model_data['search_value_end'] = $search_value_end;
					$total_rows = $this->memberm->get_counts($model_data); # 총 카운트 수
					$this->view_data['counts'] = $total_rows;
					$this->pagination_config['total_rows'] = $total_rows;
					$this->pagination->initialize($this->pagination_config);
				}
			}
			# 검색 enum 결정
			$this->view_data['choose_1'] = $this->commonm->get_enum_type('members','type');
			$this->view_data['choose_2'] = $this->commonm->get_enum_type('members','is_blind');
			//print_r($this->view_data['choose_1']);

			# 검색 설정이 완료 된 후 페이지네이션 추가.
			$this->view_data['pagination'] = $this->pagination->create_links();

			# 기본 view를 위한 모델 데이터
			$model_data['limit'] = $this->pagination_config['per_page'];
			$model_data['offset'] =$this->uri->segment($this->pagination_config['uri_segment'], 0);
			//print_r($model_data);
			# 데이터 조회
			$retrieve = $this->memberm->get_members($model_data);
			//echo $this->db->last_query();
			$this->view_data['lists'] = $retrieve;

			# 뷰 호출
			$this->load->view($this->context.'_list', $this->view_data);
		}
	/********************************
		생성 - 웹플로우
	********************************/
		public function create()
		{
			# 뷰
			$this->load->view($this->context.'_create', $this->view_data);
		}

	/********************************
		생성 처리 - 웹플로우
	********************************/
		public function create_proc()
		{
			# 밸리데이션
			$this->form_validation->set_rules('user_id', '아이디', 'trim|required|xss_clean|min_length[5]|is_unique[members.user_id]');
			$this->form_validation->set_rules('user_pw', '비밀번호', 'trim|required|xss_clean|min_length[5]');
			$this->form_validation->set_rules('nick', '닉네임', 'trim|required|xss_clean|is_unique[members.nick]');
			$this->form_validation->set_rules('email', '이메일', 'trim|required|xss_clean|valid_email|is_unique[members.email]');
			$this->form_validation->set_rules('introduce', '소개', 'trim|xss_clean');
			$this->form_validation->set_rules('type', '유저 타입', 'trim|required');
			$this->form_validation->set_rules('level', '레벨', 'trim|required|less_than[10]');
			$this->form_validation->set_rules('term_agreement', '이용약관', 'trim');
			$this->form_validation->set_rules('privacy_polish', '개인정보보호정책', 'trim');
			$this->form_validation->set_rules('dates', '가입일', 'trim|required|xss_clean|exact_length[10]');
			$this->form_validation->set_rules('times', '가입시', 'trim|required|xss_clean|exact_length[8]');
			$this->form_validation->set_rules('signed_dates', '마지막 사인인 일', 'trim|required|xss_clean|exact_length[10]');
			$this->form_validation->set_rules('signed_times', '마지막 사인인 시', 'trim|required|xss_clean|exact_length[8]');
			$this->form_validation->set_rules('captcha', '캡챠입력정보', 'trim|required|xss_clean');
			$this->form_validation->set_rules('count_signed', '사인인 횟수', 'trim|required|xss_clean|numeric');
			$this->form_validation->set_rules('count_write_article', '게시글 작성수', 'trim|required|xss_clean|numeric');
			$this->form_validation->set_rules('count_write_comment', '댓글 작성수', 'trim|required|xss_clean|numeric');
			$this->form_validation->set_rules('is_blind', '탈퇴 여부', 'trim');
			$form_validate = $this->form_validation->run();

			# 밸리데이션 체크 실패 | 성공
			if ($form_validate == FALSE) {
				$this->load->view($this->context.'_create', $this->view_data);
			} else {
				$model_data = $this->input->post();
				if ($this->memberm->sign_up($model_data) == TRUE) {
					redirect('/'.$this->context.'/lists/0/');
				}
				$this->load->view($this->context.'_create', $this->view_data);
			}
		}

	/********************************
		조회, 수정을 위한 조회 - 웹플로우
	********************************/
		public function retrieve_and_update()
		{
			# 조회 부분 게시물을 얻는다.
			$model_data = array(
				'uid'=>$this->uri->segment(4, 0)
			);
			$retrieve = $this->memberm->get_member($model_data);
			$this->view_data['r'] = $retrieve;

			# 뷰 호출
			$this->load->view($this->context.'_retrieve_and_update', $this->view_data);
		}

	/********************************
		수정 처리 - 웹플로우
	********************************/
		public function update_proc()
		{
			# 밸리데이션
			$this->form_validation->set_rules('nick', '닉네임', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', '이메일', 'trim|required|xss_clean|valid_email');
			$this->form_validation->set_rules('introduce', '소개', 'trim|xss_clean');
			$this->form_validation->set_rules('type', '유저 타입', 'trim|required');
			$this->form_validation->set_rules('level', '레벨', 'trim|required|less_than[10]');
			$this->form_validation->set_rules('term_agreement', '이용약관', 'trim');
			$this->form_validation->set_rules('privacy_polish', '개인정보보호정책', 'trim');
			$this->form_validation->set_rules('dates', '가입일', 'trim|required|xss_clean|exact_length[10]');
			$this->form_validation->set_rules('times', '가입시', 'trim|required|xss_clean|exact_length[8]');
			$this->form_validation->set_rules('signed_dates', '마지막 사인인 일', 'trim|required|xss_clean|exact_length[10]');
			$this->form_validation->set_rules('signed_times', '마지막 사인인 시', 'trim|required|xss_clean|exact_length[8]');
			$this->form_validation->set_rules('captcha', '캡챠입력정보', 'trim|required|xss_clean');
			$this->form_validation->set_rules('count_signed', '사인인 횟수', 'trim|required|xss_clean|numeric');
			$this->form_validation->set_rules('count_write_article', '게시글 작성수', 'trim|required|xss_clean|numeric');
			$this->form_validation->set_rules('count_write_comment', '댓글 작성수', 'trim|required|xss_clean|numeric');
			$this->form_validation->set_rules('is_blind', '탈퇴 여부', 'trim');
			$form_validate = $this->form_validation->run();

			# 조회 부분
			$model_data = array(
				'uid'=>$this->uri->segment(4, 0)
			);
			$retrieve = $this->memberm->get_member($model_data);
			$this->view_data['r'] = $retrieve;

			# 밸리데이션 체크 실패 | 성공
			if ($form_validate == FALSE) {
				$this->load->view($this->context.'_retrieve_and_update', $this->view_data);
			} else {
				$model_data = $this->input->post();
				if ($this->memberm->updates($model_data) == TRUE) {
					//print_r($this->input->post());
					redirect('/'.$this->context.'/lists/0/');
				}
				$this->load->view($this->context.'_retrieve_and_update', $this->view_data);
			}
		}

	/********************************
		삭제 - 싱글
	********************************/
		public function delete_proc()
		{
			$check = $this->input->post('chk');
			if (empty($check)) {
				alert_back('삭제할 항목을 선택 하여 주십시오.');
			}
			foreach($check as $k=>$v) {
				$model_data = array(
					'uid' => $v
				);
				$this->memberm->deletes($model_data);
			}
			alert_back('삭제 되었습니다.', '/'.$this->context.'/lists/0/');
		}

}
/* End of file */