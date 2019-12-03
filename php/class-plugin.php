<?php
/**
 * Primary plugin file.
 *
 * @package   WPAI_DFI
 */

namespace WPAI_DFI;

/**
 * Class Plugin
 */
class Plugin extends Plugin_Abstract {
	/**
	 * Execute this once plugins are loaded.
	 */
	public function plugin_loaded() {

		// Register frontend content override for the author box.
		$this->wpai_featured_image = new WPAI\Featured_Image();
		$this->wpai_featured_image->register_hooks();
	}
}
