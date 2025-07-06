<?php
function neurowiki_enqueue_assets()
{
    wp_enqueue_style('normalize', get_template_directory_uri() . '/assets/css/normalize.css');
    wp_enqueue_style('neurowiki-style', get_template_directory_uri() . '/assets/css/style.css');
    wp_enqueue_script('neurowiki-script', get_template_directory_uri() . '/assets/js/script.js', [], false, true);
}
add_action('wp_enqueue_scripts', 'neurowiki_enqueue_assets');
