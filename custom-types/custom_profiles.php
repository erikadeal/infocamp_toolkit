<?php
/*
Add custom user roles
*/

if(!class_exists('custom_profiles'))
{

	class custom_profiles
	{

    	public function __construct()
    	{
    		add_action('admin_init', array(&$this, 'admin_init'));
    		add_action('admin_menu', array(&$this, 'admin_menu'));
    	} // END public function __construct()

    	public function admin_init()
    	{
    		$this->create_custom_roles();
    		//add_action('add_meta_boxes', array(&$this, 'add_meta_boxes'));
    	} // END public function init()

    	public function create_custom_roles()
    	{
    		add_role('forum_member', 'Refugee Forum Member', array(
			    'read' => true, // True allows that capability
			    'edit_posts' => true,
			    'delete_posts' => true,
			));

			add_role('forum_participant', 'Refugee Forum Participant', array(
			    'read' => true, // True allows that capability
			    'edit_posts' => false,
			    'delete_posts' => false,
			));
    	}

    	/*public function add_meta_boxes()
    	{

    	}*/

	} // END class kcrf_meetings
} // END if(!class_exists('kcrf_meetings'))
?>