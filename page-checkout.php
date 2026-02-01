<?php
/**
 * Template Name: Checkout Shopify
 * Template for WooCommerce checkout page with minimal header/footer
 *
 * @package Infinity_Displays
 */

defined('ABSPATH') || exit;

get_header('checkout');
?>

<main class="flex-1">
    <?php
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>
</main>

<?php
get_footer('checkout');
