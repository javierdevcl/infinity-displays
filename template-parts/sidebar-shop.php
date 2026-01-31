<?php
/**
 * Shop Sidebar Template
 *
 * @package Infinity_Displays
 */

$current_user = wp_get_current_user();
$is_logged_in = is_user_logged_in();
?>

<aside class="w-full lg:w-80 space-y-4 lg:sticky lg:top-24 self-start">

    <?php if (!$is_logged_in): ?>
    <!-- Register CTA -->
    <div class="bg-primary p-4 rounded-xl">
        <div class="flex items-center gap-2 mb-2">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <h3 class="font-bold text-white">¿No tienes cuenta?</h3>
        </div>
        <p class="text-white/80 text-sm mb-3">
            Accede a precios mayoristas exclusivos y descuentos especiales.
        </p>
        <a href="<?php echo home_url('/registro-socio'); ?>" class="block w-full text-center px-4 py-2 bg-white text-primary font-semibold rounded-lg hover:bg-gray-100 transition-colors">
            Registrarse Ahora
        </a>
    </div>

    <!-- Login Form -->
    <div class="bg-card border border-border rounded-xl p-4">
        <div class="flex items-center gap-2 mb-4">
            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <h3 class="font-semibold text-foreground">Iniciar Sesión</h3>
        </div>
        <form method="post" action="<?php echo esc_url(wp_login_url()); ?>" class="space-y-3">
            <div>
                <label class="text-xs text-muted-foreground mb-1 block">Email</label>
                <input
                    type="email"
                    name="log"
                    required
                    class="w-full px-3 py-2 rounded-lg bg-secondary border border-border text-sm text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50"
                    placeholder="tu@email.com"
                />
            </div>
            <div>
                <label class="text-xs text-muted-foreground mb-1 block">Contraseña</label>
                <input
                    type="password"
                    name="pwd"
                    required
                    class="w-full px-3 py-2 rounded-lg bg-secondary border border-border text-sm text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50"
                    placeholder="••••••••"
                />
            </div>
            <button type="submit" class="w-full px-4 py-2 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors">
                Entrar
            </button>
            <p class="text-xs text-center text-muted-foreground">
                <a href="<?php echo wp_lostpassword_url(); ?>" class="text-primary hover:underline">¿Olvidaste tu contraseña?</a>
            </p>
        </form>
    </div>
    <?php else: ?>
    <!-- Welcome User -->
    <div class="bg-primary p-4 rounded-xl">
        <div class="flex items-center gap-2 mb-2">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <h3 class="font-bold text-white">¡Hola, <?php echo esc_html($current_user->display_name); ?>!</h3>
        </div>
        <p class="text-white/80 text-sm mb-3">
            Bienvenido de vuelta. Tienes acceso a precios especiales.
        </p>
        <a href="<?php echo wp_logout_url(home_url()); ?>" class="block w-full text-center px-4 py-2 bg-white text-primary font-semibold rounded-lg hover:bg-gray-100 transition-colors">
            Cerrar Sesión
        </a>
    </div>
    <?php endif; ?>

    <!-- Turnaround -->
    <div class="bg-card border border-border rounded-xl p-4">
        <div class="flex items-center gap-2 mb-3">
            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="font-semibold text-foreground">Tiempo de Entrega</h3>
        </div>
        <p class="text-sm text-muted-foreground mb-2">
            Despacho express en <span class="text-foreground font-medium">24-48hrs</span> para pedidos en la Región Metropolitana.
        </p>
        <div class="mt-3 bg-green-500/10 border border-green-500/30 rounded-lg p-3">
            <div class="flex items-center gap-2 text-green-600 font-semibold text-sm mb-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                </svg>
                Express Turnaround
            </div>
            <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">DISPONIBLE</span>
            <p class="text-xs text-muted-foreground mt-2">
                Contáctanos para detalles de envío express
            </p>
        </div>
    </div>

    <!-- Contact -->
    <div class="bg-card border border-border rounded-xl p-4">
        <div class="flex items-center gap-2 mb-3">
            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
            </svg>
            <h3 class="font-semibold text-foreground">Contáctanos</h3>
        </div>
        <div class="flex items-center gap-2 mb-3">
            <span class="text-sm text-muted-foreground">Estamos actualmente</span>
            <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">ABIERTO</span>
        </div>
        <p class="text-sm text-muted-foreground mb-4">
            Envíanos un email o WhatsApp y te responderemos a la brevedad.
        </p>
        <div class="space-y-2">
            <a
                href="mailto:ventas@infinitydisplays.cl"
                class="flex items-center gap-2 text-sm text-primary hover:underline"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                ventas@infinitydisplays.cl
            </a>
            <a
                href="https://wa.me/56942057591"
                target="_blank"
                rel="noopener noreferrer"
                class="flex items-center gap-2 text-sm text-green-600 hover:underline"
            >
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                +56 9 4205 7591
            </a>
        </div>
    </div>

    <!-- Delivery Info -->
    <div class="bg-card border border-border rounded-xl p-4">
        <div class="flex items-center gap-2 mb-3">
            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
            </svg>
            <h3 class="font-semibold text-foreground">Información de Envío</h3>
        </div>
        <ul class="space-y-2 text-sm">
            <li class="flex items-start gap-2">
                <svg class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-muted-foreground">Envío gratis sobre $500.000</span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-muted-foreground">Despacho a todo Chile</span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-muted-foreground">Retiro en bodega disponible</span>
            </li>
        </ul>
    </div>

</aside>
