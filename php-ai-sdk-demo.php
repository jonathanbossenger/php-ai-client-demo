<?php
/**
 * Plugin Name: PHP AI SDK Demo
 * Description: A demo plugin to showcase the integration of the PHP AI SDK.
 * Version: 1.0.0
 * Author: Jonathan Bossenger
 * Plugin URI: https://github.com/jonathanbossenger/php-ai-sdk-demo
 *
 * @package php-ai-sdk-demo
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if WordPress version is greater than or equal to 7.0, and if so, skip the autoloader.
if ( ! isset( $wp_version ) || version_compare( $wp_version, '7.0-alpha', '<' ) ) {
	// Include the Composer autoloader.
	if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
		require_once __DIR__ . '/vendor/autoload.php';
	} else {
		wp_die( 'Please run "composer install" in the plugin directory to install the required dependencies.' );
	}
}

/**
 * Generate text using the PHP AI SDK with the Anthropic provider.
 *
 * @param string $prompt The prompt to generate text from.
 *
 * @return string
 */
function php_ai_sdk_demo_generate_text( $prompt ) {

	/**
	 * Set custom request options for the AI Client. This is optional, but demonstrates how to customize the request.
	 */
	$options = new \WordPress\AiClient\Providers\Http\DTO\RequestOptions();
	$options->setTimeout( 60.0 );
	$options->setConnectTimeout( 10.0 );

	if ( function_exists( 'wp_ai_client_prompt' ) ) { // WordPress 7.0 helper function for AI Client.
		$result = wp_ai_client_prompt( $prompt )
			->using_request_options( $options )
			->generate_text();
	} else {
		$result = \WordPress\AiClient\AiClient::prompt( $prompt )
												->usingRequestOptions( $options )
												->generateText();
	}

	return $result;
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	WP_CLI::add_command(
		'php-ai-sdk-demo-text',
		function ( $args ) {
			if ( empty( $args[0] ) ) {
				WP_CLI::error( 'Please provide a prompt.' );
			}
			WP_CLI::line( php_ai_sdk_demo_generate_text( 'Write a short poem about WordPress plugins.' ) );
		},
		array(
			'shortdesc' => 'Generate text using the PHP AI SDK with the Anthropic provider. Usage: wp php-ai-sdk-demo-text "Your prompt here"',
		)
	);
}
