<?php
/**
 * Shortcode Tribe_Tickets_Rsvp_Protected_Content.
 *
 * @since   1.0.0
 * @package Tribe\Extensions\Tickets\Shortcodes
 */

namespace Tribe\Extensions\Tickets\Shortcodes\Shortcodes;

use Tribe__Tickets__Tickets as Tickets;
use Tribe__Tickets__Tickets_View as Tickets_View;
use Tribe__Utils__Array as Utils__Array;
use WP_Post;

/**
 * Class for Shortcode Tribe_Tickets_Rsvp_Protected_Content.
 *
 * @since   1.0.0
 * @package Tribe\Extensions\Tickets\Shortcodes\Shortcodes
 */
class Tribe_Tickets_Rsvp_Protected_Content extends Shortcode_Abstract {

	/**
	 * {@inheritDoc}
	 */
	protected $slug = 'tribe_tickets_rsvp_protected_content';

	/**
	 * {@inheritDoc}
	 */
	protected $default_arguments = [
		'post_id'  => null,
		'rsvp_ids' => null,
		'rsvpd'    => 1,
	];

	/**
	 * {@inheritDoc}
	 */
	public function get_html() {
		$post_id  = $this->get_argument( 'post_id' );
		$rsvp_ids = Utils__Array::list_to_array( $this->get_argument( 'rsvp_ids' ) );
		$rsvpd    = filter_var( $this->get_argument( 'rsvpd' ), FILTER_VALIDATE_BOOLEAN );

		$post = get_post( $post_id );

		if ( ! $post instanceof WP_Post ) {
			return '';
		}

		$user_id = is_user_logged_in() ? get_current_user_id() : 0;

		// No content to show for someone who is not logged in.
		if ( $rsvpd && 0 === $user_id ) {
			return '';
		}

		$tickets_view = Tickets_View::instance();

		if ( empty( $rsvp_ids ) ) {
			$has_ticket_attendees = $tickets_view->has_rsvp_attendees( $post_id, $user_id );
		} else {
			$has_ticket_attendees = (boolean) Tickets::get_event_attendees_count( $post_id, [
				'by' => [
					'user'   => $user_id,
					'ticket' => $rsvp_ids,
				],
			] );
		}

		// Limited to RSVP'd users; User is not RSVP'd, show nothing.
		if ( $rsvpd && ! $has_ticket_attendees ) {
			return '';
		}

		// Limited to non-RSVP'd users; User is RSVP'd, show nothing.
		if ( ! $rsvpd && $has_ticket_attendees ) {
			return '';
		}

		// Return content with shortcodes processed (support embedded shortcodes).
		return do_shortcode( $this->content );
	}

}
