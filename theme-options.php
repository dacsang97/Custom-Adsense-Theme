<?php

defined('ABSPATH') or die;

/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 *
 */
require_once( dirname( __FILE__ ) . '/options/options.php' );
/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constants for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
	
	//$sections = array();
	$sections[] = array(
		'title' => __('A Section added by hook', 'ad-sense' ),
		'desc' => '<p class="description">' . __('This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.', 'ad-sense' ) . '</p>',
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You don't have to though, leave it blank for default.
		'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array()
	);
	
	return $sections;
	
}//function
//add_filter('nhp-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}//function
//add_filter('nhp-opts-args-twenty_eleven', 'change_framework_args');

/*
 * This is the meat of creating the options page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there to be overridden if needed.
 *
 *
 */

function setup_framework_options(){
	$args = array();

	//Set it to dev mode to view the class settings/info in the form - default is false
	$args['dev_mode'] = false;
	//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
	//$args['stylesheet_override'] = true;

	//Add HTML before the form
	//$args['intro_text'] = __('<p>This is the HTML which can be displayed before the form, it isn't required, but more info is always better. Anything goes in terms of markup here, any HTML.</p>', 'ad-sense' );

	if ( ! MTS_THEME_WHITE_LABEL ) {
		//Setup custom links in the footer for share icons
		$args['share_icons']['twitter'] = array(
			'link' => 'http://twitter.com/mythemeshopteam',
			'title' => __( 'Follow Us on Twitter', 'ad-sense' ),
			'img' => 'fa fa-twitter-square'
		);
		$args['share_icons']['facebook'] = array(
			'link' => 'http://www.facebook.com/mythemeshop',
			'title' => __( 'Like us on Facebook', 'ad-sense' ),
			'img' => 'fa fa-facebook-square'
		);
	}

	//Choose to disable the import/export feature
	//$args['show_import_export'] = false;

	//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
	$args['opt_name'] = MTS_THEME_NAME;

	//Custom menu icon
	//$args['menu_icon'] = '';

	//Custom menu title for options page - default is "Options"
	$args['menu_title'] = __('Theme Options', 'ad-sense' );

	//Custom Page Title for options page - default is "Options"
	$args['page_title'] = __('Theme Options', 'ad-sense' );

	//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
	$args['page_slug'] = 'theme_options';

	//Custom page capability - default is set to "manage_options"
	//$args['page_cap'] = 'manage_options';

	//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
	//$args['page_type'] = 'submenu';

	//parent menu - default is set to "themes.php" (Appearance)
	//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	//$args['page_parent'] = 'themes.php';

	//custom page location - default 100 - must be unique or will override other items
	$args['page_position'] = 62;

	//Custom page icon class (used to override the page icon next to heading)
	//$args['page_icon'] = 'icon-themes';

	if ( ! MTS_THEME_WHITE_LABEL ) {
		//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition
		$args['help_tabs'][] = array(
			'id' => 'nhp-opts-1',
			'title' => __('Support', 'ad-sense' ),
			'content' => '<p>' . sprintf( __('If you are facing any problem with our theme or theme option panel, head over to our %s.', 'ad-sense' ), '<a href="http://community.mythemeshop.com/">'. __( 'Support Forums', 'ad-sense' ) . '</a>' ) . '</p>'
		);
		$args['help_tabs'][] = array(
			'id' => 'nhp-opts-2',
			'title' => __('Earn Money', 'ad-sense' ),
			'content' => '<p>' . sprintf( __('Earn 70%% commision on every sale by refering your friends and readers. Join our %s.', 'ad-sense' ), '<a href="http://mythemeshop.com/affiliate-program/">' . __( 'Affiliate Program', 'ad-sense' ) . '</a>' ) . '</p>'
		);
	}

	//Set the Help Sidebar for the options page - no sidebar by default										
	//$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'ad-sense' );

	$mts_home_layout = array(
		'featured-width' => array('img' => NHP_OPTIONS_URL.'img/layouts/home-layout-1.png'), // No sidebar grid (Default)
		'isotope-width' => array('img' => NHP_OPTIONS_URL.'img/layouts/home-layout-2.png'),  // No sidebar Masonry
		'full-width' => array('img' => NHP_OPTIONS_URL.'img/layouts/home-layout-3.png'),  // No Sidebar full width posts
		'blog-width' => array('img' => NHP_OPTIONS_URL.'img/layouts/home-layout-4.png'), // Article with sidebar 3Posts
		'grid-width-sidebar' => array('img' => NHP_OPTIONS_URL.'img/layouts/home-layout-5.png'),  // Article with sidebar 2Posts
		'traditional' => array('img' => NHP_OPTIONS_URL.'img/layouts/home-layout-6.png'),  // Traditional Blog Layout with Sidebar
		'traditional-with-full-thumb' => array('img' => NHP_OPTIONS_URL.'img/layouts/home-layout-7.png')  // Traditional Blog Layout with Sidebar & Full Width Thumbnail
	);

	$mts_patterns = array(
		'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
		'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
		'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
		'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
		'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
		'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
		'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
		'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
		'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
		'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
		'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
		'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
		'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
		'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
		'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
		'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
		'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
		'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
		'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
		'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
		'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
		'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
		'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
		'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
		'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
		'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
		'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
		'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
		'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
		'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
		'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
		'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
		'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
		'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
		'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
		'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
		'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
		'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
		'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
		'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
		'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
		'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
		'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
		'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
		'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
		'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
		'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
		'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
		'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
		'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
		'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
		'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
		'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
		'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
		'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
		'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
		'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
		'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
		'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
		'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
		'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
		'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
		'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
		'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
	);
	

	$sections = array();

	$sections[] = array(
		'icon' => 'fa fa-cogs',
		'title' => __('General Settings', 'ad-sense' ),
		'desc' => '<p class="description">' . __('This tab contains common setting options which will be applied to the whole theme.', 'ad-sense' ) . '</p>',
		'fields' => array(
			array(
				'id' => 'mts_logo',
				'type' => 'upload',
				'title' => __('Logo Image', 'ad-sense' ),
				'sub_desc' => __('Upload your logo using the Upload Button or insert image URL.', 'ad-sense' )
			),
			array(
				'id' => 'mts_favicon',
				'type' => 'upload',
				'title' => __('Favicon', 'ad-sense' ),
				'sub_desc' => sprintf( __('Upload a %s image that will represent your website\'s favicon.', 'ad-sense' ), '<strong>32 x 32 px</strong>' )
			),
			array(
				'id' => 'mts_touch_icon',
				'type' => 'upload',
				'title' => __('Touch icon', 'ad-sense' ),
				'sub_desc' => sprintf( __('Upload a %s image that will represent your website\'s touch icon for iOS 2.0+ and Android 2.1+ devices.', 'ad-sense' ), '<strong>152 x 152 px</strong>' )
			),
			array(
				'id' => 'mts_metro_icon',
				'type' => 'upload',
				'title' => __('Metro icon', 'ad-sense' ),
				'sub_desc' => sprintf( __('Upload a %s image that will represent your website\'s IE 10 Metro tile icon.', 'ad-sense' ), '<strong>144 x 144 px</strong>' )
			),
			array(
				'id' => 'mts_twitter_username',
				'type' => 'text',
				'title' => __('Twitter Username', 'ad-sense' ),
				'sub_desc' => __('Enter your Username here.', 'ad-sense' ),
			),
			array(
				'id' => 'mts_feedburner',
				'type' => 'text',
				'title' => __('FeedBurner URL', 'ad-sense' ),
				'sub_desc' => sprintf( __('Enter your FeedBurner\'s URL here, ex: %s and your main feed (http://example.com/feed) will get redirected to the FeedBurner ID entered here.)', 'ad-sense' ), '<strong>http://feeds.feedburner.com/mythemeshop</strong>' ),
				'validate' => 'url'
			),
			array(
				'id' => 'mts_header_code',
				'type' => 'textarea',
				'title' => __('Header Code', 'ad-sense' ),
				'sub_desc' => wp_kses( __('Enter the code which you need to place <strong>before closing &lt;/head&gt; tag</strong>. (ex: Google Webmaster Tools verification, Bing Webmaster Center, BuySellAds Script, Alexa verification etc.)', 'ad-sense' ), array( 'strong' => '' ) )
			),
			array(
				'id' => 'mts_analytics_code',
				'type' => 'textarea',
				'title' => __('Footer Code', 'ad-sense' ),
				'sub_desc' => wp_kses( __('Enter the codes which you need to place in your footer. <strong>(ex: Google Analytics, Clicky, STATCOUNTER, Woopra, Histats, etc.)</strong>.', 'ad-sense' ), array( 'strong' => '' ) )
			),
			array(
				'id' => 'mts_pagenavigation_type',
				'type' => 'radio',
				'title' => __('Pagination Type', 'ad-sense' ),
				'sub_desc' => __('Select pagination type.', 'ad-sense' ),
				'options' => array(
					'0'=> __('Default (Next / Previous)', 'ad-sense' ),
					'1' => __('Numbered (1 2 3 4...)', 'ad-sense' ),
					'2' => __( 'AJAX (Load More Button)', 'ad-sense' ),
					'3' => __( 'AJAX (Auto Infinite Scroll)', 'ad-sense' )
				),
				'std' => '1'
			),
			array(
				'id' => 'mts_ajax_search',
				'type' => 'button_set',
				'title' => __('AJAX Quick search', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('Enable or disable search results appearing instantly below the search form', 'ad-sense' ),
				'std' => '0'
			),
			array(
				'id' => 'mts_responsive',
				'type' => 'button_set',
				'title' => __('Responsiveness', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('MyThemeShop themes are responsive, which means they adapt to tablet and mobile devices, ensuring that your content is always displayed beautifully no matter what device visitors are using. Enable or disable responsiveness using this option.', 'ad-sense' ),
				'std' => '1'
			),
			array(
				'id' => 'mts_rtl',
				'type' => 'button_set',
				'title' => __('Right To Left Language Support', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('Enable this option for right-to-left sites.', 'ad-sense' ),
				'std' => '0'
			),
			array(
				'id' => 'mts_shop_products',
				'type' => 'text',
				'title' => __('No. of Products', 'ad-sense' ),
				'sub_desc' => __('Enter the total number of products which you want to show on shop page (WooCommerce plugin must be enabled).', 'ad-sense' ),
				'validate' => 'numeric',
				'std' => '9',
				'class' => 'small-text'
			),
		)
	);
	$sections[] = array(
		'icon' => 'fa fa-bolt',
		'title' => __('Performance', 'ad-sense' ),
		'desc' => '<p class="description">' . __('This tab contains performance-related options which can help speed up your website.', 'ad-sense' ) . '</p>',
		'fields' => array(
			array(
				'id' => 'mts_prefetching',
				'type' => 'button_set',
				'title' => __('Prefetching', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('Enable or disable prefetching. If user is on homepage, then single page will load faster and if user is on single page, homepage will load faster in modern browsers.', 'ad-sense' ),
				'std' => '0'
			),
			array(
				'id' => 'mts_lazy_load',
				'type' => 'button_set_hide_below',
				'title' => __('Lazy Load', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('Delay loading of images outside of viewport, until user scrolls to them.', 'ad-sense' ),
				'std' => '0',
				'args' => array('hide' => 2)
			),
			array(
				'id' => 'mts_lazy_load_thumbs',
				'type' => 'button_set',
				'title' => __('Lazy load featured images', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('Enable or disable Lazy load of featured images across site.', 'ad-sense' ),
				'std' => '0'
			),
			array(
				'id' => 'mts_lazy_load_content',
				'type' => 'button_set',
				'title' => __('Lazy load post content images', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('Enable or disable Lazy load of images inside post/page content.', 'ad-sense' ),
				'std' => '0'
			),
			array(
				'id' => 'mts_async_js',
				'type' => 'button_set',
				'title' => __('Async JavaScript', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => sprintf( __('Add %s attribute to script tags to improve page download speed.', 'ad-sense' ), '<code>async</code>' ),
				'std' => '1',
			),
			array(
				'id' => 'mts_remove_ver_params',
				'type' => 'button_set',
				'title' => __('Remove ver parameters', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => sprintf( __('Remove %s parameter from CSS and JS file calls. It may improve speed in some browsers which do not cache files having the parameter.', 'ad-sense' ), '<code>ver</code>' ),
				'std' => '1',
			),
			array(
				'id' => 'mts_optimize_wc',
				'type' => 'button_set',
				'title' => __('Optimize WooCommerce scripts', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('Load WooCommerce scripts and styles only on WooCommerce pages (WooCommerce plugin must be enabled).', 'ad-sense' ),
				'std' => '1'
			),
			'cache_message' => array(
				'id' => 'mts_cache_message',
				'type' => 'info',
				'title' => __('Use Cache', 'ad-sense' ),
				/*
					Translators: %1$s = popup link to W3 Total Cache, %2$s = popup link to WP Super Cache
				 */
				'desc' => sprintf(
					__('A cache plugin can increase page download speed dramatically. We recommend using %1$s or %2$s.', 'ad-sense' ),
					'<a href="https://community.mythemeshop.com/tutorials/article/8-make-your-website-load-faster-using-w3-total-cache-plugin/" target="_blank" title="W3 Total Cache">W3 Total Cache</a>',
					'<a href="'.admin_url( 'plugin-install.php?tab=plugin-information&plugin=wp-super-cache&TB_iframe=true&width=772&height=574' ).'" class="thickbox" title="WP Super Cache">WP Super Cache</a>'
				),
			),
		)
	);

	// Hide cache message on multisite or if a chache plugin is active already
	if ( is_multisite() || strstr( join( ';', get_option( 'active_plugins' ) ), 'cache' ) ) {
		unset( $sections[1]['fields']['cache_message'] );
	}

	$sections[] = array(
		'icon' => 'fa fa-adjust',
		'title' => __('Styling Options', 'ad-sense' ),
		'desc' => '<p class="description">' . __('Control the visual appearance of your theme, such as colors, layout and patterns, from here.', 'ad-sense' ) . '</p>',
		'fields' => array(
			array(
				'id' => 'mts_color_scheme',
				'type' => 'color',
				'title' => __('Primary Color Scheme', 'ad-sense' ),
				'sub_desc' => __('The theme comes with unlimited color schemes for your theme\'s styling.', 'ad-sense' ),
				'std' => '#2196f3'
			),
			array(
				'id' => 'mts_second_color_scheme',
				'type' => 'color',
				'title' => __('Secondary Color/ Hover', 'ad-sense' ), 
				'sub_desc' => __('The theme comes with unlimited color schemes for your theme\'s styling.', 'ad-sense' ),
				'std' => '#8bc34a'
			),
			array(
				'id' => 'mts_layout',
				'type' => 'radio_img',
				'title' => __('Layout Style', 'ad-sense' ),
				'sub_desc' => wp_kses( __('Choose the <strong>default sidebar position</strong> for your site. The position of the sidebar for individual posts can be set in the post editor. NOTE: On homepage this will apply to only layouts with sidebar.', 'ad-sense' ), array( 'strong' => '' ) ),
				'options' => array(
					'cslayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/cs.png'),
					'sclayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/sc.png')
				),
				'std' => 'cslayout'
			),
			array(
				'id' => 'mts_background',
				'type' => 'background',
				'title' => __('Site Background', 'ad-sense' ),
				'sub_desc' => __('Set background color, pattern and image from here.', 'ad-sense' ),
				'options' => array(
					'color'		 => '',	
					'image_pattern' => $mts_patterns,
					'image_upload'  => '',	
					'repeat'		=> array(),
					'attachment'	=> array(),
					'position'	  => array(),
					'size'		  => array(),
					'gradient'	  => '',	
					'parallax'	  => array(),
				),
				'std' => array(
					'color'		 => '#dadada',
					'use'		   => 'pattern',
					'image_pattern' => 'nobg',
					'image_upload'  => '',
					'repeat'		=> 'repeat',
					'attachment'	=> 'scroll',
					'position'	  => 'left top',
					'size'		  => 'cover',
					'gradient'	  => array('from' => '#ffffff', 'to' => '#000000', 'direction' => 'horizontal' ),
					'parallax'	  => '0',
				)
			),
			array(
				'id' => 'mts_custom_css',
				'type' => 'textarea',
				'title' => __('Custom CSS', 'ad-sense' ),
				'sub_desc' => __('You can enter custom CSS code here to further customize your theme. This will override the default CSS used on your site.', 'ad-sense' )
			),
			array(
				'id' => 'mts_lightbox',
				'type' => 'button_set',
				'title' => __('Lightbox', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('A lightbox is a stylized pop-up that allows your visitors to view larger versions of images without leaving the current page. You can enable or disable the lightbox here.', 'ad-sense' ),
				'std' => '0'
			),
		)
	);
	$sections[] = array(
		'icon' => 'fa fa-credit-card',
		'title' => __('Header', 'ad-sense' ),
		'desc' => '<p class="description">' . __('From here, you can control the elements of header section.', 'ad-sense' ) . '</p>',
		'fields' => array(
			array(
				'id' => 'mts_header_background',
				'type' => 'background',
				'title' => __('Header Background', 'ad-sense' ),
				'sub_desc' => __('Set background color, pattern and image from here.', 'ad-sense' ),
				'options' => array(
					'color'		 => '',	
					'image_pattern' => $mts_patterns,
					'image_upload'  => '',	
					'repeat'		=> array(),
					'attachment'	=> array(),
					'position'	  => array(),
					'size'		  => array(),
					'gradient'	  => '',	
					'parallax'	  => array(),
				),
				'std' => array(
					'color'		 => '#252525',
					'use'		 	=> 'pattern',
					'image_pattern' => 'nobg',
					'image_upload'  => '',
					'repeat'		=> 'repeat',
					'attachment'	=> 'scroll',
					'position'	  => 'left top',
					'size'		  => 'cover',
					'gradient'	  => array('from' => '#ffffff', 'to' => '#000000', 'direction' => 'horizontal' ),
					'parallax'	  => '0',
				)
			),
			array(
				'id' => 'mts_header_section2',
				'type' => 'button_set',
				'title' => __('Show Logo', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => wp_kses( __('Use this button to Show or Hide the <strong>Logo</strong> completely.', 'ad-sense' ), array( 'strong' => '' ) ),
				'std' => '1'
			),
			array(
				'id' => 'mts_social_icon_head',
				'type' => 'button_set_hide_below',
				'title' => __('Social Icons', 'ad-sense'),
				'sub_desc' => __('You can control social icon links from <strong>Blog Settings > Social Buttons</strong> Tab.', 'mythemeshop'),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'std' => '1',
				'args' => array('hide' => '1')
			),
			array(
			 	'id' => 'mts_header_social',
			 	'title' => __('Header Social Icons', 'ad-sense'), 
			 	'sub_desc' => __( 'Add Social Media icons in header.', 'ad-sense' ),
			 	'type' => 'group',
			 	'groupname' => __('Header Icons', 'ad-sense'), // Group name
			 	'subfields' => 
					array(
						array(
							'id' => 'mts_header_icon_title',
							'type' => 'text',
							'title' => __('Title', 'ad-sense'), 
							),
						array(
							'id' => 'mts_header_icon',
							'type' => 'icon_select',
							'title' => __('Icon', 'ad-sense')
							),
						array(
							'id' => 'mts_header_icon_color',
							'type' => 'color',
							'title' => __('Icon Color', 'ad-sense' )
							),
						array(
							'id' => 'mts_header_icon_link',
							'type' => 'text',
							'title' => __('URL', 'ad-sense'), 
							),
						),
				'std' => array(
					'facebook' => array(
						'group_title' => 'Facebook',
						'group_sort' => '1',
						'mts_header_icon_title' => 'Facebook',
						'mts_header_icon' => 'facebook',
						'mts_header_icon_color' => '#5d82d1',
						'mts_header_icon_link' => '#',
					),
					'twitter' => array(
						'group_title' => 'Twitter',
						'group_sort' => '2',
						'mts_header_icon_title' => 'Twitter',
						'mts_header_icon' => 'twitter',
						'mts_header_icon_color' => '#40bff5',
						'mts_header_icon_link' => '#',
					),
					'gplus' => array(
						'group_title' => 'Google Plus',
						'group_sort' => '3',
						'mts_header_icon_title' => 'Google Plus',
						'mts_header_icon' => 'google-plus',
						'mts_header_icon_color' => '#eb5e4c',
						'mts_header_icon_link' => '#',
					)
				)
			),
			array(
				'id' => 'mts_show_primary_nav',
				'type' => 'button_set_hide_below',
				'title' => __('Show Primary Navigation Menu', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => sprintf( __('Use this button to enable %s.', 'ad-sense' ), '<strong>' . __( 'Primary Navigation Menu', 'ad-sense' ) . '</strong>' ),
				'std' => '1',
				'args' => array('hide' => 3)
				),
				array(
					'id' => 'mts_sticky_nav',
					'type' => 'button_set',
					'title' => __('Floating Navigation Menu', 'ad-sense' ),
					'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
					'sub_desc' => sprintf( __('Use this button to enable %s.', 'ad-sense' ), '<strong>' . __('Floating Navigation Menu', 'ad-sense' ) . '</strong>' ),
					'std' => '0'
				),
				array(
					'id' => 'mts_header_search',
					'type' => 'button_set',
					'title' => __('Show Header Search Form', 'ad-sense'), 
					'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
					'sub_desc' => __('Use this button to Show or Hide <strong>Header Search Form</strong>.', 'ad-sense'),
					'std' => '1'
				),
				array(
					'id' => 'mts_nav_background',
					'type' => 'background',
					'title' => __('Primary Navigation Background', 'ad-sense' ),
					'sub_desc' => __('Set background color, pattern and image from here.', 'ad-sense' ),
					'options' => array(
						'color'		 => '',	
						'image_pattern' => $mts_patterns,
						'image_upload'  => '',	
						'repeat'		=> array(),
						'attachment'	=> array(),
						'position'	  => array(),
						'size'		  => array(),
						'gradient'	  => '',	
						'parallax'	  => array(),
					),
					'std' => array(
						'color'		 => '#ffffff',
						'use'		 	=> 'pattern',
						'image_pattern' => 'nobg',
						'image_upload'  => '',
						'repeat'		=> 'repeat',
						'attachment'	=> 'scroll',
						'position'	  => 'left top',
						'size'		  => 'cover',
						'gradient'	  => array('from' => '#ffffff', 'to' => '#000000', 'direction' => 'horizontal' ),
						'parallax'	  => '0',
					)
			),
			array(
				'id' => 'mts_call_to_action',
				'type' => 'button_set_hide_below',
				'title' => __('Call to Action Section', 'ad-sense' ), 
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('This section will appear just below the navigation menu.', 'ad-sense' ),
				'std' => '1',
				'args' => array('hide' => 6)
				),
				array(
					'id' => 'mts_call_to_action_bg',
					'type' => 'background',
					'title' => __('Call to Action Section Background', 'ad-sense' ), 
					'sub_desc' => __('Set background color, pattern and image from here.', 'ad-sense' ),
					'options' => array(
						'color'		 => '',	
						'image_pattern' => $mts_patterns,
						'image_upload'  => '',	
						'repeat'		=> array(),
						'attachment'	=> array(),
						'position'	  => array(),
						'size'		  => array(),
						'gradient'	  => '',	
						'parallax'	  => array(),
					),
					'std' => array(
						'color'		 => '#efefef',
						'use'		 	=> 'pattern',
						'image_pattern' => 'nobg',
						'image_upload'  => '',
						'repeat'		=> 'repeat',
						'attachment'	=> 'scroll',
						'position'	  => 'left top',
						'size'		  => 'cover',
						'gradient'	  => array('from' => '#ffffff', 'to' => '#000000', 'direction' => 'horizontal' ),
						'parallax'	  => '0',
					)
				),
				array(
					'id' => 'mts_call_to_action_heading',
					'type' => 'text',
					'title' => __('Call to Action Heading', 'ad-sense' ),
					'sub_desc'=> __('Add heading text for Call to Action section from here.', 'ad-sense' ),
					'std'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
				),
				array(
					'id' => 'mts_call_to_action_heading_color',
					'type' => 'color',
					'title' => __('Call to Action Heading Color', 'ad-sense' ),
					'sub_desc' => __('Set color for text of Call to Action section.', 'ad-sense' ),
					'std' => '#757575'
				),
				array(
					'id' => 'mts_call_to_action_button',
					'type' => 'text',
					'title' => __('Call to Action Button', 'ad-sense' ),
					'std' => 'Join Us Now For Free',
				),
				array(
					'id' => 'mts_call_to_action_button_bg',
					'type' => 'color',
					'title' => __('Call to Action Button Background', 'ad-sense' ),
					'sub_desc' => __('Set Call to Action button background color from here.', 'ad-sense' ),
					'std' => '#2196f3'
				),
				array(
					'id' => 'mts_call_to_action_button_url',
					'type' => 'text',
					'title' => __('Call to Action Button Link', 'ad-sense' ),
					'std' => '#',
				),
		)
	);
	$sections[] = array(
		'icon' => 'fa fa-table',
		'title' => __('Footer', 'ad-sense' ),
		'desc' => '<p class="description">' . __('From here, you can control the elements of Footer section.', 'ad-sense' ) . '</p>',
		'fields' => array(
			array(
				'id' => 'mts_footer_section2',
				'type' => 'button_set_hide_below',
				'title' => __('Show Footer Logo', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => wp_kses( __('Use this button to Show or Hide the <strong>Footer Logo</strong> completely.', 'ad-sense' ), array( 'strong' => '' ) ),
				'std' => '1',
				'args' => array('hide' => '1')
				),
				array(
					'id' => 'mts_footer_logo',
					'type' => 'upload',
					'title' => __('Footer Logo Image', 'ad-sense' ),
					'sub_desc' => __('Upload your logo at footer using the Upload Button or insert image URL.', 'ad-sense' )
				),
			array(
				'id' => 'mts_footer_social_icon_head',
				'type' => 'button_set_hide_below',
				'title' => __('Footer Social Icons', 'ad-sense'),
				'sub_desc' => __('You can control social icon links from <strong>Blog Settings > Social Buttons</strong> Tab.', 'ad-sense'),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'std' => '1',
				'args' => array('hide' => '1')
				),
				array(
				 	'id' => 'mts_footer_social',
				 	'title' => __('Footer Social Icons', 'ad-sense'), 
				 	'sub_desc' => __( 'Add Social Media icons in footer.', 'ad-sense' ),
				 	'type' => 'group',
				 	'groupname' => __('Footer Icons', 'ad-sense'), // Group name
				 	'subfields' => 
						array(
							array(
								'id' => 'mts_footer_icon_title',
								'type' => 'text',
								'title' => __('Title', 'ad-sense'), 
								),
							array(
								'id' => 'mts_footer_icon',
								'type' => 'icon_select',
								'title' => __('Icon', 'ad-sense')
								),
							array(
								'id' => 'mts_footer_icon_color',
								'type' => 'color',
								'title' => __('Icon Color', 'ad-sense' )
								),
							array(
								'id' => 'mts_footer_icon_link',
								'type' => 'text',
								'title' => __('URL', 'ad-sense'), 
								),
							),
					'std' => array(
						'facebook' => array(
							'group_title' => 'Facebook',
							'group_sort' => '1',
							'mts_footer_icon_title' => 'Facebook',
							'mts_footer_icon' => 'facebook',
							'mts_footer_icon_color' => '#5d82d1',
							'mts_footer_icon_link' => '#',
						),
						'twitter' => array(
							'group_title' => 'Twitter',
							'group_sort' => '2',
							'mts_footer_icon_title' => 'Twitter',
							'mts_footer_icon' => 'twitter',
							'mts_footer_icon_color' => '#40bff5',
							'mts_footer_icon_link' => '#',
						),
						'gplus' => array(
							'group_title' => 'Google Plus',
							'group_sort' => '3',
							'mts_footer_icon_title' => 'Google Plus',
							'mts_footer_icon' => 'google-plus',
							'mts_footer_icon_color' => '#eb5e4c',
							'mts_footer_icon_link' => '#',
						)
					)
				),
			array(
				'id' => 'mts_footer_logo_background',
				'type' => 'background',
				'title' => __('Footer Logo Section Background', 'ad-sense' ),
				'sub_desc' => __('Set background color, pattern and image from here.', 'ad-sense' ),
				'options' => array(
					'color'		 => '',	
					'image_pattern' => $mts_patterns,
					'image_upload'  => '',	
					'repeat'		=> array(),
					'attachment'	=> array(),
					'position'	  => array(),
					'size'		  => array(),
					'gradient'	  => '',	
					'parallax'	  => array(),
				),
				'std' => array(
					'color'		 => '#454545',
					'use'		 	=> 'pattern',
					'image_pattern' => 'nobg',
					'image_upload'  => '',
					'repeat'		=> 'repeat',
					'attachment'	=> 'scroll',
					'position'	  => 'left top',
					'size'		  => 'cover',
					'gradient'	  => array('from' => '#ffffff', 'to' => '#000000', 'direction' => 'horizontal' ),
					'parallax'	  => '0',
				)
			),
			array(
				'id' => 'mts_first_footer',
				'type' => 'button_set_hide_below',
				'title' => __('Footer Widgets', 'ad-sense' ),
				'sub_desc' => __('Enable or disable first footer with this option.', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'std' => '0',
				'args' => array('hide' => '2')
				),
				array(
					'id' => 'mts_first_footer_num',
					'type' => 'button_set',
					'class' => 'green',
					'title' => __('Footer Widget Layout', 'ad-sense' ),
					'sub_desc' => wp_kses( __('Choose the number of widget areas in the <strong>first footer</strong>', 'ad-sense' ), array( 'strong' => '' ) ),
					'options' => array(
						'3' => __( '3 Widgets', 'ad-sense' ),
						'4' => __( '4 Widgets', 'ad-sense' ),
					),
					'std' => '3'
				),
			  	array(
					'id' => 'mts_footer_widget_background',
					'type' => 'background',
					'title' => __('Footer Widgets Background', 'ad-sense' ),
					'sub_desc' => __('Set background color, pattern and image from here.', 'ad-sense' ),
					'options' => array(
						'color'		 => '',	
						'image_pattern' => $mts_patterns,
						'image_upload'  => '',	
						'repeat'		=> array(),
						'attachment'	=> array(),
						'position'	  => array(),
						'size'		  => array(),
						'gradient'	  => '',	
						'parallax'	  => array(),
					),
					'std' => array(
						'color'		 => '#353535',
						'use'		 	=> 'pattern',
						'image_pattern' => 'nobg',
						'image_upload'  => '',
						'repeat'		=> 'repeat',
						'attachment'	=> 'scroll',
						'position'	  => 'left top',
						'size'		  => 'cover',
						'gradient'	  => array('from' => '#ffffff', 'to' => '#000000', 'direction' => 'horizontal' ),
						'parallax'	  => '0',
					)
				),
			array(
				'id' => 'mts_copyrights',
				'type' => 'textarea',
				'title' => __('Copyrights Text', 'ad-sense' ),
				'sub_desc' => __( 'You can change or remove our link from footer and use your own custom text.', 'ad-sense' ) . ( MTS_THEME_WHITE_LABEL ? '' : wp_kses( __('(You can also use your affiliate link to <strong>earn 70% of sales</strong>. Ex: <a href="https://mythemeshop.com/go/aff/aff" target="_blank">https://mythemeshop.com/?ref=username</a>)', 'ad-sense' ), array( 'strong' => '', 'a' => array( 'href' => array(), 'target' => array() ) ) ) ),
				'std' => MTS_THEME_WHITE_LABEL ? null : sprintf( __( 'Theme by %s', 'ad-sense' ), '<a href="http://mythemeshop.com/" rel="nofollow">MyThemeShop.com</a>' )
			),
			array(
				'id' => 'mts_copyrights_background',
				'type' => 'background',
				'title' => __('Footer Copyrights Background', 'ad-sense' ),
				'sub_desc' => __('Set background color, pattern and image from here.', 'ad-sense' ),
				'options' => array(
					'color'		 => '',	
					'image_pattern' => $mts_patterns,
					'image_upload'  => '',	
					'repeat'		=> array(),
					'attachment'	=> array(),
					'position'	  => array(),
					'size'		  => array(),
					'gradient'	  => '',	
					'parallax'	  => array(),
				),
				'std' => array(
					'color'		 => '#252526',
					'use'		 	=> 'pattern',
					'image_pattern' => 'nobg',
					'image_upload'  => '',
					'repeat'		=> 'repeat',
					'attachment'	=> 'scroll',
					'position'	  => 'left top',
					'size'		  => 'cover',
					'gradient'	  => array('from' => '#ffffff', 'to' => '#000000', 'direction' => 'horizontal' ),
					'parallax'	  => '0',
				)
			),
		)
	);
	$sections[] = array(
		'icon' => 'fa fa-home',
		'title' => __('Homepage', 'ad-sense' ),
		'desc' => '<p class="description">' . __('From here, you can control the elements of the homepage.', 'ad-sense' ) . '</p>',
		'fields' => array(
			array(
				'id' => 'mts_home_layout',
				'type' => 'radio_img',
				'title' => __('Select Layout for Homepage', 'ad-sense' ),
				'sub_desc' => wp_kses( __('Choose the layout for homepage posts.', 'ad-sense' ), array( 'strong' => '' ) ),
				'options' => $mts_home_layout,
				'std' => 'featured-width'
			),
			array(
				'id' => 'mts_featured_slider',
				'type' => 'button_set_hide_below',
				'title' => __('Homepage Slider', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => wp_kses( __('<strong>Enable or Disable</strong> homepage slider with this button. The slider will show recent articles from the selected categories.', 'ad-sense' ), array( 'strong' => '' ) ),
				'std' => '0',
				'args' => array('hide' => 3),
				'reset_at_version' => '1.1'
				),
				array(
					'id' => 'mts_featured_slider_cat',
					'type' => 'cats_multi_select',
					'title' => __('Slider Category(s)', 'ad-sense' ),
					'sub_desc' => wp_kses( __('Select a category from the drop-down menu, latest articles from this category will be shown <strong>in the slider</strong>.', 'ad-sense' ), array( 'strong' => '' ) ),
					'reset_at_version' => '1.1'
				),
				array(
					'id' => 'mts_featured_slider_num',
					'type' => 'text',
					'class' => 'small-text',
					'title' => __('Number of posts', 'ad-sense' ),
					'sub_desc' => __('Enter the number of posts to show in the slider', 'ad-sense' ),
					'std' => '3',
					'args' => array('type' => 'number'),
					'reset_at_version' => '1.1'
				),	
				array(
					'id' => 'mts_custom_slider',
					'type' => 'group',
					'title' => __('Custom Slider', 'ad-sense' ),
					'sub_desc' => __('With this option you can set up a slider with custom image and text instead of the default slider automatically generated from your posts.', 'ad-sense' ),
					'groupname' => __('Slider', 'ad-sense' ), // Group name
					'subfields' => 
					array(
						array(
							'id' => 'mts_custom_slider_title',
							'type' => 'text',
							'title' => __('Title', 'ad-sense' ),
							'sub_desc' => __('Title of the slide', 'ad-sense' ),
						),
						array(
							'id' => 'mts_custom_slider_image',
							'type' => 'upload',
							'title' => __('Image', 'ad-sense' ),
							'sub_desc' => __('Upload or select an image for this slide', 'ad-sense' ),
							'return' => 'id'
						),
						array('id' => 'mts_custom_slider_link',
							'type' => 'text',
							'title' => __('Link', 'ad-sense' ),
							'sub_desc' => __('Insert a link URL for the slide', 'ad-sense' ),
							'std' => '#'
						),
					),
					'reset_at_version' => '1.1'
			),
			array(
				'id'		=> 'mts_featured_categories',
				'type'	  => 'group',
				'title'	 => __('Featured Categories', 'ad-sense' ),
				'sub_desc'  => __('Select categories appearing on the homepage.', 'ad-sense' ),
				'groupname' => __('Section', 'ad-sense' ), // Group name
				'subfields' => 
					array(
						array(
							'id' => 'mts_featured_category',
							'type' => 'cats_select',
							'title' => __('Category', 'ad-sense' ),
							'sub_desc' => __('Select a category or the latest posts for this section', 'ad-sense' ),
							'std' => 'latest',
							'args' => array('include_latest' => 1, 'hide_empty' => 0),
							),
						array(
							'id' => 'mts_featured_category_postsnum',
							'type' => 'text',
							'class' => 'small-text',
							'title' => __('Number of posts', 'ad-sense' ),
							'sub_desc' => __('Enter the number of posts to show in this section.', 'ad-sense' ),
							'std' => '9',
							'args' => array('type' => 'number')
							),
					),
					'std' => array(
						'1' => array(
							'group_title' => '',
							'group_sort' => '1',
							'mts_featured_category' => 'latest',
							'mts_featured_category_postsnum' => 9,
						)
					)
				),
			 array(
				'id' => 'mts_post_format_icons',
				'type' => 'button_set',
				'title' => __('Post Format Icons', 'ad-sense' ), 
				'sub_desc' => __('Show Post Format Icons on the Post', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'std' => '1'
			),
			array(
				'id' => 'mts_hover_effect',
				'type' => 'button_set',
				'title' => __('Hover Effect', 'ad-sense' ), 
				'sub_desc' => __('Show excerpts when hovered on the homepage posts. This option will not apply 3rd, 6th & 7th Homepage Layout.', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'std' => '1'
			),
			array(
				'id' => 'mts_show_post_info_small',
				'type' => 'button_set_hide_below',
				'title' => __('Show Meta Info in homepage posts', 'ad-sense' ), 
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('You can add custom text for your site here', 'ad-sense' ),
				'std' => '0',
				'args' => array('hide' => 1)
			),
			array(
				'id'	 => 'mts_home_headline_meta_info',
				'type'	 => 'layout',
				'title'	=> __('HomePage Post Meta Info', 'ad-sense' ),
				'sub_desc' => __('Organize how you want the post meta info to appear on the homepage', 'ad-sense' ),
				'options'  => array(
					'enabled'  => array(
						'author'   => __('Author Name', 'ad-sense' ),
						'date'	 => __('Date', 'ad-sense' )
					),
					'disabled' => array(
						'category' => __('Categories', 'ad-sense' ),
						'comment'  => __('Comment Count', 'ad-sense' )
					)
				),
				'std'  => array(
					'enabled'  => array(
						'author'   => __('Author Name', 'ad-sense' ),
						'date'	 => __('Date', 'ad-sense' )
					),
					'disabled' => array(
						'category' => __('Categories', 'ad-sense' ),
						'comment'  => __('Comment Count', 'ad-sense' )
					)
				)
			),
			array(
				'id' => 'mts_show_comment_full',
				'type' => 'button_set',
				'title' => __('Post Comment Number', 'ad-sense' ), 
				'sub_desc' => __('Hide comment number from homepage. Applies only for 3rd, 5th & 6th Homepage Layout.', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'std' => '1'
			),
		)
	);	
	$sections[] = array(
		'icon' => 'fa fa-file-text',
		'title' => __('Single Posts', 'ad-sense' ),
		'desc' => '<p class="description">' . __('From here, you can control the appearance and functionality of your single posts page.', 'ad-sense' ) . '</p>',
		'fields' => array(
			array(
				'id'	   => 'mts_single_post_layout',
				'type'	 => 'layout2',
				'title'	=> __('Single Post Layout', 'ad-sense' ),
				'sub_desc' => __('Customize the look of single posts', 'ad-sense' ),
				'options'  => array(
					'enabled'  => array(
						'content'   => array(
							'label' 	=> __('Post Content', 'ad-sense' ),
							'subfields'	=> array()
						),
						'related'   => array(
							'label' 	=> __('Related Posts', 'ad-sense' ),
							'subfields'	=> array(
								array(
									'id' => 'mts_related_posts_taxonomy',
									'type' => 'button_set',
									'title' => __('Related Posts Taxonomy', 'ad-sense' ) ,
									'options' => array(
										'tags' => __( 'Tags', 'ad-sense' ),
										'categories' => __( 'Categories', 'ad-sense' )
									) ,
									'class' => 'green',
									'sub_desc' => __('Related Posts based on tags or categories.', 'ad-sense' ) ,
									'std' => 'categories'
								),
								array(
									'id' => 'mts_related_postsnum',
									'type' => 'text',
									'class' => 'small-text',
									'title' => __('Number of related posts', 'ad-sense' ) ,
									'sub_desc' => __('Enter the number of posts to show in the related posts section.', 'ad-sense' ) ,
									'std' => '2',
									'args' => array(
										'type' => 'number'
									)
								),

							)
						),
						'author'   => array(
							'label' 	=> __('Author Box', 'ad-sense' ),
							'subfields'	=> array()
						),
					),
					'disabled' => array(
						'tags'   => array(
							'label' 	=> __('Tags', 'ad-sense' ),
							'subfields'	=> array()
						),
					)
				)
			),
			array(
				'id' => 'mts_cat_button',
				'type' => 'button_set',
				'title' => __('Show Category on Single Page', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('Use this button to show categories of post.', 'ad-sense' ),
				'std' => '1'
			),
			array(
				'id'	   => 'mts_single_headline_meta_info',
				'type'	 => 'layout',
				'title'	=> __('Meta Info to Show', 'ad-sense' ),
				'sub_desc' => __('Organize how you want the post meta info to appear', 'ad-sense' ),
				'options'  => array(
					'enabled'  => array(
						'author'   => __('Author Name', 'ad-sense' ),
						'date'	 => __('Date', 'ad-sense' )
					),
					'disabled' => array(
						'comment'  => __('Comment Count', 'ad-sense' )
					)
				),
				'std'  => array(
					'enabled'  => array(
						'author'   => __('Author Name', 'ad-sense' ),
						'date'	 => __('Date', 'ad-sense' )
					),
					'disabled' => array(
						'comment'  => __('Comment Count', 'ad-sense' )
					)
				)
			),
			array(
				'id' => 'mts_breadcrumb',
				'type' => 'button_set',
				'title' => __('Breadcrumbs', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('Breadcrumbs are a great way to make your site more user-friendly. You can enable them by checking this box.', 'ad-sense' ),
				'std' => '1'
			),
			array(
				'id' => 'mts_author_comment',
				'type' => 'button_set',
				'title' => __('Highlight Author Comment', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('Use this button to highlight author comments.', 'ad-sense' ),
				'std' => '1'
			),
			array(
				'id' => 'mts_comment_date',
				'type' => 'button_set',
				'title' => __('Date in Comments', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('Use this button to show the date for comments.', 'ad-sense' ),
				'std' => '1'
			),
		)
	);
	$sections[] = array(
		'icon' => 'fa fa-group',
		'title' => __('Social Buttons', 'ad-sense' ),
		'desc' => '<p class="description">' . __('Enable or disable social sharing buttons on single posts using these buttons.', 'ad-sense' ) . '</p>',
		'fields' => array(
			array(
				'id' => 'mts_social_button_position',
				'type' => 'button_set',
				'title' => __('Social Sharing Buttons Position', 'ad-sense' ),
				'options' => array('top' => __('Above Content', 'ad-sense' ), 'bottom' => __('Below Content', 'ad-sense' ), 'floating' => __('Floating', 'ad-sense' )),
				'sub_desc' => __('Choose position for Social Sharing Buttons.', 'ad-sense' ),
				'std' => 'floating',
				'class' => 'green'
			),
			array(
				'id' => 'mts_social_buttons_on_pages',
				'type' => 'button_set',
				'title' => __('Social Sharing Buttons on Pages', 'ad-sense' ),
				'options' => array('0' => __('Off', 'ad-sense' ), '1' => __('On', 'ad-sense' )),
				'sub_desc' => __('Enable the sharing buttons for pages too, not just posts.', 'ad-sense' ),
				'std' => '0',
			),
			array(
				'id'	   => 'mts_social_buttons',
				'type'	 => 'layout',
				'title'	=> __('Social Media Buttons', 'ad-sense' ),
				'sub_desc' => __('Organize how you want the social sharing buttons to appear on single posts', 'ad-sense' ),
				'options'  => array(
					'enabled'  => array(
						'facebookshare'   => __('Facebook Share', 'ad-sense' ),
						'twitter'   => __('Twitter', 'ad-sense' ),
						'email'	 => __('Email', 'ad-sense') 
					),
					'disabled' => array(
						'gplus'	 => __('Google Plus', 'ad-sense' ),
						'pinterest' => __('Pinterest', 'ad-sense' ),
						'linkedin'  => __('LinkedIn', 'ad-sense' ),
						'stumble'   => __('StumbleUpon', 'ad-sense' ),
					)
				),
				'std'  => array(
					'enabled'  => array(
						'facebookshare'   => __('Facebook Share', 'ad-sense' ),
						'twitter'   => __('Twitter', 'ad-sense' ),
						'email'	 => __('Email', 'ad-sense')
					),
					'disabled' => array(
						'gplus'	 => __('Google Plus', 'ad-sense' ),
						'pinterest' => __('Pinterest', 'ad-sense' ),
						'linkedin'  => __('LinkedIn', 'ad-sense' ),
						'stumble'   => __('StumbleUpon', 'ad-sense' ),
					)
				)
			),
		)
	);
	$sections[] = array(
		'icon' => 'fa fa-bar-chart-o',
		'title' => __('Ad Management', 'ad-sense' ),
		'desc' => '<p class="description">' . __('Now, ad management is easy with our options panel. You can control everything from here, without using separate plugins.', 'ad-sense' ) . '</p>',
		'fields' => array(
			array(
				'id' => 'mts_detect_adblocker',
				'type' => 'button_set_hide_below',
				'title' => __('Detect Ad Blocker', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('If user is using any ad blocker extension then this option will hide the content and will ask user to white-list your website.', 'ad-sense' ),
				'std' => '1',
				'args' => array('hide' => 3)
			),
			array(
				'id' => 'mts_detect_adblocker_type',
				'type' => 'button_set',
				'title' => __('Ad Blocker Notice Type', 'ad-sense' ),
				'options' => array('hide-content' => __('Hide Content', 'ad-sense' ), 'popup' => __('Show Popup', 'ad-sense' ), 'floating' => __('Floating Notice', 'ad-sense' ), 'shortcode' => __('Shortcode', 'ad-sense' )),
				'sub_desc' => sprintf( __('Choose Ad Blocker Notice type from here. SHORTCODE: %s ', 'ad-sense' ), '<code>[detect_adblocker title="Your Title" description="Description"]Content[/detect_adblocker]</code>' ),
				'std' => 'popup',
				'class' => 'green'
			),
			array(
				'id' => 'mts_detect_adblocker_title',
				'type' => 'text',
				'title' => __('Ad Blocker Title', 'ad-sense' ),
				'sub_desc' => __('Enter Ad Blocker detector Title here.', 'ad-sense' ),
				'std' => __('Ad Blocker Detected', 'ad-sense' ),
			),
			array(
				'id' => 'mts_detect_adblocker_description',
				'type' => 'textarea',
				'title' => __('Ad Blocker Description', 'ad-sense' ),
				'sub_desc' => __('Enter Ad Blocker detector Description here.', 'ad-sense' ),
				'std' => __('Our website is made possible by displaying online advertisements to our visitors. Please consider supporting us by disabling your ad blocker.', 'ad-sense' ),
			),
			array(
				'id' => 'mts_background_clickable',
				'type' => 'button_set_hide_below',
				'title' => __('Site Background Clickable', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('This option will make your website background clickable.', 'ad-sense' ),
				'std' => '0',
				'args' => array('hide' => 2)
			),
			array(
				'id' => 'mts_background_link',
				'type' => 'text',
				'title' => __('Site Background URL', 'ad-sense' ),
				'sub_desc' => __('Enter URL Here', 'ad-sense' ),
				'validate' => 'url'
			),
			array(
				'id' => 'mts_background_link_new_tab',
				'type' => 'button_set',
				'title' => __('Site Background Click - Open in new Tab', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('Enter URL Here', 'ad-sense' ),
				'std' => '1'
			),
			array(
				'id' => 'mts_header_ad',
				'type' => 'button_set_hide_below',
				'title' => __('Header Ad', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('This option will let you add an Ad in the Header.', 'ad-sense' ),
				'std' => '0',
				'args' => array('hide' => 2)
			),
			array(
				'id' => 'mts_header_adcode',
				'type' => 'textarea',
				'title' => __('Header Ad Code', 'ad-sense' ),
				'sub_desc' => __('Paste your Adsense, BSA or other ad code here to show ads in the Header. NOTE: if header ad is present then it will hide Header Social Icons.', 'ad-sense' )
			),
			array(
				'id' => 'mts_header_ad_size',
				'type' => 'select',
				'title' => __('Header Ad Size [For Adsense Ads]', 'ad-sense' ),
				'sub_desc' => __('If you leave the AdSense size boxes on Auto, the theme will automatically resize the Google ads. Note: For smaller screens ads will be set on Auto mode irrespective of size defined here.', 'ad-sense' ),
				'options' => mts_ad_sizes(),
				'std' => '27'
			),
			array(
				'id' => 'mts_navigation_ad',
				'type' => 'button_set_hide_below',
				'title' => __('Navigation Ad', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('This option will let you add an Ad below Navigation menu.', 'ad-sense' ),
				'std' => '0',
				'args' => array('hide' => 3)
			),
			array(
				'id' => 'mts_navigation_adcode',
				'type' => 'textarea',
				'title' => __('Navigation Ad Code', 'ad-sense' ),
				'sub_desc' => __('Paste your Adsense, BSA or other ad code here to show ads in the Header.', 'ad-sense' )
			),
			array(
				'id' => 'mts_navigation_ad_size',
				'type' => 'select',
				'title' => __('Navigation Ad Size [For Adsense Ads]', 'ad-sense' ),
				'sub_desc' => __('If you leave the AdSense size boxes on Auto, the theme will automatically resize the Google ads. Note: For smaller screens ads will be set on Auto mode irrespective of size defined here.', 'ad-sense' ),
				'options' => mts_ad_sizes(),
				'std' => '26'
			),
			array(
				'id' => 'mts_navigation_ad_background',
				'type' => 'color',
				'title' => __('Navigation Ad Background', 'ad-sense' ),
				'sub_desc' => __('Set background color for navigation Ad from here.', 'ad-sense' ),
				'std' => '#252525'
			),
			array(
				'id' => 'mts_posttop',
				'type' => 'button_set_hide_below',
				'title' => __('Ad Below Post Title', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('This option will let you add an Ad below Article Post Title.', 'ad-sense' ),
				'std' => '0',
				'args' => array('hide' => 3)
			),
			array(
				'id' => 'mts_posttop_adcode',
				'type' => 'textarea',
				'title' => __('Below Post Title', 'ad-sense' ),
				'sub_desc' => __('Paste your Adsense, BSA or other ad code here to show ads below your article title on single posts.', 'ad-sense' )
			),
			array(
				'id' => 'mts_posttop_ad_position',
				'type' => 'button_set',
				'title' => __('Below Post Title Ad Position', 'ad-sense' ),
				'options' => array('left' => __('Left', 'ad-sense' ), 'center' => __('Center', 'ad-sense' ), 'right' => __('Right', 'ad-sense' )),
				'sub_desc' => __('Choose position for the Ad', 'ad-sense' ),
				'std' => 'left',
				'class' => 'green'
			),
			array(
				'id' => 'mts_posttop_adcode_time',
				'type' => 'text',
				'title' => __('Show After X Days', 'ad-sense' ),
				'sub_desc' => __('Enter the number of days after which you want to show the Below Post Title Ad. Enter 0 to disable this feature.', 'ad-sense' ),
				'validate' => 'numeric',
				'std' => '0',
				'class' => 'small-text',
				'args' => array('type' => 'number')
			),
			array(
				'id' => 'mts_postend',
				'type' => 'button_set_hide_below',
				'title' => __('Ad Below Post Content', 'ad-sense' ),
				'options' => array( '0' => __( 'Off', 'ad-sense' ), '1' => __( 'On', 'ad-sense' ) ),
				'sub_desc' => __('This option will let you add an Ad below Article Post Content.', 'ad-sense' ),
				'std' => '0',
				'args' => array('hide' => 3)
			),
			array(
				'id' => 'mts_postend_adcode',
				'type' => 'textarea',
				'title' => __('Below Post Content', 'ad-sense' ),
				'sub_desc' => __('Paste your Adsense, BSA or other ad code here to show ads below the post content on single posts.', 'ad-sense' )
			),
			array(
				'id' => 'mts_postend_ad_position',
				'type' => 'button_set',
				'title' => __('Below Post Content Ad Position', 'ad-sense' ),
				'options' => array('left' => __('Left', 'ad-sense' ), 'center' => __('Center', 'ad-sense' ), 'right' => __('Right', 'ad-sense' )),
				'sub_desc' => __('Choose position for the Ad', 'ad-sense' ),
				'std' => 'left',
				'class' => 'green'
			),
			array(
				'id' => 'mts_postend_adcode_time',
				'type' => 'text',
				'title' => __('Show After X Days', 'ad-sense' ),
				'sub_desc' => __('Enter the number of days after which you want to show the Below Post Title Ad. Enter 0 to disable this feature.', 'ad-sense' ),
				'validate' => 'numeric',
				'std' => '0',
				'class' => 'small-text',
				'args' => array('type' => 'number')
			),
		)
	);
	$sections[] = array(
		'icon' => 'fa fa-columns',
		'title' => __('Sidebars', 'ad-sense' ),
		'desc' => '<p class="description">' . __('Now you have full control over the sidebars. Here you can manage sidebars and select one for each section of your site, or select a custom sidebar on a per-post basis in the post editor.', 'ad-sense' ) . '<br></p>',
		'fields' => array(
			array(
				'id'		=> 'mts_custom_sidebars',
				'type'	  => 'group', //doesn't need to be called for callback fields
				'title'	 => __('Custom Sidebars', 'ad-sense' ),
				'sub_desc'  => wp_kses( __('Add custom sidebars. <strong>You need to save the changes to use the sidebars in the drop-downs below.</strong><br />You can add content to the sidebars in Appearance &gt; Widgets.', 'ad-sense' ), array( 'strong' => '', 'br' => '' ) ),
				'groupname' => __('Sidebar', 'ad-sense' ), // Group name
				'subfields' => 
					array(
						array(
							'id' => 'mts_custom_sidebar_name',
							'type' => 'text',
							'title' => __('Name', 'ad-sense' ),
							'sub_desc' => __('Example: Homepage Sidebar', 'ad-sense' )
						),	
						array(
							'id' => 'mts_custom_sidebar_id',
							'type' => 'text',
							'title' => __('ID', 'ad-sense' ),
							'sub_desc' => __('Enter a unique ID for the sidebar. Use only alphanumeric characters, underscores (_) and dashes (-), eg. "sidebar-home"', 'ad-sense' ),
							'std' => 'sidebar-'
						),
					),
			),
			array(
				'id' => 'mts_sidebar_for_home',
				'type' => 'sidebars_select',
				'title' => __('Homepage', 'ad-sense' ),
				'sub_desc' => __('Select a sidebar for the homepage. NOTE: Applies only to homepage layouts which have Sidebar.', 'ad-sense' ),
				'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','shop-sidebar', 'product-sidebar')),
				'std' => ''
			),
			array(
				'id' => 'mts_sidebar_for_post',
				'type' => 'sidebars_select',
				'title' => __('Single Post', 'ad-sense' ),
				'sub_desc' => __('Select a sidebar for the single posts. If a post has a custom sidebar set, it will override this.', 'ad-sense' ),
				'args' => array('exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','shop-sidebar', 'product-sidebar')),
				'std' => ''
			),
			array(
				'id' => 'mts_sidebar_for_page',
				'type' => 'sidebars_select',
				'title' => __('Single Page', 'ad-sense' ),
				'sub_desc' => __('Select a sidebar for the single pages. If a page has a custom sidebar set, it will override this.', 'ad-sense' ),
				'args' => array('exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','shop-sidebar', 'product-sidebar')),
				'std' => ''
			),
			array(
				'id' => 'mts_sidebar_for_archive',
				'type' => 'sidebars_select',
				'title' => __('Archive', 'ad-sense' ),
				'sub_desc' => __('Select a sidebar for the archives. Specific archive sidebars will override this setting (see below).', 'ad-sense' ),
				'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','shop-sidebar', 'product-sidebar')),
				'std' => ''
			),
			array(
				'id' => 'mts_sidebar_for_category',
				'type' => 'sidebars_select',
				'title' => __('Category Archive', 'ad-sense' ),
				'sub_desc' => __('Select a sidebar for the category archives.', 'ad-sense' ),
				'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','shop-sidebar', 'product-sidebar')),
				'std' => ''
			),
			array(
				'id' => 'mts_sidebar_for_tag',
				'type' => 'sidebars_select',
				'title' => __('Tag Archive', 'ad-sense' ),
				'sub_desc' => __('Select a sidebar for the tag archives.', 'ad-sense' ),
				'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','shop-sidebar', 'product-sidebar')),
				'std' => ''
			),
			array(
				'id' => 'mts_sidebar_for_date',
				'type' => 'sidebars_select',
				'title' => __('Date Archive', 'ad-sense' ),
				'sub_desc' => __('Select a sidebar for the date archives.', 'ad-sense' ),
				'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','shop-sidebar', 'product-sidebar')),
				'std' => ''
			),
			array(
				'id' => 'mts_sidebar_for_author',
				'type' => 'sidebars_select',
				'title' => __('Author Archive', 'ad-sense' ),
				'sub_desc' => __('Select a sidebar for the author archives.', 'ad-sense' ),
				'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','shop-sidebar', 'product-sidebar')),
				'std' => ''
			),
			array(
				'id' => 'mts_sidebar_for_search',
				'type' => 'sidebars_select',
				'title' => __('Search', 'ad-sense' ),
				'sub_desc' => __('Select a sidebar for the search results.', 'ad-sense' ),
				'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','shop-sidebar', 'product-sidebar')),
				'std' => ''
			),
			array(
				'id' => 'mts_sidebar_for_notfound',
				'type' => 'sidebars_select',
				'title' => __('404 Error', 'ad-sense' ),
				'sub_desc' => __('Select a sidebar for the 404 Not found pages.', 'ad-sense' ),
				'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','shop-sidebar', 'product-sidebar')),
				'std' => ''
			),
			array(
				'id' => 'mts_sidebar_for_shop',
				'type' => 'sidebars_select',
				'title' => __('Shop Pages', 'ad-sense' ),
				'sub_desc' => wp_kses( __('Select a sidebar for Shop main page and product archive pages (WooCommerce plugin must be enabled). Default is <strong>Shop Page Sidebar</strong>.', 'ad-sense' ), array( 'strong' => '' ) ),
				'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','shop-sidebar', 'product-sidebar')),
				'std' => 'shop-sidebar'
			),
			array(
				'id' => 'mts_sidebar_for_product',
				'type' => 'sidebars_select',
				'title' => __('Single Product', 'ad-sense' ),
				'sub_desc' => wp_kses( __('Select a sidebar for single products (WooCommerce plugin must be enabled). Default is <strong>Single Product Sidebar</strong>.', 'ad-sense' ), array( 'strong' => '' ) ),
				'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','shop-sidebar', 'product-sidebar')),
				'std' => 'product-sidebar'
			),
		),
	);

	$sections[] = array(
		'icon' => 'fa fa-list-alt',
		'title' => __('Navigation', 'ad-sense' ),
		'desc' => '<p class="description"><div class="controls">' . sprintf( __('Navigation settings can now be modified from the %s.', 'ad-sense' ), '<a href="nav-menus.php"><b>' . __( 'Menus Section', 'ad-sense' ) . '</b></a>' ) . '<br></div></p>'
	);

				
	$tabs = array();
	
	$args['presets'] = array();
	$args['show_translate'] = false;
	include('theme-presets.php');
	
	global $NHP_Options;
	$NHP_Options = new NHP_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';
	/*
	do your validation
	
	if(something){
		$value = $value;
	}elseif(something else){
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function

/*--------------------------------------------------------------------
 * 
 * Default Font Settings
 *
 --------------------------------------------------------------------*/
if(function_exists('mts_register_typography')) { 
	mts_register_typography(array(
		'logo_font' => array(
			'preview_text' => __( 'Logo Font', 'ad-sense' ),
			'preview_color' => 'dark',
			'font_family' => 'Roboto Slab',
			'font_variant' => '700',
			'font_size' => '28px',
			'font_color' => '#ffffff',
			'css_selectors' => '#header h1, #header h2, .footer-header #logo'
		),
		'navigation_font' => array(
			'preview_text' => __( 'Navigation Font', 'ad-sense' ),
			'preview_color' => 'light',
			'font_family' => 'Roboto',
			'font_variant' => '700',
			'font_size' => '13px',
			'font_color' => '#757575',
			'css_selectors' => '#primary-navigation a',
			'additional_css' => 'text-transform: uppercase;'
		),
		'home_title_font' => array(
			'preview_text' => __( 'Home Article Title', 'ad-sense' ),
			'preview_color' => 'light',
			'font_family' => 'Roboto Slab',
			'font_size' => '22px',
			'font_variant' => '700',
			'font_color' => '#000',
			'css_selectors' => '.latestPost .title a'
		),
		'single_title_font' => array(
			'preview_text' => __( 'Single Article Title', 'ad-sense' ),
			'preview_color' => 'light',
			'font_family' => 'Roboto',
			'font_size' => '30px',
			'font_variant' => '700',
			'font_color' => '#252525',
			'css_selectors' => '.single-title'
		),
		'content_font' => array(
			'preview_text' => __( 'Content Font', 'ad-sense' ),
			'preview_color' => 'light',
			'font_family' => 'Roboto',
			'font_size' => '14px',
			'font_variant' => 'normal',
			'font_color' => '#757575',
			'css_selectors' => 'body'
		),
		'sidebar_widget_title' => array(
			'preview_text' => __( 'Sidebar Widget Title', 'ad-sense' ),
			'preview_color' => 'light',
			'font_family' => 'Roboto Slab',
			'font_variant' => '700',
			'font_size' => '20px',
			'font_color' => '#252525',
			'css_selectors' => '.sidebar .widget h3'
		),
		'sidebar_widget' => array(
			'preview_text' => __( 'Sidebar Widget Font', 'ad-sense' ),
			'preview_color' => 'light',
			'font_family' => 'Roboto',
			'font_variant' => 'normal',
			'font_size' => '14px',
			'font_color' => '#555555',
			'css_selectors' => '.sidebar .widget'
		),
		'sidebar_links' => array(
			'preview_text' => __( 'Sidebar Widget Links', 'ad-sense' ),
			'preview_color' => 'light',
			'font_family' => 'Roboto Slab',
			'font_variant' => '700',
			'font_size' => '16px',
			'font_color' => '#555555',
			'css_selectors' => '.sidebar .widget li .post-title a, .sidebar .widget li .entry-title a'
		),
		'footer_widget_title' => array(
			'preview_text' => __( 'Footer Widget Title', 'ad-sense' ),
			'preview_color' => 'dark',
			'font_family' => 'Roboto Slab',
			'font_variant' => '700',
			'font_size' => '20px',
			'font_color' => '#ffffff',
			'css_selectors' => '#site-footer .widget h3'
		),
		'footer_widget' => array(
			'preview_text' => __( 'Footer Widget Font', 'ad-sense' ),
			'preview_color' => 'dark',
			'font_family' => 'Roboto',
			'font_variant' => '700',
			'font_size' => '14px',
			'font_color' => '#757575',
			'css_selectors' => '#site-footer'
		),
		'footer_links' => array(
			'preview_text' => __( 'Footer Widget Links', 'ad-sense' ),
			'preview_color' => 'dark',
			'font_family' => 'Roboto Slab',
			'font_variant' => '700',
			'font_size' => '14px',
			'font_color' => '#757575',
			'css_selectors' => '#site-footer .widget li .post-title a, #site-footer .widget li .entry-title a'
		),
		'h1_headline' => array(
			'preview_text' => __( 'Content H1', 'ad-sense' ),
			'preview_color' => 'light',
			'font_family' => 'Roboto Slab',
			'font_variant' => '700',
			'font_size' => '28px',
			'font_color' => '#252525',
			'css_selectors' => 'h1'
		),
		'h2_headline' => array(
			'preview_text' => __( 'Content H2', 'ad-sense' ),
			'preview_color' => 'light',
			'font_family' => 'Roboto Slab',
			'font_variant' => '700',
			'font_size' => '24px',
			'font_color' => '#252525',
			'css_selectors' => 'h2'
		),
		'h3_headline' => array(
			'preview_text' => __( 'Content H3', 'ad-sense' ),
			'preview_color' => 'light',
			'font_family' => 'Roboto Slab',
			'font_variant' => '700',
			'font_size' => '22px',
			'font_color' => '#252525',
			'css_selectors' => 'h3'
		),
		'h4_headline' => array(
			'preview_text' => __( 'Content H4', 'ad-sense' ),
			'preview_color' => 'light',
			'font_family' => 'Roboto Slab',
			'font_variant' => '700',
			'font_size' => '20px',
			'font_color' => '#252525',
			'css_selectors' => 'h4'
		),
		'h5_headline' => array(
			'preview_text' => __( 'Content H5', 'ad-sense' ),
			'preview_color' => 'light',
			'font_family' => 'Roboto Slab',
			'font_variant' => '700',
			'font_size' => '18px',
			'font_color' => '#252525',
			'css_selectors' => 'h5'
		),
		'h6_headline' => array(
			'preview_text' => __( 'Content H6', 'ad-sense' ),
			'preview_color' => 'light',
			'font_family' => 'Roboto Slab',
			'font_variant' => '700',
			'font_size' => '16px',
			'font_color' => '#252525',
			'css_selectors' => 'h6'
		)
	));
}
