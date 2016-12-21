<?php
/**
 * The main template file.
 *
 * Used to display the homepage when home.php doesn't exist.
 */
$mts_options = get_option(MTS_THEME_NAME);
get_header();

$mts_home_layout = $mts_options['mts_home_layout'];
if ( 'full-width' == $mts_home_layout ) {
	$pclass	= 'page-featuredfull';
	$thumb 	= 'ad-sense-featuredfull';
} elseif ( 'blog-width' == $mts_home_layout ) {
	$pclass	= 'page-featuredblog';
	$thumb 	= 'ad-sense-traditionalfull';
} elseif ( 'isotope-width' == $mts_home_layout ) {
	$pclass	= 'page-featuredisotope';
	$thumb 	= 'ad-sense-featuredfull';
} elseif ( 'grid-width-sidebar' == $mts_home_layout ) {
	$pclass	= 'page-featuredgridsidebar';
	$thumb 	= 'ad-sense-traditionalfull';
} elseif ( 'traditional' == $mts_home_layout ) {
	$pclass	= 'page-traditional';
	$thumb 	= 'ad-sense-traditionalfull';
} elseif ( 'traditional-with-full-thumb' == $mts_home_layout ) {
	$pclass	= 'page-traditional-full-thumb';
	$thumb 	= 'ad-sense-traditionalfull';
} else { 
	$pclass = 'page-featured-default';
	$thumb 	= 'ad-sense-featuredfull';
} ?>

<div id="page" class="<?php echo $pclass; ?>">
	<div class="article">
		<div id="content_box">
			<?php if ( !is_paged() ) {

				if ( is_home() && $mts_options['mts_featured_slider'] == '1' ) { ?>

					<div class="primary-slider-container clearfix loading">
						<div id="slider" class="primary-slider">
						<?php if ( empty( $mts_options['mts_custom_slider'] ) ) { ?>
							<?php
							// prevent implode error
							if ( empty( $mts_options['mts_featured_slider_cat'] ) || !is_array( $mts_options['mts_featured_slider_cat'] ) ) {
								$mts_options['mts_featured_slider_cat'] = array('0');
							}

							$slider_cat = implode( ",", $mts_options['mts_featured_slider_cat'] );
							$slider_query = new WP_Query('cat='.$slider_cat.'&posts_per_page='.$mts_options['mts_featured_slider_num']);
							while ( $slider_query->have_posts() ) : $slider_query->the_post();
							?>
							<div class="item"> 
								<a href="<?php echo esc_url( get_the_permalink() ); ?>">
									<?php the_post_thumbnail( $thumb, array('title' => '') ); ?>
									<div class="slide-caption">
										<h2 class="slide-title"><?php the_title(); ?></h2>
									</div>
								</a> 
							</div>
							<?php endwhile; wp_reset_postdata(); ?>
						<?php } else { ?>
							<?php foreach( $mts_options['mts_custom_slider'] as $slide ) : ?>
								<div class="item">
									<a href="<?php echo esc_url( $slide['mts_custom_slider_link'] ); ?>">
										<?php echo wp_get_attachment_image( $slide['mts_custom_slider_image'], $thumb, false, array('title' => '') ); ?>
										<div class="slide-caption">
											<h2 class="slide-title"><?php echo esc_html( $slide['mts_custom_slider_title'] ); ?></h2>
										</div>
									</a>
								</div>
							<?php endforeach; ?>
						<?php } ?>
						</div><!-- .primary-slider -->
					</div><!-- .primary-slider-container -->

				<?php }

				$featured_categories = array();
				if ( !empty( $mts_options['mts_featured_categories'] ) ) {
					foreach ( $mts_options['mts_featured_categories'] as $section ) {
						$category_id = $section['mts_featured_category'];
						$featured_categories[] = $category_id;
						$posts_num = $section['mts_featured_category_postsnum'];
						if ( 'latest' == $category_id ) { ?>
							<?php if( $mts_options['mts_home_layout'] == 'isotope-width') { ?>
							<div class="content_wrap">
							<?php } ?>
								<?php $j = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
									<article class="latestPost excerpt <?php echo (++$j % 3 == 0) ? 'last' : ''; ?>">
										<?php mts_archive_post(); ?>
									</article>
								<?php endwhile; endif; ?>
							<?php if( $mts_options['mts_home_layout'] == 'isotope-width') { ?>
							</div>
						<?php } ?>
							
							<?php if ( $j !== 0 ) { // No pagination if there is no posts ?>
								<?php mts_pagination(); ?>
							<?php } ?>
							
						<?php } else { // if $category_id != 'latest': ?>
							<div class="latestPost-category-options">
								<h3 class="featured-category-title"><a href="<?php echo esc_url( get_category_link( $category_id ) ); ?>" title="<?php echo esc_attr( get_cat_name( $category_id ) ); ?>"><?php echo esc_html( get_cat_name( $category_id ) ); ?></a></h3>
								<?php if( $mts_options['mts_home_layout'] == 'isotope-width') { ?>
								<div class="content_wrap">
								<?php } ?>
								<?php
								$j = 0;
								$cat_query = new WP_Query('cat='.$category_id.'&posts_per_page='.$posts_num);
								if ( $cat_query->have_posts() ) : while ( $cat_query->have_posts() ) : $cat_query->the_post(); ?>
									<article class="latestPost excerpt <?php echo (++$j % 3 == 0) ? 'last' : ''; ?>">
										<?php mts_archive_post(); ?>
									</article>
								<?php
								endwhile; endif; ?>
								<?php if( $mts_options['mts_home_layout'] == 'isotope-width') { ?>
									 </div>
								<?php } ?>
							</div>
							<?php wp_reset_postdata();
						}
					}
				}
			} else { //Paged
				if( $mts_options['mts_home_layout'] == 'isotope-width') { ?>
				<div class="content_wrap">
				<?php } ?>
					<?php $j = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<article class="latestPost excerpt <?php echo (++$j % 3 == 0) ? 'last' : ''; ?>">
						<?php mts_archive_post(); ?>
					</article>
					<?php endwhile; endif; ?>
				<?php if( $mts_options['mts_home_layout'] == 'isotope-width') { ?>
				</div>
				 <?php } ?>
				<?php if ( $j !== 0 ) { // No pagination if there is no posts ?>
					<?php mts_pagination(); ?>
				<?php } ?>

			<?php } ?>
		</div>
	</div>
	<?php if( 'featured-width' != $mts_home_layout  && 'isotope-width' != $mts_home_layout && 'full-width' != $mts_home_layout ) get_sidebar(); ?>
<?php get_footer(); ?>