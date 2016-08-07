
/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
jQuery(function($){
	
	get_options(['colour','font']).then(function(_colours, _fonts){
		
		var colours = [];
		for(var name in _colours){
			colours.push(name);			
		}
		colours.forEach(function(name){
			wp.customize( 'colour_' + name, function( value ) {
				value.bind( function( newval ) {
					
					$('#colour_' + name).text(' .colour_'+ name +' { color: ' + newval + '; }')
					$('#border_colour_' + name).text(' .border_colour_'+ name +' { border-color: ' + newval + '; }')
					$('#bg_' + name).text(' .bg_'+ name +' { background-color: ' + newval + '; }')
					
					$('.option.colour_' + name + ' .value').text(newval);
					$('.option.bg_' + name + ' .value').text(newval);
					
				});
			});
		});
		
		var fonts = [];
		for(var name in _fonts){
			fonts.push(name);
		}
		fonts.forEach(function(){
			wp.customize( 'font_' + name, function( value ) {
				value.bind( function( newval ) {
					
					$('#font_' + name).text(' .font_'+ name +' { font-family: ' + newval + '; }')
					$('.option.font_' + name + ' .value').text(newval);
					
				});
			});
		})
	})
});
