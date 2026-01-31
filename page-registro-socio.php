<?php
/**
 * Template Name: Registro de Socios
 * Description: Formulario de registro para socios mayoristas
 *
 * @package Infinity_Displays
 */

get_header();
?>

<main class="container mx-auto px-4 py-12">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-display font-bold text-foreground mb-4">
                Registro de Socios Mayoristas
            </h1>
            <p class="text-muted-foreground text-lg">
                Únete a nuestra red de socios y accede a precios especiales para mayoristas.
            </p>
        </div>

        <!-- Benefits -->
        <div class="bg-gradient-to-r from-primary/10 to-secondary/10 rounded-xl p-6 mb-8">
            <h3 class="font-display font-semibold text-foreground mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Beneficios de ser Socio
            </h3>
            <ul class="space-y-2">
                <li class="flex items-start gap-2 text-sm">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Precio Socio en compras de 6-23 unidades
                </li>
                <li class="flex items-start gap-2 text-sm">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Precio Preventa en compras de 24+ unidades (embalaje completo)
                </li>
                <li class="flex items-start gap-2 text-sm">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Asesoría personalizada para tu negocio
                </li>
                <li class="flex items-start gap-2 text-sm">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Prioridad en despachos y atención
                </li>
            </ul>
        </div>

        <!-- Registration Form -->
        <div class="bg-white rounded-xl border border-border shadow-sm p-6 md:p-8">
            <form id="socio-registration-form" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-foreground mb-2">
                            Nombre Completo <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            required
                            class="w-full px-4 py-2 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Juan Pérez"
                        >
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-foreground mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            class="w-full px-4 py-2 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="juan@empresa.cl"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-foreground mb-2">
                            Teléfono <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            required
                            class="w-full px-4 py-2 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="+56 9 1234 5678"
                        >
                    </div>

                    <!-- RUT -->
                    <div>
                        <label for="rut" class="block text-sm font-medium text-foreground mb-2">
                            RUT <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="rut"
                            name="rut"
                            required
                            class="w-full px-4 py-2 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="12.345.678-9"
                        >
                    </div>
                </div>

                <!-- Company -->
                <div>
                    <label for="company" class="block text-sm font-medium text-foreground mb-2">
                        Razón Social / Empresa <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="company"
                        name="company"
                        required
                        class="w-full px-4 py-2 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                        placeholder="Mi Empresa S.A."
                    >
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-foreground mb-2">
                            Contraseña <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            minlength="6"
                            class="w-full px-4 py-2 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Mínimo 6 caracteres"
                        >
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="confirm-password" class="block text-sm font-medium text-foreground mb-2">
                            Confirmar Contraseña <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="password"
                            id="confirm-password"
                            name="confirm-password"
                            required
                            minlength="6"
                            class="w-full px-4 py-2 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Repite tu contraseña"
                        >
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-start gap-3">
                    <input
                        type="checkbox"
                        id="terms"
                        name="terms"
                        required
                        class="mt-1 w-4 h-4 text-primary border-border rounded focus:ring-primary"
                    >
                    <label for="terms" class="text-sm text-muted-foreground">
                        Acepto los <a href="#" class="text-primary hover:underline">términos y condiciones</a> y la <a href="#" class="text-primary hover:underline">política de privacidad</a> de Infinity Displays.
                    </label>
                </div>

                <!-- Error/Success Messages -->
                <div id="form-message" class="hidden"></div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    id="submit-btn"
                    class="w-full px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary/90 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    Registrarse como Socio
                </button>

                <p class="text-center text-sm text-muted-foreground">
                    ¿Ya tienes cuenta? <a href="<?php echo wc_get_page_permalink('myaccount'); ?>" class="text-primary hover:underline font-medium">Inicia sesión aquí</a>
                </p>
            </form>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('socio-registration-form');
    const submitBtn = document.getElementById('submit-btn');
    const messageDiv = document.getElementById('form-message');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Validate passwords match
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        if (password !== confirmPassword) {
            showMessage('Las contraseñas no coinciden.', 'error');
            return;
        }

        // Disable submit button
        submitBtn.disabled = true;
        submitBtn.textContent = 'Registrando...';

        // Prepare form data
        const formData = new FormData();
        formData.append('action', 'infinity_socio_registration');
        formData.append('nonce', '<?php echo wp_create_nonce('infinity-nonce'); ?>');
        formData.append('name', document.getElementById('name').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('phone', document.getElementById('phone').value);
        formData.append('rut', document.getElementById('rut').value);
        formData.append('company', document.getElementById('company').value);
        formData.append('password', password);

        try {
            const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                showMessage(data.data.message, 'success');
                form.reset();

                // Redirect to login after 2 seconds
                setTimeout(() => {
                    window.location.href = '<?php echo wc_get_page_permalink('myaccount'); ?>';
                }, 2000);
            } else {
                showMessage(data.data.message || 'Ocurrió un error. Por favor intenta nuevamente.', 'error');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Registrarse como Socio';
            }
        } catch (error) {
            showMessage('Error de conexión. Por favor intenta nuevamente.', 'error');
            submitBtn.disabled = false;
            submitBtn.textContent = 'Registrarse como Socio';
        }
    });

    function showMessage(message, type) {
        messageDiv.className = 'p-4 rounded-lg mb-4 ' + (type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800');
        messageDiv.textContent = message;
        messageDiv.classList.remove('hidden');

        // Auto-hide after 5 seconds
        setTimeout(() => {
            messageDiv.classList.add('hidden');
        }, 5000);
    }
});
</script>

<?php
get_footer();
