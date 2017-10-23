<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array(
	'page_builder' => array(
		'title'       => esc_html__( 'Demo', '_mkb_' ),
		'description' => esc_html__( 'Demo tekst + onderschrift + afbeelding', '_mkb_' ),
		'tab'         => esc_html__( 'MKB Punt', '_mkb_' ),
		'popup_size'  => 'medium',
		'disable_correction' => true,
	),
);