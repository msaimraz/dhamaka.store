<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 40.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop, $road_opt;

if($road_shopclass=='shop-fullwidth') {
	if(isset($road_opt)){
		$woocommerce_loop['columns'] = $road_opt['product_per_row_fw'];
		$colwidth = round(12/$woocommerce_loop['columns']);
	}
	$col_classes = ' item-col col-xs-12 col-sm-4 col-md-'.$colwidth ;
} else {
	if(isset($road_opt)){
		$woocommerce_loop['columns'] = $road_opt['product_per_row'];
		$colwidth = round(12/$woocommerce_loop['columns']);
	}
	$col_classes = ' item-col col-xs-12 col-sm-'.$colwidth ;
}
?>
<div <?php wc_product_cat_class($col_classes); ?>>
	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	

		<?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );
		?>

		<span>
			<?php
				echo esc_html($category->name);

				if ( $category->count > 0 )
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
			?>
		</span>

		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>


	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
</div>
