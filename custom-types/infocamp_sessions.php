<?php
/* Session Post Type
*/

if(!class_exists('infocamp_sessions'))
{

	class infocamp_sessions
	{
		const POST_TYPE	= "sessions";

    	public function __construct()
    	{
    		add_action('init', array(&$this, 'init'));
    		add_action('admin_init', array(&$this, 'init'));
    		add_action('admin_menu', array(&$this, 'admin_menu'));
    	} // END public function __construct()

    	public function init()
    	{
    		$this->register_sessions_type();
    		add_action('save_post', array(&$this, 'save_post'));
    	} // END public function init()


    	public function register_sessions_type() 
    	{ 
			register_post_type(
				self::POST_TYPE,
				array( 'labels' => array(
					'name' => __( 'Sessions', 'bonestheme' ), /* This is the Title of the Group */
					'singular_name' => __( 'Session', 'bonestheme' ), /* This is the individual type */
					'all_items' => __( 'All Sessions', 'bonestheme' ), /* the all items menu item */
					'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
					'add_new_item' => __( 'Add New Session', 'bonestheme' ), /* Add New Display Title */
					'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
					'edit_item' => __( 'Edit Sessions', 'bonestheme' ), /* Edit Display Title */
					'new_item' => __( 'New Session', 'bonestheme' ), /* New Display Title */
					'view_item' => __( 'View Session', 'bonestheme' ), /* View Display Title */
					'search_items' => __( 'Search Sessions', 'bonestheme' ), /* Search Session Type Title */ 
					'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
					'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
					'parent_item_colon' => ''
					), /* end of arrays */
					'description' => __( 'This the place to post session information and archives.', 'bonestheme' ), /* Session Type Description */
					'public' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => false,
					'show_ui' => true,
					'query_var' => true,
					'menu_position' => 8,
					'menu-icon' => 'dashicons-editor-ul',
					'rewrite'	=> array( 'slug' => 'sessions', 'with_front' => false ),
					'has_archive' => 'sessions', /* you can rename the slug here */
					'hierarchical' => false,
					/* the next one is important, it tells what's enabled in the post editor */
					'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'Session-fields', 'comments', 'revisions', 'sticky')
				) /* end of options */
			); /* end of register post type */

			register_taxonomy( 'session-categories', 
				array('sessions'), /* if you change the name of register_post_type( 'Session_type', then you have to change this */
				array('hierarchical' => true,     /* if this is true, it acts like categories */
					'labels' => array(
						'name' => __( 'Session Categories', 'bonestheme' ), /* name of the Session taxonomy */
						'singular_name' => __( 'Session Category', 'bonestheme' ), /* single taxonomy name */
						'search_items' =>  __( 'Search Session Categories', 'bonestheme' ), /* search title for taxomony */
						'all_items' => __( 'All Session Categories', 'bonestheme' ), /* all title for taxonomies */
						'parent_item' => __( 'Parent Session Category', 'bonestheme' ), /* parent title for taxonomy */
						'parent_item_colon' => __( 'Parent Session Category:', 'bonestheme' ), /* parent taxonomy title */
						'edit_item' => __( 'Edit Session Category', 'bonestheme' ), /* edit Session taxonomy title */
						'update_item' => __( 'Update Session Category', 'bonestheme' ), /* update title for taxonomy */
						'add_new_item' => __( 'Add New Session Category', 'bonestheme' ), /* add new title for taxonomy */
						'new_item_name' => __( 'New Session Category Name', 'bonestheme' ) /* name title for taxonomy */
					),
					'show_admin_column' => true, 
					'show_ui' => true,
					'query_var' => true,
					'rewrite' => array( 'slug' => 'sessions-cat' ),
				)
			);

			register_taxonomy( 'sessions_tag', 
				array('sessions'), /* if you change the name of register_post_type( 'Session_type', then you have to change this */
				array('hierarchical' => false,    /* if this is false, it acts like tags */
					'labels' => array(
						'name' => __( 'Session Tags', 'bonestheme' ), /* name of the Session taxonomy */
						'singular_name' => __( 'Session Tag', 'bonestheme' ), /* single taxonomy name */
						'search_items' =>  __( 'Search Session Tags', 'bonestheme' ), /* search title for taxomony */
						'all_items' => __( 'All Session Tags', 'bonestheme' ), /* all title for taxonomies */
						'parent_item' => __( 'Parent Session Tag', 'bonestheme' ), /* parent title for taxonomy */
						'parent_item_colon' => __( 'Parent Session Tag:', 'bonestheme' ), /* parent taxonomy title */
						'edit_item' => __( 'Edit Session Tag', 'bonestheme' ), /* edit Session taxonomy title */
						'update_item' => __( 'Update Session Tag', 'bonestheme' ), /* update title for taxonomy */
						'add_new_item' => __( 'Add New Session Tag', 'bonestheme' ), /* add new title for taxonomy */
						'new_item_name' => __( 'New Session Tag Name', 'bonestheme' ) /* name title for taxonomy */
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
            
    		if($_POST['sessions'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
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

	} // END class infocamp_sessions
} // END if(!class_exists('infocamp_sessions'))

?>
