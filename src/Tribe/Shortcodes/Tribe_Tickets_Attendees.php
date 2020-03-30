<?php
/**
 * Shortcode Tribe_Tickets_Attendees.
 *
 * @since   1.0.0
 * @package Tribe\Extensions\Tickets\Shortcodes
 */

namespace Tribe\Extensions\Tickets\Shortcodes\Shortcodes;

/**
 * Class for Shortcode Tribe_Tickets_Attendees.
 *
 * @since   1.0.0
 * @package Tribe\Extensions\Tickets\Shortcodes\Shortcodes
 */
class Tribe_Tickets_Attendees extends Shortcode_Abstract {

	/**
	 * {@inheritDoc}
	 */
	protected $slug = 'tribe_tickets_attendees';

	/**
	 * {@inheritDoc}
	 */
	protected $default_arguments = [
		'post_id' => null,
		'title'   => '',
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

		return $this->get_attendees_block( $post_id );
	}

	/**
	 * Gets the block template and return it.bg-darken-2
	 *
	 * @param WP_Post|int $post the post/event we're viewing.
	 *
	 * @return string HTML.
	 */
	public function get_attendees_block( $post ) {
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

		$post_id = $post->ID;
		$title   = $this->get_argument( 'title' );

		/** @var Tribe__Tickets__Editor__Template $template */
		$template            = tribe( 'tickets.editor.template' );
		$attendees_block     = tribe( 'tickets.editor.blocks.attendees' );
		$attributes          = [];
		$attributes['title'] = empty( $title ) ? esc_html__( "Who's coming?", 'tribe-ext-tickets-shortcodes' ) : $title;
		$args['post_id']     = $post_id;
		$args['attributes']  = $attendees_block->attributes( $attributes );
		$args['attendees']   = $attendees_block->get_attendees( $post_id );

		// Add the rendering attributes into global context
		$template->add_template_globals( $args );

		// enqueue assets.
		tribe_asset_enqueue( 'tribe-tickets-gutenberg-block-attendees-style' );

		return $template->template( 'blocks/attendees', $args, false );
	}

}
