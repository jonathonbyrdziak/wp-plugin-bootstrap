<?php 
/**
 * @Author	Jonathon byrd
 * @link http://www.5twentystudios.com
 * @Package Wordpress
 * @SubPackage Category Filter Widget
 * @copyright Proprietary Software, Copyright Byrd Incorporated. All Rights Reserved
 * @Since 1.0.0
 * 
 */

defined('ABSPATH') or die("Cannot access pages directly.");

/**
 * Function is called upon activation
 *
 * @return null
 */
function cfw_activate_plugin()
{
	
}

/**
 * Function is called upon de-activation
 *
 * @return null
 */
function cfw_deactivate_plugin()
{
	
}

/**
 * function is called in the header
 *
 */
function cfw_document_head()
{
	
}

/**
 * function is called in the footer
 *
 */
function cfw_document_footer()
{
	
}

/**
 * Constructor.
 * 
 * This function contains all of the pre-registration and hooks required
 * to get this plugin moving in the right direction.
 *
 * @return null
 */
function cfw_initialize()
{
	//register assets
	wp_register_script( 'cfw_js', plugin_dir_url(__file__).'js/cfw.js', array(), CFW_VERSION, true);
	wp_register_style( 'cfw_css', plugin_dir_url(__file__).'css/cfw.css', array(), CFW_VERSION, 'all');
	
	//load the scripts into the theme
	wp_enqueue_style('cfw_css');
	wp_enqueue_script('cfw_js');
	
	//shortcodes
	add_shortcode('widget', 'cfw_shortcode_widget');
	
	//actions
	add_action('activate_'.plugin_basename(dirname(__file__)).DS.'index.php', 'cfw_activate_plugin');
	add_action('deactivate_'.plugin_basename(dirname(__file__)).DS.'index.php', 'cfw_deactivate_plugin');
	add_action('init', 'cfw_show_ajax', 100);
	add_action('admin_notices', 'cfw_read_520_rss', 1);
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
		
}


