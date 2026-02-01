<?php
/**
 * The Template for displaying product archives, including the main shop page
 *
 * @package Infinity_Displays
 */

defined('ABSPATH') || exit;

get_header();

// Get page info
$is_shop = is_shop();
$is_search = is_search();

if ($is_shop) {
    $page_title = woocommerce_page_title(false);
    $page_description = get_the_content(get_option('woocommerce_shop_page_id'));
} elseif ($is_search) {
    $page_title = sprintf(__('Resultados de búsqueda: "%s"', 'infinity-displays'), get_search_query());
    $page_description = '';
} else {
    $page_title = woocommerce_page_title(false);
    $page_description = '';
}

// Count products
$product_count = wc_get_loop_prop('total');
?>

<!-- Breadcrumb -->
<div class="bg-secondary/30 border-b border-border">
    <div class="container mx-auto px-4 py-3">
        <?php woocommerce_breadcrumb(array(
            'delimiter' => '<svg class="w-4 h-4 text-muted-foreground mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>',
            'wrap_before' => '<div class="flex items-center text-sm">',
            'wrap_after' => '</div>',
            'before' => '<span class="text-muted-foreground hover:text-primary">',
            'after' => '</span>',
        )); ?>
    </div>
</div>

<!-- Page Header -->
<div class="bg-gradient-to-br from-primary/5 via-secondary/30 to-primary/10 py-12 md:py-16">
    <div class="container mx-auto px-4">
        <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground mb-3">
            <?php echo esc_html($page_title); ?>
        </h1>
        <?php if ($product_count): ?>
            <p class="text-lg text-muted-foreground">
                <?php printf(_n('%d producto disponible', '%d productos disponibles', $product_count, 'infinity-displays'), $product_count); ?>
            </p>
        <?php endif; ?>
        <?php if ($page_description): ?>
            <div class="mt-4 text-muted-foreground max-w-3xl">
                <?php echo wp_kses_post($page_description); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Products -->
<div class="container mx-auto px-4 py-12">
    <?php if (woocommerce_product_loop()): ?>

        <!-- Toolbar -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 pb-6 border-b border-border">
            <div class="woocommerce-result-count text-sm text-muted-foreground">
                <?php woocommerce_result_count(); ?>
            </div>
            <div class="woocommerce-ordering">
                <?php woocommerce_catalog_ordering(); ?>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <?php
            while (have_posts()):
                the_post();
                wc_get_template_part('content', 'product');
            endwhile;
            ?>
        </div>

        <?php woocommerce_pagination(); ?>

    <?php else: ?>

        <div class="text-center py-16">
            <?php if ($is_search): ?>
                <svg class="w-20 h-20 mx-auto text-muted-foreground/50 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <p class="text-muted-foreground text-lg mb-4">
                    No se encontraron productos para "<strong><?php echo esc_html(get_search_query()); ?></strong>"
                </p>
            <?php else: ?>
                <svg class="w-20 h-20 mx-auto text-muted-foreground/50 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <p class="text-muted-foreground text-lg mb-4">
                    No hay productos disponibles.
                </p>
            <?php endif; ?>
            <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                Ver todos los productos
            </a>
        </div>

    <?php endif; ?>
</div>

<!-- Categories Section -->
<?php
$categories = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
    'parent' => 0,
    'exclude' => array(get_option('default_product_cat')),
));

if ($categories && !is_wp_error($categories) && count($categories) > 1):
?>
<div class="bg-gray-900 py-12">
    <div class="container mx-auto px-4">
        <h2 class="font-display text-2xl font-bold text-white mb-6">
            Explorar por Categoría
        </h2>
        <div class="flex flex-wrap gap-3">
            <?php foreach ($categories as $category): ?>
                <a href="<?php echo get_term_link($category); ?>"
                   class="px-4 py-2 bg-white/10 rounded-lg border border-white/20 text-white hover:bg-white hover:text-gray-900 transition-colors font-medium">
                    <?php echo esc_html($category->name); ?>
                    <span class="text-white/60 ml-1">(<?php echo $category->count; ?>)</span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
get_footer();
