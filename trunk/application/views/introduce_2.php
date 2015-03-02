<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => '코드이그나이터 소개 - 나이유미 게시판',
		'front_scope' => 'introduce_2',
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
					<h3>코드이그나이터 소개</h3>

					<img src="/images/fig_4.png" alt="코드이그나이터 로고" />

					<h4>코드이그나이터는 무엇입니까?</h4>
					<p>코드이그나이터는 PHP 프레임워크입니다. NAIYUMIE BOARD에 프레임워크로 채택한 이유라면 PHP개발자 라면 누구나 배우기 쉽고 매뉴얼이 한글로 번역되어 있으며, 한국에서의 사용자 포럼도 활성화되어있기 때문입니다. 자세한 내용은 코드 이그나이터 한국 사용자 포럼의 매뉴얼 부분에서 발췌하였으며 각색하여 소개할까 합니다.</p>
					<p>코드이그나이터 한국 사용자 포럼의 매뉴얼 부분에서 발췌 :</p>
					<p>코드이그나이터(이하 CI)는 PHP를 이용하여 웹사이트를 구축하고자 하는 사람들을 위한 개발 프레임 워크입니다. CI는 날코딩 하는 분들을 위해 풍부한 라이브러리, 쉬운 인터페이스 및 쉬운 로직을 제공함으로써 개발 속도를 높여 드릴 것입니다. CI는 개발자가 최소한의 코딩만 하도록 하여 프로젝트에 집중할 수 있도록 해줍니다.</p>
					<p>CodeIgniter는 극한의 성능, 적용성, 최소성, 유연성, 가벼움을 목적으로 설계되었습니다. 이 목적을 만족시키기 위해서 벤치마킹, 리팩토링, 단순화하기 등을 개발의 전 과정에서 수행하였습니다. 그리고, 이 목적에 맞지 않는 것은 단호히 제거하였습니다.</p>
					<p>기술적,설계적 관점에서 CodeIgniter는 다음의 목표를 따릅니다.</p>
					<p>1. 동적인 작동(Dynamic Instantiation). CodeIgniter에서 컴포넌트들은 글로벌이 아니라 오직 사용자가 필요할 때만 로드되어 사용됩니다. 어떤 기능이 필요할지 미리 짐작하지 않으므로 매우 가벼운 상태를 기본으로 하고 있습니다. 작성한 컨트롤러와 뷰는 HTTP 요청이 발생할 때 비로소 무엇이 호출될지를 결정합니다.</p>
					<p>2. 느슨한 결합( Loose Coupling). 결합(Coupling)이란 어떤 컴포넌트가 어떤 컴포넌트에 의존하는가 하는 수준을 말합니다. 적은 컴포넌트 의존은 더욱 유연하고 재사용 가능한 시스템이 되게 합니다. 우리 목표는 대단히 느슨하게 결합된 시스템입니다.</p>
					<p>3. 컴포넌트 단일성(Component Singularity). 단일성이란 컴포넌트가 얼마나 목적에만 집중하는가에 대한 수준을 말합니다. CodeIgniter에서는 사용성을 극대화하기 위하여 각 클래스와 함수가 대단히 그 고유 기능에 집중되어 만들어져 있습니다.</p>
					<p>위 목표로 인하여 CodeIgniter 는 작은 패키지 이면서도 단순성,유연성,고가용성을 달성하기위해 노력하고있습니다.</p>


					<h4>PHP 프레임워크를 사용하지 마라. </h4>
					<p>PHP의 아버지 rasmus는 Drupalcon 2008의 프레젠테이션에서 PHP 프레임워크의 사용이 좋지 않다고 주장하였습니다.</p>
					<p>프레임워크를 사용하는 것은 단순한 PHP를 사용하는데 있어서 훨씬 성능을 낮게 한다는 이유 때문입니다.</p>
					<p>rasmus는 간단한 hello world를 출력하는 예제 PHP 페이지의 응답시간을 프레임워크 별로 비교하였으며, 단순히 직접 php를 사용했을 때보다 훨씬 늦은 속도를 보였습니다. 즉 php 프레임워크를 사용은 성능에 많은 손실을 입게 됩니다. 그러나 굳이 php 프레임워크를 사용한다면 CodeIgniter를 추천하였습니다. 그 이유는 즉 상대적으로 덜 복잡하게 구성되어 있으며 가장 퍼포먼스가 뛰어난 순수한 PHP에 가깝기 때문입니다.</p>
					<p>그러나 코드 컨벤션과 재 사용성, 가독성 등 프레임워크를 사용하였을 때 얻을 수 있는 효과가 많으며 모든 PHP 개발자 들이 이해하고 있는 사실입니다.</p>
				</div>
			</section>
		</div>




<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>