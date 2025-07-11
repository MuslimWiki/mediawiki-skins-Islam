# Changelog

All notable changes to this project will be documented in this file. See [standard-version](https://github.com/conventional-changelog/standard-version) for commit guidelines.

## [0.0.2](https://github.com/MuslimWiki/mediawiki-skins-Islam/compare/v0.0.1...v0.0.2) (2025-07-11)

### Added
- Comprehensive documentation for the Islam skin, including:
  - Component and template reference
  - Development guidelines
  - Architecture overview
  - Getting started guides
  - API documentation
- Initial development of interactive documentation viewer (experimental)
- Automated documentation link checking

### Changed
- Reorganized project structure for better modularity:
  - Moved `IslamDashboard/` to `modules/IslamDashboard/`
  - Moved `docs/islam-dashboard/` to `docs/modules/islam-dashboard/`
- Reorganized documentation into logical sections
- Standardized documentation formatting and style
- Improved cross-referencing between documents
- Enhanced code examples and usage guides
- Updated README with documentation setup instructions
- Improved mobile responsiveness of documentation
- Updated development dependencies

### Known Issues
- Documentation viewer webview has known issues with link handling
- Some navigation features may not work as expected
- These issues will be addressed in a future release

## [0.0.1](https://github.com/MuslimWiki/mediawiki-skins-Islam/compare/v0.0.0...v0.0.1) (2025-07-08)

Initial release of the Islam skin, a responsive and modern MediaWiki skin designed specifically for Islamic knowledge bases.

### Features

- **Responsive Design**: Fully responsive layout that works on all device sizes
- **Modern UI Components**: Clean and intuitive user interface components
- **RTL Support**: Full right-to-left language support for Arabic and other RTL languages
- **Accessibility**: Built with accessibility best practices in mind
- **Multilingual**: Includes translation files for multiple languages (ar, bn, br, ckb, etc.)
- **Customizable**: Easy to customize through template files and configuration
- **Performance Optimized**: Lightweight and fast-loading design
- **Localization Support**: 
  - Includes `template.json` for easy creation of new language files
  - Standardized metadata format across all language files
  - Proper language codes and direction settings
  - Contributor attribution in translation files

### Components

- **Header**: Responsive header with logo and navigation
- **Search**: Integrated search functionality
- **User Menu**: Easy access to user account and preferences
- **Page Tools**: Quick access to page actions and tools
- **Sidebar**: Collapsible sidebar for navigation
- **Footer**: Comprehensive footer with site links and information
- **Drawer**: Mobile-friendly navigation drawer

### Bug Fixes

- Initial release - no previous bugs to fix

### Performance Improvements

- Optimized asset loading
- Minimal CSS and JavaScript footprint
- Efficient template rendering

### Documentation

- Added comprehensive README with installation and configuration instructions
- Included CONTRIBUTING guidelines
- Added CODE_OF_CONDUCT for community contributions
- Created CREDITS file to acknowledge contributors

### Localization

- Added support for multiple languages including:
  - Arabic (ar)
  - Bengali (bn)
  - Breton (br)
  - Central Kurdish (ckb)
  - And more...

### Dependencies

- MediaWiki 1.35+
- PHP 7.4+

### Known Issues

- This is the initial release. Please report any issues on our [GitHub repository](https://github.com/MuslimWiki/mediawiki-skins-Islam/issues).

