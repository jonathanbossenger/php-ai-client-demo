# PHP AI Client Demo

A simple demonstration plugin showcasing the integration of the PHP AI Client library with WordPress. This plugin provides a minimal example of how to use AI capabilities in WordPress using pure PHP.

## Description

PHP AI Client Demo is a lightweight example plugin that demonstrates the basics of integrating AI text generation into WordPress using the PHP AI Client library. The plugin works with any supported AI provider including Anthropic Claude, OpenAI, and local AI models.

## Features

- **Simple AI Integration**: Minimal setup to get AI text generation working in WordPress
- **Multi-Provider Support**: Works with any AI provider supported by the PHP AI Client library
- **Custom Request Options**: Demonstrates configuring timeouts for local and remote AI models
- **Reusable Function**: Easy-to-use helper function for generating text
- **WP-CLI Integration**: Generate text from the command line

## Requirements

- WordPress 6.0 or higher
- PHP 8.0 or higher
- Composer
- API key for your chosen AI provider (or access to a local AI model)

## Installation

1. Clone or download this plugin to your WordPress plugins directory:
```bash
cd wp-content/plugins
git clone git clone git@github.com:jonathanbossenger/php-ai-client-demo
```

2. Install PHP dependencies:
```bash
cd php-ai-client-demo
composer install
```

3. Configure your AI provider credentials in your `wp-config.php` file. The PHP AI Client library automatically detects provider-specific constants:

For Anthropic Claude:
```php
define( 'ANTHROPIC_API_KEY', 'your-api-key-here' );
```

For OpenAI:
```php
define( 'OPENAI_API_KEY', 'your-api-key-here' );
```

For Google Gemini:
```php
define( 'GOOGLE_API_KEY', 'your-api-key-here' );
```

4. Activate the plugin through the WordPress admin interface or via WP-CLI:
```bash
wp plugin activate php-ai-client-demo
```

## Usage

### Generate Text

Use the provided helper function to generate text from a prompt:

```php
$prompt = 'Write a short introduction about WordPress';
$generated_text = php_ai_sdk_demo_generate_text( $prompt );
echo $generated_text;
```

### WP-CLI Command

You can also use the WP-CLI command to generate text:

```bash
wp php-ai-sdk-demo-text "Write a short introduction about WordPress"
```

This will output generated text based on the prompt.

## License

GPL-2.0-or-later

## Author

Jonathan Bossenger