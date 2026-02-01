<?php
/**
 * Terms and Conditions Checkbox - Shopify Style
 *
 * @package Infinity_Displays
 */

defined('ABSPATH') || exit;

if (apply_filters('woocommerce_checkout_show_terms', true) && function_exists('wc_terms_and_conditions_checkbox_enabled')) {
    do_action('woocommerce_checkout_before_terms_and_conditions');

    ?>
    <div class="woocommerce-terms-and-conditions-wrapper mb-4">
        <?php
        /**
         * Terms and conditions hook used to inject content.
         */
        do_action('woocommerce_checkout_terms_and_conditions');
        ?>

        <?php if (wc_terms_and_conditions_checkbox_enabled()): ?>
            <div class="form-row validate-required">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox flex items-start gap-3 cursor-pointer">
                    <span class="woocommerce-terms-and-conditions-checkbox-text text-sm text-gray-600">
                        <input type="checkbox"
                               class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox mt-0.5 w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary"
                               name="terms"
                               <?php checked(apply_filters('woocommerce_terms_is_checked_default', isset($_POST['terms'])), true); ?>
                               id="terms" />
                        <?php wc_terms_and_conditions_checkbox_text(); ?>
                    </span>
                    <input type="hidden" name="terms-field" value="1" />
                </label>
            </div>
        <?php endif; ?>
    </div>

    <?php

    do_action('woocommerce_checkout_after_terms_and_conditions');
}
