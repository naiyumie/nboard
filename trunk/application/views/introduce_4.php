<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => '적용기술 소개 - 나이유미 게시판',
		'front_scope' => 'introduce_4',
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
					<h3>적용기술 소개</h3>

					<!-- <img src="/images/fig_5.png" alt="웹 표준, 웹 접근성, 웹 호환성 소개" />-->
					<p>"무엇보다 그리고 다른 어떤 것보다 웹을 추구하고 혁신합니다." 나이유미 게시판은 다년간의 노하우와 웹 기술의 모던함과 단순함, 그리고 담백함을 추구합니다. 웹 사이트 구축에 특별한 기술이나 노하우가 필요한 것이 아닙니다. 우리가 익숙히 알고 있던 라이브러리와 오픈소스를 통해 발견해 낼 수 있고, 그것으로 웹사이트의 초석을 다질 수 있습니다. 이곳에서는 나이유미 게시판에서 사용된 라이브러리와 오픈소스를 소개합니다. 좋은 프로그램을 공개해주신 많은 개발자분들께 감사드립니다.</p>

					<h4>1. 기반 기술</h4>
					<ol>
						<li><span class="num">1.1</span> 웹 디자인</li>
						<li><span class="num">1.2</span> 웹 퍼블리싱</li>
						<li><span class="num">1.3</span> 웹 서버사이드 프로그래밍 기술</li>
					</ol>

					<h4>2. 기반 기술에 입각한 확장 기술</h4>

					<h5>2.1 웹 디자인</h5>
					<ol>
						<li><span class="num">2.1.1</span> adobe photoshop, adobe illustrator를 이용한 그래픽 드로잉 기술.</li>
						<li><span class="num">2.1.2</span> 웹사이트의 해상도와 글꼴 가독성을 고려한 디자인.</li>
						<li><span class="num">2.1.3</span> 인포메이션 아키텍처(IA) 설계와 UI&UX (User Interfaces & User Experience) 디자인.</li>
						<li><span class="num">2.1.4 </span>웹 접근성을 고려한 색상 배치.</li>
						<li><span class="num">2.1.5</span> 돋움, 돋움체, 굴림, 맑은 고딕, Futura , Optima, Respective 폰트 사용.</li>
						<li><span class="num">2.1.6</span> 무료 딩벳, 픽토그램 기반 아이콘 이미지 편집 및 가공 사용.</li>
					</ol>

					<h5>2.2 Front-End 웹 퍼블리싱.</h5>
					<ol>
						<li><span class="num">2.2.1</span> 비트맵 드로잉 그래픽을 html5(html5, css2.1~3, JavaScript) 퍼블리싱 하는 프론트엔드 기술.</li>
						<li><span class="num">2.2.2</span> w3c html5(HyperText Markup Language) 웹 표준 스펙에 준수한 마크업 퍼블리싱 기술.</li>
						<li><span class="num">2.2.3</span> w3c css(Cascading Style Sheets) 웹 표준 스펙에 준수한 스타일링 기술.</li>
						<li><span class="num">2.2.4</span> ECMA-262 표준에 기반을 둔 객체지향 자바스크립트 프로그래밍(JavaScript Object Oriented Programming).</li>
						<li><span class="num">2.2.5</span> 웹 접근성(Web Accessbility, K-WAH4.0 validator 사용), 웹 호환성(Web Compatibility Web Crossbrowsing, ie8+), 웹 표준(Web Standard) 준수.</li>
						<li><span class="num">2.2.5</span> sass css transpiling(ruby programming language - sass transpiler) 사용.</li>
						<li><span class="num">2.2.6</span> PC와 mobile을 고려한 반응형(Responsive web design) 파일 리스트 설계.</li>
						<li><span class="num">2.2.7</span> jQuery Core & jQuery migrate & jQuery UI 사용.</li>
						<li><span class="num">2.2.8</span> 사용 라이브러리 및 플러그인.</li>
						<li><span class="num">2.2.8.1</span> jQuery에 기반을 둔 웹 위지윅 에디터 cleditor 사용.</li>
						<li><span class="num">2.2.8.2</span> jQuery cookie jquery-cookie 플러그인 사용.</li>
						<li><span class="num">2.2.8.3</span> 사용자 화면, 메인 키비쥬얼을 위한 woothemes-FlexSlider 플러그인 사용.</li>
						<li><span class="num">2.2.8.4 </span>구형 브라우저의 모던 브라우저 화를 위한 모더나이징 패치 ie7.js, html5shiv.js, modernizr.js, selectivizr.js, Placeholders.js 사용.</li>
						<li><span class="num">2.2.8.5</span> 관리자 페이지 UI표준 화면을 위한 Bootstrap3을 기반을 둔 Bootstrap Metro Dashboard 테마 사용.</li>
						<li><span class="num">2.2.8.6</span> 부트스트랩 확장 bootstrap timepicker 라이브러리 사용.</li>
						<li><span class="num">2.2.8.7</span> font-awesome 오픈소스 CSS 라이브러리 사용.</li>
					</ol>

					<h5>2.3 apache, php, mysql 웹 서버사이드 프로그래밍 기술.</h5>
					<ol>
						<li><span class="num">2.3.1</span> xampp 오픈소스 apm 설치 프로그램 사용.</li>
						<li><span class="num">2.3.2</span> Apache 2.4.7 기반.</li>
						<li><span class="num">2.3.2.1</span> virtual host를 위한 http.conf 적용.</li>
						<li><span class="num">2.3.2.2</span> 웹사이트의 보안과 codeIgniter 설정을 위한 .htaccess 적용.</li>
						<li><span class="num">2.3.3</span> PHP Version 5.5.6 기반을 둔 script programming. (5 버전대 하위 호완성 유지)</li>
						<li><span class="num">2.3.3.1</span> MVC 모델 php 라이브러리 CodeIgniter-2.2.1 적용. CodeIgniter 표준 MVC 모델에 입각한 개발.</li>
						<li><span class="num">2.3.3.2</span> CodeIgniter 확장 라이브러리 MY_Pagination, aler_helper 확장.</li>
						<li><span class="num">2.3.4</span> Mysql 5.6.14 - MySQL Community Server 사용.</li>
						<li><span class="num">2.3.4.1</span> MyISAM 파일 디비 사용.</li>
						<li><span class="num">2.3.4.2</span> Sql 관리도구 phpMyAdmin 4.3.10 사용.</li>
					</ol>

					<h4>3. 특별히 감사 드립니다.</h4>
					<ol>
						<li><span class="num">3.1</span> 네이버 맞춤법 검사기 사용.</li>
						<li><span class="num">3.2</span> 부산대학교 인공지능연구실과 (주)나라인포테크가 개발하는 한국어 맞춤법/문법 검사기 사용.</li>
						<li><span class="num">3.3</span> O'REILLY JavaServer Pages 2nd Ed. By Hans Bergsten 2nd Edition August 2002 글 인용.</li>
						<li><span class="num">3.4</span> PHP의 제작자 rasmus의 Drupalcon 2008의 프레젠테이션 인용.</li>
						<li><span class="num">3.5</span> CodeIgniter 한국 사용자 포럼의 한글 번역 매뉴얼 응용 및 인용.</li>
						<li><span class="num">3.6</span> CodeIgniter 한국 사용자 포럼 바로가기 배너.</li>
						<li><span class="num">3.7</span> CodeIgniter EllisLab 바로가기 배너 및 문구 응용 및 인용.</li>
						<li><span class="num">3.8</span> svn에 입각한 디렉터리 구조 설계 채용.</li>
						<li><span class="num">3.9</span> ... 그리고 구글신.</li>
					</ol>

				</div>
			</section>
		</div>




<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>