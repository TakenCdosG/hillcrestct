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
        global $fbaddr;
    		// Check values
		if( $instance) {
			$title = esc_attr($instance['title']);
			$text = esc_attr($instance['text']);
            $fbaddr = esc_attr($instance['fbaddr']);
            $twaddr = esc_attr($instance['twaddr']);
            $ptaddr = esc_attr($instance['ptaddr']);
            $gpaddr = esc_attr($instance['gpaddr']);
            $beaddr = esc_attr($instance['beaddr']);
		} else {
			$title = '';
			$text = '';
            $fbaddr = '';
            $twaddr = '';
            $ptaddr = '';
            $gpaddr = '';
            $beaddr = '';
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
        <p>
            <label for="<?php echo $this->get_field_id('fbaddr'); ?>"><?php _e('Enter Facebook Page Address:', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('fbaddr'); ?>" name="<?php echo $this->get_field_name('fbaddr'); ?>" type="text" value="<?php echo $fbaddr; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('twaddr'); ?>"><?php _e('Enter Twitter Page Address:', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('twaddr'); ?>" name="<?php echo $this->get_field_name('twaddr'); ?>" type="text" value="<?php echo $twaddr; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('ptaddr'); ?>"><?php _e('Enter Pinterest Page Address:', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('ptaddr'); ?>" name="<?php echo $this->get_field_name('ptaddr'); ?>" type="text" value="<?php echo $ptaddr; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('gpaddr'); ?>"><?php _e('Enter Google Plus Page Address:', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('gpaddr'); ?>" name="<?php echo $this->get_field_name('gpaddr'); ?>" type="text" value="<?php echo $gpaddr; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('beaddr'); ?>"><?php _e('Enter Behance Page Name:', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('beaddr'); ?>" name="<?php echo $this->get_field_name('beaddr'); ?>" type="text" value="<?php echo $beaddr; ?>" />
        </p>
		<?php
	}
	// widget update
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
        $instance['fbaddr'] = strip_tags($new_instance['fbaddr']);
        $instance['twaddr'] = strip_tags($new_instance['twaddr']);
        $instance['ptaddr'] = strip_tags($new_instance['ptaddr']);
        $instance['gpaddr'] = strip_tags($new_instance['gpaddr']);
        $instance['beaddr'] = strip_tags($new_instance['beaddr']);
		return $instance;
	}

	// display widget
	function widget($args, $instance) {
     	extract( $args );
		// these are the widget options
		$title = $instance['title'];
		$text = $instance['text'];
        $fbaddr = $instance['fbaddr'];
        $twaddr = $instance['twaddr'];
        $ptaddr = $instance['ptaddr'];
        $gpaddr = $instance['gpaddr'];
        $beaddr = $instance['beaddr'];
        $fba2 = $fbaddr;
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
                <?php global $fb2; $fb2 = $fbaddr; ?>
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