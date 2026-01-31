/**
 * Infinity Displays Theme - Main JavaScript
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {

        // Mobile Menu Toggle
        initMobileMenu();

        // Smooth Scroll for Anchor Links
        initSmoothScroll();

        // Product Image Zoom (optional enhancement)
        initProductImageZoom();

        // Dynamic Cart Count Update
        updateCartCount();

        // WhatsApp Quote Functionality
        initWhatsAppQuote();

        // Form Enhancements
        initFormEnhancements();

        // Back to Top Button
        initBackToTop();

        // Dropdown Menus
        initDropdownMenus();
    });

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const menuToggle = $('#mobile-menu-toggle');
        const mobileMenu = $('#mobile-menu');
        const menuIcon = menuToggle.find('.menu-icon');
        const closeIcon = menuToggle.find('.close-icon');

        menuToggle.on('click', function() {
            mobileMenu.toggleClass('active');
            menuIcon.toggleClass('hidden');
            closeIcon.toggleClass('hidden');
        });

        // Close menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#mobile-menu, #mobile-menu-toggle').length) {
                mobileMenu.removeClass('active');
                menuIcon.removeClass('hidden');
                closeIcon.addClass('hidden');
            }
        });

        // Handle mobile submenu toggle - Only for categories menu
        $('#mobile-menu .menu-item-has-children').each(function() {
            const $parent = $(this);
            const $link = $parent.find('> a');
            const $submenu = $parent.find('> .sub-menu');
            const categoryName = $link.text().trim();

            // Don't add toggle if it already exists or if parent has sub-menu
            if (!$parent.find('> .submenu-toggle').length && $submenu.length) {
                const $toggle = $('<button class="submenu-toggle" aria-label="Toggle submenu"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>');

                // Make link container relative and add toggle button after link
                $parent.css('position', 'relative');
                $link.after($toggle);

                // Add header with close button to submenu if not already present
                if (!$submenu.find('.submenu-header').length) {
                    const $header = $('<div class="submenu-header"><span class="submenu-title">' + categoryName + '</span><button class="submenu-close" aria-label="Cerrar submenú"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button></div>');
                    $submenu.prepend($header);
                }
            }
        });

        // Toggle submenu on button click
        $(document).on('click', '#mobile-menu .submenu-toggle', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const $button = $(this);
            const $parent = $button.closest('.menu-item-has-children');
            const $submenu = $parent.find('> .sub-menu');

            // Close other open submenus at the same level
            $parent.siblings('.menu-item-has-children').find('> .sub-menu').slideUp(250);
            $parent.siblings('.menu-item-has-children').removeClass('submenu-open');

            // Toggle this submenu
            $parent.toggleClass('submenu-open');
            $submenu.slideToggle(250);
        });

        // Close submenu on X button click
        $(document).on('click', '#mobile-menu .submenu-close', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const $submenu = $(this).closest('.sub-menu');
            const $parent = $submenu.closest('.menu-item-has-children');

            $parent.removeClass('submenu-open');
            $submenu.slideUp(250);
        });

        // Toggle submenu on parent link click
        $('#mobile-menu .menu-item-has-children > a').on('click', function(e) {
            const $parent = $(this).closest('.menu-item-has-children');
            if ($parent.find('> .sub-menu').length) {
                e.preventDefault();
                $parent.find('> .submenu-toggle').trigger('click');
            }
        });
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        $('a[href*="#"]:not([href="#"])').on('click', function(e) {
            const target = $(this.hash);

            if (target.length) {
                e.preventDefault();

                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 600);
            }
        });
    }

    /**
     * Product Image Zoom (Simple hover zoom)
     */
    function initProductImageZoom() {
        $('.woocommerce-product-gallery__image img').on('mouseenter', function() {
            $(this).css('transform', 'scale(1.1)');
        }).on('mouseleave', function() {
            $(this).css('transform', 'scale(1)');
        });
    }

    /**
     * Update Cart Count in Header
     */
    function updateCartCount() {
        // Listen for WooCommerce cart updates
        $(document.body).on('added_to_cart removed_from_cart updated_cart_totals', function() {
            $.ajax({
                url: infinityAjax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'infinity_get_cart_count'
                },
                success: function(response) {
                    if (response.success) {
                        $('.cart-count').text(response.data.count);
                    }
                }
            });
        });
    }

    /**
     * WhatsApp Quote Functionality
     */
    function initWhatsAppQuote() {
        // Single Product Page - Quote Button
        $('.quote-whatsapp').on('click', function(e) {
            e.preventDefault();

            const productId = $(this).data('product-id');
            const productName = $(this).data('product-name') || 'Producto';
            const quantity = $('#quantity-' + productId).val() || 1;
            const currentPrice = $('#current-price-' + productId).text();
            const totalPrice = $('#total-price-' + productId).text();

            const message = `Hola! Me interesa cotizar:\n- Producto: ${productName}\n- Cantidad: ${quantity} unidades\n- Precio unitario: ${currentPrice}\n- Total estimado: ${totalPrice}`;

            const whatsappUrl = `https://wa.me/56942057591?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        });

        // Cart Page - Quote All Cart Items
        $('.quote-cart-whatsapp').on('click', function(e) {
            e.preventDefault();

            let cartMessage = 'Hola! Me interesa cotizar los siguientes productos:\n\n';

            $('.woocommerce-cart-form__cart-item').each(function() {
                const productName = $(this).find('.product-name a').text();
                const quantity = $(this).find('.qty').val();
                const price = $(this).find('.product-subtotal').text();

                cartMessage += `- ${productName} (${quantity} unidades): ${price}\n`;
            });

            const total = $('.order-total .woocommerce-Price-amount').text();
            cartMessage += `\nTotal: ${total}`;

            const whatsappUrl = `https://wa.me/56942057591?text=${encodeURIComponent(cartMessage)}`;
            window.open(whatsappUrl, '_blank');
        });
    }

    /**
     * Form Enhancements
     */
    function initFormEnhancements() {
        // Add loading state to forms
        $('form').on('submit', function() {
            const submitBtn = $(this).find('button[type="submit"], input[type="submit"]');

            if (!submitBtn.hasClass('no-loading')) {
                submitBtn.prop('disabled', true).addClass('loading');

                // Add spinner if not exists
                if (!submitBtn.find('.spinner').length) {
                    submitBtn.prepend('<span class="spinner"></span>');
                }
            }
        });

        // Phone number formatting (Chilean format)
        $('input[type="tel"]').on('input', function() {
            let value = $(this).val().replace(/\D/g, '');

            // Format: +56 9 1234 5678
            if (value.startsWith('56')) {
                value = value.slice(2);
            }

            if (value.length > 0) {
                value = '+56 ' + value;
            }

            $(this).val(value);
        });

        // RUT validation and formatting
        $('input[name="rut"]').on('input', function() {
            let value = $(this).val().replace(/[^0-9kK]/g, '');

            if (value.length > 1) {
                const dv = value.slice(-1);
                const rut = value.slice(0, -1);

                // Format: 12.345.678-9
                value = rut.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + dv;
            }

            $(this).val(value);
        });
    }

    /**
     * Back to Top Button
     */
    function initBackToTop() {
        // Create back to top button if not exists
        if (!$('#back-to-top').length) {
            $('body').append('<button id="back-to-top" class="back-to-top" aria-label="Volver arriba"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg></button>');
        }

        const backToTop = $('#back-to-top');

        // Show/hide based on scroll position
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                backToTop.addClass('show');
            } else {
                backToTop.removeClass('show');
            }
        });

        // Scroll to top on click
        backToTop.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: 0 }, 600);
        });
    }

    /**
     * Dropdown Menu Enhancement
     */
    function initDropdownMenus() {
        const menuItems = $('.menu-item-has-children');

        // Add ARIA attributes for accessibility
        menuItems.each(function() {
            const $this = $(this);
            const $link = $this.find('> a');
            const $submenu = $this.find('> .sub-menu');

            // Add unique ID to submenu
            const submenuId = 'submenu-' + Math.random().toString(36).substr(2, 9);
            $submenu.attr('id', submenuId);

            // Add ARIA attributes
            $link.attr({
                'aria-haspopup': 'true',
                'aria-expanded': 'false',
                'aria-controls': submenuId
            });
        });

        // Mobile touch support
        if ('ontouchstart' in window) {
            menuItems.on('touchstart', function(e) {
                const $this = $(this);
                const $link = $this.find('> a');
                const $submenu = $this.find('> .sub-menu');

                // If submenu is hidden, show it and prevent navigation
                if (!$submenu.hasClass('show-mobile')) {
                    e.preventDefault();

                    // Hide all other submenus
                    $('.sub-menu').removeClass('show-mobile');
                    $('.menu-item-has-children > a').attr('aria-expanded', 'false');

                    // Show this submenu
                    $submenu.addClass('show-mobile');
                    $link.attr('aria-expanded', 'true');
                }
            });

            // Close submenu when clicking outside
            $(document).on('touchstart', function(e) {
                if (!$(e.target).closest('.menu-item-has-children').length) {
                    $('.sub-menu').removeClass('show-mobile');
                    $('.menu-item-has-children > a').attr('aria-expanded', 'false');
                }
            });
        }

        // Desktop hover enhancement (update ARIA)
        menuItems.on('mouseenter', function() {
            $(this).find('> a').attr('aria-expanded', 'true');
        }).on('mouseleave', function() {
            $(this).find('> a').attr('aria-expanded', 'false');
        });

        // Keyboard navigation
        menuItems.find('> a').on('keydown', function(e) {
            const $this = $(this);
            const $parent = $this.parent();
            const $submenu = $parent.find('> .sub-menu');

            // Enter or Space - toggle submenu
            if (e.keyCode === 13 || e.keyCode === 32) {
                e.preventDefault();

                const isExpanded = $this.attr('aria-expanded') === 'true';

                if (!isExpanded) {
                    // Close all other submenus
                    $('.sub-menu').removeClass('show-keyboard');
                    $('.menu-item-has-children > a').attr('aria-expanded', 'false');

                    // Open this submenu
                    $submenu.addClass('show-keyboard');
                    $this.attr('aria-expanded', 'true');

                    // Focus first item in submenu
                    setTimeout(function() {
                        $submenu.find('a').first().focus();
                    }, 100);
                } else {
                    $submenu.removeClass('show-keyboard');
                    $this.attr('aria-expanded', 'false');
                }
            }

            // Escape - close submenu
            if (e.keyCode === 27) {
                $submenu.removeClass('show-keyboard');
                $this.attr('aria-expanded', 'false');
                $this.focus();
            }
        });

        // Close submenus on ESC key
        $(document).on('keydown', function(e) {
            if (e.keyCode === 27) {
                $('.sub-menu').removeClass('show-keyboard show-mobile');
                $('.menu-item-has-children > a').attr('aria-expanded', 'false');
            }
        });
    }

    /**
     * AJAX Get Cart Count
     */
    $.ajax({
        url: infinityAjax.ajaxurl,
        type: 'POST',
        data: {
            action: 'infinity_get_cart_count'
        },
        success: function(response) {
            if (response.success && $('.cart-count').length) {
                $('.cart-count').text(response.data.count);
            }
        }
    });

})(jQuery);

/**
 * Vanilla JS for Critical Functions
 */
document.addEventListener('DOMContentLoaded', function() {

    // Lazy Load Images (Simple implementation)
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        observer.unobserve(img);
                    }
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Add to Cart Animation
    document.addEventListener('click', function(e) {
        if (e.target.closest('.add_to_cart_button')) {
            const btn = e.target.closest('.add_to_cart_button');
            btn.classList.add('loading');

            setTimeout(() => {
                btn.classList.remove('loading');
                btn.classList.add('added');

                // Show success message
                showNotification('Producto agregado al carrito', 'success');
            }, 1000);
        }
    });

    /**
     * Show Notification (Toast-like)
     */
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.textContent = message;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.add('show');
        }, 100);

        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }
});

/**
 * Add CSS for Back to Top Button and Notifications
 */
const style = document.createElement('style');
style.textContent = `
    .back-to-top {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 3rem;
        height: 3rem;
        background-color: var(--color-primary);
        color: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 999;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .back-to-top.show {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top:hover {
        background-color: rgba(0, 168, 204, 0.9);
        transform: translateY(-3px);
    }

    .notification {
        position: fixed;
        top: 5rem;
        right: 2rem;
        padding: 1rem 1.5rem;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease;
        max-width: 300px;
    }

    .notification.show {
        opacity: 1;
        transform: translateX(0);
    }

    .notification-success {
        border-left: 4px solid #10b981;
    }

    .notification-error {
        border-left: 4px solid #ef4444;
    }

    .notification-info {
        border-left: 4px solid #3b82f6;
    }

    @media (max-width: 768px) {
        .back-to-top {
            bottom: 1rem;
            right: 1rem;
            width: 2.5rem;
            height: 2.5rem;
        }

        .notification {
            right: 1rem;
            left: 1rem;
            max-width: none;
        }
    }
`;
document.head.appendChild(style);
