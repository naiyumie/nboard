<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('admin_inc_layout_admin_head');?>
<?php $this->load->view('admin_inc_layout_admin_header');?>
<?php $this->load->view('admin_inc_layout_admin_script');?>


<div class="container-fluid-full">
	<div class="row-fluid">
		<?php $this->load->view('admin_inc_layout_admin_aside'); ?>
		<div id="content" class="span10">
			<div class="breadcrumb_container">
				<ul class="breadcrumb">
					<li>
						<a href="/admin/"><i class="icon-home"></i></a>
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<span>게시판 관리</span>
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<span>목록</span>
					</li>
				</ul>
				<a href="#<?php echo $manual_context?>" class="breadcrumb_help" title="도움말보기"><i class="icon-question-sign"></i></a>
			</div>
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header">
						<h2>게시판 관리</h2>
					</div>
					<div class="box-content">
						<?php echo form_open(''.$context.'/{mode}/'.$this->uri->segment(3,0), array('class'=>'form','id'=>'form', 'onsubmit'=>'return false;')); ?>
							<div class="span4 box-controls-container">
								<a class="btn btn-s btn-trash submit" href="#">
									<i class="halflings-icon white trash"></i>삭제
								</a>
							</div>
							<table class="table table-bordered table-striped table-condensed">
								<colgroup>
									<col>
									<col>
									<col>
									<col>
									<col>
								</colgroup>
								<thead>
									<tr>
										<th rowspan="2"></th>
										<th rowspan="2">카테고리 PK</th>
										<th rowspan="2">카테고리 이름</th>
										<th rowspan="2">모양새</th>
										<th colspan="2">주소 및 바로가기</th>
									</tr>
									<tr>
										<th class="tac">사용자</th>
										<th>관리자</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!$lists):?>
										<?php $colspan="8"; ?>
										<tr class="section">
											<td colspan="<?php echo $colspan?>">조회 가능한 내용이 없습니다.</th>
										</tr>
									<?php else:?>
										<?php foreach($lists as $k=>$v):?>
											<tr>
												<td><input type="checkbox" name="chk[]" class="chk" value="<?php echo $v['category']?>" /></td>
												<td><a href="/admin_board_manage/retrieve_and_update/<?php echo $v['category']?>/"><?php echo $v['category']?></a></td>
												<td><?php echo $v['names']?></td>
												<td class="tac"><?php echo $v['appearance']?></td>
												<td>
													<a href="/board/lists/<?php echo $v['category']?>/0/" class="ib">/board/lists/<?php echo $v['category']?>/0/</a>
													<a href="/board/lists/<?php echo $v['category']?>/0/" target="_blank" class="ib"><i class="icon-external-link"></i></a>
												</td>
												<td>
													<a href="/admin_board/lists/<?php echo $v['category']?>/0/" class="ib">/admin_board/lists/<?php echo $v['category']?>/0/</a>
													<a href="/admin_board/lists/<?php echo $v['category']?>/0/" target="_blank" class="ib"><i class="icon-external-link"></i></a>
												</td>
											</tr>
										<?php endforeach;?>
									<?php endif;?>
								</tbody>
							</table>
						<?php echo form_close();?>
					</div>
					<div class="row-fluid box-footer">
						<div class="span6 box-footer-inner">
							<a href="/<?php echo $context?>/board_create/" class="btn btn-primary">게시판 추가</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php $this->load->view('admin_inc_layout_admin_footer');?>
<script type="text/javascript">
	// 네비게이션 활성화
	$("[data-sidebar_id=<?php echo $context?>]").addClass('active');
</script>
<?php $this->load->view('admin_inc_layout_admin_foot');?>