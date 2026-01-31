<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="fixed top-0 left-0 right-0 z-50">
    <!-- Top Bar -->
    <div class="bg-gray-100 border-b border-gray-200 hidden md:block">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-10 text-sm">
                <a href="mailto:ventas@infinitydisplays.cl" class="flex items-center gap-2 text-gray-600 hover:text-primary transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    ventas@infinitydisplays.cl
                </a>
                <div class="flex items-center gap-6">
                    <a href="tel:+56942057591" class="flex items-center gap-2 text-gray-600 hover:text-primary transition-colors">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        +56 9 4205 7591
                    </a>
                    <span class="text-gray-300">|</span>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'top-menu',
                        'container' => false,
                        'menu_class' => 'flex items-center gap-6',
                        'link_before' => '',
                        'link_after' => '',
                        'fallback_cb' => function() {
                            echo '<a href="' . home_url('/contacto') . '" class="text-gray-600 hover:text-primary">Contacto</a>';
                        }
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="bg-white/95 backdrop-blur-sm border-b border-gray-200 shadow-sm">
        <div class="container mx-auto px-4">
            <!-- Desktop Header -->
            <div class="hidden md:flex items-center justify-between gap-4 h-20 py-3">
                <!-- Logo -->
                <a href="<?php echo home_url('/'); ?>" class="flex items-center flex-shrink-0">
                    <?php if (has_custom_logo()): ?>
                        <?php the_custom_logo(); ?>
                    <?php else: ?>
                        <img src="<?php echo INFINITY_THEME_URI; ?>/assets/images/logo.png" alt="<?php bloginfo('name'); ?>" class="h-12 w-auto">
                    <?php endif; ?>
                </a>

                <!-- Search Bar - Desktop -->
                <div class="flex flex-1 max-w-2xl mx-4">
                    <form role="search" method="get" class="search-form w-full" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="relative">
                            <input type="search"
                                   name="s"
                                   placeholder="Buscar productos..."
                                   class="w-full px-6 py-3 pr-12 text-base border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary"
                                   value="<?php echo get_search_query(); ?>">
                            <input type="hidden" name="post_type" value="product">
                            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary p-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Actions - Desktop -->
                <div class="flex items-center gap-3 flex-shrink-0">
                    <!-- Cart Icon -->
                    <button onclick="openSideCart()" class="relative p-2 text-gray-700 hover:text-primary transition-colors" aria-label="Abrir carrito">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <?php $cart_count = WC()->cart->get_cart_contents_count(); ?><span class="infinity-cart-badge infinity-cart-badge-desktop absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full min-w-[1.25rem] h-5 flex items-center justify-center px-1<?php echo $cart_count > 0 ? '' : ' hidden'; ?>"><?php echo $cart_count; ?></span>
                    </button>

                    <?php if (is_user_logged_in()): ?>
                        <a href="<?php echo wc_get_account_endpoint_url('dashboard'); ?>" class="px-4 py-2 text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-100 rounded-md transition-colors">
                            Mi Cuenta
                        </a>
                        <a href="<?php echo wp_logout_url(home_url()); ?>" class="px-4 py-2 text-sm font-medium bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md transition-colors">
                            Cerrar Sesión
                        </a>
                    <?php else: ?>
                        <a href="<?php echo wc_get_account_endpoint_url('dashboard'); ?>" class="px-4 py-2 text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-100 rounded-md transition-colors">
                            Iniciar Sesión
                        </a>
                        <a href="<?php echo home_url('/registro-socio'); ?>" class="px-4 py-2 text-sm font-medium bg-primary hover:bg-primary/90 text-white rounded-md transition-colors">
                            Registrarse
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Mobile Header: [Hamburger] [Logo Center] [Account + Cart] -->
            <div class="md:hidden flex items-center justify-between h-16 py-2">
                <!-- Left: Hamburger Menu -->
                <button class="text-gray-700 p-2 -ml-2" id="mobile-menu-toggle" aria-label="Abrir menú">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Center: Logo -->
                <a href="<?php echo home_url('/'); ?>" class="flex items-center absolute left-1/2 transform -translate-x-1/2">
                    <?php if (has_custom_logo()): ?>
                        <?php the_custom_logo(); ?>
                    <?php else: ?>
                        <img src="<?php echo INFINITY_THEME_URI; ?>/assets/images/logo.png" alt="<?php bloginfo('name'); ?>" class="h-10 w-auto">
                    <?php endif; ?>
                </a>

                <!-- Right: Account + Cart Icons -->
                <div class="flex items-center -mr-2">
                    <!-- Account Icon -->
                    <a href="<?php echo wc_get_account_endpoint_url('dashboard'); ?>" class="p-2 text-gray-700 hover:text-primary transition-colors" aria-label="Mi cuenta">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </a>

                    <!-- Cart Icon -->
                    <button onclick="openSideCart()" class="relative p-2 text-gray-700 hover:text-primary transition-colors" aria-label="Abrir carrito">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <?php $cart_count_mobile = WC()->cart->get_cart_contents_count(); ?><span class="infinity-cart-badge infinity-cart-badge-mobile absolute -top-0.5 -right-0.5 bg-primary text-white text-xs font-bold rounded-full min-w-[1.125rem] h-[1.125rem] flex items-center justify-center text-[10px]<?php echo $cart_count_mobile > 0 ? '' : ' hidden'; ?>"><?php echo $cart_count_mobile; ?></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Search Bar -->
    <div class="md:hidden bg-white border-b border-gray-200 px-4 py-3">
        <form role="search" method="get" class="search-form w-full" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="relative">
                <input type="search"
                       name="s"
                       placeholder="Buscar productos..."
                       class="w-full px-4 py-2 pr-10 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary"
                       value="<?php echo get_search_query(); ?>">
                <input type="hidden" name="post_type" value="product">
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <!-- Category Navigation Bar -->
    <div class="hidden md:block bg-white border-b border-gray-200">
        <div class="container mx-auto px-4">
            <nav class="flex items-center justify-center gap-1 py-2">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'categories',
                    'container' => false,
                    'menu_class' => 'flex items-center justify-center gap-1 flex-wrap',
                    'fallback_cb' => function() {
                        // Fallback to WooCommerce categories if no menu is set
                        $categories = infinity_get_product_categories();
                        if ($categories && !is_wp_error($categories)):
                            foreach ($categories as $category):
                        ?>
                            <a href="<?php echo get_term_link($category); ?>" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-primary hover:bg-gray-100 rounded-md transition-colors">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        <?php
                            endforeach;
                        endif;
                    },
                    'link_before' => '',
                    'link_after' => '',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ));
                ?>
            </nav>
        </div>
    </div>

    <!-- Mobile Menu Modal (Fullscreen) -->
    <div class="mobile-menu-modal" id="mobile-menu-modal">
        <!-- Main Menu Panel -->
        <div class="mobile-menu-panel" id="mobile-menu-main">
            <div class="mobile-menu-header">
                <span class="mobile-menu-title"></span>
                <button class="mobile-menu-close" id="mobile-menu-close" aria-label="Cerrar menú">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="mobile-menu-content">
                <nav class="mobile-menu-nav">
                    <!-- User actions at top -->
                    <div class="mobile-menu-section">
                        <a href="<?php echo home_url('/#contacto'); ?>" class="mobile-menu-item">
                            Contacto
                        </a>
                        <?php if (is_user_logged_in()): ?>
                            <a href="<?php echo wc_get_account_endpoint_url('dashboard'); ?>" class="mobile-menu-item">
                                Mi Cuenta
                            </a>
                        <?php else: ?>
                            <a href="<?php echo wc_get_account_endpoint_url('dashboard'); ?>" class="mobile-menu-item">
                                Iniciar Sesión
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="mobile-menu-divider"></div>

                    <!-- Categories -->
                    <div class="mobile-menu-section" id="mobile-categories-list">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'categories',
                            'container' => false,
                            'menu_class' => 'mobile-menu-categories',
                            'fallback_cb' => function() {
                                echo '<a href="' . get_permalink(wc_get_page_id('shop')) . '" class="mobile-menu-item">Todos los productos</a>';
                                $categories = infinity_get_product_categories();
                                if ($categories && !is_wp_error($categories)):
                                    foreach ($categories as $category):
                                ?>
                                    <a href="<?php echo get_term_link($category); ?>" class="mobile-menu-item">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                <?php
                                    endforeach;
                                endif;
                            },
                            'items_wrap' => '%3$s',
                            'walker' => new Infinity_Mobile_Menu_Walker(),
                        ));
                        ?>
                    </div>

                    <div class="mobile-menu-divider"></div>

                    <!-- Auth buttons -->
                    <div class="mobile-menu-section mobile-menu-auth">
                        <?php if (is_user_logged_in()): ?>
                            <a href="<?php echo wp_logout_url(home_url()); ?>" class="mobile-menu-btn mobile-menu-btn-secondary">
                                Cerrar Sesión
                            </a>
                        <?php else: ?>
                            <a href="<?php echo home_url('/registro-socio'); ?>" class="mobile-menu-btn mobile-menu-btn-primary">
                                Registrarse
                            </a>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Submenu Panel (for drill-down) -->
        <div class="mobile-menu-panel mobile-submenu-panel" id="mobile-submenu-panel">
            <div class="mobile-menu-header">
                <button class="mobile-menu-back" id="mobile-menu-back" aria-label="Volver">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <span class="mobile-submenu-title" id="mobile-submenu-title"></span>
                <button class="mobile-menu-close" id="mobile-submenu-close" aria-label="Cerrar menú">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="mobile-menu-content">
                <nav class="mobile-menu-nav" id="mobile-submenu-content">
                    <!-- Submenu items will be injected here -->
                </nav>
            </div>
        </div>
    </div>
</header>
