<?php
/**
 * Register sidebars and widget areas.
 *
 * @package Insynia
 */

defined( 'ABSPATH' ) || exit;

add_action( 'widgets_init', function () {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'insynia' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Widgets shown in the main sidebar.', 'insynia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'insynia' ),
		'id'            => 'sidebar-footer',
		'description'   => __( 'Widgets shown in the site footer.', 'insynia' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="footer-widget-title">',
		'after_title'   => '</h3>',
	) );
} );
