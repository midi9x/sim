<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package StrapPress
 */

get_header(); ?>

    <div class="container">
        <div class="row">
            <div id="primary" class="content-area col-md-6 order-md-2 px-md-0 bg-white">
                <main id="main" class="site-main p-2" role="main">

                <?php
                if ( have_posts() ) :

                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content', get_post_format() );

                    endwhile;

                    wpbs_pagination();

                else :

                    get_template_part( 'template-parts/content', 'none' );

                endif; ?>

                </main><!-- #main -->
            </div><!-- #primary -->
    <?php
        get_sidebar('left');
        get_sidebar('right');
    ?>
<?php
get_footer();
