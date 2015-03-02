<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => $category_name.' 글조회 - 나이유미 게시판',
		'front_scope' => 'board_retrieve',
		'board_front_scope' => $category,
		'lnb' => 'board_'.$category.''
	);
	$this->load->view('inc_layout_sub_head', $view_argument);
?>
<?php $this->load->view('inc_layout_sub_header');?>
<?php
	# print_r($articles)
	# print_r($comment)
?>
		<div class="wrapper">
			<section class="sub">
				<aside class="sidebar">
					<?php $this->load->view('inc_layout_sub_aside', $view_argument); ?>
				</aside>
				<div class="content_wrap" id="sc">
					<h3><?php echo $category_name?></h3>
					<div class="subcription1">
						<strong><?php echo $retrieve['uid']?> </strong>번째 글입니다.
					</div>
					<div class="boardstyle retrieve">
						<table role="presentation" summary="게시판 조회 양식">
							<colgroup>
								<col style="width:80%">
								<col>
							</colgroup>
							<tbody>
								<tr class="section">
									<td class="title"><?php echo $retrieve['title']?></td>
									<td class="datetimes">
										<span><?php echo $retrieve['dates']?> <?php echo $retrieve['times']?> </span>
									</td>
								</tr>
								<tr class="section">
									<td class="writer">
										<strong class="writer_nick"><?php echo $retrieve['nick']?></strong>
										<span class="writer_id">(<?php echo $retrieve['user_id_marked']?>)</span>
									</td>
									<td class="hits">
										<strong class="hits_num">조회수</strong>
										<span class="hits_num_data"><?php echo $retrieve['hit']?></span>
										<strong class="recommendation_num">추천수</strong>
										<span class="recommendation_num_data"><?php echo $retrieve['recommend']?></span>
									</td>
								</tr>
								<tr class="section">
									<td colspan="2" class="content"><?php echo htmlspecialchars_decode($retrieve['content'])?></td>
								</tr>
							</tbody>
						</table>

						<div class="button_container3 separation">
							<div class="left">
								<?php
									# notice 게시판은 관리자만 작성 가능
								?>
								<?php if (($this->appearance == 'notice') && ($this->auth->is_admin_signed() == TRUE)):?>
									<a href="/board/write/<?php echo $category?>/<?php echo $this->uri->segment(4,0)?>/" class="btn btn5 write_button">글쓰기</a>
								<?php endif;?>

								<?php
									# 게시물 쓴 이(작성자)가 사인인 한 사용자와 같을 경우
									if ($retrieve['user_id'] == $this->session->userdata('signed_id') ):
								?>
									<a href="/board/update/<?php echo $category?>/<?php echo $this->uri->segment(4,0)?>/<?php echo $retrieve['uid']?>" class="btn btn6 update_button">수정</a>
									<a href="/board/erase/<?php echo $category?>/<?php echo $this->uri->segment(4,0)?>/<?php echo $retrieve['uid']?>" class="btn btn6 erase_button">삭제</a>
								<?php endif; ?>
							</div>
							<div class="right">
								<?php if ($signed):?>
									<?php echo form_open('board/recommend/'.$category.'/'.$this->uri->segment(4,0).'/'.$this->uri->segment(5,0).'', array('class'=>'form','id'=>'form2')); ?>
										<input type="hidden" name="board_uid" value="<?php echo $this->uri->segment(5,0)?>"/>
										<input type="submit" class="btn btn5" value="추천">
										<a href="/board/lists/<?php echo $category?>/<?php echo $this->uri->segment(4,0)?>/" class="btn btn5 list_button">목록</a>
									<?php echo form_close();?>
								<?php endif;?>
							</div>
							<hr class="clear" />
						</div>

						<div class="subcription1 separation">
							댓글 <strong><?php echo $comment_count;?></strong> 개
						</div>
						<?php if ($comment):?>
							<?php foreach($comment as $k=>$v):?>
								<?php
									# 댓글에 답글이 아닌경우
									if ($v['parent_uid'] == 0):
								?>
									<div class="comment_article">
										<div class="commenter" data-uid="<?php echo $v['uid']?>">
											<strong><?php echo $v['nick']?> <span>(<?php echo marked_text($v['user_id'])?>)</span></strong>
											<span> <?php echo $v['dates']?> <?php echo $v['times']?></span>
											<a href="#none" class="comment_reply_btn" data-uid="<?php echo $v['uid']?>">답글</a>
										</div>
										<?php
											# 댓글 쓴 이(댓글 작성자)가 사인인 한 사용자와 같을경우
											if ($v['user_id'] == $this->session->userdata('signed_id') ):
										?>
											<div class="reaction">
												<a href="#none" class="comment_update_btn" data-uid="<?php echo $v['uid']?>">수정</a><a href="#none" class="comment_update_cancel_btn" data-uid="<?php echo $v['uid']?>" style="display:none;">수정취소</a><span>|</span><a href="#none" class="comment_erase_btn" data-uid="<?php echo $v['uid']?>">삭제</a>
											</div>
										<?php endif;?>
										<?php if ($v['is_blind']=='Y'):?>
											<div class="comment_content" data-comment-uid="<?php echo $v['uid']?>"><span>삭제된 댓글 입니다.</span></div>
										<?php else:?>
											<div class="comment_content" data-comment-uid="<?php echo $v['uid']?>"><?php echo $v['content']?></div>
										<?php endif;?>
									</div>
									<?php foreach($comment as $kk=>$vv):?>
										<?php

											# 댓글에 답글인 경우 - 대댓글.
											# 반복을 도는 댓글의 parent_uid가 0이 아니고, 그 parent_uid가 상단 반복의 uid와 같을 경우만
											if ($vv['parent_uid'] != 0 && $vv['parent_uid'] == $v['uid']):
										?>
											<div class="comment_article depth1">
												<div class="commenter" data-uid="<?php echo $vv['uid']?>">
													<strong><?php echo $vv['nick']?> <span>(<?php echo marked_text($vv['user_id'])?>)</span></strong>
													<span> <?php echo $vv['dates']?> <?php echo $vv['times']?></span>
													<a href="#none" class="comment_reply_for_writer_btn" data-uid="<?php echo $v['uid']?>" data-writer-uid="<?php echo $vv['writer']?>">답글</a>
												</div>
												<?php
													# 댓글 쓴 이(댓글 작성자)가 사인인 한 사용자와 같을경우
													if ($vv['user_id'] == $this->session->userdata('signed_id') ):
												?>
													<div class="reaction">
														<a href="#none" class="comment_update_btn" data-uid="<?php echo $vv['uid']?>">수정</a><a href="#none" class="comment_update_cancel_btn" data-uid="<?php echo $vv['uid']?>" style="display:none;">수정취소</a><span>|</span><a href="#none" class="comment_erase_btn" data-uid="<?php echo $v['uid']?>">삭제</a>
													</div>
												<?php endif;?>
												<?php if ($v['is_blind']=='Y'):?>
													<div class="comment_content" data-comment-uid="<?php echo $v['uid']?>"><span>삭제된 댓글 입니다.</span></div>
												<?php else:?>
													<div class="comment_content" data-comment-uid="<?php echo $vv['uid']?>"><?php
														if ($vv['comment_reply_writer'] != 0) {
															echo '<span>'.$vv['comment_reply_writer_nick'].'</span>';
														}
													?><?php echo $vv['content']?></div>
												<?php endif;?>
											</div>
										<?php endif;?>
									<?php endforeach;?>
								<?php endif;?>
							<?php endforeach;?>
						<?php endif;?>
						<?php if ($signed):?>
							<?php echo form_open('board/comment_write/'.$category.'/'.$this->uri->segment(4,0).'/'.$this->uri->segment(5,0).'', array('class'=>'form comment_form','id'=>'form')); ?>
								<input type="hidden" name="board_uid" value="<?php echo $this->uri->segment(5,0)?>"/>
								<input type="hidden" name="comment_uid" value="0"/>
								<input type="hidden" name="comment_parent_uid" value="0"/>
								<input type="hidden" name="comment_reply_writer" value="0"/>
								<input type="hidden" name="comment_mode" value="create"/>
								<div class="comment_write">
									<textarea class="textarea1 comment_write_textarea" id="comment" name="comment"><?php echo set_value('comment');?></textarea>
									<input type="submit" class="btn btn7" value="확인">
								</div>
							<?php echo form_close();?>
						<?php endif;?>

					</div>

					<div class="subcription1">
						총 <strong><?php echo $board_counts?> </strong>건의 글이 있습니다.
					</div>
					<div class="boardstyle list">
						<?php if ($appearance == 'basic' || $appearance == 'notice'):?>
							<table role="presentation" summary="게시판 목록">
								<colgroup>
									<col style="width:70px">
									<col>
									<col style="width:100px">
									<col style="width:70px">
									<col style="width:40px">
									<col style="width:40px">
								</colgroup>
								<thead>
									<tr class="section">
										<th scope="col">번호</th>
										<th scope="col">제목</th>
										<th scope="col">작성자</th>
										<th scope="col">작성일</th>
										<th scope="col">조회</th>
										<th scope="col">추천</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!$articles):?>
										<?php $colspan="6"; ?>
										<tr>
											<td colspan="<?php echo $colspan?>" class="first">조회가능한 게시물이 없습니다.</th>
										</tr>
									<?php else:?>
										<?php foreach($articles as $k=>$v):?>
											<tr class="section">
												<td><?php ($appearance == 'notice')?$num='<span class="notice_num">공지</span>':$num=$v['uid']; ?><?php echo $num?></td>
												<td>
													<a href="/board/retrieve/<?php echo $category?>/<?php echo $this->uri->segment(4,0)?>/<?php echo $v['uid']?>">
														<?php echo $v['title']?>
														<?php if ($v['comment_count'] > 0):?>
															<span class="comment">[<strong><?php echo $v['comment_count']?></strong>]</span>
														<?php endif;?>
													</a>
												</td>
												<td><?php echo $v['nick']?></td>
												<td>
													<?php
														# 현재 날짜가 같다면 시간만 보여준다.
														echo get_dates_or_times_from_today($v['dates'], $v['times']);
													?>
												</td>
												<td><?php echo $v['hit']?></td>
												<td><?php echo $v['recommend']?></td>
											</tr>
										<?php endforeach;?>
									<?php endif;?>
								</tbody>
							</table>
						<?php endif;?>
						<?php if ($appearance == 'gallery'):?>
							<?php if (!$articles):?>
								<span class="appearance_gallery_nodata">조회 가능한 게시물이 없습니다.</span>
							<?php else:?>
								<ul class="appearance_gallery article_contents">
									<?php foreach($articles as $k=>$v):?>
										<li>
											<a href="/board/retrieve/<?php echo $category?>/<?php echo $this->uri->segment(4,0)?>/<?php echo $v['uid']?>">
												<span class="imgcnt" style="background:#f8f8f8 url('<?php echo $v['thumbnail']?>') center center no-repeat;"></span>
												<span class="img_description"><?php echo $v['title']?><?php if ($v['comment_count'] > 0):?> <span>[<strong><?php echo $v['comment_count']?></strong>]</span><?php endif;?></span>
												<span class="hits">조회수 <?php echo $v['hit']?></span>
												<span class="recommend">추천수 <?php echo $v['recommend']?></span>
												<span class="writer"><?php echo $v['nick']?></span>
												<span class="datetimes"><?php echo get_dates_or_times_from_today($v['dates'], $v['times']); ?></span>
											</a>
										</li>
									<?php endforeach;?>
								</ul>
							<?php endif;?>
						<?php endif;?>


						<div class="button_container3">
							<div class="left">
								<?php
									# notice 게시판은 관리자만 작성 가능
								?>
								<?php if (($this->appearance == 'notice') && ($this->auth->is_admin_signed() == TRUE)):?>
									<a href="/board/write/<?php echo $category?>/<?php echo $this->uri->segment(4,0)?>/" class="btn btn5 write_button">글쓰기</a>
								<?php endif;?>
							</div>
							<div class="right">
								<a href="/board/lists/<?php echo $category?>/<?php echo $this->uri->segment(4,0)?>/" class="btn btn5 list_button">목록</a>
							</div>
						</div>
						<div class="pagination1">
							<?php echo $pagination; ?>
						</div>

					</div>
				</div>
			</section>
		</div>




<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>