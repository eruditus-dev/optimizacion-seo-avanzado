<?php

// Funciones de optimización adicionales como cacheo y limpieza de scripts
function osa_optimize_wordpress() {
    // Ejemplo: desactivar el emoji script de WordPress
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    // Implementar otras optimizaciones como el cacheo
}
add_action('init', 'osa_optimize_wordpress');
