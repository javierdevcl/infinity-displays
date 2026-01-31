<?php
/**
 * The template for displaying all pages
 *
 * @package Infinity_Displays
 */

get_header();
?>

<main class="container mx-auto px-4 py-8">
    <?php
    while (have_posts()):
        the_post();
    ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1 class="text-4xl font-display font-bold text-foreground mb-6">
                <?php the_title(); ?>
            </h1>
            <div class="prose max-w-none">
                <?php the_content(); ?>
            </div>
        </article>
    <?php
    endwhile;
    ?>
</main>

<?php
get_footer();
