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
	die();
}
$tc = new Target_controller();
if (isset($_POST['target-submit']))
{
	$title = $_POST['title'];
	$subtitle = $_POST['subtitle'];
	$url = $_POST['url'];
	$user_id = $_SESSION['user_id'];

	$result = $tc->create_new_target($title, $subtitle, $url, $user_id);
	if (is_int($result))
	{
		?>
		<script>window.location = '<?php echo $config->get_base_url(); ?>target/<?php echo $result ?>/';</script>
		<?php
	}
}

if (isset($_GET['id']))
{
	$new = false;
	$target_id = $_GET['id'];
	$target_details = $tc->get_target_details_on_id($target_id);
	$headline = $target_details['title'];
	$lead = $target_details['subtitle'];
	$title = $headline;
	$subtitle = $lead;
	$url = $target_details['url'];
	$created = date("d/m-Y", $target_details['datetime']);
	$user = $target_details['owner_id'];
}
else
{
	$new = true;
	$headline = "New Target";
	$lead = "Create a new Target to spy on";
	$title = "Unnamed Target";
	$subtitle = "Unnamed Target's subtitle";
	$url = "http://www.domain.com/section-to-be-crawled/";
	$created = date("d/m-Y", time());
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
				<h1><?php echo $headline ?></h1>
				<p class="lead" id="subtitle">
					<?php echo $lead ?>
					<span class="pull-right last-login-span">
						<i>Last login:</i> 28/09/2015
					</span>
				</p>
			</div>
			<div id="page-inner">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="content-box">
						<form action="" method="POST">
							<div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
								<input type="text" name="title" value="<?php echo $title ?>" class="form-control title-input invisible-input" onclick="this.select();">
							</div>
							<div class="col-lg-6 col-md-4 col-sm-2 hidden-xs">
								<label class="pull-right form-label">Created: <?php echo $created ?></label>
							</div>
							<div class="clearfix"></div>
							<div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
								<input type="text" name="subtitle" value="<?php echo $subtitle ?>" class="form-control subtitle-input invisible-input" onclick="this.select();">
							</div>
							<div class="col-lg-6 col-md-4 col-sm-2 hidden-xs">
								<label class="pull-right form-label">Owner: <?php echo $active_user_name ?></label>
							</div>
							<div class="clearfix"></div>
							<hr>
							<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
								<input type="url" name="url" value="<?php echo $url ?>" class="form-control" onclick="this.select();">
							</div>
							<div class="clearfix"></div>
							<br>
							<div id="keyword-area">
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
									<input type="text" name="keyword-name[]" placeholder="Keyword Name" class="form-control">
								</div>
								<div class="col-lg-7 col-md-7 col-sm-8 col-xs-6">
									<input type="text" name="keyword-path[]" placeholder="Keyword Path" class="form-control">
								</div>
								<div class="clearfix"></div>
								<br>
							</div>
							<br>
							<div class="col-lg-12">
								<a class="btn btn-default" onClick="AddKeywordRow()"><span class="fa fa-plus"></span> Add Keyword</a>
								<input type="submit" class="btn btn-primary" value="Save Target" name="target-submit">
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
				var newField = "<div class='col-lg-3 col-md-3 col-sm-4 col-xs-6'><input type='text' class='form-control' placeholder='Keyword Name' name='keyword-name[]'></div><div class='col-lg-7 col-md-7 col-sm-8 col-xs-6'><input type='text' class='form-control' placeholder='Keyword Path' name='keyword-path[]'></div><div class='clearfix'></div><br>";
				$('#keyword-area').append(newField);
			}
		</script>
	</body>
</html>