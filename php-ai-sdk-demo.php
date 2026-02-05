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

// Include the Composer autoloader.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
} else {
	wp_die( 'Please run "composer install" in the plugin directory to install the required dependencies.' );
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
	$options->setTimeout(60.0);
	$options->setConnectTimeout(10.0);

	try {
		$result = WordPress\AiClient\AiClient::prompt( $prompt )
						->usingRequestOptions( $options )
						->generateText();
	} catch ( Exception $e ) {
		$result = 'Error: ' . $e->getMessage();
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

