<!DOCTYPE html>
<?php
//This should be done on all pages
require_once __DIR__ . '/../../vendor/autoload.php';

$config = new Config();

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
				<p class="lead">Create a new Target to spy on</p>
			</div>
		</div>
		<?php require './footer.php'; ?>
	</body>
</html>