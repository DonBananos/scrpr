<nav class="navbar-default navbar-side" role="navigation" id="side-menu">
	<div class="sidebar-collapse">
		<div id="main-menu">
			<ul class="nav">
				<li>
					<a href="<?php echo $config->get_base_url() ?>" id="brand">ScrpR</a>
				</li>
				<li>
					<a class="active-menu menu-item"  href="<?php echo $config->get_base_url() ?>dashboard"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
				</li>
				<li>
					<a href="#" id="target-li">
						<span class="fa fa-link fa-3x"></span> 
						Targets
						<span class="fa arrow"></span>
					</a>
					<ul class="nav nav-second-level" style="display: none" id="target-menu">
						<li>
							<a href="#" class="menu-item"><span class="fa fa-plus"></span> New Target</a>
						</li>
						<li>
							<a href="#" class="menu-item"><span class="fa fa-link"></span> My Target</a>
						</li>
						<li>
							<a href="#" class="menu-item"><span class="fa fa-link"></span> My Target</a>
						</li>
						<li>
							<a href="#" class="menu-item"><span class="fa fa-link"></span> My Target</a>
						</li>
					</ul>
				</li>  
				<li>
					<a href="#" class="menu-item">
						<span class="fa fa-lightbulb-o fa-3x"></span> 
						Results
					</a>
				</li>
			</ul>
			<ul class="botoom-menu nav">
				<li class="bottom-link">
					<a href="#" id="target-li" class="menu-item">
						<span class="fa fa-lightbulb-o fa-3x"></span> 
						Results
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>