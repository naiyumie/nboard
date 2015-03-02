<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="sidebar-left" class="span2">
	<div class="nav-collapse sidebar-nav">
		<ul class="nav nav-tabs nav-stacked main-menu">
			<li data-sidebar_id="admin">
				<a href="/admin/"><i class="icon-bar-chart"></i><span class="hidden-tablet"> 관리자 대시보드</span></a>
			</li>
			<li data-sidebar_id="admin_member">
				<a href="/admin_member/lists/0/"><i class="icon-user"></i><span class="hidden-tablet"> 멤버 관리</span></a>
			</li>
			<li data-sidebar_id="admin_session_manager">
				<a href="/admin_session_manager/lists/0/"><i class="fa fa-sign-in"></i><span class="hidden-tablet"> 세션 관리</span></a>
			</li>
			<li data-sidebar_id="admin_board_manage">
				<a href="/admin_board_manage/lists/"><i class="icon-align-justify"></i><span class="hidden-tablet"> 게시판 관리</span></a>
			</li>
			<li data-sidebar_id="admin_board_article_manage">
				<a href="/admin_board_article_manage/lists/freeboard/0/"><i class="icon-edit"></i><span class="hidden-tablet"> 게시물 관리</span></a>
			</li>
			<li data-sidebar_id="admin_crud">
				<a href="/admin_crud/lists/0/"><i class="icon-cogs"></i><span class="hidden-tablet"> CRUD 샘플</span></a>
			</li>
			<li data-sidebar_id="admin_phpmyadmin">
				<a href="/admin/phpmyadmin/0/"><i class="icon-umbrella"></i><span class="hidden-tablet"> phpMyAdmin</span></a>
			</li>
		</ul>
	</div>
</div>