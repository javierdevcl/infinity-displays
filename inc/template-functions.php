<?php
/**
 * Template Functions
 *
 * @package Infinity_Displays
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add custom body classes
 */
function infinity_body_classes($classes) {
    // Add class for WooCommerce pages
    if (is_woocommerce()) {
        $classes[] = 'woocommerce-page';
    }

    // Add class for single product pages
    if (is_product()) {
        $classes[] = 'single-product-page';
    }

    return $classes;
}
add_filter('body_class', 'infinity_body_classes');

/**
 * Format Chilean price
 */
function infinity_format_price($price) {
    return '$' . number_format($price, 0, ',', '.');
}

/**
 * Get current user role
 */
function infinity_get_current_user_role() {
    if (!is_user_logged_in()) {
        return false;
    }

    $user = wp_get_current_user();
    $roles = (array) $user->roles;

    return $roles[0] ?? false;
}

/**
 * Display product badge
 */
function infinity_product_badge($product) {
    if ($product->is_featured()) {
        echo '<span class="product-badge badge-new">NUEVO</span>';
    }

    if ($product->is_on_sale()) {
        echo '<span class="product-badge badge-hot">🔥 HOT</span>';
    }
}

/**
 * Get product stock status label
 */
function infinity_stock_status_label($product) {
    if (!$product->is_in_stock()) {
        return '<span class="stock-status out-of-stock">Agotado</span>';
    }

    $stock_quantity = $product->get_stock_quantity();

    if ($stock_quantity === null) {
        return '<span class="stock-status in-stock">En Stock</span>';
    }

    if ($stock_quantity <= 10) {
        return '<span class="stock-status low-stock">Últimas unidades</span>';
    }

    return '<span class="stock-status in-stock">Disponible (' . $stock_quantity . ' unidades)</span>';
}

/**
 * Custom excerpt length
 */
function infinity_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'infinity_excerpt_length');

/**
 * Custom excerpt more
 */
function infinity_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'infinity_excerpt_more');
