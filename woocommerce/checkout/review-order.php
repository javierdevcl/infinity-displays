<?php
/**
 * Review order table - Shopify Style
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
                    <?php echo wc_cart_totals_coupon_html($coupon); ?>
                </span>
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

    <!-- Payment Methods -->
    <div class="mt-6 pt-6 border-t border-gray-200">
        <h3 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
            </svg>
            Método de Pago
        </h3>

        <?php if (!WC()->cart->needs_payment()): ?>
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                <svg class="w-8 h-8 mx-auto text-green-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-green-700 font-medium">No se requiere pago</p>
            </div>
        <?php else: ?>
            <div id="payment" class="woocommerce-checkout-payment">
                <?php if (WC()->cart->needs_payment()): ?>
                    <ul class="wc_payment_methods payment_methods methods space-y-3">
                        <?php
                        if (!empty($available_gateways = WC()->payment_gateways->get_available_payment_gateways())) {
                            foreach ($available_gateways as $gateway) {
                                wc_get_template('checkout/payment-method.php', array('gateway' => $gateway));
                            }
                        } else {
                            echo '<li class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">';
                            echo '<p class="text-yellow-700">';
                            echo esc_html(apply_filters('woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__('Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce') : esc_html__('Please fill in your details above to see available payment methods.', 'woocommerce')));
                            echo '</p>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                <?php endif; ?>

                <div class="form-row place-order mt-6">
                    <noscript>
                        <?php
                        printf(
                            esc_html__('Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce'),
                            '<em>',
                            '</em>'
                        );
                        ?>
                        <br/>
                        <button type="submit" class="button alt wp-element-button" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e('Update totals', 'woocommerce'); ?>">
                            <?php esc_html_e('Update totals', 'woocommerce'); ?>
                        </button>
                    </noscript>

                    <?php wc_get_template('checkout/terms.php'); ?>

                    <?php do_action('woocommerce_review_order_before_submit'); ?>

                    <button type="submit" class="w-full py-4 px-6 bg-primary hover:bg-primary/90 text-white font-semibold text-lg rounded-lg transition-all duration-200 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl" name="woocommerce_checkout_place_order" id="place_order" value="<?php esc_attr_e('Place order', 'woocommerce'); ?>" data-value="<?php esc_attr_e('Place order', 'woocommerce'); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Finalizar Compra
                    </button>

                    <?php do_action('woocommerce_review_order_after_submit'); ?>

                    <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Secure Checkout Notice -->
    <div class="mt-6 pt-4 border-t border-gray-100">
        <div class="flex items-center justify-center gap-2 text-xs text-gray-500">
            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
            </svg>
            <span>Tu información está protegida con encriptación SSL</span>
        </div>
    </div>
</div>
