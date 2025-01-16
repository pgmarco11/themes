<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Module Name: Widget
 * Description: Display any available widgets
 */
class TB_Widget_Module extends Themify_Builder_Module {
	function __construct() {
		parent::__construct(array(
			'name' => __( 'Widget', 'themify' ),
			'slug' => 'widget'
		));

		add_action( 'themify_builder_lightbox_fields', array( $this, 'widget_fields' ), 10, 2 );
		add_action( 'wp_ajax_module_widget_get_form', array( $this, 'widget_get_form' ), 10 );
	}

	public function get_options() {
		$options = array(
			array(
				'id' => 'mod_title_widget',
				'type' => 'text',
				'label' => __( 'Module Title', 'themify' ),
				'class' => 'large'
			),
			array(
				'id' => 'class_widget',
				'type' => 'widget_select',
				'label' => __( 'Select Widget', 'themify' ),
				'class' => 'large',
				'help' => __( 'Select Available Widgets', 'themify' ),
				'separated' => 'bottom',
				'break' => true
			),
			array(
				'id' => 'instance_widget',
				'type' => 'widget_form',
				'label' => false
			),
			// Additional CSS
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<hr/>')
			),
			array(
				'id' => 'custom_css_widget',
				'type' => 'text',
				'label' => __( 'Additional CSS Class', 'themify' ),
				'help' => sprintf( '<br/><small>%s</small>', __( 'Add additional CSS class(es) for custom styling', 'themify' ) ),
				'class' => 'large exclude-from-reset-field'
			)
		);
		return $options;
	}

	public function get_animation() {
		$animation = array(
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . esc_html__( 'Appearance Animation', 'themify' ) . '</h4>')
			),
			array(
				'id' => 'multi_Animation Effect',
				'type' => 'multi',
				'label' => __( 'Effect', 'themify' ),
				'fields' => array(
					array(
						'id' => 'animation_effect',
						'type' => 'animation_select',
						'label' => __( 'Effect', 'themify' )
					),
					array(
						'id' => 'animation_effect_delay',
						'type' => 'text',
						'label' => __( 'Delay', 'themify' ),
						'class' => 'xsmall',
						'description' => __( 'Delay (s)', 'themify' ),
					),
					array(
						'id' => 'animation_effect_repeat',
						'type' => 'text',
						'label' => __( 'Repeat', 'themify' ),
						'class' => 'xsmall',
						'description' => __( 'Repeat (x)', 'themify' ),
					),
				)
			)
		);

		return $animation;
	}

	public function get_styling() {
		$general = array(
			// Background
			array(
				'id' => 'separator_image_background',
				'title' => '',
				'description' => '',
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . __( 'Background', 'themify' ) . '</h4>' )
			),
			array(
				'id' => 'background_image',
				'type' => 'image_and_gradient',
				'label' => __( 'Background Image', 'themify' ),
				'class' => 'xlarge',
				'prop' => 'background-image',
				'selector' => '.module-widget',
				'option_js' => true
			),
			array(
				'id' => 'background_color',
				'type' => 'color',
				'label' => __( 'Background Color', 'themify' ),
				'class' => 'small',
				'prop' => 'background-color',
				'selector' => '.module-widget',
			),
			// Background repeat
			array(
				'id' 		=> 'background_repeat',
				'label'		=> __( 'Background Repeat', 'themify' ),
				'type' 		=> 'select',
				'default'	=> '',
				'meta'		=> Themify_Builder_Model::get_background_options(),
				'prop' => 'background-repeat',
				'selector' => '.module-widget',
				'wrap_with_class' => 'tf-group-element tf-group-element-image'
			),
			// Font
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<hr />' )
			),
			array(
				'id' => 'separator_font',
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . __('Font', 'themify' ) .'</h4>' )
			),
			array(
				'id' => 'font_family',
				'type' => 'font_select',
				'label' => __( 'Font Family', 'themify' ),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => array( '.module-widget', '.module-widget a' ),
			),
			array(
				'id' => 'font_color',
				'type' => 'color',
				'label' => __( 'Font Color', 'themify' ),
				'class' => 'small',
				'prop' => 'color',
				'selector' => array( '.module-widget', '.module-widget a' ),
			),
			array(
				'id' => 'multi_font_size',
				'type' => 'multi',
				'label' => __( 'Font Size', 'themify' ),
				'fields' => array(
					array(
						'id' => 'font_size',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'font-size',
						'selector' => array( '.module-widget', '.module-widget a' ),
					),
					array(
						'id' => 'font_size_unit',
						'type' => 'select',
						'meta' => Themify_Builder_Model::get_css_units()
					)
				)
			),
			array(
				'id' => 'multi_line_height',
				'type' => 'multi',
				'label' => __( 'Line Height', 'themify' ),
				'fields' => array(
					array(
						'id' => 'line_height',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'line-height',
						'selector' => array( '.module-widget', '.module-widget a' ),
					),
					array(
						'id' => 'line_height_unit',
						'type' => 'select',
						'meta' => Themify_Builder_Model::get_css_units()
					)
				)
			),
			array(
				'id' => 'text_align',
				'label' => __( 'Text Align', 'themify' ),
				'type' => 'radio',
				'meta' => Themify_Builder_Model::get_text_align(),
				'prop' => 'text-align',
				'selector' => array( '.module-widget' ),
			),
			// Link
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<hr />' )
			),
			array(
				'id' => 'separator_link',
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . __( 'Link', 'themify' ) . '</h4>' )
			),
			array(
				'id' => 'link_color',
				'type' => 'color',
				'label' => __( 'Color', 'themify' ),
				'class' => 'small',
				'prop' => 'color',
				'selector' => array( '.module-widget a' ),
			),
			array(
				'id' => 'link_color_hover',
				'type' => 'color',
				'label' => __( 'Color Hover', 'themify' ),
				'class' => 'small',
				'prop' => 'color',
				'selector' => '.module-widget a:hover'
			),
			array(
				'id' => 'text_decoration',
				'type' => 'select',
				'label' => __( 'Text Decoration', 'themify' ),
				'meta'	=> Themify_Builder_Model::get_text_decoration(),
				'prop' => 'text-decoration',
				'selector' => array( '.module-widget a' ),
			),
			// Padding
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<hr />' )
			),
			array(
				'id' => 'separator_padding',
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . __( 'Padding', 'themify' ) . '</h4>' ),
			),
			Themify_Builder_Model::get_field_group( 'padding', '.module-widget', 'top' ),
			Themify_Builder_Model::get_field_group( 'padding', '.module-widget', 'right' ),
			Themify_Builder_Model::get_field_group( 'padding', '.module-widget', 'bottom' ),
			Themify_Builder_Model::get_field_group( 'padding', '.module-widget', 'left' ),
			Themify_Builder_Model::get_field_group( 'padding', '.module-widget', 'all' ),
			// Margin
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<hr />' )
			),
			array(
				'id' => 'separator_margin',
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . __( 'Margin', 'themify') . '</h4>' ),
			),
			Themify_Builder_Model::get_field_group( 'margin', '.module-widget', 'top' ),
			Themify_Builder_Model::get_field_group( 'margin', '.module-widget', 'right' ),
			Themify_Builder_Model::get_field_group( 'margin', '.module-widget', 'bottom' ),
			Themify_Builder_Model::get_field_group( 'margin', '.module-widget', 'left' ),
			Themify_Builder_Model::get_field_group( 'margin', '.module-widget', 'all' ),
			// Border
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<hr />' )
			),
			array(
				'id' => 'separator_border',
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . __( 'Border', 'themify' ) . '</h4>' )
			),
			Themify_Builder_Model::get_field_group( 'border', '.module-widget', 'top' ),
			Themify_Builder_Model::get_field_group( 'border', '.module-widget', 'right' ),
			Themify_Builder_Model::get_field_group( 'border', '.module-widget', 'bottom' ),
			Themify_Builder_Model::get_field_group( 'border', '.module-widget', 'left' ),
			Themify_Builder_Model::get_field_group( 'border', '.module-widget', 'all' )
		);

		return array(
			array(
				'type' => 'tabs',
				'id' => 'module-styling',
				'tabs' => array(
					'general' => array(
					'label' => __( 'General', 'themify' ),
					'fields' => $general
					),
					'module-title' => array(
						'label' => __( 'Module Title', 'themify' ),
						'fields' => Themify_Builder_Model::module_title_custom_style( $this->slug )
					)
				)
			)
		);
	}

	function widget_fields( $field, $mod_name ) {
		global $wp_widget_factory;
		$output = '';

		if ( $mod_name != 'widget' ) return;

		switch ( $field['type'] ) {
			case 'widget_select':
				$output .= '<select name="'. esc_attr( $field['id'] ) .'" id="'. esc_attr( $field['id'] ) .'" class="tfb_lb_option module-widget-select-field"'. themify_builder_get_control_binding_data( $field ) .'>';
				$output .= '<option></option>';
				foreach ($wp_widget_factory->widgets as $class => $widget ) {
					$output .= '<option value="' . esc_attr( $class ) . '" data-idbase="' . esc_attr( $widget->id_base ) . '">' . esc_html( $widget->name ) . '</option>';
				}
				$output .= '</select>';
			break;

			case 'widget_form':
			$output .= '<div id="'. esc_attr( $field['id'] ) .'" class="module-widget-form-container module-widget-form-placeholder tfb_lb_option"'. themify_builder_get_control_binding_data( $field ) .'></div>';
			break;
		}
		echo $output;
	}

	function widget_get_form() {
		if ( ! wp_verify_nonce( $_POST['tfb_load_nonce'], 'tfb_load_nonce' ) ) die(-1);

		global $wp_widget_factory;
		require_once ABSPATH . 'wp-admin/includes/widgets.php';

		$widget_class = $_POST['load_class'];
		if ( $widget_class == '') die(-1);

		$get_instance = isset( $_POST['widget_instance'] ) ? $_POST['widget_instance'] : '';
		$instance = array();
		if ( is_array( $get_instance ) && count( $get_instance ) > 0 ) {
			foreach ( $get_instance as $k => $s ) {
				$instance = $s;
			}
		}

		$widget = new $widget_class();
		$widget->number = next_widget_id_number( $_POST['id_base'] );

		ob_start();
		$instance = stripslashes_deep( $instance );
		if($widget_class==='WP_Widget_Archives'){// WP checks checkbox === true in WP_Widget_Archives
			if(isset($instance['count']) && !empty($instance['count'])){
				$instance['count'] = true;
			}
			if(isset($instance['dropdown']) && !empty($instance['dropdown'])){
				$instance['dropdown'] = true;
			}
		}
		$widget->form($instance);
		$form = ob_get_clean();

		$widget->form = $form;

		echo $widget->form;
		echo '<br/>';
		die();
	}
}

///////////////////////////////////////
// Module Options
///////////////////////////////////////
Themify_Builder_Model::register_module( 'TB_Widget_Module' );