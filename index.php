<?php 
/**
 * @Author	Jonathon byrd
 * @link http://www.5twentystudios.com
 * @Package Wordpress
 * @SubPackage Category Filter Widget
 * @copyright Proprietary Software, Copyright Byrd Incorporated. All Rights Reserved
 * @Since 1.0.0
 * 
 * 
 * Plugin Name: Category Filter Widget
 * Plugin URI: http://www.5twentystudios.com
 * Description: This widget creates a list of categories, allowing your users to create their own filter of posts to view. <a href="http://www.5twentystudios.com" target="_blank">Author Website</a>
 * Version: 1.0.0
 * Author: 5Twenty Studios
 * Author URI: http://www.5twentystudios.com
 * 
 * 
 */

defined('ABSPATH') or die("Cannot access pages directly.");

/**
 * Initializing 
 * 
 * The directory separator is different between linux and microsoft servers.
 * Thankfully php sets the DIRECTORY_SEPARATOR constant so that we know what
 * to use.
 */
defined("DS") or define("DS", DIRECTORY_SEPARATOR);

defined("CFW_VERSION") or define("CFW_VERSION", '1.0.0');

/**
 * Startup
 * 
 * This block of functions is only preloading a set of functions that I've prebuilt
 * and that I use throughout my websites.
 * 
 * @copyright Proprietary Software, Copyright Byrd Incorporated. All Rights Reserved
 * @since 1.0
 */
require_once ABSPATH.WPINC.DS."pluggable.php";
require_once dirname(__file__).DS."bootstrap.php";
require_once dirname(__file__).DS."helper.php";
require_once dirname(__file__).DS."template-codes.php";

/**
 * Initialize Localization
 * 
 * @tutorial http://codex.wordpress.org/I18n_for_WordPress_Developers
 * function call loads the localization files from the current folder
 */
if (function_exists('load_theme_textdomain')) load_theme_textdomain('cfw');

/**
 * User Control Level
 * 
 * Allows the developer to hook into this system and set the access level for this plugin.
 * If the user does not have the capability to view this plguin, they may still be
 * able to view the default widget area. This will not cause problems with the script,
 * however the editing user will not be able to add or delete viewable pages to the 
 * widget.
 * 
 * @TODO need to set this to call get_option from the db
 * @TODO need to add this as a security check to every file
 */
defined("FIVETS_CURRENT_USER_CANNOT") or define("FIVETS_CURRENT_USER_CANNOT", (!current_user_can("edit_theme_options")) );

/**
 * Initialize the Framework
 * 
 */
set_controller_path( dirname( __FILE__ ) );

//register assets
wp_register_script( 'fivets_default_js', plugin_dir_url(__file__).'js/default.js', array(), CFW_VERSION, true);
wp_register_style( 'fivets_default_css', plugin_dir_url(__file__).'css/default.css', array(), CFW_VERSION, 'all');

//load the scripts into the theme
wp_enqueue_style('fivets_default_css');
wp_enqueue_script('fivets_default_js');

//shortcodes
//add_shortcode('widget', 'cfw_shortcode_widget');

//actions for bootstrap
add_action('init', 'fivets_show_ajax', 100);
//add_action('admin_notices', 'fivets_read_520_rss', 1);

//actions for helper
add_action('activate_'.plugin_basename(dirname(__file__)).DS.'index.php', 'cfw_activate_plugin');
add_action('deactivate_'.plugin_basename(dirname(__file__)).DS.'index.php', 'cfw_deactivate_plugin');
add_action('wp_head', 'cfw_document_head');
add_action('wp_footer', 'cfw_document_footer');

register_multiwidget(array(
	'id' => 'category-filter-widget',	// Must be slug compatible, and unique, it's used a lot
	'title' => __('Category Filter Widget'),	
	'description' => __('Allows your users to select multiple categories and then view a list of all posts within those categories.'),	
	'classname' => 'st-custom-wi',	
	'show_view' => 'category-filter-widget',	//This is the unique filename within the views folder, the theme is checked first, then defaults to the plugin
	'fields' => array(
/*
	array(
		'name' => 'Text box',
		'desc' => 'Enter something here',
		'id' => 'text',
		'type' => 'text',
		'std' => 'Default value 1'
	),
	array(
		'type' => 'custom',
		'std' => '<hr/>'
	),
	array(
		'name' => 'Textarea',
		'desc' => 'Enter big text here',
		'id' => 'textarea',
		'type' => 'textarea',
		'std' => 'Default value 2'
		
	),
	array(
		'name' => 'Select box',
		'id' => 'select',
		'type' => 'select',
		'options' => array('Option 1', 'Option 2', 'Option 3')
	),
	array(
		'name' => 'Radio',
		'id' => 'radio',
		'type' => 'radio',
		'options' => array(
		array('name' => 'Name 1', 'value' => 'Value 1'),
		array('name' => 'Name 2', 'value' => 'Value 2')
		)
	),
	array(
		'name' => 'Checkbox',
		'id' => 'checkbox',
		'type' => 'checkbox'
	),
	*/
	)
));