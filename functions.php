<?php
/**
 * Infinity Displays Theme Functions
 *
 * @package Infinity_Displays
 */

if (!defined('ABSPATH')) {
    exit;
}

// Theme constants
define('INFINITY_VERSION', '1.4.0');
define('INFINITY_THEME_DIR', get_template_directory());
define('INFINITY_THEME_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function infinity_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('customize-selective-refresh-widgets');

    // WooCommerce support
    add_theme_support('woocommerce');
    // Disabled gallery features to use custom template
    // add_theme_support('wc-product-gallery-zoom');
    // add_theme_support('wc-product-gallery-lightbox');
    // add_theme_support('wc-product-gallery-slider');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'infinity-displays'),
        'top-menu' => __('Menú Superior', 'infinity-displays'),
        'categories' => __('Menú de Categorías', 'infinity-displays'),
        'footer' => __('Menú Footer', 'infinity-displays'),
        'footer-products' => __('Menú Footer Productos', 'infinity-displays'),
    ));

    // Image sizes for products
    add_image_size('infinity-product-thumb', 400, 400, true);
    add_image_size('infinity-product-large', 800, 800, true);
}
add_action('after_setup_theme', 'infinity_theme_setup');

/**
 * Custom Walker for Mobile Menu
 * Generates flat HTML structure for JavaScript-driven drill-down navigation
 */
class Infinity_Mobile_Menu_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $has_children = !empty($item->classes) && in_array('menu-item-has-children', $item->classes);
        $classes = 'mobile-menu-item';

        if ($has_children) {
            $classes .= ' has-children';
            // For items with children, create a button that triggers submenu
            $output .= '<button class="' . esc_attr($classes) . '" data-submenu="submenu-' . $item->ID . '" data-title="' . esc_attr($item->title) . '" data-link="' . esc_url($item->url) . '">';
            $output .= esc_html($item->title);
            $output .= '<svg class="mobile-menu-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
            $output .= '</button>';
        } else {
            // Regular links
            $output .= '<a class="' . esc_attr($classes) . '" href="' . esc_url($item->url) . '">';
            $output .= esc_html($item->title);
            $output .= '</a>';
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        // No closing needed for our flat structure
    }

    public function start_lvl(&$output, $depth = 0, $args = null) {
        // Store submenu items in a hidden container for JS to use
        $output .= '<div class="mobile-submenu-data hidden">';
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</div>';
    }
}

/**
 * Enqueue styles and scripts
 */
function infinity_enqueue_scripts() {
    // Tailwind CSS (compiled from src/input.css)
    wp_enqueue_style('infinity-tailwind', INFINITY_THEME_URI . '/assets/css/tailwind.css', array(), INFINITY_VERSION);

    // Main theme styles (custom CSS)
    wp_enqueue_style('infinity-style', get_stylesheet_uri(), array('infinity-tailwind'), INFINITY_VERSION);
    wp_enqueue_style('infinity-main', INFINITY_THEME_URI . '/assets/css/main.css', array('infinity-tailwind'), INFINITY_VERSION);

    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap', array(), null);

    // Force WooCommerce scripts to load on all pages (needed for AJAX cart)
    if (class_exists('WooCommerce')) {
        wp_enqueue_script('wc-cart-fragments');
        wp_enqueue_script('wc-add-to-cart');
    }

    // Theme scripts
    wp_enqueue_script('infinity-main', INFINITY_THEME_URI . '/assets/js/main.js', array('jquery'), INFINITY_VERSION, true);
    wp_enqueue_script('infinity-quote-modal', INFINITY_THEME_URI . '/assets/js/quote-modal.js', array(), INFINITY_VERSION, true);
    wp_enqueue_script('infinity-video-lightbox', INFINITY_THEME_URI . '/assets/js/video-lightbox.js', array(), INFINITY_VERSION, true);
    wp_enqueue_script('infinity-side-cart', INFINITY_THEME_URI . '/assets/js/side-cart.js', array('jquery', 'wc-add-to-cart'), INFINITY_VERSION, true);

    // Localize script for AJAX
    wp_localize_script('infinity-main', 'infinityAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('infinity-nonce'),
    ));

    wp_localize_script('infinity-quote-modal', 'infinityQuote', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('infinity-quote-nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'infinity_enqueue_scripts');

/**
 * Custom User Role: Socio (Wholesaler)
 */
function infinity_add_socio_role() {
    if (!get_role('socio')) {
        add_role(
            'socio',
            __('Socio Mayorista', 'infinity-displays'),
            array(
                'read' => true,
                'edit_posts' => false,
                'delete_posts' => false,
            )
        );
    }
}
add_action('init', 'infinity_add_socio_role');

/**
 * Custom Product Fields for Volume Pricing
 */
function infinity_add_custom_product_fields() {
    echo '<div class="options_group">';

    // Retail Price (Base - 1-5 units)
    woocommerce_wp_text_input(array(
        'id' => '_retail_price',
        'label' => __('Precio Base (1-5 unidades)', 'infinity-displays'),
        'desc_tip' => true,
        'description' => __('Precio para compras de 1 a 5 unidades', 'infinity-displays'),
        'type' => 'number',
        'custom_attributes' => array(
            'step' => 'any',
            'min' => '0',
        ),
    ));

    // Wholesale Price (Socio - 6-23 units)
    woocommerce_wp_text_input(array(
        'id' => '_wholesale_price',
        'label' => __('Precio Socio (6-23 unidades)', 'infinity-displays'),
        'desc_tip' => true,
        'description' => __('Precio para socios mayoristas, compras de 6 a 23 unidades', 'infinity-displays'),
        'type' => 'number',
        'custom_attributes' => array(
            'step' => 'any',
            'min' => '0',
        ),
    ));

    // Bulk Price (Preventa - 24+ units)
    woocommerce_wp_text_input(array(
        'id' => '_bulk_price',
        'label' => __('Precio Preventa (24+ unidades)', 'infinity-displays'),
        'desc_tip' => true,
        'description' => __('Precio para compras al por mayor, 24 unidades o más (embalaje)', 'infinity-displays'),
        'type' => 'number',
        'custom_attributes' => array(
            'step' => 'any',
            'min' => '0',
        ),
    ));

    echo '</div>';
}
add_action('woocommerce_product_options_pricing', 'infinity_add_custom_product_fields');

/**
 * Save Custom Product Fields
 */
function infinity_save_custom_product_fields($post_id) {
    $retail_price = isset($_POST['_retail_price']) ? sanitize_text_field($_POST['_retail_price']) : '';
    $wholesale_price = isset($_POST['_wholesale_price']) ? sanitize_text_field($_POST['_wholesale_price']) : '';
    $bulk_price = isset($_POST['_bulk_price']) ? sanitize_text_field($_POST['_bulk_price']) : '';

    update_post_meta($post_id, '_retail_price', $retail_price);
    update_post_meta($post_id, '_wholesale_price', $wholesale_price);
    update_post_meta($post_id, '_bulk_price', $bulk_price);
}
add_action('woocommerce_process_product_meta', 'infinity_save_custom_product_fields');

/**
 * Dynamic Product Pricing Based on Quantity
 */
function infinity_dynamic_product_pricing($price, $product) {
    // Get cart quantity for this product
    $cart_quantity = 0;
    if (WC()->cart) {
        foreach (WC()->cart->get_cart() as $cart_item) {
            if ($cart_item['product_id'] == $product->get_id()) {
                $cart_quantity += $cart_item['quantity'];
            }
        }
    }

    // Get custom prices
    $retail_price = get_post_meta($product->get_id(), '_retail_price', true);
    $wholesale_price = get_post_meta($product->get_id(), '_wholesale_price', true);
    $bulk_price = get_post_meta($product->get_id(), '_bulk_price', true);

    // Determine price based on quantity
    if ($cart_quantity >= 24 && !empty($bulk_price)) {
        return $bulk_price;
    } elseif ($cart_quantity >= 6 && !empty($wholesale_price)) {
        return $wholesale_price;
    } elseif (!empty($retail_price)) {
        return $retail_price;
    }

    return $price;
}
add_filter('woocommerce_product_get_price', 'infinity_dynamic_product_pricing', 10, 2);
add_filter('woocommerce_product_variation_get_price', 'infinity_dynamic_product_pricing', 10, 2);

/**
 * Get Volume Pricing Info
 */
function infinity_get_volume_pricing($product_id) {
    return array(
        'retail' => get_post_meta($product_id, '_retail_price', true),
        'wholesale' => get_post_meta($product_id, '_wholesale_price', true),
        'bulk' => get_post_meta($product_id, '_bulk_price', true),
    );
}

/**
 * WhatsApp Quote Link Generator
 */
function infinity_whatsapp_quote_link($phone = '+56942057591', $message = '') {
    $phone = preg_replace('/[^0-9+]/', '', $phone);
    $encoded_message = urlencode($message);
    return "https://wa.me/{$phone}?text={$encoded_message}";
}

/**
 * AJAX Handler for Quote Form
 */
function infinity_handle_quote_form() {
    check_ajax_referer('infinity-nonce', 'nonce');

    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $company = sanitize_text_field($_POST['company'] ?? '');
    $cart_items = sanitize_textarea_field($_POST['cart_items'] ?? '');

    // Build WhatsApp message
    $message = "Hola! Mi nombre es {$name} de {$company}.\n\n";
    $message .= "Solicito cotización para:\n{$cart_items}\n\n";
    $message .= "Datos de contacto:\n";
    $message .= "Email: {$email}\n";
    $message .= "Teléfono: {$phone}";

    $whatsapp_link = infinity_whatsapp_quote_link('+56942057591', $message);

    wp_send_json_success(array('whatsapp_link' => $whatsapp_link));
}
add_action('wp_ajax_infinity_quote_form', 'infinity_handle_quote_form');
add_action('wp_ajax_nopriv_infinity_quote_form', 'infinity_handle_quote_form');

/**
 * AJAX Handler for Socio Registration
 */
function infinity_handle_socio_registration() {
    check_ajax_referer('infinity-nonce', 'nonce');

    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $rut = sanitize_text_field($_POST['rut'] ?? '');
    $company = sanitize_text_field($_POST['company'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validate required fields
    if (empty($name) || empty($email) || empty($password)) {
        wp_send_json_error(array('message' => 'Por favor complete todos los campos requeridos.'));
        return;
    }

    // Check if email already exists
    if (email_exists($email)) {
        wp_send_json_error(array('message' => 'Este email ya está registrado.'));
        return;
    }

    // Create user
    $user_id = wp_create_user($email, $password, $email);

    if (is_wp_error($user_id)) {
        wp_send_json_error(array('message' => $user_id->get_error_message()));
        return;
    }

    // Update user meta
    wp_update_user(array(
        'ID' => $user_id,
        'display_name' => $name,
        'first_name' => $name,
    ));

    update_user_meta($user_id, 'phone', $phone);
    update_user_meta($user_id, 'rut', $rut);
    update_user_meta($user_id, 'company', $company);

    // Assign socio role
    $user = new WP_User($user_id);
    $user->set_role('socio');

    wp_send_json_success(array(
        'message' => '¡Registro exitoso! Bienvenido a Infinity Displays.',
        'user_id' => $user_id,
    ));
}
add_action('wp_ajax_infinity_socio_registration', 'infinity_handle_socio_registration');
add_action('wp_ajax_nopriv_infinity_socio_registration', 'infinity_handle_socio_registration');

/**
 * Remove default WooCommerce styles (we'll use our custom Tailwind styles)
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Custom WooCommerce Settings
 */
function infinity_woocommerce_custom_settings() {
    // Hide prices for non-logged in users (optional)
    // if (!is_user_logged_in()) {
    //     remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    //     remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    // }
}
add_action('init', 'infinity_woocommerce_custom_settings');

/**
 * Customize WooCommerce product columns
 */
function infinity_product_columns() {
    return 3; // 3 columns for product grid
}
add_filter('loop_shop_columns', 'infinity_product_columns');

/**
 * Products per page
 */
function infinity_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'infinity_products_per_page', 20);

/**
 * Get product categories (exclude uncategorized)
 */
function infinity_get_product_categories() {
    $categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
        'exclude' => array(get_option('default_product_cat')),
    ));

    return $categories;
}

/**
 * Check if user is Socio
 */
function infinity_is_socio($user_id = null) {
    if (!$user_id) {
        $user_id = get_current_user_id();
    }

    if (!$user_id) {
        return false;
    }

    $user = get_userdata($user_id);
    return in_array('socio', (array) $user->roles);
}

/**
 * Display volume pricing table on product page
 */
function infinity_display_volume_pricing() {
    global $product;

    $pricing = infinity_get_volume_pricing($product->get_id());

    if (empty($pricing['retail'])) {
        return;
    }

    ?>
    <div class="volume-pricing-table bg-gray-50 rounded-lg p-4 my-4">
        <h4 class="font-semibold text-gray-900 mb-3">Precios por Volumen</h4>
        <div class="space-y-2">
            <?php if (!empty($pricing['retail'])): ?>
            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                <span class="text-sm text-gray-600">1-5 unidades (Base)</span>
                <span class="font-semibold text-gray-900">$<?php echo number_format($pricing['retail'], 0, ',', '.'); ?></span>
            </div>
            <?php endif; ?>

            <?php if (!empty($pricing['wholesale'])): ?>
            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                <span class="text-sm text-gray-600">6-23 unidades (Socio)</span>
                <span class="font-semibold text-primary">$<?php echo number_format($pricing['wholesale'], 0, ',', '.'); ?></span>
            </div>
            <?php endif; ?>

            <?php if (!empty($pricing['bulk'])): ?>
            <div class="flex justify-between items-center py-2">
                <span class="text-sm text-gray-600">24+ unidades (Preventa)</span>
                <span class="font-semibold text-green-600">$<?php echo number_format($pricing['bulk'], 0, ',', '.'); ?></span>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
}
add_action('woocommerce_single_product_summary', 'infinity_display_volume_pricing', 25);

/**
 * Include additional theme files
 */
require_once INFINITY_THEME_DIR . '/inc/template-functions.php';
require_once INFINITY_THEME_DIR . '/inc/woocommerce-customizations.php';

/**
 * AJAX Handler: Send Quote Request via Email
 */
function infinity_ajax_send_quote() {
    // Check nonce
    check_ajax_referer('infinity-quote-nonce', 'nonce');

    // Sanitize inputs
    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $company = sanitize_text_field($_POST['company'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone)) {
        wp_send_json_error(array('message' => 'Por favor completa todos los campos requeridos.'));
        return;
    }

    // Validate email
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Email no válido.'));
        return;
    }

    // Prepare email
    $to = get_option('admin_email'); // Send to site admin
    $subject = 'Nueva Solicitud de Cotización - Infinity Displays';
    
    $body = "Nueva solicitud de cotización recibida:\n\n";
    $body .= "Nombre: $name\n";
    $body .= "Email: $email\n";
    $body .= "Teléfono: $phone\n";
    if ($company) {
        $body .= "Empresa: $company\n";
    }
    if ($message) {
        $body .= "\nMensaje:\n$message\n";
    }
    $body .= "\n---\n";
    $body .= "Enviado desde: " . home_url() . "\n";
    $body .= "Fecha: " . date('d/m/Y H:i:s') . "\n";

    $headers = array(
        'From: Infinity Displays <noreply@infinitydisplays.cl>',
        'Reply-To: ' . $name . ' <' . $email . '>',
        'Content-Type: text/plain; charset=UTF-8'
    );

    // Send email
    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_send_json_success(array('message' => 'Cotización enviada exitosamente.'));
    } else {
        wp_send_json_error(array('message' => 'Error al enviar el email.'));
    }
}
add_action('wp_ajax_infinity_send_quote', 'infinity_ajax_send_quote');
add_action('wp_ajax_nopriv_infinity_send_quote', 'infinity_ajax_send_quote');

/**
 * Add side cart content to WooCommerce fragments
 * This ensures the cart updates properly when items are added
 */
function infinity_add_cart_fragments($fragments) {
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

    // Add cart count
    ob_start();
    ?>
    <span class="side-cart-count ml-auto text-sm font-medium bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    <?php
    $fragments['.side-cart-count'] = trim(ob_get_clean());

    // Add header cart count badge (used in header for both desktop and mobile)
    $cart_count = WC()->cart->get_cart_contents_count();
    $hidden_class = $cart_count > 0 ? '' : ' hidden';

    // Desktop cart badge
    $fragments['.cart-count-desktop'] = '<span class="cart-count cart-count-desktop absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full min-w-[1.25rem] h-5 flex items-center justify-center px-1' . $hidden_class . '">' . $cart_count . '</span>';

    // Mobile cart badge
    $fragments['.cart-count-mobile'] = '<span class="cart-count cart-count-mobile absolute -top-0.5 -right-0.5 bg-primary text-white text-xs font-bold rounded-full min-w-[1.125rem] h-[1.125rem] flex items-center justify-center text-[10px]' . $hidden_class . '">' . $cart_count . '</span>';

    // Add footer content
    ob_start();
    ?>
    <div class="side-cart-footer-wrapper">
        <?php if (!WC()->cart->is_empty()): ?>
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
        <?php endif; ?>
    </div>
    <?php
    $fragments['.side-cart-footer-wrapper'] = ob_get_clean();

    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'infinity_add_cart_fragments');

/**
 * Include additional theme files
 */
if (file_exists(INFINITY_THEME_DIR . '/inc/template-functions.php')) {
    require_once INFINITY_THEME_DIR . '/inc/template-functions.php';
}
if (file_exists(INFINITY_THEME_DIR . '/inc/woocommerce-customizations.php')) {
    require_once INFINITY_THEME_DIR . '/inc/woocommerce-customizations.php';
}
if (file_exists(INFINITY_THEME_DIR . '/inc/video-stories-cpt.php')) {
    require_once INFINITY_THEME_DIR . '/inc/video-stories-cpt.php';
}
