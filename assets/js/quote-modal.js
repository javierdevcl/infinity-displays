/**
 * Quote Modal functionality
 */

(function() {
    'use strict';

    // Create modal HTML
    const createModal = () => {
        const modalHTML = `
            <div id="quote-modal" class="quote-modal hidden">
                <!-- Backdrop -->
                <div class="quote-modal-backdrop" onclick="closeQuoteModal()"></div>

                <!-- Modal -->
                <div class="quote-modal-content">
                    <!-- Header -->
                    <div class="quote-modal-header">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="quote-modal-icon">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-white">Solicitar Cotización</h2>
                                    <p class="text-white/80 text-sm">Completa tus datos y te contactaremos</p>
                                </div>
                            </div>
                            <button onclick="closeQuoteModal()" class="quote-modal-close">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="quote-modal-body">
                        <form id="quote-form" class="space-y-4">
                            <h3 class="font-semibold text-foreground mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Tus Datos
                            </h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-foreground mb-1.5">
                                        Nombre Completo *
                                    </label>
                                    <input
                                        type="text"
                                        name="name"
                                        required
                                        maxlength="100"
                                        class="w-full px-4 py-2.5 rounded-lg border border-border bg-background focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all text-foreground"
                                        placeholder="Juan Pérez"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-foreground mb-1.5">
                                        Empresa (opcional)
                                    </label>
                                    <input
                                        type="text"
                                        name="company"
                                        maxlength="100"
                                        class="w-full px-4 py-2.5 rounded-lg border border-border bg-background focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all text-foreground"
                                        placeholder="Mi Empresa S.A."
                                    />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-foreground mb-1.5">
                                        Email *
                                    </label>
                                    <input
                                        type="email"
                                        name="email"
                                        required
                                        maxlength="255"
                                        class="w-full px-4 py-2.5 rounded-lg border border-border bg-background focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all text-foreground"
                                        placeholder="tu@email.com"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-foreground mb-1.5">
                                        Teléfono *
                                    </label>
                                    <input
                                        type="tel"
                                        name="phone"
                                        required
                                        maxlength="20"
                                        class="w-full px-4 py-2.5 rounded-lg border border-border bg-background focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all text-foreground"
                                        placeholder="+56 9 1234 5678"
                                    />
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-foreground mb-1.5">
                                    Mensaje Adicional (opcional)
                                </label>
                                <textarea
                                    name="message"
                                    rows="3"
                                    maxlength="1000"
                                    class="w-full px-4 py-2.5 rounded-lg border border-border bg-background focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all text-foreground resize-none"
                                    placeholder="¿Necesitas personalización, diseño gráfico o tienes alguna consulta específica?"
                                ></textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Footer Actions -->
                    <div class="quote-modal-footer">
                        <div class="flex flex-col sm:flex-row gap-3">
                            <button
                                onclick="submitQuoteWhatsApp()"
                                class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-colors"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                Cotizar por WhatsApp
                            </button>
                            <button
                                onclick="submitQuoteEmail()"
                                class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-primary hover:bg-primary/90 text-white font-semibold rounded-lg transition-colors"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Enviar por Email
                            </button>
                        </div>
                        <p class="text-xs text-muted-foreground text-center mt-3">
                            Te responderemos en menos de 2 horas en horario laboral
                        </p>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHTML);
    };

    // Open modal
    window.openQuoteModal = function() {
        const modal = document.getElementById('quote-modal');
        if (!modal) createModal();

        document.getElementById('quote-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };

    // Close modal
    window.closeQuoteModal = function() {
        const modal = document.getElementById('quote-modal');
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }
    };

    // Submit via WhatsApp
    window.submitQuoteWhatsApp = function() {
        const form = document.getElementById('quote-form');
        const formData = new FormData(form);

        // Validate required fields
        if (!formData.get('name') || !formData.get('email') || !formData.get('phone')) {
            alert('Por favor completa nombre, email y teléfono.');
            return;
        }

        // Generate WhatsApp message
        let message = '*Nueva Solicitud de Cotización*\n\n';
        message += `*Cliente:* ${formData.get('name')}\n`;
        message += `*Email:* ${formData.get('email')}\n`;
        message += `*Teléfono:* ${formData.get('phone')}\n`;
        if (formData.get('company')) {
            message += `*Empresa:* ${formData.get('company')}\n`;
        }
        if (formData.get('message')) {
            message += `\n*Mensaje:*\n${formData.get('message')}`;
        }

        // Open WhatsApp with the message
        const whatsappUrl = `https://wa.me/56942057591?text=${encodeURIComponent(message)}`;
        window.open(whatsappUrl, '_blank');

        closeQuoteModal();
        form.reset();
    };

    // Submit via Email
    window.submitQuoteEmail = function() {
        const form = document.getElementById('quote-form');
        const formData = new FormData(form);

        // Validate required fields
        if (!formData.get('name') || !formData.get('email') || !formData.get('phone')) {
            alert('Por favor completa nombre, email y teléfono.');
            return;
        }

        // Send AJAX request
        const data = {
            action: 'infinity_send_quote',
            nonce: infinityQuote.nonce,
            name: formData.get('name'),
            email: formData.get('email'),
            phone: formData.get('phone'),
            company: formData.get('company'),
            message: formData.get('message')
        };

        fetch(infinityQuote.ajaxurl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('¡Cotización enviada! Te contactaremos pronto a ' + formData.get('email'));
                closeQuoteModal();
                form.reset();
            } else {
                alert('Error al enviar la cotización. Por favor intenta de nuevo.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al enviar la cotización. Por favor intenta de nuevo.');
        });
    };

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeQuoteModal();
        }
    });

    // Add click event to all quote buttons (fallback for buttons without onclick)
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.infinity-quote-btn, .quote-whatsapp, .infinity-whatsapp-quote');
        if (btn && !btn.hasAttribute('onclick')) {
            e.preventDefault();
            openQuoteModal();
        }
    });

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Quote modal system ready');
        });
    } else {
        console.log('Quote modal system ready');
    }

})();
