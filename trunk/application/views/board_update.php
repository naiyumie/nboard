<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => $category_name.' 글수정 - 나이유미 게시판',
		'front_scope' => 'board_update',
		'board_front_scope' => $category,
		'lnb' => 'board_'.$category.''
	);
	$this->load->view('inc_layout_sub_head', $view_argument);
?>
<?php $this->load->view('inc_layout_sub_header');?>
<?php
	#print_r($retrieve);
?>
		<div class="wrapper">
			<section class="sub">
				<aside class="sidebar">
					<?php $this->load->view('inc_layout_sub_aside', $view_argument); ?>
				</aside>
				<div class="content_wrap" id="sc">
					<h3><?php echo $category_name?></h3>
					<div class="subcription1">
						게시판 운영원칙에 맞지않는 게시물은 관리자의 판단하에 경고조치없이 임의로 삭제될 수 있습니다.
					</div>
					<div class="boardstyle write_and_update">
						<?php echo form_open('board/update/'.$category.'/'.$this->uri->segment(4,0).'/'.$this->uri->segment(5,0).'', array('class'=>'form','id'=>'form')); ?>
							<?php echo form_hidden(array('uid'=>$retrieve['uid']));?>
							<table role="presentation" summary="게시판 편집 양식">
								<colgroup>
									<col style="width:70px">
									<col>
								</colgroup>
								<tbody>
									<tr class="section">
										<th scope="row"><label for="article_title" class="title">제목</label></th>
										<td class="writing_title">
											<input type="text" name="title" value="<?php echo $retrieve['title'];?>" id="article_title" class="text1" placeholder="제목을 입력 하세요." />
										</td>
									</tr>
									<tr class="section">
										<th scope="row">파일첨부</th>
										<td class="writing_title">
											<a href="#none" class="attach_item image">이미지</a>
											<div class="image_attach">
												<iframe src="/board/image_append" class="image_attach_frame" name="image_append" id="image_append"></iframe>
											</div>
										</td>
									</tr>
									<tr class="section thumbnail_wrapper" <?php if (isset($retrieve['thumbnail'])) {echo'style="display: table-row;"';}?>>
										<th scope="row">섬네일</th>
										<td class="writing_title">
											<div class="thumbnail_container" <?php if (isset($retrieve['thumbnail'])) {echo'style="background:url('.$retrieve['thumbnail'].') center center no-repeat;"';}?>></div>
											<input type="hidden" name="thumbnail" value="<?php echo $retrieve['thumbnail'];?>" />
											<div class="checkbox checkbox1 thumbnail_chekcer">
												<input type="checkbox" class="checkbox1x" id="gallery_main_display" name="gallery_main_display" value="Y" <?php if (isset($retrieve['gallery_main_display'])) { if ($retrieve['gallery_main_display'] == 'Y') { echo 'checked';}}?> />
												<label for="gallery_main_display">메인에 노출 합니다.</label>
											</div>
										</td>
									</tr>
									<tr class="section">
										<td colspan="2">
											<textarea class="textarea1" name="content"><?php echo $retrieve['content'];?></textarea>
										</td>
									</tr>
								</tbody>
							</table>

							<div class="button_container3 separation">
								<div class="left">
									<a href="/board/lists/<?php echo $category?>/<?php echo $this->uri->segment(4,0)?>/" class="btn btn6 list_button">목록</a>
								</div>
								<div class="right">
									<input type="submit" class="btn btn5" value="완료">
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