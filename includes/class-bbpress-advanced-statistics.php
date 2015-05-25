<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class bbPress_Advanced_Statistics {

	/**
	 * The single instance of bbPress_Advanced_Statistics.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * Settings class object
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $settings = null;
        
        /**
	 * Online class object
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $online = null;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $_version;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $_token;

	/**
	 * The main plugin file.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $file;

	/**
	 * The main plugin directory.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $dir;

	/**
	 * The plugin assets directory.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $assets_dir;

	/**
	 * The plugin assets URL.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $assets_url;

	/**
	 * Suffix for Javascripts.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $script_suffix;
        
        /**
	 * Options from the DB
	 * @var     array
	 * @access  public
	 * @since   1.0.0
	 */
	public $options;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct ( $file = '', $version = '1.0.3' ) {
		$this->_version = $version;
		$this->_token = 'bbpress-advanced-statistics';

		// Load plugin environment variables
		$this->file = $file;
		$this->dir = dirname( $this->file );
		$this->assets_dir = trailingslashit( $this->dir ) . 'assets';
		$this->assets_url = esc_url( trailingslashit( plugins_url( '/assets/', $this->file ) ) );

		$this->script_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		register_activation_hook( $this->file, array( $this, 'install' ) );

		// Load frontend JS & CSS
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 10 );

		// Load API for generic admin functions
		if ( is_admin() ) {
                    $this->admin = new bbPress_Advanced_Statistics_Admin_API();
		}
                
                // Load our options
                $this->setDefaultOptions( false );
                
                
	} // End __construct ()
        
	/**
	 * Load frontend CSS.
	 * @access  public
	 * @since   1.0.0
	 * @return void
	 */
	public function enqueue_styles () {
		wp_register_style( $this->_token . '-frontend', esc_url( $this->assets_url ) . 'css/frontend.css', array(), $this->_version );
		wp_enqueue_style( $this->_token . '-frontend' );
	} // End enqueue_styles ()
        
        /**
         * Set default options
         * @access public
         * @since 1.0.3
         * @param bool $install
         */
        
        public function setDefaultOptions( $install ) {
            $this->setOptions( array("user_inactivity_time" => 15, 
                    "user_activity_time" => 24,
                    "last_user" => "on",
                    "bbpress_statistics" => "on",
                    "title_text_currently_active" => "Members Currently Active: %COUNT_ACTIVE_USERS%",
                    "title_text_last_x_hours" => "Members active within the past %HOURS% hours: %COUNT_ALL_USERS%",
                    "forum_display_option" => "",
                    "before_forum_display" => "<h2>Forum Statistics</h2>",
                    "after_forum_display" => ""), $install );
        }

	/**
         * Set options for the session
         * @access public
         * @since 1.0.0
         * @param array $options
         * @param bool $install
         */
        
        public function setOptions( $options, $install )
        {
            foreach( $options as $key => $default )
            {
                if( $install == true )
                {
                    if( !get_option( $this->_token . '-' .  $key ) )
                    {
                        update_option( $this->_token . '-' .  $key, $default );
                    }
                } else {
                    $this->option[ $key ] = get_option( $this->_token . '-' .  $key );
                }
            }
        }
                
	/**
	 * Main bbPress_Advanced_Statistics Instance
	 *
	 * Ensures only one instance of bbPress_Advanced_Statistics is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see bbPress_Advanced_Statistics()
	 * @return Main bbPress_Advanced_Statistics instance
	 */
	public static function instance ( $file = '', $version = '1.0.3' ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $file, $version );
		}
		return self::$_instance;
	} // End instance ()

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
	} // End __clone ()

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
	} // End __wakeup ()

	/**
	 * Installation. Runs on activation.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function install () {
            if( !class_exists("bbpress") )
            {
                die("bbPress is required in order to use this plugin. Please install bbPress before continuing.");
            }
            
            $this->setDefaultOptions( true );
            
            $this->_log_version_number($this->_version);
	} // End install ()
        
	/**
	 * Log the plugin version number.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	private function _log_version_number ($version) {
            update_option( $this->_token . '-version', $version );
	} // End _log_version_number ()

}