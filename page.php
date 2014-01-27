<?php
 /**
 * @package WordPress
 * @subpackage 
 */
	get_header();
?>
<?php while( have_posts() ): the_post();?>
					<div class="column large-column first-column">
						<div class="article page-article">
							<?php get_template_part( 'loop', 'page' );?>
						</div>

					</div>
<?php endwhile;?>
<?php get_footer(); ?>