 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php get_search_sim_form(); ?>
	<header class="entry-header">
		<h1 class="entry-title sim-title">Bán sim <?php the_title();?> - Sim <?=str_replace('.', '', get_the_title())?> giá rẻ</h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="row my-3">
			<div class="col-md-6 vcenter sim-info">
				<div class="row mb-3">
					<div class="col-4 bold">Số sim:</div>
					<div class="col-8 so">
						<?php the_title();?>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-4 bold">Giá bán:</div>
					<div class="col-8 gia">
						<?php
							$gia = getGia(get_the_ID());
							echo $gia;
						?>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-4 bold">Mạng:</div>
					<div class="col-8 mang">
						<?php
    						global $nhaMang;
    						echo ucfirst($nhaMang);
						?>
					</div>
				</div>
			</div>
			<div class="col-md-6 vcenter text-center">
			    <?php global $image; ?>
			    <img class="single-image" src="<?php echo $image;?>" alt="<?php the_title()?>">
			</div>
		</div>
		<?=do_shortcode('[contact-form-7 id="85" title="Form liên hệ 1" order_number="' . get_the_title() . '" order_time="' . time() . '" order_price="' . $gia . '"]')?>
		<div class="row mb-2">
			<div class="col-12">
			    <?php if (!get_the_content()): ?>
    				Mua bán sim <?php the_title();?> giá rẻ giao hàng quốc. <br>
    				Sim <?=$mang?> miễn phí giao sim tại <?php echo $_SERVER['SERVER_NAME']?> <br>
    				Sim số <?=str_replace('.', '', get_the_title())?> đăng ký thông tin sim chính chủ. 
				<?php else: ?>
				    <?php the_content() ?>
				<?php endif; ?>
			</div>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
