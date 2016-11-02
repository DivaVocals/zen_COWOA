<?php
// -----
// Part of the CSS3 buttons for Zen Cart plugin, v1.1.0 and later.  Copyright (C) 2014, Vinos de Frutas Tropicales (lat9).
// Adapted for COWOA by Copyright (C) 2015, Over the Hill Web Consulting (C Jones)
//
if (!defined ('CSS3_BUTTONS_INCLUDE_FONT_AWESOME')) {
	if (defined ('FONT_AWESOME_INCLUDE_FONT_AWESOME_CSS_VERSION') && defined ('FONT_AWESOME_INCLUDE_FONT_AWESOME_CSS') && FONT_AWESOME_INCLUDE_FONT_AWESOME_CSS == 'true') {
	  echo '<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/' . FONT_AWESOME_INCLUDE_FONT_AWESOME_CSS_VERSION . '/css/font-awesome.min.css" />' . "\n";
	}
} else {
	if (defined ('CSS3_BUTTONS_FONT_AWESOME_VERSION') && defined ('CSS3_BUTTONS_INCLUDE_FONT_AWESOME') && CSS3_BUTTONS_INCLUDE_FONT_AWESOME == 'true') {
	  echo '<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/' . CSS3_BUTTONS_FONT_AWESOME_VERSION . '/css/font-awesome.min.css" />' . "\n";
	}
}
