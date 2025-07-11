# Components API

This document provides detailed information about the components available in the Islam Skin.

## Available Components

### Link Component
- **File**: `/components/link.md`
- **Description**: A reusable link component with consistent styling.
- **Props**:
  - `to` (String): The URL to link to
  - `external` (Boolean): Whether the link is external (default: false)
  - `active` (Boolean): Whether the link is currently active (default: false)

### Menu Component
- **File**: `/components/menu/overview.md`
- **Description**: A navigation menu component.
- **Props**:
  - `items` (Array): Array of menu items
  - `orientation` (String): 'horizontal' or 'vertical' (default: 'horizontal')

### Menu Item Component
- **File**: `/components/menu/menu-item.md`
- **Description**: A single menu item within a menu.
- **Props**:
  - `label` (String): Display text for the menu item
  - `to` (String): URL to navigate to when clicked
  - `icon` (String): Optional icon class

### User Info Component
- **File**: `/components/user-info.md`
- **Description**: Displays user information and avatar.
- **Props**:
  - `user` (Object): User object containing name, avatar, etc.
  - `showDetails` (Boolean): Whether to show additional user details

## Usage Example

```javascript
// Example of using the Menu component
const menuItems = [
  { label: 'Home', to: '/' },
  { label: 'About', to: '/about' },
  { label: 'Contact', to: '/contact' }
];

<Menu items={menuItems} orientation="vertical" />
```

## Styling

Each component comes with default styling that can be overridden using CSS custom properties. See the [Styling Guide](../../development/style-guide.md) for more information.
