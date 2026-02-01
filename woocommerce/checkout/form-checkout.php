<?php
/**
 * Checkout Form - Shopify Style
 *
 * @package Infinity_Displays
 */

defined('ABSPATH') || exit;

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo '<div class="min-h-screen flex items-center justify-center bg-gray-50">';
    echo '<div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200 text-center max-w-md">';
    echo '<svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>';
    echo '<h2 class="text-xl font-semibold text-gray-900 mb-2">Inicia sesión para continuar</h2>';
    echo '<p class="text-gray-600 mb-4">Debes iniciar sesión para completar tu compra.</p>';
    echo '<a href="' . esc_url(wc_get_page_permalink('myaccount')) . '" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90">Iniciar Sesión</a>';
    echo '</div></div>';
    return;
}

$cart_items = WC()->cart->get_cart();
$cart_count = WC()->cart->get_cart_contents_count();
$cart_total = WC()->cart->get_total();
?>

<div class="checkout-shopify bg-gray-50 min-h-screen flex flex-col">
    <?php do_action('woocommerce_before_checkout_form', $checkout); ?>

    <form name="checkout" method="post" class="checkout woocommerce-checkout flex-1" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="checkout-grid">

                <!-- Left Column - Form -->
                <div class="checkout-main">

                    <?php if ($checkout->get_checkout_fields()): ?>

                    <!-- Express Checkout -->
                    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
                        <div class="text-center mb-4">
                            <span class="text-sm text-gray-500">Pago rápido</span>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="https://wa.me/56942057591?text=<?php echo urlencode('Hola, quiero finalizar mi compra de ' . $cart_count . ' producto(s)'); ?>" target="_blank" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3 bg-green-500 text-white font-medium rounded-lg hover:bg-green-600 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                Pagar por WhatsApp
                            </a>
                        </div>
                        <div class="relative my-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-white text-gray-500">O completa el formulario</span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden mb-6">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                            <div class="flex items-center justify-between">
                                <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                    <span class="w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center text-sm font-bold">1</span>
                                    Información de Contacto
                                </h2>
                                <?php if (!is_user_logged_in()): ?>
                                <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="text-sm text-primary hover:underline">
                                    ¿Ya tienes cuenta? Inicia sesión
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="p-6">
                            <?php do_action('woocommerce_checkout_billing'); ?>
                        </div>
                    </div>

                    <!-- Shipping -->
                    <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()): ?>
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden mb-6">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                            <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <span class="w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center text-sm font-bold">2</span>
                                Método de Envío
                            </h2>
                        </div>
                        <div class="p-6">
                            <?php do_action('woocommerce_checkout_shipping'); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Order Notes -->
                    <?php if (apply_filters('woocommerce_enable_order_notes_field', 'yes' === get_option('woocommerce_enable_order_comments', 'yes'))): ?>
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden mb-6">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                            <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                                Notas del Pedido
                                <span class="text-sm font-normal text-gray-500">(opcional)</span>
                            </h2>
                        </div>
                        <div class="p-6">
                            <?php foreach ($checkout->get_checkout_fields('order') as $key => $field): ?>
                                <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php endif; ?>

                </div>

                <!-- Right Column - Order Summary -->
                <div class="checkout-sidebar">
                    <div class="checkout-sidebar-inner bg-white rounded-lg border border-gray-200 overflow-hidden">
                        <!-- Mobile Toggle -->
                        <button type="button" class="checkout-mobile-toggle w-full px-6 py-4 flex items-center justify-between border-b border-gray-200 bg-gray-50" onclick="this.closest('.bg-white').querySelector('.order-summary-content').classList.toggle('hidden')">
                            <span class="flex items-center gap-2 font-medium text-gray-900">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Resumen del pedido
                                <span class="bg-primary text-white text-xs px-2 py-0.5 rounded-full"><?php echo $cart_count; ?></span>
                            </span>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div class="order-summary-content hidden lg:block">
                            <!-- Products List -->
                            <div class="p-6 border-b border-gray-100 max-h-80 overflow-y-auto">
                                <?php foreach ($cart_items as $cart_item_key => $cart_item):
                                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0):
                                        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                                ?>
                                <div class="flex gap-4 py-3 <?php echo ($cart_item !== end($cart_items)) ? 'border-b border-gray-100' : ''; ?>">
                                    <div class="relative flex-shrink-0">
                                        <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                                            <?php echo $_product->get_image('thumbnail', array('class' => 'w-full h-full object-cover')); ?>
                                        </div>
                                        <span class="absolute -top-2 -right-2 w-5 h-5 bg-gray-500 text-white text-xs rounded-full flex items-center justify-center font-medium">
                                            <?php echo $cart_item['quantity']; ?>
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 truncate">
                                            <?php echo $_product->get_name(); ?>
                                        </h4>
                                        <?php echo wc_get_formatted_cart_item_data($cart_item); ?>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">
                                        <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
                                    </div>
                                </div>
                                <?php endif; endforeach; ?>
                            </div>

                            <!-- Coupon -->
                            <?php if (wc_coupons_enabled()): ?>
                            <div class="p-6 border-b border-gray-100">
                                <div class="flex gap-2">
                                    <input type="text" name="coupon_code" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary" placeholder="Código de descuento" id="coupon_code">
                                    <button type="button" class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors text-sm" onclick="jQuery('form.checkout').append('<input type=\'hidden\' name=\'apply_coupon\' value=\'1\'>'); jQuery('[name=coupon_code]').val(jQuery('#coupon_code').val()); jQuery('form.checkout').submit();">
                                        Aplicar
                                    </button>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- Order Review -->
                            <div class="p-6">
                                <?php do_action('woocommerce_checkout_before_order_review'); ?>

                                <div id="order_review" class="woocommerce-checkout-review-order">
                                    <?php do_action('woocommerce_checkout_order_review'); ?>
                                </div>

                                <?php do_action('woocommerce_checkout_after_order_review'); ?>
                            </div>
                        </div>

                        <!-- Trust Badges -->
                        <div class="p-6 bg-gray-50 border-t border-gray-100">
                            <div class="flex items-center justify-center gap-4 text-xs text-gray-500">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Pago Seguro</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    <span>Garantía</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    <span>SSL Encriptado</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </form>

    <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
</div>
