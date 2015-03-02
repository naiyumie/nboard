<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	DB 공통 모델

**************************************************************************************************/
class Commonm extends CI_Model {
	/********************************
		생성자
	********************************/
		function __construct()
		{
			parent::__construct();
		}

	/**************************************************************************************************

		기본 CRUD
		기본 CRUD 모델의 함수들은 편리하다 :)
		그러나 이것을 가지고 애플리케이션을 전부 만드는건 변화에 취약 할 수 있다.
		많은 혼돈을 주며, MVC 개발론 적으로 보았을때 좋지 못하다.
		즉, 이 함수들로 일반적인 CRUD를 구성 하고, 애플리케이션이 복잡해진다면 별도의 모델을 생성하여
		구성하는편이 올바른 방법이다.

		# 모델 데이터
		$model_data = array(
			# 환경 변수
			'environment' => array(
				'context' => 'table_name',
				'pk' => 'uid'
			),
			# 데이터
			'pk_value' => 'uid',
			'foo' => 'bar',
			'key' => 'val'
		);

		# 모델 호출
		$this->commonm->create($model_data]);

		# 인자 설명
		- context >> table name
		- pk >> uid와 같은 primary key
		- pk_value >> 예를들면 uid값.
		예시) $this->db->where('uid', '1')
			  $this->db->where($args['environment']['pk'], $args['uid']);

	**************************************************************************************************/
		/********************************
			C 데이터 생성
		********************************/
			public function create($args)
			{
				$query = $this->db->insert($args['environment']['context'], $args);
				$affected = $this->db->affected_rows();
				$ret = FALSE;
				if ($affected > 0) {
					$ret = TRUE;
				}
				return $ret;
			}

		/********************************
			R 목록을 조회한다.
		********************************/
			public function gets($args)
			{
				$this->db->select('*');
				$this->db->from($args['environment']['context']);
				$this->db->limit($args['limit'], $args['offset']);
				$this->db->order_by($args['environment']['pk'],'desc');
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
			R 하나의 row를 조회한다.
		********************************/
			public function get($args)
			{
				$query = $this->db
				->where($args['environment']['pk'], $args['pk_value'])
				->select('*')
				->from($args['environment']['context'])
				->get();
				if ($query->num_rows() > 0) {
					$ret = $query->row_array();
					return $ret;
				} else {
					return FALSE;
				}
			}

		/********************************
			R 카운트를 얻는다.
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
				$this->db->from($args['environment']['context']);
				$query = $this->db->get();
				$ret = $query->num_rows();
				return $ret;
			}

		/********************************
			U 업데이트 한다.
		********************************/
			public function updates($args)
			{
				$this->db->where($args['environment']['pk'], $args['pk_value']);
				$this->db->update($args['environment']['context'], $args);
				return TRUE;
			}

		/********************************
			U 수 증가
		********************************/
			public function plus_count($args)
			{
				$this->db->set($args['target_column'], $args['target_column'].' + 1', FALSE);
				$this->db->where($args['environment']['pk'], $args['pk_value']);
				$this->db->update($args['environment']['context']);
				if ($this->db->affected_rows() > 0) {
					return TRUE;
				} else {
					return FALSE;
				}
			}

		/********************************
			D 삭제 한다.
		********************************/
			public function deletes($args)
			{
				$this->db->where($args['environment']['pk'], $args['pk_value']);
				$this->db->delete($args['environment']['context']);
				return TRUE;
			}


	/**************************************************************************************************

		DB 유틸

	**************************************************************************************************/
		/********************************
			enum 타입을 얻는다.
			- 동일 db상에 해당 column이 동일하게 존재하면 안된다.
			- 즉, A 데이터베이스의 b 테이블에 c 컬럼이 enum이고 조건이 c('1','2','3') 이라 할시
			-	 B 데이터베이스의 b 테이블에 c 컬럼이 enum이고 조건이 c('4','5','6') 일경우 이 함수는 1,2,3,4,5,6을 리턴 할 것이다.
		********************************/
			public function get_enum_type($table_name, $column_name)
			{
				$query = $this->db->query("
					SELECT DISTINCT SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING(COLUMN_TYPE, 7, LENGTH(COLUMN_TYPE) - 8), \"','\", 1 + units.i + tens.i * 10) , \"','\", -1) AS enumtype
					FROM INFORMATION_SCHEMA.COLUMNS
					CROSS JOIN (SELECT 0 AS i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) units
					CROSS JOIN (SELECT 0 AS i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) tens
					WHERE TABLE_NAME = '{$table_name}'
					AND COLUMN_NAME = '{$column_name}'"
				);
				$result = $query->result_array();
				$ret_array = array();
				foreach($result as $k=>$v) {
					$ret_array[] = $v['enumtype'];
				}
				//print_r($ret_array);
				$ret = $ret_array;
				return $ret;
			}
}

/* End of file */