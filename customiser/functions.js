console.log("customiser loaded");
var customiser = {
	templates: {},
	options: {}
};

function set_not_static(element){
	if($(element).css('position') === 'static'){
		$(element).css('position', 'relative');
	}
}

/*
 * Investigate if needed
 */
function set_zindex(element, search){
	var zindex = $(element).parents(search).toArray().length + 1;
	$(element).css('z-index', zindex);
}

/**
 * Closes the options picker
 */
function close_picker(picker){
	
	if(!$(picker).hasClass('options_picker')){
		picker = $(picker).closest('.options_picker')
	}
	
	//gets the container
	var container = $(picker).closest('[data-customise]');
	
	//removes picker
	$(picker).remove();
	
	//gets / sets z-index
	//var zindex = container.parents('[data-customise]').toArray().length + 1;
	//container.css('z-index', zindex);
	
}

function get_options(options){
	var promises = [];
	options.forEach(function(option){
		var prom = get_option(option);
		promises.push(prom);
	})
	
	return $.when.apply(this, promises);
}

function get_option(option){
	var deferred = $.Deferred();
	
	if(typeof customiser.options[option] === 'undefined'){
		$.get(ajaxurl,{
			'action': 'get_option',
			'option':   option
		}, 
		function(response){
			customiser.options[option] = response;
			deferred.resolve(response);
		}, "JSON");
	}else{
		deferred.resolve(customiser.options[option]);
	}
	
	return deferred.promise();
}
	
function get_template_parts(parts){
	var promises = [];
	parts.forEach(function(part){
		var prom = get_template_part(part);
		promises.push(prom);
	})
	
	return $.when.apply(this, promises);
}
	
function get_template_part(part){
	var deferred = $.Deferred();
	
	if(typeof customiser.templates[part] === 'undefined'){
		$.get(ajaxurl,{
			'action': 'customiser_template',
			'part': part
		}, 
		function(response){
			
			var template = Handlebars.compile(response);
			
			customiser.templates[part] = template;
			deferred.resolve(template);
		});
	}else{
		deferred.resolve(customiser.templates[part]);
	}
	
	return deferred.promise();
}