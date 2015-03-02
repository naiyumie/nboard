<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => '멤버 정보 조회 및 변경 - 나이유미 게시판',
		'front_scope' => 'signinfo_retrieve_and_update',
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

					<?php echo form_open('member/retrieve_and_update', array('class'=>'form','id'=>'form')); ?>
						<h3>멤버 정보 조회 및 변경</h3>
						<div class="subcription1">
							<span class="required_text">*</span> 으로 표시된 부분은 필수 입력 사항 입니다.
						</div>
						<div class="formstyle">
							<table role="presentation" summary="멤버 정보 조회 및 변경 입력 양식">
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
									<th scope="col"><label for="input_nick">별명</label></th>
									<td>
										<input type="text" name="nick" value="<?php echo $retrieve['nick']?>" id="input_nick" class="text1 l" placeholder="별명" />
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
													if (empty($form_error) && $nick_change_able) {
														echo '이미 사용중인 닉네임 입니다.';
													} else if (empty($form_error)) {
														echo '정확히 입력하셨습니다.';
													}

												}
											?>
										</span>
									</td>
								</tr>
								<tr class="section">
									<th scope="col"><label for="input_email">이메일</label></th>
									<td>
										<input type="text" name="email" value="<?php echo $retrieve['email']?>" id="input_email" class="text1 l" placeholder="예) example.example.com" />
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
													if (empty($form_error) && $email_change_able) {
														echo '이미 사용중인 이메일 입니다.';
													} else if (empty($form_error)) {
														echo '정확히 입력하셨습니다.';
													}
												}
											?>
										</span>
									</td>
								</tr>
								<tr class="section">
									<th scope="col">회원타입</th>
									<td class="sep with_chekbox_radio">
										<div class="radiogroup radio2">
											<input type="radio" name="type" <?php echo set_radio('type','users', ($this->view_data['signed_data']['type']=='users')?TRUE:FALSE); ?> id="radio1" name="member_type" value="users" class="radio2x" />
											<label for="radio1">사용자</label>
										</div>
										<div class="radiogroup radio2">
											<input type="radio" name="type" <?php echo set_radio('type','admin', ($this->view_data['signed_data']['type']=='admin')?TRUE:FALSE); ?> id="radio2" name="member_type" value="admin" class="radio2x" />
											<label for="radio2">관리자</label>
										</div>
									</td>
								</tr>
								<tr class="section">
									<th scope="col">자기소개</th>
									<td>
										<textarea class="textarea1" name="introduce"><?php echo $retrieve['introduce']?></textarea>
									</td>
								</tr>
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
													echo '정보를 수정 할경우 패스워드를 확인 하여야 합니다.';
												} else {
													$form_error = form_error($field);
													echo $form_error;
													if (empty($form_error) && !$check_id_pw) {
														echo '패스워드가 올바르지 않습니다.';
													} else if (empty($form_error)) {
														echo '정확히 입력하셨습니다.';
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
					<?php echo form_close();?>

				</div>
			</section>
		</div>




<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>