<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<header class="header">
			<div class="in">
				<dl class="shortCut">
					<dt class="blind">바로가기 메뉴</dt>
					<dd><a href="#sc">본문 바로가기</a></dd>
					<dd><a href="#sh">메인메뉴 바로가기</a></dd>
					<dd><a href="#sf">하단 바로가기</a></dd>
				</dl>
				<h1 class="logowrap">
					<a href="/"><img src="/images/logo.png" class="logo" alt="Naiyumie Board" /></a>
				</h1>
				<nav class="gnb" id="sh">
					<ul>
						<li class="g01">
							<a href="/statics/page/introduce_0">소개</a>
						</li>
						<li class="g02">
							<a href="/board/lists/noticeboard/">소식</a>
						</li>
						<li class="g03">
							<a href="/board/lists/freeboard/">커뮤니티</a>
						</li>
					</ul>
				</nav>
				<?php if (!$signed):?>
					<a href="/member/sign_in/go" class="singlesign_go">사인인</a>
				<?php endif;?>
			</div>
		</header>