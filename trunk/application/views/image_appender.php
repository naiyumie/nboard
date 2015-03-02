<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => '이미지 첨부 - 나이유미 게시판',
		'front_scope' => 'image_append',
		'board_front_scope' => ''
	);
	$this->load->view('inc_layout_sub_head', $view_argument);
?>

	<div class="frame_wrapper">
		<!-- <?=$upload_error?> -->
		<?php echo form_open_multipart('board/image_append_next'.'/'.$mode.'');?>
			<div class="attach_subcription">
				<span class="num">1. </span>이미지 파일(jpg, png, gif, jpeg)을 선택하고 업로드 버튼을 누르십시오.
			</div>
			<div class="attach_contents">
				<input type="file" class="file_inp" name="userfile" />
			</div>
			<div class="attach_contents">
				<input type="submit" class="file_btn btn btn5" value="업로드" />
			</div>
		<?php echo form_close();?>
	</div>


<?php $this->load->view('inc_layout_sub_foot');?>