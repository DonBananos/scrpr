<!DOCTYPE html>
<?php
require '../../config/Config.php';

if (isset($_SESSION['user_id']) OR isset($_SESSION['signed_in']))
{
	session_destroy();
}
require './footer.php';
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="refresh" content="0; url=http://<?php echo $config->get_base_url() ?>target/" />
		<title>Scrpr Logout</title>
		<?php require '../../config/Config.php'; ?>
	</head>
	<body>
		<?php require './footer.php'; ?>
	</body>
</html>