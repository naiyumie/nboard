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
						<span>작성</span>
					</li>
				</ul>
				<a href="#<?php echo $manual_context?>" class="breadcrumb_help" title="도움말보기"><i class="icon-question-sign"></i></a>
			</div>
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header">
						<h2>게시물 작성</h2>
					</div>
					<div class="box-content">
						<?php echo form_open(''.$context.'/create_proc/'.$this->uri->segment(3,0).'/'.$this->uri->segment(4,0).'/', array('class'=>'form-horizontal','id'=>'form')); ?>
							<fieldset>
								<div class="control-group">
									<?php $field='title';?>
									<label class="control-label" for="id_<?php echo $field?>">제목</label>
									<div class="controls">
										<input name="<?php echo $field?>" id="id_<?php echo $field?>" value="<?php echo set_value($field); ?>" class="input-full" type="text"  >
										<?php echo form_error($field);?>
									</div>
								</div>

								<div class="control-group">
									<?php $field='content';?>
									<label class="control-label" for="id_<?php echo $field?>">내용</label>
									<div class="controls">
										<textarea name="<?php echo $field?>" id="id_<?php echo $field?>" class="input-full"><?php echo set_value($field); ?></textarea>
										<?php echo form_error($field);?>
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


		</div>
	</div>
</div>



<?php $this->load->view('admin_inc_layout_admin_footer');?>
<script type="text/javascript">
	// 네비게이션 활성화
	$("[data-sidebar_id=<?php echo $context?>]").addClass('active');
</script>
<?php $this->load->view('admin_inc_layout_admin_foot');?>