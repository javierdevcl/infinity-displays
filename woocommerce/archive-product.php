<?php
/**
 * The Template for displaying product archives, including the main shop page
 *
 * @package Infinity_Displays
 */

defined('ABSPATH') || exit;

// Check if this is a product category page
if (is_product_category()) {
    // Use custom category template
    $term = get_queried_object();
    $term_id = $term->term_id;
    $term_name = $term->name;
    $term_description = term_description($term_id);

    get_header();
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

    <!-- Category Header -->
    <div class="bg-secondary/20 py-12">
        <div class="container mx-auto px-4">
            <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground mb-3">
                <?php echo esc_html($term_name); ?>
            </h1>
            <?php
            $product_count = $term->count;
            ?>
            <p class="text-lg text-muted-foreground">
                <?php printf(_n('%d producto disponible', '%d productos disponibles', $product_count, 'infinity-displays'), $product_count); ?>
            </p>
            <?php if ($term_description): ?>
                <div class="mt-3 text-muted-foreground prose max-w-3xl">
                    <?php echo $term_description; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Products -->
    <div class="container mx-auto px-4 py-12">
        <?php if (have_posts()): ?>

            <!-- Products Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <?php
                while (have_posts()):
                    the_post();
                    wc_get_template_part('content', 'product-category');
                endwhile;
                ?>
            </div>

            <?php woocommerce_pagination(); ?>

        <?php else: ?>

            <div class="text-center py-16">
                <p class="text-muted-foreground text-lg mb-4">
                    No hay productos en esta categoría.
                </p>
                <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="text-primary hover:underline">
                    Ver todos los productos
                </a>
            </div>

        <?php endif; ?>
    </div>

    <!-- Other Categories -->
    <div class="bg-secondary/30 py-12">
        <div class="container mx-auto px-4">
            <h2 class="font-display text-2xl font-bold text-foreground mb-6">
                Otras Categorías
            </h2>
            <div class="flex flex-wrap gap-3">
                <?php
                $categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                    'exclude' => array($term_id, get_option('default_product_cat')),
                ));

                if ($categories && !is_wp_error($categories)):
                    foreach ($categories as $category):
                ?>
                    <a href="<?php echo get_term_link($category); ?>"
                       class="px-4 py-2 bg-white rounded-lg border border-border hover:border-primary hover:text-primary transition-colors font-medium">
                        <?php echo esc_html($category->name); ?>
                    </a>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>

    <?php
    get_footer();

} else {
    // Regular shop page
    get_header('shop');
    ?>

    <div class="shop-header bg-gradient-to-r from-primary/10 to-secondary/10 py-8 mb-8">
        <div class="container mx-auto px-4">
            <?php if (apply_filters('woocommerce_show_page_title', true)): ?>
                <h1 class="text-4xl font-display font-bold text-foreground mb-2">
                    <?php woocommerce_page_title(); ?>
                </h1>
            <?php endif; ?>

            <?php
            /**
             * Hook: woocommerce_archive_description.
             */
            do_action('woocommerce_archive_description');
            ?>
        </div>
    </div>

    <div class="container mx-auto px-4 pb-12">
        <div class="flex flex-col lg:flex-row gap-8">

            <!-- Main Content -->
            <div class="flex-1">
                <?php if (woocommerce_product_loop()): ?>

                    <?php
                    /**
                     * Hook: woocommerce_before_shop_loop.
                     */
                    do_action('woocommerce_before_shop_loop');
                    ?>

                    <div class="mb-6 flex justify-between items-center flex-wrap gap-4">
                        <div class="woocommerce-result-count text-sm text-muted-foreground">
                            <?php woocommerce_result_count(); ?>
                        </div>
                        <div class="woocommerce-ordering">
                            <?php woocommerce_catalog_ordering(); ?>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <?php
                        if (wc_get_loop_prop('total')):
                            while (have_posts()):
                                the_post();

                                /**
                                 * Hook: woocommerce_shop_loop.
                                 */
                                do_action('woocommerce_shop_loop');

                                wc_get_template_part('content', 'product');
                            endwhile;
                        endif;
                        ?>
                    </div>

                    <?php
                    /**
                     * Hook: woocommerce_after_shop_loop.
                     */
                    do_action('woocommerce_after_shop_loop');
                    ?>

                <?php else: ?>

                    <div class="text-center py-12">
                        <p class="text-muted-foreground text-lg mb-4">No se encontraron productos.</p>
                        <a href="<?php echo home_url(); ?>" class="inline-block px-6 py-3 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors">
                            Volver al inicio
                        </a>
                    </div>

                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <?php get_template_part('template-parts/sidebar', 'shop'); ?>

        </div>
    </div>

    <?php
    get_footer('shop');
}
