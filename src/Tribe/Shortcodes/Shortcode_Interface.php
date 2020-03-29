<?php
/**
 * The interface all shortcodes should implement.
 *
 * @since   1.0.0
 * @package Tribe\Extensions\Tickets\Shortcodes
 */

namespace Tribe\Extensions\Tickets\Shortcodes\Shortcodes;

/**
 * Interface Shortcode_Interface
 *
 * @since   1.0.0
 * @package Tribe\Extensions\Tickets\Shortcodes
 */
interface Shortcode_Interface {

	/**
	 * Returns the shortcode slug.
	 *
	 * The slug should be the one that will allow the shortcode to be built by the shortcode class by slug.
	 *
	 * @since  1.0.0
	 *
	 * @return string The shortcode slug.
	 */
	public function get_registration_slug();

	/**
	 * Configures the base variables for an instance of shortcode.
	 *
	 * @since  1.0.0
	 *
	 * @param array  $arguments Set of arguments passed to the Shortcode at hand.
	 * @param string $content   Contents passed to the shortcode, inside of the open and close brackets.
	 *
	 * @return void
	 */
	public function setup( $arguments, $content );

	/**
	 * Returns the arguments for the shortcode parsed correctly with defaults applied.
	 *
	 * @since 1.0.0
	 *
	 * @param array $arguments Set of arguments passed to the Shortcode at hand.
	 *
	 * @return array
	 */
	public function parse_arguments( $arguments );

	/**
	 * Returns the array of arguments for this shortcode after applying the validation callbacks.
	 *
	 * @since 1.0.0
	 *
	 * @param array $arguments Set of arguments passed to the Shortcode at hand.
	 *
	 * @return array
	 */
	public function validate_arguments( $arguments );

	/**
	 * Returns the array of callbacks for this shortcode's arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_validate_arguments_map();

	/**
	 * Returns a shortcode default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_default_arguments();

	/**
	 * Returns a shortcode arguments after been parsed.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_arguments();

	/**
	 * Returns a shortcode argument after been parsed.
	 *
	 * @since 1.0.0
	 *
	 * @param array $index   Which index we indent to fetch from the arguments.
	 * @param array $default Default value if it doesn't exist.
	 *
	 * @return array
	 * @uses  Tribe__Utils__Array::get For index fetching and Default.
	 *
	 */
	public function get_argument( $index, $default = null );

	/**
	 * Returns a shortcode HTML code.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_html();
}