# Copilot Instructions for PHP AI Client Demo

## Project Overview

This is a WordPress plugin demonstrating integration of the PHP AI Client library with multiple AI providers. It provides a minimal example of AI text generation in WordPress using pure PHP, supporting Anthropic Claude, OpenAI, local AI models, and other providers supported by the PHP AI Client library.

## Requirements

- WordPress 6.0+
- PHP 8.0+
- API key for chosen AI provider (or access to a local AI model)

## Setup & Dependencies

Install PHP dependencies:
```bash
composer install
```

Activate the plugin:
```bash
wp plugin activate php-ai-client-demo
```

## WordPress Plugin Conventions

- Main plugin file: `php-ai-sdk-demo.php` (contains plugin header and initialization)
- All code follows WordPress Coding Standards (WPCS)
- Plugin uses WordPress hooks and WP-CLI integration where appropriate
- Composer autoloader is required and checked at runtime

## Architecture

This is a simple, single-file WordPress plugin with the following key components:

1. **Composer Autoloading**: Vendor dependencies are loaded via `vendor/autoload.php`
2. **Core Function**: `php_ai_sdk_demo_generate_text()` wraps the AI Client library for text generation
3. **AI Client Usage**: Uses `WordPress\AiClient\AiClient` with automatic provider detection based on available API keys
4. **Request Options**: Configures custom timeouts (60s timeout, 10s connect timeout) to support slower local AI models
5. **WP-CLI Command**: Provides `wp php-ai-sdk-demo-text` command for CLI text generation

## Key Dependencies

- `wordpress/php-ai-client` (^0.3.1): WordPress AI Client library for provider-agnostic AI integration
- `guzzlehttp/guzzle` (^7.10): HTTP client used by the AI Client

## Coding Standards

Run PHPCS to check code against WordPress standards:
```bash
./vendor/bin/phpcs --standard=WordPress php-ai-sdk-demo.php
```

Fix auto-fixable issues:
```bash
./vendor/bin/phpcbf --standard=WordPress php-ai-sdk-demo.php
```

## Usage Patterns

### Generate Text Programmatically
```php
$prompt = 'Write a short introduction about WordPress';
$generated_text = php_ai_sdk_demo_generate_text( $prompt );
```

### WP-CLI Command
```bash
wp php-ai-sdk-demo-text "Your prompt here"
```

## Error Handling

The plugin wraps AI Client calls in try-catch blocks, returning error messages as strings prefixed with "Error: " when exceptions occur.

## Configuration

API keys are defined in `wp-config.php`. The PHP AI Client library automatically detects provider-specific constants:

**Anthropic Claude:**
```php
define( 'ANTHROPIC_API_KEY', 'your-api-key-here' );
```

**OpenAI:**
```php
define( 'OPENAI_API_KEY', 'your-api-key-here' );
```

**Local AI models:** No API key required if using a locally-hosted model.

Consult the [PHP AI Client documentation](https://github.com/WordPress/php-ai-client) for other provider configurations.
