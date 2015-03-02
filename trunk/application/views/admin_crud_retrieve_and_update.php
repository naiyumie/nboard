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
						<span>CRUD 샘플</span>
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
						<h2>CRUD 조회</h2>
					</div>
					<div class="box-content">
						<?php echo form_open(''.$context.'/update_proc/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/', array('class'=>'form-horizontal','id'=>'form')); ?>
							<input type="hidden" name="uid" value="<?php echo $r['uid']?>" />
							<fieldset>

								<div class="control-group">
									<?php $field='textfield';?>
									<label class="control-label" for="id_<?php echo $field?>">텍스트필드</label>
									<div class="controls">
										<input name="<?php echo $field?>" id="id_<?php echo $field?>" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?>" class="input-full" type="text"  >
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='textarea';?>
									<label class="control-label" for="id_<?php echo $field?>">텍스트에어리어</label>
									<div class="controls">
										<textarea name="<?php echo $field?>" id="id_<?php echo $field?>" class="input-full"><?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?></textarea>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='checkbox';?>
									<label class="control-label">체크박스</label>
									<div class="controls">
										<label class="checkbox inline">
											<input type="checkbox" name="<?php echo $field?>" id="id_<?php echo $field;?>_1" value="Y" <?php if ( $this->input->post($field) == '' ) { echo $r[$field]=='Y'?'checked':''; } else { echo set_checkbox($field,'Y', ($this->input->post($field)=='Y')?TRUE:FALSE); }?>>
											체크 Y
										</label>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='radio';?>
									<label class="control-label">레디오</label>
									<div class="controls">
										<label class="radio">
											<input type="radio" name="<?php echo $field?>" id="id_<?php echo $field;?>_1" value="type_a" <?php if ( $this->input->post($field) == '' ) { echo $r[$field]=='type_a'?'checked':''; } else { echo set_radio($field,'type_a', ($this->input->post($field)=='type_a')?TRUE:FALSE); }?>>
											type_a 타입A
										</label>
										<div style="clear:both"></div>
										<label class="radio">
											<input type="radio" name="<?php echo $field?>" id="id_<?php echo $field;?>_2" value="type_b" <?php if ( $this->input->post($field) == '' ) { echo $r[$field]=='type_b'?'checked':''; } else { echo set_radio($field,'type_b', ($this->input->post($field)=='type_b')?TRUE:FALSE); }?>>
											type_b 타입B
										</label>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='select';?>
									<label class="control-label" for="<?php echo $field?>">셀렉트</label>
									<div class="controls">
										<?php
											$select_array = array(
												'type_1' => '타입-1',
												'type_2' => '타입-2',
												'type_3' => '타입-3'
											);
										?>
										<select name="<?php echo $field?>" id="<?php echo $field?>">
											<?php foreach ($select_array as $k=>$v):?>
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