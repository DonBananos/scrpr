<!DOCTYPE html>
<?php
//This should be done on all pages
require_once __DIR__ . '/../../vendor/autoload.php';

$config = new Config();

$view_id = 1; //Dashboard View

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
		<title>Dashboard | Scrpr</title>
		<?php require '../../config/head.php'; ?>
	</head>
	<body>
		<?php require './navbar/navbar.php'; ?>
		<div id="page-wrapper">
			<div class="page-header">
				<h1>Welcome <?php echo $active_user_name ?></h1>
				<p class="lead" id="subtitle">
					Great to see you again!
					<span class="pull-right last-login-span">
						<i>Last login:</i> 28/09/2015
					</span>
				</p>
			</div>
		</div>
		<?php require './footer.php'; ?>
	</body>
</html>
