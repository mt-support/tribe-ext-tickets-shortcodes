<?php
/**
 * Shortcode Tribe_Tickets.
 *
 * @since   1.0.0
 * @package Tribe\Extensions\Tickets\Shortcodes
 */

namespace Tribe\Extensions\Tickets\Shortcodes\Shortcodes;

use Tribe__Tickets__Tickets as Tickets;

/**
 * Class for Shortcode Tribe_Tickets.
 *
 * @since   1.0.0
 * @package Tribe\Extensions\Tickets\Shortcodes\Shortcodes
 */
class Tribe_Tickets extends Shortcode_Abstract {

	/**
	 * {@inheritDoc}
	 */
	protected $slug = 'tribe_tickets';

	/**
	 * {@inheritDoc}
	 */
	protected $default_arguments = [
		'post_id' => null,
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

		return $this->get_tickets_block( $post_id );
	}

	/**
	 * Gets the block template and return it.bg-darken-2
	 *
	 * @param WP_Post|int $post the post/event we're viewing.
	 *
	 * @return string HTML.
	 */
	public function get_tickets_block( $post ) {
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
		$provider_id = Tickets::get_event_ticket_provider( $post_id );

		// Protect against ticket that exists but is of a type that is not enabled
		if ( ! method_exists( $provider_id, 'get_instance' ) ) {
			return '';
		}

		$provider = call_user_func( [ $provider_id, 'get_instance' ] );

		/** @var \Tribe__Tickets__Editor__Template $template */
		$template = tribe( 'tickets.editor.template' );

		/** @var \Tribe__Tickets__Editor__Blocks__Tickets $blocks_tickets */
		$blocks_tickets = tribe( 'tickets.editor.blocks.tickets' );

		// Load assets manually.
		$blocks_tickets->assets();

		$tickets = $provider->get_tickets( $post_id );

		$args = [
			'post_id'             => $post_id,
			'provider'            => $provider,
			'provider_id'         => $provider_id,
			'tickets'             => $tickets,
			'cart_classes'        => [ 'tribe-block', 'tribe-tickets' ],
			'tickets_on_sale'     => $blocks_tickets->get_tickets_on_sale( $tickets ),
			'has_tickets_on_sale' => tribe_events_has_tickets_on_sale( $post_id ),
			'is_sale_past'        => $blocks_tickets->get_is_sale_past( $tickets ),
		];

		// Add the rendering attributes into global context.
		$template->add_template_globals( $args );

		// Enqueue assets.
		tribe_asset_enqueue( 'tribe-tickets-gutenberg-tickets' );
		tribe_asset_enqueue( 'tribe-tickets-gutenberg-block-tickets-style' );

		return $template->template( 'blocks/tickets', $args, false );
	}

}
