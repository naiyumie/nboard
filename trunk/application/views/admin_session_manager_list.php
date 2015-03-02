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
						<span>세션 관리</span>
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<span>목록</span>
					</li>
				</ul>
				<a href="#<?php echo $context?>" class="breadcrumb_help" title="도움말보기"><i class="icon-question-sign"></i></a>
			</div>
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header">
						<h2>세션 관리</h2>
					</div>
					<div class="box-content">
						총 <strong class="cnt"><?php echo $counts ?></strong>건
					</div>
					<div class="box-content">
						<?php echo form_open(''.$context.'/{mode}/'.$this->uri->segment(3,0), array('class'=>'form','id'=>'form', 'onsubmit'=>'return false;')); ?>
							<div class="span4 box-controls-container">
								<a class="btn btn-s btn-trash submit" href="#">
									<i class="halflings-icon white trash"></i>세션 풀기
								</a>
							</div>
							<div class="span8 box-controls-container text-right">
								<label class="inline-inp">검색 :</label>
								<select name="search_key" class="inline-inp input-medium">
									<option value="session_id" data-search_type="textlike" <?php if ($this->input->get('search_key') == 'session_id'):?>selected="selected"<?php endif;?>>세션 아이디</option>
									<option value="ip_address" data-search_type="textlike" <?php if ($this->input->get('search_key') == 'ip_address'):?>selected="selected"<?php endif;?>>아이피</option>
									<option value="user_agent" data-search_type="textlike" <?php if ($this->input->get('search_key') == 'user_agent'):?>selected="selected"<?php endif;?>>접속 브라우저</option>
								</select>
								<span>
									<?php /* 텍스트 검색*/ ?>
									<input type="text" name="search_value" data-search_type="textlike"  class="search_value inline-inp input-medium" value="<?php echo $this->input->get('search_value')?>">
								</span>

								<a class="btn btn-s btn-search search_submit" href="#">
									<i class="halflings-icon white search"></i>검색
								</a>
							</div>
							<table class="table table-bordered table-striped table-condensed">
								<colgroup>
									<col style="width:10%;">
									<col>
									<col style="width:20%;">
									<col style="width:100px;">
									<col>
									<col style="width:170px;">
								</colgroup>
								<thead>
									<tr>
										<th><input type="checkbox" class="chkc" value="" /></th>
										<th>세션 아이디</th>
										<th>세션 멤버 정보</th>
										<th>아이피</th>
										<th>접속 브라우저</th>
										<th>마지막 행동</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!$lists):?>
										<?php $colspan="6"; ?>
										<tr class="section">
											<td colspan="<?php echo $colspan?>">조회 가능한 내용이 없습니다.</th>
										</tr>
									<?php else:?>
										<?php foreach($lists as $k=>$v):?>
											<tr>
												<td><input type="checkbox" name="chk[]" class="chk" value="<?php echo $v['session_id']?>" /></td>
												<td><a href="/<?php echo $context?>/retrieve_and_update/<?php echo $this->uri->segment(3, 0)?>/<?php echo $v['session_id']?>/?<?php echo $query_string?>"><?php echo $v['session_id']?></a></td>
												<td>
													<?php
														if (isset($v['user_data_array']['signed_id'])):?>
														<?php echo $v['user_data_array']['signed_data']['nick']?> (<?php echo $v['user_data_array']['signed_id']?>)
													<?php endif;?>
												</td>
												<td><?php echo $v['ip_address']?></td>
												<td><?php echo $v['user_agent']?></td>
												<td><?php echo $v['last_activity_string']?></td>
											</tr>
										<?php endforeach;?>
									<?php endif;?>
								</tbody>
							</table>
						<?php echo form_close();?>
						<div class="pagination pagination-centered">
							<?=$pagination?>
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