<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('admin_inc_layout_admin_head', array('layout'=>'full_layout manual_iframe_inner'));?>
<?php $this->load->view('admin_inc_layout_admin_script');?>

		<h1 class="manual_heading">도움말</h1>
		<a href="#close" class="manual_close_button" title="닫기"></a>

		<?php echo $contents?>


<?php $this->load->view('admin_inc_layout_admin_foot');?>