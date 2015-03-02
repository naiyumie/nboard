<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	멤버 모델

**************************************************************************************************/
class Memberm extends CI_Model {
	/********************************
		생성자
	********************************/
		function __construct()
		{
			parent::__construct();
			$this->load->library('encrypt');
		}


	/**************************************************************************************************

		사용자 관리자 공통

	**************************************************************************************************/
		/********************************
			유저 정보 등록
		********************************/
			public function sign_up($args)
			{
				$args['user_pw'] = $this->encrypt->encode($args['user_pw']);
				$query = $this->db->insert('members', $args);
				$affected = $this->db->affected_rows();
				//echo "affected".$affected;
				$ret = FALSE;
				if ($affected > 0) {
					$ret = TRUE;
				}
				//echo $ret;
				return $ret;
			}

		/********************************
			유저의 아이디 패스워드 체크
		********************************/
			public function sign_in($args)
			{
				//$this->db->get('members');
				$user_id = (string) $args['user_id'];
				$this->db->where('user_id', $user_id);
				$this->db->where('type', $args['type']);
				$this->db->where('is_blind', 'N');
				$this->db->from('members');
				$query = $this->db->get();
				$result = $query->row_array();
				$user_pw = '';
				if(count($result) > 0){
					//print_R($result);
					$user_pw = $this->encrypt->decode($result['user_pw']);
					//echo $user_pw;
					//echo "////";
					//echo $args['user_pw'];
				}
				$ret = FALSE;
				if ($user_pw == $args['user_pw']) {
					$ret = TRUE;
				}
				return $ret;
			}

		/********************************
			유저의 데이터를 얻는다.
		********************************/
			public function get_user_data($args)
			{
				$args['signed_id'] = (string) $args['signed_id'];
				$this->db->where('user_id', $args['signed_id']);
				$this->db->where('is_blind', 'N');
				$this->db->from('members');
				$query = $this->db->get();
				//print_r($this->db->last_query());
				//print_r($query->row_array());
				if ($query->num_rows() > 0) {
					return $query->row_array();
				} else {
					return FALSE;
				}
			}

		/********************************
			유저 데이터 탈퇴
		********************************/
			public function erase_user_data($args)
			{
				$content = '';
				$content .= $args['leaved_message'];
				$model_data = array(
					'leaved_message' => $content,
					'leaved_dates' => date('Y-m-d'),
					'leaved_times' => date('H:i:s'),
					'is_blind' => 'Y'
				);
				$this->db->where('user_id', $args['signed_id']);
				$this->db->update('members', $model_data);
				return TRUE;
			}

		/********************************
			해당 키가 고유값인지
		********************************/
			public function is_unique_by_id($args, $id, $col)
			{
				$this->db->where('user_id !=', $id);
				$this->db->where($col, $args[$col]);
				$query = $this->db->get('members');
				$ret = FALSE;
				if ($query->num_rows() > 0) {
					$ret = TRUE;
				}
				return $ret;
			}

		/********************************
			user_id를 기준으로 업데이트 한다.
		********************************/
			public function updating($args, $id)
			{
				$this->db->where('user_id', $id);
				$this->db->update('members', $args);
				if ($this->db->affected_rows() > 0) {
					return TRUE;
				} else {
					return FALSE;
				}
			}

		/********************************
			uid를 기준으로 업데이트 한다.
		********************************/
			public function updates($args)
			{
				$this->db->where('uid', $args['uid']);
				$this->db->update('members', $args);
				return TRUE;
			}

		/********************************
			이메일을 기준으로 아이디를 추출
		********************************/
			public function findid($args)
			{
				$args['email'] = (string) $args['email'];
				$this->db->where('email', $args['email']);
				$this->db->where('is_blind', 'N');
				$this->db->from('members');
				$query = $this->db->get();
				if ($query->num_rows() > 0) {
					$ret = $query->row_array();
					$ret = $ret['user_id'];
					return $ret;
				} else {
					return FALSE;
				}
			}

		/********************************
			아이디 이메일을 기준으로
			유저 존재 여부 검색.
		********************************/
			public function findpassword($args)
			{
				$args['email'] = (string) $args['email'];
				$args['user_id'] = (string) $args['user_id'];
				$this->db->where('email', $args['email']);
				$this->db->where('user_id', $args['user_id']);
				$this->db->where('is_blind', 'N');
				$this->db->from('members');
				$query = $this->db->get();
				if ($query->num_rows() > 0) {
					$temp_password = strtolower(random_string('alnum', 5));
					$temp_password_encoded = $this->encrypt->encode($temp_password);
					$this->db->where('user_id', $args['user_id']);
					$model_data = array(
						'user_pw'=>	$temp_password_encoded
					);
					$this->db->update('members', $model_data);
					return $temp_password;
				} else {
					return FALSE;
				}
			}

		/********************************
			패스워드 업데이트
		********************************/
			public function password_upading($args)
			{
				$args['user_pw'] = $this->encrypt->encode($args['user_pw']);
				$this->db->where('user_id', $args['user_id']);
				$this->db->update('members', $args);
				if ($this->db->affected_rows() > 0) {
					return TRUE;
				} else {
					return FALSE;
				}
			}

		/********************************
			수 증가
		********************************/
			public function plus_count($user_id, $target_column)
			{
				$this->db->set($target_column, $target_column.' + 1', FALSE);
				$this->db->where('user_id', $user_id);
				$this->db->update('members');
				if ($this->db->affected_rows() > 0) {
					return TRUE;
				} else {
					return FALSE;
				}
			}


	/**************************************************************************************************

		관리자 작업시 추가

	**************************************************************************************************/
		/********************************
			카운트를 얻는다.
		********************************/
			public function get_counts($args)
			{
				# 일반 값 검색일 경우
				if (isset($args['search_key']) && isset($args['search_value'])) {
					$this->db->like($args['search_key'], $args['search_value']);
				}
				# dates 검색일 경우
				if (isset($args['search_key']) && isset($args['search_value_start']) && isset($args['search_value_end'])) {
					# SELECT * FROM `naiyumie`.`crud` WHERE dates >= '2015-02-23'  AND dates <= '2015-02-24'
					$start_key = $args['search_key'].'>=';
					$end_key = $args['search_key'].'<=';
					$this->db->where($start_key, "'".$args['search_value_start']."'", FALSE);
					$this->db->where($end_key, "'".$args['search_value_end']."'", FALSE);
				}
				$this->db->from('members');
				$query = $this->db->get();
				$ret = $query->num_rows();
				return $ret;
			}

		/********************************
			멤버 목록을 조회한다.
		********************************/
			public function get_members($args)
			{
				$this->db->select('*');
				$this->db->from('members');
				$this->db->limit($args['limit'], $args['offset']);
				$this->db->order_by('uid','desc');
				# 일반 값 검색일 경우
				if (isset($args['search_key']) && isset($args['search_value'])) {
					$this->db->like($args['search_key'], $args['search_value']);
				}
				# dates 검색일 경우
				if (isset($args['search_key']) && isset($args['search_value_start']) && isset($args['search_value_end'])) {
					# SELECT * FROM `naiyumie`.`crud` WHERE dates >= '2015-02-23'  AND dates <= '2015-02-24'
					$start_key = $args['search_key'].'>=';
					$end_key = $args['search_key'].'<=';
					$this->db->where($start_key, "'".$args['search_value_start']."'", FALSE);
					$this->db->where($end_key, "'".$args['search_value_end']."'", FALSE);
				}
				$query = $this->db->get();
				if ($query->num_rows() > 0) {
					$ret = $query->result_array();
					return $ret;
				} else {
					return FALSE;
				}
			}

		/********************************
			멤버 정보를 얻는다
		********************************/
			public function get_member($args)
			{
				$this->db->where('uid', $args['uid']);
				$this->db->from('members');
				$query = $this->db->get();
				if ($query->num_rows() > 0) {
					return $query->row_array();
				} else {
					return FALSE;
				}
			}

		/********************************
			탈퇴 플래그로 변경한다.
		********************************/
			public function deletes($args)
			{
				$model_data = array(
					'leaved_message' => '관리자에 의한 블라인드',
					'leaved_dates' => date('Y-m-d'),
					'leaved_times' => date('H:i:s'),
					'is_blind' => 'Y'
				);
				$this->db->where('uid', $args['uid']);
				$this->db->update('members', $model_data);
				return TRUE;
			}
}
/* End of file */