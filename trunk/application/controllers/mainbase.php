<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	Mainbase
	메인을 호출 하는 컨트롤러 이다.

**************************************************************************************************/
class Mainbase extends CI_Controller {
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
			$this->load->helper('form');
			$this->load->helper('n');

			# 모델
			$this->load->model('memberm');
			$this->load->model('boardm');

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
			/********************************
			#	새소식
			********************************/
				# 새소식 | 전체
				$model_data = array(
					'category' => 'noticeboard|updatenews',
					'limit' => 6,
					'orderby' => 'uid'
				);
				$top_notice_update_recommend = $this->boardm->get_recent_articles($model_data);
				$this->view_data['top_notice_update_recommend'] = $top_notice_update_recommend;

				# 공지사항
				$model_data = array(
					'category' => 'noticeboard',
					'limit' => 6,
					'orderby' => 'uid'
				);
				$top_notice_recommend = $this->boardm->get_recent_articles($model_data);
				$this->view_data['top_notice_recommend'] = $top_notice_recommend;

				# 업데이트
				$model_data = array(
					'category' => 'updatenews',
					'limit' => 6,
					'orderby' => 'uid'
				);
				$top_updatenews_recommend = $this->boardm->get_recent_articles($model_data);
				$this->view_data['top_updatenews_recommend'] = $top_updatenews_recommend;

			/********************************
			#	최신글
			********************************/
				# 전체 데이터 추출
				$model_data = array(
					'category' => 'freeboard',
					'limit' => 6,
					'orderby' => 'uid'
				);
				$top_freeboard_recent = $this->boardm->get_recent_articles($model_data);
				//print_r($top_freeboard_recent);
				$this->view_data['top_freeboard_recent'] = $top_freeboard_recent;

				# 인기순 데이터 추출.
				$model_data = array(
					'category' => 'freeboard',
					'limit' => 6,
					'orderby' => 'hit'
				);
				$top_freeboard_hit = $this->boardm->get_recent_articles($model_data);
				//print_r($top_freeboard_hit);
				$this->view_data['top_freeboard_hit'] = $top_freeboard_hit;

				# 추천순 데이터 추출
				$model_data = array(
					'category' => 'freeboard',
					'limit' => 6,
					'orderby' => 'recommend'
				);
				$top_freeboard_recommend = $this->boardm->get_recent_articles($model_data);
				$this->view_data['top_freeboard_recommend'] = $top_freeboard_recommend;

			/********************************
			#	갤러리
			********************************/
				# 전체 데이터 추출
				$model_data = array(
					'category' => 'gallery',
					'limit' => 4,
					'where_key1' => 'gallery_main_display',
					'where_val1' => 'Y',
					'orderby' => 'uid'
				);
				$top_gallery_recent = $this->boardm->get_recent_articles($model_data);
				//print_r($top_gallery_recent);
				$this->view_data['top_gallery_recent'] = $top_gallery_recent;

			# 뷰 호출
			$this->load->view('main', $this->view_data);
		}

}
/* End of file */