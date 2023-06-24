<?php
/**
 * The main service provider for Shortcodes support
 *
 * @since   1.0.0
 * @package Tribe\Extensions\Tickets\Shortcodes
 */

namespace Tribe\Extensions\Tickets\Shortcodes;

use TEC\Common\Contracts\Service_Provider as TEC_Service_Provider;

/**
 * Class Service_Provider
 * @since   1.0.0
 * @package Tribe\Extensions\Tickets\Shortcodes
 */
class Service_Provider extends TEC_Service_Provider {

	/**
	 * Binds and sets up implementations.
	 *
	 * @since 1.0.0
	 */
	public function register() {
		$manager = new Shortcodes\Manager( $this->container );
		$this->container->singleton( Shortcodes\Manager::class, $manager );
		$this->container->singleton( 'tickets.shortcodes.manager', $manager );

		$this->register_hooks();

		// Register the SP on the container
		$this->container->singleton( 'tickets.shortcodes', $this );
		$this->container->singleton( static::class, $this );
	}

	/**
	 * Registers the provider handling all the 1st level filters and actions for the extension
	 *
	 * @since 1.0.0
	 */
	protected function register_hooks() {
		$hooks = new Hooks( $this->container );
		$hooks->register();

		// Allow Hooks to be removed, by having the them registered to the container.
		$this->container->singleton( Hooks::class, $hooks );
		$this->container->singleton( 'tickets.shortcode.hooks', $hooks );
	}
}
