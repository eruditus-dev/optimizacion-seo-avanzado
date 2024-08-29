<?php
/*
Plugin Name: Optimización & SEO Avanzado
Description: Un plugin para optimizar imágenes, mejorar SEO con meta descriptions, acelerar WordPress, optimizar plugins instalados y mejorar la plantilla activa.
Version: 1.4
Author: Tom Cardenas
*/

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Incluir archivos necesarios
include_once plugin_dir_path(__FILE__) . 'admin/admin-page.php';
include_once plugin_dir_path(__FILE__) . 'admin/meta-description.php';
include_once plugin_dir_path(__FILE__) . 'includes/image-optimization.php';
include_once plugin_dir_path(__FILE__) . 'includes/performance-optimization.php';
include_once plugin_dir_path(__FILE__) . 'includes/error-reporting.php';
include_once plugin_dir_path(__FILE__) . 'includes/plugin-optimization.php';
include_once plugin_dir_path(__FILE__) . 'includes/theme-optimization.php'; // Nuevo archivo para optimización de la plantilla

// Registrar la página de administración
function osa_add_admin_menu() {
    add_menu_page(
        'Optimización & SEO',    // Título de la página
        'Optimización & SEO',    // Texto del menú
        'manage_options',        // Capacidad requerida
        'osa-settings',          // Slug del menú
        'osa_render_admin_page', // Función para mostrar la página
        'dashicons-admin-generic' // Icono del menú
    );
    add_submenu_page(
        'osa-settings',
        'Reporte de Fallos',
        'Reporte de Fallos',
        'manage_options',
        'osa-error-reporting',
        'osa_render_error_reporting_page'
    );
    add_submenu_page(
        'osa-settings',
        'Optimización de Plugins',
        'Optimización de Plugins',
        'manage_options',
        'osa-plugin-optimization',
        'osa_render_plugin_optimization_page'
    );
    add_submenu_page(
        'osa-settings',
        'Optimización de la Plantilla',
        'Optimización de la Plantilla',
        'manage_options',
        'osa-theme-optimization',
        'osa_render_theme_optimization_page'
    );
}
add_action('admin_menu', 'osa_add_admin_menu');
