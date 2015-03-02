<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => 'MVC 패턴이란? - 나이유미 게시판',
		'front_scope' => 'introduce_1',
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
					<h3>MVC 패턴이란?</h3>

					<img src="/images/fig_2.png" alt="MVC패턴 소개" />

					<h4>MVC 패턴은 무엇인가?</h4>
					<p>현대적인 웹 프로그래밍 개발 패턴에서 MVC 아키텍처는 광범위하게 사용되고 있습니다. 인기 있는 프레임워크의 대부분은 MVC 패턴을 채택하고 있습니다. (PHP의 CodeIgniter,  Laravel, yii와 같은 프레임워크, JAVA의 스프링과 같은 전자 정부 프레임워크, MS의 asp.net과 같은 닷넷 프레임워크, 웹을 떠나 응용프로그램, 모바일앱에서도 그 두각을 나타냅니다. ) MVC는 프로그램의 디자인 패턴이며, 기능적인 부분인 애플리케이션을 말하는 것은 아닙니다. 유사하게, 아키텍처 패턴으로 알려져 있기도 합니다. </p>

					<p>즉, MVC는 레이어 기반의 아키텍처로 간주할 수 있습니다. 컨트롤러, 모델, 뷰가 서로 연관성이 있는 세 개의 계층을 말합니다. 사용자가 요청을 보내면 컨트롤러는 이를 받아 모델에 데이터를 요청하여 처리하고 뷰에 데이터를 입혀 사용자에게 보내 줍니다. 그리고 사용자의 웹브라우저는 이를 해석하여 화면에 렌더링 하게 됩니다. 뷰는 일반적으로  html이 나 json, xml과 같은 데이터 형태가 될 수도 있습니다.</p>

					<img src="/images/fig_3.png" alt="잘못된 개발 패턴" />

					<h4>규칙은 있으나 구속은 없다.</h4>
					<p>국내 혹은 국외에 PHP 게시판 웹 프로그램은 pure 한 상태로 쓰여 있거나 MVC와는 다른 프로그램 디자인 패턴을 따르고 있습니다. 그 예로 디자인적인 요소를 테마, 스킨 혹은 레이아웃 엔진으로 분리 시켰고, 위젯 기능으로 구분하거나 템플릿 엔진을 사용하여 화면을 구성하며, 프로그램의 경우 플러그인으로 구분하여 기능 추가를 위해 플러그인 형태로 패키징 하여 프로그래밍 할 필요가 있습니다. 부가기능을 관리하고 실행하는 계층을 코어 애플리케이션으로 정의하고, 부가기능 및 스킨 레이아웃 등의 부가기능을 플러그인으로 정의됩니다. 이로 인해 해당 프로그램은 무거워져 성능 하락을 가져오며, 억지로 프로그래밍 하는 과정 중 버그 발생의 위험을 가져올 수 있습니다. 이는 잘못된 프로그램 패턴입니다.</p>

					<p>또한, 플러그인과 스킨 등의 부가기능을 해석하고 관리하거나 동작시키기 위해서만 필요한 불필요한 기능들을 넣어 확장성을 강제 함으로써, 웹 전문가는 그러한 구속에 맞춰 디자인하거나 퍼블리싱 하거나 개발하는 등의 표현성이 구속된 불편한 리스크를 갖고 감으로써 자신의 능력을 강제합니다.</p>

					<p>그러나, NAIYUMIE BOARD는 MVC 패턴을 채용하고 유지함으로써, 실제 코딩 및 개발 시 유연하고 확장성이 좋은 코드 품질을 유지할 수 있습니다. 웹 전문가가 알아보기 쉽고 코딩하기 편해야 좋은 솔루션이 나온다고 생각하기 때문입니다.</p>


					<h4>웹개발시 MVC 패턴을 적용하는 일반적인 목적 </h4>
					<p>O'REILLY JavaServer Pages 2nd Ed. By Hans Bergsten 2nd Edition August 2002 라는 서적에 실려 있는 글 입니다. JSP의 경우 spring과 struts와 같은 MVC 프레임워크를 사용하여 개발하는 것이 일반화되어 있습니다.</p>
					<p>MVC에 기반한 JSP 어플리케이션 설계</p>
					<p>JSP 기술은 전화번호부나 직원휴가일정과 같은 간단한 웹어플리케이션에서부터 구인구직, 정교한 쇼핑몰 등의 성숙한 기업 어플리케이션에 이르기까지 모든 분야에서 유용하다. 나는 간단하거나 복잡한 어플리케이션에 모두 적합한 모델 - 뷰 - 컨트롤러 (MVC: Model-View-Controller) 라는 설계 방법을 소개하려고 한다.</p>
					<p>MVC는 제록스가 80년대말 발표한 여러 논문에서 처음 설명되었다. MVC 의 핵심은 프로그램로직을 세 개의 유닛 [ 모델, 뷰, 콘트롤러 ] 로 분리하는 것이다. 서버어플리케이션에서는 [ 비즈니스로직, 프레젠테이션, 리퀘스트프로세싱 ] 으로 어플리케이션 구성요소를 분류한다. 비즈니스로직은 고객,상품,주문 정보등과 같은 어플리케이션 데이터의 처리를 말할 때 쓰는 용어이다. 프레젠테이션은 이러한 데이터가 사용자에게 어떻게 보여지느냐를 의미한다. 예를들어 데이터의 위치, 글자의 종류나 크기 등을 말한다. 마지막으로 리퀘스트프로세싱은 비즈니스로직과 프레젠테이션 영역을 연결해주는 부분을 말한다. MVC 용어에 있어서, 모델은 비즈니스로직과 데이터에, 뷰는 프레젠테이션에, 콘트롤러는 리퀘스트프로세싱에 해당된다.</p>
					<p>왜 JSP 를 가지고 이렇게 설계를 할까? 그 답은 우선 앞의 두 요소에 있다. 어플리케이션 데이터구조와 로직(모델)은 전형적으로 가장 안정된 영역이고, 반면에 그러한 데이터의 프레젠테이션(뷰)은 사실 자주 변경된다는 점을 상기해보자. 단지 웹디자인의 최근 유행을 따르기 위해 많은 웹싸이트가 겪는 모든 성형수술을 주목해보자. 그러나 웹싸이트가 보여주는 데이터에는 변함이 없다. 프레젠테이션 로직이 비즈니스로직에서 분리되어야 하는 또 다른 평범한 예로, 국내외의 사용자에게 다양한 언어로 데이터를 보여주고 싶을 수 있다. 핸드폰이나 PDAs 와 같은 새로운 장치들에 대한 데이터처리는 최근의 경향이다. 각 클라이이언트 유형은 그에 맞는 프레젠테이션 포맷을 요구한다. 그렇다면, 비즈니스로직과 프레젠테이션을 분리함으로써 이러한 요구의 변경에 따라 어플리케이션을 진화시키기 쉽다는 것은 놀라운 일이 아니다. 비즈니스로직을 변경하지 않고 새로운 프레젠테이션 인터페이스를 개발할 수 있다.</p>
					<p>JSP Application Design with MVC</p>
					<p>JSP technology can play a part in everything from the simplest web application, such as an online phone list or an employee vacation planner, to full-fledged enterprise applications, such as a human-resource application or a sophisticated online shopping site. How large a part JSP plays differs in each case, of course. In this section, I introduce a design model called Model-View-Controller (MVC), suitable for both simple and complex applications.</p>
					<p>MVC was first described by Xerox in a number of papers published in the late 1980s. The key point of using MVC is to separate logic into three distinct units: the Model, the View, and the Controller. In a server application, we commonly classify the parts of the application as business logic, presentation, and request processing. Business logic is the term used for the manipulation of an application's data, such as customer, product, and order information. Presentation refers to how the application data is displayed to the user, for example, position, font, and size. And finally, request processing is what ties the business logic and presentation parts together. In MVC terms, the Model corresponds to business logic and data, the View to the presentation, and the Controller to the request processing.</p>
					<p>Why use this design with JSP? The answer lies primarily in the first two elements. Remember that an application data structure and logic (the Model) is typically the most stable part of an application, while the presentation of that data (the View) changes fairly often. Just look at all the face-lifts many web sites go through to keep up with the latest fashion in web design. Yet, the data they present remains the same. Another common example of why presentation should be separated from the business logic is that you may want to present the data in different languages or present different subsets of the data to internal and external users. Access to the data through new types of devices, such as cell phones and personal digital assistants (PDAs), is the latest trend. Each client type requires its own presentation format. It should come as no surprise, then, that separating business logic from the presentation makes it easier to evolve an application as the requirements change; new presentation interfaces can be developed without touching the business logic.</p>
				</div>
			</section>
		</div>




<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>