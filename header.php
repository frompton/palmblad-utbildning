<?php
/**
 * @package WordPress
 * @subpackage 
 */
	global $theme;
?><!DOCTYPE html>
<html <?php language_attributes();?> class="js-disabled">
	<head>
		<meta charset="<?php bloginfo( 'charset' );?>">
		<title><?php if (is_front_page()): ?>
				<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>
			<?php else: ?>
				<?php wp_title( '--', true, 'right' ); ?> <?php bloginfo( 'name' ); ?>
			<?php endif; ?>
		</title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' );?>">
<?php if ( is_home() || is_front_page() ):?>
		<meta name="description" content="<?php bloginfo( 'description' );?>">
<?php endif;?>
<!-- wp_head -->
<?php wp_head();?>
<!-- /wp_head -->
	</head>
	<body <?php body_class();?>>
		<div id="page-container">
			<div id="page-header" class="header">
				<div class="inner">
					<div id="logo">
						<a href="<?php echo home_url( '/' );?>">
							<img src="<?php echo get_stylesheet_directory_uri() ?>/image/logo.png" alt="Logotyp"><br>
							<span class="tagline"><?php bloginfo( 'description' ); ?></span>
						</a>

					</div>
					<?php if (is_front_page()): ?>
						<h1><?php echo esc_attr( get_bloginfo( 'name', 'display' ) );?></h1>
					<?php else: ?>
						<p><?php echo esc_attr( get_bloginfo( 'name', 'display' ) );?></p>
					<?php endif; ?>
					<?php wp_nav_menu( array(
						'theme_location' => 'main-navigation',
						'menu_class' => 'nav clear-children',
						'container' => 'nav',
						'container_id' => 'top-nav',
						'container_class' => 'nav',
						'depth'=> '1'
					) ); ?>
				</div>
			</div><!-- #page-header -->
			<div id="page-content" class="clear-children">

