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
							<input class="form-control input-lg" placeholder="Sign up with your email" type="email" name="email">
							<span class="input-group-btn"><input class="btn btn-lg btn-primary" type="submit" value=">>"></span>
						</div>
					</form>
				</div>
			</div>
		</div>
    </body>
</html>
