<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo $config->get_base_url() ?>../styling/js/bootstrap.min.js"></script>

<!-- JQuery -->
<script src="<?php echo $config->get_base_url() ?>../styling/js/jquery-1.10.2.js"></script>

<!-- Metis Menu -->
<script src="<?php echo $config->get_base_url() ?>../styling/js/jquery.metisMenu.js"></script>

<!-- Morris Charts -->
<script src="<?php echo $config->get_base_url() ?>../styling/js/morris/raphael-2.1.0.min.js"></script>
<script src="<?php echo $config->get_base_url() ?>../styling/js/morris/morris.js"></script>

<!-- Custom -->
<script src="<?php echo $config->get_base_url() ?>../styling/js/custom.js"></script>

<!-- Make the side menu 2. level work correct -->
<script>
	$('.menu-item').click(function(){
		$(".menu-item").removeClass("active-menu");
		$(this).addClass("active-menu");
	});
	$('#target-li').click(function(){
		if($(this).attr('next') == 'up')
		{
			$(this).attr('next', 'down');
			$('#target-menu').slideUp(250);
			setTimeout(function(){
				$('#target-li').removeClass('submenu-shown');
			}, 200);
		}
		else
		{
			$(this).attr('next', 'up');
			$('#target-li').addClass('submenu-shown');
			$('#target-menu').slideDown(250);
		}
	});
</script>
