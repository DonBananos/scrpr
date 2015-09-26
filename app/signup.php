<?php
if (isset($_POST['email']))
{
	$email = $_POST['email'];
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
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
        <title>Scrpr | Your source for up2date data</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body>
		<style>
			body
			{
				background-color: #01003b;
				color: orange
			}
			.v-center {
				margin-top:7%;
			}
			.hidden-link a,
			.hidden-link a:hover,
			.hidden-link a:active,
			.hidden-link a:visited
			{
				text-decoration: none; 
				color: inherit
			}
		</style>
		<div class="container-full">
			<div class="row">
				<div class="col-lg-12 text-center v-center">
					<h1 class="hidden-link"><a href="./">ScrpЯ</a></h1>
					<p class="lead">Your source for up2date data</p>
					<br><br><br>
					<hr>
					<div>
						<h3>Alright! So your email is <?php echo $email ?>?</h3>
						<p class="lead">Let's just finish this up with a small bit of info!</p>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-3 hidden-xs">

					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 hidden-xs">
						<form class="col-lg-12" action="./signup.php" method="POST">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<input type="email" name="email" class="form-control" value="<?php echo $email ?>">
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<input type="text" name="name" placeholder="What's your name?" class="form-control">
							</div>
							<br>
							<br>
							<br>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<input type="password" name="pass1" placeholder="Password" class="form-control">
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<input type="password" name="pass2" placeholder="Retype password" class="form-control">
							</div>
							<br>
							<br>
							<br>
							<input class="btn btn-success btn-lg" value="Sign up!" type="submit">
						</form>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-3 hidden-xs">

					</div>
				</div>
			</div>
		</div>
	</body>
</html>