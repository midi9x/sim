<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package MinoSim
 */

if ( ! function_exists( 'minosim_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function minosim_posted_on() {
	$time_string = 'Đăng lúc: <time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$posted_on = sprintf($time_string);

	echo '<span class="posted-on">' . $posted_on . '</span>';

	$categories_list = get_the_category_list( esc_html__( ', ', 'minosim' ) );
	if ( $categories_list ) {
		printf( ' | Chuyên mục: <span class="cat-links"><i class="far fa-folder-open"></i>' . esc_html__( '%1$s', 'minosim' ) . '</span>', $categories_list );
	}
}
endif;

if ( ! function_exists( 'minosim_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function minosim_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() && is_single() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'minosim' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><i class="fas fa-tags"></i>' . esc_html__( '%1$s', 'minosim' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'minosim' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link float-right">',
		'</span>', 0, 'btn btn-sm btn-danger'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function minosim_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'minosim_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'minosim_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so minosim_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so minosim_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in minosim_categorized_blog.
 */
function minosim_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'minosim_categories' );
}
add_action( 'edit_category', 'minosim_category_transient_flusher' );
add_action( 'save_post',     'minosim_category_transient_flusher' );
