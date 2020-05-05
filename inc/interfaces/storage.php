<?php
/**
 * Storage interface
 *
 * @package Meta Box
 */

/**s
 * Interface cleancoded_Storage_Interface
 */
interface cleancoded_Storage_Interface {

	/**
	 * Get value from storage.
	 *
	 * @param  int    $object_id Object id.
	 * @param  string $name      Field name.
	 * @param  array  $args      Custom arguments..
	 * @return mixed
	 */
	public function get( $object_id, $name, $args = array() );
}
