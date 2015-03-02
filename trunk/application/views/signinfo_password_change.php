<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => '멤버 정보 조회 및 변경 - 나이유미 게시판',
		'front_scope' => 'password_change',
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

					<?php echo form_open('member/password_change', array('class'=>'form','id'=>'form')); ?>
						<h3>멤버 정보 조회 및 변경</h3>
						<div class="subcription1">
							패스워드 변경시 입력 하여주십시오.
						</div>
						<div class="formstyle">
							<table role="presentation" summary="패스워드 변경 입력 양식">
								<colgroup>
									<col style="width:13%">
									<col>
								</colgroup>
								<tr class="section">
									<th scope="col"><span class="required">*</span><label for="input_cur_pw">기존 패스워드</label></th>
									<td>
										<input type="password" name="user_current_pw" value="<?php echo set_value('user_current_pw')?>" id="input_cur_pw" class="text1 l" placeholder="패스워드 입력" />
										<span class="validator">
											<?php
												$field = null;
												$field = 'user_current_pw';
												$fieldpost = $this->input->post($field);
												if (empty($fieldpost)!==FALSE) {
													echo '패스워드 변경을 위해서는 기존 패스워드를 확인 하여야 합니다.';
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
								<tr>
									<th scope="col"><label for="input_pw">패스워드</label></th>
									<td>
										<input type="password" name="user_new_pw" value="<?php echo set_value('user_new_pw')?>" id="input_pw" class="text1 l" placeholder="패스워드 입력" />
										<span class="validator">
											<?php
												$field = null;
												$field = 'user_new_pw';
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
									<th scope="col"><label for="input_pw_confirm">패스워드 확인</label></th>
									<td>
										<input type="password" name="user_new_pw_verify" value="<?php echo set_value('user_new_pw_verify')?>" id="input_pw_confirm" class="text1 l" placeholder="패스워드 확인" />
										<span class="validator">
											<?php
												$field = null;
												$field = 'user_new_pw_verify';
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
								<?php if ($is_updating):?>
									<tr class="section">
										<td class="descript" colspan="2"><p class="descript_p">업데이트 되었습니다.<br> 내 정보를 수정 하였을 경우 다시 사인인 하여야 합니다.</p></td>
									</tr>
								<?php endif;?>
							</table>
							<div class="button_container2">

								<?php if ($is_updating):?>
									<a href="/member/sign_in/go" class="btn btn4">사인 인</a>
								<?php else:?>
									<input type="submit" class="btn btn4" value="수정완료">
								<?php endif;?>
							</div>
						</div>
						</div>
					<?php echo form_close();?>
				</div>
			</section>
		</div>




<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>