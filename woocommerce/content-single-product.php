<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * @package Infinity_Displays
 */

defined('ABSPATH') || exit;

global $product;

$pricing = infinity_get_volume_pricing($product->get_id());
$retail_price = !empty($pricing['retail']) ? $pricing['retail'] : $product->get_price();
$wholesale_price = !empty($pricing['wholesale']) ? $pricing['wholesale'] : '';
$bulk_price = !empty($pricing['bulk']) ? $pricing['bulk'] : '';
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

<!-- Breadcrumb -->
<div class="bg-secondary/20 border-b border-border">
    <div class="container mx-auto px-4 py-3">
        <?php woocommerce_breadcrumb(array(
            'delimiter' => '<svg class="w-4 h-4 text-muted-foreground mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>',
            'wrap_before' => '<nav class="flex items-center text-sm">',
            'wrap_after' => '</nav>',
            'before' => '<span class="text-muted-foreground hover:text-primary">',
            'after' => '</span>',
        )); ?>
    </div>
</div>

<!-- Product Content -->
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">

        <!-- Product Images -->
        <div class="relative">
            <?php if ($product->is_on_sale()): ?>
                <span class="absolute top-4 left-4 z-10 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded">
                    ¡HOT!
                </span>
            <?php endif; ?>

            <?php if ($product->is_featured()): ?>
                <span class="absolute top-4 right-4 z-10 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded">
                    NUEVO
                </span>
            <?php endif; ?>

            <!-- Main Image -->
            <div class="product-images bg-white rounded-2xl overflow-hidden mb-4" id="main-product-image">
                <?php
                if (has_post_thumbnail()) {
                    $image_id = $product->get_image_id();
                    $image_url = wp_get_attachment_image_url($image_id, 'large');
                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($product->get_name()) . '" class="w-full aspect-square object-contain" data-image-id="' . $image_id . '">';
                } else {
                    echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" class="w-full aspect-square object-contain">';
                }
                ?>
            </div>

            <!-- Thumbnail Gallery -->
            <?php
            $attachment_ids = $product->get_gallery_image_ids();
            $main_image_id = $product->get_image_id();

            // Combine main image with gallery images
            if ($main_image_id) {
                array_unshift($attachment_ids, $main_image_id);
            }

            if (count($attachment_ids) > 1):
            ?>
                <div class="flex gap-2 overflow-x-auto pb-2">
                    <?php foreach ($attachment_ids as $index => $attachment_id):
                        $thumbnail_url = wp_get_attachment_image_url($attachment_id, 'thumbnail');
                        $large_url = wp_get_attachment_image_url($attachment_id, 'large');
                        $is_active = ($index === 0) ? 'ring-2 ring-primary' : 'ring-1 ring-gray-200';
                    ?>
                        <button
                            type="button"
                            class="product-thumbnail flex-shrink-0 w-20 h-20 bg-white rounded-lg overflow-hidden <?php echo $is_active; ?> hover:ring-2 hover:ring-primary transition-all"
                            data-large-image="<?php echo esc_url($large_url); ?>"
                            data-image-id="<?php echo esc_attr($attachment_id); ?>"
                            onclick="changeProductImage(this)">
                            <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($product->get_name()); ?>" class="w-full h-full object-contain">
                        </button>
                    <?php endforeach; ?>
                </div>

                <script>
                function changeProductImage(thumbnail) {
                    const largeImageUrl = thumbnail.getAttribute('data-large-image');
                    const mainImage = document.querySelector('#main-product-image img');

                    // Update main image
                    mainImage.src = largeImageUrl;

                    // Update active state
                    document.querySelectorAll('.product-thumbnail').forEach(thumb => {
                        thumb.classList.remove('ring-2', 'ring-primary');
                        thumb.classList.add('ring-1', 'ring-gray-200');
                    });
                    thumbnail.classList.remove('ring-1', 'ring-gray-200');
                    thumbnail.classList.add('ring-2', 'ring-primary');
                }
                </script>
            <?php endif; ?>
        </div>

        <!-- Product Details -->
        <div>
            <?php
            $categories = wc_get_product_category_list($product->get_id(), ', ');
            if ($categories):
            ?>
                <span class="text-sm text-primary font-medium uppercase tracking-wider">
                    <?php echo strip_tags($categories); ?>
                </span>
            <?php endif; ?>

            <h1 class="font-display text-3xl lg:text-4xl font-bold text-foreground mt-2 mb-4">
                <?php echo esc_html($product->get_name()); ?>
            </h1>

            <p class="text-muted-foreground text-lg mb-6">
                <?php echo wp_kses_post($product->get_short_description()); ?>
            </p>

            <!-- Features -->
            <?php
            $features = get_post_meta($product->get_id(), '_product_features', true);
            if ($features && is_array($features)):
            ?>
                <div class="mb-6">
                    <h3 class="font-semibold text-foreground mb-3">Características</h3>
                    <ul class="space-y-2">
                        <?php foreach ($features as $feature): ?>
                            <li class="flex items-start gap-2 text-sm text-muted-foreground">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <?php echo esc_html($feature); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Size Selector (if product has variations) -->
            <?php if ($product->is_type('variable')):
                $available_variations = $product->get_available_variations();
                $attributes = $product->get_variation_attributes();
            ?>
                <div class="mb-6">
                    <h3 class="font-semibold text-foreground mb-3">Tamaño</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php
                        foreach ($attributes as $attribute_name => $options):
                            foreach ($options as $option):
                        ?>
                            <button type="button" class="size-option px-4 py-2 bg-primary text-white rounded-full text-sm font-medium hover:bg-primary/90 transition-colors" data-value="<?php echo esc_attr($option); ?>">
                                <?php echo esc_html($option); ?>
                            </button>
                        <?php
                            endforeach;
                        endforeach;
                        ?>
                    </div>
                </div>
            <?php else:
                // For simple products, try to show size from attributes
                $attributes = $product->get_attributes();
                $size_display = '';

                foreach ($attributes as $attribute) {
                    if ($attribute->get_name() === 'pa_tamano' || $attribute->get_name() === 'pa_size') {
                        $terms = wc_get_product_terms($product->get_id(), $attribute->get_name(), array('fields' => 'names'));
                        if (!empty($terms)) {
                            $size_display = $terms[0];
                            break;
                        }
                    }
                }

                if ($size_display):
            ?>
                <div class="mb-6">
                    <h3 class="font-semibold text-foreground mb-3">Tamaño</h3>
                    <div class="inline-block px-4 py-2 bg-primary text-white rounded-full text-sm font-medium">
                        <?php echo esc_html($size_display); ?>
                    </div>
                </div>
            <?php
                endif;
            endif;
            ?>

            <!-- Quantity Selector -->
            <div class="mb-6">
                <h3 class="font-semibold text-foreground mb-3">Cantidad</h3>
                <div class="flex items-center gap-3">
                    <div class="flex items-center border border-border rounded-lg">
                        <button type="button" class="qty-minus px-4 py-3 hover:bg-secondary transition-colors" data-product-id="<?php echo $product->get_id(); ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                        </button>
                        <input
                            type="number"
                            id="quantity-<?php echo $product->get_id(); ?>"
                            class="w-20 text-center border-x border-border py-3 focus:outline-none"
                            value="1"
                            min="1"
                            data-product-id="<?php echo $product->get_id(); ?>"
                        >
                        <button type="button" class="qty-plus px-4 py-3 hover:bg-secondary transition-colors" data-product-id="<?php echo $product->get_id(); ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                    </div>
                    <span class="text-sm text-muted-foreground">unidades</span>
                </div>
            </div>

            <!-- Price Tiers Selection -->
            <div class="bg-primary/5 rounded-xl p-6 mb-6">
                <h4 class="font-semibold text-foreground mb-4">Precios por Volumen</h4>
                <div class="space-y-2" id="price-tiers-<?php echo $product->get_id(); ?>">
                    <!-- Precio Base -->
                    <div class="price-tier-option active cursor-pointer flex items-center justify-between p-4 bg-white border-2 border-primary rounded-lg transition-all hover:border-primary/70" data-tier="retail" data-min="1" data-max="5">
                        <div class="flex items-center gap-3">
                            <div class="check-indicator w-5 h-5 rounded-full border-2 border-primary bg-primary flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Precio Base (1-5 uds)</span>
                        </div>
                        <span class="text-lg font-bold text-primary">${<?php echo number_format($retail_price, 0, ',', '.'); ?>}</span>
                    </div>

                    <?php if ($wholesale_price): ?>
                    <!-- Precio Socio -->
                    <div class="price-tier-option cursor-pointer flex items-center justify-between p-4 bg-white border-2 border-border rounded-lg transition-all hover:border-primary/70" data-tier="wholesale" data-min="6" data-max="23">
                        <div class="flex items-center gap-3">
                            <div class="check-indicator w-5 h-5 rounded-full border-2 border-border bg-white"></div>
                            <span class="text-sm font-medium">Precio Socio (6-23 uds)</span>
                        </div>
                        <span class="text-lg font-bold text-foreground">${<?php echo number_format($wholesale_price, 0, ',', '.'); ?>}</span>
                    </div>
                    <?php endif; ?>

                    <?php if ($bulk_price): ?>
                    <!-- Precio Preventa -->
                    <div class="price-tier-option cursor-pointer flex items-center justify-between p-4 bg-white border-2 border-border rounded-lg transition-all hover:border-primary/70" data-tier="bulk" data-min="24" data-max="999">
                        <div class="flex items-center gap-3">
                            <div class="check-indicator w-5 h-5 rounded-full border-2 border-border bg-white"></div>
                            <span class="text-sm font-medium">Precio Preventa (24+ uds)</span>
                        </div>
                        <span class="text-lg font-bold text-foreground">${<?php echo number_format($bulk_price, 0, ',', '.'); ?>}</span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Price Summary -->
            <div class="bg-secondary/20 rounded-xl p-6 mb-6">
                <div class="flex justify-between items-baseline mb-2">
                    <span class="text-sm text-muted-foreground">Precio Base</span>
                    <span class="text-lg font-medium text-foreground" id="unit-price-display-<?php echo $product->get_id(); ?>">
                        $<?php echo number_format($retail_price, 0, ',', '.'); ?> x 1
                    </span>
                </div>
                <div class="border-t border-border pt-4 mt-4">
                    <div class="flex justify-between items-baseline">
                        <span class="text-lg font-semibold text-foreground">Total Estimado</span>
                        <span class="text-3xl font-bold text-primary" id="total-price-<?php echo $product->get_id(); ?>">
                            $<?php echo number_format($retail_price, 0, ',', '.'); ?>
                        </span>
                    </div>
                    <p class="text-xs text-muted-foreground mt-2">+ IVA • Envío no incluido</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div id="product-action-buttons" class="lg:grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8 lg:mb-8">
                <!-- Add to Cart Form -->
                <form class="cart" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>">
                    <input type="hidden" name="product_id" value="<?php echo esc_attr($product->get_id()); ?>">
                    <input type="hidden" id="selected-tier-<?php echo $product->get_id(); ?>" name="selected_tier" value="retail">
                    <input type="hidden" id="cart-quantity-<?php echo $product->get_id(); ?>" name="quantity" value="1">

                    <button type="submit" class="single_add_to_cart_button button alt inline-flex items-center justify-center w-full px-6 py-4 text-base font-semibold bg-primary text-primary-foreground hover:bg-primary/90 rounded-lg transition-colors h-full">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Agregar al Carrito
                    </button>
                </form>

                <a href="#" class="quote-whatsapp inline-flex items-center justify-center w-full px-6 py-4 text-base font-semibold border-2 border-green-500 text-green-700 hover:bg-green-50 rounded-lg transition-colors" data-product-id="<?php echo $product->get_id(); ?>">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Cotizar por WhatsApp
                </a>
            </div>

            <!-- Trust Badges -->
            <div class="grid grid-cols-3 gap-4 py-6 border-t border-border">
                <div class="text-center">
                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <div class="text-xs font-medium text-foreground">Envío a todo Chile</div>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="text-xs font-medium text-foreground">Garantía incluida</div>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-xs font-medium text-foreground">Despacho 24-48h</div>
                </div>
            </div>

        </div>
    </div>

    <!-- Technical Specifications -->
    <?php
    // Get product attributes for technical specs
    $product_attributes = $product->get_attributes();
    $specs_to_show = array();

    foreach ($product_attributes as $attribute) {
        if (!$attribute->get_variation()) { // Only non-variation attributes
            $name = wc_attribute_label($attribute->get_name());
            if ($attribute->is_taxonomy()) {
                $terms = wp_get_post_terms($product->get_id(), $attribute->get_name(), array('fields' => 'names'));
                $value = implode(', ', $terms);
            } else {
                $value = implode(', ', $attribute->get_options());
            }
            $specs_to_show[$name] = $value;
        }
    }

    if (!empty($specs_to_show)):
    ?>
    <div class="mt-12 bg-white rounded-xl border border-border p-8">
        <h2 class="text-2xl font-display font-bold text-foreground mb-6">Especificaciones Técnicas</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($specs_to_show as $spec_name => $spec_value): ?>
                <div class="flex gap-4">
                    <div class="text-sm text-muted-foreground min-w-[120px]"><?php echo esc_html($spec_name); ?></div>
                    <div class="text-sm font-medium text-foreground"><?php echo esc_html($spec_value); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Product Description Tabs -->
    <div class="mt-12">
        <?php woocommerce_output_product_data_tabs(); ?>
    </div>

    <!-- Related Products -->
    <?php
    $related_products = wc_get_related_products($product->get_id(), 4);
    if ($related_products):
    ?>
        <div class="mt-12">
            <h2 class="text-2xl font-display font-bold text-foreground mb-6">Productos Relacionados</h2>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                foreach ($related_products as $related_id):
                    $post_object = get_post($related_id);
                    setup_postdata($GLOBALS['post'] =& $post_object);
                    wc_get_template_part('content', 'product-category');
                endforeach;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    <?php endif; ?>

</div><!-- #product-<?php the_ID(); ?> -->

<script>
// Dynamic pricing calculator
document.addEventListener('DOMContentLoaded', function() {
    const productId = <?php echo $product->get_id(); ?>;
    const pricing = {
        retail: <?php echo $retail_price; ?>,
        wholesale: <?php echo $wholesale_price ? $wholesale_price : 0; ?>,
        bulk: <?php echo $bulk_price ? $bulk_price : 0; ?>
    };

    let currentTier = 'retail';

    function updatePrice() {
        const qtyInput = document.getElementById('quantity-' + productId);
        const qty = parseInt(qtyInput.value) || 1;

        // Auto-select tier based on quantity
        if (qty >= 24 && pricing.bulk > 0) {
            currentTier = 'bulk';
        } else if (qty >= 6 && pricing.wholesale > 0) {
            currentTier = 'wholesale';
        } else {
            currentTier = 'retail';
        }

        // Update tier selection UI
        updateTierSelection();

        // Calculate price
        const currentPrice = pricing[currentTier];
        const total = currentPrice * qty;

        // Update display
        document.getElementById('unit-price-display-' + productId).textContent =
            '$' + currentPrice.toLocaleString('es-CL') + ' x ' + qty;
        document.getElementById('total-price-' + productId).textContent =
            '$' + total.toLocaleString('es-CL');

        // Update hidden form fields for cart
        document.getElementById('cart-quantity-' + productId).value = qty;
        document.getElementById('selected-tier-' + productId).value = currentTier;
    }

    function updateTierSelection() {
        const tiers = document.querySelectorAll('.price-tier-option');
        tiers.forEach(tier => {
            const tierType = tier.dataset.tier;
            const checkIndicator = tier.querySelector('.check-indicator');

            if (tierType === currentTier) {
                tier.classList.add('active', 'border-primary');
                tier.classList.remove('border-border');
                checkIndicator.classList.add('bg-primary', 'border-primary');
                checkIndicator.classList.remove('bg-white', 'border-border');
                checkIndicator.innerHTML = '<svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>';
            } else {
                tier.classList.remove('active', 'border-primary');
                tier.classList.add('border-border');
                checkIndicator.classList.remove('bg-primary', 'border-primary');
                checkIndicator.classList.add('bg-white', 'border-border');
                checkIndicator.innerHTML = '';
            }
        });
    }

    // Quantity controls
    document.querySelectorAll('.qty-minus').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = document.getElementById('quantity-' + productId);
            const current = parseInt(input.value) || 1;
            if (current > 1) {
                input.value = current - 1;
                updatePrice();
            }
        });
    });

    document.querySelectorAll('.qty-plus').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = document.getElementById('quantity-' + productId);
            const current = parseInt(input.value) || 1;
            input.value = current + 1;
            updatePrice();
        });
    });

    document.querySelectorAll('input[id^="quantity-"]').forEach(input => {
        input.addEventListener('change', function() {
            updatePrice();
        });
    });

    // Tier selection click
    document.querySelectorAll('.price-tier-option').forEach(option => {
        option.addEventListener('click', function() {
            const tier = this.dataset.tier;
            const minQty = parseInt(this.dataset.min);
            const qtyInput = document.getElementById('quantity-' + productId);

            // Update quantity to minimum for this tier
            if (parseInt(qtyInput.value) < minQty) {
                qtyInput.value = minQty;
            }

            currentTier = tier;
            updatePrice();
        });
    });

    // WhatsApp quote - Open modal only
    document.querySelectorAll('.quote-whatsapp').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const qty = document.getElementById('quantity-' + productId).value;
            const productName = "<?php echo esc_js($product->get_name()); ?>";
            const currentPrice = pricing[currentTier];
            const total = currentPrice * qty;

            // Pre-fill message in modal
            if (typeof openQuoteModal === 'function') {
                openQuoteModal();

                // Wait for modal to be created, then pre-fill message
                setTimeout(function() {
                    const messageField = document.querySelector('#quote-modal textarea[name="message"]');
                    if (messageField) {
                        messageField.value = `Me interesa cotizar:\n- Producto: ${productName}\n- Cantidad: ${qty} unidades\n- Precio unitario: $${currentPrice.toLocaleString('es-CL')}\n- Total estimado: $${total.toLocaleString('es-CL')}`;
                    }
                }, 100);
            }
        });
    });

    // Sticky buttons behavior for mobile
    function initStickyButtons() {
        if (window.innerWidth > 767) return; // Only for mobile

        const actionButtons = document.getElementById('product-action-buttons');
        if (!actionButtons) return;

        let observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    // Buttons are visible, remove sticky
                    actionButtons.classList.remove('is-sticky');
                } else {
                    // Buttons are out of view, make them sticky
                    actionButtons.classList.add('is-sticky');
                }
            });
        }, {
            threshold: 0,
            rootMargin: '0px'
        });

        observer.observe(actionButtons);
    }

    // Initialize
    updatePrice();
    initStickyButtons();

    // Re-init on resize
    window.addEventListener('resize', function() {
        initStickyButtons();
    });
});
</script>
