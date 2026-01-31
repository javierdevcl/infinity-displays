<?php
/**
 * Video Stories Section
 *
 * @package Infinity_Displays
 */

$video_stories = infinity_get_video_stories();

if (!$video_stories->have_posts()) {
    return;
}
?>

<div class="mb-6">
    <!-- Title -->
    <div class="flex items-center gap-2 mb-4">
        <span class="text-xl">📹</span>
        <h3 class="font-display text-lg font-semibold text-foreground">Mira Nuestros Productos</h3>
    </div>

    <!-- Stories - spread across full width -->
    <div class="flex flex-wrap gap-4 justify-start">
        <?php while ($video_stories->have_posts()): $video_stories->the_post();
            $video_url = get_post_meta(get_the_ID(), '_video_youtube_url', true);
            $label = get_post_meta(get_the_ID(), '_video_label', true);
            $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium');

            if (!$video_url) continue;
        ?>
        <div class="flex flex-col items-center gap-2 cursor-pointer story-item"
             onclick="openVideoLightbox('<?php echo esc_js($video_url); ?>', '<?php echo esc_js($label); ?>')">
            <div class="w-[100px] h-[100px] rounded-full p-[3px] bg-gradient-to-br from-primary via-primary/80 to-primary/60 hover:scale-105 transition-transform shadow-md">
                <div class="w-full h-full rounded-full overflow-hidden bg-background p-[2px]">
                    <div class="w-full h-full rounded-full overflow-hidden relative group">
                        <?php if ($thumbnail): ?>
                        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($label); ?>" class="w-full h-full object-cover" />
                        <?php else: ?>
                        <div class="w-full h-full bg-gray-200"></div>
                        <?php endif; ?>
                        <div class="absolute inset-0 flex items-center justify-center bg-black/30 group-hover:bg-black/20 transition-colors">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <span class="text-xs text-muted-foreground font-medium text-center max-w-[100px] line-clamp-2">
                <?php echo esc_html($label ? $label : get_the_title()); ?>
            </span>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>

<!-- Video Lightbox Modal -->
<div id="video-lightbox" class="video-lightbox hidden">
    <div class="video-lightbox-backdrop" onclick="closeVideoLightbox()"></div>
    <div class="video-lightbox-content">
        <!-- Close button -->
        <button onclick="closeVideoLightbox()" class="video-lightbox-close">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Video container -->
        <div class="video-lightbox-player">
            <iframe id="video-iframe"
                    width="100%"
                    height="100%"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
            </iframe>
        </div>
    </div>
</div>

<script>
function openVideoLightbox(url, title) {
    const lightbox = document.getElementById('video-lightbox');
    const iframe = document.getElementById('video-iframe');

    // Extract YouTube video ID
    let videoId = '';
    if (url.includes('youtube.com/watch')) {
        videoId = url.split('v=')[1]?.split('&')[0];
    } else if (url.includes('youtu.be/')) {
        videoId = url.split('youtu.be/')[1]?.split('?')[0];
    } else if (url.includes('youtube.com/embed/')) {
        videoId = url.split('embed/')[1]?.split('?')[0];
    }

    if (videoId) {
        // YouTube embed with no controls, autoplay, and minimal branding
        iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&controls=0&modestbranding=1&rel=0&showinfo=0&iv_load_policy=3&playsinline=1`;
    } else {
        iframe.src = url;
    }

    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeVideoLightbox() {
    const lightbox = document.getElementById('video-lightbox');
    const iframe = document.getElementById('video-iframe');

    iframe.src = '';
    lightbox.classList.add('hidden');
    document.body.style.overflow = '';
}

// Close on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeVideoLightbox();
    }
});
</script>
