<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => '사인 인 - 나이유미 게시판',
		'front_scope' => 'singlesign'
	);
	$this->load->view('inc_layout_sub_head', $view_argument);
?>
<?php $this->load->view('inc_layout_sub_header');?>

		<div class="wrapper">
			<section class="sub">
				<div class="content_wrap2">
					<div class="inwrap">
						<div class="in_tbl">
							<div class="in_tr">
								<div class="in_td">
									<div class="in_container">
										<article class="box box2 signin">
											<div class="in">
												<?php if ($signed_false):?>
													<p class="signin_failed">
														아이디 또는 비밀번호를 다시 확인하세요. <br>
														등록되지 않은 아이디이거나, 아이디 또는 비밀번호를 잘못 입력하셨습니다.
													</p>
												<?php endif;?>
												<h3>사인 인</h3>
												<?php echo form_open('member/sign_in', array('class'=>'form','id'=>'form')); ?>
													<div class="sigin_auth_choose">
														<div class="nrdg">
															<input type="radio" id="signin_member" name="signin_type" value="users" class="nrdgx" <?php echo set_radio('signin_type','users',TRUE); ?> />
															<label for="signin_member">멤버</label>
														</div>
														<p class="info sign_type sigin_type1">멤버 권한으로 사인 인 합니다. </p>
														<div class="nrdg">
															<input type="radio" id="signin_admin" name="signin_type" value="admin" class="nrdgx" <?php echo set_radio('signin_type','admin'); ?>/>
															<label for="signin_admin">관리자</label>
														</div>
														<p class="info sign_type sigin_type2">관리자 권한으로 사인 인 합니다. </p>
													</div>
													<fieldset class="ffield">
														<legend class="blind">사인인</legend>
														<label for="inp_id" class="blind">아이디</label><input type="text" id="inp_id" class="inp_id" title="사인인 아이디" name="user_id" value="<?php echo set_value('user_id')?>" placeholder="아이디" />
														<label for="inp_pw" class="blind">패스워드</label><input type="password" id="inp_pw" class="inp_pw" title="사인인 패스워드" name="user_pw" placeholder="패스워드" value="<?php echo set_value('user_pw')?>" />
														<div class="remember_id">
															<label for="chk_remember_id" class="blind">아이디기억</label><input type="checkbox" class="chk_remember_id" id="chk_remember_id" name="chk_remember_id" title="아이디기억"  />
														</div>
														<input type="submit" class="inp_btn" value="SIGN IN" />
													</fieldset>
												<?php echo form_close();?>
												<div class="find_and_new">
													<a href="/member/findid">아이디</a>
													<span class="sep dot">ㆍ</span>
													<a href="/member/findpassword/go">패스워드 찾기</a>
													<span class="sep">|</span>
													<a href="/member/sign_up">멤버 조인</a>
												</div>
											</div>
										</article>
										<article class="box signin_ad">
											<img src="/images/singlesign_v1.png" alt="PLEASE SIGN IN" class="single_sign_visual ssv1" />
											<img src="/images/singlesign_v2.png" alt="PLEASE SIGN IN" class="single_sign_visual ssv2" style="display:none;" />
										</article>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>




<?php $this->load->view('inc_layout_sub_footer');?>
<?php $this->load->view('inc_layout_sub_foot');?>