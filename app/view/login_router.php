<!DOCTYPE html>
<?php
//This should be done on all pages
require_once __DIR__ . '/../../vendor/autoload.php';

$config = new Config();

if (isset($_POST['email-submit']))
{
	$email = $_POST['email'];
	$uc = new User_controller();
	$email_check = $uc->check_if_email_is_free($email);
}
elseif (isset($_POST['signupsubmit']))
{
	$email = $_POST['email'];
	$name = $_POST['name'];
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];

	$uc = new User_controller();
	$uc->create_new_user($email, $name, $pass1, $pass2);
}
elseif(isset($_POST['sign-in-submit']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$uc = new User_controller();
	$sign_in_result = $uc->sign_user_in($email, $password);
	if($sign_in_result)
	{
		?>
<script>alert("Welcome!");window.location = '<?php echo $config->get_base_url() ?>view/dashboard.php';</script>
		<?php
	}
	else
	{
		?>
<script>alert("BAAAH!");</script>
		<?php
	}
}
else
{
	?>
	<script>
		window.location = "./";
	</script>
	<?php
}
?>
<html>
	<head>
		<meta charset="UTF-8">
        <title>Scrpr | Your source for up2date data</title>
		<?php require '../../config/head.php'; ?>
	</head>
	<body>
		<div class="container-full">
			<div class="row">
				<div class="col-lg-12 text-center v-center">
					<h1 class="hidden-link"><a href="<?php echo $config->get_base_url() ?>">ScrpЯ</a></h1>
					<p class="lead">Your source for up2date data</p>
					<br><br><br>
					<hr>
					<div class="col-lg-4 col-md-4 col-sm-3 hidden-xs">
						<!-- EMPTY DIV FOR ALIGNMENT -->
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<form class="col-lg-12" action=" " method="POST">
						<?php
						if (!$email_check)
						{
							require './login.php';
						}
						else
						{
							require './signup.php';
						}
						?>
						</form>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-3 hidden-xs">
						<!-- EMPTY DIV FOR ALIGNMENT -->
					</div>
				</div>
			</div>
		</div>
	</body>
</html>