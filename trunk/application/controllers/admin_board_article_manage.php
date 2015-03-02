<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	Admin_board_article_manage
	관리자용 게시물 관리 컨트롤러 이다.

	- 관리자의 경우 이미지 삽입이나 첨부파일을 ftp로 한다.

**************************************************************************************************/
class Admin_board_article_manage extends CI_Controller {
	/********************************
		선언
	********************************/
		# 전역 view_data
		var $view_data = array();
		# 게시판 카테고리
		var $category = 'freeboard';
		# 페이지네이션 환경 설정 전역
		var $pagination_config = array();
		# 게시판 룩 모양새
		var $appearance = 'basic';
		# 컨텍스트
		var $context = 'admin_board_article_manage';
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
			$this->load->library('image_lib');

			# 모델
			$this->load->model('commonm');
			$this->load->model('boardm');
			$this->load->model('memberm');

			# 폼 밸리데이션
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="fail">', '</span>');

			# sign 체크
			$this->load->library('auth');
			$this->view_data['signed'] = $this->auth->is_signed();
			$this->view_data['admin_signed'] = $this->auth->is_admin_signed();
			$this->auth->check_admin_signed();

			# 사인인 후의 유저 정보
			$this->view_data['signed_data'] = $this->auth->get_user_info();

			# 카테고리 표시
			$this->category = $this->uri->segment(3, 0);
			$this->board_info = $this->boardm->get_board_info(array('category'=>$this->category));
			$this->view_data['category_name'] = $this->board_info['names'];
			$this->view_data['category'] = $this->category;

			# 현재 모양새를 가져온다.
			$this->appearance = $this->board_info['appearance'];
			$this->view_data['appearance'] = $this->board_info['appearance'];
			//print_R($this->view_data);

			# 쿼리스트링
			$querystring = $_SERVER['QUERY_STRING'];
			$this->view_data['query_string'] = $querystring;

			# pagination 환경 설정
			$this->pagination_config = $this->config->item('pagination');
			$this->pagination_config['total_rows'] = $this->boardm->get_counts(array('category'=>$this->category)); # 총 게시물 수
			$this->pagination_config['per_page'] = 10; # 페이지당 표시할 게시물수
			$this->pagination_config['uri_segment'] = 4; # 페이지 번호가 지정될 세그먼트 번호
			$this->pagination_config['num_links'] = 5; # 표시될 페이지수 / 2 (5면 10개씩 표시됨)
			$this->pagination_config['base_url'] = site_url($this->context.'/lists/'.$this->category.'');
			$this->pagination_config['suffix'] = '?'.$querystring;

			# 전체 게시물 수
			$this->view_data['counts'] = $this->boardm->get_counts_admin(array('category'=>$this->category));

			# 컨텍스트를 view에 넘김
			$this->view_data['context'] = $this->context;
			$this->view_data['manual_context'] = $this->manual_context;
		}

	/********************************
		인덱스
	********************************/
		public function index()
		{
			show404();
		}

	/********************************
		R 게시글 목록
	********************************/
		public function lists()
		{
			$this->view_data['category_choose'] = $this->boardm->get_board_categories();

			# 모델 데이터 세팅
			$model_data = array();
			$model_data['category'] = $this->category;

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
					$total_rows = $this->boardm->get_counts_admin($model_data); # 총 카운트 수
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
					$total_rows = $this->boardm->get_counts_admin($model_data); # 총 카운트 수
					$this->view_data['counts'] = $total_rows;
					$this->pagination_config['total_rows'] = $total_rows;
					$this->pagination->initialize($this->pagination_config);
				}
			}
			# 검색 enum 결정
			$this->view_data['choose_1'] = $this->commonm->get_enum_type('board','is_blind');
			//print_r($this->view_data['choose_1']);

			# 검색 설정이 완료 된 후 페이지네이션 추가.
			$this->view_data['pagination'] = $this->pagination->create_links();

			# 기본 view를 위한 모델 데이터
			$model_data['limit'] = $this->pagination_config['per_page'];
			$model_data['offset'] =$this->uri->segment($this->pagination_config['uri_segment'], 0);
			//print_r($model_data);

			# 데이터 조회
			$retrieve = $this->boardm->get_articles_admin($model_data);
			//echo $this->db->last_query();

			$this->view_data['lists'] = $retrieve;

			# 뷰 호출
			$this->load->view($this->context.'_list', $this->view_data);
		}

	/********************************
		R&U 조회, 수정을 위한 조회 - 웹플로우
	********************************/
		public function retrieve_and_update()
		{
			# 조회 부분 게시물을 얻는다.
			$model_data['uid'] = $this->uri->segment(4, 0);
			$model_data['category'] = $this->category;
			$retrieve = $this->boardm->get_article_admin($model_data);
			$this->view_data['r'] = $retrieve;

			# 댓글 부분
			$this->view_data['comment'] = $this->boardm->get_comments($model_data);
			$this->view_data['comment_count'] = cnt($this->view_data['comment']);

			# 뷰 호출
			$this->load->view($this->context.'_retrieve_and_update', $this->view_data);
		}

	/********************************
		U 수정 처리 - 웹플로우
	********************************/
		public function update_proc()
		{
			# 밸리데이션
			$this->form_validation->set_rules('title', '제목', 'trim|required|xss_clean');
			$this->form_validation->set_rules('content', '내용', 'trim|required');
			$this->form_validation->set_rules('is_blind', '삭제여부', 'required');
			$this->form_validation->set_rules('dates', '일', 'trim|required|xss_clean|exact_length[10]');
			$this->form_validation->set_rules('times', '시', 'trim|required|xss_clean|exact_length[8]');
			$this->form_validation->set_rules('hit', '조회수', 'trim|required|numeric');
			$this->form_validation->set_rules('recommend', '추천수', 'trim|required|numeric');
			$form_validate = $this->form_validation->run();

			# 조회 부분 게시물을 얻는다.
			$model_data['uid'] = $this->uri->segment(4, 0);
			$model_data['category'] = $this->category;
			$retrieve = $this->boardm->get_article_admin($model_data);
			$this->view_data['r'] = $retrieve;

			# 밸리데이션 체크 실패 | 성공
			if ($form_validate == FALSE) {
				$this->load->view($this->context.'_retrieve_and_update', $this->view_data);
			} else {
				$model_data = $this->input->post();
				if ($this->boardm->article_update($model_data) == TRUE) {
					redirect('/'.$this->context.'/lists/'.$this->category.'/0/');
				}
				$this->load->view($this->context.'_retrieve_and_update', $this->view_data);
			}
		}


	/********************************
		D 삭제 - 싱글
	********************************/
		public function delete_proc()
		{
			$check = $this->input->post('chk');
			//print_r($check);
			if (empty($check)) {
				alert_back('삭제할 항목을 선택 하여 주십시오.');
			}
			foreach($check as $k=>$v) {
				$model_data = array(
					'uid' => $v,
					'is_blind' => 'Y'
				);
				$this->boardm->article_update($model_data);
			}
			alert_back('삭제 되었습니다.', '/'.$this->context.'/lists/'.$this->category.'/0/');
		}

	/********************************
		C 생성 - 웹플로우
	********************************/
		public function create()
		{
			# 뷰
			$this->load->view($this->context.'_create', $this->view_data);
		}

	/********************************
		C 생성 처리 - 웹플로우
	********************************/
		public function create_proc()
		{
			# 밸리데이션
			$this->form_validation->set_rules('title', '제목', 'trim|required|xss_clean');
			$this->form_validation->set_rules('content', '내용', 'trim|required');
			$form_validate = $this->form_validation->run();

			# 밸리데이션 체크 실패 | 성공
			if ($form_validate == FALSE) {
				$this->load->view($this->context.'_create', $this->view_data);
			} else {
				# 작성자의 내용을 만든다.
				$model_data_retrieve = array();
				$this->view_data['signed_id'] = $this->session->userdata('signed_id');
				$model_data_retrieve['signed_id'] = $this->view_data['signed_id'];
				$retrieve = $this->memberm->get_user_data($model_data_retrieve);
				$this->view_data['retrieve'] = $retrieve;
				$model_data = $this->input->post();
				$model_data['category'] =$this->category;
				$model_data['writer'] = $retrieve['uid'];
				$model_data['dates'] = date('Y-m-d');
				$model_data['times'] = date('H:i:s');
				if ($this->boardm->article_write($model_data) == TRUE) {
					redirect('/'.$this->context.'/lists/'.$this->category.'/0/');
				}
				$this->load->view($this->context.'_create', $this->view_data);
			}
		}

	/********************************
		댓글 - 싱글
	********************************/
		public function comment_delete_proc()
		{
			$check = $this->input->post('chk');
			//print_r($check);
			if (empty($check)) {
				alert_back('삭제할 항목을 선택 하여 주십시오.');
			}
			foreach($check as $k=>$v) {
				$model_data = array(
					'uid' => $v,
					'is_blind' => 'Y'
				);
				$this->boardm->comment_update_admin($model_data);
			}
			alert_back('삭제 되었습니다.');
		}
}
/* End of file */