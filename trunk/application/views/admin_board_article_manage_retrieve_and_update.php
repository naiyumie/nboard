<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('admin_inc_layout_admin_head');?>
<?php $this->load->view('admin_inc_layout_admin_header');?>
<?php $this->load->view('admin_inc_layout_admin_script');?>

<?php
	#print_r($r);
	#print_r($this->input->post());
?>
<div class="container-fluid-full">
	<div class="row-fluid">
		<?php $this->load->view('admin_inc_layout_admin_aside'); ?>
		<div id="content" class="span10">
			<div class="breadcrumb_container">
				<ul class="breadcrumb">
					<li>
						<a href="/admin/"><i class="icon-home"></i></a>
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<span>게시물 관리</span>
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<span><?php echo $category_name ?></span>
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<span>조회</span>
					</li>
				</ul>
				<a href="#<?php echo $manual_context?>" class="breadcrumb_help" title="도움말보기"><i class="icon-question-sign"></i></a>
			</div>
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header">
						<h2>게시물 조회</h2>
					</div>
					<div class="box-content">
						<?php echo form_open(''.$context.'/update_proc/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/', array('class'=>'form-horizontal','id'=>'form')); ?>
							<input type="hidden" name="uid" value="<?php echo $r['uid']?>" />
							<fieldset>
								<div class="control-group">
									<?php $field='uid';?>
									<label class="control-label" for="id_<?php echo $field?>">게시글 uid</label>
									<div class="controls">
										<span class="input-mini uneditable-input"><?php echo $r[$field];?></span>
									</div>
								</div>

								<div class="control-group">
									<?php $field='writer';?>
									<label class="control-label" for="id_<?php echo $field?>">작성자 uid</label>
									<div class="controls">
										<span class="input-mini uneditable-input"><?php echo $r[$field];?></span>
									</div>
								</div>

								<div class="control-group">
									<?php $field='nick';?>
									<label class="control-label" for="id_<?php echo $field?>">작성자 닉네임</label>
									<div class="controls">
										<span class="input-xlarge uneditable-input"><?php echo $r[$field];?></span>
									</div>
								</div>

								<div class="control-group">
									<?php $field='user_id';?>
									<label class="control-label" for="id_<?php echo $field?>">작성자 아이디</label>
									<div class="controls">
										<span class="input-xlarge uneditable-input"><?php echo $r[$field];?></span>
									</div>
								</div>

								<div class="control-group">
									<?php $field='uid';?>
									<label class="control-label" for="id_<?php echo $field?>">게시글 번호</label>
									<div class="controls">
										<span class="input-mini uneditable-input"><?php echo $r[$field];?></span>
									</div>
								</div>

								<div class="control-group">
									<?php $field='title';?>
									<label class="control-label" for="id_<?php echo $field?>">제목</label>
									<div class="controls">
										<input name="<?php echo $field?>" id="id_<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?>" class="input-full" type="text"  >
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='content';?>
									<label class="control-label" for="id_<?php echo $field?>">내용</label>
									<div class="controls">
										<textarea name="<?php echo $field?>" id="id_<?php echo $field?>" class="input-full"><?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?></textarea>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='is_blind';?>
									<label class="control-label" for="<?php echo $field?>">삭제여부</label>
									<div class="controls">
										<?php
											$select_array = array(
												'Y' => '삭제',
												'N' => '게시중'
											);
										?>
										<select name="<?php echo $field?>" id="<?php echo $field?>">
											<?php foreach($select_array as $k=>$v):?>
												<option value="<?php echo $k;?>" <?php if ( $this->input->post($field) == '' ) { echo $r[$field]==$k?'selected="selected"':''; } else { echo set_select($field, $k); }?>><?php echo $v?></option>
											<?php endforeach;?>
										</select>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='dates';?>
									<label class="control-label" for="<?php echo $field?>">일</label>
									<div class="controls">
										<input type="text" name="<?php echo $field?>" class="input-small nDatePicker" id="<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field, date('Y-m-d')); }?>">
										<label class="picker-icon" for="<?php echo $field?>"><img src="/admin_assets/img/ncalendar.png" alt="일 선택" class="timepicker nDatePickerIcon" /></label>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='times';?>
									<label class="control-label" for="<?php echo $field?>">시</label>
									<div class="controls">
										<input type="text" name="<?php echo $field?>" class="input-small nTimePicker" id="<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field, date('H:i:s')); }?>">
										<label class="picker-icon" for="<?php echo $field?>"><img src="/admin_assets/img/ndatepick.png" alt="시 선택" class="timepicker nTimePickerIcon" /></label>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='hit';?>
									<label class="control-label" for="id_<?php echo $field?>">조회수</label>
									<div class="controls">
										<input name="<?php echo $field?>" id="id_<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?>" class="input-mini" type="text"  >
									</div>
								</div>


								<div class="control-group">
									<?php $field='recommend';?>
									<label class="control-label" for="id_<?php echo $field?>">추천수</label>
									<div class="controls">
										<input name="<?php echo $field?>" id="id_<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?>" class="input-mini" type="text"  >
									</div>
								</div>

								<div class="control-group">
									<?php $field='comment_count';?>
									<label class="control-label" for="id_<?php echo $field?>">댓글수</label>
									<div class="controls">
										<span class="input-mini uneditable-input"><?php echo $r[$field];?></span>
									</div>
								</div>

								<div class="form-actions">
									<button type="submit" class="btn btn-primary">저장</button>
									<a href="/<?php echo $context?>/lists/<?php echo $category?>/0/?<?php echo $query_string?>" class="btn">취소</a>
								</div>
							</fieldset>
						<?php echo form_close();?>
					</div>
				</div>
			</div>

			<?php if ($comment):?>
				<div class="row-fluid">
					<div class="box span12">
						<div class="box-header">
							<h2>게시물 댓글 조회</h2>
							<p>댓글 <strong><?php echo $comment_count;?></strong> 개</p>
						</div>
						<div class="box-content">
							<?php echo form_open(''.$context.'/comment_delete_proc/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/', array('class'=>'form-horizontal','id'=>'form_comment')); ?>
								<?php foreach($comment as $k=>$v):?>
									<?php
										# 댓글에 답글이 아닌경우
										if ($v['parent_uid'] == 0):
									?>
										<div class="comment_article">
											<?php if ($v['is_blind']=='Y'):?><del><?php endif;?>
												<div class="commenter" data-uid="<?php echo $v['uid']?>">
													<label>
														<input type="checkbox" name="chk[]" class="chk" value="<?php echo $v['uid']?>" /><?php echo $v['uid']?>
														<strong><?php echo $v['nick']?> <span>(<?php echo $v['user_id']?>)</span></strong>
														<span> <?php echo $v['dates']?> <?php echo $v['times']?></span>
													</label>
												</div>
												<div class="comment_content" data-comment-uid="<?php echo $v['uid']?>"><?php echo $v['content']?></div>
											<?php if ($v['is_blind']=='Y'):?></del><?php endif;?>
										</div>
										<?php foreach($comment as $kk=>$vv):?>
											<?php

												# 댓글에 답글인 경우 - 대댓글.
												# 반복을 도는 댓글의 parent_uid가 0이 아니고, 그 parent_uid가 상단 반복의 uid와 같을 경우만
												if ($vv['parent_uid'] != 0 && $vv['parent_uid'] == $v['uid']):
											?>
												<div class="comment_article depth1">
													<?php if ($v['is_blind']=='Y'):?><del><?php endif;?>
														<div class="commenter" data-uid="<?php echo $vv['uid']?>">
															<label>
																<input type="checkbox" name="chk[]" class="chk" value="<?php echo $vv['uid']?>" /><?php echo $vv['uid']?>
																<strong><?php echo $vv['nick']?> <span>(<?php echo $vv['user_id']?>)</span></strong>
																<span> <?php echo $vv['dates']?> <?php echo $vv['times']?></span>
															</label>
														</div>
														<div class="comment_content" data-comment-uid="<?php echo $vv['uid']?>"><?php
															if ($vv['comment_reply_writer'] != 0) {
																echo '<span>'.$vv['comment_reply_writer_nick'].'</span>';
															}
														?><?php echo $vv['content']?></div>
														</div>
													<?php if ($v['is_blind']=='Y'):?></del><?php endif;?>
											<?php endif;?>
										<?php endforeach;?>
									<?php endif;?>
								<?php endforeach;?>
								<div class="form-actions">
									<button type="submit" class="btn btn-primary">삭제</button>
								</div>
							<?php echo form_close();?>
						</div>
					</div>
				</div>
			<?php endif;?>




		</div>
	</div>
</div>



<?php $this->load->view('admin_inc_layout_admin_footer');?>
<script type="text/javascript">
	// 네비게이션 활성화
	$("[data-sidebar_id=<?php echo $context?>]").addClass('active');
</script>
<?php $this->load->view('admin_inc_layout_admin_foot');?>