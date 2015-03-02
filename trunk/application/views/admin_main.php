<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('admin_inc_layout_admin_head');?>
<?php $this->load->view('admin_inc_layout_admin_script');?>


<?php $this->load->view('admin_inc_layout_admin_header');?>
<div class="container-fluid-full">
	<div class="row-fluid">
		<?php $this->load->view('admin_inc_layout_admin_aside'); ?>
		<div id="content" class="span10">
			<div class="row-fluid" style="margin-bottom:20px;">
				<a class="quick-button metro blue span2" href="/admin_member/lists/0/">
					<i class="fa fa-child"></i>
					<p>멤버</p>
					<span class="notification"><?php echo $member_count?></span>
				</a>
				<a class="quick-button metro green span2" href="/admin_board_article_manage/lists/freeboard/0/">
					<i class="fa fa-leanpub"></i>
					<p>게시물</p>
					<span class="notification"><?php echo $article_count?></span>
				</a>
				<a class="quick-button metro red span2" href="/admin_board_article_manage/lists/freeboard/0/">
					<i class="fa fa-reply fa-rotate-180"></i>
					<p>댓글</p>
					<span class="notification"><?php echo $board_comment_count?></span>
				</a>
				<a class="quick-button metro pink span2" href="/admin_board_article_manage/lists/freeboard/0/">
					<i class="fa fa-thumbs-up"></i>
					<p>추천</p>
					<span class="notification"><?php echo $board_recommend_count?></span>
				</a>
				<a class="quick-button metro orange2 span2" href="/admin_member/lists/0/">
					<i class="fa fa-user-plus"></i>
					<p>이달의 뉴비</p>
					<span class="notification"><?php echo $newbie_count?></span>
				</a>
				<a class="quick-button metro yellow span2">
					<i class="fa fa-sign-in"></i>
					<p>사인인 멤버</p>
					<span class="notification"><?php echo $session_count?></span>
				</a>
				<div class="clearfix"></div>
			</div>

			<div class="row-fluid">
				<div class="box span12">
					<div class="box-content">
						<h2>신규 멤버 TOP 5</h2>
						<table class="table table-bordered table-striped table-condensed">
							<colgroup>
								<col>
								<col>
								<col style="width:170px">
								<col style="width:170px">
								<col style="width:100px">
							</colgroup>
							<thead>
								<tr>
									<th>아이디</th>
									<th>닉네임</th>
									<th>가입일시</th>
									<th>사인인일시</th>
									<th>사인인 횟수</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!$recent_joined_member):?>
									<?php $colspan="5"; ?>
									<tr class="section">
										<td colspan="<?php echo $colspan?>">조회 가능한 내용이 없습니다.</th>
									</tr>
								<?php else:?>
									<?php foreach($recent_joined_member as $k=>$v):?>
										<tr>
											<td><a href="/admin_member/retrieve_and_update/0/<?php echo $v['uid']?>/"><?php echo $v['user_id']?></a></td>
											<td><?php echo $v['nick']?></td>
											<td><?php echo $v['dates']?> <?php echo $v['times']?></td>
											<td><?php echo $v['signed_dates']?> <?php echo $v['signed_times']?></td>
											<td class="hidden-phone tac"><?php echo $v['count_signed']?></td>
										</tr>
									<?php endforeach;?>
								<?php endif;?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-content">
						<h2>최신 게시물 TOP 10</h2>
						<table class="table table-bordered table-striped table-condensed">
							<colgroup>
								<col>
								<col style="width:180px">
								<col style="width:170px">
								<col style="width:60px">
								<col style="width:60px">
							</colgroup>
							<thead>
								<tr>
									<th>제목</th>
									<th>작성자</th>
									<th>작성일시</th>
									<th>조회수</th>
									<th>추천수</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!$top_article_recent):?>
									<?php $colspan="5"; ?>
									<tr class="section">
										<td colspan="<?php echo $colspan?>">조회 가능한 내용이 없습니다.</th>
									</tr>
								<?php else:?>
									<?php foreach($top_article_recent as $k=>$v):?>
										<tr>
											<td><a href="/admin_board_article_manage/retrieve_and_update/<?php echo $v['category']?>/<?php echo $v['uid']?>/"><?php echo $v['title']?></a></td>
											<td><a href="/admin_member/retrieve_and_update/0/<?php echo $v['writer']?>/"><?php echo $v['user_id']?>(<?php echo $v['nick']?>)</a></td>
											<td class="tac"><?php echo $v['dates']?> <?php echo $v['times']?></td>
											<td class="hidden-phone tac"><?php echo $v['hit']?></td>
											<td class="hidden-phone tac"><?php echo $v['recommend']?></td>
										</tr>
									<?php endforeach;?>
								<?php endif;?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-content">
						<h2>최신 댓글 TOP 10</h2>
						<table class="table table-bordered table-striped table-condensed">
							<colgroup>
								<col>
								<col style="width:180px">
								<col style="width:170px">
							</colgroup>
							<thead>
								<tr>
									<th>제목</th>
									<th>작성자</th>
									<th>작성일시</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!$top_comment_recent):?>
									<?php $colspan="5"; ?>
									<tr class="section">
										<td colspan="<?php echo $colspan?>">조회 가능한 내용이 없습니다.</th>
									</tr>
								<?php else:?>
									<?php foreach($top_comment_recent as $k=>$v):?>
										<tr>
											<td><a href="/admin_board_article_manage/retrieve_and_update/<?php echo $v['category']?>/<?php echo $v['board_uid']?>/"><?php echo $v['content']?></a></td>
											<td><a href="/admin_member/retrieve_and_update/0/<?php echo $v['writer']?>/"><?php echo $v['user_id']?>(<?php echo $v['nick']?>)</a></td>
											<td class="tac"><?php echo $v['dates']?> <?php echo $v['times']?></td>
										</tr>
									<?php endforeach;?>
								<?php endif;?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php $this->load->view('admin_inc_layout_admin_footer');?>
<script type="text/javascript">
	// 네비게이션 활성화
	$("[data-sidebar_id=admin]").addClass('active');
</script>
<?php $this->load->view('admin_inc_layout_admin_foot');?>