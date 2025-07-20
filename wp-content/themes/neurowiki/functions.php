<?php
function neurowiki_enqueue_assets()
{
    wp_enqueue_style('google-fonts-inter', 'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap', [], null);
    wp_enqueue_style('neuro-wiki-style', get_template_directory_uri() . '/assets/css/style.min.css', [], filemtime(get_template_directory() . '/assets/css/style.min.css'));
    wp_enqueue_script('neurowiki-script', get_template_directory_uri() . '/assets/js/dist/main.min.js', [], filemtime(get_template_directory() . '/assets/js/dist/main.min.js'), true);
}
add_action('wp_enqueue_scripts', 'neurowiki_enqueue_assets');

function neurowiki_register_menus()
{
    register_nav_menus([
        'primary' => __('Primary Menu', 'neurowiki'),
    ]);
}
add_action('after_setup_theme', 'neurowiki_register_menus');

function neurowiki_register_post_types()
{
    register_post_type('neural_network', [
        'labels' => [
            'name' => __('Neural Networks', 'neurowiki'),
            'singular_name' => __('Neural Network', 'neurowiki'),
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-networking',
    ]);
}
add_action('init', 'neurowiki_register_post_types');
