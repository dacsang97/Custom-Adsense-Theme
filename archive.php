<?php
/**
 * The template for displaying archive pages.
 *
 * Used for displaying archive-type pages. These views can be further customized by
 * creating a separate template for each one.
 *
 * - author.php (Author archive)
 * - category.php (Category archive)
 * - date.php (Date archive)
 * - tag.php (Tag archive)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
$mts_options = get_option(MTS_THEME_NAME);
get_header();

$mts_home_layout = $mts_options['mts_home_layout'];
if ( 'full-width' == $mts_home_layout ) {
	$pclass	= 'page-featuredfull';
} elseif ( 'blog-width' == $mts_home_layout ) {
	$pclass	= 'page-featuredblog';
} elseif ( 'isotope-width' == $mts_home_layout ) {
	$pclass	= 'page-featuredisotope';
} elseif ( 'grid-width-sidebar' == $mts_home_layout ) {
	$pclass	= 'page-featuredgridsidebar';
} elseif ( 'traditional' == $mts_home_layout ) {
	$pclass	= 'page-traditional';
} elseif ( 'traditional-with-full-thumb' == $mts_home_layout ) {
	$pclass	= 'page-traditional-full-thumb';
} else { 
	$pclass = 'page-featured-default';
} ?>

<div id="page" class="<?php echo $pclass; ?>">
	<div class="article">
		<div id="content_box">
			<h1 class="postsby">
				<span><?php the_archive_title(); ?></span>
			</h1>
			<?php if( $mts_options['mts_home_layout'] == 'isotope-width') { ?>
			<div class="content_wrap">
			<?php } ?>
				<?php $j = 0; if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article class="latestPost excerpt <?php echo (++$j % 3 == 0) ? 'last' : ''; ?>">
						<?php mts_archive_post(); ?>
					</article><!--.post excerpt-->
				<?php endwhile; endif; ?>
			<?php if( $mts_options['mts_home_layout'] == 'isotope-width') { ?>
				 </div>
			<?php } ?>
			<?php if ( $j !== 0 ) { // No pagination if there is no posts ?>
				<?php mts_pagination(); ?>
			<?php } ?>
		</div>
	</div>
	<?php if( 'featured-width' != $mts_home_layout  && 'isotope-width' != $mts_home_layout && 'full-width' != $mts_home_layout ) get_sidebar(); ?>
<?php get_footer(); ?>