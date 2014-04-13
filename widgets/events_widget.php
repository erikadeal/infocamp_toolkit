<?php
/* Events Widget */

if(!class_exists('events_widget'))
{
	class events_widget extends WP_Widget {

		protected $widget_slug = 'events_widget';

		public function __construct()
		{
			// load plugin text domain
			add_action( 'init', array( $this, 'widget_textdomain' ) );

			// TODO: update description
			parent::__construct(
				$this->get_widget_slug(),
				__( 'Events List', $this->get_widget_slug() ),
				array(
				'classname' => $this->get_widget_slug().'-class',
				'description' => __( 'Short description of the widget goes here.', $this->get_widget_slug() )
			)
		}



	}//End class events_widget

}//End if(!class_exists())
?>