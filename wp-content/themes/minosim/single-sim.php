<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package MinoSim
 */

function filter_wpseo_title($title) {
    $sim = str_replace('.', '', get_the_title());
    $title = str_replace('*sim*', $sim, $title);
    return $title;
}
add_filter( 'wpseo_title', 'filter_wpseo_title', 10, 1 );


function filter_wpseo_metadesc($desc) {
    $sim = str_replace('.', '', get_the_title());
    $desc = str_replace('*sim*', $sim, $desc);
    return $desc;
}
add_filter( 'wpseo_metadesc', 'filter_wpseo_metadesc', 10, 1 );

$nhaMang = getTenNhaMang(get_the_title(), true);

global $post;
$image = home_url('/') . $nhaMang . '/' . $post->post_name . '.jpg';
function filter_wpseo_opengraph_image( $img ) {
    global $image;
    return $image; 
}
add_filter( 'wpseo_opengraph_image', 'filter_wpseo_opengraph_image', 10, 10 );
add_filter( 'wpseo_twitter_image', 'filter_wpseo_opengraph_image', 10, 10 );

get_header(); ?>

    <div class="container">
        <div class="row">
            <div id="primary" class="content-area col-md-6 order-md-2 px-md-0 bg-white">
                <main id="main" class="site-main p-3" role="main">

                <?php
                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/single', 'sim' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        //comments_template();
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
