<?php
/**
 * Cart Page
 *
 * @package Infinity_Displays
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<div class="woocommerce-cart-form-wrapper">
    <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
        <?php do_action('woocommerce_before_cart_table'); ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl border border-border overflow-hidden">
                    <div class="p-6 border-b border-border">
                        <h2 class="text-2xl font-display font-bold text-foreground">
                            Carrito de Compras
                            <span class="text-muted-foreground text-lg font-normal ml-2">
                                (<?php echo WC()->cart->get_cart_contents_count(); ?> productos)
                            </span>
                        </h2>
                    </div>

                    <?php if (WC()->cart->is_empty()): ?>
                        <div class="p-12 text-center">
                            <svg class="w-24 h-24 mx-auto text-muted-foreground opacity-50 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-foreground mb-2">Tu carrito está vacío</h3>
                            <p class="text-muted-foreground mb-6">Agrega productos para comenzar tu compra</p>
                            <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="inline-flex items-center px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Continuar Comprando
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="divide-y divide-border">
                            <?php
                            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                                    ?>
                                    <div class="cart-item p-6" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                                        <div class="flex gap-6">
                                            <!-- Image -->
                                            <div class="flex-shrink-0">
                                                <?php
                                                $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('thumbnail'), $cart_item, $cart_item_key);

                                                if (!$product_permalink) {
                                                    echo $thumbnail;
                                                } else {
                                                    printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail);
                                                }
                                                ?>
                                            </div>

                                            <!-- Details -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex justify-between gap-4 mb-3">
                                                    <div class="flex-1">
                                                        <h3 class="text-lg font-semibold text-foreground mb-1">
                                                            <?php
                                                            if (!$product_permalink) {
                                                                echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                                            } else {
                                                                echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s" class="hover:text-primary transition-colors">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                                                            }
                                                            ?>
                                                        </h3>

                                                        <?php
                                                        // Meta data
                                                        echo wc_get_formatted_cart_item_data($cart_item);

                                                        // Backorder notification
                                                        if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                                            echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                                                        }
                                                        ?>
                                                    </div>

                                                    <!-- Remove -->
                                                    <div>
                                                        <?php
                                                        echo apply_filters(
                                                            'woocommerce_cart_item_remove_link',
                                                            sprintf(
                                                                '<a href="%s" class="text-muted-foreground hover:text-destructive transition-colors" aria-label="%s" data-product_id="%s" data-product_sku="%s"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></a>',
                                                                esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                                esc_html__('Remove this item', 'woocommerce'),
                                                                esc_attr($product_id),
                                                                esc_attr($_product->get_sku())
                                                            ),
                                                            $cart_item_key
                                                        );
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="flex items-center justify-between flex-wrap gap-4">
                                                    <!-- Quantity -->
                                                    <div class="flex items-center gap-4">
                                                        <label class="text-sm text-muted-foreground">Cantidad:</label>
                                                        <?php
                                                        if ($_product->is_sold_individually()) {
                                                            $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                                        } else {
                                                            $product_quantity = woocommerce_quantity_input(
                                                                array(
                                                                    'input_name'   => "cart[{$cart_item_key}][qty]",
                                                                    'input_value'  => $cart_item['quantity'],
                                                                    'max_value'    => $_product->get_max_purchase_quantity(),
                                                                    'min_value'    => '0',
                                                                    'product_name' => $_product->get_name(),
                                                                    'classes'      => array('border border-border rounded-lg px-4 py-2 w-24 text-center'),
                                                                ),
                                                                $_product,
                                                                false
                                                            );
                                                        }

                                                        echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
                                                        ?>
                                                    </div>

                                                    <!-- Price -->
                                                    <div class="text-right">
                                                        <div class="text-sm text-muted-foreground mb-1">Precio</div>
                                                        <div class="text-2xl font-bold text-primary">
                                                            <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>

                        <!-- Actions -->
                        <div class="p-6 bg-secondary/30 flex flex-wrap gap-4 justify-between items-center">
                            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="inline-flex items-center px-6 py-3 border-2 border-border text-foreground font-medium rounded-lg hover:bg-secondary transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Continuar Comprando
                            </a>

                            <button type="submit" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>" class="inline-flex items-center px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Actualizar Carrito
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Cart Totals -->
            <div class="lg:col-span-1">
                <?php if (!WC()->cart->is_empty()): ?>
                    <div class="bg-white rounded-xl border border-border overflow-hidden sticky top-24">
                        <div class="p-6 border-b border-border">
                            <h3 class="text-xl font-display font-bold text-foreground">Resumen del Pedido</h3>
                        </div>

                        <div class="p-6">
                            <?php woocommerce_cart_totals(); ?>

                            <?php do_action('woocommerce_proceed_to_checkout'); ?>

                            <div class="mt-6 p-4 bg-secondary/50 rounded-lg">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div class="text-sm text-muted-foreground">
                                        <p class="font-medium text-foreground mb-1">Envío calculado al finalizar</p>
                                        <p>Los costos de envío se calculan según tu ubicación y el peso del pedido.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <?php do_action('woocommerce_cart_contents'); ?>
        <?php do_action('woocommerce_after_cart_contents'); ?>

        <?php do_action('woocommerce_after_cart_table'); ?>

        <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
    </form>
</div>

<?php do_action('woocommerce_after_cart'); ?>
