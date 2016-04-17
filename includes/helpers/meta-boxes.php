<?php
/**
 * Meta Boxes
 *
 * Create new meta boxes.
 *
 * @package Bow
 */

namespace Lambry\Bow;

class Meta_Boxes {

	/* Variables */
	private $meta_boxes;
	private $post_types;

	/**
	 * Construct
	 *
	 * Register new meta boxes and load assets.
	 *
	 * @param array $meta_boxes
	 * @param array $post_types
	 */
	public function __construct( $meta_boxes, $post_types = [ 'page' ] ) {

		// Set variables
		$this->meta_boxes = $meta_boxes;
		$this->post_types = array_map( 'sanitize_title_with_dashes', $post_types );

		// Register sanitizers
		$this->register_sanitizers();

		// Register meta boxes
		add_action( 'add_meta_boxes', [ $this, 'register_meta_boxes' ] );

		// Add admin assets
		add_action( 'admin_enqueue_scripts', [ $this, 'load_assets' ] );

		// Add actions to save meta boxes
		foreach ( $post_types as $post_type ) {
			add_action( 'save_post_' . $post_type, [ $this, 'update_meta_boxes' ] );
		}

	}

	/**
	 * Load Assets
	 *
	 * Loads all assets.
	 *
	 * @access public
	 * @param  string $hook
	 * @return null
	 */
	public function load_assets( $hook ) {

		// Check if we should load assets
		if ( $hook !== 'post-new.php' && $hook !== 'post.php' ) return;

		// Load settings css
		wp_enqueue_style( 'bow-meta-styles', get_template_directory_uri() . '/assets/admin/styles/meta-boxes.css', [ 'wp-color-picker' ], '1.0.0' );
		// Load media assets
		wp_enqueue_media();
		// Load settings js
		wp_enqueue_script( 'bow-meta-scripts', get_template_directory_uri() . '/assets/admin/scripts/meta-boxes.js', [ 'jquery', 'wp-color-picker' ], '1.0.0', true );

	}

	/**
	 * Register Sanitizers
	 *
	 * Register sanitizers for meta boxes.
	 *
	 * @access public
	 * @return null
	 */
	public function register_sanitizers() {

		foreach ( $this->meta_boxes as $meta_box ) {
			foreach ( $meta_box['fields'] as $field ) {

				switch ($field['type']) {
					case 'checkbox':
					case 'repeater':
						register_meta( 'post', $this->field_name( $field ), [ $this, 'sanitize_array' ] );
						break;
					case 'editor':
						// register_meta( 'post', $this->field_name( $field ), 'wp_kses' );
						break;
					default:
						register_meta( 'post', $this->field_name( $field ), 'sanitize_text_field' );
						break;
				}

			}
		}

	}

	/**
	 * Register Meta Boxes
	 *
	 * Register all meta boxes.
	 *
	 * @access public
	 * @return null
	 */
	public function register_meta_boxes() {

		// Set up each meta box
		foreach ( $this->meta_boxes as $meta_box ) {

			// Set meta box defaults
			$context = ( isset( $meta_box['context'] ) ) ? $meta_box['context'] : 'normal';
			$priority = ( isset( $meta_box['priority'] ) ) ? $meta_box['priority'] : 'high';

			// Add meta boxes
			foreach ( $this->post_types as $post_type ) {
				add_meta_box( $meta_box['id'], $meta_box['title'], [ $this, 'display_meta_box' ], $post_type, $context, $priority, $meta_box );
			}

		}

	}

	/**
	 * Display Meta Box
	 *
	 * Display all meta boxes.
	 *
	 * @access public
	 * @param  object $post
	 * @param  array $meta_box
	 * @return null
	 */
	public function display_meta_box( $post, $meta_box ) { ?>

		<div class="bow-meta-boxes">
			<?php
				wp_nonce_field( 'bow_meta_boxes', 'bow_meta_boxes_nonce' );

				// Display description
				if ( isset( $meta_box['args']['description'] ) ) {
					echo "<p class='meta-box-descripion'>{$meta_box['args']['description']}</p>";
				}

				// Add fields
				foreach ( $meta_box['args']['fields'] as $field ) {
					$this->add_field( $field );
				}
			?>
		</div>

		<?php

	}

	/**
	 * Add Field
	 *
	 * Display the appropraite field.
	 *
	 * @access private
	 * @param  array $field
	 * @return null
	 */
	private function add_field( $field ) {

		switch ( $field['type'] ) {
			case 'text':
				$this->text( $field );
				break;

			case 'textarea':
				$this->textarea( $field );
				break;

			case 'editor':
				$this->editor( $field );
				break;

			case 'select':
				$this->select( $field );
				break;

			case 'radio':
				$this->radio( $field );
				break;

			case 'checkbox':
				$this->checkbox( $field );
				break;

			case 'on_off':
				$this->on_off( $field );
				break;

			case 'upload':
				$this->upload( $field );
				break;

			case 'color':
				$this->color( $field );
				break;

			case 'repeater':
				$this->repeater( $field );
				break;

			default:
				$this->text( $field );
				break;
		}

	}

	/**
	 * Text
	 *
	 * Generates a text field.
	 *
	 * @access private
	 * @param  array $field
	 * @return null
	 */
	private function text( $field ) { ?>

		<div class="meta-field meta-text">
			<label><?php echo $field['label']; ?></label>
			<input type="text" name="<?php echo $this->field_name( $field ); ?>" value="<?php echo $this->field_value( $field ); ?>">
			<?php $this->field_description( $field ); ?>
		</div>

	<?php }

	/**
	 * Textarea
	 *
	 * Generates a textarea.
	 *
	 * @access private
	 * @param  array $field
	 * @return null
	 */
	private function textarea( $field ) { ?>

		<div class="meta-field meta-textarea">
			<label><?php echo $field['label']; ?></label>
			<textarea name="<?php echo $this->field_name( $field ); ?>" cols="50" rows="10"><?php echo $this->field_value( $field ); ?></textarea>
			<?php $this->field_description( $field ); ?>
		</div>

	<?php }

	/**
	 * Editor
	 *
	 * Generates a WordPress editor.
	 *
	 * @access private
	 * @param  array $field
	 * @return null
	 */
	private function editor( $field ) { ?>

		<div class="meta-field meta-editor">
			<label><?php echo $field['label']; ?></label>
			<?php wp_editor( $this->field_value( $field ), $field['id'], [ 'textarea_name' => $this->field_name( $field ) ] ); ?>
			<?php $this->field_description( $field ); ?>
		</div>

	<?php }

	/**
	 * Select
	 *
	 * Generates a select box.
	 *
	 * @access private
	 * @param  array $field
	 * @return null
	 */
	private function select( $field ) { ?>

		<div class="meta-field meta-select">
			<label><?php echo $field['label']; ?></label>

			<select name="<?php echo $this->field_name( $field ); ?>">
				<option value=""><?php echo __( '-- select --', 'bow' ); ?></option>
				<?php foreach ( $field['choices'] as $value => $label ) : ?>
					<option value="<?php echo $value; ?>" <?php selected( $this->field_value( $field ), $value ); ?>>
						<?php echo $label; ?>
					</option>
				<?php endforeach; ?>
			</select>

			<?php $this->field_description( $field ); ?>
		</div>

	<?php }

	/**
	 * Radio
	 *
	 * Generates a list of radio buttons.
	 *
	 * @access private
	 * @param  array $field
	 * @return null
	 */
	private function radio( $field ) { ?>

		<div class="meta-field meta-radio">
			<?php foreach ( $field['choices'] as $value => $label ) : ?>
				<label><?php echo $label; ?>
					<input type="radio" name="<?php echo $this->field_name( $field ); ?>" value="<?php echo $value; ?>" <?php checked( $this->field_value( $field ), $value ); ?>>
				</label>
			<?php endforeach; ?>
			<?php $this->field_description( $field ); ?>
		</div>

	<?php }

	/**
	 * Checkbox
	 *
	 * Generates a list of checkboxes.
	 *
	 * @access private
	 * @param  array $field
	 * @return null
	 */
	private function checkbox( $field ) {

		$option = $this->field_value( $field ); ?>

		<div class="meta-field meta-checkbox">
			<?php $i = 0; foreach ( $field['choices'] as $value => $label ) :
			    $checked = ( is_array( $option ) && in_array( $value, $option ) ) ? true : false; ?>
			    <label><?php echo $label; ?>
			        <input type="checkbox" name="<?php echo $this->field_name( $field ) . "[{$i}]"; ?>"
			               value="<?php echo $value; ?>" <?php checked( true, $checked ); ?>>
			    </label>
			<?php $i++; endforeach; ?>
			<?php $this->field_description( $field ); ?>
		</div>

	<?php }

	/**
	 * On Off
	 *
	 * Generates a single checkbox.
	 *
	 * @access private
	 * @param  array $field
	 * @return null
	 */
	private function on_off( $field ) {

		$option = $this->field_value( $field ); ?>

		<div class="meta-field meta-on-off">
			<label><?php echo $field['label']; ?>
				<input type="checkbox" name="<?php echo $this->field_name( $field ); ?>" value="1" <?php checked( $option, '1' ); ?>>
			</label>
			<?php $this->field_description( $field ); ?>
		</div>

	<?php }

	/**
	 * Upload
	 *
	 * Generates an upload field.
	 *
	 * @access private
	 * @param  array $field
	 * @return null
	 */
	private function upload( $field ) {

		$option = $this->field_value( $field ); ?>

		<div class="meta-field meta-upload">
			<label><?php echo $field['label']; ?></label>

			<div class="upload">
				<div class="upload-image <?php echo ( ! $option ) ? 'hide' : ''; ?>">
					<img src="<?php echo $option; ?>" alt="<?php echo $option; ?>">
					<i class="upload-remove remove dashicons dashicons-no-alt"></i>
				</div>

				<input type="hidden" name="<?php echo $this->field_name( $field ); ?>" value="<?php echo $option; ?>" class="upload-file">
				<button class="button upload-select block" type="button"><?php _e( 'Select', 'bow' ); ?></button>

				<?php $this->field_description( $field ); ?>
			</div>

		</div>

	<?php }

	/**
	 * Color
	 *
	 * Generates a color picker.
	 *
	 * @access private
	 * @param  array $field
	 * @return null
	 */
	private function color( $field ) { ?>

		<div class="meta-field meta-text">
			<label><?php echo $field['label']; ?></label>
			<input type="text" name="<?php echo $this->field_name( $field ); ?>" value="<?php echo $this->field_value( $field ); ?>" class="color-picker">
			<?php $this->field_description( $field ); ?>
		</div>

	<?php }

	/**
	 * Repeater
	 *
	 * Generates repeater fields.
	 *
	 * @access private
	 * @param  array $fields
	 * @return null
	 */
	private function repeater( $fields ) {

		global $post;

		$meta = get_post_meta( $post->ID, $this->field_name( $fields ), false );
		$repeats = ( is_array( $meta ) && ! empty( $meta[0] ) ) ? $meta[0] : [ 'default' ]; ?>

		<p><strong><?php echo $fields['label']; ?></strong></p>
		<div class="meta-repeater">
			<div class="meta-sortable">
				<?php $i = 0;
					foreach ( $repeats as $repeat ) : ?>
					<div data-index="<?php echo $i; ?>" class="repeater <?php echo ( $repeat === 'default' ) ? 'hide' : ''; ?>">
						<i class="repeater-remove remove dashicons dashicons-no-alt"></i>
						<?php
							foreach ( $fields['fields'] as $field ) {
								$field['repeater'] = [
									'inc'   => $i,
									'id'    => $fields['id'],
									'value' => ( isset( $repeat[$field['id']] ) ) ? $repeat[$field['id']] : '',
								];
								$this->add_field( $field );
							}
						?>
					</div>
				<?php $i++; endforeach; ?>
			</div>
			<?php $this->field_description( $fields ); ?>
			<button class="button repeater-add block" type="button">
				<?php echo ( isset( $fields['button'] ) ) ? $fields['button'] : _e( 'Add New +', 'bow' ); ?>
			</button>
		</div>

	<?php }

	/**
	 * Field Description
	 *
	 * Displays the fields description.
	 *
	 * @access private
	 * @param  array $field
	 * @return null
	 */
	private function field_description( $field ) {

		if ( isset( $field['description'] ) ) : ?>
			<p class="description"><?php echo $field['description']; ?></p>
		<?php endif;

	}

	/**
	 * Field Name
	 *
	 * Generates a field name.
	 *
	 * @access private
	 * @param  string $field
	 * @return string $name
	 */
	private function field_name( $field ) {

		if ( isset( $field['repeater'] ) ) {
			return '_' . $field['repeater']['id'] . '[' . $field['repeater']['inc'] . ']' . '[' . $field['id'] . ']';
		} else {
			return '_' . $field['id'];
		}

	}

	/**
	 * Feild Value
	 *
	 * Gets the current fields value.
	 *
	 * @access private
	 * @param  array $field
	 * @return mixed $meta_value
	 */
	private function field_value( $field ) {

		global $post;

		if ( isset( $field['repeater'] ) ) {
			return $field['repeater']['value'];
		} else {
			return get_post_meta( $post->ID, $this->field_name( $field ), true );
		}

	}

	/**
	 * Update Meta Boxes
	 *
	 * Update all meta box data.
	 *
	 * @access public
	 * @param  int $post_id
	 * @return null
	 */
	public function update_meta_boxes( $post_id ) {

		// Check user permissions
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;

		// Check for nonce and autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE || ! isset( $_POST['bow_meta_boxes_nonce'] ) ||
			 ! wp_verify_nonce( $_POST['bow_meta_boxes_nonce'], 'bow_meta_boxes' ) ) {
			return;
		}

		// Save all meta fields
		foreach ( $this->meta_boxes as $meta_box ) {

			foreach ( $meta_box['fields'] as $field ) {

				$value = ( isset( $_POST[$this->field_name( $field )] ) ) ? $_POST[$this->field_name( $field )] : '';

				if ( $field['type'] === 'repeater' && is_array( $value ) ) {
					$value = $this->filter_array( $value );
				}

				update_post_meta( $post_id, $this->field_name( $field ), $value );

			}

		}

	}

	/**
	 * Sanitize Array
	 *
	 * Sanitizes a meta array.
	 *
	 * @access public
	 * @param  array $array
	 * @return array $array
	 */
	public function sanitize_array( $array ) {

		if ( ! is_array( $array ) ) {
			return sanitize_text_field( $array );
		}

		array_walk_recursive( $array, function( &$value, $key ) {
			if ( ! is_array( $value ) ) {
				$value = sanitize_text_field( $value );
			}
		});

		return $array;

	}

	/**
	 * Filter Array
	 *
	 * Filters out empty repeaters.
	 *
	 * @access private
	 * @param  array $array
	 * @return array $filtered_array
	 */
	private function filter_array( $array ) {

		$filtered_array = [];

		foreach ( $array as $item ) {

			$filtered_items = array_filter( $item, function( $value, $key ) {
				return $value;
			}, ARRAY_FILTER_USE_BOTH );

			if ( $filtered_items ) {
				array_push( $filtered_array, $item );
			}

		}

		return $filtered_array;

	}

}
