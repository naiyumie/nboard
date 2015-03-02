<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko">
	<head>
		<title><?php echo $head_title?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1" /><![endif]-->
		<meta name="keywords" content="나이유미" />
		<meta name="description" content="나이유미의 게시판 프로젝트" />
		<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
		<link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
		<meta name="viewport" id="viewport" content="user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, width=device-width" />

		<link rel="stylesheet" type="text/css" href="/css/media.all.css" />
		<link rel="stylesheet" type="text/css" href="/css/media.all.agentfix.css" />

		<script type="text/javascript">
		//<![CDATA[
			var front_scope = "<?php echo $front_scope?>";
			var board_front_scope = "<?php if (isset($board_front_scope)) { echo $board_front_scope; }?>";
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