<?php
add_action('astra_entry_bottom', 'real_estate_mf', 10);
add_filter( 'real_metadata_value_screen', 'real_metadata_value_screen', 10, 2 );

function real_estate_mf(){
	$data = get_field_objects();
	$items = [];
	foreach ( $data as $field ){
		$items []= ['tag' => 'col', 'content' => [
			esc_html( $field['label'] ),
			esc_html( apply_filters( 'real_metadata_value_screen', $field['value'], $field ) ),
		]];
	}

	real()->render( 'estate-meta', [
		$items
	] );
}

function real_metadata_value_screen( $value, $field ){
	$result = $value;
	if ( 'number' == $field['type'] ){
		$result = number_format( ( int ) $result, 0, '', '&nbsp;' );
	}

	return $result;
}
