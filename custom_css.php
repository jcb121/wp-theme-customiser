<style>
	<?php
	$custom_fonts = get_option("cardiffapp_custom_fonts");
	foreach ($custom_fonts as $name => $default) {
		$custom_font = get_theme_mod('font_import_' . $name, $default);	
		echo $custom_font . "; \n";
	}
	?>
</style>

<?php

$fonts = get_option("cardiffapp_font");
foreach ($fonts as $name => $default) {
	$font = get_theme_mod('font_' . $name, $default);
	
	echo "<style id='font_{$name}'> .font_{$name} { font-family:{$font}; } </style> \n";
}

$theme_colours = get_option("cardiffapp_colour");
foreach ($theme_colours as $name => $default) {
	$theme_color = get_theme_mod('colour_' . $name, $default);
	
	echo "<style id='bg_{$name}'> .bg_{$name}     { background-color:{$theme_color}; } </style> \n";
	echo "<style id='colour_{$name}'> .colour_{$name} { color:{$theme_color}; } </style> \n";
}

?>

</style>
