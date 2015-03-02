<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	Member
	멤버를 관리하는 컨트롤러 이다.

**************************************************************************************************/
class Member extends CI_Controller {
	/********************************
		선언
	********************************/
		# 전역 view_data
		var $view_data = array();
		# 캡챠 환경
		var $captcha_config = array();


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

			# 모델
			$this->load->model('memberm');
			$this->load->model('captcham');

			# 폼 밸리데이션
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="fail">', '</span>');

			# captcha
			$this->load->helper('captcha');
			$this->captcha_config = array(
				'word' => '',
				'img_path' => 'captcha/',
				'img_url' => base_url().'/captcha/',
				'font_path' => './assets/verdana.ttf',
				'img_width' => '202',
				'img_height' => 50,
				'expiration' => 7200
			);

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
		멤버 사인 인 - 셀프
	********************************/
		public function sign_in($mode='')
		{
			# 클릭했을때는 밸리데이션이 틀렸다는 부분을 보여 주지 않음.
			if ($mode=='go') {
				$this->view_data['signed_false'] = FALSE;
				$this->load->view('singlesign', $this->view_data);
				return;
			}

			# 입력값이 없을때만 밸리데이션 설정
			$form_validate = FALSE;
			$posts = $this->input->post('user_id');
			if (empty($posts) === FALSE) {
				$this->form_validation->set_rules('user_id', '아이디', 'trim|required|min_length[4]|max_length[16]|xss_clean');
				$this->form_validation->set_rules('user_pw', '패스워드', 'trim|required|min_length[4]|max_length[16]');
				$this->form_validation->set_rules('signin_type', '사인 타입', 'required');
				$form_validate = $this->form_validation->run();
			}
			//print_r( $this->input->post() );

			# 밸리데이션이 틀렸다는 부분을 보여주지 않는 플래그
			$this->view_data['signed_false'] = FALSE;

			# 밸리데이션 실패 | 성공
			if ($form_validate == FALSE) {
				//echo "validation false";
				# 뷰 : 밸리데이션이 틀렸다는 부분을 보여줌
				$this->view_data['signed_false'] = TRUE;
				$this->load->view('singlesign', $this->view_data);
			} else {
				# 입력값에 따라 사인인을 db에서 체크 한다.
				$model_data = array(
					'user_id' => $this->input->post('user_id'),
					'user_pw' => $this->input->post('user_pw'),
					'type' => $this->input->post('signin_type')
				);
				$model_result = $this->memberm->sign_in($model_data);

				# 데이터가 없으면 | 있으면
				if ($model_result == FALSE) {
					//alert_back('아이디 혹은 패스워드를 확인 하십시오.');
					//echo "model_false";

					# 밸리데이션이 틀렸다는 플래그를 설정한다.
					$this->view_data['signed_false'] = TRUE;
				} else {
					//echo "model true";
					# 마지막 사인인 시간을 업데이트 한다.
					$model_data = array(
						'signed_dates' => date('Y-m-d'),
						'signed_times' => date('H:i:s')
					);
					$this->memberm->updating($model_data, $this->input->post('user_id'));

					# 사인인 횟수 증가.
					$this->memberm->plus_count($this->input->post('user_id'), 'count_signed');

					# 유저 데이터를 조회 한다.
					$model_data = array(
						'signed_id' => $this->input->post('user_id')
					);
					$signed_user_data = $this->memberm->get_user_data($model_data);
					$signed_user_data['introduce'] = '';

					# 세션에 유저 데이터를 집어 넣는다.
					$this->session->set_userdata('sign_state', TRUE); # 사인 상태값을 TRUE로 변경
					$this->session->set_userdata('signed_id', $this->input->post('user_id')); # 사인인된 아이디 생성
					$this->session->set_userdata('signed_data', $signed_user_data); # 배열을 그대로 넣음.

					# 조회수를 위한 세션 데이터 생성
					$this->session->set_userdata('read_board_uid', '|');
					redirect('/');
				}

				# 뷰 호출
				$this->load->view('singlesign', $this->view_data);
			}
		}


	/********************************
		멤버 가입 - 웹플로우
	********************************/
		public function sign_up()
		{
			$this->signup_licence_agreement();
		}

		# 약관동의
		public function signup_licence_agreement()
		{
			$this->load->view('signup_licence_agreement', $this->view_data);
		}

		# 기본정보 입력
		public function signup_join_form()
		{
			# 입력된 항목 중 아래 내용이 없을 경우 뒤로. | 있을 경우
			if ($this->input->post('term_agreement') != 'agree' && $this->input->post('privacy_polish') != 'agree') {
				back();
			} else {
				# 뷰에 히든으로 바인딩 할 폼데이터를 넣는다.
				$this->view_data['form_data'] = $this->input->post();
			}

			# 뷰 호출
			$this->load->view('signup_join_form', $this->view_data);
		}

		# 가입인증
		public function signup_join_authentication()
		{
			# 입력된 항목 중 아래 내용이 없을 경우 뒤로.
			if ($this->input->post('term_agreement') != 'agree' && $this->input->post('privacy_polish') != 'agree') {
				back();
			}

			# 밸리데이션 설정
			$this->form_validation->set_rules('term_agreement', '이용정보동의', 'trim|required');
			$this->form_validation->set_rules('privacy_polish', '개인정보동의', 'trim|required');

			$this->form_validation->set_rules('user_id', '아이디', 'trim|required|min_length[4]|max_length[16]|is_unique[members.user_id]');
			$this->form_validation->set_rules('user_pw', '패스워드', 'trim|required|min_length[4]|max_length[16]|matches[user_pw_verify]');
			$this->form_validation->set_rules('user_pw_verify', '패스워드 확인', 'trim|required|matches[user_pw]');
			$this->form_validation->set_rules('nick', '별명', 'trim|required|is_unique[members.nick]');
			$this->form_validation->set_rules('email', '이메일', 'trim|required|valid_email|is_unique[members.email]');
			$this->form_validation->set_rules('introduce', '자기소개', 'trim|xss_clean');
			if (ENVIRONMENT == 'development') {
				# type을 받을때는 개발 할때만 받는다.
				$this->form_validation->set_rules('type', '타입', 'required|xss_clean');
			}

			# formdata 웹플로우 (데이터 바인딩 - 히든에 집어 넣는다.)
			$this->view_data['form_data'] = $this->input->post();
			$this->view_data['form_data']['introduce'] = nl2br($this->input->post('introduce'));

			# 밸리데이션 체크 실패 | 성공
			if ($this->form_validation->run() == FALSE) {
				//echo validation_errors('<div class="error">', '</div>');
				# 뷰 호출 : 가입 폼
				$this->load->view('signup_join_form', $this->view_data);
			} else {
				# 뷰 호출 : 캡차를 생성 한뒤 가입 인증 뷰호출.
				$this->view_data['captcha'] = $this->_create_captcha();
				$this->load->view('signup_join_authentication', $this->view_data);
			}
		}

		# 가입완료 - 데이터 삽입 부분
		public function signup_compleate()
		{
			# 입력된 항목 중 아래 내용이 없을 경우 뒤로.
			if ($this->input->post('term_agreement') != 'agree' && $this->input->post('privacy_polish') != 'agree') {
				back();
			}

			# formdata 웹플로우 (데이터 바인딩 - 히든에 집어 넣는다.)
			$this->view_data['form_data'] = $this->input->post();

			# 캡차 밸리데이션 체크
			$model_data = array(
				'captcha' => $this->input->post('captcha')
			);

			# 캡차 밸리데이션이 틀렸을경우 | 맞을경우
			if ($this->captcham->validation($model_data) == FALSE) {
				# 뷰 호출 : 캡차 생성하고 가입 인증 뷰호출.
				$this->view_data['captcha'] = $this->_create_captcha();
				$this->load->view('signup_join_authentication', $this->view_data);
			} else {
				# 데이터를 db에 집어 넣는다.
				$model_data = array(
					'term_agreement'=>$this->input->post('term_agreement'),
					'privacy_polish'=>$this->input->post('privacy_polish'),
					'user_id' => $this->input->post('user_id'),
					'user_pw' => $this->input->post('user_pw'),
					'nick' => $this->input->post('nick'),
					'email'=> $this->input->post('email'),
					'introduce' => nl2br($this->input->post('introduce')),

					'dates' => date('Y-m-d'),
					'times' => date('H:i:s'),
					'captcha' => $this->input->post('captcha')
				);
				if (ENVIRONMENT == 'development') {
					$model_data['type'] = $this->input->post('type');
				}
				$this->memberm->sign_up($model_data);

				# 다음 페이지에서 한번만 시작되도록 플래시 데이터 삽입.
				$flash_data = $this->session->set_flashdata('user_id',$this->input->post('user_id'));
				redirect('member/signup_finished');
			}
		}

		# 가입완료 - 데이터 조회 하여 보여줌.
		public function signup_finished()
		{
			# 저장된 플래시 데이터에 의해 한번만 실행됨.
			$flash_data = $this->session->flashdata('user_id');
			if (empty($flash_data)) {
				home();
			}
			# 유저 데이터를 조회 한다.
			$model_data = array(
				'signed_id' => $flash_data
			);
			$this->view_data['retrieve'] = $this->memberm->get_user_data($model_data);

			# 뷰 호출 : 가입 완료 되었음
			$this->load->view('signup_compleate', $this->view_data);
		}

		# ajax 캡챠 생성
		public function get_ajax_captcha()
		{
			exit($this->_create_captcha());
		}

		# 캡차 생성 서브 루틴
		public function _create_captcha()
		{
			# 캡차 생성 한뒤
			$captcha_string = strtolower(random_string('alnum', 5));
			$this->captcha_config['word'] = $captcha_string;
			$captcha = create_captcha($this->captcha_config);

			# DB에 해당 텍스트 정보 저장.
			$model_data = array(
				'captcha_time' => $captcha['time'],
				'ip_address' => $this->input->ip_address(),
				'word'	=> $captcha['word']
			);
			$this->captcham->save_validate_data($model_data);
			return $captcha['image'];
		}


	/********************************
		멤버 사인 체크 - 싱글
		deprecated : library Auth를 사용한다.
	********************************/
		public function sign_check()
		{
			if ($this->session->userdata('sign_state') == TRUE) {
				//echo "signed";
				return TRUE;
			} else {
				//echo "unsigned";
				return FALSE;
			}
		}


	/********************************
		멤버 사인 아웃 - 싱글
	********************************/
		public function sign_out()
		{
			# 세션 파괴 하고 홈으로
			$this->session->sess_destroy();
			home();
		}


	/********************************
		멤버 탈퇴 - 프로세스
	********************************/
		public function leave()
		{
			# 사인중일때만
			if ($this->auth->is_signed() == FALSE) {
				home();
			}

			# 세션 정보 불러옴
			$this->view_data['signed_id'] = $this->session->userdata('signed_id');
			//$this->view_data['signed_data'] = $this->session->userdata('signed_data');

			# 뷰 호출
			$this->load->view('member_leave', $this->view_data);
		}

		# 멤버 탈퇴 프로세스
		public function leave_proc()
		{
			# 사인중일때만
			if ($this->auth->is_signed() == FALSE) {
				home();
			}

			//print_r($this->auth->is_signed());
			//print_r($this->input->post());

			# 세션 정보 불러옴
			$this->view_data['signed_id'] = $this->session->userdata('signed_id');

			# 밸리데이션 설정
			$this->form_validation->set_rules('user_pw', '패스워드', 'trim|required|min_length[4]');

			# 밸리데이션 체크
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('member_leave', $this->view_data);
				return;
			}

			# 사인인 패스워드 체크
			$model_data = array(
				'user_id' => $this->session->userdata('signed_id'),
				'user_pw' => $this->input->post('user_pw'),
				'type' => $this->view_data['signed_data']['type']
			);
			$model_result = $this->memberm->sign_in($model_data);
			//print_r($model_result);

			# 패스워드가 틀릴 경우 | 맞을 경우
			if ($model_result == FALSE) {
				//exit("아이디 혹은 패스워드를 확인");
				alert_back('아이디 혹은 패스워드를 확인 하십시오.');
			} else {
				# 탈퇴 됨. db(user_leaved)에 데이터를 집어 넣고 삭제
				//exit("탈퇴 됨.");
				$model_data = array();
				$model_data['signed_id'] = $this->session->userdata('signed_id');
				$model_data['leaved_message'] = $this->input->post('leaved_message');
				$erased = $this->memberm->erase_user_data($model_data);
				# 세션 파괴
				$this->session->sess_destroy();
			}
			alert_home('탈퇴 되었습니다. 감사합니다.');
		}


	/********************************
		아이디 찾기 - 셀프
	********************************/
		public function findid()
		{
			//print_r( $this->input->post() );
			# 입력값이 없을때만 밸리데이션 설정
			$form_validate = FALSE;
			$posts = $this->input->post('email');
			if (empty($posts) === FALSE) {
				$this->form_validation->set_rules('email', '이메일', 'trim|required|valid_email');
				$form_validate = $this->form_validation->run();
			}

			# 찾는 아이디를 보여주는 부분.
			$this->view_data['finded_id'] = '찾는 아이디가 없습니다.';

			# 이메일 발송 사실을 알려주는 플래그
			$this->view_data['email_sended'] = FALSE;

			# 밸리데이션 실패 | 성공
			if ($form_validate == FALSE) {
				# 뷰 호출
				$this->load->view('findid', $this->view_data);
				return;
			} else {
				# 입력 이메일값에 따라 아이디를 db에서 조회 한다.
				$model_data = array(
					'email' => $this->input->post('email')
				);
				$model_result = $this->memberm->findid($model_data);

				# 데이터가 있으면
				if ($model_result != FALSE) {
					//echo "model true";
					# 적당히 마킹
					$model_result_marked = marked_text($model_result);
					$this->view_data['finded_id'] = '귀하의 아이디는 '.$model_result_marked.' 입니다.';

					# 메일 폼의 모조 변수를 파싱.
					$this->load->library('parser');
					$data = array(
						'user_id' => $model_result,
						'url' => base_url()
					);
					$mailform = $this->parser->parse('mailform_findid', $data, TRUE);
					$to = $this->input->post('email');
					//$to = 'naiyumie@gmail.com';

					# 라이브러리 로드
					$this->load->library('email');

					# 메일 보내는 사람의 메일주소와 이름을 설정
					$this->email->from('naiyumie@gmail.com', '나이유미');

					# 수신자의 이메일주소를 설정, 하나이상의 주소를 설정할수있으며 , 여러개를 설정할때는 콤마(,)로 구분하여 설정하거나, 배열로 넘겨줄수도 있다.
					$this->email->to($to);

					# 메일 제목을 설정
					$this->email->subject('[나이유미 게시판] 요청하신 아이디 정보를 알려 드립니다.');

					# 이메일 내용을 설정
					$this->email->message($mailform);
					$this->email->set_mailtype('html');

					# 이메일을 발송
					$this->email->send();
					//log_message ('info', "email sending".$this->email->print_debugger());
					//echo $this->email->print_debugger();
					$this->view_data['email_sended'] = TRUE;
				}

				# 뷰 호출
				$this->load->view('findid', $this->view_data);
			}

		}


	/********************************
		패스워드 찾기 - 셀프
	********************************/
		public function findpassword($mode='')
		{
			# description값을 설정
			$this->view_data['description'] = TRUE;

			# 클릭했을때는 밸리데이션이 틀렸다는 부분을 보여 주지 않음.
			if ($mode=='go') {
				$this->view_data['description'] = FALSE;
				$this->load->view('findpassword', $this->view_data);
				return;
			}

			//print_r( $this->input->post() );
			# 입력값이 없을때만 밸리데이션 설정
			$form_validate = FALSE;
			$posts1 = $this->input->post('user_id');
			$posts2 = $this->input->post('email');
			if (empty($posts1) === FALSE && empty($posts2) === FALSE) {
				$this->form_validation->set_rules('user_id', '아이디', 'trim|required|min_length[4]|max_length[16]');
				$this->form_validation->set_rules('email', '이메일', 'trim|required|valid_email');
				$form_validate = $this->form_validation->run();
			}

			# 아이디&패스워드 일치 여부 플래그
			$this->view_data['you_our_member'] = FALSE;

			# 이메일 발송 사실을 알려주는 플래그
			$this->view_data['email_sended'] = FALSE;

			# 밸리데이션 실패 | 성공
			if ($form_validate == FALSE) {
				# 뷰 호출
				$this->load->view('findpassword', $this->view_data);
				return;
			} else {
				# 입력 아이디&이메일값에 따라 유저정보가 있는지를 db에서 조회 한다.
				$model_data = array(
					'user_id' => $this->input->post('user_id'),
					'email' => $this->input->post('email')
				);
				$model_result = $this->memberm->findpassword($model_data);

				# 데이터가 있으면 임시 비밀번호를 리턴 할 것이다.
				if ($model_result != FALSE) {
					//echo "model true";
					//# 적당히 마킹
					//$model_result_marked = marked_text($model_result);
					//$this->view_data['finded_id'] = '귀하의 아이디는 '.$model_result_marked.' 입니다.';
					$this->view_data['you_our_member'] = TRUE;

					# 메일 폼의 모조 변수를 파싱.
					$this->load->library('parser');
					$data = array(
						'user_password' => $model_result,
						'url' => base_url()
					);
					$mailform = $this->parser->parse('mailform_findpassword', $data, TRUE);
					$to = $this->input->post('email');
					//$to = 'naiyumie@gmail.com';

					# 라이브러리 로드
					$this->load->library('email');

					# 메일 보내는 사람의 메일주소와 이름을 설정
					$this->email->from('naiyumie@gmail.com', '나이유미');

					# 수신자의 이메일주소를 설정, 하나이상의 주소를 설정할수있으며 , 여러개를 설정할때는 콤마(,)로 구분하여 설정하거나, 배열로 넘겨줄수도 있다.
					$this->email->to($to);

					# 메일 제목을 설정
					$this->email->subject('[나이유미 게시판] 요청하신 패스워드 정보를 알려 드립니다.');

					# 이메일 내용을 설정
					$this->email->message($mailform);
					$this->email->set_mailtype('html');

					# 이메일을 발송
					$this->email->send();
					//log_message ('info', "email sending".$this->email->print_debugger());
					//echo $this->email->print_debugger();

					$this->view_data['email_sended'] = TRUE;
				}

				# 뷰 호출
				$this->load->view('findpassword', $this->view_data);
			}
		}


	/********************************
		패스워드 변경 - 셀프
	********************************/
		public function password_change()
		{
			//print_r( $this->input->post() );

			# 사인중일때만
			if ($this->auth->is_signed() == FALSE) {
				home();
			}

			# 세션 정보 불러옴
			$this->view_data['signed_id'] = $this->session->userdata('signed_id');
			//$this->view_data['signed_data'] = $this->session->userdata('signed_data');

			# 멤버 정보 조회 데이터
			$this->view_data['retrieve'] = $this->view_data['signed_data'];

			# 밸리데이션
			$this->form_validation->set_rules('user_current_pw', '기존 패스워드', 'trim|min_length[4]|max_length[16]');
			$this->form_validation->set_rules('user_new_pw', '패스워드 변경', 'trim|min_length[4]|max_length[16]|matches[user_new_pw_verify]');
			$this->form_validation->set_rules('user_new_pw_verify', '변경 패스워드 확인', 'trim|min_length[4]|max_length[16]|matches[user_new_pw]');

			# 업데이트 여부 사용자 메시징 플래그
			$this->view_data['is_updating'] = FALSE;

			# 밸리데이션 실행 실패 | 성공
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('signinfo_password_change', $this->view_data);
			} else {
				# 모델데이터 세팅 및 멤버 아이디 패스워드 타입 체크 하여 정보 일치 검사.
				$model_data_id_pw = array(
					'user_id' => $this->view_data['signed_id'],
					'user_pw' => $this->input->post('user_current_pw'),
					'type' => $this->view_data['signed_data']['type']
				);
				$member_check = $this->memberm->sign_in($model_data_id_pw);

				# 기존 패스워드 일치 여부가 성공이면
				if ($member_check) {
					//echo "sign true";
					# 업데이트를 위한 모델 세팅
					$model_data = array(
						'user_id' => $this->view_data['signed_id'],
						'user_pw' => $this->input->post('user_new_pw')
					);
					# 업데이트 한다.
					$this->memberm->password_upading($model_data);

					# 업데이트 여부 플래그를 TRUE로 놓는다.
					$this->view_data['is_updating'] = TRUE;

					# 업데이트 되었을경우 다시 사인인 하여야 함.
					$this->session->sess_destroy();
				}

				# 뷰 호출
				$this->load->view('signinfo_password_change', $this->view_data);
			}
		}


	/********************************
	   멤버 조회 및 수정 - 셀프
	********************************/
		public function retrieve_and_update()
		{
			//print_r( $this->input->post() );

			# 사인중일때만
			if ($this->auth->is_signed() == FALSE) {
				home();
			}

			# 세션 정보 불러옴
			$this->view_data['signed_id'] = $this->session->userdata('signed_id');
			//$this->view_data['signed_data'] = $this->session->userdata('signed_data');

			# 멤버 정보 조회 데이터 = 기본적으로 세션 데이터를 가져오고
			$this->view_data['retrieve'] = $this->view_data['signed_data'];
			$model_data = array(
				'signed_id' => $this->session->userdata('signed_id')
			);
			# db에서 가져온다.
			$retrieve = $this->memberm->get_user_data($model_data);
			$this->view_data['retrieve']['introduce'] = $retrieve['introduce'];

			# 밸리데이션
			$this->form_validation->set_rules('user_new_pw', '패스워드 변경', 'trim|min_length[4]|max_length[16]|matches[user_new_pw_verify]');
			$this->form_validation->set_rules('user_new_pw_verify', '변경 패스워드 확인', 'trim');
			$this->form_validation->set_rules('nick', '별명', 'trim|required||min_length[4]|xss_clean');
			$this->form_validation->set_rules('email', '이메일', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('introduce', '자기소개', 'trim|required|xss_clean');
			$this->form_validation->set_rules('type', '타입', 'required|xss_clean');
			$this->form_validation->set_rules('user_current_pw', '기존 패스워드', 'trim|min_length[4]|max_length[16]|xss_clean');

			# 입력된 데이터가 있을경우 입력된 데이터 유지
			if ($this->input->post('nick')) {
				$this->view_data['retrieve']['nick'] = $this->input->post('nick');
			}
			if ($this->input->post('email')) {
				$this->view_data['retrieve']['email'] = $this->input->post('email');
			}
			if ($this->input->post('introduce')) {
				$this->view_data['retrieve']['introduce'] = $this->input->post('introduce');
			}

			# 업데이트 (변경이 되었는지) 여부 전체 검사.
			$change_able_flag = TRUE;

			# 업데이트 여부 사용자 메시징 플래그
			$this->view_data['is_updating'] = FALSE;

			# 아이디 패스워드 체크 플래그
			$this->view_data['check_id_pw'] = FALSE;

			# 닉네임 변경이 됨 체크 플래그
			$this->view_data['nick_change_able'] = FALSE;

			# 이메일 변경이 됨 체크 플래그
			$this->view_data['email_change_able'] = FALSE;

			# 밸리데이션 실행 실패 | 성공
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('signinfo_retrieve_and_update', $this->view_data);
			} else {
				# 모델데이터 세팅 및 멤버 아이디 패스워드 타입 체크 하여 정보 일치 검사.
				$model_data_id_pw = array(
					'user_id' => $this->view_data['signed_id'],
					'user_pw' => $this->input->post('user_current_pw'),
					'type' => $this->view_data['signed_data']['type']
				);
				$member_check = $this->memberm->sign_in($model_data_id_pw);

				# 기존 패스워드 일치 여부가 성공이면
				if ($member_check) {

					# 밸리데이션 : 비밀번호 변경 플래그
					$this->view_data['check_id_pw'] = TRUE;

					//echo "sign true";
					# 업데이트를 위한 모델 세팅
					$model_data = array(
						'nick' => $this->input->post('nick'),
						'email'=> $this->input->post('email'),
						'introduce' => $this->input->post('introduce'),
						'type' => $this->input->post('type')
					);

					# 업데이트를 위한 아이디 세팅
					$model_id = $this->view_data['signed_id'];

					# 밸리데이션 : nick 유니크 검사.
					if ($this->memberm->is_unique_by_id($model_data, $model_id, 'nick') == TRUE) {
						$change_able_flag = FALSE;
						$this->view_data['nick_change_able'] = TRUE;
					}

					# 밸리데이션 : email 유니크 검사.
					if ($this->memberm->is_unique_by_id($model_data, $model_id, 'email') == TRUE) {
						$change_able_flag = FALSE;
						$this->view_data['email_change_able'] = TRUE;
					}

					# 위의 필드가 중복되지 않을 경우만 가능
					if ($change_able_flag == TRUE) {
						# 업데이트 한다.
						$this->memberm->updating($model_data, $model_id);

						# 업데이트 여부 플래그를 TRUE로 놓는다.
						$this->view_data['is_updating'] = TRUE;

						# 업데이트 되었을경우 다시 사인인 하여야 함.
						$this->session->sess_destroy();

					}
				}

				# 뷰 호출
				$this->load->view('signinfo_retrieve_and_update', $this->view_data);
			}
		}


}
/* End of file */