<?php
/*
Plugin Name: Carousel Anything for VC
Description: Adds a flexible touch-ready carousel system in Visual Composer.
Author: Gambit Technologies
Version: 1.5
Author URI: http://gambit.ph
*/
defined( 'VERSION_GAMBIT_CAROUSEL_ANYTHING' ) or define( 'VERSION_GAMBIT_CAROUSEL_ANYTHING', '1.5' );

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

defined( 'GAMBIT_CAROUSEL_ANYTHING' ) or define( 'GAMBIT_CAROUSEL_ANYTHING', 'gambit-carousel-anything' );

if ( ! class_exists('GambitCarouselShortcode') ) {

	class GambitCarouselShortcode {

	    private static $id = 0;


		/**
		 * Hook into WordPress
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {
			// Initialize after setup
    		add_action( 'init', array( $this, 'createShortcodes' ), 999 );

			// Our translations
			add_action( 'plugins_loaded', array( $this, 'loadTextDomain' ), 1 );

			// Our admin-side scripts & styles
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueueAdminScripts' ) );

			// Render shortcode for the plugin
			add_shortcode( 'carousel_anything', array( $this, 'renderShortcode' ) );

			// Gambit links
			add_filter( 'plugin_row_meta', array( $this, 'pluginLinks' ), 10, 2 );

			// Activation instructions & CodeCanyon rating notices
			$this->createNotices();
		}


		/**
		 * Loads the translations
		 *
		 * @return	void
		 * @since	1.0
		 */
		public function loadTextDomain() {
			load_plugin_textdomain( GAMBIT_CAROUSEL_ANYTHING, false, basename( dirname( __FILE__ ) ) . '/languages/' );
		}


		/**
		 * Loads the admin stylings for VC
		 *
		 * @return	void
		 * @since	1.0
		 */
		public function enqueueAdminScripts() {
			wp_enqueue_style( 'carousel-anything-admin', plugins_url( 'css/admin.css', __FILE__ ) );
		}


		/**
		 * Creates the carousel element inside VC
		 *
		 * @return	void
		 * @since	1.0
		 */
		public function createShortcodes() {
			include( 'class-carousel-anything.php' );

			if ( ! is_admin() ) {
				return;
			}
			if ( ! function_exists( 'vc_map' ) ) {
				return;
			}

			vc_map( array(
			    "name" => __( 'Carousel Anything', GAMBIT_CAROUSEL_ANYTHING ),
			    "base" => "carousel_anything",
				"icon" => plugins_url( 'vc-icon.png', __FILE__ ),
				"description" => __( 'A modern and responsive content carousel system.', GAMBIT_CAROUSEL_ANYTHING ),
				"as_parent" => array( 'only' => 'vc_row,vc_row_inner' ),
			    "js_view" => 'VcColumnView',
				"content_element" => true,
				'is_container' => true,
				'container_not_allowed' => false,
			    "params" => array(
					array(
						"type" => "textfield",
						"heading" => __( 'Items to display on screen', GAMBIT_CAROUSEL_ANYTHING ),
						"param_name" => "items",
						"value" => '5',
						"group" => __( 'General options', 'carousel_anything' ),
			                    "description" => __( 'Maximum items to display at a time.', GAMBIT_CAROUSEL_ANYTHING ),
					),
					array(
						"type" => "textfield",
						"heading" => __( 'Items to display on small desktops', GAMBIT_CAROUSEL_ANYTHING ),
						"param_name" => "items_desktop_small",
						"value" => '3',
						"group" => __( 'General options', 'carousel_anything' ),
			                    "description" => __( 'Maximum items to display at a time for smaller screened desktops.', GAMBIT_CAROUSEL_ANYTHING ),
					),
					array(
						"type" => "textfield",
						"heading" => __( 'Items to display on tablets', GAMBIT_CAROUSEL_ANYTHING ),
						"param_name" => "items_tablet",
						"value" => '2',
						"group" => __( 'General options', 'carousel_anything' ),
			                    "description" => __( 'Maximum items to display at a time for tablet devices.', GAMBIT_CAROUSEL_ANYTHING ),
					),
					array(
						"type" => "textfield",
						"heading" => __( 'Items to display on mobile phones', GAMBIT_CAROUSEL_ANYTHING ),
						"param_name" => "items_mobile",
						"value" => '1',
						"group" => __( 'General options', 'carousel_anything' ),
			                    "description" => __( 'Maximum items to display at a time for mobile devices.', GAMBIT_CAROUSEL_ANYTHING ),
					),



					array(
						"type" => "dropdown",
						"heading" => __( 'Navigation Thumbnails', GAMBIT_CAROUSEL_ANYTHING ),
						"param_name" => "thumbnails",
						"value" => array(
	                        __( 'Circle', GAMBIT_CAROUSEL_ANYTHING ) => 'circle',
	                        __( 'Square', GAMBIT_CAROUSEL_ANYTHING ) => 'square',
	                        __( 'Arrows', GAMBIT_CAROUSEL_ANYTHING ) => 'arrows',
	                        __( 'None', GAMBIT_CAROUSEL_ANYTHING ) => 'none',
	                    ),
	                    'description' => __( 'Select whether to display thumbnails below your carousel for navigation.<br>Selecting Arrows will display navigation arrows at each side.', GAMBIT_CAROUSEL_ANYTHING ),
						"group" => __( 'Thumbnails', 'carousel_anything' ),
					),

					array(
						"type" => "colorpicker",
						"heading" => __( 'Thumbnail Default Color', GAMBIT_CAROUSEL_ANYTHING ),
						"param_name" => "thumbnail_color",
						"value" => '#c3cbc8',
						"description" => __( 'The color of the non-active thumbnail. Not applicable to Arrows type of navigation.', GAMBIT_CAROUSEL_ANYTHING ),
		                "dependency" => array(
		                    "element" => "thumbnails",
		                    "value" => array( "circle", "square" ),
		                ),
						"group" => __( 'Thumbnails', 'carousel_anything' ),
					),

					array(
						"type" => "colorpicker",
						"heading" => __( 'Thumbnail Active Color', GAMBIT_CAROUSEL_ANYTHING ),
						"param_name" => "thumbnail_active_color",
						"value" => '#869791',
						"description" => __( 'The color of the active / current thumbnail. Not applicable to Arrows type of navigation.', GAMBIT_CAROUSEL_ANYTHING ),
		                "dependency" => array(
		                    "element" => "thumbnails",
		                    "value" => array( "circle", "square" ),
		                ),
						"group" => __( 'Thumbnails', 'carousel_anything' ),
					),

					array(
						"type" => "checkbox",
						"heading" => '',
						"param_name" => "thumbnail_numbers",
						"value" => array( __( 'Check to display page numbers inside the thumbnails. Not applicable to Arrows type of navigation.', GAMBIT_CAROUSEL_ANYTHING ) => 'true' ),
						"description" => '',
		                "dependency" => array(
		                    "element" => "thumbnails",
		                    "value" => array( "circle", "square" ),
		                ),
						"group" => __( 'Thumbnails', GAMBIT_CAROUSEL_ANYTHING ),
					),

					array(
						"type" => "colorpicker",
						"heading" => __( 'Thumbnail Deffault Page Number Color', GAMBIT_CAROUSEL_ANYTHING ),
						"param_name" => "thumbnail_number_color",
						"value" => '#ffffff',
						"description" => __( 'The color of the page numbers inside non-active thumbnails', GAMBIT_CAROUSEL_ANYTHING ),
		                "dependency" => array(
		                    "element" => "thumbnail_numbers",
		                    "value" => array( "true" ),
		                ),
						"group" => __( 'Thumbnails', 'carousel_anything' ),
					),

					array(
						"type" => "colorpicker",
						"heading" => __( 'Thumbnail Active Page Number Color', GAMBIT_CAROUSEL_ANYTHING ),
						"param_name" => "thumbnail_number_active_color",
						"value" => '#ffffff',
						"description" => __( 'The color of the page numbers inside active / current thumbnails', GAMBIT_CAROUSEL_ANYTHING ),
		                "dependency" => array(
		                    "element" => "thumbnail_numbers",
		                    "value" => array( "true" ),
		                ),
						"group" => __( 'Thumbnails', 'carousel_anything' ),
					),



					//array(
					//	"type" => "checkbox",
					//	"heading" => '',
					//	"param_name" => "scroll_per_page",
					//	"value" => array( __( 'Scroll a page at a time. If unchecked, the carousel will scroll one item at a time.', GAMBIT_CAROUSEL_ANYTHING ) => 'true' ),
					//	"description" => '',
					//	"group" => __( 'Advanced', GAMBIT_CAROUSEL_ANYTHING ),
					//),

					array(
						"type" => "textfield",
						"heading" => __( 'Autoplay', GAMBIT_CAROUSEL_ANYTHING ),
						"param_name" => "autoplay",
						"value" => '5000',
						"description" => __( 'Enter an amount in milliseconds for the carousel to move. Leave blank to disable autoplay', GAMBIT_CAROUSEL_ANYTHING ),
						"group" => __( 'Advanced', GAMBIT_CAROUSEL_ANYTHING ),
					),

					array(
						"type" => "checkbox",
						"heading" => '',
						"param_name" => "stop_on_hover",
						"value" => array( __( 'Pause the carousel when the mouse is hovered onto it.', GAMBIT_CAROUSEL_ANYTHING ) => 'true' ),
						"description" => '',
		                "dependency" => array(
		                    "element" => "autoplay",
		                    "not_empty" => true,
		                ),
						"group" => __( 'Advanced', GAMBIT_CAROUSEL_ANYTHING ),
					),

					array(
						"type" => "textfield",
						"heading" => __( 'Scroll Speed', GAMBIT_CAROUSEL_ANYTHING ),
						"param_name" => "speed_scroll",
						"value" => '800',
						"description" => __( 'The speed the carousel scrolls in milliseconds', GAMBIT_CAROUSEL_ANYTHING ),
						"group" => __( 'Advanced', 'carousel_anything' ),
					),

					array(
						"type" => "textfield",
						"heading" => __( 'Rewind Speed', GAMBIT_CAROUSEL_ANYTHING ),
						"param_name" => "speed_rewind",
						"value" => '1000',
						"description" => __( 'The speed the carousel scrolls back to the beginning after it reaches the end in milliseconds', GAMBIT_CAROUSEL_ANYTHING ),
						"group" => __( 'Advanced', 'carousel_anything' ),
					),
					array(
						"type" => "checkbox",
						"heading" => '',
						"param_name" => "touchdrag",
						"value" => array( __( 'Check this box to disable touch dragging of the carousel. (Normally enabled by default)', GAMBIT_CAROUSEL_ANYTHING ) => 'false' ),
						"description" => '',
						"group" => __( 'Advanced', GAMBIT_CAROUSEL_ANYTHING ),
					),
			    ),
				'default_content' => '[vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner]',
			) );
		}

		/**
		 * Adds plugin links
		 *
		 * @access	public
		 * @param	array $plugin_meta The current array of links
		 * @param	string $plugin_file The plugin file
		 * @return	array The current array of links together with our additions
		 * @since	1.0
		 **/
		public function pluginLinks( $plugin_meta, $plugin_file ) {
			if ( $plugin_file == plugin_basename( __FILE__ ) ) {
				$pluginData = get_plugin_data( __FILE__ );

				$plugin_meta[] = sprintf( "<a href='%s' target='_blank'>%s</a>",
					"http://support.gambit.ph?utm_source=" . urlencode( $pluginData['Name'] ) . "&utm_medium=plugin_link",
					__( "Get Customer Support", GAMBIT_CAROUSEL_ANYTHING )
				);
				$plugin_meta[] = sprintf( "<a href='%s' target='_blank'>%s</a>",
					"https://gambit.ph/plugins?utm_source=" . urlencode( $pluginData['Name'] ) . "&utm_medium=plugin_link",
					__( "Get More Plugins", GAMBIT_CAROUSEL_ANYTHING )
				);
			}
			return $plugin_meta;
		}

		/************************************************************************
		 * Activation instructions & CodeCanyon rating notices START
		 ************************************************************************/
		/**
		 * For theme developers who want to include our plugin, they will need
		 * to disable this section. This can be done by include this line
		 * in their theme:
		 *
		 * defined( 'GAMBIT_DISABLE_RATING_NOTICE' ) or define( 'GAMBIT_DISABLE_RATING_NOTICE', true );
		 */

		/**
		 * Adds the hooks for the notices
		 *
		 * @access	protected
		 * @return	void
		 * @since	1.0
		 **/
		protected function createNotices() {
			register_activation_hook( __FILE__, array( $this, 'justActivated' ) );
			register_deactivation_hook( __FILE__, array( $this, 'justDeactivated' ) );

			add_action( 'admin_notices', array( $this, 'remindSettingsAndSupport' ) );

			if ( ! defined( 'GAMBIT_DISABLE_RATING_NOTICE' ) ) {
				add_action( 'admin_notices', array( $this, 'remindRating' ) );
				add_action( 'wp_ajax_' . __CLASS__ . '-ask-rate', array( $this, 'ajaxRemindHandler' ) );
			}
		}


		/**
		 * Creates the transients for triggering the notices when the plugin is activated
		 *
		 * @return	void
		 * @since	1.0
		 **/
		public function justActivated() {
			delete_transient( __CLASS__ . '-activated' );
			set_transient( __CLASS__ . '-activated', time(), MINUTE_IN_SECONDS * 2 );

			if ( ! defined( 'GAMBIT_DISABLE_RATING_NOTICE' ) ) {
				delete_transient( __CLASS__ . '-ask-rate' );
				set_transient( __CLASS__ . '-ask-rate', time(), DAY_IN_SECONDS * 4 );

				update_option( __CLASS__ . '-ask-rate-placeholder', 1 );
			}
		}


		/**
		 * Removes the transients & triggers when the plugin is deactivated
		 *
		 * @return	void
		 * @since	1.0
		 **/
		public function justDeactivated() {
			delete_transient( __CLASS__ . '-activated' );
			delete_transient( __CLASS__ . '-ask-rate' );
			delete_option( __CLASS__ . '-ask-rate-placeholder' );
		}


		/**
		 * Ajax handler for when a button is clicked in the 'ask rating' notice
		 *
		 * @return	void
		 * @since	1.0
		 **/
		public function ajaxRemindHandler() {
			check_ajax_referer( __CLASS__, '_nonce' );

			if ( $_POST['type'] == 'remove' ) {
				delete_option( __CLASS__ . '-ask-rate-placeholder' );
			} else { // remind
				set_transient( __CLASS__ . '-ask-rate', time(), DAY_IN_SECONDS );
			}

			die();
		}


		/**
		 * Displays the notice for reminding the user to rate our plugin
		 *
		 * @return	void
		 * @since	1.0
		 **/
		public function remindRating() {
			if ( get_option( __CLASS__ . '-ask-rate-placeholder' ) === false ) {
				return;
			}
			if ( get_transient( __CLASS__ . '-ask-rate' ) ) {
				return;
			}

			$pluginData = get_plugin_data( __FILE__ );
			$nonce = wp_create_nonce( __CLASS__ );

			echo '<div class="updated gambit-ask-rating" style="border-left-color: #3498db">
					<p>
						<img src="' . plugins_url( 'gambit-logo.png', __FILE__ ) . '" style="display: block; margin-bottom: 10px"/>
						<strong>' . sprintf( __( 'Enjoying %s?', GAMBIT_CAROUSEL_ANYTHING ), $pluginData['Name'] ) . '</strong><br>' .
						__( 'Help us out by rating our plugin 5 stars in CodeCanyon! This will allow us to create more awesome products and provide top notch customer support.', GAMBIT_CAROUSEL_ANYTHING ) . '<br>' .
						'<button data-href="http://codecanyon.net/downloads?utm_source=' . urlencode( $pluginData['Name'] ) . '&utm_medium=rate_notice" class="button button-primary" style="margin: 10px 10px 10px 0;">' . __( 'Rate us 5 stars in CodeCanyon :)', GAMBIT_CAROUSEL_ANYTHING ) . '</button>' .
						'<button class="button button-secondary remind" style="margin: 10px 10px 10px 0;">' . __( 'Remind me tomorrow', GAMBIT_CAROUSEL_ANYTHING ) . '</button>' .
						'<button class="button button-secondary nothanks" style="margin: 10px 0;">' . __( 'I&apos;ve already rated!', GAMBIT_CAROUSEL_ANYTHING ) . '</button>' .
						'<script>
						jQuery(document).ready(function($) {
							"use strict";

							$(".gambit-ask-rating button").click(function() {
								if ( $(this).is(".button-primary") ) {
									var $this = $(this);

									var data = {
										"_nonce": "' . $nonce . '",
										"action": "' . __CLASS__ . '-ask-rate",
										"type": "remove"
									};

									$.post(ajaxurl, data, function(response) {
										$this.parents(".updated:eq(0)").fadeOut();
										window.open($this.attr("data-href"), "_blank");
									});

								} else if ( $(this).is(".remind") ) {
									var $this = $(this);

									var data = {
										"_nonce": "' . $nonce . '",
										"action": "' . __CLASS__ . '-ask-rate",
										"type": "remind"
									};

									$.post(ajaxurl, data, function(response) {
										$this.parents(".updated:eq(0)").fadeOut();
									});

								} else if ( $(this).is(".nothanks") ) {
									var $this = $(this);

									var data = {
										"_nonce": "' . $nonce . '",
										"action": "' . __CLASS__ . '-ask-rate",
										"type": "remove"
									};

									$.post(ajaxurl, data, function(response) {
										$this.parents(".updated:eq(0)").fadeOut();
									});
								}
								return false;
							});
						});
						</script>
					</p>
				</div>';
		}


		/**
		 * Displays the notice that we have a support site and additional instructions
		 *
		 * @return	void
		 * @since	1.0
		 **/
		public function remindSettingsAndSupport() {
			if ( ! get_transient( __CLASS__ . '-activated' ) ) {
				return;
			}

			$pluginData = get_plugin_data( __FILE__ );

			echo '<div class="updated" style="border-left-color: #3498db">
					<p>
						<img src="' . plugins_url( 'gambit-logo.png', __FILE__ ) . '" style="display: block; margin-bottom: 10px"/>
						<strong>' . sprintf( __( 'Thank you for activating %s!', GAMBIT_CAROUSEL_ANYTHING ), $pluginData['Name'] ) . '</strong><br>' .

						// Tell users how to use the plugin.
						__( 'Now just edit your pages and create a Carousel Anywhere element in Visual Composer.', GAMBIT_CAROUSEL_ANYTHING ) . '<br>' .

						__( 'If you need any support, you can leave us a ticket in our support site. The link to our support site is also listed in the plugin details for future reference.', GAMBIT_CAROUSEL_ANYTHING ) . '<br>' .
						'<a href="http://support.gambit.ph?utm_source=' . urlencode( $pluginData['Name'] ) . '&utm_medium=activation_notice" class="gambit_ask_rate button button-default" style="margin: 10px 0;" target="_blank">' . __( 'Visit our support site', GAMBIT_CAROUSEL_ANYTHING ) . '</a>' .
						'<br>' .
						'<em style="color: #999">' . __( 'This notice will go away in a moment', GAMBIT_CAROUSEL_ANYTHING ) . '</em><br>
					</p>
				</div>';
		}


		/************************************************************************
		 * Activation instructions & CodeCanyon rating notices END
		 ************************************************************************/


		/**
		 * Shortcode logic
		 *
		 * @return	string The rendered html
		 * @since	1.0
		 */
		public function renderShortcode( $atts, $content = null ) {
	        $defaults = array(
				'items' => '5',
				'items_desktop_small' => '3',
				'items_tablet' => '2',
				'items_mobile' => '1',
				'autoplay' => '5000',
				'stop_on_hover' => false,
				'scroll_per_page' => false,
				'speed_scroll' => '800',
				'speed_rewind' => '1000',
				'thumbnails' => 'circle',
				'thumbnail_color' => '#c3cbc8',
				'thumbnail_active_color' => '#869791',
				'thumbnail_numbers' => false,
				'thumbnail_number_color' => '#ffffff',
				'thumbnail_number_active_color' => '#ffffff',
				'touchdrag' => true,
	        );
			if ( empty( $atts ) ) {
				$atts = array();
			}
			$atts = array_merge( $defaults, $atts );

			wp_enqueue_style( 'carousel-anything-owl', plugins_url( 'css/owl.carousel.theme.style.css', __FILE__ ), array(), VERSION_GAMBIT_CAROUSEL_ANYTHING );
			wp_enqueue_script( 'carousel-anything-owl', plugins_url( 'js/min/owl.carousel-min.js', __FILE__ ), array( 'jquery' ), '1.3.3', true );
			wp_enqueue_script( 'carousel-anything', plugins_url( 'js/min/script-min.js', __FILE__ ), array( 'jquery', 'carousel-anything-owl' ), VERSION_GAMBIT_CAROUSEL_ANYTHING, true );

			self::$id++;
			$id = 'carousel-anything-' . esc_attr( self::$id );

	        $ret = "";

			// Thumbnail styles
			$styles = "";
			$carousel_class = "";
			$navigation_buttons = false;
			if ( ! empty( $atts['thumbnails'] ) ) {
				if ( $atts['thumbnails'] == 'square' ) {
					$styles .= "#{$id}.owl-theme .owl-controls .owl-page span { border-radius: 0 }";
				}
				if ( $atts['thumbnails'] == 'arrows' ) {
					$navigation_buttons = true;
					$carousel_class = " has-arrows";
				}
				if ( $atts['thumbnails'] != 'none' && $atts['thumbnails'] != 'arrows') {
					$styles .= "#{$id}.owl-theme .owl-controls .owl-page span { opacity: 1; background: " . esc_attr( $atts['thumbnail_color'] ) . " }"
							 . "#{$id}.owl-theme .owl-controls .owl-page.active span { background: " . esc_attr( $atts['thumbnail_active_color'] ) . " }";
				}
				if ( $atts['thumbnail_numbers'] != false && $atts['thumbnails'] != 'arrows') {
					$styles .= "#{$id}.owl-theme .owl-controls .owl-page span.owl-numbers { color: " . esc_attr( $atts['thumbnail_number_color'] ) . " }"
						 	 . "#{$id}.owl-theme .owl-controls .owl-page.active span.owl-numbers { color: " . esc_attr( $atts['thumbnail_number_active_color'] ) . " }";
				}
			}
			if ( $styles ) {
				$ret .= "<style>{$styles}</style>";
			}

			if ( $navigation_buttons ) {
				wp_enqueue_style( 'dashicons' );
				wp_enqueue_style( 'carousel-anything', plugins_url( 'css/style.css', __FILE__ ), array(), VERSION_GAMBIT_CAROUSEL_ANYTHING );
			}

			// Carousel html
			// $ret .= '<div class="customNavigation"><a class="btn prev">Previous</a><a class="btn next">Next</a></div>';
			$ret .= '<div id="' . esc_attr( $id ) . '" class="carousel-anything-container owl-carousel' . $carousel_class . '"data-items="' . esc_attr( $atts['items'] ) . '"data-scroll_per_page="' . esc_attr( $atts['scroll_per_page'] ) . '"data-autoplay="' . esc_attr( empty( $atts['autoplay'] ) || $atts['autoplay'] == '0' ? 'false' : $atts['autoplay'] ) . '"data-items-small="' . esc_attr( $atts['items_desktop_small'] ) . '"data-items-tablet="' . esc_attr( $atts['items_tablet'] ) . '"data-items-mobile="' . esc_attr( $atts['items_mobile'] ) . '"data-stop-on-hover="' . esc_attr( $atts['stop_on_hover'] ) . '"data-speed-scroll="' . esc_attr( $atts['speed_scroll'] ) . '"data-speed-rewind="' . esc_attr( $atts['speed_rewind'] ) . '"data-thumbnails="' . esc_attr( $atts['thumbnails'] ) . '"data-thumbnail-numbers="' . esc_attr( $atts['thumbnail_numbers'] ) . '"data-navigation="' . esc_attr( $navigation_buttons ? 'true' : 'false' ) . '"data-touchdrag="' . esc_attr( $atts['touchdrag'] ? 'true' : 'false' ) . '">';
			$ret .= do_shortcode( $content ) . '</div>';

			return $ret;
		}
	}
	
	new GambitCarouselShortcode();
}