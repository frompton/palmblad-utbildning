<?php
 /**
 * @package WordPress
 * @subpackage 
 */
    global $theme;
?>

								<div class="header">
<?php if( is_single() || is_page() ): ?>
									<?php if (has_post_thumbnail()): ?>
										<span class="featured-image">
																	<?php the_post_thumbnail('large') ?>
															</span>
									<?php endif; ?>
									<h1><?php the_title();?></h1>
<?php elseif( !is_front_page() ): ?>
									<h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
<?php else:?>
									<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
<?php endif; ?>


								</div>

								<div class="content">
									<?php has_excerpt() ? the_excerpt(): the_content( '...' );?>
								</div>

<?php if( !is_page() || is_front_page() ): ?>
								<div class="context">
									<p><?php the_tags(); ?></p>
	<?php if( !is_single() && !is_page() ):?>
									<p><a href="<?php the_permalink();?>" class="more"><?php echo __( 'Read more', 'fc' );?></a></p>
	<?php endif;?>
								</div>
<?php endif; ?>