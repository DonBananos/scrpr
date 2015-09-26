<!DOCTYPE html>
<?php
//This should be done on all pages
require_once __DIR__ . '/../../vendor/autoload.php';

$config = new Config();

if(isset($_SESSION['user_id']))
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
		<div id="wrapper">
			<?php require './navbar/side-nav.php'; ?>
			<div id="page-wrapper" >
				<div id="page-inner">
					<div class="row">
						<div class="page-header">
							<h1>ScrpЯ Dashboard</h1>   
							<p class="lead">Welcome <?php echo $active_user_name ?>, Love to see you back.! </p>
						</div>
					</div>              
				</div>
            </div>
        </div>
	</body>
</html>