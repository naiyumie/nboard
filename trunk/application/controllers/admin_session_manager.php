<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	Admin_session_manager
	기본적인 CRUD이다.

**************************************************************************************************/
class Admin_session_manager extends CI_Controller {
	/********************************
		선언
	********************************/
		# 전역 view_data
		var $view_data = array();
		# 컨텍스트
		var $context = 'admin_session_manager';

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

			# 폼 밸리데이션
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="fail help-inline">', '</span>');

			# 모델
			$this->load->model('commonm');

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
			$this->pagination_config['per_page'] = 10; # 페이지당 표시할 카운트 수
			$this->pagination_config['uri_segment'] = 3; # 페이지 번호가 지정될 세그먼트 번호
			$this->pagination_config['num_links'] = 5; # 표시될 페이지수 / 2 (5면 10개씩 표시됨)
			$this->pagination_config['base_url'] = site_url($this->context.'/lists/');
			$this->pagination_config['suffix'] = '?'.$querystring;



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
		R 목록
	********************************/
		public function lists()
		{

			# 모델 데이터
			$model_data = array();
			$model_data['environment'] = array(
				'context' => 'ci_sessions',
				'pk' => 'last_activity'
			);
			# 전체 수
			$this->view_data['counts'] = $this->commonm->get_counts($model_data);
			$this->pagination_config['total_rows'] = $this->commonm->get_counts($model_data);

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
					$total_rows = $this->commonm->get_counts($model_data); # 총 카운트 수
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
					$total_rows = $this->commonm->get_counts($model_data); # 총 카운트 수
					$this->view_data['counts'] = $total_rows;
					$this->pagination_config['total_rows'] = $total_rows;
					$this->pagination->initialize($this->pagination_config);
				}
			}
			# 검색 enum 결정
			$this->view_data['choose_1'] = $this->commonm->get_enum_type('crud','checkbox');
			$this->view_data['choose_2'] = $this->commonm->get_enum_type('crud','radio');
			$this->view_data['choose_3'] = $this->commonm->get_enum_type('crud','select');
			//print_r($this->view_data['choose_1']);

			# 검색 설정이 완료 된 후 페이지네이션 추가.
			$this->view_data['pagination'] = $this->pagination->create_links();

			# 기본 view를 위한 모델 데이터
			$model_data['limit'] = $this->pagination_config['per_page'];
			$model_data['offset'] =$this->uri->segment($this->pagination_config['uri_segment'], 0);

			# 데이터 조회
			$retrieve = $this->commonm->gets($model_data);
			foreach($retrieve as $k=>$v) {
				$retrieve[$k]['user_data_array'] = unserialize($retrieve[$k]['user_data']);
				$retrieve[$k]['last_activity_string'] = date('Y-m-d H:i:s', $retrieve[$k]['last_activity']);
			}
			$this->view_data['lists'] = $retrieve;

			# 뷰 호출
			$this->load->view($this->context.'_list', $this->view_data);
		}

	/********************************
		R 조회
	********************************/
		public function retrieve_and_update()
		{
			# 조회 부분 게시물을 얻는다.
			# 모델 데이터
			$model_data = array();
			$model_data['environment'] = array(
				'context' => 'ci_sessions',
				'pk' => 'session_id'
			);
			$model_data['pk_value'] = $this->uri->segment(4, 0);

			# 데이터 조회
			$retrieve = $this->commonm->get($model_data);
			$retrieve['user_data_array'] = unserialize($retrieve['user_data']);
			$retrieve['last_activity_string'] = date('Y-m-d H:i:s', $retrieve['last_activity']);
			$this->view_data['r'] = $retrieve;

			# 뷰 호출
			$this->load->view($this->context.'_retrieve_and_update', $this->view_data);
		}

	/********************************
		D 삭제 - 싱글
		chk값은 lists에서 넘어오며,
		프로세스라 할수도 있다.
	********************************/
		public function delete_proc()
		{
			$check = $this->input->post('chk');
			if (empty($check)) {
				alert_back('삭제할 항목을 선택 하여 주십시오.');
			}
			foreach($check as $k=>$v) {
				# 모델 데이터
				$model_data = array();
				$model_data['environment'] = array(
					'context' => 'ci_sessions',
					'pk' => 'session_id'
				);
				$model_data['pk_value'] = $v;
				$this->commonm->deletes($model_data);
			}
			alert_back('삭제 되었습니다.', '/'.$this->context.'/lists/0/');
		}
}
/* End of file */