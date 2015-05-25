<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class bbPress_Advanced_Statistics_Settings {

	/**
	 * The single instance of bbPress_Advanced_Statistics_Settings.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * The main plugin object.
	 * @var 	object
	 * @access  public
	 * @since 	1.0.0
	 */
	public $parent = null;

	/**
	 * Prefix for plugin settings.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $base = '';

	/**
	 * Available settings for plugin.
	 * @var     array
	 * @access  public
	 * @since   1.0.0
	 */
	public $settings = array();

	public function __construct ( $parent ) {
		$this->parent = $parent;

		$this->base = 'bbpress-advanced-statistics-';

		// Initialise settings
		add_action( 'init', array( $this, 'init_settings' ), 11 );

		// Register plugin settings
		add_action( 'admin_init' , array( $this, 'register_settings' ) );

		// Add settings page to menu
		add_action( 'admin_menu' , array( $this, 'add_menu_item' ) );

		// Add settings link to plugins page
		add_filter( 'plugin_action_links_' . plugin_basename( $this->parent->file ) , array( $this, 'add_settings_link' ) );
	}

	/**
	 * Initialise settings
	 * @return void
	 */
	public function init_settings () {

            $this->settings = $this->settings_fields();
	}

	/**
	 * Add settings page to admin menu
	 * @return void
	 */
	public function add_menu_item () {
		$page = add_submenu_page("edit.php?post_type=forum", 'bbPress Advanced Statistics', 'Advanced Statistics', 'activate_plugins' , $this->parent->_token . '_settings', array( $this, 'settings_page' ));
                add_action( 'admin_print_styles-' . $page, array( $this, 'settings_assets' ) );
	}

	/**
	 * Load settings JS & CSS
	 * @return void
	 */
	public function settings_assets () {

            // We're including the WP media scripts here because they're needed for the image upload field
            // If you're not including an image upload then you can leave this function call out
            
            wp_enqueue_media();

            wp_register_script( $this->parent->_token . '-settings-js', $this->parent->assets_url . 'js/settings' . $this->parent->script_suffix . '.js', array( 'farbtastic', 'jquery' ), '1.0.0' );
            wp_enqueue_script( $this->parent->_token . '-settings-js' );
	}

	/**
	 * Add settings link to plugin list table
	 * @param  array $links Existing links
	 * @return array 		Modified links
	 */
	public function add_settings_link ( $links ) {
            $settings_link = '<a href="edit.php?post_type=forum&page=' . $this->parent->_token . '_settings">' . __( 'Settings', 'bbpress_advanced_statistics' ) . '</a>';
            array_push( $links, $settings_link );
            return $links;
	}

	/**
	 * Build settings fields
	 * @return array Fields to be displayed on settings page
	 */
	private function settings_fields () {

		$settings['standard'] = array(
			'title'					=> __( 'Basic Settings', 'bbpress-advanced-statistics' ),
			'description'			=> __( 'Basic Settings for the plugin changing various aspects', 'bbpress-advanced-statistics' ),
			'fields'				=> array(
				array(
					'id' 			=> 'user_inactivity_time',
					'label'			=> __( 'User Active Time' , 'bbpress-advanced-statistics' ),
					'description'	=> __( 'The amount of time before a user is marked as inactive, default = 15 minutes.', 'bbpress-advanced-statistics' ),
					'type'			=> 'number',
					'default'		=> '15',
					'placeholder'	=> __( '15', 'bbpress-advanced-statistics' ),
                                        'class'         => ''
				),
                                array(
                                            'id' 			=> 'user_activity_time',
                                            'label'			=> __( 'Active users' , 'bbpress-advanced-statistics' ),
                                            'description'	=> __( 'The amount of time to go back when listing activity, default = 24 hours.', 'bbpress-advanced-statistics' ),
                                            'type'			=> 'number',
                                            'default'		=> '24',
                                            'placeholder'	=> __( '24', 'bbpress-advanced-statistics' ),
                                            'class'         => ''
                                    ),
				array(
					'id' 			=> 'last_user',
					'label'			=> __( 'Latest Registered user', 'bbpress-advanced-statistics' ),
					'description'	=> __( 'Display the latest user to register to the site?', 'bbpress-advanced-statistics' ),
					'type'			=> 'checkbox',
					'default'		=> '',
                                        'class'         => ''
				),
				array(
					'id' 			=> 'bbpress_statistics',
					'label'			=> __( 'bbPress Statistics', 'bbpress-advanced-statistics' ),
					'description'	=> __( 'Display the bbPress Statistics?', 'bbpress-advanced-statistics' ),
					'type'			=> 'checkbox',
					'default'		=> 'on',
                                        'class'         => ''
				),
                                array(
                                        'id' 			=> 'bbpress_statistics',
                                        'label'			=> __( 'bbPress Statistics', 'bbpress-advanced-statistics' ),
                                        'description'	=> __( 'Display the bbPress Statistics?', 'bbpress-advanced-statistics' ),
                                        'type'			=> 'checkbox',
                                        'default'		=> 'on',
                                        'class'         => ''
                                )
			)
		);
                
                $settings['style'] = array(
			'title'					=> __( 'Customisation Settings', 'bbpress-advanced-statistics' ),
			'description'			=> __( 'Some Customisation Options to enable more user control over the plugin', 'bbpress-advanced-statistics' ),
			'fields'				=> array(
				array(
					'id' 			=> 'title_text_currently_active',
					'label'			=> __( 'Users Currently Active' , 'bbpress-advanced-statistics' ),
					'description'	=> __( 'You are able to set a different text string instead of the default "Users Currently Active", use %MINS% to display the minutes set. %COUNT_ACTIVE_USERS% will display the amount of users currently active', 'bbpress-advanced-statistics' ),
					'type'			=> 'text',
					'default'		=> 'Users Currently Active',
					'placeholder'	=> __( 'Users Currently Active', 'bbpress-advanced-statistics' ),
                                        'class'         => 'regular-text'
				),
                array(
					'id' 			=> 'title_text_last_x_hours',
					'label'			=> __( 'Last 24 Hours' , 'bbpress-advanced-statistics' ),
					'description'	=> __( 'You are able to set the string of text displayed for the users active in the time period set, use %HOURS% for the timeframe selected. %COUNT_ALL_USERS% will display the amount of users active', 'bbpress-advanced-statistics' ),
					'type'			=> 'text',
					'default'		=> 'Members active in the past %HOURS% hours',
					'placeholder'	=> __( 'Members active in the past %HOURS% hours', 'bbpress-advanced-statistics' ),
                                        'class'         => 'regular-text'
				),
				array(
					'id' 			=> 'before_forum_display',
					'label'			=> __( 'Before Stats Display', 'bbpress-advanced-statistics' ),
					'description'	=> __( 'If you are not using the shortcode, you may want to define some additional code here to be displayed <strong>before</strong> the statistics', 'bbpress-advanced-statistics' ),
					'type'			=> 'text',
					'default'		=> '<h2>Forum Statistics</h2>',
					'class'         => 'regular-text'
				),
				array(
					'id' 			=> 'after_forum_display',
					'label'			=> __( 'After Stats Display', 'bbpress-advanced-statistics' ),
					'description'	=> __( 'If you are not using the shortcode, you may want to define some additional code here to be displayed <strong>after</strong> the statistics', 'bbpress-advanced-statistics' ),
					'type'			=> 'text',
					'default'		=> '',
					'class'         => 'regular-text'
				),
				array(
					'id' 			=> 'forum_display_option',
					'label'			=> __( 'Location of Statistics', 'bbpress-advanced-statistics' ),
					'description'	=> __( 'Define where you would like the statistics to be placed. If you prefer to use the shortcode, leave these options unchecked.', 'bbpress-advanced-statistics' ),
					'type'			=> 'checkbox_multi',
					'options'		=> array( 'after_forums_index' => 'After Forums Index', 'after_topics_index' => 'After Topics Index', 'after_single_topic' => 'After Single Topic', 'after_single_forum' => 'After Single Forum / Category' ),
					'default'		=> ''
				),
			)
		);

		$settings = apply_filters( $this->parent->_token . '_settings_fields', $settings );

		return $settings;
	}
        
        public function get_current_tab() {
            
            $current_tab = "";
            
            if ( isset( $_POST['tab'] ) && $_POST['tab'] ) {
                $current_tab = $_POST['tab'];
            } else {
                if ( isset( $_GET['tab'] ) && $_GET['tab'] ) {
                    $current_tab = $_GET['tab'];
                } else {
                    $current_tab = "standard";
                }
            }
            
            return $current_tab;
        }

	/**
	 * Register plugin settings
	 * @return void
	 */
	public function register_settings () {
		if ( is_array( $this->settings ) ) {

                    // Check posted/selected tab
                    $current_section = $this->get_current_tab();

                    foreach ( $this->settings as $section => $data ) {

                            if ( $current_section && $current_section != $section ) continue;

                            // Add section to page
                            add_settings_section( $section, $data['title'], array( $this, 'settings_section' ), $this->parent->_token . '_settings' );

                            foreach ( $data['fields'] as $field ) {

                                    // Validation callback for field
                                    $validation = '';
                                    if ( isset( $field['callback'] ) ) {
                                            $validation = $field['callback'];
                                    }

                                    // Register field
                                    $option_name = $this->base . $field['id'];
                                    register_setting( $this->parent->_token . '_settings', $option_name, $validation );

                                    // Add field to page
                                    add_settings_field( $field['id'], $field['label'], array( $this->parent->admin, 'display_field' ), $this->parent->_token . '_settings', $section, array( 'field' => $field, 'prefix' => $this->base ) );
                            }

                            if ( ! $current_section ) break;
			}
		}
	}

	public function settings_section ( $section ) {
            $html = '<p> ' . $this->settings[ $section['id'] ]['description'] . '</p>' . "\n";
            echo $html;
	}
        
        public function return_message( $class, $message ) {
            return "<div class=\"{$class} settings-error notice is-dismissible\"><p>{$message}</p></div>";
        }
        
	/**
	 * Load settings page content
	 * @return void
	 */
	public function settings_page () {
                        
		// Build page HTML
		$html = '<div class="wrap" id="' . $this->parent->_token . '_settings">' . "\n";
			$html .= '<h2>' . __( 'bbPress Advanced Statistics' , 'bbpress-advanced-statistics' ) . '</h2>' . "\n";

			$tab = $this->get_current_tab();

			// Show page tabs
			if ( is_array( $this->settings ) && 1 < count( $this->settings ) ) {

				$html .= '<h2 class="nav-tab-wrapper">' . "\n";
                               
				$c = 0;
				foreach ( $this->settings as $section => $data ) {

					// Set tab class
					$class = 'nav-tab';
					if ( ! isset( $_GET['tab'] ) ) {
						if ( 0 == $c ) {
							$class .= ' nav-tab-active';
						}
					} else {
						if ( isset( $_GET['tab'] ) && $section == $_GET['tab'] ) {
							$class .= ' nav-tab-active';
						}
					}

					// Set tab link
					$tab_link = add_query_arg( array( 'tab' => $section ) );
					if ( isset( $_GET['settings-updated'] ) ) {
						$tab_link = remove_query_arg( 'settings-updated', $tab_link );
					}

					// Output tab
					$html .= '<a href="' . $tab_link . '" class="' . esc_attr( $class ) . '">' . esc_html( $data['title'] ) . '</a>' . "\n";

					++$c;
				}

				$html .= '</h2>' . "\n";
			}
                                                
			$html .= '<form method="post" action="options.php" id="' . $tab . '" enctype="multipart/form-data">' . "\n";

				// Get settings fields
				ob_start();
				settings_fields( $this->parent->_token . '_settings' );
				do_settings_sections( $this->parent->_token . '_settings' );
                                
				$html .= ob_get_clean();

				$html .= '<p class="submit">' . "\n";
					$html .= '<input type="hidden" name="tab" value="' . esc_attr( $tab ) . '" />' . "\n";
					$html .= '<input name="submit-'. $tab .'" type="submit" class="button-primary" value="' . esc_attr( __( 'Save Settings' , 'bbpress-advanced-statistics' ) ) . '" />' . "\n";
				$html .= '</p>' . "\n";
			$html .= '</form>' . "\n";
		$html .= '</div>' . "\n";

		echo $html;
	}
       
        /**
	 * Main bbPress_Advanced_Statistics_Settings Instance
	 *
	 * Ensures only one instance of bbPress_Advanced_Statistics_Settings is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see bbPress_Advanced_Statistics()
	 * @return Main bbPress_Advanced_Statistics_Settings instance
	 */
	public static function instance ( $parent ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $parent );
		}
		return self::$_instance;
	} // End instance()

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->parent->_version );
	} // End __clone()

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->parent->_version );
	} // End __wakeup()

}