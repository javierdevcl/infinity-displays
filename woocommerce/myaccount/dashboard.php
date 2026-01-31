<?php
/**
 * My Account Dashboard
 *
 * @package Infinity_Displays
 */

defined('ABSPATH') || exit;
?>

<div class="woocommerce-MyAccount-dashboard p-6">
    <h2 class="text-2xl font-display font-bold text-foreground mb-6">
        Panel de Control
    </h2>

    <?php
    $current_user = wp_get_current_user();
    ?>

    <div class="prose max-w-none mb-8">
        <p class="text-muted-foreground">
            Hola <strong class="text-foreground"><?php echo esc_html($current_user->display_name); ?></strong>
            (¿No eres <?php echo esc_html($current_user->display_name); ?>?
            <a href="<?php echo esc_url(wc_logout_url()); ?>" class="text-primary hover:underline">Cerrar sesión</a>)
        </p>
    </div>

    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Orders Card -->
        <a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>" class="block p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border border-blue-200 hover:shadow-lg transition-all group">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900"><?php echo count(wc_get_orders(array('customer' => get_current_user_id(), 'limit' => -1))); ?></div>
                    <div class="text-sm text-gray-600">Pedidos Totales</div>
                </div>
            </div>
            <div class="text-sm text-blue-600 font-medium group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                Ver pedidos
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </a>

        <!-- Account Details Card -->
        <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-account')); ?>" class="block p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl border border-purple-200 hover:shadow-lg transition-all group">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-900">Detalles de Cuenta</div>
                    <div class="text-xs text-gray-600"><?php echo esc_html($current_user->user_email); ?></div>
                </div>
            </div>
            <div class="text-sm text-purple-600 font-medium group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                Editar cuenta
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </a>

        <!-- Addresses Card -->
        <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-address')); ?>" class="block p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-xl border border-green-200 hover:shadow-lg transition-all group">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-900">Direcciones</div>
                    <div class="text-xs text-gray-600">Facturación y envío</div>
                </div>
            </div>
            <div class="text-sm text-green-600 font-medium group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                Gestionar direcciones
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </a>
    </div>

    <?php
    // Show recent orders
    $customer_orders = wc_get_orders(array(
        'customer' => get_current_user_id(),
        'limit'    => 5,
        'orderby'  => 'date',
        'order'    => 'DESC',
    ));

    if ($customer_orders): ?>
        <div class="mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-display font-bold text-foreground">Pedidos Recientes</h3>
                <a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>" class="text-sm text-primary hover:underline">
                    Ver todos
                </a>
            </div>

            <div class="border border-border rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-secondary/30">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-muted-foreground uppercase">Pedido</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-muted-foreground uppercase">Fecha</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-muted-foreground uppercase">Estado</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-muted-foreground uppercase">Total</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-muted-foreground uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        <?php foreach ($customer_orders as $order): ?>
                            <tr class="hover:bg-secondary/10 transition-colors">
                                <td class="px-4 py-3 font-medium text-foreground">#<?php echo $order->get_order_number(); ?></td>
                                <td class="px-4 py-3 text-sm text-muted-foreground"><?php echo esc_html($order->get_date_created()->date_i18n('d/m/Y')); ?></td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">
                                        <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 font-semibold text-primary"><?php echo $order->get_formatted_order_total(); ?></td>
                                <td class="px-4 py-3 text-right">
                                    <a href="<?php echo esc_url($order->get_view_order_url()); ?>" class="text-sm text-primary hover:underline">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <?php do_action('woocommerce_account_dashboard'); ?>

</div>
