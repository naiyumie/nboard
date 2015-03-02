<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => '멤버조인 > 가입 인증 - 나이유미 게시판',
		'front_scope' => 'signup_join_authentication',
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
						<?php echo get_form_hidden_fields($form_data); ?>

						<h3>멤버 조인</h3>
						<div class="member_join_phase phase3">
							멤버 조인을 위해서는
							총 약관동의 &gt; 기본정보 입력 &gt; 가입 인증 &gt; 가입 완료 단계를 거치며
							가입 인증 입력 단계를 진행 중 입니다.
						</div>
						<div class="subcription1">
							<strong>그림</strong>에 적힌 이미지를 입력 하세요.
						</div>
						<div class="formstyle">
							<table role="presentation" summary="가입 인증 입력 양식">
								<colgroup>
									<col style="width:13%">
									<col>
								</colgroup>
								<tr class="section">
									<th scope="col"><span class="required">*</span><label for="input_captcha">자동등록 방지</label></th>
									<td class="sep captcha">
										<span class="captcha_container"><?=$captcha?></span>
										<input type="text" name="captcha" id="input_captcha" class="text1 s" />
										<span class="validator">왼쪽의 글자를 입력하세요. </span>
									</td>
								</tr>
								<tr class="section">
									<th scope="col">이미지 갱신</th>
									<td>
										<a href="#none" class="btn btn4 captcha_refresh">이미지 갱신</a>
										<span class="validator">이미지가 알아볼 수 없는 경우 클릭하세요.</span>
									</td>
								</tr>
							</table>

							<div class="button_container2">
								<input type="submit" class="btn btn4" value="다음으로">
							</div>
						</div>
					<?php echo form_close();?>
				</div>
			</section>
		</div>





<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>