<?php
/*
Plugin Name: Refugee Forum Toolkit
Description: Custom functionality for Refugee Forum theme
Version: 1.0
Author: Erika Deal
Author URI: http://erikadeal.com
License: GPLv2 or later
*/

if(!class_exists('kcrf_toolkit_plugin'))
{
    class kcrf_toolkit_plugin
    {
        public function __construct()
        {
            include_once(sprintf("%s/includes/advanced-custom-fields/acf.php", dirname(__FILE__)));

            include_once(sprintf("%s/includes/acf-repeater/acf-repeater.php", dirname(__FILE__)));

            include_once(sprintf("%s/includes/the-events-calendar/the-events-calendar.php", dirname(__FILE__)));

            require_once(sprintf("%s/custom-types/kcrf_meetings.php", dirname(__FILE__)));
            $kcrf_meetings = new kcrf_meetings();

            require_once(sprintf("%s/custom-types/custom_profiles.php", dirname(__FILE__)));
            $custom_profiles = new custom_profiles();
        } // END public function __construct

        public static function activate()
        {
            // Do nothing
        } // END public static function activate
    
        public static function deactivate()
        {
            // Do nothing
        } // END public static function deactivate
    } // END class kcrf_toolkit_plugin
} // END if(!class_exists('kcrf_toolkit_plugin'))

if(class_exists('kcrf_toolkit_plugin'))
{
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('kcrf_toolkit_plugin', 'activate'));
    register_deactivation_hook(__FILE__, array('kcrf_toolkit_plugin', 'deactivate'));

    // instantiate the plugin class
    $kcrf_toolkit_plugin = new kcrf_toolkit_plugin();
}

?>