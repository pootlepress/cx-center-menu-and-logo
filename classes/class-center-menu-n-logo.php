<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Pootlepress_Center_Menu_N_Logo Class
 *
 * Base class for the Pootlepress Center Menu and Logo Plugin
 *
 * @package WordPress
 * @subpackage pootlepress-center-menu-n-logo
 * @category Core
 * @author Pootlepress
 * @since 1.0.0
 *
 * TABLE OF CONTENTS
 *
 * public $token
 * public $version
 * private $_menu_style
 * 
 * - __construct()
 * - add_theme_options()
 * - load_localisation()
 * - check_plugin()
 * - load_plugin_textdomain()
 * - activation()
 * - register_plugin_version()
 * - load_center_mnl()
 */
class Pootlepress_Center_Menu_N_Logo {
	public $token = 'pootlepress-center-menu-n-logo';
	
	public $version;
	private $file;
	private $_menu_style;

	/**
	 * Constructor.
	 * @param string $file The base file of the plugin.
	 * @access public
	 * @since  1.0.0
	 * @return  void
	 */
	public function __construct ( $file ) {
		$this->file = $file;
		$this->load_plugin_textdomain();
		add_action( 'init','check_main_heading', 0 );
		add_action( 'init', array( &$this, 'load_localisation' ), 0 );

		// Run this on activation.
		register_activation_hook( $file, array( &$this, 'activation' ) );

		// Add the custom theme options.
		add_filter( 'option_woo_template', array( &$this, 'add_theme_options' ) );

		// Lood for a method/function for the selected style and load it.
		add_action('init', array( &$this, 'load_center_mnl' ) );
	} // End __construct()

	/**
	 * Add theme options to the WooFramework.
	 * @access public
	 * @since  1.0.0
	 * @param array $o The array of options, as stored in the database.
	 */	
	public function add_theme_options ( $o ) {
	
	$nameprefix = $this->token;
	
	$mls_domain = $this->token;
		$o[] = array(
				'name' => 'Center Menu & Logo', 
				'type' => 'subheading'
				);
		$o[] = array(
				'id' => $nameprefix."_center-logo-option", 
				'name' => __( 'Center Logo', $mls_domain ), 
				'desc' => __( 'Align the logo in the middle of the header.', $mls_domain ), 
				'std' => 'true',
				'type' => 'checkbox'
				);
		$o[] = array(
				
				'id' => $nameprefix."_center-navigation-option",
		 
		'name' => __( 'Center Primary Nav', $mls_domain ),
		 		'desc' => __( 'Center the primary navigation element.', $mls_domain ),
		 		'std' => 'true',
		 		'type' => 'checkbox'
		 		);
		$o[] = array(
				'id' => $nameprefix."_center-top-menu-option", 
				'name' => __( 'Center Top Nav', $mls_domain ), 
				'desc' => __( 'Center the top navigation menu.', $mls_domain ), 
				'std' => 'true',
				'type' => 'checkbox'
				);
		return $o;
	} // End add_theme_options()
	
	/**
	 * Load the plugin's localisation file.
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function load_localisation () {
		load_plugin_textdomain( $this->token, false, dirname( plugin_basename( $this->file ) ) . '/lang/' );
	} // End load_localisation()
	
	/**
	 * Load the plugin textdomain from the main WordPress "languages" folder.
	 * @access public
	 * @since  1.0.0
	 * @return  void
	 */
	public function load_plugin_textdomain () {
	    $domain = $this->token;
	    // The "plugin_locale" filter is also used in load_plugin_textdomain()
	    $locale = apply_filters( 'plugin_locale', get_locale(), $domain );
	 
	    load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
	    load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( $this->file ) ) . '/lang/' );
	} // End load_plugin_textdomain()

	/**
	 * Run on activation.
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function activation () {
		$this->register_plugin_version();
	} // End activation()

	/**
	 * Register the plugin's version.
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	private function register_plugin_version () {
		if ( $this->version != '' ) {
			update_option( $this->token . '-version', $this->version );
		}
	} // End register_plugin_version()

	/**
	 * Load the sticky nav files
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function load_center_mnl() {
		$nameprefix = $this->token;
		$_center_logo_enabled		= get_option($nameprefix."_center-logo-option");
		$_center_pri_nav_enabled	= get_option($nameprefix."_center-navigation-option");
		$_center_top_menu_enabled	= get_option($nameprefix."_center-top-menu-option");
				
		if ($_center_logo_enabled == 'true') {
			add_action('wp_head', 'center_logo_css');
			// add_action('wp_footer', 'stickyjs', 8);
			// add_action('woo_nav_before', 'navBefore');
		}
		if ($_center_pri_nav_enabled == 'true') {
			add_action('wp_head', 'center_nav_css');
		}
		if ($_center_top_menu_enabled == 'true') {
			add_action('wp_head', 'center_topmenu_css');
		}
	} // End load_center_mnl()
	

} // End Class


