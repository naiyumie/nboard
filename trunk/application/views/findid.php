<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => '아이디 찾기 - 나이유미 게시판',
		'front_scope' => 'findid',
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
					<?php echo form_open('member/findid', array('class'=>'form','id'=>'form')); ?>
						<h3>아이디 찾기</h3>
						<div class="subcription1">
							가입 당시 이메일을 입력하여 아이디를 조회할 수 있습니다.
						</div>
						<div class="formstyle">
							<table role="presentation" summary="입력 양식">
								<colgroup>
									<col style="width:13%">
									<col>
								</colgroup>
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
								<tr class="section">
									<th scope="col">아이디</th>
									<td class="sep read">
										<?php echo $finded_id?>&nbsp;
									</td>
								</tr>
								<?php if ($email_sended):?>
									<tr class="section">
										<td class="descript" colspan="2"><p class="descript_p">입력하신 메일로 요청하신 아이디 전문을 발송 하였습니다.<br>메일 수신 측 포털사의 정책에 의해 스팸으로 필터링 될 수 있습니다.</p></td>
									</tr>
								<?php endif;?>
							</table>

							<div class="button_container2">
								<input type="submit" class="btn btn4" value="아이디 찾기" />
							</div>
						</div>
					<?php echo form_close();?>
				</div>
			</section>
		</div>




<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>