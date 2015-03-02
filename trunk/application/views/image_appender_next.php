<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko">
	<head>
		<title>이미지 첨부 완료</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1" /><![endif]-->
		<meta name="keywords" content="나이유미" />
		<meta name="description" content="나이유미의 게시판 프로젝트" />
		<link rel="stylesheet" type="text/css" href="/css/media.all.css" />
		<link rel="stylesheet" type="text/css" href="/css/media.all.agentfix.css" />
		<script type="text/javascript">
		//<![CDATA[
			var front_scope = "image_append_next";
			var board_front_scope = "";
		//]]>
		</script>
		<script type="text/javascript" src="/js/lib.global.js" charset="utf-8" ></script>
		<!--[if IE 7]><script type="text/javascript" src="/js/lib.IE7.min.js" charset="utf-8" ></script><script type="text/javascript" src="/js/lib.ie7-squish.min.js" charset="utf-8" ></script><![endif]-->
		<!--[If IE 8]><script type="text/javascript" src="/js/lib.IE8.min.js" charset="utf-8" ></script><![endif]-->
		<!--[if IE 9]><script type="text/javascript" src="/js/lib.IE9.min.js" charset="utf-8" ></script><![endif]-->
		<script type="text/javascript" src="/js/lib.anything.js" charset="utf-8" ></script>
		<script type="text/javascript" src="/js/lib.control.js" charset="utf-8" ></script>
		<script type="text/javascript" src="/js/lib.control.expend.js" charset="utf-8" ></script>
		<script type="text/javascript" src="/js/lib.control.caller.js" charset="utf-8" ></script>

	</head>
<body>
	<!-- <?php print_R($upload_data);?> -->
	<!--<img src="/attach/<?php echo $upload_data['upload_data']['file_name']?>" alt="<?php echo $upload_data['upload_data']['orig_name']?>" />
	<img src="/attach/<?php echo $upload_data['upload_data']['raw_name']?>_contents<?php echo $upload_data['upload_data']['file_ext']?>" alt="<?php echo $upload_data['upload_data']['orig_name']?>" />
	-->
	<?php echo $mode?>
	<div class="frame_wrapper">
		<?php echo form_open_multipart('board/image_append_next');?>
			<div class="attach_subcription">
				<span class="num">2. </span>이미지를 첨부 하시려면 본문에 이미지 첨부 버튼을 누르십시오.
			</div>
			<div class="attach_contents">
				<img
					src="/attach/<?php echo $upload_data['upload_data']['raw_name']?>_thumb<?php echo $upload_data['upload_data']['file_ext']?>"
					class="image_for_thumbs"
					data-image_for_contents="/attach/<?php echo $upload_data['upload_data']['raw_name']?>_contents<?php echo $upload_data['upload_data']['file_ext']?>"
					alt="<?php echo $upload_data['upload_data']['orig_name']?>"
				/>
			</div>
			<div class="attach_contents">
				<?php if ($mode == 'update'):?>
					<a href="#none" class="btn btn5 file_btn image_append_btn_step">본문에 이미지 첨부</a>
					<a href="#none" class="btn btn5 file_btn thumbnail_append_btn_step">섬네일 이미지 등록</a>
					<a href="#none" class="btn btn5 file_btn image_appender_close_btn_step">닫기</a>
				<?php else:?>
					<a href="#none" class="btn btn5 file_btn image_append_btn">본문에 이미지 첨부</a>
				<?php endif;?>
			</div>
		<?php echo form_close();?>
	</div>


</body>
</html>
