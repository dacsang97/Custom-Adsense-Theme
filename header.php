<?php
/**
 * The template for displaying the header.
 *
 * Displays everything from the doctype declaration down to the navigation.
 */
?>
<!DOCTYPE html>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<html class="no-js" <?php language_attributes(); ?>>
<head itemscope itemtype="http://schema.org/WebSite">
	<meta charset="<?php bloginfo('charset'); ?>">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php mts_meta(); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
    <meta property="fb:app_id" content="245853192502636" />
    <meta property="fb:admins" content="100003142142917"/>
</head>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=245853192502636";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<body id="blog" <?php body_class('main'); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php if($mts_options['mts_background_clickable'] && $mts_options['mts_background_link']) { ?>
		<a href="<?php echo $mts_options['mts_background_link']; ?>" rel="nofollow" class="clickable-background" <?php if($mts_options['mts_background_link_new_tab']) echo 'target="_blank"'; ?>></a>
	<?php } ?>
	<div class="main-container <?php if($mts_options['mts_detect_adblocker']) echo 'blocker-enabled-check '; echo $mts_options['mts_detect_adblocker_type']; ?>">
		<header id="site-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
	  		<div class="container">	
	  			<div id="header">
					<div class="logo-wrap">
						<?php
						if ($mts_options['mts_logo'] != '') {
							$logo_id = mts_get_image_id_from_url( $mts_options['mts_logo'] );
							$logo_w_h = '';
							if ( $logo_id ) {
								$logo	 = wp_get_attachment_image_src( $logo_id, 'full' );
								$logo_w_h = ' width="'.$logo[1].'" height="'.$logo[2].'"';
							}
							if( is_front_page() || is_home() || is_404() ) { ?>
								<h1 id="logo" class="image-logo" itemprop="headline">
									<a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_url( $mts_options['mts_logo'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"<?php echo $logo_w_h; ?><?php if (!empty($mts_options['mts_logo2x'])) { echo ' data-at2x="'.esc_attr( $mts_options['mts_logo2x'] ).'"'; } ?>></a>
								</h1><!-- END #logo -->
							<?php } else { ?>
								<h2 id="logo" class="image-logo" itemprop="headline">
									<a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_url( $mts_options['mts_logo'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"<?php echo $logo_w_h; ?><?php if (!empty($mts_options['mts_logo2x'])) { echo ' data-at2x="'.esc_attr( $mts_options['mts_logo2x'] ).'"'; } ?>></a>
								</h2><!-- END #logo -->
							<?php } ?>
						<?php } else { ?>
							<?php if( is_front_page() || is_home() || is_404() ) { ?>
								<h1 id="logo" class="text-logo" itemprop="headline">
									<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
								</h1><!-- END #logo -->
							<?php } else { ?>
								<h2 id="logo" class="text-logo" itemprop="headline">
									<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
								</h2><!-- END #logo -->
							<?php } ?>
							<div class="site-description" itemprop="description">
								<?php bloginfo( 'description' ); ?>
							</div>
						<?php } ?>
					</div>
				</div><!--#header-->
			<?php if ( !empty( $mts_options['mts_show_primary_nav'] ) || !empty( $mts_options['mts_header_search'] ) ) { ?>
				<?php if ( $mts_options['mts_sticky_nav'] == '1' ) { ?>
					<div class="clear" id="catcher"></div>
					<div class="navigation-wrap sticky-navigation">
				<?php } else { ?>
					<div class="navigation-wrap">
				<?php } ?>
		 			<?php if ( $mts_options['mts_show_primary_nav'] == '1' ) { ?>
	   					<div id="primary-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
			  				<a href="#" id="pull" class="toggle-mobile-menu"><?php _e('Menu', 'ad-sense' ); ?></a>
			  				<nav class="navigation clearfix mobile-menu-wrapper">
								<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
									<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
								<?php } else { ?>
									<ul class="menu clearfix">
										<?php wp_list_categories('title_li='); ?>
									</ul>
								<?php } ?>
							</nav>
		   				</div>
		  			<?php } ?>
		  			<?php if(!empty($mts_options['mts_header_search'])) { ?>
						<div id="search-6" class="widget widget_search">
							<?php get_search_form(); ?>
						</div><!-- END #search-6 -->
		  			<?php } ?>
					</div>
			<?php } ?>
			<?php if($mts_options['mts_navigation_ad'] && $mts_options['mts_navigation_adcode']) { ?>
				<div class="navigation-banner">
					<div style="<?php mts_ad_size_value($mts_options['mts_navigation_ad_size']); ?>">
						<?php echo $mts_options['mts_navigation_adcode']; ?>
					</div>
				</div>
			<?php } ?>
			<?php if( isset( $mts_options['mts_call_to_action'] ) && $mts_options['mts_call_to_action'] == '1') { ?>
				<div class="text-info">
					<h3 class="text"><?php echo !empty($mts_options['mts_call_to_action_heading']) ? $mts_options['mts_call_to_action_heading'] : ''; ?></h3>
					<?php if ( !empty($mts_options['mts_call_to_action_button_url']) ) { ?>
						<div class="readMore">
							<a href="<?php echo $mts_options['mts_call_to_action_button_url']; ?>" title="<?php echo !empty($mts_options['mts_call_to_action_button']) ? $mts_options['mts_call_to_action_button'] : ''; ?>"><?php echo !empty($mts_options['mts_call_to_action_button']) ? $mts_options['mts_call_to_action_button'] : ''; ?></a>
						</div>
				   <?php } ?> 
				</div>
			<?php } ?>
			</div>
		</header>