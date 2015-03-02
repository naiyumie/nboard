<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
	$view_argument = array(
		'head_title' => '메인 - 나이유미 게시판',
		'front_scope' => 'main'
	);
	$this->load->view('inc_layout_main_head', $view_argument);
?>
<?php $this->load->view('inc_layout_main_header');?>

		<div class="wrapper">
			<section class="main" id="sc">
				<article class="keyvisual">
					<div class="visual-navi">
						<ul class="anchor anchor-prev">
							<li class="btn-prev">
								<a href="#prev" class="prev" title="이전">이전</a>
							</li>
						</ul>
						<ul class="navi"></ul>
						<ul class="anchor anchor-next">
							<li class="btn-next">
								<a href="#next" class="next" title="다음">다음</a>
							</li>
						</ul>
					</div>
					<div class="visual-wrap">
						<ul class="slides">
							<li class="keyvisual_images">
								<img src="/images/key_visual_slogan0.png" class="slogan slogan0" alt="Powered by CodeIgniter FrameWork MVC pattern in PHP Development THAT BETTER CHOOSEN" />
								<p class="descript descript0">유연하고 확장하기좋은 구조 설계.</p>
								<a href="/statics/page/introduce_0" class="btn btn0">자세히 알아보기</a>
								<span class="visual-snap"><img src="/images/keyvisual0_bg.jpg" alt="MVC" /></span>
							</li>
							<li class="keyvisual_images">
								<img src="/images/key_visual_slogan1.png" class="slogan slogan1" alt="Web Standards and Web Accessibility Board Solution that people love." />
								<p class="descript descript1">누구나 자유로운 웹 세상.</p>
								<a href="/statics/page/introduce_3" class="btn btn1">자세히 알아보기</a>
								<span class="visual-snap"><img src="/images/keyvisual1_bg.jpg" alt="Improve the Web for Everyone" /></span>
							</li>
							<li class="keyvisual_images">
								<img src="/images/key_visual_slogan2.png" class="slogan slogan2" alt="There are rules. However, There is no redemption. Best Friend of web professionals" />
								<p class="descript descript2">심플함과 올바른 방법론을 가진 웹전문가들의 단짝 친구.</p>
								<a href="/statics/page/introduce_1" class="btn btn2">자세히 알아보기</a>
								<span class="visual-snap"><img src="/images/keyvisual2_bg.jpg" alt="NO REDEPMTION" /></span>
							</li>
						</ul>
					</div>
				</article>

				<article class="box box0 news">
					<h2>새소식</h2>


					<a href="#none" class="tab tab01 tab_a" data-group="tab_a" data-target="a01">전체</a>
					<div class="article_contents atype a01">
						<ul>
							<?php if (!$top_notice_update_recommend):?>
								<li><span class="nodata">조회 가능한 게시물이 없습니다.</span></li>
							<?php else:?>
								<?php foreach($top_notice_update_recommend as $k=>$v):?>
									<li><a href="/board/retrieve/<?php echo $v['category'] ?>/0/<?php echo $v['uid']?>"><?php echo $v['title'] ?></a><span class="datetimes"><?php echo get_dates_or_times_from_today($v['dates'], $v['times']);?></span></li>
								<?php endforeach;?>
							<?php endif;?>
						</ul>
					</div>
					<a href="/board/lists/noticeboard/0/" class="article_more atype a01">더보기</a>



					<a href="#none" class="tab tab02 tab_a" data-group="tab_a" data-target="a02">공지사항</a>
					<div class="article_contents atype a02">
						<ul>
							<?php if (!$top_notice_recommend):?>
								<li><span class="nodata">조회 가능한 게시물이 없습니다.</span></li>
							<?php else:?>
								<?php foreach($top_notice_recommend as $k=>$v):?>
									<li><a href="/board/retrieve/<?php echo $v['category'] ?>/0/<?php echo $v['uid']?>"><?php echo $v['title'] ?></a><span class="datetimes"><?php echo get_dates_or_times_from_today($v['dates'], $v['times']);?></span></li>
								<?php endforeach;?>
							<?php endif;?>

						</ul>
					</div>
					<a href="/board/lists/noticeboard/0/" class="article_more atype a02">더보기</a>



					<a href="#none" class="tab tab03 tab_a" data-group="tab_a" data-target="a03">업데이트</a>
					<div class="article_contents atype a03">
						<ul>
							<?php if (!$top_updatenews_recommend):?>
								<li><span class="nodata">조회 가능한 게시물이 없습니다.</span></li>
							<?php else:?>
								<?php foreach($top_updatenews_recommend as $k=>$v):?>
									<li><a href="/board/retrieve/<?php echo $v['category'] ?>/0/<?php echo $v['uid']?>"><?php echo $v['title'] ?></a><span class="datetimes"><?php echo get_dates_or_times_from_today($v['dates'], $v['times']);?></span></li>
								<?php endforeach;?>
							<?php endif;?>
						</ul>
					</div>
					<a href="/board/lists/updatenews/0/" class="article_more atype a03">더보기</a>
				</article>

				<article class="box box1 recent">
					<h2>최신글</h2>

					<a href="#none" class="tab tab01 tab_b" data-group="tab_b" data-target="b01">전체</a>
					<div class="article_contents btype b01">
						<ul>
							<?php if (!$top_freeboard_recent):?>
								<li><span class="nodata">조회 가능한 게시물이 없습니다.</span></li>
							<?php else:?>
								<?php foreach($top_freeboard_recent as $k=>$v):?>
									<li><a href="/board/retrieve/<?php echo $v['category'] ?>/0/<?php echo $v['uid']?>"><?php echo $v['title'] ?></a><span class="datetimes"><?php echo get_dates_or_times_from_today($v['dates'], $v['times']);?></span></li>
								<?php endforeach;?>
							<?php endif;?>
						</ul>
					</div>
					<a href="/board/lists/freeboard/0/" class="article_more btype b01">더보기</a>

					<a href="#none" class="tab tab02 tab_b" data-group="tab_b" data-target="b02">인기</a>
					<div class="article_contents btype b02">
						<ul>
							<?php if (!$top_freeboard_hit):?>
								<li><span class="nodata">조회 가능한 게시물이 없습니다.</span></li>
							<?php else:?>
								<?php foreach($top_freeboard_hit as $k=>$v):?>
									<li><a href="/board/retrieve/<?php echo $v['category'] ?>/0/<?php echo $v['uid']?>"><?php echo $v['title'] ?></a><span class="datetimes"><?php echo get_dates_or_times_from_today($v['dates'], $v['times']);?></span></li>
								<?php endforeach;?>
							<?php endif;?>
						</ul>
					</div>
					<a href="/board/lists/freeboard/0/" class="article_more btype b02">더보기</a>

					<a href="#none" class="tab tab03 tab_b" data-group="tab_b" data-target="b03">추천</a>
					<div class="article_contents btype b03">
						<ul>
							<?php if (!$top_freeboard_recommend):?>
								<li><span class="nodata">조회 가능한 게시물이 없습니다.</span></li>
							<?php else:?>
								<?php foreach($top_freeboard_recommend as $k=>$v):?>
									<li><a href="/board/retrieve/<?php echo $v['category'] ?>/0/<?php echo $v['uid']?>"><?php echo $v['title'] ?></a><span class="datetimes"><?php echo get_dates_or_times_from_today($v['dates'], $v['times']);?></span></li>
								<?php endforeach;?>
							<?php endif;?>
						</ul>
					</div>
					<a href="/board/lists/freeboard/0/" class="article_more btype b03">더보기</a>
				</article>
				<?php if ($signed):?>
					<article class="box box2 signed">
						<div class="in">
							<div class="basicauth">
								<span class="signed_id"><?php echo $signed_data['nick']?><span class="suffix">님</span></span>
								<span class="auth"><?php echo $signed_data['type_kr']?><span class="level">1LV</span></span>
							</div>
							<div class="biography">
								<span class="bio_since title">since<span class="dates"><?php echo $signed_data['dates']?></span></span>
								<span class="bio_signed title">signed<span class="dates"><?php echo $signed_data['signed_dates']?></span></span>
							</div>
							<hr class="sep sep1" />
							<ul class="article_active_history">
								<li><span class="title">사인인 횟수</span> <span class="num"><?php echo $signed_data['count_signed']?><span class="suffix"> 회</span></span></li>
								<li><span class="title">게시글 작성수</span> <span class="num"><?php echo $signed_data['count_write_article']?><span class="suffix"> 개</span></span></li>
								<li><span class="title">댓글 작성수</span> <span class="num"><?php echo $signed_data['count_write_comment']?><span class="suffix"> 개</span></span></li>
							</ul>
							<hr class="sep sep2" />
							<a href="/member/sign_out" class="btn btn3">사인아웃</a>
							<a href="/member/retrieve_and_update" class="change_myinfo">내정보수정</a>

							<?php if ($admin_signed):?>
								<a href="/admin/" class="go_admin">관리자 바로가기</a>
							<?php endif;?>
						</div>
					</article>
				<?php else:?>
					<article class="box box2 signin">
						<div class="in">
							<h2>사인 인</h2>
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
									<label for="inp_id" class="blind">아이디</label><input type="text" id="inp_id" class="inp_id" title="사인인 아이디" name="user_id" placeholder="아이디" />
									<label for="inp_pw" class="blind">패스워드</label><input type="password" id="inp_pw" class="inp_pw" title="사인인 패스워드" name="user_pw" placeholder="패스워드" />
									<div class="remember_id">
										<label for="chk_remember_id" class="blind">아이디기억</label><input type="checkbox" class="chk_remember_id" id="chk_remember_id" name="chk_remember_id"  title="아이디기억" />
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
							<div class="tester">
								<strong>게스트 : </strong>guest / 12345 ,
								<strong>관리자 : </strong>tester / 12345
							</div>
						</div>
					</article>
				<?php endif;?>


				<article class="box box3 gallery">
					<h2>갤러리</h2>
						<?php if (!$top_gallery_recent):?>
							<span class="nodata">조회 가능한 게시물이 없습니다.</span>
						<?php else:?>
							<ul class="article_contents">
								<?php foreach($top_gallery_recent as $k=>$v):?>
									<li>
										<a href="/board/retrieve/<?php echo $v['category'] ?>/0/<?php echo $v['uid']?>">
											<span class="imgcnt" style="background:#f8f8f8 url('<?php echo $v['thumbnail']?>') center center no-repeat;"></span>
											<span class="img_description"><?php echo $v['title'] ?></span>
											<span class="datetimes"><?php echo get_dates_or_times_from_today($v['dates'], $v['times']);?></span>
										</a>
									</li>
								<?php endforeach;?>
							</ul>
						<?php endif;?>
					<a href="/board/lists/gallery/0/" class="article_more">더보기</a>
				</article>

				<article class="box box4 popupzone">
					<div class="in uPopupZone">
						<h2 class="subj">
							알림판
						</h2>
						<div class="popup photocnt">
							<ul>
								<li class="photo fl"><a href="http://naiyumie.inour.net/about/" target="_blank"><img src="/images/popupzone_banner_1.jpg" alt="나이유미 프론트 엔드 디벨로퍼 소개" /></a></li>
								<li class="photo fl"><a href="http://naiyumie.inour.net/responsive_resume/html/" target="_blank"><img src="/images/popupzone_banner_2.jpg" alt="웹 이력서 바로가기" /></a></li>
								<li class="photo fl"><a href="http://codeigniter-kr.org/" target="_blank"><img src="/images/popupzone_banner_3.jpg" alt="코드이그나이터 한국 사용자 포럼" /></a></li>
								<li class="photo fl"><a href="http://www.codeigniter.com/" target="_blank"><img src="/images/popupzone_banner_4.jpg" alt="코디이그나이터 공식 사이트" /></a></li>
							</ul>
						</div>
					</div>

				</article>

			</section>
		</div>


<?php $this->load->view('inc_layout_main_footer');?>
<?php $this->load->view('inc_layout_main_foot');?>