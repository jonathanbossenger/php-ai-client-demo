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

if ( ! defined( 'ANTHROPIC_API_KEY' ) ) {
	wp_die( 'Please define the ANTHROPIC_API_KEY constant in your wp-config.php file.' );
}

// Include the Composer autoloader.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
} else {
	wp_die( 'Please run "composer install" in the plugin directory to install the required dependencies.' );
}

add_action( 'init', 'php_ai_sdk_demo_init' );
/**
 * Plugin initialization function. Initializes the AI provider registry.
 *
 * @return void
 */
function php_ai_sdk_demo_init() {
	$registry = new WordPress\AiClient\Providers\ProviderRegistry();
	$registry->registerProvider( WordPress\AiClient\ProviderImplementations\Anthropic\AnthropicProvider::class );
}
/**
 * Generate text using the PHP AI SDK with the Anthropic provider.
 *
 * @param string $prompt The prompt to generate text from.
 *
 * @return string
 */
function php_ai_sdk_demo_generate_text( $prompt ) {
	try {
		$result = WordPress\AiClient\AiClient::prompt( $prompt )
						->usingProvider( 'anthropic' )

						->generateText();
	} catch ( Exception $e ) {
		$result = 'Error: ' . $e->getMessage();
	}
	return $result;
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	WP_CLI::add_command( 'php-ai-sdk-demo-text', function () {
		WP_CLI::line( php_ai_sdk_demo_generate_text( 'Write a short poem about WordPress plugins.' ) );
	} );
}

