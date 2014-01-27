<?php
/*
* @package WordPress
* @subpackage BZ
*/

require( dirname( __FILE__ )  . '/BZBase.class.php' );
require( dirname( __FILE__ )  . '/BZPosttype.class.php' );
require( dirname( __FILE__ )  . '/BZTheme.class.php' );


if( !class_exists( 'MP' ) ){
	class MP extends BZTheme{

		protected $domain = 'mariapalmblad';

		public function __construct(){

			parent::__construct();

			add_action( 'widgets_init', array( $this, 'wp_register_sidebars' ) );
		}

		/*
		*	@return void
		*/
		public function wp_register_sidebars(){

			register_sidebar( array(
				'name' => __( 'Footer sidebar', 'kn' ),
				'id' => 'footer-sidebar',
				'description' => __( 'Add widgets here.', 'kn' ),
				'before_widget' => '<div id="%1$s" class="article widget-article %2$s clear-children">',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
				'after_widget' => '</div>'
			) );

		}

	}
}