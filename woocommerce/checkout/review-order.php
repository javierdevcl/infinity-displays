<?php
/**
 * Review order table - Shopify Style
 * Only shows totals - payment methods handled by WooCommerce default
 *
 * @package Infinity_Displays
 */

defined('ABSPATH') || exit;
?>

<div class="woocommerce-checkout-review-order-table-wrapper">

    <!-- Totals -->
    <div class="space-y-3 text-sm">
        <!-- Subtotal -->
        <div class="flex justify-between items-center">
            <span class="text-gray-600">Subtotal</span>
            <span class="text-gray-900 font-medium"><?php wc_cart_totals_subtotal_html(); ?></span>
        </div>

        <!-- Coupons -->
        <?php foreach (WC()->cart->get_coupons() as $code => $coupon): ?>
            <div class="flex justify-between items-center text-green-600">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <?php echo esc_html($code); ?>
                </span>
                <span><?php wc_cart_totals_coupon_html($coupon); ?></span>
            </div>
        <?php endforeach; ?>

        <!-- Shipping -->
        <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()): ?>
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Envío</span>
                <span class="text-gray-900">
                    <?php wc_cart_totals_shipping_html(); ?>
                </span>
            </div>
        <?php endif; ?>

        <!-- Fees -->
        <?php foreach (WC()->cart->get_fees() as $fee): ?>
            <div class="flex justify-between items-center">
                <span class="text-gray-600"><?php echo esc_html($fee->name); ?></span>
                <span class="text-gray-900"><?php wc_cart_totals_fee_html($fee); ?></span>
            </div>
        <?php endforeach; ?>

        <!-- Taxes (if itemized) -->
        <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()): ?>
            <?php if ('itemized' === get_option('woocommerce_tax_total_display')): ?>
                <?php foreach (WC()->cart->get_tax_totals() as $code => $tax): ?>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600"><?php echo esc_html($tax->label); ?></span>
                        <span class="text-gray-900"><?php echo wp_kses_post($tax->formatted_amount); ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600"><?php echo esc_html(WC()->countries->tax_or_vat()); ?></span>
                    <span class="text-gray-900"><?php wc_cart_totals_taxes_total_html(); ?></span>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php do_action('woocommerce_review_order_before_order_total'); ?>

        <!-- Total -->
        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
            <span class="text-lg font-semibold text-gray-900">Total</span>
            <span class="text-xl font-bold text-gray-900"><?php wc_cart_totals_order_total_html(); ?></span>
        </div>

        <?php do_action('woocommerce_review_order_after_order_total'); ?>
    </div>

</div>
