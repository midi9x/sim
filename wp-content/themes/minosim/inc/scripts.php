<?php
/**
 * Enqueue scripts and styles.
 */
function minosim_scripts() {
	wp_enqueue_style( 'minosim-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), '1.0.0' );
	wp_enqueue_style( 'minosim-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0.0' );

	wp_enqueue_script( 'minosim-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), ' ', true );
	wp_enqueue_script( 'minosim-js', get_template_directory_uri() . '/js/app.js', array('jquery'), ' ', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'minosim_scripts' );


/**
 * Filter the HTML script tag of `leadgenwp-fa` script to add `defer` attribute.
 *
*/
function minosim_defer_scripts( $tag, $handle, $src ) {
	// The handles of the enqueued scripts we want to defer
	$defer_scripts = array( 
		'minosim-fa'
	);
    if ( in_array( $handle, $defer_scripts ) ) {
        return '<script src="' . $src . '" defer></script>';
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'minosim_defer_scripts', 10, 3 );