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
		}
		else
		{
			$(this).attr('next', 'up');
			$('#target-menu').slideDown(250);
		}
	});
</script>
