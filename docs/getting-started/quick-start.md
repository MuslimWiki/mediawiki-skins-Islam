# Quick Start Guide

> **Version Compatibility**: MediaWiki 1.43+

## 🚀 Getting Started with Islam Skin

This guide will help you quickly set up and start using the Islam skin for your MediaWiki installation.

## 📋 Prerequisites

Before you begin, ensure you have:

- MediaWiki 1.43 or later installed
- PHP 7.4 or later
- Composer (for dependency management)
- Node.js and npm (for development)

## 🛠 Installation

### 1. Install the Skin

#### Using Composer (Recommended)

```bash
composer require mediawiki/islam-skin
```

#### Manual Installation

1. Download the latest release from [GitHub](https://github.com/muslim-wiki/dev.muslim.wiki/releases)
2. Extract the files to `skins/Islam` in your MediaWiki installation
3. Add the following to your `LocalSettings.php`:

```php
wfLoadSkin( 'Islam' );
$wgDefaultSkin = 'islam';
```

### 2. Configure Basic Settings

Add these configurations to your `LocalSettings.php`:

```php
// Enable the skin
$wgDefaultSkin = 'islam';

// Site logo (SVG recommended)
$wgLogos = [
    '1x' => "$wgResourceBasePath/resources/assets/logo.svg",
    'icon' => "$wgResourceBasePath/resources/assets/icon.svg",
];

// Enable responsive images
$wgResponsiveImages = true;
```

## 🎨 Basic Customization

### Changing the Color Scheme

Add to your `LocalSettings.php`:

```php
$wgIslamSkinFeatures = [
    'color-scheme' => 'light', // 'light' or 'dark'
    'primary-color' => '#2c58a0',
    'secondary-color' => '#4a6da7',
    'font-family' => '"Segoe UI", system-ui, -apple-system, sans-serif',
];
```

### Customizing the Header

```php
$wgIslamSkinFeatures['header'] = [
    'show-search' => true,
    'fixed' => true,
    'show-edit-button' => true,
];
```

## 🔧 Common Tasks

### Adding a Custom Logo

1. Place your logo file in `skins/Islam/resources/assets/`
2. Update `LocalSettings.php`:

```php
$wgLogos = [
    '1x' => "$wgResourceBasePath/skins/Islam/resources/assets/your-logo.svg",
    'icon' => "$wgResourceBasePath/skins/Islam/resources/assets/your-icon.svg",
];
```

### Adding Navigation Items

Create a new file `LocalSettings.php`:

```php
$wgIslamSkinNavigation = [
    'main' => [
        'Home' => [
            'href' => '/wiki/Main_Page',
            'icon' => 'home',
        ],
        'About' => [
            'href' => '/wiki/About',
            'icon' => 'info',
        ]
    ]
];
```

## 🚦 Development Setup

### Prerequisites

- Node.js 16+
- npm 8+

### Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/your-org/Islam.git
   cd Islam
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Start the development server:
   ```bash
   npm run dev
   ```

## 🤔 Troubleshooting

### Skin Not Appearing
- Clear your browser cache
- Run `php maintenance/update.php`
- Check PHP error logs

### Styling Issues
- Ensure all dependencies are installed
- Check browser console for CSS/JS errors
- Verify file permissions

## 📚 Learn More

- [Component Documentation](../components/README.md)
- [Template Guide](../templates/README.md)
- [Styling Reference](../reference/styling.md)

## 📝 Version History

| Version | Changes |
|---------|---------|
| 1.0.0   | Initial release |
| 1.1.0   | Added dark mode |
| 1.2.0   | Improved responsive design |

## ❓ Need Help?

If you encounter any issues or have questions:

1. Check our [GitHub Discussions](https://github.com/muslim-wiki/dev.muslim.wiki/discussions) for common questions
2. [Open an issue](https://github.com/muslim-wiki/dev.muslim.wiki/issues)
3. Join our [GitHub Discussions](https://github.com/muslim-wiki/dev.muslim.wiki/discussions)

## 📄 License

This project is licensed under the [GPL-3.0-or-later](https://www.gnu.org/licenses/gpl-3.0) license.
