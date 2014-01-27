<?php
 /**
 * @package WordPress
 * @subpackage
 */
	get_header();

	global $theme;
?>
					<div class="aside column small-column first-column">
						&nbsp;
					</div>
					<div class="column medium-column">
						<div class="article post-article section list-section">

<?php if( have_posts() ):?>				
							<h1><?php printf( __( 'Nyheter:', 'fc' ) ); ?></h1>
	<?php while( have_posts() ): the_post();?>
							<div class="article post-article">
								<h2><a href="<?php the_permalink();?>"><?php echo the_title();?></a></h2>
							
								<div class="content">
									<?php
									echo $theme->get_limit_content(25);
									?>
								</div>
							</div>
	<?php endwhile;?>
<?php else:?>
							<div class="article not-found">
								<h1><?php _e('Nothing found', 'fc');?></h1>
								<p><?php _e('Sorry, no posts were found. Please try again.', 'fc');?></p>
							</div>	
<?php endif;?>

						</div>
					</div>

					<div class="aside column small-column" role="complementary">
						<?php dynamic_sidebar( 'post' );?>&nbsp;
					</div>
<?php get_footer(); ?>