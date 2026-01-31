<?php
/**
 * Checkout Form
 *
 * @package Infinity_Displays
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

    <?php if ($checkout->get_checkout_fields()): ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Checkout Fields -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Billing Details -->
                <div class="bg-white rounded-xl border border-border overflow-hidden">
                    <div class="p-6 border-b border-border">
                        <h3 class="text-2xl font-display font-bold text-foreground flex items-center gap-2">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Información de Facturación
                        </h3>
                    </div>

                    <div class="p-6">
                        <?php do_action('woocommerce_checkout_billing'); ?>
                    </div>
                </div>

                <!-- Shipping Details -->
                <?php if (wc_ship_to_billing_address_only() && WC()->cart->needs_shipping()): ?>
                    <div class="bg-white rounded-xl border border-border overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-xl font-display font-bold text-foreground mb-4">Dirección de Envío</h3>
                            <p class="text-muted-foreground">La dirección de envío será la misma que la de facturación.</p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

                <!-- Order Notes -->
                <?php if (apply_filters('woocommerce_enable_order_notes_field', 'yes' === get_option('wc_checkout_order_notes_enabled'))): ?>
                    <?php if (!WC()->cart->needs_shipping() || wc_ship_to_billing_address_only()): ?>
                        <div class="bg-white rounded-xl border border-border overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-xl font-display font-bold text-foreground mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                    </svg>
                                    Notas del Pedido (Opcional)
                                </h3>
                                <?php foreach ($checkout->get_checkout_fields('order') as $key => $field): ?>
                                    <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            </div>

            <!-- Order Review -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl border border-border overflow-hidden sticky top-24">
                    <div class="p-6 border-b border-border">
                        <h3 class="text-xl font-display font-bold text-foreground flex items-center gap-2">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            Tu Pedido
                        </h3>
                    </div>

                    <div class="p-6">
                        <?php do_action('woocommerce_checkout_before_order_review'); ?>

                        <div id="order_review" class="woocommerce-checkout-review-order">
                            <?php do_action('woocommerce_checkout_order_review'); ?>
                        </div>

                        <?php do_action('woocommerce_checkout_after_order_review'); ?>
                    </div>
                </div>
            </div>

        </div>

    <?php endif; ?>

</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
