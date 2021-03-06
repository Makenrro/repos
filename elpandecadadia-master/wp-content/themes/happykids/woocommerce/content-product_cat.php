<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

 // Store column count for displaying the grid
$gen_sets = theme_get_option('general', 'gen_sets');
$gen_template = ( isset($gen_sets['_gen_woo_template_select']) ) ? $gen_sets['_gen_woo_template_select'] : 'right';
if ($gen_template == 'full'){
	 $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
} else {
	 $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
}

// Increase loop count
$woocommerce_loop['loop']++;
?>
<li class="product-category product<?php
    if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1 )
        echo ' first';
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo ' last';
	?>">
	<div class="content-wrapper">
		<figure>

			<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

			<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" >
				<?php 
					/**
					 * woocommerce_before_subcategory_title hook
					 *
					 * @hooked woocommerce_subcategory_thumbnail - 10
					 */
					do_action( 'woocommerce_before_subcategory_title', $category );
				?>
			<a/>
		</figure>
	</div>
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
			<div class="title">
				<?php
					echo $category->name;
					if ( $category->count > 0 )
						echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
				?>
			</div>
		</a>
		<?php
			if($category->description) {
				echo ($category->description);
			}
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	</a>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</li>
