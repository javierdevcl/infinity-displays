<?php
/**
 * Custom Post Type: Video Stories
 *
 * @package Infinity_Displays
 */

// Register Video Stories CPT
function infinity_register_video_stories_cpt() {
    $labels = array(
        'name' => 'Video Stories',
        'singular_name' => 'Video Story',
        'menu_name' => 'Video Stories',
        'add_new' => 'Agregar Nuevo',
        'add_new_item' => 'Agregar Nuevo Video',
        'edit_item' => 'Editar Video',
        'new_item' => 'Nuevo Video',
        'view_item' => 'Ver Video',
        'search_items' => 'Buscar Videos',
        'not_found' => 'No se encontraron videos',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-video-alt3',
        'supports' => array('title', 'thumbnail'),
        'show_in_rest' => true,
        'menu_position' => 20,
        'has_archive' => false,
        'publicly_queryable' => true,
        'query_var' => true,
    );

    register_post_type('video_story', $args);
}
add_action('init', 'infinity_register_video_stories_cpt');

// Add meta boxes for Video Stories
function infinity_video_stories_meta_boxes() {
    add_meta_box(
        'video_story_details',
        'Detalles del Video',
        'infinity_video_story_meta_box_callback',
        'video_story',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'infinity_video_stories_meta_boxes');

// Meta box callback
function infinity_video_story_meta_box_callback($post) {
    wp_nonce_field('infinity_save_video_story_meta', 'infinity_video_story_nonce');

    $youtube_url = get_post_meta($post->ID, '_video_youtube_url', true);
    $label = get_post_meta($post->ID, '_video_label', true);
    $order = get_post_meta($post->ID, '_video_order', true);

    ?>
    <table class="form-table">
        <tr>
            <th><label for="video_label">Etiqueta del Video</label></th>
            <td>
                <input type="text" id="video_label" name="video_label" value="<?php echo esc_attr($label); ?>" class="regular-text" placeholder="Ej: Roll-Ups, Pop-Ups" />
                <p class="description">Nombre que aparecerá bajo el círculo del video</p>
            </td>
        </tr>
        <tr>
            <th><label for="video_youtube_url">URL de YouTube</label></th>
            <td>
                <input type="url" id="video_youtube_url" name="video_youtube_url" value="<?php echo esc_attr($youtube_url); ?>" class="regular-text" placeholder="https://youtube.com/shorts/..." />
                <p class="description">URL completa del video en YouTube (puede ser Short o video normal)</p>
            </td>
        </tr>
        <tr>
            <th><label for="video_order">Orden</label></th>
            <td>
                <input type="number" id="video_order" name="video_order" value="<?php echo esc_attr($order ? $order : 0); ?>" min="0" max="100" />
                <p class="description">Orden de aparición (0 = primero)</p>
            </td>
        </tr>
        <tr>
            <th>Imagen de Portada</th>
            <td>
                <p class="description">Usa la imagen destacada de WordPress para la miniatura del video</p>
            </td>
        </tr>
    </table>
    <?php
}

// Save meta box data
function infinity_save_video_story_meta($post_id) {
    // Check nonce
    if (!isset($_POST['infinity_video_story_nonce']) ||
        !wp_verify_nonce($_POST['infinity_video_story_nonce'], 'infinity_save_video_story_meta')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save fields
    if (isset($_POST['video_youtube_url'])) {
        update_post_meta($post_id, '_video_youtube_url', sanitize_text_field($_POST['video_youtube_url']));
    }

    if (isset($_POST['video_label'])) {
        update_post_meta($post_id, '_video_label', sanitize_text_field($_POST['video_label']));
    }

    if (isset($_POST['video_order'])) {
        update_post_meta($post_id, '_video_order', intval($_POST['video_order']));
    }
}
add_action('save_post_video_story', 'infinity_save_video_story_meta');

// Helper function to get video embed ID
function infinity_get_youtube_id($url) {
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
    return isset($match[1]) ? $match[1] : false;
}

// Get all video stories for display
function infinity_get_video_stories() {
    $args = array(
        'post_type' => 'video_story',
        'posts_per_page' => 6,
        'orderby' => 'meta_value_num',
        'meta_key' => '_video_order',
        'order' => 'ASC',
        'post_status' => 'publish',
    );

    return new WP_Query($args);
}
