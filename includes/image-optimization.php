<?php

// Convertir imágenes a WebP al subir
function osa_convert_to_webp($metadata) {
    $upload_dir = wp_upload_dir();
    $file = $upload_dir['basedir'] . '/' . $metadata['file'];
    $extension = pathinfo($file, PATHINFO_EXTENSION);

    if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
        $image = wp_get_image_editor($file);
        if (!is_wp_error($image)) {
            $image->set_quality(get_option('osa_webp_quality', 80));
            $webp_file = str_replace(".$extension", '.webp', $file);
            $image->save($webp_file, 'image/webp');
        }
    }
    return $metadata;
}
add_filter('wp_generate_attachment_metadata', 'osa_convert_to_webp');

// Agregar atributos alt automáticamente
function osa_add_alt_text($post_ID) {
    $attachment_id = get_post_thumbnail_id($post_ID);
    if ($attachment_id) {
        $alt_text = get_the_title($post_ID);
        update_post_meta($attachment_id, '_wp_attachment_image_alt', sanitize_text_field($alt_text));
    }
}
add_action('save_post', 'osa_add_alt_text');
