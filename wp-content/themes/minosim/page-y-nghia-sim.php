<?php
/**
 * Template Name: Ý nghĩa sim
 */

$simnumber = get_query_var('simnumber');
function filter_wpseo_canonical($canonical) {
    global $simnumber;
    $link = $canonical . $simnumber . '/';
    $link = str_replace('y-nghia-sim/', 'y-nghia-sim-', $link);
    return $link;
}
add_filter( 'wpseo_canonical', 'filter_wpseo_canonical', 10, 1 );
//add_filter( 'wpseo_opengraph_url', 'filter_wpseo_canonical', 10, 1 );

function filter_wpseo_title($title) {
    global $simnumber;
    if ($simnumber) {
        $title = str_replace('*sim*', $simnumber, $title);
    }
    return $title;
}
add_filter( 'wpseo_title', 'filter_wpseo_title', 10, 1 );

function filter_wpseo_metadesc($desc) {
    global $simnumber;
    if ($simnumber) {
        $desc = str_replace('*sim*', $simnumber, $desc);
    }
    return $desc;
}
add_filter( 'wpseo_metadesc', 'filter_wpseo_metadesc', 10, 1 );

get_header(); ?>

	<div class="container">
		<div class="row">
			<div id="primary" class="content-area col-md-6 order-md-2 px-md-0 bg-white">
				<main id="main" class="site-main p-2" role="main">

					<?php
					while ( have_posts() ) : the_post();
                    ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    	<header class="entry-header">
                    		<h1 class="entry-title">Ý nghĩ sim <?=$simnumber?></h1>
                    	</header><!-- .entry-header -->
                    
                    	<div class="entry-content">
                    		<?php
                    			the_content();
                    
                    			wp_link_pages( array(
                    				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'minosim' ),
                    				'after'  => '</div>',
                    			) );
                    		?>
                    	</div><!-- .entry-content -->
                    </article><!-- #post-## -->
                    <?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</main><!-- #main -->
			</div><!-- #primary -->
		<?php
			get_sidebar('left');
			get_sidebar('right');
		?>
<?php
get_footer();
