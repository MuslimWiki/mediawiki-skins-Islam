# Islam Skin Directory Structure

## Overview
This document outlines the file and folder structure of the Islam skin, providing a high-level view of how the codebase is organized.

## Root Directory

### Core Files
- `skin.json` - Main skin configuration file
- `README.md` - Project overview and basic documentation
- `CHANGELOG.md` - Version history and changes
- `LICENSE` - License information (GPL-3.0-or-later)
- `SECURITY.md` - Security policy and reporting guidelines
- `CONTRIBUTING.md` - Guidelines for contributors
- `CODE_OF_CONDUCT.md` - Community code of conduct
- `ROADMAP.md` - Project roadmap and future plans

### Main Directories

#### 1. `docs/`
Contains documentation files for the skin.

#### 2. `i18n/`
Internationalization files with translations for various languages.

#### 3. `includes/`
Core PHP classes and components.
```
includes/
├── Api/                    # API endpoints
├── Components/             # Reusable UI components
├── Hooks/                  # MediaWiki hooks
├── ResourceLoader/         # ResourceLoader modules
└── SkinIslam.php           # Main skin class
```

#### 4. `resources/`
Frontend assets including styles, scripts, and images.
```
resources/
├── skins.islam.codex.styles/  # Codex design system components
├── skins.islam.preferences/   # User preference styles
├── skins.islam.scripts/       # JavaScript files
├── skins.islam.search/        # Search component assets
└── skins.islam.styles/        # Main style files
    ├── common/                # Common styles
    ├── components/            # Component-specific styles
    └── skinning/              # MediaWiki core overrides
```

#### 5. `skinStyles/`
Skin-specific style overrides for extensions.

#### 6. `templates/`
Mustache templates for rendering the UI.
```
templates/
├── components/            # Reusable UI components
├── partials/              # Template partials
├── MainMenu.mustache      # Main navigation menu
├── Menu.mustache          # Generic menu component
├── MenuContents.mustache  # Menu contents
├── MenuListItem.mustache  # Individual menu items
└── UserInfo.mustache      # User information and menu
```

## Key Files and Their Purposes

### 1. `skin.json`
- Defines skin metadata and configuration
- Registers ResourceLoader modules
- Configures skin features and options

### 2. `includes/SkinIslam.php`
- Main skin class that extends `SkinMustache`
- Handles template data preparation
- Implements skin-specific functionality

### 3. `resources/skins.islam.styles/skin.less`
- Main stylesheet entry point
- Imports all other style files
- Defines responsive breakpoints

### 4. `templates/MainMenu.mustache`
- Rersponsible for the main navigation menu
- Uses the Menu component

### 5. `templates/UserInfo.mustache`
- Displays user information and menu
- Shows user groups and statistics

## Development Workflow

### Adding New Components
1. Create a new PHP class in `includes/Components/`
2. Add corresponding template in `templates/components/`
3. Add styles in `resources/skins.islam.styles/components/`
4. Update documentation in `docs/`

### Styling Conventions
- Follow BEM naming convention
- Use design tokens from `tokens.less`
- Keep styles scoped to components
- Document complex styles

## Build Process

The skin uses ResourceLoader for asset management. To rebuild assets:

1. Install dependencies:
   ```bash
   npm install
   ```

2. Build for production:
   ```bash
   npm run build
   ```

3. Watch for changes during development:
   ```bash
   npm run dev
   ```

## Testing

### PHPUnit Tests
Tests are located in `tests/phpunit/` and can be run with:
```bash
composer test:unit
```

### Linting
Check code style with:
```bash
composer test:lint
```

## Deployment

1. Update version in `skin.json`
2. Update `CHANGELOG.md`
3. Create a git tag
4. Push to repository

## Extension Integration

The skin provides styles for various MediaWiki extensions in the `skinStyles/` directory. Each extension has its own subdirectory with style overrides.
