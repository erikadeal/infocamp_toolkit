<?php
/* Sponsors Post Type
*/

if(!class_exists('infocamp_sponsors'))
{

	class infocamp_sponsors
	{
		const POST_TYPE	= "sponsors";

    	public function __construct()
    	{
    		add_action('init', array(&$this, 'init'));
    		add_action('admin_init', array(&$this, 'init'));
    		add_action('admin_menu', array(&$this, 'admin_menu'));
    	} // END public function __construct()

    	public function init()
    	{
    		$this->register_sponsors_type();
    		add_action('save_post', array(&$this, 'save_post'));
    	} // END public function init()


    	public function register_sponsors_type() 
    	{ 
			register_post_type(
				self::POST_TYPE,
				array( 'labels' => array(
					'name' => __( 'Sponsors', 'bonestheme' ), /* This is the Title of the Group */
					'singular_name' => __( 'Sponsor', 'bonestheme' ), /* This is the individual type */
					'all_items' => __( 'All Sponsors', 'bonestheme' ), /* the all items menu item */
					'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
					'add_new_item' => __( 'Add New Sponsor', 'bonestheme' ), /* Add New Display Title */
					'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
					'edit_item' => __( 'Edit Sponsors', 'bonestheme' ), /* Edit Display Title */
					'new_item' => __( 'New Sponsor', 'bonestheme' ), /* New Display Title */
					'view_item' => __( 'View Sponsor', 'bonestheme' ), /* View Display Title */
					'search_items' => __( 'Search Sponsors', 'bonestheme' ), /* Search Sponsors Type Title */ 
					'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
					'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
					'parent_item_colon' => ''
					), /* end of arrays */
					'description' => __( 'This the place to post sponsor information and archives.', 'bonestheme' ), /* Sponsors Type Description */
					'public' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => false,
					'show_ui' => true,
					'query_var' => true,
					'menu_position' => 8,
					'menu-icon' => 'dashicons-editor-ul',
					'rewrite'	=> array( 'slug' => 'sponsors', 'with_front' => false ),
					'has_archive' => 'sponsors', /* you can rename the slug here */
					'hierarchical' => false,
					/* the next one is important, it tells what's enabled in the post editor */
					'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'Sponsors-fields', 'comments', 'revisions', 'sticky')
				) /* end of options */
			); /* end of register post type */
	
		/* Register custom meta */
		if(function_exists("register_field_group"))
		{
			register_field_group(array (
				'id' => 'acf_sponsor-information',
				'title' => 'Sponsor Information',
				'fields' => array (
					array (
						'key' => 'field_538e7b15ec009',
						'label' => 'Sponsorship Level',
						'name' => 'sponsorship_level',
						'type' => 'select',
						'choices' => array (
							'Gold' => 'Gold',
							'Silver' => 'Silver',
							'Bronze' => 'Bronze',
							'Grassroots' => 'Grassroots',
						),
						'default_value' => '',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_538e7b4eec00a',
						'label' => 'Sponsor Logo',
						'name' => 'sponsor_logo',
						'type' => 'image',
						'save_format' => 'url',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_538f4a92bfabc',
						'label' => 'Donation Total',
						'name' => 'donation_total',
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
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'sponsors',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array (
					'position' => 'acf_after_title',
					'layout' => 'default',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 0,
			));
		}


		}

    	public function save_post($post_id)
    	{
            // verify if this is an auto save routine. 
            // If it is our form has not been submitted, so we dont want to do anything
            if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            {
                return;
            }
            
    		if($_POST['sponsors'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
    		{
    			foreach($this->_meta as $field_name)
    			{
    				// Update the post's meta field
    				update_post_meta($post_id, $field_name, $_POST[$field_name]);
    			}
    		}
    		else
    		{
    			return;
    		} // if($_POST['post_type'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
    	} // END public function save_post($post_id)

    	public function custom_admin()
    	{
    		
    	}

	} // END class infocamp_sponsors
} // END if(!class_exists('infocamp_sponsors'))

?>
