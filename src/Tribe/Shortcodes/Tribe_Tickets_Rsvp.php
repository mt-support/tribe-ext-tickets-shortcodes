<?php
/**
 * Shortcode Tribe_Tickets_Rsvp.
 *
 * @package Tribe\Extensions\Tickets\Shortcodes
 * @since   1.0.0
 */
namespace Tribe\Extensions\Tickets\Shortcodes\Shortcodes;

/**
 * Class for Shortcode Tribe_Tickets_Rsvp.
 * @since   1.0.0
 * @package Tribe\Extensions\Tickets\Shortcodes\Shortcodes
 */
class Tribe_Tickets_Rsvp extends Shortcode_Abstract {

	/**
	 * {@inheritDoc}
	 */
	protected $slug = 'tribe_tickets_rsvp';

	/**
	 * {@inheritDoc}
	 */
	protected $default_arguments = [
		'post_id'           => null,
	];

	/**
	 * {@inheritDoc}
	 */
	public function get_html() {
		$context = tribe_context();

		if ( is_admin() && ! $context->doing_ajax() ) {
			return '';
		}

		$post_id = $this->get_argument( 'post_id' );

		return $this->get_rsvp_block( $post_id );
	}

	/**
	 * Gets the block template and return it.
	 *
	 * @param WP_Post|int $post the post/event we're viewing.
	 *
	 * @return string HTML.
	 */
	public function get_rsvp_block( $post ) {

		if ( empty( $post ) ) {
			return '';
		}

		if ( is_numeric( $post ) ) {
			$post = get_post( $post );
		}

		// if password protected then do not display content
		if ( post_password_required() ) {
			return '';
		}

		$post_id     = $post->ID;
		/** @var Tribe__Tickets__Editor__Template $template */
		$template                 = tribe( 'tickets.editor.template' );
		$args['post_id']          = $post_id;
		$rsvps                    = $this->get_rsvps( $post_id );
		$args['active_rsvps']     = $this->get_active_tickets( $rsvps );
		$args['has_active_rsvps'] = ! empty( $args['active_rsvps'] );
		$args['has_rsvps']        = ! empty( $rsvps );
		$args['all_past']         = $this->get_all_tickets_past( $rsvps );

		// Add the rendering attributes into global context.
		$template->add_template_globals( $args );

		// enqueue assets.
		tribe_asset_enqueue( 'tribe-tickets-gutenberg-rsvp' );
		tribe_asset_enqueue( 'tribe-tickets-gutenberg-block-rsvp-style' );

		return $template->template( 'blocks/rsvp', $args, false );
	}

	/**
	 * Method to get all RSVP tickets
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	protected function get_rsvps( $post_id ) {
		$tickets = [];

		// Bail if there's no event id
		if ( ! $post_id ) {
			return $tickets;
		}

		// Get the tickets IDs for this event
		$ticket_ids = tribe( 'tickets.rsvp' )->get_tickets_ids( $post_id );

		// Bail if we don't have tickets
		if ( ! $ticket_ids ) {
			return $tickets;
		}

		foreach ( $ticket_ids as $post ) {
			// Get the ticket
			$ticket = tribe( 'tickets.rsvp' )->get_ticket( $post_id, $post );

			// Continue if is not RSVP, we only want RSVP tickets
			if ( 'Tribe__Tickets__RSVP' !== $ticket->provider_class ) {
				continue;
			}

			$tickets[] = $ticket;
		}

		return $tickets;
	}

	/**
	 * Method to get the active RSVP tickets
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	protected function get_active_tickets( $tickets ) {
		$active_tickets = [];

		foreach ( $tickets as $ticket ) {
			// continue if it's not in date range
			if ( ! $ticket->date_in_range() ) {
				continue;
			}

			$active_tickets[] = $ticket;
		}

		return $active_tickets;
	}

	/**
	 * Method to get the all RSVPs past flag
	 * All RSVPs past flag is true if all RSVPs end date is earlier than current date
	 * If there are no RSVPs, false is returned
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	protected function get_all_tickets_past( $tickets ) {
		if ( empty( $tickets ) ) {
			return false;
		}

		$all_past = true;

		foreach ( $tickets as $ticket ) {
			$all_past = $all_past && $ticket->date_is_later();
		}

		return $all_past;
	}

}
