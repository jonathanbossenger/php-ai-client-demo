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
   git clone <repository-url> php-ai-client-demo
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

### In a Theme or Plugin

```php
// Example: Generate content for a custom post type
add_action( 'save_post_my_custom_type', function( $post_id ) {
    if ( empty( get_post_meta( $post_id, '_ai_generated_summary', true ) ) ) {
        $post = get_post( $post_id );
        $prompt = "Write a brief summary of this content: " . $post->post_title;
        $summary = php_ai_sdk_demo_generate_text( $prompt );
        update_post_meta( $post_id, '_ai_generated_summary', $summary );
    }
} );
```

### Custom Provider Configuration

The plugin initializes the Anthropic provider by default. You can extend this to use other providers:

```php
add_action( 'init', function() {
    $registry = new WordPress\AiClient\Providers\ProviderRegistry();
    
    // Register Anthropic (already done by the plugin)
    $registry->registerProvider( 
        WordPress\AiClient\ProviderImplementations\Anthropic\AnthropicProvider::class 
    );
    
    // You can register additional providers here
}, 20 );
```

## Configuration

### API Key Setup

The plugin requires an Anthropic API key to be defined in your `wp-config.php`:

```php
define( 'ANTHROPIC_API_KEY', 'sk-ant-xxxxxxxxxxxxxxxxxxxxx' );
```

You can obtain an API key from [Anthropic's website](https://www.anthropic.com/).

### Error Handling

The plugin will:
- Show a fatal error if the `ANTHROPIC_API_KEY` constant is not defined
- Show a fatal error if Composer dependencies are not installed
- Return an error message if text generation fails

## Dependencies

### PHP Dependencies
- `wordpress/php-ai-client`: ^0.3.1
- `guzzlehttp/guzzle`: ^7.10

## File Structure

```
php-ai-client-demo/
├── php-ai-sdk-demo.php      # Main plugin file
├── composer.json            # PHP dependencies
├── composer.lock            # Locked dependency versions
└── vendor/                  # PHP dependencies (generated)
```

## How It Works

1. **Plugin Initialization**: On WordPress `init`, the plugin initializes the provider registry
2. **Provider Registration**: The Anthropic provider is registered with the PHP AI Client
3. **Text Generation**: When `php_ai_sdk_demo_generate_text()` is called:
   - A prompt is sent to the AI Client
   - The Anthropic provider is specified
   - Text is generated and returned
   - Any errors are caught and returned as error messages

## Code Example

The main plugin file demonstrates a complete, minimal implementation:

```php
// Initialize the provider registry
add_action( 'init', 'php_ai_sdk_demo_init' );
function php_ai_sdk_demo_init() {
    $registry = new WordPress\AiClient\Providers\ProviderRegistry();
    $registry->registerProvider( 
        WordPress\AiClient\ProviderImplementations\Anthropic\AnthropicProvider::class 
    );
}

// Generate text using the AI Client
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
```

## Security

- API keys should be stored in `wp-config.php`, never committed to version control
- Add `wp-config.php` to your `.gitignore` file
- Consider using environment variables for API keys in production

## Troubleshooting

### "Please run composer install" Error

Make sure you've installed the PHP dependencies:
```bash
cd wp-content/plugins/php-ai-client-demo
composer install
```

### "Please define the ANTHROPIC_API_KEY constant" Error

Add your API key to `wp-config.php`:
```php
define( 'ANTHROPIC_API_KEY', 'your-api-key-here' );
```

### Text Generation Errors

If you receive an error message when generating text:
- Verify your API key is valid
- Check that you have sufficient API credits
- Ensure your server can make outbound HTTPS requests
- Check the error message for specific details

## Development

### Code Standards

The plugin follows WordPress Coding Standards. To check your code:

```bash
composer install --dev
./vendor/bin/phpcs
```

## Extending the Plugin

This plugin is designed as a starting point. You can extend it by:

1. Adding support for additional AI providers
2. Creating custom WordPress admin pages for AI interactions
3. Building custom post type integrations
4. Adding caching for AI responses
5. Implementing more advanced prompt engineering

## License

GPL-2.0-or-later

## Author

Jonathan Bossenger

## Support

For issues and questions:
- GitHub Issues: https://github.com/jonathanbossenger/php-ai-sdk-demo/issues
- Documentation: See the PHP AI Client documentation for more details on the underlying library

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Related Projects

- [WP AI Client Demo](../wp-ai-client-demo/) - A more comprehensive demo with JavaScript integration
- [PHP AI Client](https://github.com/jonathanbossenger/php-ai-client) - The underlying PHP library
- [WP AI Client](https://github.com/jonathanbossenger/wp-ai-client) - WordPress-specific AI client wrapper
