# Islam Skin Configuration

## Overview
This document outlines the configuration options and structure of the Islam skin as defined in `skin.json`.

## Basic Information

### Core Metadata
- **Name**: Islam
- **Version**: 0.0.1
- **License**: GPL-3.0-or-later
- **MediaWiki Version**: Requires MediaWiki 1.43.0 or later
- **Authors**:
  - [Abdullah Khalid ibn Mika'il Abdullah](https://muslim.wiki/User:Abdullah_Khalid_ibn_Mika'il_Abdullah)

## Skin Registration

### Valid Skin Names
```json
"ValidSkinNames": {
    "islam": {
        "class": "MediaWiki\\Skins\\Islam\\SkinIslam",
        "args": [{
            "name": "islam",
            "responsive": true,
            "supportsMwHeading": true,
            "templateSectionLinks": "SectionLinks",
            "toc": false,
            "wrapSiteNotice": true
        }]
    }
}
```

## Features and Settings

### UI Components
- **Responsive Design**: Enabled
- **Table of Contents**: Disabled by default
- **Site Notice Wrapping**: Enabled
- **Menus**:
  - User Interface Preferences
  - User Menu
  - Notifications
  - Views
  - Actions
  - Language Variants
  - Associated Pages

### Resource Loading

#### JavaScript Modules
- `skins.islam.scripts`: Core JavaScript
- `skins.islam.search`: Search functionality
- `skins.islam.commandPalette`: Command palette feature
- `skins.islam.commandPalette.codex`: Codex components for command palette

#### Style Modules
- `skins.islam.styles`: Core styles
- `skins.islam.codex.styles`: Codex design system styles
- `skins.islam.icons`: Icon set
- `skins.islam.search.styles`: Search component styles

### Internationalization
- **Message Directories**: `i18n/`
- **Supported Messages**:
  - `islam-actions-more-toggle`
  - `islam-drawer-toggle`
  - `islam-jumptotop`
  - `islam-languages-toggle`
  - `islam-preferences-toggle`
  - `islam-search-toggle`
  - `islam-usermenu-toggle`
  - And various MediaWiki core messages

### Integration Features

#### VisualEditor
- **Icon Skins**: Supports VisualEditor with custom icons

#### Dark Mode
- **Disabled**: Dark mode is explicitly disabled for this skin

#### API Modules
- **webapp-manifest**: Provides web app manifest functionality

## Asset Management

### Resource Paths
- **Local Base Path**: Root skin directory
- **Remote Skin Path**: `Islam`

### Skin-Specific Styles
- **Extensions**: Comprehensive support for various MediaWiki extensions
- **MediaWiki Core**: Styling for core MediaWiki interfaces
- **Libraries**: Integration with various JavaScript libraries

## Configuration Options

### Theme Settings
```json
"config": {
    "ThemeDefault": {
        "value": "auto",
        "description": "Default theme (auto/light/dark)"
    }
}
```

## Development Notes

### Autoloading
- **Namespaces**:
  - `MediaWiki\Skins\Islam\`: `includes/`
  - `MediaWiki\Skins\Islam\Tests\`: `tests/phpunit/`

### Testing
- **PHPUnit**: Test directory is set up for PHPUnit tests

## Integration with Extensions
The skin provides specific styles for numerous MediaWiki extensions, including:
- VisualEditor
- UniversalLanguageSelector
- Popups
- MultimediaViewer
- And many more

## Best Practices
1. **Theming**: Use the provided Codex design system components when possible
2. **Responsive Design**: Ensure all components work well on mobile devices
3. **Accessibility**: Follow WCAG guidelines for all UI components
4. **Performance**: Use the resource loader effectively to minimize page load times
