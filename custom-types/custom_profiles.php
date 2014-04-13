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
    		add_action('plugins_loaded', array(&$this, 'plugins_loaded'));
    	} // END public function __construct()

    	public function plugins_loaded()
    	{
    		$this->create_member_role();
            $this->create_participant_role();
    	} // END public function init()

    	public function create_member_role()
    	{
    		add_role('forum_member', 'Refugee Forum Member', array(
			    'read' => true, // True allows that capability
			    'edit_posts' => true,
			    'delete_posts' => true,
                'publish_tribe_events' => true,
                'publish_posts' => true,
			));

            register_field_group(array (
                    'id' => 'acf_service-areas',
                    'title' => 'Service Areas',
                    'fields' => array (
                        array (
                            'key' => 'field_53025fd551115',
                            'label' => 'Services',
                            'name' => 'member_services',
                            'type' => 'checkbox',
                            'instructions' => 'Please check all that apply.',
                            'required' => 1,
                            'choices' => array (
                                'Multicultural Resources' => 'Multicultural Resources',
                                'Mental Health Services' => 'Mental Health Services',
                                'Medical Assistance' => 'Medical Assistance',
                                'Legal Services' => 'Legal Services',
                                'Job/Employment Assistance' => 'Job/Employment Assistance',
                                'Immigration' => 'Immigration',
                                'Housing Assistance' => 'Housing Assistance',
                                'Food Bank' => 'Food Bank',
                                'English Classes' => 'English Classes',
                                'Education' => 'Education',
                                'Domestic Violence' => 'Domestic Violence',
                                'Children\'s Services' => 'Children\'s Services',
                            ),
                            'default_value' => '',
                            'layout' => 'vertical',
                        ),
                        array (
                            'key' => 'field_5302608151116',
                            'label' => 'Additional Services',
                            'name' => 'additional_services',
                            'type' => 'textarea',
                            'instructions' => 'If the list above does not fully cover your services, please add a sentence or two of specifics below.',
                            'default_value' => '',
                            'placeholder' => '',
                            'maxlength' => '',
                            'formatting' => 'br',
                        ),
                    ),
                    'location' => array (
                        array (
                            array (
                                'param' => 'ef_user',
                                'operator' => '==',
                                'value' => 'forum_member',
                                'order_no' => 0,
                                'group_no' => 0,
                            ),
                        ),
                    ),
                    'options' => array (
                        'position' => 'normal',
                        'layout' => 'default',
                        'hide_on_screen' => array (
                        ),
                    ),
                    'menu_order' => 0,
                ));

                register_field_group(array (
                    'id' => 'acf_member-info',
                    'title' => 'Member info',
                    'fields' => array (
                        array (
                            'key' => 'field_532c866bbaa90',
                            'label' => 'Organization Name',
                            'name' => 'organization_name',
                            'type' => 'text',
                            'instructions' => 'Enter the organization that you represent or are affiliated with. Leave blank if you participate in the Forum as an individual member.',
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'formatting' => 'html',
                            'maxlength' => '',
                        ),
                        array (
                            'key' => 'field_532c8653baa8f',
                            'label' => 'Date Founded',
                            'name' => 'date_founded',
                            'type' => 'text',
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'formatting' => 'html',
                            'maxlength' => '',
                        ),
                        array (
                            'key' => 'field_532c86afbaa91',
                            'label' => 'Address Line 1',
                            'name' => 'address_line_1',
                            'type' => 'text',
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'formatting' => 'html',
                            'maxlength' => '',
                        ),
                        array (
                            'key' => 'field_532c86b8baa92',
                            'label' => 'Address Line 2',
                            'name' => 'address_line_2',
                            'type' => 'text',
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'formatting' => 'html',
                            'maxlength' => '',
                        ),
                        array (
                            'key' => 'field_53307d344dbbe',
                            'label' => 'Phone',
                            'name' => 'phone',
                            'type' => 'text',
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'formatting' => 'html',
                            'maxlength' => '',
                        ),
                        array (
                            'key' => 'field_53307f6176f9f',
                            'label' => 'Primary demographic',
                            'name' => 'demographic',
                            'type' => 'text',
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'formatting' => 'html',
                            'maxlength' => '',
                        ),
                    ),
                    'location' => array (
                        array (
                            array (
                                'param' => 'ef_user',
                                'operator' => '==',
                                'value' => 'forum_member',
                                'order_no' => 0,
                                'group_no' => 0,
                            ),
                        ),
                    ),
                    'options' => array (
                        'position' => 'acf_after_title',
                        'layout' => 'no_box',
                        'hide_on_screen' => array (
                        ),
                    ),
                    'menu_order' => 0,
                ));

    	}//END create_member_role

        public function create_participant_role()
        {
            add_role('forum_participant', 'Refugee Forum Participant', array(
                'read' => true, // True allows that capability
                'edit_posts' => false,
                'delete_posts' => false,
            ));

        register_field_group(array (
                'id' => 'acf_participant-fields',
                'title' => 'Participant Fields',
                'fields' => array (
                    array (
                        'key' => 'field_53485b11e4a62',
                        'label' => 'Organization Name',
                        'name' => 'organization_name',
                        'type' => 'text',
                        'instructions' => 'Enter the organization that you represent or are affiliated with. Leave blank if you participate in the Forum as an individual.',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_53485b46e4a63',
                        'label' => 'Phone',
                        'name' => 'phone',
                        'type' => 'text',
                        'instructions' => 'Enter an optional phone number where you can be reached (this will be public)',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'ef_user',
                            'operator' => '==',
                            'value' => 'forum_participant',
                            'order_no' => 0,
                            'group_no' => 0,
                        ),
                    ),
                ),
                'options' => array (
                    'position' => 'normal',
                    'layout' => 'no_box',
                    'hide_on_screen' => array (
                    ),
                ),
                'menu_order' => 0,
            ));
        }

	} // END class custom_profiles
} // END if(!class_exists('custom_profiles'))
?>