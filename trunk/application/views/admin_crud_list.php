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
						<span>CRUD 샘플</span>
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
						<h2>CRUD 목록</h2>
					</div>
					<div class="box-content">
						총 <strong class="cnt"><?php echo $counts ?></strong>건
					</div>
					<div class="box-content">
						<?php echo form_open(''.$context.'/{mode}/'.$this->uri->segment(3,0), array('class'=>'form','id'=>'form', 'onsubmit'=>'return false;')); ?>
							<div class="span4 box-controls-container">
								<a class="btn btn-s btn-trash submit" href="#">
									<i class="halflings-icon white trash"></i>삭제
								</a>
							</div>
							<div class="span8 box-controls-container text-right">
								<label class="inline-inp">검색 :</label>
								<select name="search_key" class="inline-inp input-medium">
									<option value="uid" data-search_type="textlike" <?php if ($this->input->get('search_key') == 'uid'):?>selected="selected"<?php endif;?>>번호</option>
									<option value="textfield" data-search_type="textlike" <?php if ($this->input->get('search_key') == 'textfield'):?>selected="selected"<?php endif;?>>텍스트필드</option>
									<option value="textarea" data-search_type="textlike" <?php if ($this->input->get('search_key') == 'textarea'):?>selected="selected"<?php endif;?>>텍스트에어리어</option>
									<option value="checkbox" data-search_type="choose_1" <?php if ($this->input->get('search_key') == 'checkbox'):?>selected="selected"<?php endif;?>>체크박스</option>
									<option value="radio" data-search_type="choose_2" <?php if ($this->input->get('search_key') == 'radio'):?>selected="selected"<?php endif;?>>레디오</option>
									<option value="select" data-search_type="choose_3" <?php if ($this->input->get('search_key') == 'select'):?>selected="selected"<?php endif;?>>셀렉트</option>
									<option value="dates" data-search_type="datetimes" <?php if ($this->input->get('search_key') == 'dates'):?>selected="selected"<?php endif;?>>일자</option>
								</select>
								<span>
									<?php /* 텍스트 검색*/ ?>
									<input type="text" name="search_value" data-search_type="textlike"  class="search_value inline-inp input-medium" value="<?php echo $this->input->get('search_value')?>">

									<?php /* 선택 검색 */ ?>
									<select name="search_value" data-search_type="choose_1" class="search_value inline-inp input-medium">
										<?php foreach ($choose_1 as $k=>$v):?>
											<option value="<?php echo $v?>" <?php if ($this->input->get('search_value') == $v):?>selected="selected"<?php endif;?>><?php echo $v?></option>
										<?php endforeach;?>
									</select>

									<?php /* 선택 검색 */ ?>
									<select name="search_value" data-search_type="choose_2" class="search_value inline-inp input-medium">
										<?php foreach ($choose_2 as $k=>$v):?>
											<option value="<?php echo $v?>" <?php if ($this->input->get('search_value') == $v):?>selected="selected"<?php endif;?>><?php echo $v?></option>
										<?php endforeach;?>
									</select>

									<?php /* 선택 검색 */ ?>
									<select name="search_value" data-search_type="choose_3" class="search_value inline-inp input-medium">
										<?php foreach ($choose_3 as $k=>$v):?>
											<option value="<?php echo $v?>" <?php if ($this->input->get('search_value') == $v):?>selected="selected"<?php endif;?>><?php echo $v?></option>
										<?php endforeach;?>
									</select>

									<?php /* 일자 검색 */ ?>
									<input type="text" name="search_value_start" data-search_type="datetimes" class="search_value search_value_start input-small nDatePicker inline-inp " value="<?php echo $this->input->get('search_value_start')?>">
									<span class="search_value_sep">~</span>
									<input type="text" name="search_value_end" data-search_type="datetimes" class="search_value search_value_end input-small nDatePicker inline-inp " value="<?php echo $this->input->get('search_value_end')?>">
								</span>

								<a class="btn btn-s btn-search search_submit" href="#">
									<i class="halflings-icon white search"></i>검색
								</a>
							</div>
							<table class="table table-bordered table-striped table-condensed">
								<colgroup>
									<col style="width:10%;">
									<col>
									<col style="width:90px">
									<col style="width:90px">
									<col style="width:90px">
									<col style="width:100px">
									<col style="width:51px">
								</colgroup>
								<thead>
									<tr>
										<th><input type="checkbox" class="chkc" value="" /></th>
										<th>텍스트필드</th>
										<th>체크박스</th>
										<th>레디오</th>
										<th>셀렉트</th>
										<th class="hidden-phone">일</th>
										<th class="hidden-phone">시</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!$lists):?>
										<?php $colspan="7"; ?>
										<tr class="section">
											<td colspan="<?php echo $colspan?>">조회 가능한 내용이 없습니다.</th>
										</tr>
									<?php else:?>
										<?php foreach ($lists as $k=>$v):?>
											<tr>
												<td><input type="checkbox" name="chk[]" class="chk" value="<?php echo $v['uid']?>" /><?php echo $v['uid']?></td>
												<td><a href="/<?php echo $context?>/retrieve_and_update/<?php echo $this->uri->segment(3, 0)?>/<?php echo $v['uid']?>/?<?php echo $query_string?>"><?php echo $v['textfield']?></a></td>
												<td class="tac"><?php echo $v['checkbox']?></td>
												<td class="tac"><?php echo $v['radio']?></td>
												<td class="tac"><?php echo $v['select']?></td>
												<td class="hidden-phone tac"><?php echo $v['dates']?></td>
												<td class="hidden-phone tac"><?php echo $v['times']?></td>
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
					<div class="row-fluid box-footer">
						<div class="span6 box-footer-inner">
							<a href="/<?php echo $context?>/create/<?php echo $this->uri->segment(3, 0)?>/" class="btn btn-primary">작성</a>
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