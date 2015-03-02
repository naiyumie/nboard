<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



# POST배열을 hidden으로 돌려준다.
function get_form_hidden_fields($array)
{
	$ret = '';
	foreach ($array as $key=>$val) {
		$ret .= '<label class="blind">'.$key.'<input type="hidden" name="'.$key.'" value="'.$val.'" /></label>';
	}
	return $ret;
}


# naiyumie >> na****ie
function marked_text($p1)
{
	if (empty($p1)) return;
	$str_cn = "";
	foreach (str_split(substr($p1,2,-2)) as $key=>$val) {
		$str_cn .= '*';
	}
	$splted = str_split($p1);
	$ret = $splted[0].$splted[1].$str_cn.substr($p1,-2,strlen($p1));
	return $ret;
}


# 배열에 카운트를 센다.
function cnt($cnt, $mode=0)
{
	if ($mode === 1) {
		$mode = COUNT_RECURSIVE;
	}
	if (!empty($cnt) && ($cnt !== -1)) {
		return count($cnt, $mode);
	}
	return 0;
}


# 멤버 여부 : 입력한 문자열에 따라 사용자/관리자 리턴
function get_signed_type_kr($arg)
{
	$ret = '';
	if ($arg == 'users') {
		$ret = '멤버';
	} else {
		$ret = '관리자';
	}
	return $ret;
}


# 탈퇴여부 : 입력한 문자열에 따라 탈퇴/활동 리턴
function get_is_blind_kr($arg)
{
	$ret = '';
	if ($arg == 'Y') {
		$ret = '탈퇴';
	} else {
		$ret = '활동';
	}
	return $ret;
}


# 000-000-000 >> 000.000.000
# Y-m-d >> Y.m.d도 응용.
function dash_to_point($text)
{
	$text = str_replace('-','.',$text);
	return $text;
}


# 일자가 오늘 날짜와 같다면 시간을 보여주고 그렇지 않다면 날짜를 보여준다.
# $arg1 = 날짜
# $arg2 = 시간
function get_dates_or_times_from_today($arg1, $arg2)
{
	$ret = '';
	if (date('Y-m-d') == $arg1) {
		$ret = $arg2;
	} else {
		$ret = dash_to_point($arg1);
	}
	return $ret;
}


# 해당 html에 allowedTags를 제외한 태그를 제거 한다.
function remove_tag($source)
{
	$allowedTags = '<h1><strong><span><u><i><a><ul><li><pre><hr><blockquote><img><embed><sub><sup><br><p><font><div><table><tr><td><th>';
	$source_last = strip_tags($source, $allowedTags);
	$stripAttrib = 'javascript:|onclick|ondblclick|onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|onkeydown|onkeyup';
	return stripslashes(preg_replace("/$stripAttrib/i", 'forbidden', $source_last));
}


?>