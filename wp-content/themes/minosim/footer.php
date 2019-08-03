<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MinoSim
 */

?>

    </div><!-- #content -->
    <footer class="site-footer" role="contentinfo">
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <?php dynamic_sidebar( 'sidebar-footer' ); ?>
                </div>
            </div>
        </div>
        <div id="colophon">
            <div class="container">
				<div class="row">
					<div class="col-md-6 text-left">
						Copyright <?=date('Y')?> &copy; <?php bloginfo( 'name' );?>
					</div>
					<div class="col-md-6 text-right">
						Thiết kế website bởi Mino
					</div>
				</div>
            </div> <!--  .container -->
        </div>
    </footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
