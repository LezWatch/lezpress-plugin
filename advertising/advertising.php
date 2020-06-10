<?php
/*
Global Advertising code used by pretty much everyone on LezWatch/Press
Author: Mika Epstein
*/

class LP_Advertising {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
		add_filter( 'widget_text', 'do_shortcode' );
	}

	/**
	 * Init
	 */
	public function init() {
		add_shortcode( 'affiliates', array( $this, 'affiliates' ) );
	}

	/*
	 * Display Affiliate Ads
	 *
	 * Usage: [affiliates type={random|facetwp|liquidweb} size={heightxwidth}]
	 *
	 * Currently all ads are 300x250 for ... reasons
	 *
	 * @since 1.0
	*/

	public function affiliates( $atts ) {

		$attr = shortcode_atts(
			array(
				'type' => 'random',
				'size' => '300x250',
			),
			$atts
		);

		$type = sanitize_text_field( $attr['type'] );
		$size = sanitize_text_field( $attr['size'] );

		$valid_sizes = array( '300x250' );
		$valid_types = array( 'facetwp', 'liquidweb', 'yikes' );

		if ( 'random' === $type || ! in_array( $type, $valid_types ) ) {
			$type = $valid_types [ array_rand( $valid_types ) ];
		}

		if ( ! in_array( $size, $valid_sizes ) ) {
			$size = '300x250';
		}

		$facetwp = array(
			'300x250' => '<a href="https://facetwp.com/?ref=91&campaign=LezPress"><img src="' . plugins_url( 'images/facetwp-300x250.png', __FILE__ ) . '"></a>',
		);

		$dreamhost = array(
			'300x250' => '<a href="https://dreamhost.com/dreampress/"><img src="' . plugins_url( 'images/dreamhost-300x250.png', __FILE__ ) . '"></a>',
		);

		$yikes = array(
			'300x250' => '<a href="https://www.yikesinc.com"><img src="' . plugins_url( 'images/yikes-300x250.png', __FILE__ ) . '"></a>',
		);

		$advert = '<!-- BEGIN Affiliate Ads --><div class="affiliate-ads ' . sanitize_html_class( $attr['type'] ) . '">';

		switch ( $type ) {
			case 'genesis':
				$advert .= $genesis[ $size ];
				break;
			case 'facetwp':
				$advert .= $facetwp[ $size ];
				break;
			case 'dreamhost':
				$advert .= $dreamhost[ $size ];
				break;
			default:
				$advert .= $yikes[ $size ];
		}

		$advert .= '</div><!-- END Affiliate Ads -->';

		return $advert;
	}

}

new LP_Advertising();
