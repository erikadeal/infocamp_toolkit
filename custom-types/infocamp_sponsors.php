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

			register_taxonomy( 'sponsor-categories', 
				array('sponsors'), /* if you change the name of register_post_type( 'Sponsors_type', then you have to change this */
				array('hierarchical' => true,     /* if this is true, it acts like categories */
					'labels' => array(
						'name' => __( 'Sponsors Categories', 'bonestheme' ), /* name of the Sponsors taxonomy */
						'singular_name' => __( 'Sponsors Category', 'bonestheme' ), /* single taxonomy name */
						'search_items' =>  __( 'Search Sponsors Categories', 'bonestheme' ), /* search title for taxomony */
						'all_items' => __( 'All Sponsors Categories', 'bonestheme' ), /* all title for taxonomies */
						'parent_item' => __( 'Parent Sponsors Category', 'bonestheme' ), /* parent title for taxonomy */
						'parent_item_colon' => __( 'Parent Sponsors Category:', 'bonestheme' ), /* parent taxonomy title */
						'edit_item' => __( 'Edit Sponsors Category', 'bonestheme' ), /* edit Sponsors taxonomy title */
						'update_item' => __( 'Update Sponsors Category', 'bonestheme' ), /* update title for taxonomy */
						'add_new_item' => __( 'Add New Sponsors Category', 'bonestheme' ), /* add new title for taxonomy */
						'new_item_name' => __( 'New Sponsors Category Name', 'bonestheme' ) /* name title for taxonomy */
					),
					'show_admin_column' => true, 
					'show_ui' => true,
					'query_var' => true,
					'rewrite' => array( 'slug' => 'sponsors-cat' ),
				)
			);

			register_taxonomy( 'sponsors_tag', 
				array('sponsors'), /* if you change the name of register_post_type( 'Sponsors_type', then you have to change this */
				array('hierarchical' => false,    /* if this is false, it acts like tags */
					'labels' => array(
						'name' => __( 'Sponsors Tags', 'bonestheme' ), /* name of the Sponsors taxonomy */
						'singular_name' => __( 'Sponsors Tag', 'bonestheme' ), /* single taxonomy name */
						'search_items' =>  __( 'Search Sponsors Tags', 'bonestheme' ), /* search title for taxomony */
						'all_items' => __( 'All Sponsors Tags', 'bonestheme' ), /* all title for taxonomies */
						'parent_item' => __( 'Parent Sponsors Tag', 'bonestheme' ), /* parent title for taxonomy */
						'parent_item_colon' => __( 'Parent Sponsors Tag:', 'bonestheme' ), /* parent taxonomy title */
						'edit_item' => __( 'Edit Sponsors Tag', 'bonestheme' ), /* edit Sponsors taxonomy title */
						'update_item' => __( 'Update Sponsors Tag', 'bonestheme' ), /* update title for taxonomy */
						'add_new_item' => __( 'Add New Sponsors Tag', 'bonestheme' ), /* add new title for taxonomy */
						'new_item_name' => __( 'New Sponsors Tag Name', 'bonestheme' ) /* name title for taxonomy */
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

	} // END class infocamp_sponsors
} // END if(!class_exists('infocamp_sponsors'))

?>
