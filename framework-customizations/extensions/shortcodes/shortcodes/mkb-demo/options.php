<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'title' => array(
		'type' => 'text',
		'label' => 'Titel',
	),
	'caption' => array(
		'type' => 'text',
		'label' => 'Onderschrift'
	),
	'img' => array(
		'type' => 'upload',
		'label' => 'Achtergrond afbeelding'
	),
);