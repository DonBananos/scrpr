<div class="col-lg-12">
	<h3>Alright! So your email is <?php echo $email ?>?</h3>
	<p class="lead">Let's just finish this up with a small bit of info!</p>
</div>
<input type="hidden" name="email" value="<?php echo $email ?>">
<div class="col-lg-12">
	<input type="text" name="name" placeholder="What's your name?" class="form-control input-field">
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	<input type="password" name="pass1" placeholder="Password" class="form-control input-field">
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	<input type="password" name="pass2" placeholder="Retype password" class="form-control input-field">
</div>
<input class="btn btn-success btn-lg" value="Sign up!" type="submit" name="signupsubmit">