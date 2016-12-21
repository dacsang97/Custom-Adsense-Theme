<?php
// make sure to not include translations
$args['presets']['default'] = array(
	'title' => 'Default',
	'demo' => 'http://demo.mythemeshop.com/ad-sense/',
	'thumbnail' => get_template_directory_uri().'/options/demo-importer/demo-files/default/thumb.jpg',
	'menus' => array( 'primary-menu' => 'Primary Menu', 'mobile' => ''), // menu location slug => Demo menu name
	'options' => array( 'show_on_front' => 'posts', 'posts_per_page' => 9 ),
);

$args['presets']['fashion'] = array(
	'title' => 'Fashion',
	'demo' => 'http://demo.mythemeshop.com/ad-sense-fashion/',
	'thumbnail' => get_template_directory_uri().'/options/demo-importer/demo-files/fashion/thumb.jpg',
	'menus' => array( 'primary-menu' => 'Primary Menu', 'mobile' => ''), // menu location slug => Demo menu name
	'options' => array( 'show_on_front' => 'posts', 'posts_per_page' => 5 ),
);

$args['presets']['recipes'] = array(
	'title' => 'Recipes',
	'demo' => 'http://demo.mythemeshop.com/ad-sense-recipes/',
	'thumbnail' => get_template_directory_uri().'/options/demo-importer/demo-files/recipes/thumb.jpg',
	'menus' => array( 'primary-menu' => 'Primary Menu', 'mobile' => ''), // menu location slug => Demo menu name
	'options' => array( 'show_on_front' => 'posts', 'posts_per_page' => 9 ),
);

$args['presets']['technology'] = array(
	'title' => 'Technology',
	'demo' => 'http://demo.mythemeshop.com/ad-sense-technology/',
	'thumbnail' => get_template_directory_uri().'/options/demo-importer/demo-files/technology/thumb.jpg',
	'menus' => array( 'primary-menu' => 'Primary Menu', 'mobile' => ''), // menu location slug => Demo menu name
	'options' => array( 'show_on_front' => 'posts', 'posts_per_page' => 6 ),
);

$args['presets']['viral'] = array(
	'title' => 'Viral',
	'demo' => 'http://demo.mythemeshop.com/ad-sense-viral/',
	'thumbnail' => get_template_directory_uri().'/options/demo-importer/demo-files/viral/thumb.jpg',
	'menus' => array( 'primary-menu' => 'Primary Menu', 'mobile' => ''), // menu location slug => Demo menu name
	'options' => array( 'show_on_front' => 'posts', 'posts_per_page' => 10 ),
);

$args['presets']['sports'] = array(
	'title' => 'Sports',
	'demo' => 'http://demo.mythemeshop.com/ad-sense-sports/',
	'thumbnail' => get_template_directory_uri().'/options/demo-importer/demo-files/sports/thumb.jpg',
	'menus' => array( 'primary-menu' => 'Primary Menu', 'mobile' => ''), // menu location slug => Demo menu name
	'options' => array( 'show_on_front' => 'posts', 'posts_per_page' => 10 ),
);

$args['presets']['babyblog'] = array(
	'title' => 'Baby Blog',
	'demo' => 'http://demo.mythemeshop.com/ad-sense-babyblog/',
	'thumbnail' => get_template_directory_uri().'/options/demo-importer/demo-files/babyblog/thumb.jpg',
	'menus' => array( 'primary-menu' => 'Primary Menu', 'mobile' => ''), // menu location slug => Demo menu name
	'options' => array( 'show_on_front' => 'posts', 'posts_per_page' => 10 ),
);

$args['presets']['fitness'] = array(
	'title' => 'Fitness',
	'demo' => 'http://demo.mythemeshop.com/ad-sense-fitness/',
	'thumbnail' => get_template_directory_uri().'/options/demo-importer/demo-files/fitness/thumb.jpg',
	'menus' => array( 'primary-menu' => 'Primary Menu', 'mobile' => ''), // menu location slug => Demo menu name
	'options' => array( 'show_on_front' => 'posts', 'posts_per_page' => 9 ),
);

$args['presets']['news'] = array(
	'title' => 'News',
	'demo' => 'http://demo.mythemeshop.com/ad-sense-news/',
	'thumbnail' => get_template_directory_uri().'/options/demo-importer/demo-files/news/thumb.jpg',
	'menus' => array( 'primary-menu' => 'Primary Menu', 'mobile' => ''), // menu location slug => Demo menu name
	'options' => array( 'show_on_front' => 'posts', 'posts_per_page' => 10 ),
);

global $mts_presets;
$mts_presets = $args['presets'];
