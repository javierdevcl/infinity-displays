/**
 * Side Cart Functionality
 */

// Open side cart
function openSideCart() {
    const sideCart = document.getElementById('side-cart');
    if (sideCart) {
        sideCart.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

// Close side cart
function closeSideCart() {
    const sideCart = document.getElementById('side-cart');
    if (sideCart) {
        sideCart.classList.remove('active');
        document.body.style.overflow = '';
    }
}

(function($) {
    'use strict';

    $(document).ready(function() {

        // Close side cart on overlay click
        $('.side-cart-overlay').on('click', function() {
            closeSideCart();
        });

        // Close on ESC key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSideCart();
            }
        });

        // Handle Add to Cart buttons (AJAX) - Single product page
        $(document.body).on('click', '.single_add_to_cart_button:not(.disabled)', function(e) {
            e.preventDefault();

            const $button = $(this);
            const $form = $button.closest('form.cart');
            const formData = new FormData($form[0]);

            // Add loading state
            $button.addClass('loading').prop('disabled', true);
            const originalText = $button.html();
            $button.html('<svg class="animate-spin w-4 h-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>');

            $.ajax({
                type: 'POST',
                url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.error) {
                        // Show error
                        showNotification(response.error_message || 'Error al agregar al carrito', 'error');
                    } else {
                        // Success - update cart
                        $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $button]);
                    }
                },
                error: function() {
                    showNotification('Error al agregar al carrito', 'error');
                },
                complete: function() {
                    $button.removeClass('loading').prop('disabled', false).html(originalText);
                }
            });
        });

        // Handle Add to Cart from product loops - CRITICAL FIX
        $(document.body).on('click', '.add_to_cart_button:not(.product_type_variable):not(.product_type_grouped)', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            const $button = $(this);
            const productId = $button.data('product_id');

            // Don't proceed if button is already loading
            if ($button.hasClass('loading')) {
                return false;
            }

            $button.addClass('loading');

            $.ajax({
                type: 'POST',
                url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
                data: {
                    product_id: productId,
                    quantity: 1
                },
                success: function(response) {
                    if (response.error) {
                        showNotification(response.error_message || 'Error al agregar al carrito', 'error');
                    } else {
                        // Trigger WooCommerce event
                        $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $button]);
                    }
                },
                error: function() {
                    showNotification('Error al agregar al carrito', 'error');
                },
                complete: function() {
                    $button.removeClass('loading');
                }
            });

            return false;
        });

        // Listen for WooCommerce added_to_cart event and open side cart
        $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button) {
            // Update fragments
            if (fragments) {
                $.each(fragments, function(key, value) {
                    $(key).replaceWith(value);
                });
            }

            // Refresh side cart and open it
            refreshSideCart(function() {
                openSideCart();
            });
        });

        // Update cart when quantity changes
        $(document).on('click', '.cart-qty-plus, .cart-qty-minus', function(e) {
            e.preventDefault();
            console.log('Quantity button clicked'); // Debug

            const $button = $(this);
            const $item = $button.closest('.side-cart-item');
            const cartKey = $button.data('cart-key');
            const $quantitySpan = $item.find('span.px-3');
            let currentQty = parseInt($quantitySpan.text());

            console.log('Cart key:', cartKey, 'Current qty:', currentQty); // Debug

            // Calculate new quantity
            let newQty = currentQty;
            if ($button.hasClass('cart-qty-plus')) {
                newQty = currentQty + 1;
            } else if ($button.hasClass('cart-qty-minus') && currentQty > 1) {
                newQty = currentQty - 1;
            } else if ($button.hasClass('cart-qty-minus') && currentQty === 1) {
                // If quantity is 1 and minus is clicked, remove item
                console.log('Removing item with qty 1'); // Debug
                updateCartItemQuantity(cartKey, 0);
                return;
            } else {
                return; // Don't allow quantity less than 1
            }

            console.log('New qty:', newQty); // Debug

            // Update quantity via AJAX
            updateCartItemQuantity(cartKey, newQty);
        });

        // Remove item from cart
        $(document).on('click', '.cart-remove-item', function(e) {
            e.preventDefault();
            console.log('Remove button clicked'); // Debug

            const $button = $(this);
            const cartKey = $button.data('cart-key');

            console.log('Removing cart key:', cartKey); // Debug

            // Remove directly without confirmation
            updateCartItemQuantity(cartKey, 0);
        });

    });

    /**
     * Update cart item quantity
     */
    function updateCartItemQuantity(cartKey, quantity) {
        // Determine AJAX URL
        let ajaxUrl;
        if (typeof wc_add_to_cart_params !== 'undefined' && wc_add_to_cart_params.wc_ajax_url) {
            ajaxUrl = wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'update_cart_item_qty');
        } else if (typeof infinityAjax !== 'undefined') {
            ajaxUrl = infinityAjax.ajaxurl + '?action=update_cart_item_qty';
        } else {
            console.error('No AJAX URL available');
            showNotification('Error al actualizar el carrito', 'error');
            return;
        }

        $.ajax({
            type: 'POST',
            url: ajaxUrl,
            data: {
                cart_item_key: cartKey,
                quantity: quantity
            },
            success: function(response) {
                if (response && response.fragments) {
                    // Update fragments
                    $.each(response.fragments, function(key, value) {
                        $(key).replaceWith(value);
                    });

                    // Refresh side cart
                    refreshSideCart();
                } else if (response && response.success) {
                    // Refresh side cart even if no fragments
                    refreshSideCart();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                showNotification('Error al actualizar el carrito', 'error');
                // Still try to refresh in case of error
                refreshSideCart();
            }
        });
    }

    /**
     * Refresh side cart content
     */
    function refreshSideCart(callback) {
        const $sideCart = $('#side-cart');

        if (!$sideCart.length) {
            if (callback) callback();
            return;
        }

        // Determine AJAX URL for getting fragments
        let ajaxUrl;
        if (typeof wc_add_to_cart_params !== 'undefined' && wc_add_to_cart_params.wc_ajax_url) {
            ajaxUrl = wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments');
        } else {
            // Fallback: trigger WC cart fragments update
            $(document.body).trigger('wc_fragment_refresh');
            if (callback) callback();
            return;
        }

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            success: function(data) {
                if (data && data.fragments) {
                    // Update all fragments
                    $.each(data.fragments, function(key, value) {
                        $(key).replaceWith(value);
                    });
                }

                // Also trigger WooCommerce fragment update
                $(document.body).trigger('wc_fragments_refreshed');

                if (callback) callback();
            },
            error: function() {
                if (callback) callback();
            }
        });
    }

    /**
     * Show notification (reusing from main.js if exists, otherwise create)
     */
    function showNotification(message, type = 'info') {
        // Check if main.js showNotification exists
        if (typeof window.showNotification === 'function') {
            window.showNotification(message, type);
            return;
        }

        // Otherwise create our own
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

})(jQuery);

// Expose functions globally
window.openSideCart = openSideCart;
window.closeSideCart = closeSideCart;
