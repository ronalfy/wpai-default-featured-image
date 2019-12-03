<?php
/**
 * Set up the WP All Import to get a WooCommerce featured image.
 *
 * @package   WPAI_DFI
 */

namespace WPAI_DFI\WPAI;

/**
 * Class Featured_Image
 */
class Featured_Image {

	/**
	 * Initialize the Featured_Image component.
	 */
	public function init() {

	}

	/**
	 * Register any hooks that this component needs.
	 */
	public function register_hooks() {

		// WPAI Action after post save.
		add_action( 'pmxi_saved_post', array( $this, 'set_fallback_image' ), 100, 1 );
	}

	/**
	 * Sets a fallback image from WooCommerce
	 *
	 * Only works if WooCommerce fallback image is an integer and not a URL (string).
	 *
	 * @param int $post_id The post ID.
	 */
	public function set_fallback_image( $post_id ) {
		// Make sure it's a WooCommerce product.
		if ( 'product' !== get_post_type( $post_id ) ) {
			return;
		}

		// Check to see if the post has a featured image.
		if ( has_post_thumbnail( $post_id ) ) {
			return;
		}

		// No featured image, let's use the WooCommerce featured image.
		$featured_image_id = get_option( 'woocommerce_placeholder_image', false );

		// Featured Image may be a string, so return if it is.
		if ( ! is_int( $featured_image_id ) ) {
			return;
		}

		// Let's make sure the featured image is on the site.
		if ( ! empty( wp_get_attachment_image( $featured_image_id ) ) ) {
			set_post_thumbnail( $post_id, $featured_image_id );
			error_log( 'Setting default image for: ', $post_id );
		}
	}
}
