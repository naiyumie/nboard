<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => $category_name.' 글쓰기 - 나이유미 게시판',
		'front_scope' => 'board_write',
		'board_front_scope' => $category,
		'lnb' => 'board_'.$category.''
	);
	$this->load->view('inc_layout_sub_head', $view_argument);
?>
<?php $this->load->view('inc_layout_sub_header');?>

		<div class="wrapper">
			<section class="sub">
				<aside class="sidebar">
					<?php $this->load->view('inc_layout_sub_aside', $view_argument); ?>
				</aside>
				<div class="content_wrap" id="sc">
					<h3><?php echo $category_name?> 글쓰기</h3>
					<div class="subcription1">
						게시판 운영원칙에 맞지않는 게시물은 관리자의 판단하에 경고조치없이 임의로 삭제될 수 있습니다.
					</div>
					<div class="boardstyle write_and_update">
						<?php echo form_open('board/write/'.$category.'/'.$this->uri->segment(4,0), array('class'=>'form','id'=>'form')); ?>
							<input type="hidden" name="category" value="<?php echo $category?>" />

							<table role="presentation" summary="게시판 글쓰기 양식">
								<colgroup>
									<col style="width:70px">
									<col>
								</colgroup>
								<tbody>
									<tr class="section">
										<th scope="row"><label for="article_title" class="title">제목</label></th>
										<td class="writing_title">
											<input type="text" name="title" value="<?php echo set_value('title', $title);?>" id="article_title" class="text1" placeholder="제목을 입력 하세요." />
										</td>
									</tr>
									<tr class="section">
										<th scope="row">파일첨부</th>
										<td class="writing_title">
											<a href="#none" class="attach_item image">이미지</a>
											<div class="image_attach">
												<iframe src="/board/image_append/" class="image_attach_frame" name="image_append" id="image_append"></iframe>
											</div>
										</td>
									</tr>
									<tr class="section thumbnail_wrapper">
										<th scope="row">섬네일</th>
										<td class="writing_title">
											<div class="thumbnail_container"></div>
											<input type="hidden" name="thumbnail" />
											<div class="checkbox checkbox1 thumbnail_chekcer">
												<input type="checkbox" class="checkbox1x" id="gallery_main_display" name="gallery_main_display" value="Y" />
												<label for="gallery_main_display">메인에 노출 합니다.</label>
											</div>
										</td>
									</tr>
									<tr class="section">
										<td colspan="2">
											<textarea class="textarea1" name="content"><?php echo set_value('content', $content);?></textarea>
										</td>
									</tr>
								</tbody>
							</table>

							<div class="button_container3 separation">
								<div class="left">
									<a href="/board/lists/<?php echo $category?>/<?php echo $this->uri->segment(4,0)?>/" class="btn btn6 list_button">목록</a>
								</div>
								<div class="right">
									<input type="submit" class="btn btn5" value="확인">
								</div>
								<hr class="clear" />
							</div>

						<?php echo form_close();?>
					</div>

				</div>
			</section>
		</div>
<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>