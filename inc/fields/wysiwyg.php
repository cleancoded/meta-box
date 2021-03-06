<?php
/**
 * The WYSIWYG (editor) field.
 *
 * @package Meta Box
 */

/**
 * WYSIWYG (editor) field class.
 */
class cleancoded_Wysiwyg_Field extends cleancoded_Field {
	/**
	 * Array of cloneable editors.
	 *
	 * @var array
	 */
	protected static $cloneable_editors = array();

	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_editor();
		wp_enqueue_style( 'cleancoded-wysiwyg', cleancoded_CSS_URL . 'wysiwyg.css', array(), cleancoded_VER );
		wp_enqueue_script( 'cleancoded-wysiwyg', cleancoded_JS_URL . 'wysiwyg.js', array( 'jquery' ), cleancoded_VER, true );
	}

	/**
	 * Change field value on save.
	 *
	 * @param mixed $new     The submitted meta value.
	 * @param mixed $old     The existing meta value.
	 * @param int   $post_id The post ID.
	 * @param array $field   The field parameters.
	 * @return string
	 */
	public static function value( $new, $old, $post_id, $field ) {
		return $field['raw'] ? $new : wpautop( $new );
	}

	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function html( $meta, $field ) {
		// Using output buffering because wp_editor() echos directly.
		ob_start();

		$field['options']['textarea_name'] = $field['field_name'];
		$attributes                        = self::get_attributes( $field );

		// Use new wp_editor() since WP 3.3.
		wp_editor( $meta, $attributes['id'], $field['options'] );

		return ob_get_clean();
	}

	/**
	 * Escape meta for field output.
	 *
	 * @param mixed $meta Meta value.
	 * @return mixed
	 */
	public static function esc_meta( $meta ) {
		return $meta;
	}

	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 * @return array
	 */
	public static function normalize( $field ) {
		$field = parent::normalize( $field );
		$field = wp_parse_args(
			$field,
			array(
				'raw'     => false,
				'options' => array(),
			)
		);

		$field['options'] = wp_parse_args(
			$field['options'],
			array(
				'editor_class' => 'cleancoded-wysiwyg',
				'dfw'          => true, // Use default WordPress full screen UI.
			)
		);

		// Keep the filter to be compatible with previous versions.
		$field['options'] = apply_filters( 'cleancoded_wysiwyg_settings', $field['options'] );

		return $field;
	}
}
