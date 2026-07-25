<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<!-- search -->
<div class="tp-shop-widget-search">
	<form role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<div class="tp-shop-widget-search-input">
			<input name="s" type="text" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr__( 'Search products', 'kindaid' ); ?>">
			<button type="submit">
			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M7.64993 14.2999C11.3226 14.2999 14.2999 11.3226 14.2999 7.64993C14.2999 3.97727 11.3226 1 7.64993 1C3.97727 1 1 3.97727 1 7.64993C1 11.3226 3.97727 14.2999 7.64993 14.2999Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M15.0001 15L13.6001 13.6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>                                          
			</button>
		</div>
	</form>
</div>
