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
						<span>멤버 관리</span>
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<span>조회</span>
					</li>
				</ul>
				<a href="#<?php echo $context?>" class="breadcrumb_help" title="도움말보기"><i class="icon-question-sign"></i></a>
			</div>
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header">
						<h2>멤버 조회</h2>
					</div>
					<div class="box-content">
						<?php echo form_open(''.$context.'/update_proc/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/', array('class'=>'form-horizontal','id'=>'form')); ?>
							<?php $field='uid';?>
							<input type="hidden" name="uid" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?>" />
							<fieldset>

								<div class="control-group">
									<?php $field='user_id';?>
									<label class="control-label" for="id_<?php echo $field?>">아이디</label>
									<div class="controls">
										<span class="input-xlarge uneditable-input"><?php echo $r[$field];?></span>
									</div>
								</div>
								<div class="control-group">
									<?php $field='nick';?>
									<label class="control-label" for="id_<?php echo $field?>">닉네임</label>
									<div class="controls">
										<input name="<?php echo $field?>" id="id_<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?>" class="input-full" type="text"  >
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='email';?>
									<label class="control-label" for="id_<?php echo $field?>">이메일</label>
									<div class="controls">
										<input name="<?php echo $field?>" id="id_<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?>" class="input-full" type="text"  >
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='introduce';?>
									<label class="control-label" for="id_<?php echo $field?>">소개</label>
									<div class="controls">
										<textarea name="<?php echo $field?>" id="id_<?php echo $field?>" class="input-full"><?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?></textarea>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='type';?>
									<label class="control-label" for="<?php echo $field?>">유저 타입</label>
									<div class="controls">
										<?php
											$select_array = array(
												'users' => '유저',
												'admin' => '관리자'
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
									<?php $field='level';?>
									<label class="control-label" for="id_<?php echo $field?>">레벨</label>
									<div class="controls">
										<input name="<?php echo $field?>" id="id_<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?>" class="input-mini" type="text"  >
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='term_agreement';?>
									<label class="control-label" for="<?php echo $field?>">이용약관</label>
									<div class="controls">
										<?php
											$select_array = array(
												'agree' => '동의',
												'donotagree' => '동의안함'
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
									<?php $field='privacy_polish';?>
									<label class="control-label" for="<?php echo $field?>">개인정보보호정책</label>
									<div class="controls">
										<?php
											$select_array = array(
												'agree' => '동의',
												'donotagree' => '동의안함'
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
									<label class="control-label" for="<?php echo $field?>">가입일</label>
									<div class="controls">
										<input type="text" name="<?php echo $field?>" class="input-small nDatePicker" id="<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field, date('Y-m-d')); }?>">
										<label class="picker-icon" for="<?php echo $field?>"><img src="/admin_assets/img/ncalendar.png" alt="일 선택" class="timepicker nDatePickerIcon" /></label>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='times';?>
									<label class="control-label" for="<?php echo $field?>">가입시</label>
									<div class="controls">
										<input type="text" name="<?php echo $field?>" class="input-small nTimePicker" id="<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field, date('H:i:s')); }?>">
										<label class="picker-icon" for="<?php echo $field?>"><img src="/admin_assets/img/ndatepick.png" alt="시 선택" class="timepicker nTimePickerIcon" /></label>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='signed_dates';?>
									<label class="control-label" for="<?php echo $field?>">마지막 사인인 일</label>
									<div class="controls">
										<input type="text" name="<?php echo $field?>" class="input-small nDatePicker" id="<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field, date('Y-m-d')); }?>">
										<label class="picker-icon" for="<?php echo $field?>"><img src="/admin_assets/img/ncalendar.png" alt="일 선택" class="timepicker nDatePickerIcon" /></label>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='signed_times';?>
									<label class="control-label" for="<?php echo $field?>">마지막 사인인 시</label>
									<div class="controls">
										<input type="text" name="<?php echo $field?>" class="input-small nTimePicker" id="<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field, date('H:i:s')); }?>">
										<label class="picker-icon" for="<?php echo $field?>"><img src="/admin_assets/img/ndatepick.png" alt="시 선택" class="timepicker nTimePickerIcon" /></label>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='captcha';?>
									<label class="control-label" for="id_<?php echo $field?>">캡챠입력정보</label>
									<div class="controls">
										<input name="<?php echo $field?>" id="id_<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?>" class="input-mini" type="text"  >
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='count_signed';?>
									<label class="control-label" for="id_<?php echo $field?>">사인인 횟수</label>
									<div class="controls">
										<input name="<?php echo $field?>" id="id_<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?>" class="input-mini" type="text"  >
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='count_write_article';?>
									<label class="control-label" for="id_<?php echo $field?>">게시글 작성수</label>
									<div class="controls">
										<input name="<?php echo $field?>" id="id_<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?>" class="input-mini" type="text"  >
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='count_write_comment';?>
									<label class="control-label" for="id_<?php echo $field?>">댓글 작성수</label>
									<div class="controls">
										<input name="<?php echo $field?>" id="id_<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?>" class="input-mini" type="text"  >
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='is_blind';?>
									<label class="control-label">탈퇴 여부</label>
									<div class="controls">
										<label class="radio">
											<input type="radio" name="<?php echo $field?>" id="id_<?php echo $field;?>_1" value="Y" <?php if ( $this->input->post($field) == '' ) { echo $r[$field]=='Y'?'checked':''; } else { echo set_radio($field,'Y', ($this->input->post($field)=='Y')?TRUE:FALSE); }?>>
											탈퇴
										</label>
										<div style="clear:both"></div>
										<label class="radio">
											<input type="radio" name="<?php echo $field?>" id="id_<?php echo $field;?>_2" value="N" <?php if ( $this->input->post($field) == '' ) { echo $r[$field]=='N'?'checked':''; } else { echo set_radio($field,'N', ($this->input->post($field)=='N')?TRUE:FALSE); }?>>
											활동
										</label>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='leaved_dates';?>
									<label class="control-label" for="<?php echo $field?>">탈퇴 일  </label>
									<div class="controls">
										<input type="text" name="<?php echo $field?>" class="input-small nDatePicker" id="<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field, date('Y-m-d')); }?>">
										<label class="picker-icon" for="<?php echo $field?>"><img src="/admin_assets/img/ncalendar.png" alt="일 선택" class="timepicker nDatePickerIcon" /></label>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='leaved_times';?>
									<label class="control-label" for="<?php echo $field?>">탈퇴 시 </label>
									<div class="controls">
										<input type="text" name="<?php echo $field?>" class="input-small nTimePicker" id="<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field, date('H:i:s')); }?>">
										<label class="picker-icon" for="<?php echo $field?>"><img src="/admin_assets/img/ndatepick.png" alt="시 선택" class="timepicker nTimePickerIcon" /></label>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='leaved_message';?>
									<label class="control-label" for="id_<?php echo $field?>">탈퇴 메시지</label>
									<div class="controls">
										<textarea name="<?php echo $field?>" id="id_<?php echo $field?>" class="input-full"><?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?></textarea>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="form-actions">
									<button type="submit" class="btn btn-primary">저장</button>
									<a href="/<?php echo $context?>/lists/0/?<?php echo $query_string?>" class="btn">취소</a>
								</div>
							</fieldset>
						<?php echo form_close();?>
					</div>
				</div>
			</div>


		</div>
	</div>
</div>



<?php $this->load->view('admin_inc_layout_admin_footer');?>
<script type="text/javascript">
	// 네비게이션 활성화
	$("[data-sidebar_id=<?php echo $context?>]").addClass('active');
</script>
<?php $this->load->view('admin_inc_layout_admin_foot');?>