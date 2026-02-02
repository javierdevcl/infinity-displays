<?php
/**
 * Front Page Template
 *
 * @package Infinity_Displays
 */

get_header();

// Hero slides - Trust/Brand messaging
$hero_slides = array(
    array(
        'title' => 'Calidad Profesional Garantizada',
        'subtitle' => 'Productos de alta calidad para tu negocio',
        'description' => 'Trabajamos solo con materiales premium y tecnología de punta para ofrecerte displays que impactan.',
        'icon' => 'quality',
        'color' => 'primary',
    ),
    array(
        'title' => 'Despacho en 24 Horas',
        'subtitle' => 'Entrega rápida en Santiago',
        'description' => 'Pedidos antes de las 14:00 hrs se despachan el mismo día. Envíos a todo Chile.',
        'icon' => 'shipping',
        'color' => 'green',
    ),
    array(
        'title' => 'Sala de Ventas',
        'subtitle' => 'Visítanos y conoce nuestros productos',
        'description' => 'Ven a nuestra sala de ventas, prueba los productos y recibe asesoría personalizada de nuestro equipo.',
        'icon' => 'store',
        'color' => 'blue',
    ),
    array(
        'title' => 'Stock Permanente',
        'subtitle' => 'Bodega con inventario disponible',
        'description' => 'Mantenemos stock de todos nuestros productos para que nunca tengas que esperar.',
        'icon' => 'warehouse',
        'color' => 'purple',
    ),
);
$slide_count = count($hero_slides);
?>

<section class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-2xl"></div>
    </div>

    <div class="container mx-auto px-4 py-12 lg:py-20">
        <div class="hero-slider relative" data-slide-count="<?php echo $slide_count; ?>">
            <!-- Slides Container -->
            <div class="hero-slides">
                <?php foreach ($hero_slides as $index => $slide): ?>
                <div class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                    <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-16">

                        <!-- Content - Left Side -->
                        <div class="flex-1 z-10 text-left order-2 lg:order-1">
                            <span class="inline-block px-4 py-1.5 bg-<?php echo $slide['color']; ?>-500/20 text-<?php echo $slide['color'] === 'primary' ? 'primary' : $slide['color'] . '-400'; ?> rounded-full text-sm font-semibold mb-4 uppercase tracking-wide border border-<?php echo $slide['color'] === 'primary' ? 'primary' : $slide['color'] . '-500'; ?>/30">
                                <?php echo esc_html($slide['subtitle']); ?>
                            </span>

                            <h2 class="text-3xl lg:text-5xl font-display font-bold text-white mb-5 leading-tight">
                                <?php echo esc_html($slide['title']); ?>
                            </h2>

                            <p class="text-lg text-gray-300 mb-8 max-w-xl leading-relaxed">
                                <?php echo esc_html($slide['description']); ?>
                            </p>

                            <div class="flex flex-wrap gap-4">
                                <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="inline-flex items-center justify-center px-8 py-4 bg-primary text-white text-lg font-semibold rounded-xl hover:bg-primary/90 transition-all hover:shadow-xl hover:shadow-primary/30 hover:-translate-y-0.5">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Ver Productos
                                </a>
                                <a href="https://wa.me/56942057591" target="_blank" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 text-white text-lg font-semibold rounded-xl hover:bg-white/20 transition-all border border-white/20">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                    Contactar
                                </a>
                            </div>
                        </div>

                        <!-- Icon/Visual - Right Side -->
                        <div class="flex-shrink-0 order-1 lg:order-2">
                            <div class="relative w-64 h-64 sm:w-72 sm:h-72 lg:w-80 lg:h-80 mx-auto">
                                <!-- Animated background circles -->
                                <div class="absolute inset-0 bg-<?php echo $slide['color'] === 'primary' ? 'primary' : $slide['color'] . '-500'; ?>/20 rounded-full animate-pulse"></div>
                                <div class="absolute inset-4 bg-<?php echo $slide['color'] === 'primary' ? 'primary' : $slide['color'] . '-500'; ?>/10 rounded-full"></div>

                                <!-- Icon -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <?php if ($slide['icon'] === 'quality'): ?>
                                    <svg class="w-32 h-32 lg:w-40 lg:h-40 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                    <?php elseif ($slide['icon'] === 'shipping'): ?>
                                    <svg class="w-32 h-32 lg:w-40 lg:h-40 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                                    </svg>
                                    <?php elseif ($slide['icon'] === 'store'): ?>
                                    <svg class="w-32 h-32 lg:w-40 lg:h-40 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <?php elseif ($slide['icon'] === 'warehouse'): ?>
                                    <svg class="w-32 h-32 lg:w-40 lg:h-40 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Navigation Arrows -->
            <button class="hero-prev absolute left-0 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-colors z-20 hidden lg:flex">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button class="hero-next absolute right-0 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-colors z-20 hidden lg:flex">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Dots Navigation -->
            <div class="hero-dots flex justify-center gap-2 mt-10">
                <?php for ($i = 0; $i < $slide_count; $i++): ?>
                <button class="hero-dot w-2.5 h-2.5 rounded-full transition-all <?php echo $i === 0 ? 'bg-primary w-8' : 'bg-white/30 hover:bg-white/50'; ?>" data-index="<?php echo $i; ?>"></button>
                <?php endfor; ?>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.querySelector('.hero-slider');
            if (!slider) return;

            const slides = slider.querySelectorAll('.hero-slide');
            const dots = slider.querySelectorAll('.hero-dot');
            const prevBtn = slider.querySelector('.hero-prev');
            const nextBtn = slider.querySelector('.hero-next');
            const slideCount = parseInt(slider.dataset.slideCount);

            if (slideCount <= 1) return;

            let currentSlide = 0;
            let autoplayInterval;

            function showSlide(index) {
                if (index >= slideCount) index = 0;
                if (index < 0) index = slideCount - 1;

                slides.forEach((slide, i) => {
                    slide.classList.toggle('active', i === index);
                });

                dots.forEach((dot, i) => {
                    dot.classList.toggle('bg-primary', i === index);
                    dot.classList.toggle('w-8', i === index);
                    dot.classList.toggle('bg-white/30', i !== index);
                    dot.classList.toggle('w-2.5', i !== index);
                });

                currentSlide = index;
            }

            function nextSlide() { showSlide(currentSlide + 1); }
            function prevSlide() { showSlide(currentSlide - 1); }
            function startAutoplay() { autoplayInterval = setInterval(nextSlide, 5000); }
            function stopAutoplay() { clearInterval(autoplayInterval); }

            if (prevBtn) prevBtn.addEventListener('click', function() { stopAutoplay(); prevSlide(); startAutoplay(); });
            if (nextBtn) nextBtn.addEventListener('click', function() { stopAutoplay(); nextSlide(); startAutoplay(); });

            dots.forEach((dot, i) => {
                dot.addEventListener('click', function() { stopAutoplay(); showSlide(i); startAutoplay(); });
            });

            // Touch support
            let touchStartX = 0;
            slider.addEventListener('touchstart', function(e) { touchStartX = e.changedTouches[0].screenX; stopAutoplay(); }, { passive: true });
            slider.addEventListener('touchend', function(e) {
                const diff = touchStartX - e.changedTouches[0].screenX;
                if (Math.abs(diff) > 50) { diff > 0 ? nextSlide() : prevSlide(); }
                startAutoplay();
            }, { passive: true });

            startAutoplay();
        });
        </script>
    </div>
</section>

<!-- Main Content with Sidebar -->
<section class="py-6 bg-background">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Products Area -->
            <div class="flex-1">
                <!-- Video Stories -->
                <?php get_template_part('template-parts/video', 'stories'); ?>

                <!-- Membership Banner -->
                <div class="mb-6 bg-primary/5 border-2 border-primary/20 rounded-xl p-6 text-center">
                    <div class="flex items-center justify-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <h3 class="font-bold text-primary">¡Hazte Socio y Ahorra!</h3>
                    </div>
                    <p class="text-muted-foreground text-sm mb-4">
                        Regístrate como socio y accede a precios exclusivos todo el mes. Solo necesitas comprar al menos 1 vez al mes para mantener tu beneficio.
                    </p>
                    <a href="<?php echo home_url('/registro-socio'); ?>" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors">
                        Registrarse Ahora
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Products Grid -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-display font-bold text-foreground">Nuestros Productos</h2>
                    </div>

                    <?php
                    // Get all products
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 12,
                        'orderby' => 'menu_order date',
                        'order' => 'ASC',
                    );

                    $products = new WP_Query($args);

                    if ($products->have_posts()):
                    ?>
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php
                            while ($products->have_posts()):
                                $products->the_post();
                                wc_get_template_part('content', 'product');
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>

                        <div class="text-center mt-8">
                            <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors">
                                Ver Todos los Productos
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    <?php else: ?>
                        <p class="text-center text-muted-foreground py-12">No hay productos disponibles en este momento.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sidebar -->
            <?php get_template_part('template-parts/sidebar', 'shop'); ?>

        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                    </svg>
                </div>
                <h3 class="font-display font-semibold text-lg mb-2">Envío Rápido a RM</h3>
                <p class="text-muted-foreground text-sm">Entrega en 24-48hrs a toda la Región Metropolitana</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="font-display font-semibold text-lg mb-2">Garantía 6 Meses</h3>
                <p class="text-muted-foreground text-sm">Todos nuestros productos con garantía de calidad</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <h3 class="font-display font-semibold text-lg mb-2">Precios de Mayorista</h3>
                <p class="text-muted-foreground text-sm">Descuentos por volumen desde 6 unidades</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-primary to-primary/80">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl lg:text-4xl font-display font-bold text-white mb-4">
            ¿Necesitas asesoría personalizada?
        </h2>
        <p class="text-lg text-white/90 mb-8 max-w-2xl mx-auto">
            Nuestro equipo está listo para ayudarte a encontrar la solución perfecta para tu negocio.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <button onclick="openQuoteModal()" class="infinity-quote-btn inline-flex items-center px-6 py-3 bg-white text-primary font-semibold rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Solicitar Cotización
            </button>
            <a href="tel:+56942057591" class="inline-flex items-center px-6 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                Llamar Ahora
            </a>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto">
            <h2 class="text-2xl font-display font-bold text-foreground mb-4">
                ¿Tienes dudas sobre tu pedido?
            </h2>
            <p class="text-muted-foreground mb-6">
                Envíanos un email o WhatsApp y te responderemos a la brevedad. Estamos aquí para ayudarte.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="mailto:ventas@infinitydisplays.cl" class="inline-flex items-center gap-2 text-primary hover:underline">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    ventas@infinitydisplays.cl
                </a>
                <a href="https://wa.me/56942057591" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-green-600 hover:underline">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    +56 9 4205 7591
                </a>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
