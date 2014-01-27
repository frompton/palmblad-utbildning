<?php
/**
 * @package WordPress
 * @subpackage 
 */
global $theme;
?>
			</div><!-- #page-content -->
			<div id="page-footer" class="footer" role="contentinfo">
				<div class="inner clear-children">
						<?php dynamic_sidebar('footer-sidebar');?>
				</div>
			</div><!-- #page-footer -->
		</div><!-- #page-container -->

		<!-- wp_footer -->
		<?php wp_footer(); ?>
		<!-- /wp_footer -->
	</body>
</html>