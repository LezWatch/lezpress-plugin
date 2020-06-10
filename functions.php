<?php
/*
 * Plugin Name: LezPress.com Functions
 * Description: Special Functions
 * Version: 3.1.0
 * Author: Mika Epstein
*/

/*
 * File Includes
 */
require_once dirname( __FILE__ ) . '/advertising/advertising.php';

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
	public function __construct() {
		self::$version = '3.0.0';
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Enqueue Scripts
	 */
	public function wp_enqueue_scripts() {
		$bootstrap = '4.1.1';
		wp_enqueue_style( 'lezpress-gdpr', plugins_url( '/inc/css/gdpr.css', __FILE__ ), '', self::$version, 'all' );
		wp_enqueue_script( 'bootstrap', plugins_url( '/inc/js/bootstrap.min.js', __FILE__ ), array( 'jquery' ), $bootstrap, 'all', true );
		wp_enqueue_script( 'lezpress-gdpr', plugins_url( '/inc/js/gdpr.js', __FILE__ ), array( 'bootstrap' ), self::$version, 'all', true );

	}

	/**
	 * INIT function.
	 *
	 * @access public
	 * @return void
	 */
	public function init() {
		// Footer
		add_action( 'wp_footer', array( $this, 'gdpr_footer' ), 5 );
	}

	/**
	 * Echo GDPR notice if users aren't logged in
	 * (logged in users alredy know what they're in for, yo)
	 */
	public function gdpr_footer() {
		if ( ! is_user_logged_in() ) {
			?>
			<div id="GDPRAlert" class="alert alert-info alert-dismissible fade collapse alert-gdpr" role="alert">
				We use cookies to personalize content, provide features, analyze traffic, and optimize advertising. By continuing to use this website, you agree to their use. For more information, you may review our <a href="/terms-of-use/">Terms of Use</a> and <a href="/terms-of-use/privacy/">Privacy Policy</a>.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<?php
		}
	}

}


new LezPressCom();
