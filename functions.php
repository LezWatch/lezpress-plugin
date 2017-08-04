<?php
/*
Plugin Name: Functions
Description: Special Functions
Version: 1.0.0
Author: Mika Epstein
*/

/*
 * File Includes
 */

include_once( dirname( __FILE__ ) . '/advertising/advertising.php' );

/**
 * class LezPressCom
 *
 * @since 2.0
 */
class LezPressCom {

	protected static $version;

	function __construct() {
		self::$version = '1.0.0';
		add_action( 'wp_enqueue_scripts', array( $this,  'wp_enqueue_scripts' ) );
	}

	/**
	 * Enqueue Scripts
	 */
	function wp_enqueue_scripts() {
		// Cat Signal
		wp_enqueue_script( 'cat-signal', '/wp-content/mu-plugins/assets/catsignal.js', array(), self::$version, true );
	}

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
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