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
						<?php echo form_open('', array('class'=>'form-horizontal','id'=>'form')); ?>
							<fieldset>
								<div class="control-group">
									<?php $field='session_id';?>
									<label class="control-label" for="id_<?php echo $field?>">세션 아이디</label>
									<div class="controls">
										<span class="input-xlarge uneditable-input"><?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?></span>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='user_data_array';?>
									<label class="control-label" for="id_<?php echo $field?>">세션 멤버 정보</label>
									<div class="controls">
										<pre><?php foreach ($r['user_data_array']['signed_data'] as $k=>$v) { echo $k.' : '.$v.PHP_EOL; }?></pre>
										<?php echo form_error($field);?>
									</div>
								</div>
								<div class="control-group">
									<?php $field='ip_address';?>
									<label class="control-label" for="id_<?php echo $field?>">아이피</label>
									<div class="controls">
										<span class="input-xlarge uneditable-input"><?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?></span>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='user_agent';?>
									<label class="control-label" for="id_<?php echo $field?>">접속 브라우저</label>
									<div class="controls">
										<pre><?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?></pre>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='last_activity_string';?>
									<label class="control-label" for="<?php echo $field?>">마지막 행동</label>
									<div class="controls">
										<span class="input-xlarge uneditable-input"><?php if ( $this->input->post($field) == '' ) { echo $r[$field]; } else { echo set_value($field); }?></span>
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="form-actions">
									<a href="/<?php echo $context?>/lists/0/?<?php echo $query_string?>" class="btn">목록</a>
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