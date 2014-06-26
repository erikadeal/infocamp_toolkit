<?php
/*
Plugin Name: InfoCamp Toolkit
Description: Custom functionality for InfoCamp theme
Version: 1.0
Author: Erika Deal
Author URI: http://erikadeal.com
License: GPLv2 or later
*/

if(!class_exists('infocamp_toolkit_plugin'))
{
    class infocamp_toolkit_plugin
    {
        public function __construct()
        {
            include_once(sprintf("%s/includes/advanced-custom-fields/acf.php", dirname(__FILE__)));

            include_once(sprintf("%s/includes/acf-repeater/acf-repeater.php", dirname(__FILE__)));

            require_once(sprintf("%s/custom-types/infocamp_sponsors.php", dirname(__FILE__)));
            $infocamp_sponsors = new infocamp_sponsors();

            require_once(sprintf("%s/custom-types/infocamp_sessions.php", dirname(__FILE__)));
            $infocamp_sessions = new infocamp_sessions();

        } // END public function __construct

        public static function activate()
        {
            // Do nothing
        } // END public static function activate
    
        public static function deactivate()
        {
            // Do nothing
        } // END public static function deactivate
    } // END class infocamp_toolkit_plugin
} // END if(!class_exists('infocamp_toolkit_plugin'))

if(class_exists('infocamp_toolkit_plugin'))
{
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('infocamp_toolkit_plugin', 'activate'));
    register_deactivation_hook(__FILE__, array('infocamp_toolkit_plugin', 'deactivate'));

    // instantiate the plugin class
    $infocamp_toolkit_plugin = new infocamp_toolkit_plugin();
}

?>