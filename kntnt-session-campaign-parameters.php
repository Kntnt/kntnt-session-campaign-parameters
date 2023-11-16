<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Kntnt Session Campaign Parameters
 * Plugin URI:        https://github.com/Kntnt/kntnt-session-campaign-parameters
 * Description:       Provides API to retrieve Google or Matomo campaign parameters (i.e. UTM or MTM, respectively) sent during current session.
 * Version:           1.0.0
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace Kntnt\Session_Campaign_Parameters;

defined( 'ABSPATH' ) || die;

function parameters() {

	return apply_filters( 'kntnt-session-campaign-parameters', [

		// Google UTM parameters
		'utm_source',
		'utm_medium',
		'utm_campaign',
		'utm_id',
		'utm_term',
		'utm_content',

		// Matomo MTM parameters
		'mtm_campaign',
		'mtm_cid',
		'mtm_content',
		'mtm_group',
		'mtm_kwd',
		'mtm_medium',
		'mtm_placement',
		'mtm_source',

	] );

}

function get( string ...$params ) {

	// Resume PHP session.
	_initialize();

	// Default to all parameters.
	if ( ! $params ) {
		$params = parameters();
	}

	// Extract values from requested parameters.
	$vars = array_intersect_key( $_SESSION, array_flip( $params ) );

	// Arrange the values as described in the README file.
	$vars = count( $params ) == 1 ? ( $vars[ $params[0] ] ?? null ) : array_replace( array_fill_keys( $params, '' ), $vars );

	return $vars;

}

function _initialize() {

	// Start or resume PHP session.
	@session_start();

	// $_SESSION is not created automatically.
	if ( ! isset( $_SESSION ) ) {
		$_SESSION = [];
	}

}

// Save any campaign parameters after all plugins are loaded, to allow
// implementation of the `kntnt-session-campaign-parameters` filter with code
// snippet plugins, and before the theme is loaded, to allow calling
// the `get()` function in functions.php.
add_action( 'setup_theme', function () {

	if ( $params = array_intersect_key( $_GET, array_flip( parameters() ) ) ) {

		// Start PHP session.
		_initialize();

		// Save values of all managed paramters that are present in the URL.
		$_SESSION = array_merge( $_SESSION, $params );

	}

} );
