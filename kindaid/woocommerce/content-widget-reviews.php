<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-reviews.php
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

$comment = get_comment();
$product_id = $comment->comment_post_ID;

$product = wc_get_product($product_id);

// var_dump($product);

?>
<div class="tp-shop-widget-product-item d-flex align-items-center">
	<div class="tp-shop-widget-product-thumb">
		<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php echo wp_kses_post($product->get_image()); ?>
		</a>
	</div>
	<div class="tp-shop-widget-product-content">
		<div class="tp-shop-widget-product-rating-wrapper d-flex align-items-center">
			<?php echo wc_get_rating_html( intval( get_comment_meta( $comment->comment_ID, 'rating', true ) ) ); ?>
		</div>
		<h4 class="tp-shop-widget-product-title">
			<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php echo wp_kses_post( $product->get_name() ); ?></a>
		</h4>
		<div class="tp-shop-widget-product-price-wrapper">
			<span class="tp-shop-widget-product-price"><?php echo wc_price($product->get_price()); ?></span>
		</div>
	</div>
</div>
