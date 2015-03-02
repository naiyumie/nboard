<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => '멤버조인 > 가입 완료 - 나이유미 게시판',
		'front_scope' => 'signup_compleate',
		'lnb' => 'membership'
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
					<?php echo form_open('member/signup_compleate', array('class'=>'form','id'=>'form')); ?>

						<h3>멤버 조인</h3>
						<div class="member_join_phase phase4">
							멤버 조인을 위해서는
							총 약관동의 &gt; 기본정보 입력 &gt; 가입 인증 &gt; 가입 완료 단계를 거치며
							가입 완료 단계를 진행 중 입니다.
						</div>
						<div class="subcription1">
							가입을 <strong>축하</strong> 합니다.
						</div>
						<div class="formstyle">
							<table role="presentation">
								<colgroup>
									<col style="width:13%">
									<col>
								</colgroup>
								<tr class="section">
									<th scope="col">아이디</th>
									<td class="sep read">
										<?php echo $retrieve['user_id']?>
									</td>
								</tr>
								<tr class="section">
									<th scope="col">별명</th>
									<td class="sep read">
										<?php echo $retrieve['nick']?>
									</td>
								</tr>
								<tr class="section">
									<th scope="col">가입일시</th>
									<td class="sep read">
										<?php echo $retrieve['dates']?>
									</td>
								</tr>
								<tr class="section">
									<th scope="col">이메일</th>
									<td class="sep read">
										<?php echo $retrieve['email']?>
									</td>
								</tr>
								<tr class="section">
									<th scope="col">가입인사</th>
									<td class="sep read textline">
										<?php echo $retrieve['introduce']?>
									</td>
								</tr>

							</table>

							<div class="button_container2">
								<a href="/member/sign_in/go/" class="btn btn4">가입완료</a>
							</div>
						</div>

					<?php echo form_close();?>
				</div>
			</section>
		</div>




<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>