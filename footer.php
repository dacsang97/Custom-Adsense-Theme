<?php
/**
 * The template for displaying the footer.
 */
?>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php
// default = 3
$first_footer_num  = empty($mts_options['mts_first_footer_num']) ? 3 : $mts_options['mts_first_footer_num'];
?>
	</div><!--#page-->
	<footer id="site-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
		<div class="container">
			<div class="footer-header">
				<div class="logo-wrap">
					<?php if ($mts_options['mts_footer_logo'] != '') { ?>
						<?php
						$logo_id = mts_get_image_id_from_url( $mts_options['mts_footer_logo'] );
						$logo_w_h = '';
						if ( $logo_id ) {
							$logo	 = wp_get_attachment_image_src( $logo_id, 'full' );
							$logo_w_h = ' width="'.$logo[1].'" height="'.$logo[2].'"';
						}
						if( is_front_page() || is_home() || is_404() ) { ?>
							<h3 id="logo" class="image-logo" itemprop="headline">
								<a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_url( $mts_options['mts_footer_logo'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"<?php echo $logo_w_h; ?>></a>
							</h3><!-- END #logo -->
						<?php } else { ?>
							<h4 id="logo" class="image-logo" itemprop="headline">
								<a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_url( $mts_options['mts_footer_logo'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"<?php echo $logo_w_h; ?>></a>
							</h4><!-- END #logo -->
						<?php } ?>
					<?php } else { ?>
						<?php if( is_front_page() || is_home() || is_404() ) { ?>
							<h3 id="logo" class="text-logo" itemprop="headline">
								<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
							</h3><!-- END #logo -->
						<?php } else { ?>
							<h4 id="logo" class="text-logo" itemprop="headline">
								<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
							</h4><!-- END #logo -->
						<?php } ?>
						<div class="site-description" itemprop="description">
							<?php bloginfo( 'description' ); ?>
						</div>
					<?php } ?>
				</div>
				<?php if ( !empty($mts_options['mts_footer_social']) && is_array($mts_options['mts_footer_social']) && !empty($mts_options['mts_footer_social_icon_head'])) { ?>
					 <div class="footer-social">
					  <?php foreach( $mts_options['mts_footer_social'] as $footer_icons ) : ?>
					   <?php if( ! empty( $footer_icons['mts_footer_icon'] ) && isset( $footer_icons['mts_footer_icon'] ) && ! empty( $footer_icons['mts_footer_icon_link'] )) : ?>
						<a style="background-color: <?php echo isset( $footer_icons['mts_footer_icon_color'] ) ? $footer_icons['mts_footer_icon_color'] : "#555555" ?>" href="<?php print $footer_icons['mts_footer_icon_link'] ?>" class="footer-<?php print $footer_icons['mts_footer_icon'] ?>"><span class="fa fa-<?php print $footer_icons['mts_footer_icon'] ?>"></span></a>
					   <?php endif; ?>
					  <?php endforeach; ?>
					 </div>
				<?php } ?>
				<a href="#blog" class="toplink"><i class="fa fa-angle-up"></i></a>
		</div><!--.footer-header-->
			<?php if ($mts_options['mts_first_footer']) : ?>
				<div class="footer-widgets first-footer-widgets widgets-num-<?php echo $first_footer_num; ?>">
				<?php
				for ( $i = 1; $i <= $first_footer_num; $i++ ) {
					$sidebar = ( $i == 1 ) ? 'footer-first' : 'footer-first-'.$i;
					$class = ( $i == $first_footer_num ) ? 'f-widget last f-widget-'.$i : 'f-widget f-widget-'.$i;
					?>
					<div class="<?php echo $class;?>">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $sidebar ) ) : ?><?php endif; ?>
					</div>
					<?php
				}
				?>
				</div><!--.first-footer-widgets-->
			<?php endif; ?>

			<div class="copyrights">
				<?php mts_copyrights_credit(); ?>
			</div> 
		</div><!--.container-->
	</footer><!--#site-footer-->
	<?php if($mts_options['mts_detect_adblocker'] && ($mts_options['mts_detect_adblocker_type'] == 'popup' || $mts_options['mts_detect_adblocker_type'] == 'floating')) { ?>
		<?php if($mts_options['mts_detect_adblocker_type'] == 'popup') { ?>
			<div class="blocker-overlay"></div>
		<?php } ?>
		<?php echo detect_adblocker_notice(); ?>
	<?php } ?>
</div><!--.main-container-->
<?php mts_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>