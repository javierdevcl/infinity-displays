/**
 * Video Lightbox functionality for YouTube videos
 */

(function() {
    'use strict';

    // Helper to get YouTube video ID from URL
    function getYouTubeId(url) {
        const regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
        const match = url.match(regExp);
        return (match && match[7].length === 11) ? match[7] : false;
    }

    // Helper to check if URL is YouTube Shorts
    function isYouTubeShorts(url) {
        return url.includes('/shorts/');
    }

    // Get video ID from shorts URL
    function getShortsId(url) {
        const match = url.match(/\/shorts\/([^?/]+)/);
        return match ? match[1] : false;
    }

    // Open video lightbox
    window.openVideoLightbox = function(videoUrl, label) {
        const lightbox = document.getElementById('video-lightbox');
        const iframe = document.getElementById('video-iframe');

        if (!lightbox || !iframe) return;

        let videoId;

        // Check if it's a YouTube Shorts URL
        if (isYouTubeShorts(videoUrl)) {
            videoId = getShortsId(videoUrl);
        } else {
            videoId = getYouTubeId(videoUrl);
        }

        if (!videoId) {
            console.error('Invalid YouTube URL');
            return;
        }

        // Set iframe source with autoplay and minimal UI
        // Parameters: autoplay=1 (auto start), rel=0 (no related videos), modestbranding=1 (minimal YouTube logo)
        // showinfo=0 (hide title/uploader - deprecated but still works in some browsers)
        // controls=1 (show controls), iv_load_policy=3 (hide annotations)
        iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1&showinfo=0&controls=1&iv_load_policy=3`;

        // Show lightbox
        lightbox.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };

    // Close video lightbox
    window.closeVideoLightbox = function() {
        const lightbox = document.getElementById('video-lightbox');
        const iframe = document.getElementById('video-iframe');

        if (!lightbox || !iframe) return;

        // Stop video by clearing src
        iframe.src = '';

        // Hide lightbox
        lightbox.classList.add('hidden');
        document.body.style.overflow = '';
    };

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeVideoLightbox();
        }
    });

    console.log('Video lightbox system ready');

})();
