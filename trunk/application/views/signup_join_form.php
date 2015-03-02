<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => '멤버조인 > 기본정보 입력 - 나이유미 게시판',
		'front_scope' => 'signup_join_form',
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
					<?php echo form_open('member/signup_join_authentication', array('class'=>'form','id'=>'form')); ?>
						<?php echo get_form_hidden_fields($form_data); ?>

						<h3>멤버 조인</h3>
						<div class="member_join_phase phase2">
							멤버 조인을 위해서는
							총 약관동의 &gt; 기본정보 입력 &gt; 가입 인증 &gt; 가입 완료 단계를 거치며
							기본정보 입력 단계를 진행 중 입니다.
						</div>
						<div class="subcription1">
							<span class="required_text">*</span> 으로 표시된 부분은 필수 입력 사항 입니다.
						</div>
						<div class="formstyle">
							<table role="presentation" summary="기본정보 입력 양식">
								<colgroup>
									<col style="width:13%">
									<col>
								</colgroup>
								<tr class="section">
									<th scope="col"><span class="required">*</span><label for="input_id">아이디</label></th>
									<td>
										<input type="text" name="user_id" value="<?php echo set_value('user_id')?>" id="input_id" class="text1 l" placeholder="아이디 입력" />
										<span class="validator">
											<?php
												$field = null;
												$field = 'user_id';
												$fieldpost = $this->input->post($field);
												if (empty($fieldpost)!==FALSE) {
													echo '영문자, 숫자, _ 만 입력 가능. 최소 5자이상 입력하세요.';
												} else {
													$form_error = form_error($field);
													echo $form_error;
													if (empty($form_error)) {
														echo '정확히 입력 하셨습니다.';
													}
												}
											?>
										</span>
									</td>
								</tr>
								<tr class="section">
									<th scope="col"><span class="required">*</span><label for="input_pw">패스워드</label></th>
									<td>
										<input type="password" name="user_pw" value="<?php echo set_value('user_pw')?>" id="input_pw" class="text1 l" placeholder="패스워드 입력" />
										<span class="validator">
											<?php
												$field = null;
												$field = 'user_pw';
												$fieldpost = $this->input->post($field);
												if (empty($fieldpost)!==FALSE) {
													echo '영문자, 숫자, _ 만 입력 가능. 최소 5자이상 입력하세요.';
												} else {
													$form_error = form_error($field);
													echo $form_error;
													if (empty($form_error)) {
														echo '정확히 입력 하셨습니다.';
													}
												}
											?>
										</span>
									</td>
								</tr>
								<tr class="section">
									<th scope="col"><span class="required">*</span><label for="input_pw_confirm">패스워드 확인</label></th>
									<td>
										<input type="password" name="user_pw_verify" value="<?php echo set_value('user_pw_verify')?>"  id="input_pw_confirm" class="text1 l" placeholder="패스워드 확인" />
										<span class="validator">
											<?php
												$field = null;
												$field = 'user_pw_verify';
												$fieldpost = $this->input->post($field);
												if (empty($fieldpost)!==FALSE) {
													echo '다시한번 입력하세요.';
												} else {
													$form_error = form_error($field);
													echo $form_error;
													if (empty($form_error)) {
														echo '정확히 입력 하셨습니다.';
													}
												}
											?>
										</span>
									</td>
								</tr>
								<tr class="section">
									<th scope="col"><span class="required">*</span><label for="input_nick">별명</label></th>
									<td>
										<input type="text" name="nick" value="<?php echo set_value('nick')?>" id="input_nick" class="text1 l" placeholder="별명" />
										<span class="validator">
											<?php
												$field = null;
												$field = 'nick';
												$fieldpost = $this->input->post($field);
												if (empty($fieldpost)!==FALSE) {
													echo '사용하실 닉네임을 입력하세요.';
												} else {
													$form_error = form_error($field);
													echo $form_error;
													if (empty($form_error)) {
														echo '정확히 입력 하셨습니다.';
													}
												}
											?>
										</span>
									</td>
								</tr>
								<tr class="section">
									<th scope="col"><span class="required">*</span><label for="input_email">이메일</label></th>
									<td>
										<input type="text" name="email" value="<?php echo set_value('email')?>" id="input_email" class="text1 l" placeholder="예) example@example.com" />
										<span class="validator">
											<?php
												$field = null;
												$field = 'email';
												$fieldpost = $this->input->post($field);
												if (empty($fieldpost)!==FALSE) {
													echo '아이디 찾기에 사용되므로 실제 사용중인 이메일을 입력 하세요.';
												} else {
													$form_error = form_error($field);
													echo $form_error;
													if (empty($form_error)) {
														echo '정확히 입력 하셨습니다.';
													}
												}
											?>
										</span>
									</td>
								</tr>
								<?php if(ENVIRONMENT == 'development'):?>
									<tr class="section">
										<th scope="col">회원타입</th>
										<td class="sep with_chekbox_radio">
											<div class="radiogroup radio2">
												<input type="radio" id="radio1" name="type" <?php echo set_radio('type','users',TRUE); ?> value="users" class="radio2x" />
												<label for="radio1">사용자</label>
											</div>
											<div class="radiogroup radio2">
												<input type="radio" id="radio2" name="type" <?php echo set_radio('type','admin'); ?> value="admin" class="radio2x" />
												<label for="radio2">관리자</label>
											</div>
										</td>
									</tr>
								<?php endif;?>
								<tr class="section">
									<th scope="col">자기소개</th>
									<td>
										<textarea class="textarea1" name="introduce"><?php echo set_value('introduce')?></textarea>
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