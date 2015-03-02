<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => '멤버 탈퇴 - 나이유미 게시판',
		'front_scope' => 'member_leave',
		'lnb' => 'membership'
	);
	$this->load->view('inc_layout_sub_head', $view_argument);
?>
<?php $this->load->view('inc_layout_sub_header');?>
<?php
	#print_r($this->view_data);
?>
		<div class="wrapper">
			<section class="sub">
				<aside class="sidebar">
					<?php $this->load->view('inc_layout_sub_aside', $view_argument); ?>
				</aside>
				<div class="content_wrap" id="sc">
					<?php echo form_open('member/leave_proc', array('class'=>'form','id'=>'form')); ?>
						<h3>멤버 탈퇴</h3>
						<div class="subcription1">
							개인정보 보호를 위해 <strong>패스워드</strong>를 <strong>확인</strong> 합니다.
							한번 탈퇴한 아이디, 이메일로는 재 가입이 불가능 하며, 닉네임도 사용 할 수 없게됩니다.
						</div>
						<div class="formstyle">
							<table role="presentation" summary="입력 양식">
								<colgroup>
									<col style="width:13%">
									<col>
								</colgroup>
								<tr class="section">
									<th scope="col">아이디</th>
									<td class="sep read">
										<?php echo $signed_id?>
									</td>
								</tr>
								<tr class="section">
									<th scope="col">닉네임</th>
									<td class="sep read">
										<?php echo $signed_data['nick']?>
									</td>
								</tr>
								<tr class="section">
									<th scope="col">탈퇴사유</th>
									<td>
										<textarea class="textarea1" name="leaved_message"></textarea>
									</td>
								</tr>
								<tr class="section">
									<th scope="col"><span class="required">*</span><label for="input_pw">패스워드</label></th>
									<td>
										<input type="password" id="input_pw" name="user_pw" class="text1 l" placeholder="패스워드 입력" />
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
							</table>

							<div class="button_container2">
								<input type="submit" class="btn btn4" value="멤버 탈퇴">
							</div>
						</div>
					<?php echo form_close();?>
				</div>
			</section>
		</div>




<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>