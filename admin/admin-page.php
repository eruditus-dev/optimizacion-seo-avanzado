<?php

function osa_render_admin_page() {
    ?>
    <div class="wrap">
        <h1>Configuración de Optimización & SEO</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('osa-settings-group');
            do_settings_sections('osa-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Registrar configuraciones
function osa_register_settings() {
    register_setting('osa-settings-group', 'osa_webp_quality');
    add_settings_section('osa-image-section', 'Optimización de Imágenes', null, 'osa-settings');
    add_settings_field('osa-webp-quality', 'Calidad de WebP', 'osa_webp_quality_render', 'osa-settings', 'osa-image-section');
}

function osa_webp_quality_render() {
    $value = get_option('osa_webp_quality', 80);
    ?>
    <input type="number" name="osa_webp_quality" value="<?php echo esc_attr($value); ?>" min="0" max="100">
    <?php
}

add_action('admin_init', 'osa_register_settings');
