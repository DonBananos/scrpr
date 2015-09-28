<nav class="navbar-default navbar-side" role="navigation" id="side-menu">
	<div class="sidebar-collapse">
		<div id="main-menu">
			<ul class="nav top-menu">
				<li>
					<a href="<?php echo $config->get_base_url() ?>" id="brand">ScrpR</a>
				</li>
				<li>
					<a class="active-menu menu-item"  href="<?php echo $config->get_base_url() ?>dashboard" view_id = "1">
						<span class="fa fa-dashboard fa-3x menu-icon"></span> 
						Dashboard
					</a>
				</li>
				<li>
					<a href="#" id="target-li">
						<span class="fa fa-link fa-3x menu-icon"></span> 
						Targets
						<span class="fa arrow"></span>
					</a>
					<ul class="nav nav-second-level" style="display: none" id="target-menu">
						<li>
							<a href="<?php echo $config->get_base_url() ?>target/" class="menu-item" view_id = "2">
								<span class="fa fa-plus"></span> 
								New Target
							</a>
						</li>
						<?php
						$nav_uc = new User_controller();
						$target_details = $nav_uc->get_all_target_details_from_user($active_user_id);
						foreach ($target_details as $target_id => $details)
						{
							?>
							<li>
								<a href="<?php echo $config->get_base_url() ?>target/<?php echo $target_id ?>/" class="menu-item"><span class="fa fa-link"></span> <?php echo $details['title'] ?></a>
							</li>
							<?php
						}
						?>
					</ul>
				</li>  
				<li>
					<a href="#" class="menu-item">
						<span class="fa fa-lightbulb-o fa-3x menu-icon"></span> 
						Results
					</a>
				</li>
			</ul>
			<ul class="bottom-menu nav">
				<li id="bottom-menu-dual-area">
					<a href="#" class="menu-item bottom-menu-half-item text-center" id="logout">
						<span class="fa fa-lock fa-2x bottom-menu-half-item-icon"></span><br>
						Logout
					</a>
					<a href="#" class="menu-item bottom-menu-half-item text-center" id="profile">
						<span class="fa fa-user fa-2x"></span><br>
						<?php echo $active_user_name ?>
					</a>
				</li>
				<li>
					<a href="#" class="menu-item">
						<span class="fa fa-cog fa-3x menu-icon"></span> 
						Settings
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>