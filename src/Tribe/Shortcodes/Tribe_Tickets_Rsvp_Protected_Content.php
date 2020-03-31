<?php
/**
 * Shortcode Tribe_Tickets_Rsvp_Protected_Content.
 *
 * @since   1.0.0
 * @package Tribe\Extensions\Tickets\Shortcodes
 */

namespace Tribe\Extensions\Tickets\Shortcodes\Shortcodes;

use Tribe\Extensions\Tickets\Shortcodes\Shortcodes\Traits\Protected_Content;

/**
 * Class for Shortcode Tribe_Tickets_Rsvp_Protected_Content.
 *
 * @since   1.0.0
 * @package Tribe\Extensions\Tickets\Shortcodes\Shortcodes
 */
class Tribe_Tickets_Rsvp_Protected_Content extends Shortcode_Abstract {

	use Protected_Content;

	/**
	 * {@inheritDoc}
	 */
	protected $slug = 'tribe_tickets_rsvp_protected_content';

	/**
	 * {@inheritDoc}
	 */
	protected $default_arguments = [
		'post_id'      => null,
		'rsvp_ids'     => null,
		'not_rsvp_ids' => null,
		'on'           => null,
		'type'         => 'rsvp',
		'rsvpd'        => 1,
	];

	/**
	 * {@inheritDoc}
	 */
	public function get_html() {
		$args = $this->get_arguments();

		// Mapping of arguments to expected argument names.
		$mapping = [
			'rsvp_ids'     => 'ticket_ids',
			'not_rsvp_ids' => 'not_ticket_ids',
			'rsvpd'        => 'ticketed',
		];

		// Handle mapping arguments.
		foreach ( $mapping as $from => $to ) {
			$args[ $to ] = $args[ $from ];

			unset( $args[ $from ] );
		}

		// Let the trait know what called this.
		$args['context'] = $this->get_registration_slug();

		// Can they see the content?
		if ( ! $this->can_see_content( $args ) ) {
			return '';
		}

		// Return content with shortcodes processed (support embedded shortcodes).
		return do_shortcode( $this->content );
	}

}
