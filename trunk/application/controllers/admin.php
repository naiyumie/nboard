<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	Admin
	관리자-메인을 호출 하는 컨트롤러 이다.

**************************************************************************************************/
class Admin extends CI_Controller {
	/********************************
		선언
	********************************/
		# 전역 view_data
		var $view_data = array();
		# 컨텍스트
		var $context = 'admin';


	/********************************
		생성자
	********************************/
		public function __construct()
		{
			parent::__construct();

			# 라이브러리 & 헬퍼
			$this->load->helper('form');
			$this->load->helper('n');
			$this->load->helper('alert');

			# 모델
			$this->load->model('commonm');
			$this->load->model('memberm');
			$this->load->model('boardm');

			# sign 체크
			$this->load->library('auth');
			$this->view_data['signed'] = $this->auth->is_signed();
			$this->auth->check_admin_signed();

			# 사인인 후의 유저 정보
			$this->view_data['signed_data'] = $this->auth->get_user_info();

			# 컨텍스트를 view에 넘김
			$this->view_data['context'] = $this->context;
		}

	/********************************
		인덱스
	********************************/
		public function index()
		{

			/********************************
				최근 게시물
			********************************/
				# 멤버 최근 추출
				$model_data = array(
					'limit' => 5,
					'offset' => 0,
					'orderby' => 'dates'
				);
				$recent_joined_member = $this->memberm->get_members($model_data);
				$this->view_data['recent_joined_member'] = $recent_joined_member;
				//print_r($recent_joined_member);

				# 최근 게시물 데이터 추출
				$model_data = array(
					'limit' => 10,
					'orderby' => 'dates'
				);
				$top_article_recent = $this->boardm->get_recent_articles($model_data);
				$this->view_data['top_article_recent'] = $top_article_recent;

				# 최근 댓글 데이터 추출
				$model_data = array(
					'limit' => 10,
					'orderby' => 'dates'
				);
				$top_comment_recent = $this->boardm->get_recent_comments($model_data);
				//print_r($top_comment_recent);
				$this->view_data['top_comment_recent'] = $top_comment_recent;
				//print_r($top_article_recent);
			/********************************
				대시보드 카운트
			********************************/
				# 멤버 카운트
				$model_data = array(
					'environment' => array(
						'context' => 'members'
					)
				);
				$count = $this->commonm->get_counts($model_data);
				$this->view_data['member_count'] = $count;
				//print_r($count);

				# 게시물 카운트
				$model_data = array(
					'environment' => array(
						'context' => 'board'
					)
				);
				$count = $this->commonm->get_counts($model_data);
				$this->view_data['article_count'] = $count;
				//print_r($count);

				# 사인인 멤버 카운트
				$model_data = array(
					'environment' => array(
						'context' => 'ci_sessions'
					)
				);
				$count = $this->commonm->get_counts($model_data);
				$this->view_data['session_count'] = $count;
				//print_r($count);

				# 신규 멤버 카운트
				$model_data = array(
					'environment' => array(
						'context' => 'members'
					),
					'search_key' => 'dates',
					'search_value' => date('Y-m')
				);
				$count = $this->commonm->get_counts($model_data);
				$this->view_data['newbie_count'] = $count;
				//echo $this->db->last_query();
				//print_r($count);

				# 댓글 카운트
				$model_data = array(
					'environment' => array(
						'context' => 'board_comment'
					)
				);
				$count = $this->commonm->get_counts($model_data);
				$this->view_data['board_comment_count'] = $count;
				//print_r($count);

				# 추천 카운트
				$model_data = array(
					'environment' => array(
						'context' => 'board_recommend'
					)
				);
				$count = $this->commonm->get_counts($model_data);
				$this->view_data['board_recommend_count'] = $count;
				//print_r($count);

			# 뷰 호출
			$this->load->view('admin_main', $this->view_data);
		}

	/********************************
		DB 관리툴 phpmyadmin을 낑겨 넣은 패기
	********************************/
		public function phpmyadmin()
		{
			# 뷰 호출
			$this->load->view('admin_phpmyadmin', $this->view_data);
		}

}
/* End of file */