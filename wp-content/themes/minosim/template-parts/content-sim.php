<?php
/**
 * Template part for displaying sim
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MinoSim
 */

?>

<tr id="post-<?php the_ID(); ?>">
	<td class="align-middle d-none d-md-table-cell"><?=$wp_query->current_post + 1;?></td>
	<td class="align-middle so-sim">
		<a href="<?=get_the_permalink()?>" title="<?php the_title()?>">
			<?php the_title()?>
		</a>
	</td>
	<td class="align-middle d-none d-md-table-cell network-td">
	    <?php
	        $nhaMang = getTenNhaMang(get_the_title());
	        $nhaMangLower = strtolower($nhaMang);
	    ?>
		<a href="<?php echo home_url('/') . 'sim-' . $nhaMangLower;?>/" title="<?php echo $nhaMang;?>">
		    <img src="<?php echo get_template_directory_uri(); ?>/images/sim/<?php echo $nhaMangLower;?>.gif" alt="<?php echo $nhaMang;?>">
		</a>
	</td>
	<td class="align-middle"><?=getGia(get_the_ID())?></td>
	<td class="align-middle d-none d-md-table-cell">
		<?php echo getLoaiSim(get_the_title()); ?>
	</td>
	<td class="align-middle">
		<a class="btn btn-primary btn-sm" href="<?=get_the_permalink()?>">Đặt mua</a>
	</td>
</tr>