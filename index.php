<?php
/**
 * The main template file
 *
 * @package Infinity_Displays
 */

get_header();
?>

<main class="container mx-auto px-4 py-8">
    <?php
    if (have_posts()):
        while (have_posts()):
            the_post();
    ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('mb-8'); ?>>
            <h2 class="text-2xl font-display font-bold mb-4">
                <a href="<?php the_permalink(); ?>" class="text-foreground hover:text-primary transition-colors">
                    <?php the_title(); ?>
                </a>
            </h2>
            <div class="prose max-w-none">
                <?php the_content(); ?>
            </div>
        </article>
    <?php
        endwhile;
    else:
    ?>
        <p class="text-center text-muted-foreground py-12">
            No se encontraron resultados.
        </p>
    <?php
    endif;
    ?>
</main>

<?php
get_footer();
