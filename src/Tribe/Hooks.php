<?php
/**
 * Handles hooking all the actions and filters used by the module.
 *
 * To remove a filter:
 * remove_filter( 'some_filter', [ tribe( Tribe\Extensions\Tickets\Shortcodes\Hooks::class ), 'some_filtering_method' ] );
 * remove_filter( 'some_filter', [ tribe( 'tickets.shortcodes.hooks' ), 'some_filtering_method' ] );
 *
 * To remove an action:
 * remove_action( 'some_action', [ tribe( Tribe\Extensions\Tickets\Shortcodes\Hooks::class ), 'some_method' ] );
 * remove_action( 'some_action', [ tribe( 'tickets.shortcodes.hooks' ), 'some_method' ] );
 *
 * @since 1.0.0
 *
 * @package Tribe\Extensions\Tickets\Shortcodes
 */

namespace Tribe\Extensions\Tickets\Shortcodes;

use TEC\Common\Contracts\Service_Provider;

/**
 * Class Hooks
 *
 * @since 1.0.0
 *
 * @package Tribe\Extensions\Tickets\Additional_Fields
 */
class Hooks extends Service_Provider {

	/**
	 * Binds and sets up implementations.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		$this->add_actions();
		$this->add_filters();
	}

	/**
	 * Adds the required actions.
	 *
	 * @since 1.0.0
	 */
	protected function add_actions() {
		add_action( 'init', [ $this, 'action_add_shortcodes' ] );
	}

	/**
	 * Adds the required filters.
	 *
	 * @since 1.0.0
	 */
	protected function add_filters() {}

	/**
	 * Adds the shortcodes.
	 *
	 * @since TBD
	 */
	public function action_add_shortcodes() {
		$this->container->make( Shortcodes\Manager::class )->add_shortcodes();
	}
}
