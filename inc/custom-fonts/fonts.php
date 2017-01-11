<?php
/**
 * List of all available fonts.
 **/

/**
 * Web Safe Fonts
 * all fonts in this group nned to use "ws_" prefix.
 **/
function checathlon_plus_fonts_websafe() {

	$fonts = array(
		'ws_arial' => array(
			'name'   => 'Arial / Helvetica',
			'family' => 'Arial,Helvetica,sans-serif',
		),
		'ws_times' => array(
			'name'   => 'Times New Roman',
			'family' => '"Times New Roman",Times,serif',
		),
		'ws_courier' => array(
			'name'     => 'Courier New',
			'family'   => '"Courier New",Courier,monospace',
		),
		'ws_system' => array(
			'name'    => 'System fonts',
			'family'  => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif',
		),
	);

	return apply_filters( 'checathlon_plus_fonts_websafe', $fonts );
}


/**
 * Heading Fonts Choices.
 * Google fonts only suitable for headings.
 **/
function checathlon_plus_fonts_heading() {

	$fonts = array(
		'Abril Fatface' => array(
			'name'   => 'Abril Fatface',
			'family' => '"Abril Fatface",cursive',
			'weight' => array( '400' ),
			'subset' => array( 'latin', 'latin-ext' ),
		),
		'Cherry Swash' => array(
			'name'   => 'Cherry Swash',
			'family' => '"Cherry Swash",cursive',
			'weight' => array( '400', '700' ),
			'subset' => array( 'latin', 'latin-ext' ),
		),
		'Fondamento' => array(
			'name'   => 'Fondamento',
			'family' => '"Fondamento",cursive',
			'weight' => array( '400', '400i' ),
			'subset' => array( 'latin', 'latin-ext' ),
		),
		'Libre Baskerville' => array(
			'name'   => 'Libre Baskerville',
			'family' => '"Libre Baskerville",cursive',
			'weight' => array( '400', '400i', '700' ),
			'subset' => array( 'latin', 'latin-ext' ),
		),
		'Lobster Two' => array(
			'name'   => 'Lobster Two',
			'family' => '"Lobster Two",cursive',
			'weight' => array( '400', '400i', '700', '700i' ),
			'subset' => array( 'latin' ),
		),
		'Lora' => array(
			'name'   => 'Lora',
			'family' => '"Lora",serif',
			'weight' => array( '400', '400i', '700', '700i' ),
			'subset' => array( 'latin', 'latin-ext' ),
		),
		'Montserrat' => array(
			'name'   => 'Montserrat',
			'family' => '"Montserrat",sans-serif',
			'weight' => array( '400', '700' ),
			'subset' => array( 'latin' ),
		),
		'Oswald' => array(
			'name'   => 'Oswald',
			'family' => '"Oswald",sans-serif',
			'weight' => array( '300', '400', '700' ),
			'subset' => array( 'latin', 'latin-ext' ),
		),
		'Playfair Display' => array(
			'name'   => 'Playfair Display',
			'family' => '"Playfair Display",serif',
			'weight' => array( '400', '400i', '700', '700i', '900', '900i' ),
			'subset' => array( 'latin', 'latin-ext','cyrillic' ),
		),
		'Raleway' => array(
			'name'   => 'Raleway',
			'family' => '"Raleway",sans-serif',
			'weight' => array( '400', '400i', '600', '600i', '700', '700i' ),
			'subset' => array( 'latin', 'latin-ext' ),
		),
		'Roboto' => array(
			'name'   => 'Roboto',
			'family' => '"Roboto",sans-serif',
			'weight' => array( '400', '400i', '500', '500i', '700', '700i' ),
			'subset' => array( 'latin', 'latin-ext','cyrillic', 'cyrillic-ext', 'greek', 'greek-ext', 'vietnamese' ),
		),
		'Roboto Slab' => array(
			'name'   => 'Roboto Slab',
			'family' => '"Roboto Slab",serif',
			'weight' => array( '100', '300', '400', '700' ),
			'subset' => array( 'latin', 'latin-ext','cyrillic', 'cyrillic-ext', 'greek', 'greek-ext', 'vietnamese' ),
		),
		'Rancho' => array(
			'name'   => 'Rancho',
			'family' => '"Rancho",cursive',
			'weight' => array( '400' ),
			'subset' => array( 'latin' ),
		),
		'Satisfy' => array(
			'name'   => 'Satisfy',
			'family' => '"Satisfy",cursive',
			'weight' => array( '400' ),
			'subset' => array( 'latin' ),
		),
		'Source Sans Pro' => array(
			'name'   => 'Source Sans Pro',
			'family' => '"Source Sans Pro",sans-serif',
			'weight' => array( '400', '600', '700', '400i', '600i', '700i' ),
			'subset' => array( 'latin', 'latin-ext' ),
		),
		'Source Serif Pro' => array(
			'name'   => 'Source Serif Pro',
			'family' => '"Source Serif Pro",serif',
			'weight' => array( '400', '600', '700' ),
			'subset' => array( 'latin', 'latin-ext' ),
		),
	);

	return apply_filters( 'checathlon_plus_fonts_heading', $fonts );
}


/**
 * Base Fonts Choices.
 * Google fonts suitable for base fonts.
 **/
function checathlon_plus_fonts_base() {

	$fonts = array(
		'Alegreya Sans' => array(
			'name' => 'Alegreya (Sans)',
			'family'  => '"Alegreya Sans",sans-serif',
			'weight'  => array( '100', '100i', '300', '300i', '400', '400i', '500', '500i', '700', '700', '800', '800', '900', '900' ),
			'subset'  => array( 'latin', 'latin-ext', 'vietnamese' ),
		),
		'Alegreya' => array(
			'name'   => 'Alegreya (Serif)',
			'family' => '"Alegreya",serif',
			'weight' => array( '400', '400i', '700', '700i', '900', '900i' ),
			'subset' => array( 'latin', 'latin-ext' ),
		),
		'Asap' => array(
			'name'   => 'Asap',
			'family' => '"Asap",sans-serif',
			'weight' => array( '400', '400i', '500', '500i', '700', '700i' ),
			'subset' => array( 'latin', 'latin-ext', 'vietnamese' ),
		),
		'Arvo' => array(
			'name'   => 'Arvo',
			'family' => '"Arvo",serif',
			'weight' => array( '400', '400i', '700', '700i' ),
			'subset' => array( 'latin' ),
		),
		'Capin' => array(
			'name'   => 'Capin',
			'family' => '"Capin",sans-serif',
			'weight' => array( '400', '400i', '500', '500i', '600', '600i', '700', '700i' ),
			'subset' => array( 'latin', 'latin-ext', 'vietnamese' ),
		),
		'Droid Sans' => array(
			'name'   => 'Droid Sans',
			'family' => '"Droid Sans",sans-serif',
			'weight' => array( '400', '700' ),
			'subset' => array( 'latin' ),
		),
		'Droid Serif' => array(
			'name'   => 'Droid Serif',
			'family' => '"Droid Serif",serif',
			'weight' => array( '400', '400i', '700', '700i' ),
			'subset' => array( 'latin' ),
		),
		'Lato' => array(
			'name' => 'Lato',
			'family' => '"Lato",sans-serif',
			'weight'  => array( '100', '100i', '300', '300i', '400', '400i', '700', '700i', '900', '900i' ),
			'subset'  => array( 'latin', 'latin-ext' ),
		),
		'Lora' => array(
			'name' => 'Lora',
			'family' => '"Lora",serif',
			'weight'  => array( '400', '400i', '700', '700i' ),
			'subset'  => array( 'latin', 'latin-ext', 'cyrillic' ),
		),
		'Merriweather Sans' => array(
			'name' => 'Merriweather (Sans)',
			'family' => '"Merriweather Sans",sans-serif',
			'weight'  => array( '300', '300i', '400', '400i', '700', '700i', '800', '800i' ),
			'subset'  => array( 'latin', 'latin-ext' ),
		),
		'Merriweather' => array(
			'name' => 'Merriweather (Serif)',
			'family' => '"Merriweather",serif',
			'weight'  => array( '300', '300i', '400', '400i', '700', '700i', '900', '900i' ),
			'subset'  => array( 'latin', 'latin-ext' ),
		),
		'Noticia Text' => array(
			'name' => 'Noticia Text',
			'family' => '"Noticia Text",serif',
			'weight'  => array( '400', '400i', '700', '700i' ),
			'subset'  => array( 'latin', 'latin-ext', 'vietnamese' ),
		),
		'Noto Sans' => array(
			'name' => 'Noto (Sans)',
			'family' => '"Noto Sans",sans-serif',
			'weight'  => array( '400', '400i', '700', '700i' ),
			'subset'  => array( 'latin', 'latin-ext', 'cyrillic', 'cyrillic-ext', 'greek', 'greek-ext', 'vietnamese' ),
		),
		'Noto Serif' => array(
			'name' => 'Noto (Serif)',
			'family' => '"Noto Serif",serif',
			'weight'  => array( '400', '400i', '700', '700i' ),
			'subset'  => array( 'latin', 'latin-ext', 'cyrillic', 'cyrillic-ext', 'greek', 'greek-ext', 'vietnamese' ),
		),
		'Open Sans' => array(
			'name' => 'Open Sans',
			'family' => '"Open Sans",sans-serif',
			'weight'  => array( '300', '300i', '400', '400i', '600', '600i', '700', '700i', '800', '800i' ),
			'subset'  => array( 'latin', 'latin-ext', 'cyrillic', 'cyrillic-ext', 'greek', 'greek-ext', 'vietnamese' ),
		),
		'PT Sans' => array(
			'name' => 'PT (Sans)',
			'family' => '"PT Sans",sans-serif',
			'weight'  => array( '400', '400i', '700', '700i' ),
			'subset'  => array( 'latin', 'latin-ext','cyrillic', 'cyrillic-ext' ),
		),
		'PT Serif' => array(
			'name' => 'PT (Serif)',
			'family' => '"PT Serif",serif',
			'weight'  => array( '400', '400i', '700', '700i' ),
			'subset'  => array( 'latin', 'latin-ext','cyrillic', 'cyrillic-ext' ),
		),
		'Ubuntu' => array(
			'name' => 'Ubuntu',
			'family' => '"Ubuntu",sans-serif',
			'weight'  => array( '300', '300i', '400', '400i', '700', '700i' ),
			'subset'  => array( 'latin', 'latin-ext','cyrillic', 'cyrillic-ext', 'greek', 'greek-ext' ),
		),
		'Vollkorn' => array(
			'name' => 'Vollkorn',
			'family' => '"Vollkorn",serif',
			'weight'  => array( '400', '400i', '700', '700i' ),
			'subset'  => array( 'latin' ),
		),
	);
	return apply_filters( 'checathlon_plus_fonts_base', $fonts );
}

/**
 * Merge All Fonts Available
 */
function checathlon_plus_fonts() {
	$fonts = array_merge( checathlon_plus_fonts_websafe(), checathlon_plus_fonts_heading(), checathlon_plus_fonts_base() );
	return apply_filters( 'checathlon_plus_fonts', $fonts );
}

/**
 * Merge All Google Fonts.
 **/
function checathlon_plus_fonts_google() {
	$fonts = array_merge( checathlon_plus_fonts_heading(), checathlon_plus_fonts_base() );
	return apply_filters( 'checathlon_plus_fonts_google', $fonts );
}
