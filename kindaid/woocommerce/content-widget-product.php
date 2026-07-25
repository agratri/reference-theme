<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

?>
<li>
	<div class="tp-shop-widget-product-item d-flex align-items-center">
		<div class="tp-shop-widget-product-thumb">
			<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
		<div class="tp-shop-widget-product-content">
			<?php if($product->get_average_rating() > 0): ?>
			<div class="tp-shop-widget-product-rating-wrapper d-flex align-items-center">
				<?php echo wc_get_rating_html( $product->get_average_rating() ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				
				<div class="tp-shop-widget-product-rating-number">
					<span>(<?php echo esc_html($product->get_average_rating()); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>)</span>
				</div>
			</div>
			<?php endif; ?>

			<h4 class="tp-shop-widget-product-title">
				<a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo wp_kses_post( $product->get_name() ); ?></a>
			</h4>
			<div class="tp-shop-widget-product-price-wrapper">
				<span class="tp-shop-widget-product-price">
					<?php echo wp_kses_post($product->get_price_html()); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</span>
			</div>
		</div>
	</div>
</li>
