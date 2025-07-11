# Menu Components

This directory contains documentation for the menu-related components used in the Islam Skin.

## Available Components

- [Menu Overview](./overview.md) - Main menu component documentation
- [Menu Item](./menu-item.md) - Individual menu item component

## Features

- Support for nested menus
- Keyboard navigation
- Responsive design
- Customizable styling
- Support for icons and badges

## Usage

```javascript
import { Menu, MenuItem } from 'islam-skin';

const menuItems = [
  { label: 'Home', to: '/', icon: 'home' },
  { label: 'About', to: '/about', children: [
    { label: 'Our Team', to: '/about/team' },
    { label: 'History', to: '/about/history' }
  ]},
  { label: 'Contact', to: '/contact' }
];

function App() {
  return (
    <Menu items={menuItems} orientation="vertical" />
  );
}
```

## Styling

Menu components can be styled using CSS custom properties. See the [styling guide](../../architecture/styling.md) for more information.

## Accessibility

All menu components follow WAI-ARIA design patterns for accessibility. They support:
- Keyboard navigation
- Screen reader announcements
- Proper ARIA attributes
- Focus management
