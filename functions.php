<?php

function tt_enqueue_styles() {
    wp_enqueue_style( 'tt-main', get_template_directory_uri() . '/style.css');
}

add_action('wp_enqueue_scripts', 'tt_enqueue_styles');


function tt_register_sidebars() {
    /* Register the 'primary' sidebar. */
    register_sidebar(
        array(
            'id'            => 'primary',
            'name'          => __( 'Primary Sidebar' ),
            'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '<div class="p-3 widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="font-italic">',
            'after_title'   => '</h4>',
        )
    );
    /* Repeat register_sidebar() code for additional sidebars. */
}
add_action( 'widgets_init', 'tt_register_sidebars' );
