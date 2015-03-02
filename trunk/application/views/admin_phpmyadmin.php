<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('admin_inc_layout_admin_head');?>
<?php $this->load->view('admin_inc_layout_admin_header');?>
<?php $this->load->view('admin_inc_layout_admin_script');?>

<div class="container-fluid-full">
	<div class="row-fluid">
		<?php $this->load->view('admin_inc_layout_admin_aside'); ?>
		<div id="content" class="span10">
			<iframe src="http://localhost:8088/admin_assets/pma/index.php" id="myadmin_frame" frameborder="0" width="100%" height="100%" style="margin:0;padding:0;float:left;"></iframe>
		</div>
	</div>
</div>



<?php $this->load->view('admin_inc_layout_admin_footer');?>
<script type="text/javascript">
	// 리사이즈 처리
	$(function() {
		$('#content').css('padding', '0');
		$('#myadmin_frame').height( $('#content').height() );
	});
	$(window).resize(function() {
		$('#myadmin_frame').height( $('#content').height() );
	});

	// 네비게이션 활성화
	$("[data-sidebar_id=phpmyadmin]").addClass('active');
</script>
<?php $this->load->view('admin_inc_layout_admin_foot');?>