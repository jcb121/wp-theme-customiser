
/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
(function($){
	
	//TODO Get these settings from the get_options functions
	var colours = ['1','2','3','4','5','6','7'];
	
	colours.forEach(function(name){
		
		wp.customize( 'colour_' + name, function( value ) {
			value.bind( function( newval ) {
				
				$('#colour_' + name).text(' .colour_'+ name +' { color: ' + newval + ' }')
				$('.option.colour_' + name + ' .value').text(newval);
				
				$('#bg_' + name).text(' .bg_'+ name +' { background-color: ' + newval + ' }')
				$('.option.bg_' + name + ' .value').text(newval);
				
			});
		});
	});	
	
	var fonts = ['1', '2', '3', '4', '5'];
	
	fonts.forEach(function(name){
		
		wp.customize( 'font_' + name, function( value ) {
			value.bind( function( newval ) {
				
				$('#font_' + name).text(' .font_'+ name +' { font-family: ' + newval + ' }')
				$('.option.font_' + name + ' .value').text(newval);
				
			});
		});
	});	
	
})(jQuery);
