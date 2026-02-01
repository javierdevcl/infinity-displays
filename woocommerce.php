<?php
/**
 * WooCommerce Template
 *
 * @package Infinity_Displays
 */

// Check if we're on checkout page - use minimal header/footer
if (is_checkout() && !is_wc_endpoint_url()) {
    // Checkout uses its own header/footer inside form-checkout.php
    woocommerce_content();
} else {
    // Regular WooCommerce pages use standard header/footer
    get_header();
    ?>

    <main class="container mx-auto px-4 py-8">
        <?php woocommerce_content(); ?>
    </main>

    <?php
    get_footer();
}
