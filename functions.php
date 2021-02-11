<?php

add_action( 'wp_enqueue_scripts', 'stockie_child_local_enqueue_parent_styles' );

function stockie_child_local_enqueue_parent_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'main-style', get_stylesheet_directory_uri() . '/css/main.css' );
	wp_enqueue_script( 'main-script', get_stylesheet_directory_uri() . '/js/main.js', array(), true );
}