<?php
/*
 * functions and definitions
 */

if ( ! function_exists( 'setup' ) ) :

	function setup() {

        load_theme_textdomain( 'belitsoft-theme', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'belitsoft-theme' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'custom_background_args', array(
			'default-color' => '',
			'default-image' => '',
		)));

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo', array(
			'height'      => 65,
			'width'       => 160,
			'flex-width'  => true,
            'flex-height' => true,
		) );
	}
endif;

add_action( 'after_setup_theme', 'setup' );


function content_width() {
	$GLOBALS['content_width'] = apply_filters( 'content_width', 640 );
}
add_action( 'after_setup_theme', 'content_width', 0 );

//Register widget area.
function widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'belitsoft-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'belitsoft-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action( 'widgets_init', 'widgets_init' );

//Enqueue scripts and styles.
function scripts() {

    wp_enqueue_style('style', get_template_directory_uri().'/assets/style.css');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'scripts' );


add_action('rest_api_init', 'register_rest_images' );

function register_rest_images(){
    register_rest_field( array('post'),
        'fimg_url',
        array(
            'get_callback'    => 'get_rest_featured_image',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}

function get_rest_featured_image( $object, $field_name, $request ) {
    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
        return $img[0];
    }
    return false;
}

add_action( 'template_redirect', 'my_redirect_if_user_not_logged_in' );

function my_redirect_if_user_not_logged_in() {

    if ( !is_user_logged_in()) {

        wp_redirect( '/wp-admin');

        exit;

    }

}
