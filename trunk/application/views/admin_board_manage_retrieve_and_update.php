<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('admin_inc_layout_admin_head');?>
<?php $this->load->view('admin_inc_layout_admin_header');?>
<?php $this->load->view('admin_inc_layout_admin_script');?>

<?php
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
						<span>게시판 관리</span>
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
						<h2>게시판 조회</h2>
					</div>
					<div class="box-content">
						<?php echo form_open(''.$context.'/update_proc/'.$r['category'].'/', array('class'=>'form-horizontal','id'=>'form')); ?>
							<input type="hidden" name="category" value="<?php echo $r['category']?>" />
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="id_category">카테고리 PK</label>
									<div class="controls">
										<?php $field='category';?>
										<span class="input-xlarge uneditable-input"><?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?></span>
										<?php echo form_error($field);?>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="id_names">카테고리 이름</label>
									<div class="controls">
										<?php $field='names';?>
										<input name="<?php echo $field?>" class="input-full" id="id_names" type="text" value="<?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?>" >
										<?php echo form_error($field);?>
										<span class="help-inline">한글과 영문과 숫자가 입력 가능합니다.</span>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="select1">모양새</label>
									<div class="controls">
										<?php
											$field='appearance';
											$select_array = $appearence;
										?>
										<select name="<?php echo $field?>" id="select1">
											<?php foreach($select_array as $k=>$v):?>
												<option value="<?php echo $v;?>"  <?php if ($v==$r['appearance']):?>selected="selected"<?php endif;?>><?php echo $v?></option>
											<?php endforeach;?>
										</select>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="form-actions">
									<button type="submit" class="btn btn-primary">저장</button>
									<a href="/<?php echo $context?>/lists/0/" class="btn">취소</a>
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