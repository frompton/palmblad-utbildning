<?php

	if( !class_exists( 'BZBase' ) ){
		class BZBase{

			protected $domain = 'bz-base';
			protected $post_type = 'post';
			protected $meta_cache = array();

			public function __get( $key ){
				if( isset( $this->$key ) ){
					return $this->$key;
				}
			}

			public function __toString(){
				return strtolower( get_class( $this ) );
			}

			/**
			 * @param  $id
			 * @return bool
			 */
			public function split_admin_menu_before( $id ){
				global $menu;

				if( !$menu ) return false;

				$key = 0;
				foreach( $menu as $item ){
					if( isset($item[5]) && $item[5] == $id ){
						array_splice( $menu, $key, 0, array( array( '', 'read', 'separator10' . $key, '', 'wp-menu-separator' ) ) );
						$menu[$key-1][4] .= ' menu-top-last';
						$menu[$key+1][4] .= ' menu-top-first';
						return true;
					}
					$key++;
				}
				return false;
			}


			/**
			 * @param $meta_key string
			 * @param null $post_id int
			 * @return string
			 */
			public function get_metadata( $meta_key, $post_id = NULL, $native = false ){
				if( !$post_id ){
					global $post;
					$post_id = $post->ID;
				}

				if( !isset($this->meta_cache[$post_id]) ){
					$this->meta_cache[$post_id] = get_post_custom( $post_id );
				}

				if( $native ){
					return $this->meta_cache[$post_id][$meta_key][0];
				}

				return $this->meta_cache[$post_id]['_'.$this->domain.'_'.$meta_key][0];
			}


			public function get_posts( array $args = array() ){
				$bz_query = array_merge( array(
					'post_type' => $this->post_type,
					'paged' => 1,
					'posts_per_page' => -1,
					'order' => 'ASC',
					'orderby' => 'title'
				), $args );

				return new WP_Query( $bz_query );
			}
		}
	}