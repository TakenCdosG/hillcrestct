<?php
/**
 * Plugin Name: Footer4
 * Description: Information of Footer 4.
 * License: GPL2
 */
class footer4 extends WP_Widget {

	// constructor
	function footer4() {
        parent::WP_Widget(false, $name = __('Footer Column 4 Info', 'wp_widget_plugin') );
    }

	// widget form creation
	function form($instance) {
    		// Check values
		if( $instance) {
			$title = esc_attr($instance['title']);
			$text = esc_attr($instance['text']);
		} else {
			$title = '';
			$text = '';
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Column Title', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
		</p>
		<?php
	}
	// widget update
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
		return $instance;
	}

	// display widget
	function widget($args, $instance) {
     	extract( $args );
		// these are the widget options
		$title = $instance['title'];
		$text = $instance['text'];
		echo $before_widget;
		?>
		<div class="widget-text wp_widget_plugin_box">
			<div class="footer-logos">
			</div>
			<div class="footer-title-area">
				<?php
					if( $title ) {
						 echo '<h3 class="widget-title">'.$title.'</h3>';
					}
				?>
			</div>
			<div class="footer-text-area">
				<?php
					if( $text ) {
						echo '<p>'.$text.'</p>';
				   	}
			   	?>
			</div>
			<div class="footer-form-area">
				<form action="http://thinkcreativegroup.createsend.com/t/y/s/fjywi/" method="post" id="subForm">
				    <input id="fieldEmail" name="cm-fjywi-fjywi" type="email" required placeholder="Email Address" />
				    <input class="submit-btn" type="submit" value="submit">
				</form>
			</div>
			<div class="footer-social-icons">
                <?php
                    global $fbaddr,$twaddr,$ptaddr,$gpaddr,$beaddr;
                ?>
				<div class="fb-white"><a href="<?php if($fbaddr == null) echo "#"; else echo $fbaddr;?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social-logos/facebook-white.png"></a></div>
				<div class="tw-white"><a href="<?php if($twaddr == null) echo "#"; else echo $twaddr; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social-logos/twitter-white.png"></a></div>
				<div class="pt-white"><a href="<?php if($ptaddr == null) echo "#"; else echo $ptaddr; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social-logos/pinterest-white.png"></a></div>
				<div class="gp-white"><a href="<?php if($gpaddr == null) echo "#"; else echo $gpaddr; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social-logos/google-white.png"></a></div>
				<div class="be-white"><a href="<?php if($beaddr == null) echo "#"; else echo $beaddr; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social-logos/behance-white.png"></a></div>
            </div>
		</div>
		<?php
		echo $after_widget;
	}
}
// register widget
add_action('widgets_init', create_function('', 'return register_widget("footer4");') );
?>