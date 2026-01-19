# PHP AI Client Demo

A simple demonstration plugin showcasing the integration of the PHP AI Client library with WordPress. This plugin provides a minimal example of how to use AI capabilities in WordPress using pure PHP.

## Description

PHP AI Client Demo is a lightweight example plugin that demonstrates the basics of integrating AI text generation into WordPress using the PHP AI Client library with Anthropic's Claude AI.

## Features

- **Simple AI Integration**: Minimal setup to get AI text generation working in WordPress
- **Anthropic Provider**: Demonstrates using Claude AI for text generation
- **Provider Registry**: Shows how to register and configure AI providers
- **Reusable Function**: Easy-to-use helper function for generating text

## Requirements

- WordPress 6.0 or higher
- PHP 8.0 or higher
- Composer
- Anthropic API key

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

3. Add your Anthropic API key to your `wp-config.php` file:
```php
define( 'ANTHROPIC_API_KEY', 'your-api-key-here' );
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
wp php-ai-sdk-demo-text
```

This will output generated text based on the following prompt: "Write a short poem about WordPress plugins."

## License

GPL-2.0-or-later

## Author

Jonathan Bossenger