<?php
/**
 * WooCommerce Customizations
 *
 * @package Infinity_Displays
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Remove default WooCommerce single product hooks to use custom template
 */
function infinity_remove_default_product_hooks() {
    // Only remove hooks on single product pages
    if (is_product()) {
        // Remove default product image hooks
        remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

        // Remove default product summary hooks
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

        // Remove default tabs
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

        // Remove related products (we'll add them manually in our template)
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    }
}
add_action('wp', 'infinity_remove_default_product_hooks');

/**
 * Force custom category template to load
 */
function infinity_force_category_template($template) {
    if (is_product_category()) {
        $custom_template = get_template_directory() . '/woocommerce/archive-product.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    return $template;
}
add_filter('template_include', 'infinity_force_category_template', 99);

/**
 * Remove WooCommerce default elements from category pages
 */
function infinity_remove_category_default_hooks() {
    if (is_product_category()) {
        // Remove result count and ordering
        remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
        remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    }
}
add_action('wp', 'infinity_remove_category_default_hooks');

/**
 * Change add to cart text for products
 */
function infinity_custom_add_to_cart_text($text, $product) {
    if ($product->is_type('simple')) {
        return __('Agregar', 'infinity-displays');
    }
    return $text;
}
add_filter('woocommerce_product_add_to_cart_text', 'infinity_custom_add_to_cart_text', 10, 2);
add_filter('woocommerce_product_single_add_to_cart_text', 'infinity_custom_add_to_cart_text', 10, 2);

/**
 * Disable WooCommerce notices (using custom AJAX notifications instead)
 */
add_filter('wc_add_to_cart_message_html', '__return_false');
add_filter('woocommerce_cart_redirect_after_error', '__return_false');

/**
 * Custom WooCommerce pagination
 */
function infinity_pagination_args($args) {
    $args['prev_text'] = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>';
    $args['next_text'] = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
    return $args;
}
add_filter('woocommerce_pagination_args', 'infinity_pagination_args');

/**
 * Add custom product fields in admin
 */
function infinity_add_product_features_field() {
    global $post;

    echo '<div class="options_group">';

    // Features field
    $features = get_post_meta($post->ID, '_product_features', true);
    $features_text = is_array($features) ? implode("\n", $features) : '';

    ?>
    <p class="form-field">
        <label for="product_features"><?php _e('Características del Producto', 'infinity-displays'); ?></label>
        <textarea
            id="product_features"
            name="product_features"
            rows="5"
            style="width: 100%;"
            placeholder="<?php _e('Una característica por línea', 'infinity-displays'); ?>"
        ><?php echo esc_textarea($features_text); ?></textarea>
        <span class="description"><?php _e('Ingrese una característica por línea. Estas se mostrarán en la página del producto.', 'infinity-displays'); ?></span>
    </p>
    <?php

    echo '</div>';
}
add_action('woocommerce_product_options_general_product_data', 'infinity_add_product_features_field');

/**
 * Save custom product fields
 */
function infinity_save_product_features_field($post_id) {
    $features = isset($_POST['product_features']) ? $_POST['product_features'] : '';

    if (!empty($features)) {
        $features_array = array_filter(array_map('trim', explode("\n", $features)));
        update_post_meta($post_id, '_product_features', $features_array);
    } else {
        delete_post_meta($post_id, '_product_features');
    }
}
add_action('woocommerce_process_product_meta', 'infinity_save_product_features_field');

/**
 * Customize WooCommerce breadcrumb
 */
function infinity_woocommerce_breadcrumbs() {
    return array(
        'delimiter'   => '<span class="breadcrumb-separator">/</span>',
        'wrap_before' => '<nav class="woocommerce-breadcrumb">',
        'wrap_after'  => '</nav>',
        'before'      => '',
        'after'       => '',
        'home'        => _x('Inicio', 'breadcrumb', 'infinity-displays'),
    );
}
add_filter('woocommerce_breadcrumb_defaults', 'infinity_woocommerce_breadcrumbs');

/**
 * Display WhatsApp quote button on product page
 */
function infinity_add_whatsapp_quote_button() {
    global $product;

    $phone = '+56942057591';
    $product_name = $product->get_name();
    $product_price = $product->get_price();

    ?>
    <div class="infinity-whatsapp-quote mt-4">
        <button
            type="button"
            class="button alt infinity-quote-btn"
            data-product-name="<?php echo esc_attr($product_name); ?>"
            data-product-price="<?php echo esc_attr($product_price); ?>"
        >
            <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            Cotizar por WhatsApp
        </button>
    </div>
    <?php
}
// Note: This is handled in single-product.php template

/**
 * Remove WooCommerce default sorting dropdown styles
 */
function infinity_remove_woo_sorting_styles() {
    wp_dequeue_style('woocommerce-general');
    wp_dequeue_style('woocommerce-layout');
    wp_dequeue_style('woocommerce-smallscreen');
}
add_action('wp_enqueue_scripts', 'infinity_remove_woo_sorting_styles', 100);

/**
 * Customize WooCommerce account menu items
 */
function infinity_custom_my_account_menu_items($items) {
    // Reorder menu items
    $new_items = array();

    if (isset($items['dashboard'])) {
        $new_items['dashboard'] = 'Panel';
    }
    if (isset($items['orders'])) {
        $new_items['orders'] = 'Mis Pedidos';
    }
    if (isset($items['downloads'])) {
        $new_items['downloads'] = 'Descargas';
    }
    if (isset($items['edit-address'])) {
        $new_items['edit-address'] = 'Direcciones';
    }
    if (isset($items['edit-account'])) {
        $new_items['edit-account'] = 'Datos de Cuenta';
    }
    if (isset($items['customer-logout'])) {
        $new_items['customer-logout'] = 'Cerrar Sesión';
    }

    return $new_items;
}
add_filter('woocommerce_account_menu_items', 'infinity_custom_my_account_menu_items');

/**
 * Change number of related products
 */
function infinity_related_products_args($args) {
    $args['posts_per_page'] = 4;
    $args['columns'] = 4;
    return $args;
}
add_filter('woocommerce_output_related_products_args', 'infinity_related_products_args');

/**
 * Hide WooCommerce coupon field on checkout (optional)
 */
// function infinity_hide_coupon_field($enabled) {
//     return false;
// }
// add_filter('woocommerce_coupons_enabled', 'infinity_hide_coupon_field');

/**
 * Customize "Out of Stock" text
 */
function infinity_custom_out_of_stock_text($text, $product) {
    return 'Agotado - Consulte disponibilidad';
}
add_filter('woocommerce_get_availability_text', 'infinity_custom_out_of_stock_text', 10, 2);

/**
 * AJAX: Update cart item quantity
 */
function infinity_update_cart_item_qty() {
    if (!isset($_POST['cart_item_key']) || !isset($_POST['quantity'])) {
        wp_send_json_error('Missing parameters');
        return;
    }

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);

    if ($quantity === 0) {
        WC()->cart->remove_cart_item($cart_item_key);
    } else {
        WC()->cart->set_quantity($cart_item_key, $quantity, true);
    }

    WC()->cart->calculate_totals();

    wp_send_json_success(array(
        'fragments' => apply_filters('woocommerce_add_to_cart_fragments', array()),
        'cart_hash' => WC()->cart->get_cart_hash(),
    ));
}
add_action('wc_ajax_update_cart_item_qty', 'infinity_update_cart_item_qty');
add_action('wp_ajax_update_cart_item_qty', 'infinity_update_cart_item_qty');
add_action('wp_ajax_nopriv_update_cart_item_qty', 'infinity_update_cart_item_qty');

/**
 * Enable AJAX add to cart for all products
 */
function infinity_enable_ajax_add_to_cart() {
    return true;
}
add_filter('woocommerce_product_add_to_cart_ajax', 'infinity_enable_ajax_add_to_cart');

/**
 * Add cart fragments for side cart
 */
function infinity_add_to_cart_fragments($fragments) {
    // Cart count in header
    ob_start();
    echo WC()->cart->get_cart_contents_count();
    $fragments['.cart-count'] = ob_get_clean();

    // Side cart count
    ob_start();
    ?>
    <span class="side-cart-count ml-auto text-sm font-medium bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </span>
    <?php
    $fragments['.side-cart-count'] = ob_get_clean();

    // Side cart items content
    ob_start();
    ?>
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
    <?php
    $fragments['.side-cart-items-wrapper'] = ob_get_clean();

    // Side cart footer
    ob_start();
    if (!WC()->cart->is_empty()):
    ?>
    <div class="side-cart-footer-wrapper">
        <!-- Subtotal -->
        <div class="flex justify-between items-baseline mb-4 pb-4 border-b border-border">
            <span class="text-muted-foreground">Subtotal:</span>
            <span class="text-2xl font-bold text-foreground">
                <?php echo WC()->cart->get_cart_subtotal(); ?>
            </span>
        </div>

        <!-- Buttons -->
        <div class="space-y-2">
            <a href="<?php echo wc_get_cart_url(); ?>" class="block w-full px-6 py-3 text-center border-2 border-primary text-primary font-semibold rounded-lg hover:bg-primary/5 transition-colors">
                Ver Carrito
            </a>
            <a href="<?php echo wc_get_checkout_url(); ?>" class="block w-full px-6 py-3 text-center bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors">
                Finalizar Compra
            </a>
        </div>

        <p class="text-xs text-muted-foreground text-center mt-4">
            Envío e impuestos calculados al finalizar
        </p>
    </div>
    <?php
    endif;
    $fragments['.side-cart-footer-wrapper'] = ob_get_clean();

    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'infinity_add_to_cart_fragments');
