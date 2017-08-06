<?php
/*
Plugin Name: LezPress.com Functions
Description: Special Functions
Version: 2.1.0
Author: Mika Epstein
*/

/*
 * File Includes
 */
include_once( dirname( __FILE__ ) . '/advertising/advertising.php' );
include_once( dirname( __FILE__ ) . '/wp-help.php' );

/**
 * class LezPressCom
 *
 * @since 2.0
 */
class LezPressCom {

	protected static $version;

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		self::$version = '1.0.0';
		add_action( 'wp_enqueue_scripts', array( $this,  'wp_enqueue_scripts' ) );
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Enqueue Scripts
	 */
	function wp_enqueue_scripts() {
		// Cat Signal
		wp_enqueue_script( 'cat-signal', '/wp-content/mu-plugins/assets/catsignal.js', array(), self::$version, true );
	}

	/**
	 * INIT function.
	 *
	 * @access public
	 * @return void
	 */
	function init() {

		// Filter genesis footer credits
		add_filter( 'genesis_footer_creds_text', function( $creds ) {
		    $creds = 'Copyright [footer_copyright first="2016"] <a href="https://lezpress.com">Lez Press</a> &middot; <a href="https://lezpress.com/terms-of-use/">Terms of Use</a> <br /> Powered by the <a href="http://www.shareasale.com/r.cfm?b=830048&u=728549&m=28169&urllink=&afftrack=">Showcase Pro Theme</a> on the <a href="http://www.shareasale.com/r.cfm?b=346198&u=728549&m=28169&urllink=&afftrack=">Genesis Framework</a>, [footer_wordpress_link], and <a href="https://www.dreamhost.com/dreampress">DreamPress Hosting</a> <br /> [footer_loginout]';
		    return $creds;
		}, 10, 2 );
	}
}


new LezPressCom();