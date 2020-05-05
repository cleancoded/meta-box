<?php
/**
 * Storage registry class
 *
 * @package Meta Box
 */

/**
 * Class cleancoded_Storage_Registry
 */
class cleancoded_Storage_Registry {

	/**
	 * List storage instances.
	 *
	 * @var array
	 */
	protected $storages = array();

	/**
	 * Get storage instance.
	 *
	 * @param string $class_name Storage class name.
	 * @return cleancoded_Storage_Interface
	 */
	public function get( $class_name ) {
		if ( empty( $this->storages[ $class_name ] ) ) {
			$this->storages[ $class_name ] = new $class_name();
		}

		return $this->storages[ $class_name ];
	}
}
