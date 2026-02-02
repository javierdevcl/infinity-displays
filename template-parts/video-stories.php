<?php
/**
 * Video Stories Section with Plyr Player
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
            $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'infinity-video-story');

            if (!$video_url) continue;

            // Extract YouTube video ID (supports regular videos and Shorts)
            $video_id = '';
            if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $video_url, $matches)) {
                $video_id = $matches[1];
            } elseif (preg_match('/youtu\.be\/([^?]+)/', $video_url, $matches)) {
                $video_id = $matches[1];
            } elseif (preg_match('/youtube\.com\/embed\/([^?]+)/', $video_url, $matches)) {
                $video_id = $matches[1];
            } elseif (preg_match('/youtube\.com\/shorts\/([^?]+)/', $video_url, $matches)) {
                $video_id = $matches[1]; // YouTube Shorts
            }

            // Skip if no valid video ID
            if (empty($video_id)) continue;
        ?>
        <div class="flex flex-col items-center gap-2 cursor-pointer story-item"
             data-video-id="<?php echo esc_attr($video_id); ?>"
             data-video-title="<?php echo esc_attr($label ? $label : get_the_title()); ?>"
             onclick="openPlyrLightbox('<?php echo esc_attr($video_id); ?>')">
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
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>

<!-- Video Lightbox Modal with Plyr -->
<div id="video-lightbox" class="video-lightbox hidden">
    <div class="video-lightbox-backdrop" onclick="closePlyrLightbox()"></div>
    <div class="video-lightbox-content">
        <!-- Close button -->
        <button onclick="closePlyrLightbox()" class="video-lightbox-close">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Plyr Video container -->
        <div class="video-lightbox-player">
            <div id="plyr-container">
                <div id="plyr-player" data-plyr-provider="youtube" data-plyr-embed-id=""></div>
            </div>
        </div>
    </div>
</div>

<script>
let plyrInstance = null;

function openPlyrLightbox(videoId) {
    const lightbox = document.getElementById('video-lightbox');
    const playerElement = document.getElementById('plyr-player');

    // Update the video ID
    playerElement.setAttribute('data-plyr-embed-id', videoId);

    // Destroy existing player if any
    if (plyrInstance) {
        plyrInstance.destroy();
    }

    // Create new Plyr instance
    plyrInstance = new Plyr('#plyr-player', {
        controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'fullscreen'],
        youtube: {
            noCookie: true,
            rel: 0,
            showinfo: 0,
            iv_load_policy: 3,
            modestbranding: 1
        },
        autoplay: true
    });

    // Show lightbox
    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closePlyrLightbox() {
    const lightbox = document.getElementById('video-lightbox');

    // Pause and destroy player
    if (plyrInstance) {
        plyrInstance.pause();
        plyrInstance.destroy();
        plyrInstance = null;
    }

    // Reset the player element
    const container = document.getElementById('plyr-container');
    container.innerHTML = '<div id="plyr-player" data-plyr-provider="youtube" data-plyr-embed-id=""></div>';

    // Hide lightbox
    lightbox.classList.add('hidden');
    document.body.style.overflow = '';
}

// Close on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePlyrLightbox();
    }
});
</script>
