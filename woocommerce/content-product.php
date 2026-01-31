<?php
/**
 * The template for displaying product content within loops
 *
 * @package Infinity_Displays
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}

// Get volume pricing
$pricing = infinity_get_volume_pricing($product->get_id());
$retail_price = !empty($pricing['retail']) ? floatval($pricing['retail']) : floatval($product->get_price());
$wholesale_price = !empty($pricing['wholesale']) ? floatval($pricing['wholesale']) : 0;
$bulk_price = !empty($pricing['bulk']) ? floatval($pricing['bulk']) : 0;

// Check badges
$is_new = $product->is_featured(); // Using featured as "new"
$is_hot = $product->is_on_sale(); // Using sale as "hot"
$discount = 0;
if ($product->is_on_sale() && $product->get_regular_price()) {
    $discount = round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100);
}
?>

<div <?php wc_product_class('group bg-white rounded-lg border border-gray-200 overflow-hidden transition-all duration-300 hover:border-primary hover:shadow-xl', $product); ?>>

    <!-- Image -->
    <a href="<?php echo esc_url($product->get_permalink()); ?>" class="block relative aspect-square overflow-hidden bg-secondary">

        <!-- Badges -->
        <?php if ($is_new): ?>
            <span class="absolute top-2 left-2 z-10 bg-green-500 text-white text-[10px] font-bold px-2 py-1 rounded">
                NUEVO
            </span>
        <?php endif; ?>

        <?php if ($is_hot): ?>
            <span class="absolute top-2 left-2 z-10 bg-destructive text-white text-[10px] font-bold px-2 py-1 rounded flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2c1.5 2.5 1.5 5 0 7.5C10.5 7 10.5 4.5 12 2zm4.5 5c1 1.5 1 3 0 4.5-1-1.5-1-3 0-4.5zM7.5 7c1 1.5 1 3 0 4.5-1-1.5-1-3 0-4.5zm4.5 5c2.5 1.5 2.5 4 0 10-2.5-6-2.5-8.5 0-10z"/>
                </svg>
                HOT
            </span>
        <?php endif; ?>

        <?php if ($discount > 0): ?>
            <span class="absolute top-2 right-2 z-10 bg-primary text-primary-foreground text-[10px] font-bold px-2 py-1 rounded">
                -<?php echo $discount; ?>%
            </span>
        <?php endif; ?>

        <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110')); ?>
        <?php else: ?>
            <img src="<?php echo wc_placeholder_img_src(); ?>" alt="<?php echo esc_attr($product->get_name()); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
        <?php endif; ?>

        <!-- Hover overlay -->
        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
            <span class="bg-white text-gray-900 px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                Ver Ficha
            </span>
        </div>
    </a>

    <!-- Content -->
    <div class="p-3">
        <a href="<?php echo esc_url($product->get_permalink()); ?>">
            <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 group-hover:text-primary transition-colors">
                <?php echo esc_html($product->get_name()); ?>
            </h3>
        </a>
        <p class="text-xs text-gray-500 line-clamp-2 mb-3">
            <?php echo wp_trim_words($product->get_short_description(), 15); ?>
        </p>

        <!-- Pricing -->
        <div class="space-y-1 mb-3">
            <div class="flex justify-between items-center text-xs">
                <span class="text-gray-500">Precio Base:</span>
                <span class="text-gray-900 font-medium">$<?php echo number_format($retail_price, 0, ',', '.'); ?></span>
            </div>
            <?php if ($wholesale_price > 0): ?>
            <div class="flex justify-between items-center text-xs">
                <span class="text-primary">Precio Socio:</span>
                <span class="text-primary font-medium">$<?php echo number_format($wholesale_price, 0, ',', '.'); ?></span>
            </div>
            <?php endif; ?>
            <?php if ($bulk_price > 0): ?>
            <div class="flex justify-between items-center text-xs bg-secondary -mx-3 px-3 py-1.5 border-t border-border">
                <span class="text-secondary-foreground font-medium flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Precio Preventa:
                </span>
                <span class="text-secondary-foreground font-bold">$<?php echo number_format($bulk_price, 0, ',', '.'); ?></span>
            </div>
            <?php endif; ?>
        </div>

        <!-- Buttons -->
        <div class="flex gap-2">
            <button onclick="openQuoteModal(); return false;" class="infinity-quote-btn flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-medium border-2 border-primary/30 text-primary bg-primary/5 hover:bg-primary hover:text-white hover:border-primary rounded-md transition-all duration-200">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Cotizar
            </button>
            <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
               data-quantity="1"
               data-product_id="<?php echo esc_attr($product->get_id()); ?>"
               data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
               class="add_to_cart_button ajax_add_to_cart product_type_simple text-xs px-3 py-2 bg-primary text-primary-foreground hover:bg-primary/90 rounded-md transition-colors inline-flex items-center justify-center">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
