<?php
/**
 * Widget template. This template can be overriden using the "sp_template_image-widget_widget.php" filter.
 * See the readme.txt file for more info.
 */

// Block direct requests
if ( ! defined( 'ABSPATH' ) )
	die( '-1' );

$instance['link'] = apply_filters( 'image_widget_image_link', esc_url( $instance['link'] ), $args, $instance );

echo $before_widget;

if ( ! empty( $title ) ) { echo $before_title . $title . $after_title; }

echo $this->get_image_html( $instance, true );

if ( ! empty( $description ) ) {
	echo '<div class="' . esc_attr( $this->widget_options['classname'] ) . '-description" >';
	echo wpautop( $description );
	if ( ! empty( $instance['link'] ) ) {
		echo '<p><a href="' . esc_attr( $instance['link'] ) . '" >More Information</a></p>';
	}
	echo '</div>';

}

echo $after_widget;
