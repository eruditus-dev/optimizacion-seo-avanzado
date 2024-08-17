<?php

function osa_render_plugin_optimization_page() {
    $all_plugins = get_plugins();
    $active_plugins = get_option('active_plugins', []);

    ?>
    <div class="wrap">
        <h1>Optimización de Plugins</h1>
        <p>Aquí puedes ver un listado de los plugins instalados y optimizar su uso para mejorar el rendimiento de tu sitio.</p>

        <table class="widefat fixed" cellspacing="0">
            <thead>
                <tr>
                    <th>Plugin</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_plugins as $plugin_file => $plugin_data): ?>
                    <tr>
                        <td><?php echo esc_html($plugin_data['Name']); ?></td>
                        <td><?php echo in_array($plugin_file, $active_plugins) ? 'Activo' : 'Inactivo'; ?></td>
                        <td>
                            <?php if (in_array($plugin_file, $active_plugins)): ?>
                                <form method="post">
                                    <?php wp_nonce_field('osa_deactivate_plugin'); ?>
                                    <input type="hidden" name="plugin_file" value="<?php echo esc_attr($plugin_file); ?>">
                                    <input type="submit" name="osa_deactivate_plugin" class="button" value="Desactivar">
                                </form>
                            <?php else: ?>
                                <form method="post">
                                    <?php wp_nonce_field('osa_activate_plugin'); ?>
                                    <input type="hidden" name="plugin_file" value="<?php echo esc_attr($plugin_file); ?>">
                                    <input type="submit" name="osa_activate_plugin" class="button" value="Activar">
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Recomendaciones</h2>
        <p>Considera desactivar plugins que no utilizas frecuentemente para mejorar el rendimiento.</p>
    </div>
    <?php
}

// Función para desactivar un plugin
function osa_deactivate_plugin() {
    if (isset($_POST['osa_deactivate_plugin']) && check_admin_referer('osa_deactivate_plugin')) {
        $plugin_file = sanitize_text_field($_POST['plugin_file']);
        if (deactivate_plugins($plugin_file)) {
            echo '<div class="notice notice-success"><p>Plugin desactivado exitosamente.</p></div>';
        } else {
            echo '<div class="notice notice-error"><p>Error al desactivar el plugin.</p></div>';
        }
    }
}
add_action('admin_init', 'osa_deactivate_plugin');

// Función para activar un plugin
function osa_activate_plugin() {
    if (isset($_POST['osa_activate_plugin']) && check_admin_referer('osa_activate_plugin')) {
        $plugin_file = sanitize_text_field($_POST['plugin_file']);
        if (activate_plugin($plugin_file)) {
            echo '<div class="notice notice-success"><p>Plugin activado exitosamente.</p></div>';
        } else {
            echo '<div class="notice notice-error"><p>Error al activar el plugin.</p></div>';
        }
    }
}
add_action('admin_init', 'osa_activate_plugin');

// Función para limpiar datos residuales de plugins desactivados o eliminados
function osa_cleanup_plugin_data($plugin_file) {
    // Ejemplo: eliminar opciones de la base de datos relacionadas con el plugin desactivado/eliminado
    // Aquí debes añadir lógica específica para limpiar los datos que deja el plugin
}
add_action('deactivated_plugin', 'osa_cleanup_plugin_data');
add_action('deleted_plugin', 'osa_cleanup_plugin_data');
