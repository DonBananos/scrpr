<?php require_once __DIR__ . '/vendor/autoload.php'; ?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Scrpr | Your source for up2date data</title>
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
					<br>
                                        <?php 
                                            $tester = new Tester;
                                            $bam = $tester->add(4, 57);
                                            echo "<h2>Tester->add(4, 57) result: $bam</h2>";
                                        ?>
                                        <br><br>
					<hr>
                                        <form class="col-lg-12" action="./app/signup.php" method="POST">
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
