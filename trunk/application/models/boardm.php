<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	게시판 모델

**************************************************************************************************/
class Boardm extends CI_Model {
	/********************************
		생성자
	********************************/
		function __construct()
		{
			parent::__construct();
		}

	/**************************************************************************************************

		게시판

	**************************************************************************************************/

		/********************************
			목록을 조회한다.
		********************************/
			public function get_articles($args)
			{
				$this->db->select('
						board.category,
						board.uid,
						board.title,
						board.content,
						board.writer,
						board.dates,
						board.times,
						board.hit,
						board.thumbnail,
						board.recommend,
						members.nick,
						members.user_id,
						(select count(*) from board_comment where board_comment.board_uid = board.uid) as comment_count
				');
				$this->db->from('board');
				$this->db->join('members', 'board.writer = members.uid', 'left');
				$this->db->limit($args['limit'], $args['offset']);
				$this->db->where('board.category', $args['category']);
				$this->db->where('board.is_blind !=', 'Y');
				$this->db->order_by('uid','desc');
				$query = $this->db->get();
				if ($query->num_rows() > 0) {
					$ret = $query->result_array();
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
				$this->db->where('category', $args['category']);
				$this->db->where('board.is_blind !=', 'Y');
				$this->db->from('board');
				$query = $this->db->get();
				$ret = $query->num_rows();
				return $ret;
			}

		/********************************
			게시판의 카테고리 정보를 얻는다.
		********************************/
			public function get_board_info($args)
			{
				$this->db->select('*');
				$this->db->from('board_category');
				$this->db->where('board_category.category', $args['category']);
				$query = $this->db->get();
				$ret = '';
				if ($query->num_rows() > 0) {
					$result = $query->row_array();
					$ret = $result;
				}
				return $ret;
			}

		/********************************
			게시물을 조회한다.
		********************************/
			public function get_article($args)
			{
				$this->db->select('
					board.category,
					board.uid,
					board.title,
					board.content,
					board.writer,
					board.dates,
					board.thumbnail,
					board.gallery_main_display,
					board.times,
					board.hit,
					board.recommend,
					members.nick,
					members.user_id,
					(select count(*) from board_comment where board_comment.board_uid = board.uid) as comment_count
				');
				$this->db->from('board');
				$this->db->join('members', 'board.writer = members.uid', 'left');
				$this->db->where('board.category', $args['category']);
				$this->db->where('board.uid', $args['uid']);
				$this->db->where('board.is_blind !=', 'Y');
				$query = $this->db->get();

				if ($query->num_rows() > 0) {
					$ret = $query->row_array();
					return $ret;
				} else {
					return FALSE;
				}
			}

		/********************************
			게시물을 업데이트 한다.
		********************************/
			public function article_update($args)
			{
				$this->db->where('uid', $args['uid']);
				$this->db->update('board', $args);
				return TRUE;
			}

		/********************************
			조회수 증가
		********************************/
			public function hit_plus($args)
			{
				$this->db->set('hit', 'hit + 1', FALSE);
				$this->db->where('uid', $args['uid']);
				$this->db->update('board');
				//echo $this->db->last_query();
				if ($this->db->affected_rows() > 0) {
					return TRUE;
				} else {
					return FALSE;
				}
			}

		/********************************
			추천 수 증가
		********************************/
			public function recommend_plus($args)
			{
				# board_recommend에 아이디가 존재 하는지 확인
				$this->db->where('board_uid', $args['board_uid']);
				$this->db->where('writer', $args['member_uid']);
				$this->db->from('board_recommend');
				$query = $this->db->get();
				$user_id_check = $query->num_rows();
				$ret = FALSE;
				# 존재 하지 않는다면
				if ($user_id_check <= 0) {
					$this->db->set('recommend', 'recommend + 1', FALSE);
					$this->db->where('uid', $args['board_uid']);
					$this->db->update('board');
					$model_data = array(
						'board_uid' => $args['board_uid'],
						'writer' => $args['member_uid']
					);
					$this->db->insert('board_recommend', $model_data);
					$ret = TRUE;
				}
				return $ret;
			}

		/********************************
			게시물을 작성 한다.
		********************************/
			public function article_write($args)
			{
				$this->db->insert('board', $args);
				return TRUE;
			}

		/********************************
			마지막 작성글의 uid를 얻는다.
		********************************/
			public function last_article()
			{
				$query = $this->db->get('board');
				$q = $query->last_row('array');
				$ret = $q['uid'];
				return $ret;
			}


	/**************************************************************************************************

		댓글

	**************************************************************************************************/
		/********************************
			댓글을 작성한다.
		********************************/
			public function comment_write($args)
			{
				$this->db->insert('board_comment', $args);
				if ($this->db->affected_rows() > 0) {
					return TRUE;
				} else {
					return FALSE;
				}
			}

		/********************************
			댓글을 수정한다.
		********************************/
			public function comment_update($args)
			{
				$this->db->where('writer', $args['writer']);
				$this->db->where('uid', $args['uid']);
				$this->db->update('board_comment', $args);
				if ($this->db->affected_rows() > 0) {
					return TRUE;
				} else {
					return FALSE;
				}
			}

		/********************************
			댓글을 조회한다.
		********************************/
			public function get_comments($args)
			{
				//print_r($args);
				$this->db->select('
					board_comment.uid,
					board_comment.parent_uid,
					board_comment.comment_reply_writer,
					board_comment.is_blind,
					(select members.nick from members where board_comment.comment_reply_writer = members.uid) as comment_reply_writer_nick,
					board_comment.board_uid,
					board_comment.content,
					board_comment.writer,
					board_comment.dates,
					board_comment.times,
					members.nick,
					members.user_id
				');
				$this->db->from('board_comment');
				$this->db->join('members', 'board_comment.writer = members.uid', 'left');
				$this->db->where('board_comment.board_uid', $args['uid']);
				$query = $this->db->get();
				//echo $this->db->last_query();
				if ($query->num_rows() > 0) {
					$ret = $query->result_array();
					return $ret;
				} else {
					return FALSE;
				}
			}


	/**************************************************************************************************

		최근 게시물

	**************************************************************************************************/
		/********************************
			해당 카테고리의 recent
		********************************/
			public function get_recent_articles($args)
			{
				$this->db->select('
					board.category,
					board.thumbnail,
					board.uid,
					board.title,
					board.content,
					board.writer,
					board.dates,
					board.times,
					board.hit,
					board.recommend,
					members.nick,
					members.user_id,
					(select count(*) from board_comment where board_comment.board_uid = board.uid) as comment_count
				');
				$this->db->from('board');
				$this->db->join('members', 'board.writer = members.uid', 'left');
				$this->db->limit($args['limit']);
				$this->db->where('board.is_blind !=', 'Y');
				if (isset($args['category'])) {
					if (strpos($args['category'],'|')) {
						$exploded = explode('|', $args['category']);
						foreach($exploded as $k=>$v) {
							if ($k != 0) {
								$this->db->or_where('board.category', $v);
							} else {
								$this->db->where('board.category', $v);
							}
						}
					} else {
						$this->db->where('board.category', $args['category']);
					}
				}
				if (isset($args['where_key1'])) {
					$this->db->where($args['where_key1'],$args['where_val1']);
				}
				$this->db->order_by($args['orderby'],'desc');
				$query = $this->db->get();

				if ($query->num_rows() > 0) {
					$ret = $query->result_array();
					return $ret;
				} else {
					return FALSE;
				}
			}

		/********************************
			최근 댓글을 조회한다.
		********************************/
			public function get_recent_comments($args)
			{
				//print_r($args);
				$this->db->select('
					board_comment.uid,
					board_comment.parent_uid,
					board_comment.comment_reply_writer,
					board_comment.is_blind,
					(select category from board where board_comment.board_uid = board.uid) as category,
					(select members.nick from members where board_comment.comment_reply_writer = members.uid) as comment_reply_writer_nick,
					board_comment.board_uid,
					board_comment.content,
					board_comment.writer,
					board_comment.dates,
					board_comment.times,
					members.nick,
					members.user_id
				');
				$this->db->from('board_comment');
				$this->db->join('members', 'board_comment.writer = members.uid', 'left');
				//$this->db->where('board_comment.board_uid', $args['uid']);
				$this->db->limit($args['limit']);

				//echo $this->db->last_query();
				if (isset($args['where_key1'])) {
					$this->db->where($args['where_key1'],$args['where_val1']);
				}
				$this->db->order_by($args['orderby'],'desc');
				$query = $this->db->get();
				//echo $this->db->last_query();
				if ($query->num_rows() > 0) {
					$ret = $query->result_array();
					return $ret;
				} else {
					return FALSE;
				}
			}

	/**************************************************************************************************

		관리자 카테고리

	**************************************************************************************************/
		/********************************
			카테고리 모든 정보
		********************************/
			public function get_board_categories()
			{
				$this->db->select('*');
				$this->db->from('board_category');
				$this->db->order_by('category','desc');
				$query = $this->db->get();
				$ret = $query->result_array();
				return $ret;
			}

		/********************************
			카테고리 추가
		********************************/
			public function category_create($args)
			{
				$query = $this->db->insert('board_category', $args);
				$affected = $this->db->affected_rows();
				$ret = FALSE;
				if ($affected > 0) {
					$ret = TRUE;
				}
				return $ret;
			}

		/********************************
			카테고리 정보 얻기
		********************************/
			public function get_category_data($args)
			{
				$this->db->select('*');
				$this->db->where('category',$args['category']);
				$this->db->from('board_category');
				$query = $this->db->get();
				$ret = $query->row_array();
				return $ret;
			}

		/********************************
			카테고리 삭제
		********************************/
			public function category_deletes($args)
			{
				$this->db->where('category', $args['category']);
				$this->db->delete('board_category');
				return TRUE;
			}

		/********************************
			카테고리 정보 업데이트
		********************************/
			public function category_updates($args)
			{
				$this->db->where('category', $args['category']);
				$this->db->update('board_category', $args);
				return TRUE;
			}


	/**************************************************************************************************

		관리자 게시물 관리

	**************************************************************************************************/
		/********************************
			목록을 조회한다. - 관리자
		********************************/
			public function get_articles_admin($args)
			{
				# 멤버 검색 플래그
				$nick_search_flag = FALSE;
				$userid_search_flag = FALSE;

				# 멤버 (닉네임, 아이디) 검색.
				if (isset($args['search_key']) && isset($args['search_value'])) {
					# 닉네임 검색의 경우
					if (strpos($args['search_key'], 'members.nick') !== false) {
						$sub_query = $this->db->select('uid');
						$sub_query = $this->db->from('members');
						$sub_query = $this->db->where('nick', $args['search_value']);
						$sub_query = $this->db->get();
						if ($sub_query->num_rows() >0) {
							$user = $sub_query->row_array();
							$user_writer = $user['uid'];
							//print_r($user);
							$nick_search_flag = TRUE;
						}
						$sub_query->free_result();
					}
					# 멤버 아이디의 경우
					if (strpos($args['search_key'], 'members.user_id') !== false) {
						$sub_query = $this->db->select('uid');
						$sub_query = $this->db->from('members');
						$sub_query = $this->db->where('user_id', $args['search_value']);
						$sub_query = $this->db->get();
						if ($sub_query->num_rows() >0) {
							$user = $sub_query->row_array();
							$user_writer = $user['uid'];
							//print_r($user);
							$userid_search_flag = TRUE;
						}
						$sub_query->free_result();
					}
				}

				# 본 쿼리
				$this->db->select('
					board.category,
					board.uid,
					board.title,
					board.content,
					board.writer,
					board.dates,
					board.times,
					board.hit,
					board.thumbnail,
					board.recommend,
					members.nick,
					members.user_id,
					board.is_blind,
					(select count(*) from board_comment where board_comment.board_uid = board.uid) as comment_count
				');
				$this->db->from('board');
				$this->db->join('members', 'board.writer = members.uid', 'left');
				$this->db->limit($args['limit'], $args['offset']);
				$this->db->where('board.category', $args['category']);
				$this->db->order_by('uid','desc');

				# 멤버 검색일 경우.
				if ($nick_search_flag || $userid_search_flag) {
					$this->db->where('board.writer', $user_writer);
				} else {
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
				}

				$query = $this->db->get();
				//echo $this->db->last_query();
				if ($query->num_rows() > 0) {
					$ret = $query->result_array();
					return $ret;
				} else {
					return FALSE;
				}
			}

		/********************************
			카운트를 얻는다. - 관리자
		********************************/
			public function get_counts_admin($args)
			{
				//echo "<pre>"; print_r($args); echo "</pre>";
				# 멤버 검색 플래그
				$nick_search_flag = FALSE;
				$userid_search_flag = FALSE;

				# 멤버 (닉네임, 아이디) 검색.
				if (isset($args['search_key']) && isset($args['search_value'])) {
					# 닉네임 검색의 경우
					if (strpos($args['search_key'], 'members.nick') !== false) {
						$sub_query = $this->db->select('uid');
						$sub_query = $this->db->from('members');
						$sub_query = $this->db->where('nick', $args['search_value']);
						$sub_query = $this->db->get();
						if ($sub_query->num_rows() >0) {
							$user = $sub_query->row_array();
							$user_writer = $user['uid'];
							$nick_search_flag = TRUE;
						}
						$sub_query->free_result();
					}
					# 멤버 아이디의 경우
					if (strpos($args['search_key'], 'members.user_id') !== false) {
						$sub_query = $this->db->select('uid');
						$sub_query = $this->db->from('members');
						$sub_query = $this->db->where('user_id', $args['search_value']);
						$sub_query = $this->db->get();
						if ($sub_query->num_rows() >0) {
							$user = $sub_query->row_array();
							$user_writer = $user['uid'];
							$userid_search_flag = TRUE;
						}
						$sub_query->free_result();
					}
				}

				# 멤버 검색일 경우.
				if ($nick_search_flag || $userid_search_flag) {
					$this->db->where('board.writer', $user_writer);
				} else {
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
				}
				$this->db->where('board.category', $args['category']);
				$this->db->from('board');
				$query = $this->db->get();
				//echo $this->db->last_query();
				$ret = $query->num_rows();
				return $ret;
			}

		/********************************
			게시물을 조회한다. - 관리자
		********************************/
			public function get_article_admin($args)
			{
				$this->db->select('
					board.category,
					board.uid,
					board.title,
					board.content,
					board.writer,
					board.dates,
					board.thumbnail,
					board.gallery_main_display,
					board.times,
					board.hit,
					board.recommend,
					members.nick,
					members.user_id,
					(select count(*) from board_comment where board_comment.board_uid = board.uid) as comment_count, board.is_blind
				');
				$this->db->from('board');
				$this->db->join('members', 'board.writer = members.uid', 'left');
				$this->db->where('board.category', $args['category']);
				$this->db->where('board.uid', $args['uid']);
				$query = $this->db->get();

				if ($query->num_rows() > 0) {
					$ret = $query->row_array();
					return $ret;
				} else {
					return FALSE;
				}
			}

		/********************************
			댓글을 수정한다. = 관리자
		********************************/
			public function comment_update_admin($args)
			{
				$this->db->where('uid', $args['uid']);
				$this->db->update('board_comment', $args);
				if ($this->db->affected_rows() > 0) {
					return TRUE;
				} else {
					return FALSE;
				}
			}
}
/* End of file */