<?php

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly
/**
 * Module Name: Icon
 * Description: Display Icon content
 */

class TB_Icon_Module extends Themify_Builder_Module {

	function __construct() {
		parent::__construct(array(
			'name' => __( 'Icon', 'themify' ),
			'slug' => 'icon'
		));
	}

	public function get_title($module) {
		$text = isset( $module['mod_settings']['mod_title_icon'] ) ? $module['mod_settings']['mod_title_icon'] : '';
		$return = wp_trim_words( $text, 100 );
		return $return;
	}

	public function get_options() {
		return array(
			array(
				'id' => 'icon_size',
				'type' => 'radio',
				'label' => __( 'Size', 'themify' ),
				'options' => array(
					'normal' => __( 'Normal', 'themify' ),
					'small' => __( 'Small', 'themify' ),
					'large' => __( 'Large', 'themify' ),
					'xlarge' => __( 'xLarge', 'themify' )
				),
				'default' => 'normal',
			),
			array(
				'id' => 'icon_style',
				'type' => 'radio',
				'label' => __( 'Icon Background Style', 'themify' ),
				'options' => array(
					'circle' => __( 'Circle', 'themify' ),
					'rounded' => __( 'Rounded', 'themify' ),
					'squared' => __( 'Squared', 'themify' ),
					'none' => __( 'None', 'themify' )
				),
				'default' => 'circle',
			),
			array(
				'id' => 'icon_arrangement',
				'type' => 'radio',
				'label' => __( 'Arrangement ', 'themify' ),
				'options' => array(
					'icon_horizontal' => __( 'Horizontally', 'themify' ),
					'icon_vertical' => __( 'Vertically', 'themify' ),
				),
				'default' => 'icon_horizontal'
			),
			array(
				'id' => 'content_icon',
				'type' => 'builder',
				'new_row_text' => __( 'Add new icon', 'themify' ),
				'options' => array(
					array(
						'id' => 'icon_container',
						'type' => 'multi',
						'label' => __( 'Icon', 'themify' ),
						'wrap_with_class' => 'fullwidth',
						'options' => array(
							array(
								'id' => 'icon',
								'type' => 'text',
								'iconpicker' => true,
								'label' => '',
								'class' => 'fullwidth themify_field_icon',
								'wrap_with_class' => 'fullwidth',
								'render_callback' => array(
									'repeater' => 'content_icon'
								)
							),
							array(
								'id' => 'icon_color_bg',
								'type' => 'layout',
								'label' => '',
								'options' => Themify_Builder_Model::get_colors(),
								'bottom' => false,
								'wrap_with_class' => 'fullwidth',
								'render_callback' => array(
									'repeater' => 'content_icon'
								)
							),
						)
					),
					array(
						'id' => 'label',
						'type' => 'text',
						'label' => __( 'Label', 'themify' ),
						'class' => 'fullwidth',
						'render_callback' => array(
							'repeater' => 'content_icon'
						)
					),
					array(
						'id' => 'link',
						'type' => 'text',
						'label' => __( 'Link', 'themify' ),
						'class' => 'fullwidth',
						'binding' => array(
							'empty' => array(
								'hide' => array('link_options')
							),
							'not_empty' => array(
								'show' => array('link_options', 'lightbox_size')
							)
						),
						'render_callback' => array(
							'repeater' => 'content_icon'
						)
					),
					array(
						'id' => 'link_options',
						'type' => 'radio',
						'label' => __( 'Open Link In', 'themify' ),
						'options' => array(
							'regular' => __( 'Same window', 'themify' ),
							'lightbox' => __( 'Lightbox ', 'themify' ),
							'newtab' => __( 'New tab ', 'themify' )
						),
						'new_line' => false,
						'default' => 'regular',
						'option_js' => true,
						'render_callback' => array(
							'repeater' => 'content_icon'
						),
						'wrap_with_class' => 'link_options'
					),
					array(
						'id' => 'lightbox_size',
						'type' => 'multi',
						'label' => __( 'Lightbox Dimension', 'themify' ),
						'options' => array(
							array(
								'id' => 'lightbox_width',
								'type' => 'text',
								'label' => __( 'Width', 'themify' ),
								'value' => '',
								'render_callback' => array(
									'repeater' => 'content_icon'
								)
							),
							array(
								'id' => 'lightbox_size_unit_width',
								'type' => 'select',
								'label' => __( 'Units', 'themify' ),
								'options' => array(
									'pixels' => __( 'px ', 'themify' ),
									'percents' => __( '%', 'themify' )
								),
								'default' => 'pixels',
								'render_callback' => array(
									'repeater' => 'content_icon'
								)
							),
							array(
								'id' => 'lightbox_height',
								'type' => 'text',
								'label' => __( 'Height', 'themify' ),
								'value' => '',
								'render_callback' => array(
									'repeater' => 'content_icon'
								)
							),
							array(
								'id' => 'lightbox_size_unit_height',
								'type' => 'select',
								'label' => __( 'Units', 'themify' ),
								'options' => array(
									'pixels' => __( 'px ', 'themify' ),
									'percents' => __( '%', 'themify' )
								),
								'default' => 'pixels',
								'render_callback' => array(
									'repeater' => 'content_icon'
								)
							)
						),
						'wrap_with_class' => 'tf-group-element tf-group-element-lightbox'
					)
				)
			),
			// Additional CSS
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<hr/>')
			),
			array(
				'id' => 'css_icon',
				'type' => 'text',
				'label' => __( 'Additional CSS Class', 'themify' ),
				'class' => 'large exclude-from-reset-field',
				'help' => sprintf('<br/><small>%s</small>', __( 'Add additional CSS class(es) for custom styling', 'themify' ))
			)
		);
	}

	public function get_default_settings() {
		$settings = array(
			'content_icon' => array(
				array(
					'icon' => 'fa-home',
					'label' => esc_html__( 'Icon label', 'themify' ),
					'icon_color_bg' => 'blue',
					'link_options' => 'regular'
				)
			)
		);
		return $settings;
	}

	public function get_animation() {
		$animation = array(
			array(
				'type' => 'separator',
				'meta' => array('html' => '<h4>' . esc_html__( 'Appearance Animation', 'themify' ) . '</h4>')
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
				'selector' => ' div.module-icon',
				'option_js' => true
			),
			array(
				'id' => 'background_color',
				'type' => 'color',
				'label' => __( 'Background Color', 'themify' ),
				'class' => 'small',
				'prop' => 'background-color',
				'selector' => array(' div.module-icon'),
			),
			// Font
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<hr />')
			),
			array(
				'id' => 'separator_font',
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . __( 'Font', 'themify' ) . '</h4>' )
			),
			array(
				'id' => 'font_family',
				'type' => 'font_select',
				'label' => __( 'Font Family', 'themify' ),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => ' div.module-icon',
			),
			array(
				'id' => 'font_color',
				'type' => 'color',
				'label' => __( 'Font Color', 'themify' ),
				'class' => 'small',
				'prop' => 'color',
				'selector' => array(' div.module-icon')
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
						'selector' => array(' div.module-icon i', ' div.module-icon a', ' div.module-icon span'),
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
						'selector' => array(' div.module-icon i', ' div.module-icon a', ' div.module-icon span'),
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
				'selector' => ' div.module-icon',
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
				'selector' => ' div.module-icon span'
			),
			array(
				'id' => 'link_color_hover',
				'type' => 'color',
				'label' => __( 'Color Hover', 'themify' ),
				'class' => 'small',
				'prop' => 'color',
				'selector' => ' div.module-icon .module-icon-item:hover span'
			),
			array(
				'id' => 'text_decoration',
				'type' => 'select',
				'label' => __( 'Text Decoration', 'themify' ),
				'meta' => Themify_Builder_Model::get_text_decoration(),
				'prop' => 'text-decoration',
				'selector' => array(' div.module-icon a span', ' div.module-icon a i')
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
			Themify_Builder_Model::get_field_group( 'padding', ' .module-icon', 'top' ),
			Themify_Builder_Model::get_field_group( 'padding', ' .module-icon', 'right' ),
			Themify_Builder_Model::get_field_group( 'padding', ' .module-icon', 'bottom' ),
			Themify_Builder_Model::get_field_group( 'padding', ' .module-icon', 'left' ),
			Themify_Builder_Model::get_field_group( 'padding', ' .module-icon', 'all' ),
			// Margin
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_margin',
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . __( 'Margin', 'themify') . '</h4>' ),
			),
			Themify_Builder_Model::get_field_group( 'margin', ' .module-icon', 'top' ),
			Themify_Builder_Model::get_field_group( 'margin', ' .module-icon', 'right' ),
			Themify_Builder_Model::get_field_group( 'margin', ' .module-icon', 'bottom' ),
			Themify_Builder_Model::get_field_group( 'margin', ' .module-icon', 'left' ),
			Themify_Builder_Model::get_field_group( 'margin', ' .module-icon', 'all' ),
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
			Themify_Builder_Model::get_field_group( 'border', ' .module-icon', 'top' ),
			Themify_Builder_Model::get_field_group( 'border', ' .module-icon', 'right' ),
			Themify_Builder_Model::get_field_group( 'border', ' .module-icon', 'bottom' ),
			Themify_Builder_Model::get_field_group( 'border', ' .module-icon', 'left' ),
			Themify_Builder_Model::get_field_group( 'border', ' .module-icon', 'all' )
		);

		$icon = array(
			// Background
			array(
				'id' => 'separator_image_background',
				'title' => '',
				'description' => '',
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . __( 'Background', 'themify' ) . '</h4>' )
			),
			array(
				'id' => 'background_color_icon',
				'type' => 'color',
				'label' => __( 'Background Color', 'themify' ),
				'class' => 'small',
				'prop' => 'background-color',
				'selector' => ' div.module-icon .module-icon-item i'
			),
			array(
				'id' => 'background_color_icon_hover',
				'type' => 'color',
				'label' => __( 'Background Hover', 'themify' ),
				'class' => 'small',
				'prop' => 'background-color',
				'selector' => ' div.module-icon .module-icon-item:hover i'
			),
			// Font
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<hr />' )
			),
			array(
				'id' => 'separator_font',
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . __( 'Color', 'themify' ) . '</h4>' )
			),
			array(
				'id' => 'font_color_icon',
				'type' => 'color',
				'label' => __( 'Color', 'themify' ),
				'class' => 'small',
				'prop' => 'color',
				'selector' => ' div.module-icon .module-icon-item i'
			),
			array(
				'id' => 'font_color_icon_hover',
				'type' => 'color',
				'label' => __( 'Color Hover', 'themify' ),
				'class' => 'small',
				'prop' => 'color',
				'selector' => ' div.module-icon .module-icon-item:hover i'
			),
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
					'icon' => array(
						'label' => __( 'Icon', 'themify' ),
						'fields' => $icon
					)
				)
			),
		);
	}

}

///////////////////////////////////////
// Module Options
///////////////////////////////////////
Themify_Builder_Model::register_module( 'TB_Icon_Module' );