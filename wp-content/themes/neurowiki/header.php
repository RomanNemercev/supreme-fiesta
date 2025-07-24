<?php

/**
 * The Header for our theme
 *
 * This is the template that displays all of the <head> section and header content
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header">
        <div class="header__container">
            <div class="header__logo">
                <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/src/logo-white.svg" alt="NeuroWiki Logo" /></a>
            </div>
            <nav class="header__nav">
                <?php
                wp_nav_menu(
                    [
                        'theme_location' => 'primary',
                        'menu_class' => 'header__menu',
                        'container' => false
                    ]
                );
                ?>
            </nav>
        </div>
    </header>