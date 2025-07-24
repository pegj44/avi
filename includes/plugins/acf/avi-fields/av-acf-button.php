<?php

class avi_acf_field_button extends acf_field {

	// Vars
	var $settings, 		// Will hold info such as dir / path
		$defaults,		// Will hold default field options
		$json_content; 	// Hold the content of icons JSON config file

	/**
	 *  __construct
	 *
	 *  @since	1.0.0
	 */
	function __construct() {
		
		// Vars
		$this->name = 'avi-acf-button';
		$this->label = __('Button', 'avi');
		$this->category = __("Content", 'acf');
		$this->defaults = array(
			'link'	=> '',
			'text' 	=> '',
			'style' => 'flat_rounded',
			'size'	=> 'medium',
			'color'	=> '',
			'icon'	=>	'',
			'iconalign'	=> 'right',
			'reveal' => 0,
			'newtab' => 0,
			'button' => '',
			'textcolor' => ''
		);

    	parent::__construct();

    	// Settings
		$this->settings = array(
			'dir' 		=> 	apply_filters('acf/helpers/get_dir', __FILE__),
			'path'		=>	apply_filters('acf/helpers/get_path', __FILE__),
			'config' 	=> 	apply_filters('acf/helpers/get_path', __FILE__) . 'icons/config.json',
			'icons'		=>	apply_filters('acf/helpers/get_dir', __FILE__) . 'icons/css/fontello.css',
			'version' 	=> 	'1.0.0'
		);
		
		// Apply a filter so that you can load icon set from theme
		$this->settings = apply_filters( 'acf/avi_acf_field_button/settings', $this->settings );

		// Enqueue icons style in the frontend
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_enqueue' ) );

		// Load icons list from the icons JSON file
		if ( is_admin() ){
			$json_file = @file_get_contents( $this->settings['config'] );
			$this->json_content = @json_decode( $json_file, true );
		}

		// $this->add_action( 'save_post', array( $this, 'update_value' ) );
	}

	function update_value( $value, $post_id, $field ) {

		$btn_style['flat'] = '';
		$btn_style['flat_rounded'] = 'button-rounded';
		$btn_style['btn_3d'] = 'button-3d';
		$btn_style['bordered'] = 'button-border';
		$btn_style['border_rounded'] = 'button-border button-rounded';
		$btn_style['circle'] = 'button-circle';

		$class[] = 'button';
		$class[] = $btn_style[$value['style']];
		$class[] = 'button-'. $value['size'];
		$class[] = ( $value['reveal'] )? 'button-reveal' : '';
		$class[] = ( $value['iconalign'] === 'right' )? 'tright' : '';
		$class[] = $field['_name'];

		$class = array_filter($class);

		$icon = ( $value['icon'] )? '<i class="'. $value['icon'] .'"></i>' : '';
		$target = ( $value['newtab'] )? ' target="_blank"' : '';

		$style   = array();

		// if( trim($value['color']) !== '' ) {

		// 	switch ($value['style']) {
		// 		case 'flat':
		// 			$style[] = 'background-color: '. $value['color'];
		// 			break;
		// 		case 'flat_rounded':
		// 			$style[] = 'background-color: '. $value['color'];
		// 			break;
		// 		case 'btn_3d':
		// 			$style[] = 'background-color: '. $value['color'];
		// 			break;
		// 		case 'bordered':
		// 			# code...
		// 			break;
		// 		default:
		// 			# code...
		// 			break;
		// 	}
		// }

		if( trim($value['textcolor']) !== '' ) { 
			$style[] = 'color: '. $value['textcolor'];
		}		

		$style = array_filter($style);
		$styles = '';
		if( !empty($style) ) {
			$styles = 'style="'. implode('; ', $style) .'"';
		}

		$button = '<a href="'. esc_url($value['link']) .'"'. $target .' class="'. esc_attr(implode(' ', $class)) .'" '. $styles .'>';
		
		if( $value['iconalign'] === 'right' ) {
			$button .= '<span>'. esc_html($value['text']) .'</span>';
			$button .= $icon;				
		} else {				
			$button .= $icon;
			$button .= '<span>'. esc_html($value['text']) .'</span>';					
		}
		
		$button .= '</a>';	

		if( trim($value['text']) !== '' ) {
			$value['button'] = $button;	
		} else {
			$value['button'] = false;
		}
		

		return $value;
	}

	/**
	 *  frontend_enqueue()
	 *
	 *  @since	1.0.0
	 */
	function frontend_enqueue() {
		// Register icons style
		wp_register_style( 'acf-fonticonpicker-icons', $this->settings['icons'] );
		wp_enqueue_style( 'acf-fonticonpicker-icons' );
	}

	/**
	 *  create_field()
	 *
	 *  @param	$field - An array holding all the field's data
	 *
	 *  @since	1.0.0
	 */
	function create_field( $field ) { ?>	

		<table class="widefat avi-acf-widefat">
			<tr>
				<td>
					<p class="label"><label for="<?php  echo $field['name']; ?>[link]"><?php _e('Button Link', 'avi'); ?></label></p>
					<input type="text" id="<?php  echo $field['name']; ?>[link]" name="<?php  echo $field['name']; ?>[link]" value="<?php  echo $field['value']['link']; ?>">
				</td>
				<td>
					<p class="label"><label for="<?php  echo $field['name']; ?>[text]"><?php _e('Button Text', 'avi'); ?></label></p>
					<input type="text" id="<?php  echo $field['name']; ?>[text]" name="<?php  echo $field['name']; ?>[text]" value="<?php  echo $field['value']['text']; ?>">
				</td>
			</tr>
			<tr>
				<td>
					<p class="label"><label for="<?php  echo $field['name']; ?>[style]"><?php _e('Button Style', 'avi'); ?></label></p>
					<select id="<?php  echo $field['name']; ?>[style]" name="<?php  echo $field['name']; ?>[style]">
						<option value="flat" <?php selected( $field['value']['style'], 'flat' ); ?>><?php _e('Flat', 'avi'); ?></option>
						<option value="flat_rounded" <?php selected( $field['value']['style'], 'flat_rounded' ); ?>><?php _e('Flat Rounded', 'avi'); ?></option>
						<option value="btn_3d" <?php selected( $field['value']['style'], 'btn_3d' ); ?>><?php _e('3D', 'avi'); ?></option>
						<option value="bordered" <?php selected( $field['value']['style'], 'bordered' ); ?>><?php _e('Bordered', 'avi'); ?></option>
						<option value="border_rounded" <?php selected( $field['value']['style'], 'border_rounded' ); ?>><?php _e('Border Rounded', 'avi'); ?></option>
						<option value="circle" <?php selected( $field['value']['style'], 'circle' ); ?>><?php _e('Circle', 'avi'); ?></option>
					</select>
				</td>
				<td>
					<p class="label"><label for="<?php  echo $field['name']; ?>[size]"><?php _e('Button Size', 'avi'); ?></label></p>
					<select id="<?php  echo $field['name']; ?>[size]" name="<?php  echo $field['name']; ?>[size]">
						<option value="mini" <?php selected( $field['value']['size'], 'mini' ); ?>><?php _e('Mini', 'avi'); ?></option>
						<option value="medium" <?php selected( $field['value']['size'], 'medium' ); ?>><?php _e('Medium', 'avi'); ?></option>
						<option value="large" <?php selected( $field['value']['size'], 'large' ); ?>><?php _e('Large', 'avi'); ?></option>
						<option value="xlarge" <?php selected( $field['value']['size'], 'xlarge' ); ?>><?php _e('Extra large', 'avi'); ?></option>
					</select>					
				</td>
			</tr>
			<tr>
				<td>
					<div class="acf-color_picker">
						<p class="label"><label for="<?php  echo $field['name']; ?>[color]"><?php _e('Button Color', 'avi'); ?></label></p>
						<input type="text" id="<?php  echo $field['name']; ?>[color]" name="<?php  echo $field['name']; ?>[color]" class="color_picker wp-color-picker" value="<?php  echo $field['value']['color']; ?>">
					</div>
					<div class="acf-color_picker">
						<p class="label"><label for="<?php  echo $field['name']; ?>[textcolor]"><?php _e('Button Text Color', 'avi'); ?></label></p>
						<input type="text" id="<?php  echo $field['name']; ?>[textcolor]" name="<?php  echo $field['name']; ?>[textcolor]" class="color_picker wp-color-picker" value="<?php  echo $field['value']['textcolor']; ?>">
					</div>
				</td>
				<td>
				<?php if( !isset( $this->json_content['glyphs'] ) ) : ?>
					<?php _e('No icons found'); ?>
				<?php else : ?>
					<div style="float:left;">
						<p class="label"><label for="<?php  echo $field['name']; ?>[icon]"><?php _e('Button Icon', 'avi'); ?></label></p>
						<select name="<?php echo $field['name']; ?>[icon]" id="<?php echo $field['name']; ?>[icon]" class="acf-iconpicker">
							<option value=""><?php _e('None', 'avi'); ?></option>
							<?php
								foreach ( $this->json_content['glyphs'] as $glyph ) {
									$glyph_full = $this->json_content['css_prefix_text'] . $glyph['css'];
									echo '<option value="'. $glyph_full .'" '. selected( $field['value']['icon'], $glyph_full, false ) .'>'. $glyph['css'] .'</option>';
								}
							?>
						</select>
					</div>	
					<div style="float:left; margin-left: 15px;">
						<p class="label"><label for="<?php  echo $field['name']; ?>[iconalign]"><?php _e('Icon Align', 'avi'); ?></label></p>
						<select id="<?php  echo $field['name']; ?>[iconalign]" name="<?php  echo $field['name']; ?>[iconalign]">
							<option value="left" <?php selected( $field['value']['iconalign'], 'left' ); ?>><?php _e('Left', 'avi'); ?></option>
							<option value="right" <?php selected( $field['value']['iconalign'], 'right' ); ?>><?php _e('Right', 'avi'); ?></option>							
						</select>
					</div>						
					<div style="float:left; margin-left: 15px;">
						<p class="label"><label for="<?php  echo $field['name']; ?>[reveal]"><?php _e('Reveal on Hover', 'avi'); ?></label></p>
						<ul class="acf-checkbox-list <?php echo $field['class']; ?>[reveal]">
							<input type="hidden" name="<?php echo $field['name']; ?>[reveal]" value="0" />
							<?php $selected = ($field['value']['reveal'] == 1) ? 'checked="yes"' : ''; ?>
							<li><label><input id="<?php echo $field['name']; ?>[reveal]"  type="checkbox" name="<?php echo $field['name']; ?>[reveal]" value="1" <?php echo $selected; ?> /></label></li>					
						</ul>				
					</div>												
				<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<p class="label"><label for="<?php  echo $field['name']; ?>[newtab]"><?php _e('Open link in new tab', 'avi'); ?></label></p>
					<ul class="acf-checkbox-list <?php echo $field['class']; ?>[newtab]">
						<input type="hidden" name="<?php echo $field['name']; ?>[newtab]" value="0" />
						<?php $selected = ($field['value']['newtab'] == 1) ? 'checked="yes"' : ''; ?>
						<li><label><input id="<?php echo $field['name']; ?>[newtab]"  type="checkbox" name="<?php echo $field['name']; ?>[newtab]" value="1" <?php echo $selected; ?> /></label></li>					
					</ul>
				</td>
			</tr>
		</table>
		
		<input type="hidden" id="<?php  echo $field['name']; ?>[button]" name="<?php  echo $field['name']; ?>[button]" value="<?php  echo htmlspecialchars($field['value']['button']); ?>">
	<?php }

	/**
	 *  input_admin_enqueue_scripts()
	 *
	 *  @since	1.0.0
	 */
	function input_admin_enqueue_scripts() {
	
		// Scripts
		wp_register_script( 'acf-fonticonpicker', $this->settings['dir'] . 'js/jquery.fonticonpicker.min.js', array('jquery'), $this->settings['version'] );
		wp_register_script( 'acf-fonticonpicker-input', $this->settings['dir'] . 'js/input.js', array('acf-fonticonpicker'), $this->settings['version'] );
		wp_enqueue_script( 'acf-fonticonpicker-input' );
		
		// Styles
		wp_register_style( 'acf-fonticonpicker-style', $this->settings['dir'] . 'css/jquery.fonticonpicker.min.css', false, $this->settings['version'] );
		wp_register_style( 'acf-fonticonpicker-icons', $this->settings['icons'] );
		wp_enqueue_style( array( 'acf-fonticonpicker-style', 'acf-fonticonpicker-icons' ) );
		
		$style = '
			div[data-field_type="avi-acf-button"] .acf-color_picker {
			    float: left;
			}		
			div[data-field_type="avi-acf-button"] .acf-color_picker:last-child {
			    margin-left: 15px;
			}			
		';
		wp_add_inline_style( 'acf-global', $style );
	}

} // Class avi_acf_field_button

// create field
new avi_acf_field_button();