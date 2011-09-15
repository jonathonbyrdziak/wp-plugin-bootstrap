/**
 * @Author	Jonathon byrd
 * @link http://www.5twentystudios.com
 * @Package Wordpress
 * @SubPackage Category Filter Widget
 * @copyright Proprietary Software, Copyright Byrd Incorporated. All Rights Reserved
 * @Since 1.0.0
 * 
 */

/**
 * Category Filter Widget
 * 
 * Javascript class to contain all of the elements needed for cfw.
 * 
 */
jQuery.noConflict();
var my_plugin;

(function($) {
	var api = my_plugin = {
			
		/**
		 * Method is fired upon document.ready
		 */
		init : function()
		{
			
		},
			
		/**
		 * Returns the proper url, whether it be the admin area or the front end.
		 */
		url : function()
		{
			if (typeof(userSettings.url) != 'undefined')
			{
				return userSettings.url;
			}
			else
			{
				return '/';
			}
		}
	
	};

	//firing the initialization class
	$(document).ready(function($){ my_plugin.init(); });

})(jQuery);
