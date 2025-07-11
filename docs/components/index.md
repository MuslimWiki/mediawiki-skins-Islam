# Components

Welcome to the Components documentation for the Islam Skin. This section provides detailed information about each UI component available in the skin.

## Available Components

### Core Components
- [Link](./link.md) - A reusable link component with consistent styling
- [User Info](./user-info.md) - Displays user information and avatar

### Menu Components
- [Menu](./menu/overview.md) - Navigation menu component
  - [Menu Item](./menu/menu-item.md) - Individual menu item component

## Component API

All components follow a consistent API pattern:

### Props
- `className` (String): Additional CSS classes
- `style` (Object): Inline styles
- `children` (Node): Child elements

### Common Props
- `id` (String): Unique identifier
- `aria-*` (Various): Accessibility attributes
- `data-*` (Various): Data attributes

## Usage Example

```jsx
import { Link, Menu } from 'islam-skin';

function Example() {
  return (
    <div>
      <Link to="/home">Home</Link>
      <Menu items={menuItems} />
    </div>
  );
}
```

## Styling

Components can be styled using:
- CSS Custom Properties (variables)
- Utility classes
- Component-specific classes

## Best Practices

1. **Composition**: Compose smaller components to build complex UIs
2. **Props**: Use props for configuration
3. **State Management**: Keep components stateless when possible
4. **Accessibility**: Follow WCAG guidelines

## Next Steps

- Learn how to [create custom components](../development/component-guide.md)
- Explore the [component architecture](../architecture/component-relationships.md)
- Check out the [API reference](../reference/api/components.md) for detailed prop types and examples
