<!DOCTYPE html>
<?php
//This should be done on all pages
require_once __DIR__ . '/../vendor/autoload.php';

$config = new Config();
?>

<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Scrpr | Your source for up2date data</title>
		<?php require '../config/head.php'; ?>
    </head>
    <body>
		<div class="container-full">
			<div class="row">
				<div class="col-lg-12 text-center v-center">
					<h1 class="hidden-link"><a href="<?php echo $config->get_base_url() ?>">ScrpЯ</a></h1>
					<p class="lead">Your source for up2date data</p>
					<br>
					<br><br>
					<hr>
					<form class="col-lg-12" action="<?php echo $config->get_base_url() ?>signup.php" method="POST">
						<div class="input-group" style="width:340px;text-align:center;margin:0 auto;">
							<input class="form-control input-lg" placeholder="Sign up with your email" type="email" name="email" id="email" onkeyup="checkEmail(this)">
							<span class="input-group-btn"><button class="btn btn-lg btn-primary disabled" type="submit" id="button">>></button></span>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script>
			function checkEmail(val)
			{
				var len = val.value.length;
				if (len > 5)
				{
					$('#button').removeClass('disabled');
				}
				if (len < 6)
				{
					$('#button').addClass()('disabled');
				}
			}
		</script>
    </body>
</html>
