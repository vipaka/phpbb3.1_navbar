/*$( document ).ready(function() {
	$( ".top_li" ).mouseover(function() {
		var reveal = $(this).attr('data-link');
		$('.top_menu_sub').hide();
		$('#' + reveal).css('display', 'block');
		$( "#" + reveal ).mouseover(function() {
			var revealer = $(this).attr('data-link');
			$('#' + revealer).css('display', 'block');
			$( "#" + reveal ).mouseout(function() {
				$('#' + revealer).css('display', 'none');
			});
		});
		$( ".top_li" ).mouseout(function() {
			$('#' + reveal).css('display', 'none');
		});
	});
	$( ".top_menu li ul li" ).mouseover(function() {
		var reveal = $(this).attr('data-link');
		$('.top_menu_sub_subs').hide();
		$('#' + reveal).css('display', 'inline-block');
		$( ".top_menu li ul li" ).mouseout(function() {
			$('#' + reveal).css('display', 'none');
		});
	});
});*/
