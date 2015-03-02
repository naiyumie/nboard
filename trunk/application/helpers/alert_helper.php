<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// 경고메세지를 경고창으로
function alert_back($msg='', $url='')
{
	$CI =& get_instance();

	if (!$msg) $msg = '올바른 방법으로 이용해 주십시오.';

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'>alert('".$msg."');";
    if ($url)
        echo "location.replace('".$url."');";
	else
		echo "history.go(-1);";
	echo "</script>";
	exit();
}

// 뒤로
function back()
{
	$CI =& get_instance();
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'>";
	echo "history.go(-1);";
	echo "</script>";
	exit("올바른 방법으로 이용해 주십시오.");

}

// 홈으로
function home()
{
	$CI =& get_instance();
	//echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'>";
	echo "location.replace('/')";
	echo "</script>";
	exit("올바른 방법으로 이용해 주십시오.");
}

// 홈으로
function alert_home($msg)
{
	$CI =& get_instance();
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'>";
	echo "alert('".$msg."');";
	echo "location.replace('/')";
	echo "</script>";
	exit("올바른 방법으로 이용해 주십시오.");
}

// 경고메세지 출력후 창을 닫음
function alert_close($msg)
{
	$CI =& get_instance();

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'> alert('".$msg."'); window.close(); </script>";
	exit("올바른 방법으로 이용해 주십시오.");
}

// 경고메세지만 출력
function alert($msg)
{
	$CI =& get_instance();

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'> alert('".$msg."'); </script>";
	exit("올바른 방법으로 이용해 주십시오.");
}

// 경고메세지만 출력 종료 하지 않음.
function alert_not_exit($msg)
{
	$CI =& get_instance();

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'> alert('".$msg."'); </script>";
}
?>