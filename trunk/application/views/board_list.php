<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => $category_name.' 글목록 - 나이유미 게시판',
		'front_scope' => 'board_list',
		'board_front_scope' => $category,
		'lnb' => 'board_'.$category.''
	);
	$this->load->view('inc_layout_sub_head', $view_argument);
?>
<?php $this->load->view('inc_layout_sub_header');?>
<?php
	#print_r($articles)
?>
		<div class="wrapper">
			<section class="sub">
				<aside class="sidebar">
					<?php $this->load->view('inc_layout_sub_aside', $view_argument); ?>
				</aside>
				<div class="content_wrap" id="sc">
					<h3><?php echo $category_name?></h3>
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
										<tr class="section">
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

						<?php
							# notice 게시판은 관리자만 작성 가능
							# 그외 게시판은 누구나 작성 가능
						?>
						<div class="button_container3">
							<?php if ($this->appearance == 'notice'):?>
								<?php if ($this->auth->is_admin_signed() == TRUE):?>
								<a href="/board/write/<?php echo $category?>/<?php echo $this->uri->segment(4,0)?>/" class="btn btn5 write_button">글쓰기</a>
								<?php endif;?>
							<?php else:?>
								<a href="/board/write/<?php echo $category?>/<?php echo $this->uri->segment(4,0)?>/" class="btn btn5 write_button">글쓰기</a>
							<?php endif;?>
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