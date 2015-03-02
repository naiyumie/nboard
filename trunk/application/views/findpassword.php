<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => '패스워드 찾기 - 나이유미 게시판',
		'front_scope' => 'findpassword',
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
					<?php echo form_open('member/findpassword', array('class'=>'form','id'=>'form')); ?>
						<h3>패스워드 찾기</h3>
						<div class="subcription1">
							가입 당시 아이디와 이메일을 입력하시면 임시 패스워드를 메일에서 확인 할 수 있습니다.
						</div>
						<div class="formstyle">
							<table role="presentation" summary="입력 양식">
								<colgroup>
									<col style="width:13%">
									<col>
								</colgroup>
								<tr class="section">
									<th scope="col"><span class="required">*</span><label for="input_id">아이디</label></th>
									<td>
										<input type="text" name="user_id" value="<?php echo set_value('user_id')?>" class="text1 l" id="input_id" placeholder="아이디를 입력 하세요" />
										<span class="validator">
											<?php
												$field = null;
												$field = 'user_id';
												$fieldpost = $this->input->post($field);
												if (empty($fieldpost)!==FALSE) {
													echo '가입 당시 아이디를 입력 하세요.';
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
									<th scope="col"><span class="required">*</span><label for="email">이메일</label></th>
									<td>
										<input type="text" name="email" value="<?php echo set_value('email')?>" id="email" class="text1 l" placeholder="예) your_email@example.com" />
										<span class="validator">
											<?php
												$field = null;
												$field = 'email';
												$fieldpost = $this->input->post($field);
												if (empty($fieldpost)!==FALSE) {
													echo '가입 당시 이메일을 입력 하세요.';
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
								<?php if ($description):?>
									<?php if ($you_our_member):?>
										<tr class="section">
											<td class="descript" colspan="2"><p class="descript_p">귀하는 이 웹사이트에 멤버입니다만, 패스워드는 암호화되어 저장되어 있으므로 알 수 없습니다.</p></td>
										</tr>
									<?php else:?>
										<tr class="section">
											<td class="descript" colspan="2"><p class="descript_p">웹사이트에 가입되어 있지 않습니다.</p></td>
										</tr>
									<?php endif;?>
									<?php if ($email_sended):?>
										<tr class="section">
											<td class="descript" colspan="2"><p class="descript_p">입력하신 메일로 요청하신 임시 패스워드를 발송 하였습니다.<br>메일 수신 측 포털사의 정책에 의해 스팸으로 필터링 될 수 있습니다.</p></td>
										</tr>
									<?php endif;?>
								<?php endif;?>
							</table>

							<div class="button_container2">
								<input type="submit" class="btn btn4" value="패스워드 찾기" />
							</div>
						</div>
					<?php echo form_close();?>
				</div>
			</section>
		</div>




<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>