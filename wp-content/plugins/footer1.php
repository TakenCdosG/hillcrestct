<?php
/**
 * Plugin Name: Footer1
 * Description: Information of Footer 1.
 * License: GPL2
 */
class footer1 extends WP_Widget {

	// constructor
	function footer1() {
        parent::WP_Widget(false, $name = __('Footer Column 1 Info', 'wp_widget_plugin') );
    }

	// widget form creation
	function form($instance) {

		// Check values
		if( $instance) {
		     $textarea = esc_textarea($instance['textarea']);
		} else {
		     $textarea = '';
		}
		?>

		<p>
		<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Enter footer text here (HTML Tags are valid):', 'wp_widget_plugin'); ?></label>
		<textarea rows="10" cols="10" class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
		</p>
		<?php
	}
	// widget update
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
		$instance['textarea'] = $new_instance['textarea'];
		return $instance;
	}

	// display widget
	function widget($args, $instance) {
		extract( $args );
		// these are the widget options
		$textarea = $instance['textarea'];
		echo $before_widget;
		?>
		<div class="widget-text wp_widget_plugin_box">
			<div class="footer-logos">
				<div class="calcagni-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/social-logos/calcagni-logo.png"></div>
				<div class="hillcrest-footer-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/social-logos/hillcrest-footer-logo.png"></div>
			</div>
			<div class="footer-textarea">
				<?php
					if( $textarea ) {
						 echo '<span class="wp_widget_plugin_textarea">'.$textarea.'</span>';
					}
				?>
			</div>
			<div class="lower-logos">
				<div class="lower-img-1"><img src="<?php echo get_template_directory_uri(); ?>/images/social-logos/lower-img-1.png"></div>
				<div class="lower-img-2"><img src="<?php echo get_template_directory_uri(); ?>/images/social-logos/lower-img-2.png"></div>
			</div>
		</div>
		<?php
		echo $after_widget;
	}
}
// register widget
add_action('widgets_init', create_function('', 'return register_widget("footer1");') );
?>