<?php
/**
 * The template for displaying all pages
 *
 * @package Infinity_Displays
 */

get_header();

// Check if this is a WooCommerce account page
$is_account_page = function_exists('is_account_page') && is_account_page();
?>

<main class="container mx-auto px-4 py-8">
    <?php
    while (have_posts()):
        the_post();
    ?>
        <?php if ($is_account_page): ?>
            <!-- WooCommerce Account Page - No extra wrappers -->
            <?php the_content(); ?>
        <?php else: ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1 class="text-4xl font-display font-bold text-foreground mb-6">
                    <?php the_title(); ?>
                </h1>
                <div class="prose max-w-none">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endif; ?>
    <?php
    endwhile;
    ?>
</main>

<?php
get_footer();
