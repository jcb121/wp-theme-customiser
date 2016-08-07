jQuery(document).ready(function($) {
	
	init();
	function init(){
		/*get_options(["colours", "fonts"]).then(function(){
			console.log("pre-loaded options");
		})
		get_template_parts(['container', 'background', 'colour', 'font']).then(function(){
			console.log("pre-loaded templates");
		})*/
	}
	
	$('body').on('click', '[data-customise]', function(event){
		event.stopPropagation();
		
		
		if($(this).data("active") === true){
			$(this).data("active", false);
			$(this).find('.launch_options').remove();
		}
		else{
			$(this).data("active", true);
			set_not_static(this);
			
			var options = $(this).data('customise').split(',');
			var options_container = $('<div class="launch_options"></div>');
			
			//Simple mode
			options.forEach(function(option, index){
				option = option.trim();
				var button = $('<button class="options" type="button"></button>');
				button.text(option);
				button.data("option", option);
				button.appendTo(options_container);
				
			});
			//Hard mode
			options.forEach(function(option, index){
				options[index] = option.trim();
			});
			var button = $('<button class="options" type="button"></button>');
			button.text('options');
			button.data("option", options);
			button.appendTo(options_container);
			
			options_container.appendTo(this);
		}	
	});
	
	
	
	/* OLD */
	$('[data-customise]').on('change', 'input.background', function(){
		var new_class = $(this).data('class');
		var target = $(this).closest('[data-customise]');
		
		get_option('colours').then(function(colours){
			for(var id in colours){
				target.removeClass('bg_' + id);
			}
			target.addClass(new_class);
		});
	})
	
	$('[data-customise]').on('change', 'input.colour', function(){
		var new_class = $(this).data('class');
		var target = $(this).closest('[data-customise]');
		
		get_option('colours').then(function(colours){
			for(var id in colours){
				target.removeClass('colour_' + id);
			}
			target.addClass(new_class);
		});
	})
	
	$('[data-customise]').on('change', 'input.font', function(){
		var new_class = $(this).data('class');
		var target = $(this).closest('[data-customise]');
		
		get_option('fonts').then(function(fonts){
			for(var id in fonts){
				target.removeClass('font_' + id);
			}
			target.addClass(new_class);
		});
	})
	
	/** 
	 * Closes picker on submit
	 */
	$('[data-customise]').on('submit', '.options_form', function(event){
		event.preventDefault();
		event.stopPropagation();
		close_picker(this);
	});
	
	/**
	 * Closes the current pickers
	 */
	$('[data-customise]').on('click', '.options_picker .close', function(event){
		event.stopPropagation();
		close_picker(this);
	});
	
	/**
	 * Stops picker click propogation
	 */
	$('[data-customise]').on('click', '.options_picker', function(event){
		event.stopPropagation();
	});
	
	/**
	 * Opens a picker menu
	 */
	$('[data-customise]').on('click', '.launch_options button', function(event){
		event.stopPropagation();
		
		
		
		var container = $(this).closest('[data-customise]');
		var parts = $(this).data('option');
		
		//Convert parts to array
		if(typeof parts === "string") parts = [parts];
		
		
		//check for picker on element
		var pickers_open = $(".options_picker").toArray();
		if(pickers_open.length > 0){	
			pickers_open.forEach(function(picker){
				close_picker(picker);
			});
		}
			
		get_template_part('container').then(function(_container){
			
			get_template_parts(parts).then(function(){
				var templates = arguments;
				
				get_options(parts).then(function(){
					var options = arguments;
					var area;
					var context = {};
					
					parts.forEach(function(part, index){
						context[part] = templates[index](options[index]);
					})
					
					if(container.offset().top > 600){
						context.top = true;
						area = "top";
					}else{
						context.bottom = true;
					}
					
					var modal = $(_container(context));
					container.append(modal); 
					
					var left = container.width() / 2 - modal.width() /2;
					modal.css("left", left);
					
					var top = 0;
					if(area === "top"){
						top = 0 - modal.height();
					}else{
						top = container.height();
					}	
					modal.css("top", top);
				})
			})
		})
	});
	
});

