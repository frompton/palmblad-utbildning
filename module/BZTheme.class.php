<?php

	if( !class_exists( 'BZTheme' ) ){
		class BZTheme extends BZPosttype{

			protected $domain = 'bz-theme';

			public function __construct(){

				add_filter( 'login_errors', array( $this, 'wp_remove_login_errors' ) );
				add_action( 'after_setup_theme', array( $this, 'wp_register_thumbnail_support' ) );
				add_action( 'init', array( $this, 'wp_register_navigation' ) );
				add_action( 'wp_enqueue_scripts', array( $this, 'wp_setup_resources' ), 10, 0 );
			}

			/**
			* 	@param $error string
			* 	@return string
			*/
			public function wp_remove_login_errors( $error ){
				return __( 'The username and/or password is wrong.', 'evaneander' );
			}

			/**
			* 	@return void
			*/
			public function wp_register_thumbnail_support(){
				add_theme_support( 'post-thumbnails' );
			}


			/*
			*	@return void
			*/
			public function wp_register_navigation(){
				register_nav_menus( array(
					'main-navigation' => __( 'Main menu', 'evaneander' )
				) );
			}

			/*
			*   @param $jQueryVersion string
			*	@return void
			*/
			public function wp_setup_resources( $jQueryVersion = '1.9.0' ){
				wp_enqueue_style( 'normalize-css', get_bloginfo( 'template_url' ) . '/style/normalize.css', false, '1.0' );
				wp_enqueue_style( 'common-css', get_bloginfo( 'template_url' ) . '/style/common.css', false, '1.1' );
			}

		}
	}
