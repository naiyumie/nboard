<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
/********************************
    USER INFO
********************************/
?>

				<?php if ($signed):?>
					<article class="box box2 signed">
						<div class="in">
							<div class="basicauth">
								<span class="signed_id"><?php echo $signed_data['nick']?><span class="suffix">님</span></span>
								<span class="auth"><?php echo $signed_data['type_kr']?><span class="level">1LV</span></span>

							</div>
							<div class="biography">
								<span class="bio_since title">since<span class="dates"><?php echo $signed_data['dates']?></span></span>

								<span class="bio_signed title">signed<span class="dates"><?php echo $signed_data['signed_dates']?></span></span>

							</div>
							<hr class="sep sep1" />
							<ul class="article_active_history">
								<li><span class="title">사인인 횟수</span> <span class="num"><?php echo $signed_data['count_signed']?><span class="suffix"> 회</span></span></li>
								<li><span class="title">게시글 작성수</span> <span class="num"><?php echo $signed_data['count_write_article']?><span class="suffix"> 개</span></span></li>
								<li><span class="title">댓글 작성수</span> <span class="num"><?php echo $signed_data['count_write_comment']?><span class="suffix"> 개</span></span></li>
							</ul>
							<hr class="sep sep2" />
							<a href="/member/sign_out" class="btn btn3">사인아웃</a>
							<a href="/member/retrieve_and_update" class="change_myinfo">내정보수정</a>
							<?php if ($admin_signed):?>
								<a href="/admin/" class="go_admin">관리자 바로가기</a>
							<?php endif;?>
						</div>
					</article>
				<?php else:?>
					<article class="box box2 unsigned">
						<div class="in">
							<a href="/member/sign_in/go" class="btn btn3">사인 인</a>
						</div>
					</article>
				<?php endif;?>
<?php
/********************************
    LNB
********************************/
?>

				<?php if ($lnb == 'introduce'):?>
					<h2>소개</h2>
					<nav class="lnb">
						<ul>
							<li class="l01"><a href="/statics/page/introduce_0">NB 프로젝트 소개</a></li>
							<li class="l02"><a href="/statics/page/introduce_1">MVC 패턴이란?</a></li>
							<li class="l03"><a href="/statics/page/introduce_2">코드이그나이터 소개</a></li>
							<li class="l04"><a href="/statics/page/introduce_3">웹 접근성 소개</a></li>
							<li class="l05"><a href="/statics/page/introduce_4">적용기술 소개</a></li>
						</ul>
					</nav>
				<?php endif;?>

				<?php if ($lnb == 'membership'):?>
					<h2>멤버쉽</h2>
					<nav class="lnb">
						<ul>
							<?php if ($signed):?>
								<li class="l02_notsession"><a href="/member/retrieve_and_update">멤버 정보 수정</a></li>
								<li class="l03_notsession"><a href="/member/password_change">패스워드 변경</a></li>
								<li class="l01_notsession"><a href="/member/leave">멤버 탈퇴</a></li>
							<?php else:?>
								<li class="l01"><a href="/member/sign_up">멤버 조인</a></li>
								<li class="l02"><a href="/member/findid">아이디 찾기</a></li>
								<li class="l03"><a href="/member/findpassword/go">패스워드 찾기</a></li>
							<?php endif;?>
						</ul>
					</nav>
				<?php endif;?>

				<?php if ($lnb == 'board_noticeboard' || $lnb == 'board_updatenews'):?>
					<h2>소식</h2>
					<nav class="lnb">
						<ul>
							<li class="l01"><a href="/board/lists/noticeboard">공지사항</a></li>
							<li class="l02"><a href="/board/lists/updatenews">업데이트 소식</a></li>
						</ul>
					</nav>
				<?php endif;?>

				<?php if ($lnb == 'board_freeboard' || $lnb == 'board_gallery'):?>
					<h2>커뮤니티</h2>
					<nav class="lnb">
						<ul>
							<li class="l01"><a href="/board/lists/freeboard">자유게시판</a></li>
							<li class="l02"><a href="/board/lists/gallery">갤러리</a></li>
						</ul>
					</nav>
				<?php endif;?>