<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	CRUD 모델

**************************************************************************************************/
class Crudm extends CI_Model {
	/********************************
		선언
	********************************/
		var $context = 'crud';

	/********************************
		생성자
	********************************/
		function __construct()
		{
			parent::__construct();
		}

	/**************************************************************************************************

		CREATE

	**************************************************************************************************/
		/********************************
			데이터 생성
		********************************/
			public function create($args)
			{
				$query = $this->db->insert($this->context, $args);
				$affected = $this->db->affected_rows();
				$ret = FALSE;
				if ($affected > 0) {
					$ret = TRUE;
				}
				return $ret;
			}


	/**************************************************************************************************

		Retrieve & List

	**************************************************************************************************/
		/********************************
			목록을 조회한다.
		********************************/
			public function gets($args)
			{
				$this->db->select('*');
				$this->db->from($this->context);
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
			하나의 row를 조회한다.
		********************************/
			public function get($args)
			{
				$query = $this->db
				->where('uid', $args['uid'])
				->select('*')
				->from($this->context)
				->get();
				if ($query->num_rows() > 0) {
					$ret = $query->row_array();
					return $ret;
				} else {
					return FALSE;
				}
			}

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
				$this->db->from($this->context);
				$query = $this->db->get();
				$ret = $query->num_rows();
				return $ret;
			}


	/**************************************************************************************************

		Update

	**************************************************************************************************/

		/********************************
			업데이트 한다.
		********************************/
			public function updates($args)
			{
				$this->db->where('uid', $args['uid']);
				$this->db->update($this->context, $args);
				return TRUE;
			}


	/**************************************************************************************************

		Delete

	**************************************************************************************************/

		/********************************
			삭제 한다.
		********************************/
			public function deletes($args)
			{
				$this->db->where('uid', $args['uid']);
				$this->db->delete($this->context);
				return TRUE;
			}

}
/* End of file */