<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class bbPress_Advanced_Statistics_Online {

	/**
	 * The single instance of bbPress_Advanced_Statistics_Online.
	 * @var 	object
	 * @access      private
	 * @since 	1.0.0
	 */
	private static $_instance = null;
        
        /**
	 * The current user's ID
	 * @var         int
	 * @access      private
	 * @since       1.0.0
	 */
	private $_userID = 0;
        
        /**
	 * The options set up for the app
	 * @var         int
	 * @access      private
	 * @since       1.0.0
	 */
	private $_options = [];

	/**
	 * Constructor function.
	 * @access      public
	 * @since       1.0.0
	 * @return      void
	 */
	public function __construct ( $parent ) {
            
            $this->parent = $parent;
            
            // Set the user data we need
            add_action('init', array( $this, 'setUserData' ), 10 );
           
            add_action( 'template_redirect', array( $this, 'userActivity' ), 10 );            
            add_action( 'wp_login', array( $this, 'userLoggedIn' ), 10 );    
            add_action( 'clear_auth_cookie', array( $this, 'userLoggedOut' ), 10 );
            
            add_shortcode("bbpas-activity", array( $this, "shortcode_activity" ) );
            
            // Temporarily enable shortcodes within widgets
            add_filter('widget_text', 'do_shortcode');
            
	} // End __construct ()
        
	/**
	 * Main bbPress_Advanced_Statistics_Online Instance
	 *
	 * Ensures only one instance of bbPress_Advanced_Statistics_Online is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see bbPress_Advanced_Statistics()
	 * @return Main bbPress_Advanced_Statistics_Online instance
	 */
	public static function instance ( $file = '', $version = '1.0.0' ) {
		if ( is_null( self::$_instance ) ) {
                    self::$_instance = new self( $file, $version );
		}
		return self::$_instance;
	} // End instance ()
        
        
        /**
         * update_lastactivity
         * 
         * Updates the DB value for the user id passed, uses WP's current_time
         * functionality
         * 
         * @since 1.0.0
         * @param int $userID
         * 
         * @return void
         */
        
        public function update_lastactivity( $userID ) {
            if( is_user_logged_in() && !is_null( $userID ) )
            {
                update_user_meta( $userID, 'bbpress-advanced-statistics_lastactivity', current_time('timestamp') );
                $this->update_status( $userID, true );
            }
        }
        
        /**
         * update_status
         * 
         * Small function that will update the status of a user. 
         * 
         * @since 1.0.0
         * @param int $userID
         * @param string $status
         * 
         * @return void
         */
        
        public function update_status( $userID, $status ) {
            if( !is_null( $userID ) && $userID !== 0 && !is_null( $status ) ) {
                $status = (( $status == true ) ? 1 : 0 );
                update_user_meta( $userID, 'bbpress-advanced-statistics_status', $status );
            }
        }
        
        /**
         * userLoggedOut
         * 
         * Hooked into clear_auth_cookie, wp_logout is too late as we need to
         * retain the ID to set the correct flag with the db. 
         * 
         * @since 1.0.0
         * 
         * @return void
         */
        
        public function userLoggedOut()
        {
            $this->update_status( $this->_userID, false );
        }
        
        /**
         * userLoggedIn
         * 
         * WordPress hook wp_login is too early to grab the user ID via conventional
         * methods, so here we are fetching the user's id using the WP_User data
         * generated upon logging in.
         * 
         * @since 1.0.0
         * @param WP_User $login
         * 
         * @return void
         */
        public function userLoggedIn( $login ) {
            $user = get_user_by( 'login' , $login );
            $this->update_status( reset($user)->ID, true );
        }
        
        /**
         * userActivity
         * 
         * Hooked into template_redirect to be run each time the user
         * changes the page, simply runs the update_lastactivity function 
         * 
         * @since 1.0.0
         * 
         * @return void
         */
        public function userActivity()
        {
            $this->update_lastactivity( $this->_userID );
        }
        
        /**
         * setUserData
         * 
         * Sets up the required user data for us, hooked into init. 
         * 
         * @since 1.0.0
         * 
         * @return void
         */
	public function setUserData()
        {
            $this->_userID = wp_get_current_user()->ID;
        }
        
        
        /**
         * Start building up the array of users online
         * @access public
         * @since 1.0.0
         * @return string
         */
        public function whois_online() {

            $users = $this->fetchActiveUsers();

            foreach( $users as $user ) {

                $user_lastactivity = get_user_meta( $user->ID, $this->parent->_token . '_lastactivity', true );
                $user_onlinestatus = get_user_meta( $user->ID, $this->parent->_token . '_status', true );

                $current_user = $this->get_user_link( $user_lastactivity, $user );        

                // The user will always appear in the inactive section
                $markup['inactive'][] = '<span class="bbp-topic-freshness-author '. strtolower(bbp_get_user_display_role( $user->ID, $user->user_nicename )) . '"><a id="bbpress-advanced-statistics-' . $user->ID . '">' . $current_user . '</a></span>';

                if( $user_lastactivity > ( current_time('timestamp') - $this->parent->option['user_activity_time'] ) && $user_onlinestatus == 1 )
                {
                    $markup['active'][] = '<span class="bbp-topic-freshness-author '. strtolower(bbp_get_user_display_role( $user->ID, $user->user_nicename )) . '"><a id="bbpress-advanced-statistics-' . $user->ID . '">' . $current_user . '</a></span>';
                } else {
                    $this->update_status( $user->ID, false );
                }
            }

            return ( ( isset( $markup ) ? $markup : false ) );
        }
        
        /**
         * Return a user's value within the online users widget, alongside their
         * profile link
         * 
         * @param string $last_activity
         * @param WP_USer $user
         * @since 1.0.0
         * @return string
         */
        private function get_user_link( $last_activity, $user ) {
            $name = $user->user_login; 
            $nicetime = (( $last_activity <= current_time('timestamp') ) ? human_time_diff( $last_activity, current_time('timestamp') ) . " ago" : date_i18n( "D-m-y H:i", $last_activity ) );
            $link = '<a href="' . bbp_get_user_profile_url( $user->ID ) . '" title="Last seen: ' . $nicetime . '">' . $name . '</a>';

            return $link;
        }
        
        /**
         * Fetches the currently active users
         * @since 1.0.0
         * @param array $args
         * @return WP_User object
         */
        private function fetchActiveUsers( $args = array() )
        {
            $args = wp_parse_args( $args, array(
                'meta_key' => $this->parent->_token . '_lastactivity',
                'meta_value' => ( current_time('timestamp') - ( ( $this->parent->option['user_activity_time'] * 60 ) * 60 ) ), 
                'meta_compare' => '>',
                'count_total' => false,
            ));
            
            return get_users( $args );
        }
        
        /**
         * Creates the [bbpas-activity] shortcode content
         * @access public
         * @since 1.0.0
         * @return string
         */
        public function shortcode_activity()
        {
            $content = $this->whois_online();
            
            $bbPress_stats = bbp_get_statistics();
            $markup = false;

            // Fetch the last registered user
            $latest_user = get_users(
                array(
                    'number' => 1,
                    'fields' => array("user_login", "ID"),
                    'orderby' => "registered",
                    'order' => "DESC"
                )
            );
            
            $latest_user = reset( $latest_user );
            
            if( $content == false )
            {
                return "An error has occurred.";
            } else {
            
            $HTMLOutput["active"] = $this->shortcode_tool_build_title( esc_html( $this->parent->option['title_text_currently_active'] ), false );
            
            if( isset( $content["active"] ) )
            {
                foreach( $content["active"] as $key => $value )
                {
                    $HTMLOutput["active"] .= $content["active"][$key] . (($content["active"][$key] === end($content["active"])) ? "" : ", " );
                }
            } else {
                $HTMLOutput["active"] .= "No data to display";
            }
            
            $HTMLOutput["inactive"] = $this->shortcode_tool_build_title( str_replace( "%HOURS%", $this->parent->option['user_activity_time'], esc_html( $this->parent->option['title_text_last_x_hours'] ) ), false ); 
            
            if( isset( $content['inactive'] ) )
            {
                foreach( $content["inactive"] as $key => $value )
                {
                    $HTMLOutput["inactive"] .= $content["inactive"][$key] . (($content["inactive"][$key] === end($content["inactive"])) ? "" : ", " );
                }
            } else {
                $HTMLOutput["inactive"] .= "No data to display";
            }
            
            if( $this->parent->option['bbpress_statistics'] == "on" || $this->parent->option['last_user'] == "on")
            {
                $HTMLOutput["forum_stats"] = $this->shortcode_tool_build_title( "Forum Statistics", false );
                if( $this->parent->option['bbpress_statistics'] == "on" ) {
                    $HTMLOutput["forum_stats"] .= "Threads: {$bbPress_stats['topic_count']}, Posts: {$bbPress_stats['reply_count']}, Members: {$bbPress_stats['user_count']}<br>";
                }
                
                if( $this->parent->option['last_user'] == "on" ) {
                    $HTMLOutput["forum_stats"] .= "Welcome to our newest member, <a href=\"" . bbp_get_user_profile_url( $latest_user->ID ) . "\">" . $latest_user->user_login . "</a>";
                }
            }
            
            foreach($HTMLOutput as $key => $html ) {
                $markup .= $html;
            }
            
            return ( ( isset( $markup ) ? $markup : "An error has occurred" ) );
            }
        }
        
        /**
         * Forms the bbpas header
         * @param string $title
         * @param string $link
         * @return string 
         */
        function shortcode_tool_build_title( $title, $link)
        {
            return '<div class="bbpas-header">' . (( $link == false ) ? $title : '<a href="'.$link.'">'.$title.'</a>' ). '</div>';
        }
}