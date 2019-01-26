<?php

function tt_enqueue_styles() {
    wp_enqueue_style( 'tt-main', get_template_directory_uri() . '/style.css');
}

add_action('wp_enqueue_scripts', 'tt_enqueue_styles');