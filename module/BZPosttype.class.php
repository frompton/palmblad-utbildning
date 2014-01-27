<?php

	if( !class_exists( 'BZPosttype' ) ){
		class BZPosttype extends BZBase{

			protected $domain = 'bz-posttype';
			protected $slug = '';
			
			protected $theme;
			protected $fields = array();

			public function __construct( $theme ){
				$this->theme = $theme;

				add_action( 'after_setup_theme', array( &$this, 'wp_register_posttype' ) );
				add_action( 'after_setup_theme', array( &$this, 'wp_register_thumbnail_support' ) );

				add_action( 'save_post', array( &$this, 'wp_save_post_metadata' ) );
				add_action( 'delete_post', array( &$this, 'wp_delete_post_metadata' ) );
				add_action( 'add_meta_boxes', array( &$this, 'wp_add_metadata_boxes' ) );
			}

			/**
			 * @return void
			 */
			public function wp_register_thumbnail_support(){
				add_post_type_support( $this->domain, 'thumbnails' );
			}

			/**
			 * @return void
			 */
			public function wp_add_metadata_boxes(){
				add_meta_box( $this->domain . '_metadata_box', __( 'Metadata', $this->domain ), array( &$this, 'wp_metadata_content' ), $this->domain );
			}

			/**
			 * @param $post object
			 * @return object
			 */
			public function wp_metadata_content( $post ){
				$post_id = $post->ID;
				$data = (object) array();

				wp_nonce_field( plugin_basename( __FILE__ ), $this->domain . '-nonce' );


				$custom = get_post_custom( $post_id );
				foreach( $this->fields as $key => $field ){
					$name = '_' . $this->domain . '_' . $key;
					if( isset( $custom[$name] ) ){
						$data->$key = $custom[$name][0];
					}else{
						$data->$key = NULL;
					}
				}

				/*foreach( $this->fields as $key => $field ){
					$value = get_post_meta( $post_id, '_' . $this->domain . '_' . $key, true );
					if( strlen( $value ) > 3 && substr( $value, 0, 1 ) == ',' && substr( $value, -1 ) == ',' ){
						$value = explode( ',', $value );
					}
					$data->$key = $value;
				}/*old version of the code, keep a while to see why this weird if is used*/

				return $data;
			}

			/**
			 * @param $post_id int
			 * @return void
			 */
			public function wp_save_post_metadata( $post_id ){

				if( !wp_verify_nonce( $_POST[$this->domain . '-nonce'], plugin_basename( __FILE__ ) ) ){
					return $post_id;
				}

				if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
					return $post_id;
				}

				if( 'page' == $_POST['post_type'] ) {
					if( !current_user_can( 'edit_page', $post_id ) ){
						return $post_id;
					}
				}else{
					if( !current_user_can( 'edit_post', $post_id ) ){
						return $post_id;
					}
				}

				foreach( $this->fields as $key => $field ){
					$value = $_POST[$this->domain . '-' . $key];
					if( is_array( $value ) ){
						$value = ','. implode( ',', $value ) . ',';
					}
					update_post_meta( $post_id, '_' . $this->domain . '_' . $key, esc_attr( $value ) );
				}

				return true;
			}

			/**
			 * @param $post_id int
			 * @return void
			 */
			public function wp_delete_post_metadata( $post_id ){
				foreach( $this->fields as $key => $field ){
					delete_post_meta( $post_id, '_' . $this->domain . '_' . $key );
				}
			}

			/**
			 * @return void
			 */
			public function wp_register_posttype(){

			}

		}
	}