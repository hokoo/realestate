<?php
use RE\Functions;

function real() {
	return Functions::getInstance();
}

if ( DEV_ENV )
real()->require_all( __DIR__ . '/dev/' );

real()->require_all( __DIR__ . '/inc/' );
