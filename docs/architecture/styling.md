# Islam Skin Styling Architecture

## Overview
This document outlines the styling architecture of the Islam skin, which uses Less for CSS preprocessing. The skin follows a component-based architecture with a clear separation of concerns.

## Core Files

### Main Entry Point (`skin.less`)
The primary entry point that imports all other style files. It's organized into several sections:

1. **Common Styles**: Base typography, variables, and mixins
2. **Layout**: Responsive layout definitions
3. **Components**: Individual UI components
4. **Skinning**: Overrides for MediaWiki core styles
5. **Print Styles**: Print-specific styles

## Directory Structure

```
resources/
├── skins.islam.styles/
│   ├── common/            # Common styles and utilities
│   │   ├── common.less
│   │   ├── content.less
│   │   ├── features.less
│   │   ├── hacks.less
│   │   ├── links.less
│   │   ├── print.less
│   │   ├── progressbar.less
│   │   ├── typography.less
│   │   └── viewTransition.less
│   │
│   ├── components/        # Individual UI components
│   │   ├── Button.less
│   │   ├── Drawer.less
│   │   ├── Footer.less
│   │   ├── Header.less
│   │   ├── Menu.less
│   │   ├── PageHeader.less
│   │   ├── PageSidebar.less
│   │   ├── Search.less
│   │   └── UserInfo.less
│   │       # ... and more
│   │
│   ├── skinning/          # MediaWiki core overrides
│   │   ├── content.media-common.less
│   │   ├── content.media-screen.less
│   │   ├── content.tables.less
│   │   ├── elements.less
│   │   └── interface-*.less
│   │
│   ├── fonts.less         # Font face definitions
│   ├── layout.less        # Main layout structure
│   ├── skin.less          # Main entry point
│   └── tokens.less        # Design tokens
│
├── skins.islam.codex.styles/  # Codex design system components
│   └── CdxButton.less
│
└── skins.islam.search/    # Search component styles
    ├── skins.islam.search.less
    └── components/
        ├── TypeaheadList.less
        ├── TypeaheadListItem.less
        └── TypeaheadPlaceholder.less
```

## Key Features

### 1. Design Tokens
- Defined in `tokens.less`
- Centralized variables for colors, spacing, typography, etc.
- Promotes consistency across the skin

### 2. Component-Based Architecture
- Each UI component has its own `.less` file
- Components are self-contained and reusable
- Follows BEM (Block Element Modifier) naming convention

### 3. Responsive Design
- Uses media queries for different screen sizes
- Mobile-first approach
- Responsive utilities in `common/features.less`

### 4. MediaWiki Integration
- Overrides for MediaWiki core styles in the `skinning/` directory
- Maintains compatibility with core features
- Handles both Parsoid and legacy content

## Media Queries

The skin uses a mobile-first approach with the following breakpoints:

```less
@media screen {
    // Base styles (mobile first)
}

@media ( min-width: @width-breakpoint-tablet ) {
    // Tablet and up
}

@media ( min-width: @width-breakpoint-desktop ) {
    // Desktop and up
}

@media ( min-width: @width-breakpoint-desktop-wide ) {
    // Wide desktop
}
```

## Best Practices

### 1. Use Variables
Always use variables from `tokens.less` for colors, spacing, and typography.

```less
.example {
    color: @color-base;
    margin-bottom: @spacing-100;
    font-family: @font-family-base;
}
```

### 2. Component Structure
Each component should follow this structure:

```less
// Component Name
// Description of the component

.mw-component-name {
    // Base styles

    &__element {
        // Element styles
    }

    &--modifier {
        // Modifier styles
    }
}
```

### 3. Media Queries
- Keep media queries close to the relevant styles
- Use the provided breakpoint variables
- Avoid nesting media queries too deeply

### 4. Organization
- Group related properties together (positioning, box model, typography, etc.)
- Use empty lines to separate logical groups of properties
- Comment complex or non-obvious code

## Integration with Codex

The skin uses the Codex design system for some components:
- Import Codex components as needed
- Follow Codex design tokens and patterns
- Document any customizations to Codex components

## Browser Support

The skin is designed to work with:
- Latest versions of modern browsers (Chrome, Firefox, Safari, Edge)
- Progressive enhancement for older browsers
- Mobile browsers on iOS and Android

## Development Workflow

1. Make changes to the relevant `.less` files
2. The build system will compile them to CSS
3. Test across different browsers and devices
4. Document any new components or significant changes
