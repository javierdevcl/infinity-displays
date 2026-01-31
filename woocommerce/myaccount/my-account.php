<?php
/**
 * My Account Page
 *
 * @package Infinity_Displays
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_account_navigation');
?>

<div class="woocommerce-MyAccount-wrapper">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl border border-border overflow-hidden sticky top-24">
                <div class="p-6 border-b border-border bg-gradient-to-r from-primary to-primary/80">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-primary">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="text-white">
                            <div class="text-sm opacity-90">Bienvenido</div>
                            <div class="font-semibold"><?php echo esc_html(wp_get_current_user()->display_name); ?></div>
                        </div>
                    </div>
                </div>

                <nav class="woocommerce-MyAccount-navigation p-4">
                    <ul class="space-y-1">
                        <?php foreach (wc_get_account_menu_items() as $endpoint => $label): ?>
                            <?php
                            $classes = wc_get_account_menu_item_classes($endpoint);
                            $icon = '';

                            // Icon mapping
                            switch($endpoint) {
                                case 'dashboard':
                                    $icon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>';
                                    break;
                                case 'orders':
                                    $icon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>';
                                    break;
                                case 'downloads':
                                    $icon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path></svg>';
                                    break;
                                case 'edit-address':
                                    $icon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>';
                                    break;
                                case 'edit-account':
                                    $icon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>';
                                    break;
                                case 'customer-logout':
                                    $icon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>';
                                    break;
                                default:
                                    $icon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>';
                            }
                            ?>
                            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--<?php echo esc_attr($endpoint); ?> <?php echo esc_attr($classes); ?>">
                                <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:text-primary hover:bg-gray-50 transition-colors <?php echo strpos($classes, 'is-active') !== false ? 'bg-primary/10 text-primary font-medium' : ''; ?>">
                                    <?php echo $icon; ?>
                                    <span><?php echo esc_html($label); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <div class="woocommerce-MyAccount-content bg-white rounded-xl border border-border overflow-hidden">
                <?php
                do_action('woocommerce_account_content');
                ?>
            </div>
        </div>

    </div>
</div>

<?php
do_action('woocommerce_after_account_navigation');
