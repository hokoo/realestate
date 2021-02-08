<?php

add_action( 'p2p_init', 'real_e2l' );

function real_e2l() {
	p2p_register_connection_type( [
		'name'			=> 'object2city',
		'from'			=> 'estate',
		'cardinality'	=> 'many-to-one',
		'to' 			=> 'location',
		'sortable'		=> 'to',
		'admin_box'		=> [
			'context'=> 'side',
		],
		'title'			=> [
			'from'	=> 'Город',
			'to'	=> 'Объекты'
		],
		'admin_column'	=> true,
	] );
}
