# API Reference

Welcome to the Islam Skin API Reference. This section provides comprehensive documentation for all public APIs, hooks, and utilities available in the Islam Skin.

## 📚 Quick Links

- [Components API](./api/components.md) - Detailed documentation for all UI components
- [Templates API](./api/templates.md) - Template system reference
- [Hooks](./hooks.md) - Available hooks for extending functionality
- [Utilities](./utilities.md) - Helper functions and utilities

## 🔍 API Conventions

### Component Props

All components accept the following common props:

```js
{
  // Optional unique identifier
  id: PropTypes.string,
  
  // Additional CSS class names
  className: PropTypes.string,
  
  // Inline styles
  style: PropTypes.object,
  
  // Accessibility attributes
  'aria-*': PropTypes.any,
  
  // Data attributes
  'data-*': PropTypes.any
}
```

### Event Handlers

Event handlers follow these conventions:
- Names start with `on` (e.g., `onClick`, `onChange`)
- Receive the event object as the first argument
- May receive additional relevant data as subsequent arguments

### Return Values

- Components typically return React elements
- Utility functions return the specified types
- Asynchronous functions return Promises

## 🛠 Usage Examples

### Importing Components

```jsx
// Import individual components
import { Button, Menu } from 'islam-skin';

// Or import everything (not recommended for production)
import * as IslamSkin from 'islam-skin';
```

### Basic Component Usage

```jsx
import React from 'react';
import { Button } from 'islam-skin';

function Example() {
  return (
    <Button 
      variant="primary"
      onClick={() => console.log('Clicked!')}
    >
      Click Me
    </Button>
  );
}
```

## 📦 Available APIs

### Core Components

- **Layout**
  - `Container` - Responsive container component
  - `Grid` - Flexible grid system
  - `Box` - Base layout component

- **Navigation**
  - `Menu` - Main navigation menu
  - `Tabs` - Tabbed interface
  - `Breadcrumbs` - Navigation breadcrumbs

- **Forms**
  - `Button` - Various button styles
  - `Input` - Form input fields
  - `Select` - Dropdown select
  - `Checkbox` - Checkbox input
  - `Radio` - Radio button input

### Utilities

- **Theme**
  - `useTheme` - Hook to access theme
  - `ThemeProvider` - Theme context provider
  - `createTheme` - Create custom themes

- **Helpers**
  - `formatDate` - Date formatting
  - `truncate` - Text truncation
  - `classNames` - Conditional class names

## 🔐 TypeScript Support

All components include TypeScript type definitions. To get proper type checking and IntelliSense:

```typescript
import { Button } from 'islam-skin';

interface MyButtonProps {
  /** Button text */
  text: string;
  /** Button variant */
  variant?: 'primary' | 'secondary' | 'outline';
  /** Click handler */
  onClick?: () => void;
}

const MyButton: React.FC<MyButtonProps> = ({ text, variant = 'primary', onClick }) => (
  <Button variant={variant} onClick={onClick}>
    {text}
  </Button>
);
```

## 📝 Contributing to the API

1. Follow the [Component API Guidelines](../development/component-api.md)
2. Document all public APIs with JSDoc comments
3. Include TypeScript type definitions
4. Add usage examples
5. Update this reference when making changes

## ❓ Need Help?

- Join our [community chat](https://example.com/chat)
- Open an [issue](https://github.com/your-org/islam-skin/issues)
- Check the [FAQ](#) (coming soon)
