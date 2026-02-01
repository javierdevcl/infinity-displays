<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <!-- Links -->
            <div class="flex flex-wrap items-center justify-center gap-4 text-sm text-gray-500">
                <a href="<?php echo home_url('/'); ?>" class="hover:text-primary transition-colors">
                    Volver a la tienda
                </a>
                <span class="text-gray-300 hidden sm:inline">|</span>
                <a href="<?php echo get_privacy_policy_url(); ?>" class="hover:text-primary transition-colors">
                    Política de Privacidad
                </a>
                <span class="text-gray-300 hidden sm:inline">|</span>
                <a href="<?php echo home_url('/terminos-y-condiciones'); ?>" class="hover:text-primary transition-colors">
                    Términos y Condiciones
                </a>
            </div>

            <!-- Copyright -->
            <p class="text-sm text-gray-500 text-center sm:text-right">
                &copy; <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?>
            </p>
        </div>

        <!-- Trust Badges -->
        <div class="flex flex-wrap items-center justify-center gap-6 mt-6 pt-6 border-t border-gray-100">
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>Pago Seguro</span>
            </div>
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <span>Garantía de Satisfacción</span>
            </div>
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <span>SSL Encriptado</span>
            </div>
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
                <span>Múltiples Métodos de Pago</span>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
