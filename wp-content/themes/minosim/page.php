<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MinoSim
 */

get_header(); ?>

	<div class="container">
		<div class="row">
			<div id="primary" class="content-area col-md-6 order-md-2 px-md-0 bg-white">
				<main id="main" class="site-main p-2" role="main">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/single', 'page' );

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
