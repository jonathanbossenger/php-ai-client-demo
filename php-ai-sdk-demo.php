<?php
/**
 * Plugin Name: PHP AI SDK Demo
 * Description: A demo plugin to showcase the integration of the PHP AI SDK.
 * Version: 1.0.0
 * Author: Jonathan Bossenger
 * Plugin URI: https://github.com/jonathanbossenger/wp-ai-sdk-demo
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'ANTHROPIC_API_KEY' ) ) {
	wp_die( 'Please define the ANTHROPIC_API_KEY constant in your wp-config.php file.' );
}

// Include the Composer autoloader.
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
} else {
	wp_die( 'Please run "composer install" in the plugin directory to install the required dependencies.' );
}

use WordPress\AiClient\AiClient;
use WordPress\AiClient\Providers\ProviderRegistry;
use WordPress\AiClient\ProviderImplementations\Anthropic\AnthropicProvider;

// Initialize the registry and register providers
function php_ai_sdk_demo_init_registry() {
	$registry = new ProviderRegistry();
	$registry->registerProvider(AnthropicProvider::class);
	return $registry;
}

function php_ai_sdk_demo_generate_text( $prompt ) {
	try {
		// Initialize registry with Anthropic provider
		$registry = php_ai_sdk_demo_init_registry();

		// Generate text using the registry
		$text = AiClient::prompt( $prompt )
		                ->usingProvider('anthropic')
		                ->generateText();

		return $text;
	} catch (Exception $e) {
		return 'Error: ' . $e->getMessage();
	}
}