<?php 

global $calibrefx;

$calibrefx->hooks->add( 'admin_menu', 'cfx_titan_add_inpost_layout_box' );
$calibrefx->hooks->add( 'calibrefx_wrapper', 'cfx_titan_custom_hooks', 1, 2 );
$calibrefx->hooks->add( 'admin_init', 'cfx_titan_load_admin_scripts' );


// 	Functions
function cfx_titan_load_admin_scripts () {
	
	wp_enqueue_script( 'cfx_titan-functions', TITAN_URL . '/assets/js/titan-functions.js', array( 'jquery' ), false, true );
	wp_enqueue_style( 'cfx_titan-style', TITAN_URL . '/assets/css/titan-style.css' );
}


function cfx_titan_add_inpost_layout_box () {

	global $calibrefx;

	$hooks = $calibrefx->hooks->get_hook();

	$idx = 35;

	calibrefx_add_post_meta_options(
		'calibrefx_inpost_layout_box', //slug
		'_cfx_titan_post_settings', //option name
		'Hook Action Remove', //option label
		array(
			'option_type' => 'custom',
			'option_custom' => '',
			'option_default' => '',
			'option_filter' => '',
			'option_description' => '',
			'option_attr' => array( 'class' => 'calibrefx-post-meta-heading' ),
		), // Settings config
		$idx //Priority
	);


	foreach ( $hooks as $key => $value ) {

		$tags = $value;

		$hook = $key;

		$idx++;

		calibrefx_add_post_meta_options(
			'calibrefx_inpost_layout_box',  // group id
			'_cfx_titan_post_settings_'. $key .'', // field id and option name
			__( $key, 'calibrefx' ), // Label
			array(
				'option_type' => 'custom',
				'option_custom' => '',
				'option_default' => '',
				'option_filter' => '',
				'option_description' => '',
				'option_attr' => array( 'class' => 'cfx_titan-post-meta-heading closed', 'toggle'=> 'set_hook_'. $key .'' ),
			), // Settings config
			$idx //Priority
		);

		foreach ( $tags as $key => $value ) {

			$idx++;

			calibrefx_add_post_meta_options(
				'calibrefx_inpost_layout_box',  // group id
				'_cfx_titan_hook_settings_'. $value['function'] .'', // field id and option name
				__( ''. $value['function'] .' ( '. $value['priority'] .' )', 'calibrefx' ), // Label
				array(
					'option_type' => 'checkbox',
					'option_items' => '1',
					'option_default' => '0',
					'option_filter' => 'one_zero',
					'option_attr' => array( 'class' => 'set_actions set_hook_'. $hook .'' )
				), // Settings config
				$idx //Priority
			);
		}
	}
}


function cfx_titan_custom_hooks () {

	global $calibrefx;

	$post_id = get_the_ID();

	$hooks = $calibrefx->hooks->get_hook();

	foreach ( $hooks as $key => $value ) {

		$tags = $value;

		$hook = $key;

		foreach ( $tags as $key => $value ) {

			$key_tag = '_cfx_titan_hook_settings_'. $value['function'] .'';

			$hook_remove = get_post_meta( $post_id, $key_tag, true );

			if ( $hook_remove == 1 ) {

				$calibrefx->hooks->remove( $hook, $value['function'], $value['priority'] );
			}
		}
	}
}



// 	Helpers
function cfx_titan_show_hooks () {

	global $calibrefx;

	$hooks = $calibrefx->hooks->get_hook();

	$output = '';

	$output .= '<ul>';

	foreach ( $hooks as $key => $value ) {

		$tags = $value;

		$output .= '<li>>'. $key .'';

		$output .= '<ul>';

		foreach ( $tags as $key => $value ) {

			$output .= '<li>--'. $value['function'] .' ( '. $value['priority'] .' )</li>';
		}

		$output .= '</ul>';

		$output .= '<br>';

		$output .= '</li>';
	}

	$output .= '</ul>';

	echo $output;

	exit;
}