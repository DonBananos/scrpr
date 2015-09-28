<!DOCTYPE html>
<?php
//This should be done on all pages
require_once __DIR__ . '/../../vendor/autoload.php';

$config = new Config();

$view_id = 2; //New Target View

if (isset($_SESSION['user_id']))
{
	$active_user_id = $_SESSION['user_id'];
	$uc = new User_controller();

	$active_user_name = $uc->get_user_name_from_id($active_user_id);
}
else
{
	?>
	<script>window.location = '<?php echo $config->get_base_url(); ?>';</script>
	<?php
}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Target | Scrpr</title>
		<?php require '../../config/head.php'; ?>
	</head>
	<body>
		<?php require './navbar/navbar.php'; ?>
		<div id="page-wrapper">
			<div class="page-header">
				<h1>New Target</h1>
				<p class="lead" id="subtitle">
					Create a new Target to spy on
					<span class="pull-right last-login-span">
						<i>Last login:</i> 28/09/2015
					</span>
				</p>
			</div>
			<div id="page-inner">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="content-box">
						<form>
							<div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
								<input type="text" name="title" value="Unnamed Target" class="form-control title-input invisible-input" onclick="this.select();">
							</div>
							<div class="col-lg-6 col-md-4 col-sm-2 hidden-xs">
								<label class="pull-right form-label">Created: 28/09-2015</label>
							</div>
							<div class="clearfix"></div>
							<div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
								<input type="text" name="subtitle" value="Unnamed Target's subtitle" class="form-control subtitle-input invisible-input" onclick="this.select();">
							</div>
							<div class="col-lg-6 col-md-4 col-sm-2 hidden-xs">
								<label class="pull-right form-label">Owner: <?php echo $active_user_name ?></label>
							</div>
							<div class="clearfix"></div>
							<hr>
							<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
								<input type="url" name="url" value="http://www.domain.com/section-to-be-crawled/" class="form-control" onclick="this.select();">
							</div>
							<div class="clearfix"></div>
							<br>
							<div id="keyword-area">
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
									<input type="text" name="keyword-1-name" placeholder="Keyword Name" class="form-control">
								</div>
								<div class="col-lg-7 col-md-7 col-sm-8 col-xs-6">
									<input type="text" name="keyword-1-name" placeholder="Keyword Path" class="form-control">
								</div>
								<div class="clearfix"></div>
							</div>
							<br>
							<div class="col-lg-12">
								<a class="btn btn-default" onClick="AddKeywordRow()"><span class="fa fa-plus"></span> Add Keyword</a>
							</div>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="content-box">
						<h3 class="title">
							Your Targets
						</h3>
						<hr>
					</div>
				</div>
			</div>
		</div>
		<?php require './footer.php'; ?>
		<script>
		function AddKeywordRow()
		{
			alert("Adding keyword Row");
		}
		</script>
	</body>
</html>