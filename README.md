# Islam Skin for MediaWiki

[![License: GPL v3+](https://img.shields.io/badge/License-GPL%20v3%2B-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)

A modern, responsive, and accessible MediaWiki skin specifically designed for Islamic knowledge bases. Built with performance, accessibility, and internationalization in mind.

![Islam Skin Preview](.github/preview.jpg)

## 🌟 Features

- **Fully Responsive**: Works on all devices from mobile to desktop
- **Right-to-Left (RTL) Support**: Full support for Arabic and other RTL languages
- **Dark/Light Mode**: Built-in theme switching with system preference detection
- **Accessibility**: WCAG 2.1 AA compliant
- **Performance Optimized**: Fast loading with minimal overhead
- **Modern UI**: Clean, intuitive interface with customizable components
- **Multilingual**: Comprehensive i18n support with template for new translations

## 🚀 Installation

### Requirements
- MediaWiki 1.43.0 or later
- PHP 7.4 or later

### Steps
1. Download and place the `Islam` folder in your `skins/` directory
2. Add the following to your `LocalSettings.php`:
   ```php
   wfLoadSkin('Islam');
   $wgDefaultSkin = 'islam';
   $wgDefaultMobileSkin = 'islam';
   ```

## ⚙️ Configuration

Add these settings to your `LocalSettings.php` to customize the skin:

```php
// Theme and Display
$wgIslamThemeDefault = 'light'; // 'light', 'dark', or 'auto'
$wgIslamThemeColor = '#131a21';
$wgIslamEnableARFonts = true; // Enable Arabic-script font optimizations

// Features
$wgIslamEnableCollapsibleSections = true;
$wgIslamShowPageTools = true;
$wgIslamEnableCommandPalette = true;
$wgIslamMaxSearchResults = 6;

// PWA Support
$wgIslamEnableManifest = true;
$wgIslamManifestThemeColor = '#131a21';
$wgIslamManifestBackgroundColor = '#131a21';

// Table Styling
$wgIslamTableNowrapClasses = [
    "islam-table-nowrap",
    "diff",
    "mw-changeslist-line",
    "infobox",
    "dataTable"
];
```

## 🎨 Customization

### Footer
Customize the footer content through these settings:
```php
$wgIslamFooterDesc = 'Your footer description';
$wgIslamFooterTagline = 'Your tagline text';
```
Or edit these messages in the wiki:
- `MediaWiki:Islam-footer-desc`
- `MediaWiki:Islam-footer-tagline`

### CSS/JS Customization
- JavaScript: `MediaWiki:Islam.js`
- CSS: `MediaWiki:Islam.css`

## 🤝 Contributing

We welcome contributions! Please read our [Contributing Guidelines](CONTRIBUTING.md) for details on how to contribute to this project.

### Development Setup
1. Clone the repository
2. Install dependencies: `npm install`
3. Build assets: `npm run build`

## 📜 License

This project is licensed under the GPL-3.0-or-later License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- Built with ❤️ by the MuslimWiki team
- Inspired by various modern web interfaces
- Uses [Codex](https://doc.wikimedia.org/codex/latest/) for UI components

---
*Part of the [MuslimWiki](https://muslim.wiki) project*
