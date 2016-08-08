jQuery( document ).ready(function($) {
	console.log("Loaded");
	
	$(window).on('resize', function(){
		var siteHeight = $('.site-page').height();
		var windowHeight = $('body').height();
		if( siteHeight < windowHeight){
			$('.footer').addClass('sticky');
		}else{
			$('.footer').removeClass('sticky');
		}
	});
	$(window).trigger('resize');

	var headerHeight = $('#site-identity').height();
	$(document).scroll(function() {
		var scrollDistance = $(document).scrollTop();
		if( headerHeight < scrollDistance){
			var navHeight = $('#site-header').height();
			if( !$('#site-header').hasClass('sticky')){
				$('#site-header').addClass('sticky');
				
				$('body').css('padding-top', navHeight + 3);
			}
		}
		else{
			$('#site-header').removeClass('sticky');
			$('body').css('padding-top', 0);
		}
	});
	
	
	$('.show-side-menu-right').click(function(){
		$('#side_bar_right').addClass('active');
	});
	
	$('.hide-side-menu-right').click(function(){
		$('#side_bar_right').removeClass('active');
	});
	
	
	
	
});