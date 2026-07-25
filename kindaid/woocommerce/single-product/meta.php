<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */

use Automattic\WooCommerce\Enums\ProductType;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

    $pro_cat = get_the_terms(get_the_ID(),'product_cat');
    $pro_tags = get_the_terms(get_the_ID(),'product_tag');
?>


<div class="tp-product-details-query mb-40">
	<div class="tp-product-details-query-item d-flex align-items-center">
		<span><?php esc_html_e( 'SKU:', 'kindaid' ); ?>  </span>
		<p><?php echo esc_html( $sku = $product->get_sku() ) ? esc_html($sku) : esc_html__( 'N/A', 'kindaid' ); ?></p>
	</div>

	<?php if ( ! empty( $pro_cat ) && ! is_wp_error( $pro_cat ) ) : ?> 
	<div class="tp-product-details-query-item d-flex align-items-center">
		<span><?php esc_html_e( 'Category:', 'kindaid' ); ?>  </span>
		<?php 
			$html = '';
			foreach($pro_cat as $key => $cat) {
			$html .= '<p>' .$cat->name. '</p>, ';
			}
			echo rtrim($html,', '); 
		?>
	</div>
	<?php endif; ?>

	<?php if ( ! empty( $pro_tags ) && ! is_wp_error( $pro_tags ) ) : ?> 
	<div class="tp-product-details-query-item d-flex align-items-center">
		<span>Tag: </span>
		<?php 
			$html = '';
			foreach($pro_tags as $key => $tag) {
			$html .= '<p>' .$tag->name. '</p>, ';
			}
			echo rtrim($html,', '); 
		?>
	</div>
	<?php endif; ?>
</div>
