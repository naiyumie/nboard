<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => '웹 접근성 소개 - 나이유미 게시판',
		'front_scope' => 'introduce_3',
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
					<h3>웹 접근성 소개</h3>

					<img src="/images/fig_5.png" alt="웹 표준, 웹 접근성, 웹 호환성 소개" />

					<h4>웹 표준, 웹 접근성, 웹 호환성?</h4>
					<p>웹 표준, 웹 접근성, 웹 호환성은 웹 전문가 라면 익숙하게 들어왔을 말들입니다. 이 용어 및 개념들은 정해진 규격대로 작성하게 되면 누구나 어떤 환경에서나 정보 제공자가 의도하는 정보를 전달하고 전달받을 수 있게 된다는 점을 의미 합니다.</p>
					<p>웹 표준은, (X)HTML 등에 대해 W3C가 정해놓은 규격, 또는 이를 준수하는 것을 의미합니다.</p>
					<p>웹 접근성은 웹 표준의 확장 개념이며, 인적, 환경적 제약에 관계없이 원하는 정보에 접근하고 제어가 가능한 구현 부분에 중점을 둡니다. 때문에 웹 표준에 맞게 구현하였을지라도 웹 접근성이 100% 준수되었다고 보기는 힘듭니다. 대체 텍스트의 올바른 사용, 색상만이 아닌 패턴과 동시 사용과 같이 웹 표준 보다 더욱 보완되어야 하는 부분들이 존재합니다. 장애인 차별 방지 법으로 인해 대두된 웹 접근성의 개념이나, 반드시 장애인들을 대상으로 하는 것은 아닙니다. 장애가 없는 일반인의 경우도 마우스를 쓰지 못하는 환경, 사운드를 재생할 수 없는 환경, 그리고 스크립트나 액티브엑스 제한 환경, 스마트폰과 같은 다른 미디어 사용 환경 등에 처할 때라도 웹 사이트를 이용할 수 있도록 만드는 것이 웹 접근성 준수의 개념입니다.</p>
					<p>웹 호환성은 크로스 브라우징이라고 하며, 환경적 요인에서 웹 브라우저라는 웹 문서를 읽어드리는 도구에 대한 호환성을 말합니다. 다양한 브라우저에서 같은 정보를 제공하고, 브라우저의 표현, 해석 방식에 차이를 최소화하여, 똑같은 화면이 아닌, 유사한 화면에 동일한 정보와 동일한 결과는 낳는 제어를 말합니다. 각 브라우저의 특성을 이해하고 정보를 올바르게 표시하는 게 중요합니다.</p>
				</div>
			</section>
		</div>




<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>