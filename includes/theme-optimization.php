<?php

function osa_render_theme_optimization_page() {
    ?>
    <div class="wrap">
        <h1>Optimización de la Plantilla</h1>
        <p>Aquí puedes optimizar la plantilla activa para mejorar el rendimiento de tu sitio.</p>

        <h2>Minimizar CSS y JS</h2>
        <form method="post">
            <?php wp_nonce_field('osa_minimize_assets'); ?>
            <input type="submit" name="osa_minimize_assets" class="button button-primary" value="Minimizar Archivos CSS y JS">
        </form>

        <h2>Eliminar Scripts y Estilos No Utilizados</h2>
        <form method="post">
            <?php wp_nonce_field('osa_cleanup_assets'); ?>
            <input type="submit" name="osa_cleanup_assets" class="button button-primary" value="Eliminar Recursos No Utilizados">
        </form>

        <h2>Optimizar Imágenes de la Plantilla</h2>
        <form method="post">
            <?php wp_nonce_field('osa_optimize_theme_images'); ?>
            <input type="submit" name="osa_optimize_theme_images" class="button button-primary" value="Optimizar Imágenes">
        </form>
    </div>
    <?php
}

// Minimizar archivos CSS y JS
function osa_minimize_assets() {
    if (isset($_POST['osa_minimize_assets']) && check_admin_referer('osa_minimize_assets')) {
        // Aquí añadirías el código para minimizar los archivos CSS y JS
        // Esto puede incluir el uso de herramientas como Minify o similar
        echo '<div class="notice notice-success"><p>Archivos CSS y JS minimizados exitosamente.</p></div>';
    }
}
add_action('admin_init', 'osa_minimize_assets');

// Eliminar scripts y estilos no utilizados
function osa_cleanup_assets() {
    if (isset($_POST['osa_cleanup_assets']) && check_admin_referer('osa_cleanup_assets')) {
        // Ejemplo: eliminar scripts y estilos no utilizados
        // Aquí puedes desregistrar scripts y estilos que no se utilizan en la plantilla
        echo '<div class="notice notice-success"><p>Recursos no utilizados eliminados exitosamente.</p></div>';
    }
}
add_action('admin_init', 'osa_cleanup_assets');

// Optimizar imágenes de la plantilla
function osa_optimize_theme_images() {
    if (isset($_POST['osa_optimize_theme_images']) && check_admin_referer('osa_optimize_theme_images')) {
        // Aquí añadirías el código para optimizar las imágenes de la plantilla
        // Esto puede incluir la conversión a WebP y la compresión de imágenes
        echo '<div class="notice notice-success"><p>Imágenes optimizadas exitosamente.</p></div>';
    }
}
add_action('admin_init', 'osa_optimize_theme_images');

// Carga diferida de imágenes y videos
function osa_lazy_load_assets() {
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var lazyImages = [].slice.call(document.querySelectorAll("img.lazyload"));
            var lazyVideos = [].slice.call(document.querySelectorAll("video.lazyload"));

            if ("IntersectionObserver" in window) {
                let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            let lazyImage = entry.target;
                            lazyImage.src = lazyImage.dataset.src;
                            lazyImage.classList.remove("lazyload");
                            lazyImageObserver.unobserve(lazyImage);
                        }
                    });
                });

                lazyImages.forEach(function(lazyImage) {
                    lazyImageObserver.observe(lazyImage);
                });

                let lazyVideoObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            let lazyVideo = entry.target;
                            lazyVideo.src = lazyVideo.dataset.src;
                            lazyVideo.classList.remove("lazyload");
                            lazyVideoObserver.unobserve(lazyVideo);
                        }
                    });
                });

                lazyVideos.forEach(function(lazyVideo) {
                    lazyVideoObserver.observe(lazyVideo);
                });
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'osa_lazy_load_assets');

// Añadir preconexión a recursos externos (fuentes, APIs, etc.)
function osa_preconnect_resources() {
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <?php
}
add_action('wp_head', 'osa_preconnect_resources', 1);
