<?php
/**
 * Login Form
 *
 * @package Infinity_Displays
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_customer_login_form');
?>

<div class="woocommerce-login-wrapper max-w-md mx-auto">
    <!-- Login Form -->
    <div class="bg-white rounded-2xl border border-border shadow-sm overflow-hidden">
        <!-- Header -->
        <div class="p-6 bg-gradient-to-r from-primary to-primary/80 text-white text-center">
            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-display font-bold">Iniciar Sesión</h2>
            <p class="text-white/80 text-sm mt-1">Accede a tu cuenta para ver pedidos y más</p>
        </div>

        <!-- Form -->
        <div class="p-6">
            <form class="woocommerce-form woocommerce-form-login login" method="post">

                <?php do_action('woocommerce_login_form_start'); ?>

                <div class="space-y-4">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1.5">
                            <?php esc_html_e('Correo electrónico o usuario', 'woocommerce'); ?> <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               class="woocommerce-Input woocommerce-Input--text input-text w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors"
                               name="username"
                               id="username"
                               autocomplete="username"
                               placeholder="tu@email.com"
                               value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                            <?php esc_html_e('Contraseña', 'woocommerce'); ?> <span class="text-red-500">*</span>
                        </label>
                        <input class="woocommerce-Input woocommerce-Input--text input-text w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors"
                               type="password"
                               name="password"
                               id="password"
                               autocomplete="current-password"
                               placeholder="••••••••" />
                    </div>
                </div>

                <?php do_action('woocommerce_login_form'); ?>

                <div class="flex items-center justify-between mt-4">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme flex items-center gap-2 cursor-pointer">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary"
                               name="rememberme"
                               type="checkbox"
                               id="rememberme"
                               value="forever" />
                        <span class="text-sm text-gray-600"><?php esc_html_e('Recuérdame', 'woocommerce'); ?></span>
                    </label>
                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="text-sm text-primary hover:underline">
                        <?php esc_html_e('¿Olvidaste tu contraseña?', 'woocommerce'); ?>
                    </a>
                </div>

                <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>

                <button type="submit"
                        class="woocommerce-button button woocommerce-form-login__submit w-full mt-6 px-6 py-3 bg-primary hover:bg-primary/90 text-white font-semibold rounded-lg transition-colors"
                        name="login"
                        value="<?php esc_attr_e('Iniciar sesión', 'woocommerce'); ?>">
                    <?php esc_html_e('Iniciar Sesión', 'woocommerce'); ?>
                </button>

                <?php do_action('woocommerce_login_form_end'); ?>

            </form>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 bg-gray-50 border-t border-border text-center">
            <p class="text-sm text-gray-600">
                ¿No tienes cuenta?
                <a href="<?php echo esc_url(home_url('/registro-socio')); ?>" class="text-primary font-medium hover:underline">
                    Regístrate como Socio
                </a>
            </p>
        </div>
    </div>

    <!-- Benefits -->
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="text-center p-4">
            <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <p class="text-xs text-gray-600">Historial de pedidos</p>
        </div>
        <div class="text-center p-4">
            <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-xs text-gray-600">Precios exclusivos</p>
        </div>
        <div class="text-center p-4">
            <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <p class="text-xs text-gray-600">Compra más rápido</p>
        </div>
    </div>
</div>

<?php do_action('woocommerce_after_customer_login_form'); ?>
