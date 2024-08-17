<?php

function osa_add_meta_box() {
    add_meta_box(
        'osa_meta_description',          // ID único
        'Meta Description',              // Título de la casilla
        'osa_meta_description_callback', // Función de callback
        ['post', 'page'],                // Tipos de post donde aparecerá
        'normal',                        // Contexto
        'high'                           // Prioridad
    );
}
add_action('add_meta_boxes', 'osa_add_meta_box');

function osa_meta_description_callback($post) {
    wp_nonce_field('osa_meta_description_save', 'osa_meta_description_nonce');
    $meta_description = get_post_meta($post->ID, '_osa_meta_description', true);
    ?>
    <textarea name="osa_meta_description" style="width: 100%;"><?php echo esc_textarea($meta_description); ?></textarea>
    <p>Introduce una meta description optimizada para SEO.</p>
    <?php
}

function osa_save_meta_description($post_id) {
    if (!isset($_POST['osa_meta_description_nonce']) || !wp_verify_nonce($_POST['osa_meta_description_nonce'], 'osa_meta_description_save')) {
        return;
    }

    if (array_key_exists('osa_meta_description', $_POST)) {
        update_post_meta($post_id, '_osa_meta_description', sanitize_text_field($_POST['osa_meta_description']));
    }
}
add_action('save_post', 'osa_save_meta_description');

function osa_add_meta_description_to_head() {
    if (is_singular() && $meta_description = get_post_meta(get_the_ID(), '_osa_meta_description', true)) {
        echo '<meta name="description" content="' . esc_attr($meta_description) . '">';
    }
}
add_action('wp_head', 'osa_add_meta_description_to_head');
