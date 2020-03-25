<?php
/**
 * Shortcodes manager for the new views.
 *
 * @package Tribe\Events\Pro\Views\V2\Shortcodes
 * @since   1.0.0
 */
namespace Tribe\Extensions\Tickets\Shortcodes\Shortcodes;

/**
 * Class Shortcode Manager.
 * @since   1.0.0
 * @package Tribe\Extensions\Tickets\Shortcodes
 */
class Manager {
	/**
	 * Get the list of shortcodes available for handling.
	 *
	 * @since  1.0.0
	 *
	 * @return array An associative array of shortcodes in the shape `[ <slug> => <class> ]`
	 */
	public function get_registered_shortcodes() {
		$shortcodes = [
			'tribe_tickets'                        => Tribe_Tickets::class,
			'tribe_tickets_rsvp'                   => Tribe_Tickets_Rsvp::class,
			'tribe_tickets_attendees'              => Tribe_Tickets_Attendees::class,
			'tribe_tickets_protected_content'      => Tribe_Tickets_Protected_Content::class,
			'tribe_tickets_rsvp_protected_content' => Tribe_Tickets_Rsvp_Protected_Content::class,
		];

		/**
		 * Allow the registering of shortcodes into the our Pro plugin.
		 *
		 * @since  1.0.0
		 *
		 * @var array An associative array of shortcodes in the shape `[ <slug> => <class> ]`
		 */
		$shortcodes = apply_filters( 'tribe_tickets_shortcodes', $shortcodes );

		return $shortcodes;
	}

	/**
	 * Verifies if a given shortcode slug is registered for handling.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $slug Which slug we are checking if is registered.
	 *
	 * @return bool
	 */
	public function is_shortcode_registered( $slug ) {
		$registered_shortcodes = $this->get_registered_shortcodes();
		return isset( $registered_shortcodes[ $slug ] );
	}

	/**
	 * Verifies if a given shortcode class name is registered for handling.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $class_name Which class name we are checking if is registered.
	 *
	 * @return bool
	 */
	public function is_shortcode_registered_by_class( $class_name ) {
		$registered_shortcodes = $this->get_registered_shortcodes();
		return in_array( $class_name, $registered_shortcodes );
	}

	/**
	 * Add new shortcodes handler to catch the correct strings.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function add_shortcodes() {
		$registered_shortcodes = $this->get_registered_shortcodes();

		// Add to WordPress all of the registred Shortcodes
		foreach ( $registered_shortcodes as $shortcode => $class_name ) {
			add_shortcode( $shortcode, [ $this, 'handle' ] );
		}
	}

	/**
	 * Makes sure we are correctly handling the Shortcodes we manage.
	 *
	 * @since  1.0.0
	 *
	 * @param array  $arguments Set of arguments passed to the Shortcode at hand.
	 * @param string $content   Contents passed to the shortcode, inside of the open and close brackets.
	 * @param string $shortcode Which shortcode tag are we handling here.
	 *
	 * @return string
	 */
	public function handle( $arguments, $content, $shortcode ) {
		$registered_shortcodes = $this->get_registered_shortcodes();

		// Bail when we try to handle an unregistered shortcode (shouldn't happen)
		if ( ! $this->is_shortcode_registered( $shortcode ) ) {
			return false;
		}

		$instance = new $registered_shortcodes[ $shortcode ];
		$instance->setup( $arguments, $content );

		return $instance->get_html();
	}

}
