<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => 'NB 프로젝트 소개 - 나이유미 게시판',
		'front_scope' => 'introduce_0',
		'lnb' => 'introduce'
	);
	$this->load->view('inc_layout_sub_head', $view_argument);
?>
<?php $this->load->view('inc_layout_sub_header');?>



		<div class="wrapper">
			<section class="sub">
				<aside class="sidebar">
					<?php $this->load->view('inc_layout_sub_aside', $view_argument); ?>
				</aside>
				<div class="content_wrap" id="sc">
					<h3>NB 프로젝트 소개</h3>

					<img src="/images/fig_0.png" alt="NAIYUMIE BOARD PROJECT 로고" />

					<h4>머릿말</h4>
					<p>NB는 NAIYUMIE BOARD의 약어로 한글로 직역 하면 ‘나이유미보드’ 로써 일반적인 홈페이지 및 웹사이트의 회원관리 및 게시판 관리를 위해 고안된 웹 프로그램 입니다. 웹사이트 개발에 특화된 PHP 스크립트 언어와 오픈소스 데이터베이스의 일종인 MySQL을 사용하여 개발되었으며, 코드의 유연함과 규약을 정립하기 위하여 CodeIgniter프레임 워크를 채용 하였습니다. 또한 PHP 스크립트 언어가 사용하는 특수한 라이브러리들의 의존성이 있을 수 있습니다.</p>

					<img src="/images/fig_1.png" alt="어플리케이션 레이어 설명" />

					<h4>코드의 유연함에 중점을 둔 설계</h4>
					<p>나이유미보드 프로그램은 웹 전문가를 위한 일종의 툴 이자 프레임워크이며, 웹사이트를 만들 때 필요한 일반적인 기능을 한 데로 묶어 패키지화하려는데 그 목적이 있습니다. 많은 웹 프로그램에서 채용하고 있는 관리자 페이지와 사용자 페이지를 구분하였으며, 웹사이트의 여러 기능적인 부분들을 재 사용할 수 있게 하였습니다. 회원가입, 회원 정보 수정, 회원 탈퇴 등의 일반 회원 관련 기능과 자유 게시판, 공지 게시판, 사진 앨범 등 일반 게시판 관련 기능을 기본적으로 제공하여 이를 재사용 할 수 있어 프로젝트의 핵심 기능 부분에 시간과 노력을 투자하여 프로젝트를 완수할 수 있도록 도와줍니다.</p>

					<h4>오픈소스</h4>
					<p>나이유미보드 프로젝트는 오픈소스 프로젝트로 시작되었습니다. 오픈소스 라이선스중 하나인 LGPL로 배포되고 있으며, 소스 코드의 수정이 자유로우며, 무료입니다. 또한 수정한 코드의 재 배포 역시 무료입니다. 저의 닉네임인 ‘나이유미’를 걸고 개발하는 게시판이니 만큼 저의 기술의 정수를 이 게시판에 녹일 수 있도록 노력하겠습니다.</p>

					<h4>실행환경 및 서버 요구사항</h4>
					<p>
						<span class="ln">Apache가 설치된 Web Server (.htaccess 생성 필요)와 가상 호스트 가능 환경. 혹은 웹 호스팅.</span>
						<span class="ln">PHP 5.1.6 이상</span>
						<span class="ln">Database (MySQL 4.1 이상 5.0 이상 권장)</span>
					</p>
				</div>
			</section>
		</div>




<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>