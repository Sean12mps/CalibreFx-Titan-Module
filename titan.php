<?php

/**
 * Module Name: Titan
 * Module Description: Provide calibrefx Titan
 * First Introduced: 2.0
 * Requires Connection: No
 * Auto Activate: No
 * Sort Order: 12
 * Module Tags: Appearance
 */

/** Mobile Template Constants */
define( 'TITAN_URI', CHILD_URI . '/app/modules/titan/' );
define( 'TITAN_URL', CHILD_URL . '/app/modules/titan/' );

require_once dirname( __FILE__ ) . '/titan/titan.php';
