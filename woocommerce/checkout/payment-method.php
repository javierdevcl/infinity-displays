<?php
/**
 * Payment Method Template - Shopify Style
 *
 * @package Infinity_Displays
 */

if (!defined('ABSPATH')) {
    exit;
}

?>
<li class="wc_payment_method payment_method_<?php echo esc_attr($gateway->id); ?>">
    <div class="border border-gray-200 rounded-lg overflow-hidden transition-all duration-200 hover:border-primary/50 <?php echo $gateway->chosen ? 'border-primary bg-primary/5' : ''; ?>">
        <label for="payment_method_<?php echo esc_attr($gateway->id); ?>" class="flex items-center gap-3 p-4 cursor-pointer">
            <input id="payment_method_<?php echo esc_attr($gateway->id); ?>"
                   type="radio"
                   class="w-5 h-5 text-primary border-gray-300 focus:ring-primary"
                   name="payment_method"
                   value="<?php echo esc_attr($gateway->id); ?>"
                   <?php checked($gateway->chosen, true); ?>
                   data-order_button_text="<?php echo esc_attr($gateway->order_button_text); ?>" />

            <span class="flex-1">
                <span class="block font-medium text-gray-900">
                    <?php echo $gateway->get_title(); ?>
                </span>
                <?php if ($gateway->get_icon()): ?>
                    <span class="payment-icons mt-1 inline-block">
                        <?php echo $gateway->get_icon(); ?>
                    </span>
                <?php endif; ?>
            </span>

            <?php if ($gateway->id === 'bacs'): ?>
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            <?php elseif ($gateway->id === 'cod'): ?>
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            <?php elseif (strpos($gateway->id, 'paypal') !== false): ?>
                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none">
                    <path d="M7.144 19.532l.144-.9.001-.004c.108-.674.502-1.283 1.06-1.638.265-.168.563-.281.873-.334.176-.03.354-.045.533-.045h4.42c.572 0 1.139-.079 1.684-.233.549-.155 1.078-.388 1.568-.699 1.095-.694 1.894-1.812 2.226-3.129.159-.629.232-1.281.217-1.933-.009-.373-.054-.745-.135-1.11-.083-.374-.202-.74-.357-1.091l-.005-.013c-.16-.362-.358-.705-.589-1.023-.237-.327-.51-.625-.816-.888l-.007-.006a5.523 5.523 0 00-1.113-.754 6.012 6.012 0 00-1.208-.486 7.08 7.08 0 00-1.304-.247 9.63 9.63 0 00-1.14-.071H6.744c-.367 0-.723.13-1.005.369a1.49 1.49 0 00-.498.907l-.91 5.785-.002.012-.706 4.477-.003.018-.353 2.237a.936.936 0 00.207.735c.139.16.33.271.541.311.07.013.142.02.214.02h3.008l-.093.591z" fill="#009cde"/>
                    <path d="M19.563 7.984c.018.136.033.273.046.41.011.131.019.263.024.395.008.223.005.447-.012.67a6.41 6.41 0 01-.12.886c-.308 1.372-1.024 2.56-2.055 3.348a5.058 5.058 0 01-1.345.746c-.494.185-1.011.312-1.541.377a8.66 8.66 0 01-.958.058h-3.27a.936.936 0 00-.926.789l-.58 3.679-.003.018-.166 1.05a.78.78 0 00.173.614c.116.134.276.226.452.26a.881.881 0 00.178.017h2.505a1.24 1.24 0 00.836-.306 1.24 1.24 0 00.414-.755l.017-.085.331-2.093.021-.115a1.24 1.24 0 01.414-.754c.226-.201.518-.307.82-.306h.188c.566 0 1.127-.07 1.667-.21a5.306 5.306 0 001.49-.634c.92-.553 1.59-1.391 1.923-2.382.12-.358.202-.73.244-1.107.047-.42.047-.844 0-1.264a4.023 4.023 0 00-.273-1.04l-.009-.02a3.52 3.52 0 00-.464-.851z" fill="#012169"/>
                </svg>
            <?php elseif (strpos($gateway->id, 'stripe') !== false || strpos($gateway->id, 'card') !== false): ?>
                <div class="flex items-center gap-1">
                    <svg class="w-8 h-5" viewBox="0 0 32 20" fill="none">
                        <rect width="32" height="20" rx="2" fill="#1A1F71"/>
                        <path d="M12.5 13.5H10.5L11.75 6.5H13.75L12.5 13.5Z" fill="white"/>
                        <path d="M18.25 6.65C17.85 6.5 17.2 6.35 16.4 6.35C14.45 6.35 13.1 7.35 13.1 8.75C13.1 9.8 14.05 10.4 14.75 10.75C15.5 11.1 15.75 11.35 15.75 11.7C15.75 12.2 15.15 12.45 14.55 12.45C13.7 12.45 13.25 12.3 12.55 12L12.25 11.85L11.95 13.6C12.5 13.85 13.45 14.05 14.45 14.05C16.55 14.05 17.85 13.1 17.85 11.55C17.85 10.75 17.35 10.1 16.3 9.6C15.65 9.25 15.25 9 15.25 8.6C15.25 8.25 15.65 7.85 16.45 7.85C17.1 7.85 17.6 8 17.95 8.15L18.15 8.25L18.45 6.55L18.25 6.65Z" fill="white"/>
                        <path d="M21.75 6.5H20.25C19.75 6.5 19.4 6.65 19.2 7.15L16.25 13.5H18.35L18.75 12.35H21.35L21.6 13.5H23.5L21.75 6.5ZM19.35 10.85C19.5 10.45 20.25 8.45 20.25 8.45C20.25 8.45 20.45 7.9 20.55 7.55L20.7 8.35C20.7 8.35 21.2 10.5 21.3 10.85H19.35Z" fill="white"/>
                        <path d="M10.15 6.5L8.2 11.1L8 10.05C7.6 8.85 6.45 7.55 5.15 6.9L6.95 13.45H9.1L12.3 6.5H10.15Z" fill="white"/>
                        <path d="M6.85 6.5H3.55L3.5 6.7C6 7.3 7.65 8.8 8.25 10.55L7.6 7.2C7.5 6.7 7.15 6.55 6.85 6.5Z" fill="#F9A51A"/>
                    </svg>
                    <svg class="w-8 h-5" viewBox="0 0 32 20" fill="none">
                        <rect width="32" height="20" rx="2" fill="#EB001B"/>
                        <circle cx="12" cy="10" r="6" fill="#EB001B"/>
                        <circle cx="20" cy="10" r="6" fill="#F79E1B"/>
                        <path d="M16 5.5C17.5 6.8 18.4 8.8 18.4 10C18.4 11.2 17.5 13.2 16 14.5C14.5 13.2 13.6 11.2 13.6 10C13.6 8.8 14.5 6.8 16 5.5Z" fill="#FF5F00"/>
                    </svg>
                </div>
            <?php else: ?>
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
            <?php endif; ?>
        </label>

        <?php if ($gateway->has_fields() || $gateway->get_description()): ?>
            <div class="payment_box payment_method_<?php echo esc_attr($gateway->id); ?> bg-gray-50 border-t border-gray-200 p-4 <?php echo $gateway->chosen ? '' : 'hidden'; ?>">
                <?php if ($gateway->get_description()): ?>
                    <p class="text-sm text-gray-600 mb-3"><?php echo wp_kses_post($gateway->get_description()); ?></p>
                <?php endif; ?>
                <?php $gateway->payment_fields(); ?>
            </div>
        <?php endif; ?>
    </div>
</li>
