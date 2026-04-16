<?php
/**
 * Register and enqueue core theme CSS/JS.
 *
 * Styles load in strict dependency order so the cascade stays predictable:
 * variables → reset → base → layout → components.
 *
 * Feature modules under inc/features/ self-enqueue their own assets and
 * should depend on 'insynia-components' so they override correctly.
 *
 * @package Insynia
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_enqueue_scripts', function () {
	$css = INSYNIA_URI . '/assets/css/';
	$js  = INSYNIA_URI . '/assets/js/';
	$v   = INSYNIA_VERSION;

	wp_enqueue_style( 'insynia-variables',  $css . 'variables.css',  array(),                     $v );
	wp_enqueue_style( 'insynia-reset',      $css . 'reset.css',      array( 'insynia-variables' ), $v );
	wp_enqueue_style( 'insynia-base',       $css . 'base.css',       array( 'insynia-reset' ),     $v );
	wp_enqueue_style( 'insynia-layout',     $css . 'layout.css',     array( 'insynia-base' ),      $v );
	wp_enqueue_style( 'insynia-components', $css . 'components.css', array( 'insynia-layout' ),    $v );

	wp_enqueue_script( 'insynia-main', $js . 'main.js', array(), $v, true );

	wp_localize_script( 'insynia-main', 'insyniaData', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'restUrl' => esc_url_raw( rest_url() ),
		'nonce'   => wp_create_nonce( 'wp_rest' ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
} );

/**
 * Add async/defer attributes to selected scripts. Features can extend this
 * via the 'insynia_deferred_scripts' filter.
 */
add_filter( 'script_loader_tag', function ( $tag, $handle ) {
	$deferred = apply_filters( 'insynia_deferred_scripts', array( 'insynia-main' ) );
	if ( in_array( $handle, $deferred, true ) && strpos( $tag, ' defer ' ) === false ) {
		$tag = str_replace( ' src=', ' defer src=', $tag );
	}
	return $tag;
}, 10, 2 );
