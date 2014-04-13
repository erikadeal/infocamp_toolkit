<?php
/* events Post Type
*/

if(!class_exists('kcrf_events'))
{

	class kcrf_events
	{
		const POST_TYPE	= "events";

    	public function __construct()
    	{
    		add_action('init', array(&$this, 'init'));
    		add_action('admin_init', array(&$this, 'init'));
    		add_action('admin_menu', array(&$this, 'admin_menu'));
    	} // END public function __construct()

    	public function init()
    	{
    		$this->register_events_type();
    		add_action('save_post', array(&$this, 'save_post'));
    	} // END public function init()


    	public function register_events_type() 
    	{ 
			register_post_type(
				self::POST_TYPE,
				array( 'labels' => array(
					'name' => __( 'Events', 'bonestheme' ), /* This is the Title of the Group */
					'singular_name' => __( 'Event', 'bonestheme' ), /* This is the individual type */
					'all_items' => __( 'All Events', 'bonestheme' ), /* the all items menu item */
					'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
					'add_new_item' => __( 'Add New Meeting', 'bonestheme' ), /* Add New Display Title */
					'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
					'edit_item' => __( 'Edit Post Types', 'bonestheme' ), /* Edit Display Title */
					'new_item' => __( 'New Post Type', 'bonestheme' ), /* New Display Title */
					'view_item' => __( 'View Post Type', 'bonestheme' ), /* View Display Title */
					'search_items' => __( 'Search Post Type', 'bonestheme' ), /* Search events Type Title */ 
					'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
					'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
					'parent_item_colon' => ''
					), /* end of arrays */
					'description' => __( 'This the place to post meeting information and archives.', 'bonestheme' ), /* events Type Description */
					'public' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => false,
					'show_ui' => true,
					'query_var' => true,
					'menu_position' => 8,
					'menu-icon' => 'dashicons-calendar',
					'rewrite'	=> array( 'slug' => 'events', 'with_front' => false ),
					'has_archive' => 'events', /* you can rename the slug here */
					'capability_type' => 'post',
					'hierarchical' => false,
					/* the next one is important, it tells what's enabled in the post editor */
					'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'events-fields', 'comments', 'revisions', 'sticky')
				) /* end of options */
			); /* end of register post type */

			register_taxonomy( 'event-categories', 
				array('events'), /* if you change the name of register_post_type( 'events_type', then you have to change this */
				array('hierarchical' => true,     /* if this is true, it acts like categories */
					'labels' => array(
						'name' => __( 'Events Categories', 'bonestheme' ), /* name of the events taxonomy */
						'singular_name' => __( 'Events Category', 'bonestheme' ), /* single taxonomy name */
						'search_items' =>  __( 'Search Events Categories', 'bonestheme' ), /* search title for taxomony */
						'all_items' => __( 'All Events Categories', 'bonestheme' ), /* all title for taxonomies */
						'parent_item' => __( 'Parent Events Category', 'bonestheme' ), /* parent title for taxonomy */
						'parent_item_colon' => __( 'Parent Events Category:', 'bonestheme' ), /* parent taxonomy title */
						'edit_item' => __( 'Edit Events Category', 'bonestheme' ), /* edit events taxonomy title */
						'update_item' => __( 'Update Events Category', 'bonestheme' ), /* update title for taxonomy */
						'add_new_item' => __( 'Add New Events Category', 'bonestheme' ), /* add new title for taxonomy */
						'new_item_name' => __( 'New Events Category Name', 'bonestheme' ) /* name title for taxonomy */
					),
					'show_admin_column' => true, 
					'show_ui' => true,
					'query_var' => true,
					'rewrite' => array( 'slug' => 'events-cat' ),
				)
			);

			register_taxonomy( 'events_tag', 
				array('events'), /* if you change the name of register_post_type( 'events_type', then you have to change this */
				array('hierarchical' => false,    /* if this is false, it acts like tags */
					'labels' => array(
						'name' => __( 'Events Tags', 'bonestheme' ), /* name of the events taxonomy */
						'singular_name' => __( 'Events Tag', 'bonestheme' ), /* single taxonomy name */
						'search_items' =>  __( 'Search Events Tags', 'bonestheme' ), /* search title for taxomony */
						'all_items' => __( 'All Events Tags', 'bonestheme' ), /* all title for taxonomies */
						'parent_item' => __( 'Parent Events Tag', 'bonestheme' ), /* parent title for taxonomy */
						'parent_item_colon' => __( 'Parent Events Tag:', 'bonestheme' ), /* parent taxonomy title */
						'edit_item' => __( 'Edit Events Tag', 'bonestheme' ), /* edit events taxonomy title */
						'update_item' => __( 'Update Events Tag', 'bonestheme' ), /* update title for taxonomy */
						'add_new_item' => __( 'Add New Events Tag', 'bonestheme' ), /* add new title for taxonomy */
						'new_item_name' => __( 'New Events Tag Name', 'bonestheme' ) /* name title for taxonomy */
					),
					'show_admin_column' => true,
					'show_ui' => true,
					'query_var' => true,
				)
			);
		}

    	public function save_post($post_id)
    	{
            // verify if this is an auto save routine. 
            // If it is our form has not been submitted, so we dont want to do anything
            if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            {
                return;
            }
            
    		if($_POST['events'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
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

	} // END class kcrf_events
} // END if(!class_exists('kcrf_events'))

?>
