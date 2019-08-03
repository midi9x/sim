<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package MinoSim
 */

get_header(); ?>

	<div class="container">
		<div class="row">
			<div id="primary" class="content-area col-md-6 order-md-2 px-md-0 bg-white">
				<main id="main" class="site-main p-2" role="main">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'minosim' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'minosim' ); ?></p>

						<?php
							get_search_form();
						?>
					</div>
				</main><!-- #main -->
			</div><!-- #primary -->
		<?php
			get_sidebar('left');
			get_sidebar('right');
		?>
<?php
get_footer();
