<?php
/**
 * Template Name: Contacto
 * Description: Página de contacto con formulario e información
 *
 * @package Infinity_Displays
 */

get_header();
?>

<main class="bg-gray-50">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-gray-900 via-gray-800 to-primary/20 text-white py-16 md:py-24">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-display font-bold mb-4">
                    Contáctanos
                </h1>
                <p class="text-lg md:text-xl text-white/80">
                    Estamos aquí para ayudarte. Escríbenos y te responderemos a la brevedad.
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Cards -->
    <section class="py-12 -mt-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <!-- Phone -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center hover:shadow-xl transition-shadow">
                    <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="font-display font-semibold text-gray-900 mb-2">Teléfono</h3>
                    <a href="tel:+56942057591" class="text-primary hover:underline font-medium">+56 9 4205 7591</a>
                    <p class="text-sm text-gray-500 mt-1">Lun - Vie: 9:00 - 18:00</p>
                </div>

                <!-- Email -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center hover:shadow-xl transition-shadow">
                    <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-display font-semibold text-gray-900 mb-2">Email</h3>
                    <a href="mailto:ventas@infinitydisplays.cl" class="text-primary hover:underline font-medium">ventas@infinitydisplays.cl</a>
                    <p class="text-sm text-gray-500 mt-1">Respuesta en 24 hrs</p>
                </div>

                <!-- Location -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center hover:shadow-xl transition-shadow">
                    <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-display font-semibold text-gray-900 mb-2">Dirección</h3>
                    <p class="text-gray-600">Río de Janeiro 272</p>
                    <p class="text-sm text-gray-500">Recoleta, Santiago</p>
                </div>

                <!-- WhatsApp -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center hover:shadow-xl transition-shadow">
                    <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </div>
                    <h3 class="font-display font-semibold text-gray-900 mb-2">WhatsApp</h3>
                    <a href="https://wa.me/56942057591" target="_blank" class="text-green-600 hover:underline font-medium">Escríbenos ahora</a>
                    <p class="text-sm text-gray-500 mt-1">Respuesta inmediata</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content: Form + Map -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <!-- Contact Form -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                        <h2 class="text-2xl font-display font-bold text-gray-900 mb-2">Envíanos un mensaje</h2>
                        <p class="text-gray-600 mb-6">Completa el formulario y te contactaremos pronto.</p>

                        <form id="contact-form" class="space-y-5">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre *</label>
                                    <input type="text" id="nombre" name="nombre" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                        placeholder="Tu nombre">
                                </div>
                                <div>
                                    <label for="apellido" class="block text-sm font-medium text-gray-700 mb-1">Apellido *</label>
                                    <input type="text" id="apellido" name="apellido" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                        placeholder="Tu apellido">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                    <input type="email" id="email" name="email" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                        placeholder="tu@email.com">
                                </div>
                                <div>
                                    <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                                    <input type="tel" id="telefono" name="telefono"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                        placeholder="+56 9 1234 5678">
                                </div>
                            </div>

                            <div>
                                <label for="empresa" class="block text-sm font-medium text-gray-700 mb-1">Empresa</label>
                                <input type="text" id="empresa" name="empresa"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                    placeholder="Nombre de tu empresa">
                            </div>

                            <div>
                                <label for="asunto" class="block text-sm font-medium text-gray-700 mb-1">Asunto *</label>
                                <select id="asunto" name="asunto" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors">
                                    <option value="">Selecciona un asunto</option>
                                    <option value="cotizacion">Solicitar cotización</option>
                                    <option value="productos">Consulta sobre productos</option>
                                    <option value="pedido">Estado de mi pedido</option>
                                    <option value="socio">Quiero ser socio</option>
                                    <option value="soporte">Soporte técnico</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>

                            <div>
                                <label for="mensaje" class="block text-sm font-medium text-gray-700 mb-1">Mensaje *</label>
                                <textarea id="mensaje" name="mensaje" rows="4" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors resize-none"
                                    placeholder="¿En qué podemos ayudarte?"></textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-primary text-white font-semibold py-3 px-6 rounded-lg hover:bg-primary/90 transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Enviar mensaje
                            </button>
                        </form>
                    </div>

                    <!-- Map & Info -->
                    <div class="space-y-6">
                        <!-- Map -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                            <div class="aspect-video">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3329.4!2d-70.64!3d-33.42!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzPCsDI1JzEyLjAiUyA3MMKwMzgnMjQuMCJX!5e0!3m2!1ses!2scl!4v1234567890"
                                    width="100%"
                                    height="100%"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    class="w-full h-full">
                                </iframe>
                            </div>
                            <div class="p-4 bg-gray-50 border-t border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Río de Janeiro 272, Recoleta</p>
                                        <p class="text-sm text-gray-500">Santiago, Chile</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Business Hours -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                            <h3 class="font-display font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Horario de Atención
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Lunes - Viernes</span>
                                    <span class="font-medium text-gray-900">9:00 - 18:00</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Sábado</span>
                                    <span class="font-medium text-gray-900">10:00 - 14:00</span>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600">Domingo</span>
                                    <span class="font-medium text-red-500">Cerrado</span>
                                </div>
                            </div>
                        </div>

                        <!-- Quick CTA -->
                        <div class="bg-gradient-to-r from-primary to-primary/80 rounded-2xl p-6 text-white">
                            <h3 class="font-display font-semibold mb-2">¿Necesitas ayuda urgente?</h3>
                            <p class="text-white/80 text-sm mb-4">Contáctanos por WhatsApp para una respuesta inmediata.</p>
                            <a href="https://wa.me/56942057591?text=Hola,%20necesito%20información%20sobre%20sus%20productos"
                               target="_blank"
                               class="inline-flex items-center gap-2 bg-white text-primary font-semibold py-2.5 px-5 rounded-lg hover:bg-gray-100 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                Chatear por WhatsApp
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-display font-bold text-gray-900 text-center mb-8">
                    Preguntas Frecuentes
                </h2>

                <div class="space-y-4">
                    <!-- FAQ Item 1 -->
                    <details class="group bg-gray-50 rounded-xl border border-gray-200">
                        <summary class="flex items-center justify-between cursor-pointer p-5 font-medium text-gray-900">
                            <span>¿Cuál es el tiempo de entrega?</span>
                            <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </summary>
                        <div class="px-5 pb-5 text-gray-600">
                            Para productos en stock, el tiempo de entrega es de 1-3 días hábiles en Santiago y 3-5 días hábiles en regiones. Para productos personalizados o importación, el tiempo puede variar entre 15-30 días.
                        </div>
                    </details>

                    <!-- FAQ Item 2 -->
                    <details class="group bg-gray-50 rounded-xl border border-gray-200">
                        <summary class="flex items-center justify-between cursor-pointer p-5 font-medium text-gray-900">
                            <span>¿Hacen envíos a regiones?</span>
                            <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </summary>
                        <div class="px-5 pb-5 text-gray-600">
                            Sí, realizamos envíos a todo Chile a través de Starken y Chilexpress. El costo del envío se calcula según el peso y destino al momento de la cotización.
                        </div>
                    </details>

                    <!-- FAQ Item 3 -->
                    <details class="group bg-gray-50 rounded-xl border border-gray-200">
                        <summary class="flex items-center justify-between cursor-pointer p-5 font-medium text-gray-900">
                            <span>¿Cómo puedo ser cliente socio?</span>
                            <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </summary>
                        <div class="px-5 pb-5 text-gray-600">
                            Para ser cliente socio y acceder a precios preferenciales, debes registrarte en nuestra web y completar el formulario de solicitud. Nuestro equipo revisará tu solicitud y te contactará en 24-48 horas.
                        </div>
                    </details>

                    <!-- FAQ Item 4 -->
                    <details class="group bg-gray-50 rounded-xl border border-gray-200">
                        <summary class="flex items-center justify-between cursor-pointer p-5 font-medium text-gray-900">
                            <span>¿Ofrecen garantía en sus productos?</span>
                            <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </summary>
                        <div class="px-5 pb-5 text-gray-600">
                            Todos nuestros productos cuentan con garantía de fábrica de 6 meses a 1 año dependiendo del producto. La garantía cubre defectos de fabricación, no incluye mal uso o daños por transporte.
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const nombre = document.getElementById('nombre').value;
    const apellido = document.getElementById('apellido').value;
    const email = document.getElementById('email').value;
    const telefono = document.getElementById('telefono').value;
    const empresa = document.getElementById('empresa').value;
    const asunto = document.getElementById('asunto').value;
    const mensaje = document.getElementById('mensaje').value;

    // Create WhatsApp message
    let whatsappMessage = `*Nuevo mensaje de contacto*%0A%0A`;
    whatsappMessage += `*Nombre:* ${nombre} ${apellido}%0A`;
    whatsappMessage += `*Email:* ${email}%0A`;
    if (telefono) whatsappMessage += `*Teléfono:* ${telefono}%0A`;
    if (empresa) whatsappMessage += `*Empresa:* ${empresa}%0A`;
    whatsappMessage += `*Asunto:* ${asunto}%0A%0A`;
    whatsappMessage += `*Mensaje:*%0A${mensaje}`;

    // Open WhatsApp
    window.open(`https://wa.me/56942057591?text=${whatsappMessage}`, '_blank');
});
</script>

<?php get_footer(); ?>
