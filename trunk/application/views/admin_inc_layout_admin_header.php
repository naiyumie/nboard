<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<div class="curtain" style="display:none;"></div>
		<iframe src="/manual/read/#" frameborder="0" class="manual_iframe" style="display:none;"></iframe>

		<div class="navbar">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="/admin/"><span>NAIYUMIE BOARD ADMIN</span></a>
					<div class="nav-no-collapse header-nav">
						<ul class="nav pull-right">
							<li>
								<a class="btn" href="/">
									<i class="halflings-icon globe white"></i>사이트 바로가기
								</a>
								<a class="btn" href="/" title="사이트 바로가기 새창" target="_blank">
									<i class="icon-external-link"></i>
								</a>
							</li>
							<li class="dropdown">
								<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="halflings-icon white user"></i> <?php echo $signed_data['nick']?> 님
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li class="dropdown-menu-title">
										<span><?php echo $signed_data['user_id']?></span>
									</li>
									<li>
										<ul class="admin_info">
											<li>
												<span class="title">이메일 :</span> <?php echo $signed_data['email']?>
											</li>
											<li>
												<span class="title">레벨 :</span> <?php echo $signed_data['level']?>
											</li>
											<li>
												<span class="title">가입일시 :</span> <?php echo $signed_data['dates']?> <?php echo $signed_data['times']?>
											</li>
											<li>
												<span class="title">최종사인인 :</span> <?php echo $signed_data['signed_dates']?> <?php echo $signed_data['signed_times']?>
											</li>
										</ul>
									</li>
									<li><a href="/member/sign_out/"><i class="halflings-icon off"></i> 사인아웃</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
