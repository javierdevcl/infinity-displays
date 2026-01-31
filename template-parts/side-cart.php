<?php
/**
 * Side Cart Template
 *
 * @package Infinity_Displays
 */

defined('ABSPATH') || exit;
?>

<!-- Side Cart -->
<div id="side-cart" class="side-cart">
    <!-- Overlay -->
    <div class="side-cart-overlay" onclick="closeSideCart()"></div>

    <!-- Cart Panel -->
    <div class="side-cart-panel">
        <!-- Header -->
        <div class="side-cart-header">
            <h3 class="text-xl font-display font-bold text-foreground flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                Mi Carrito
                <span class="side-cart-count ml-auto text-sm font-medium bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center">
                    <?php echo WC()->cart->get_cart_contents_count(); ?>
                </span>
            </h3>
            <button onclick="closeSideCart()" class="text-muted-foreground hover:text-foreground transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Cart Items -->
        <div class="side-cart-items">
            <div class="side-cart-items-wrapper">
                <?php if (WC()->cart->is_empty()): ?>
                    <div class="text-center py-12">
                        <svg class="w-24 h-24 mx-auto text-muted-foreground opacity-50 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <p class="text-muted-foreground text-lg mb-4">Tu carrito está vacío</p>
                        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="inline-flex items-center px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors">
                            Explorar Productos
                        </a>
                    </div>
                <?php else: ?>
                    <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item):
                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0):
                            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                    ?>
                        <div class="side-cart-item" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                            <div class="flex gap-4">
                                <!-- Image -->
                                <a href="<?php echo esc_url($product_permalink); ?>" class="flex-shrink-0">
                                    <?php
                                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('thumbnail'), $cart_item, $cart_item_key);
                                    echo $thumbnail;
                                    ?>
                                </a>

                                <!-- Details -->
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-semibold text-foreground mb-1">
                                        <a href="<?php echo esc_url($product_permalink); ?>" class="hover:text-primary transition-colors">
                                            <?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)); ?>
                                        </a>
                                    </h4>

                                    <!-- Price -->
                                    <div class="text-sm text-primary font-semibold mb-2">
                                        <?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); ?>
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="flex items-center gap-2">
                                        <div class="flex items-center border border-border rounded">
                                            <button type="button"
                                                    class="cart-qty-minus px-2 py-1 hover:bg-secondary transition-colors"
                                                    data-cart-key="<?php echo esc_attr($cart_item_key); ?>">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                </svg>
                                            </button>
                                            <span class="px-3 py-1 text-sm font-medium">
                                                <?php echo $cart_item['quantity']; ?>
                                            </span>
                                            <button type="button"
                                                    class="cart-qty-plus px-2 py-1 hover:bg-secondary transition-colors"
                                                    data-cart-key="<?php echo esc_attr($cart_item_key); ?>">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Remove -->
                                        <button type="button"
                                                class="cart-remove-item text-muted-foreground hover:text-destructive transition-colors ml-auto"
                                                data-cart-key="<?php echo esc_attr($cart_item_key); ?>">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        endif;
                    endforeach;
                    ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Footer -->
        <div class="side-cart-footer">
            <?php if (!WC()->cart->is_empty()): ?>
                <div class="side-cart-footer-wrapper">
                    <!-- Subtotal -->
                    <div class="flex justify-between items-baseline mb-4 pb-4 border-b border-border">
                        <span class="text-muted-foreground">Subtotal:</span>
                        <span class="text-2xl font-bold text-foreground">
                            <?php echo WC()->cart->get_cart_subtotal(); ?>
                        </span>
                    </div>

                    <!-- Buttons -->
                    <div>
                        <a href="<?php echo wc_get_checkout_url(); ?>" class="block w-full px-6 py-3 text-center bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors">
                            Finalizar Compra
                        </a>
                    </div>

                    <p class="text-xs text-muted-foreground text-center mt-4">
                        Envío e impuestos calculados al finalizar
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
