<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	Board
	기본적인 게시판 컨트롤러 이다.

**************************************************************************************************/
class Board extends CI_Controller {
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
			$this->load->model('boardm');
			$this->load->model('memberm');

			# 폼 밸리데이션
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="fail">', '</span>');

			# sign 체크
			$this->load->library('auth');
			$this->view_data['signed'] = $this->auth->is_signed();
			$this->view_data['admin_signed'] = $this->auth->is_admin_signed();

			# 사인인 후의 유저 정보
			$this->view_data['signed_data'] = $this->auth->get_user_info();

			# 카테고리 표시
			$this->category = $this->uri->segment(3, 0);
			$this->board_info = $this->boardm->get_board_info(array('category'=>$this->category));
			if (empty($this->board_info['category'])!==FALSE) {
				alert_back('생성되지 않은 게시판입니다.');
			}
			$this->view_data['category_name'] = $this->board_info['names'];
			$this->view_data['category'] = $this->category;

			# 현재 모양새를 가져온다.
			$this->appearance = $this->board_info['appearance'];
			$this->view_data['appearance'] = $this->board_info['appearance'];
			//print_R($this->view_data);

			# pagination 환경 설정
			$this->pagination_config = $this->config->item('pagination');
			$this->pagination_config['total_rows'] = $this->boardm->get_counts(array('category'=>$this->category)); # 총 게시물 수
			$this->pagination_config['per_page'] = 10; # 페이지당 표시할 게시물수
			$this->pagination_config['uri_segment'] = 4; # 페이지 번호가 지정될 세그먼트 번호
			$this->pagination_config['num_links'] = 5; # 표시될 페이지수 / 2 (5면 10개씩 표시됨)
			$this->pagination_config['base_url'] = site_url('board/lists/'.$this->category.'');

			# 전체 게시물 수
			$this->view_data['board_counts'] = $this->boardm->get_counts(array('category'=>$this->category));
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
			# 목록
			$this->pagination->initialize($this->pagination_config);
			$this->view_data['pagination'] = $this->pagination->create_links();
			$this->view_data['articles'] = $this->boardm->get_articles(
				array(
					'category'=>$this->category,
					'limit'=>$this->pagination_config['per_page'],
					'offset'=> $this->uri->segment($this->pagination_config['uri_segment'], 0)
				)
			);
			$this->load->view('board_list', $this->view_data);
		}


	/********************************
		R 게시글 조회
	********************************/
		public function retrieve()
		{
			# 전체 게시물 수
			$this->view_data['board_uid'] = $this->uri->segment(5, 0);

			# 조회 부분
			$model_data = array(
				'category'=>$this->category,
				'uid'=>$this->uri->segment(5, 0)
			);
			$this->view_data['retrieve'] = $this->boardm->get_article($model_data);
			$this->view_data['retrieve']['user_id_marked'] = marked_text($this->view_data['retrieve']['user_id']);
			# 댓글 부분
			$this->view_data['comment'] = $this->boardm->get_comments($model_data);
			$this->view_data['comment_count'] = cnt($this->view_data['comment']);
			//print_r($this->view_data['comment']);
			//print_r($this->view_data['comment_count']);

			# 조회 글이 없을 경우 목록으로 리디렉션
			if ($this->boardm->get_article($model_data) == FALSE) {
				redirect('/board/lists/'.$this->category.'/');
			}

			# 필터링 처리 후 view_data배열에 넣음
			$this->view_data['retrieve']['content'] = htmlspecialchars($this->view_data['retrieve']['content']);
			$this->view_data['retrieve']['content'] = nl2br($this->view_data['retrieve']['content']);

			# 조회수 업데이트 > 유저 정보 조회 > 일치시 > 세션에서 게시물 고유값을 갖고 있지 않을 경우에만 조회수 + 1
			$model_data_retrieve['signed_id'] = $this->session->userdata('signed_id');
			$count_retrieve = $this->memberm->get_user_data($model_data_retrieve);
			$writer_uid = $this->view_data['retrieve']['writer'];
			$signed_uid = $count_retrieve['uid'];
			if ($writer_uid != $signed_uid) {
				if ($this->session->userdata('sign_state') == TRUE) {
					$readed_article = $this->session->userdata('read_board_uid');
					$readed_article_array = explode('|',$readed_article);
					if (in_array($model_data['uid'], $readed_article_array) == FALSE) {
						$this->boardm->hit_plus($model_data);
						$readed_article .= '|'.$model_data['uid'];
						$this->session->set_userdata('read_board_uid', $readed_article);
						$this->view_data['retrieve']['hit'] = $this->view_data['retrieve']['hit']+1;
					}
				}
			}

			# 목록 부분
			$this->pagination->initialize($this->pagination_config);
			$this->view_data['pagination'] = $this->pagination->create_links();
			$this->view_data['articles'] = $this->boardm->get_articles(
				array(
					'category'=>$this->category,
					'limit'=>$this->pagination_config['per_page'],
					'offset'=> $this->uri->segment($this->pagination_config['uri_segment'], 0)
				)
			);
			$this->load->view('board_retrieve', $this->view_data);
		}


	/********************************
		U 게시글 수정 - 셀프
	********************************/
		public function update()
		{
			# 인증 되어 있지 않을 경우 목록으로 리디렉션
			if ($this->session->userdata('sign_state') == FALSE) {
				alert_home('게시물을 수정하기 위해서는 사인인 하여 주시기 바랍니다.');
			}

			# 관리자만 쓸 수 있음.
			if ($this->appearance == 'notice') {
				if ($this->auth->is_admin_signed() == FALSE) {
					alert_home('관리자만 이용 가능 합니다.');
				}
			}

			# 유저 정보 조회
			$signed_id = $this->session->userdata('signed_id');
			$model_data['signed_id'] = $signed_id;
			$user_data = $this->memberm->get_user_data($model_data);

			# 조회 부분 게시물을 얻는다.
			$model_data = array(
				'category'=>$this->category,
				'uid'=>$this->uri->segment(5, 0)
			);
			$this->view_data['retrieve'] = $this->boardm->get_article($model_data);
			if ($this->boardm->get_article($model_data) == FALSE) {
				redirect('/board/lists/'.$this->category.'/');
			}

			# 유저 정보와 작성자가 같으면 수정 가능
			$is_enable = FALSE;
			if ($user_data['uid'] == $this->view_data['retrieve']['writer']) {
				$is_enable = TRUE;
			} else {
				alert_back('작성자만 수정 가능 합니다.');
				redirect('/board/retrieve/'.$this->category.'/'.$this->uri->segment(4,0).'/'.$model_data['uid']);
			}

			# 밸리데이션
			$this->form_validation->set_rules('title', '제목', 'trim|required|xss_clean');
			$form_validate = $this->form_validation->run();

			# 밸리데이션 체크 실패 | 성공
			if ($form_validate == FALSE) {
				# ci set_value 기본값 설정
				$content = '';
				if (isset($_POST['content'])) {
					$content = $_POST['content'];
				}
				$this->view_data['title'] = $this->input->post('title');
				$this->view_data['content'] = htmlspecialchars_decode($content);
				$this->load->view('board_update', $this->view_data);

			} else {
				# 모델데이터 세팅
				$model_data = array(
					'uid' => $this->input->post('uid'),
					'title' => $this->input->post('title'),
					'content'=> $this->input->post('content')
				);
				# 갤러리 부분 모델 데이터
				$model_data['thumbnail'] = $this->input->post('thumbnail');
				$model_data['gallery_main_display'] = 'N';
				$posts = $this->input->post('gallery_main_display');
				if (empty($posts) === FALSE) {
					$model_data['gallery_main_display'] = 'Y';
				}

				# 게시물 업데이트
				if ($this->boardm->article_update($model_data)) {
					redirect('/board/retrieve/'.$this->category.'/'.$this->uri->segment(4,0).'/'.$this->boardm->last_article());
				}
			}
		}


	/********************************
		C 게시글 작성 - 셀프
	********************************/
		public function write()
		{
			# 인증 되어 있지 않을 경우 목록으로 리디렉션
			if ($this->session->userdata('sign_state') == FALSE) {
				home('게시물을 작성하기 위해서는 사인인 하여 주시기 바랍니다.');
			}

			# 관리자만 쓸 수 있음.
			if ($this->appearance == 'notice') {
				if ($this->auth->is_admin_signed() == FALSE) {
					alert_home('관리자 권한이 필요 합니다.');
				}
			}

			# 유저 정보 조회
			$model_data_retrieve = array();
			$this->view_data['signed_id'] = $this->session->userdata('signed_id');
			$model_data_retrieve['signed_id'] = $this->view_data['signed_id'];
			$retrieve = $this->memberm->get_user_data($model_data_retrieve);
			$this->view_data['retrieve'] = $retrieve;
			//print_r($model_data_retrieve);
			//print_r($this->view_data);

			# 밸리데이션
			$this->form_validation->set_rules('title', '제목', 'trim|required|xss_clean');
			$form_validate = $this->form_validation->run();
			//print_r($this->input->post());
			//print_r($_POST);
			# 밸리데이션 체크 실패 | 성공
			if ($form_validate == FALSE) {
				//echo "ss";
				# ci set_value 기본값 설정
				$content = '';
				if (isset($_POST['content'])) {
					$content = $_POST['content'];
				}
				$this->view_data['title'] = $this->input->post('title');
				$this->view_data['content'] = htmlspecialchars_decode($content);
				$this->load->view('board_write', $this->view_data);
			} else {
				# 모델데이터 세팅
				$model_data = array(
					'title' => $this->input->post('title'),
					'content'=> $_POST['content'],
					'category' => $this->input->post('category'),
					'writer' => $retrieve['uid'],
					'dates' => date('Y-m-d'),
					'times' => date('H:i:s')
				);
				//print_r($model_data);
				# 갤러리 부분 모델 데이터
				$model_data['thumbnail'] = $this->input->post('thumbnail');
				$model_data['gallery_main_display'] = 'N';
				$posts = $this->input->post('gallery_main_display');
				if (empty($posts) === FALSE) {
					$model_data['gallery_main_display'] = 'Y';
				}

				# 게시물 작성
				if ($this->boardm->article_write($model_data)) {
					# 작성자의 글쓴 횟수를 +1
					$this->memberm->plus_count($this->session->userdata('signed_id'), 'count_write_article');
					redirect('/board/retrieve/'.$this->category.'/'.$this->uri->segment(4,0).'/'.$this->boardm->last_article());
				}
			}
		}


	/********************************
		이미지 삽입 - 프로세스
	********************************/
		public function image_append($mode='')
		{
			# 모드가 업데이트 일 경우 섬네일과 본문 삽입을 분리 하기 위함.
			$this->view_data['mode'] = '';
			if ($mode=='update') {
				$this->view_data['mode'] = 'update';
			}

			$this->view_data['upload_error'] = '';
			$this->load->view('image_appender', $this->view_data);
		}

		public function image_append_next($mode='')
		{

			# 모드가 업데이트 일 경우 섬네일과 본문 삽입을 분리 하기 위함.
			$this->view_data['mode'] = '';
			if ($mode=='update') {
				$this->view_data['mode'] = 'update';
			}

			# 업로드 설정
			$upload_config = array(
				"upload_path" => 'attach/',
				"overwrite" => FALSE,
				"max_filename" => 250,
				"encrypt_name" => TRUE,
				"remove_spaces" => TRUE,
				"allowed_types" => "gif|jpg|png|jpeg",
				"max_size" => 0,
				"xss_clean" => TRUE,
				"max_width" => 0,
				"max_height" => 0
			);
			$this->upload->initialize($upload_config);

			# 업로드 실패 | 성공
			if (!$this->upload->do_upload('userfile')) {
				$this->view_data['upload_error'] = array('error' => $this->upload->display_errors());
				$this->load->view('image_appender', $this->view_data);
			} else {
				# 업로드 성공
				$uploaded_image = $this->upload->data();

				# thumb를 만든다.
				$thumb_config['image_library'] = 'gd2';
				$thumb_config['source_image'] = 'attach/'.$uploaded_image['raw_name'].''.$uploaded_image['file_ext'];
				$thumb_config['create_thumb'] = TRUE;
				$thumb_config['maintain_ratio'] = TRUE;
				$thumb_config['width'] = 138;
				$thumb_config['height'] = 97;
				$this->image_lib->clear();
				$this->image_lib->initialize($thumb_config);
				$this->image_lib->resize();
				$this->image_lib->clear();

				# 컨텐츠용을 만든다.
				$content_config['image_library'] = 'gd2';
				$content_config['source_image'] = 'attach/'.$uploaded_image['raw_name'].''.$uploaded_image['file_ext'];
				$content_config['create_thumb'] = TRUE;
				$content_config['thumb_marker'] = '_contents';
				if ($uploaded_image['image_width'] >= 720) {
					$content_config['maintain_ratio'] = TRUE;
					$content_config['master_dim'] = 'auto';
					$content_config['width'] = 720;
					$content_config['height'] = 720;
				}
				$this->image_lib->clear();
				$this->image_lib->initialize($content_config);
				$this->image_lib->resize();
				$this->image_lib->clear();

				$this->view_data['upload_data'] = array('upload_data' => $this->upload->data());
				$this->load->view('image_appender_next', $this->view_data);
			}
		}


	/********************************
		D 게시글 삭제 - 싱글
	********************************/
		public function erase()
		{

			# 관리자만 쓸 수 있음.
			if ($this->appearance == 'notice') {
				if ($this->auth->is_admin_signed() == FALSE) {
					alert_home('관리자 권한이 필요 합니다.');
				}
			}

			# 유저 정보 조회
			$signed_id = $this->session->userdata('signed_id');
			$model_data['signed_id'] = $signed_id;
			$user_data = $this->memberm->get_user_data($model_data);

			# 조회 부분
			$model_data = array(
				'category'=>$this->category,
				'uid'=>$this->uri->segment(5, 0)
			);
			$article_data = $this->boardm->get_article($model_data);

			#유저 정보와 작성자가 같으면 삭제 가능
			$is_enable = FALSE;
			if ($user_data['uid'] == $article_data['writer']) {
				$is_enable = TRUE;
			} else {
				alert_back('작성자만 삭제 가능 합니다.');
			}
			if ($is_enable == TRUE) {
				# 모델데이터 세팅
				$model_data = array(
					'uid' => $this->uri->segment(5,0),
					'is_blind' => 'Y'
				);
				# 게시물 업데이트
				$this->boardm->article_update($model_data);
			}
			redirect('/board/lists/'.$this->category.'/'.$this->uri->segment(4,0).'/');
		}


	/********************************
		댓글 - 싱글
	********************************/
		public function comment_write()
		{
			//$this->retrieve();
			# 인증 되어 있지 않을 경우 목록으로 리디렉션
			if ($this->session->userdata('sign_state') == FALSE) {
				alert_back('댓글을 작성하기 위해서는 사인인 하여 주시기 바랍니다.');
			}

			# 밸리데이션
			$posts1 = $this->input->post('comment');
			$posts2 = $this->input->post('board_uid');
			if (empty($posts1) && empty($posts2)) {
				alert_back('내용을 입력해 주십시오.');
			}

			# 아이디 추출
			$this->view_data['signed_id'] = $this->session->userdata('signed_id');
			$retrieve = $this->memberm->get_user_data($this->view_data);

			# 모델데이터 세팅
			$model_data = array(
				'board_uid' => $this->input->post('board_uid'),
				'writer' => $retrieve['uid'],
				'content'=> nl2br($this->input->post('comment')),
				'dates' => date('Y-m-d'),
				'times' => date('H:i:s')
			);

			# 쓰기일 경우
			if ($this->input->post('comment_mode') == 'create' && $this->input->post('comment_uid') == '0') {
				# 밸리데이션 성공시 작성
				if ($this->boardm->comment_write($model_data)) {
					# 작성자의 댓글쓴 횟수를 +1
					$this->memberm->plus_count($this->session->userdata('signed_id'), 'count_write_comment');
					redirect('/board/retrieve/'.$this->category.'/'.$this->uri->segment(4,0).'/'.$this->uri->segment(5,0));
				}
			}

			# 수정일 경우
			if ($this->input->post('comment_mode') == 'update') {
				# 모델데이터에 uid 추가.
				$model_data['uid'] =  $this->input->post('comment_uid');
				# 밸리데이션 성공시 작성
				if ($this->boardm->comment_update($model_data)) {
					redirect('/board/retrieve/'.$this->category.'/'.$this->uri->segment(4,0).'/'.$this->uri->segment(5,0));
				} else {
					alert_back('댓글 작성자가 아닙니다.');
				}
			}

			# 삭제일 경우
			if ($this->input->post('comment_mode') == 'erase') {
				# 모델데이터에 uid 추가.
				$model_data['uid'] =  $this->input->post('comment_uid');
				$model_data['is_blind'] = 'Y';
				# 밸리데이션 성공시 작성
				if ($this->boardm->comment_update($model_data)) {
					redirect('/board/retrieve/'.$this->category.'/'.$this->uri->segment(4,0).'/'.$this->uri->segment(5,0));
				} else {
					alert_back('댓글 작성자가 아닙니다.');
				}
			}

			# 댓글에 답글에 답글 인 경우.
			if ($this->input->post('comment_reply_writer') != '0') {
				$model_data['comment_reply_writer'] = $this->input->post('comment_reply_writer');
			}
			# 댓글에 답글 인 경우
			if ($this->input->post('comment_mode') == 'comment_reply') {
				# 모델데이터에 uid 추가.
				$model_data['parent_uid'] = $this->input->post('comment_parent_uid');
				# 밸리데이션 성공시 작성
				if ($this->boardm->comment_write($model_data)) {
					# 작성자의 댓글쓴 횟수를 +1
					$this->memberm->plus_count($this->session->userdata('signed_id'), 'count_write_comment');
					redirect('/board/retrieve/'.$this->category.'/'.$this->uri->segment(4,0).'/'.$this->uri->segment(5,0));
				}
			}
		}


	/********************************
		추천 - 싱글
	********************************/
		public function recommend()
		{
			//$this->retrieve();
			# 인증 되어 있지 않을 경우 목록으로 리디렉션
			if ($this->session->userdata('sign_state') == FALSE) {
				alert_back('추천을 위해서는 사인인 하여 주시기 바랍니다.');
			}
			# 밸리데이션
			# 밸리데이션
			$posts = $this->input->post('board_uid');
			if (empty($posts)) {
				alert_back('올바르지 않는 게시물 값 입니다.');
			}
			# 아이디 추출
			$this->view_data['signed_id'] = $this->session->userdata('signed_id');
			$retrieve = $this->memberm->get_user_data($this->view_data);

			# 모델데이터 세팅
			$model_data = array(
				'board_uid' => $this->input->post('board_uid'),
				'member_uid' => $retrieve['uid']
			);
			# 밸리데이션 성공시 작성 | 실패시 중복 추천
			if ($this->boardm->recommend_plus($model_data)) {
				redirect('/board/retrieve/'.$this->category.'/'.$this->uri->segment(4,0).'/'.$this->uri->segment(5,0));
			} else {
				alert_back('이미 추천 하셨습니다.');
			}
		}
}
/* End of file */