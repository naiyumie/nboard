<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => '멤버조인 > 약관동의 - 나이유미 게시판',
		'front_scope' => 'signup_licence_agreement',
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
					<?php echo form_open('member/signup_join_form', array('class'=>'form','id'=>'form')); ?>
						<h3>멤버 조인</h3>
						<div class="member_join_phase phase1">
							멤버 조인을 위해서는
							총 약관동의 &gt; 기본정보 입력 &gt; 가입 인증 &gt; 가입 완료 단계를 거치며
							약관동의 단계를 진행 중 입니다.
						</div>
						<div class="subcription1">
							<span class="required_text">*</span> 으로 표시된 부분은 필수 입력 사항 입니다.
						</div>
						<div class="formstyle">

							<table role="presentation" summary="이용약관 동의 양식">
								<tr>
									<th scope="row" colspan="2" class="single_th"><span class="required">*</span>이용약관</th>
								</tr>
								<tr>
									<td colspan="2">
										<div class="textbox1">
<pre class="pretext">
◆ Naiyumie Board 회원약관

1. 개인정보의 수집 및 이용 목적
   - 웹사이트의 원할한 이용을 위함.

2. 수집하는 개인정보의 항목
   - 필수정보 : 아이디명, 패스워드, 아이디/패스워드를 찾기 위한 이메일 주소, 별명.
   - 선택정보 : 자기소개.

3. 개인정보의 보유 및 이용기간
   - 위의 개인정보는 웹사이트의 원할한 이용을 위하여 사인인 하기 위함이며, 아이디/패스워드 분실시를 대비해
     이메일로 그 확인 절차를 갖고 있습니다.

   - 다만, 웹사이트의 회원이 개인정보의 삭제를 원하는 경우 지체 없이 해당 정보를 삭제합니다.

</pre>
										</div>
									</td>
								</tr>
								<tr class="section">
									<td class="descript">위 이용약관에 동의 하십니까?</td>
									<td class="descript right">
										<div class="radiogroup radio1">
											<input type="radio" id="donot_agree1" name="term_agreement" value="donot_agree" class="radio1x" checked="checked" />
											<label for="donot_agree1">동의안함</label>
										</div>
										<div class="radiogroup radio1">
											<input type="radio" id="agree1" name="term_agreement" value="agree" class="radio1x" />
											<label for="agree1">동의함 (필수)</label>
										</div>
									</td>
								</tr>
							</table>
							<table role="presentation" summary="개인정보 제공 및 활용 동의 양식">
								<tr>
									<th scope="row" colspan="2" class="single_th"><span class="required">*</span>개인정보 제공 및 활용 동의</th>
								</tr>
								<tr>
									<td colspan="2">
										<div class="textbox1">
<pre class="pretext">
◆ Naiyumie Board 개인정보 제공 및 활용 동의

1. 수집 및 이용 목적
   - 웹사이트 사인인시 본인확인

2. 수집하는 고유식별정보 항목
   - 이메일

3. 고유식별정보의 보유 및 이용기간
   - 해당정보는 웹사이트 데이터베이스에 저장되며 사이트 접속을 위하여 멤버 구분에 사용됩니다.
   - 다만, 입사지원자가 개인정보의 삭제를 요청하는 경우 지체 없이 이를 삭제합니다.
</pre>
										</div>
									</td>
								</tr>
								<tr class="section">
									<td class="descript">위 개인정보 취급방침에 동의 하십니까?</td>
									<td class="descript right">
										<div class="radiogroup radio2">
											<input type="radio" id="donot_agree2" name="privacy_polish" value="donot_agree" class="radio2x" checked="checked" />
											<label for="donot_agree2">동의안함</label>
										</div>
										<div class="radiogroup radio2">
											<input type="radio" id="agree2" name="privacy_polish" value="agree" class="radio2x" />
											<label for="agree2">동의함 (필수)</label>
										</div>
									</td>
								</tr>
							</table>
							<div class="button_container1 separation">
								<div class="checkbox checkbox1">
									<input type="checkbox" class="checkbox1x" id="all_agreement" name="all_agree" />
									<label for="all_agreement">모두 동의 합니다.</label>
								</div>
							</div>
							<div class="button_container2">
								<a href="#none" class="btn btn4 submit_button" data-form=".form">다음으로</a>
							</div>
						</div>
					<?php echo form_close();?>
				</div>
			</section>
		</div>




<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>