# Templates

This directory contains template files used for rendering various UI components in the Islam Skin.

## Available Templates

- [Menu Templates](./menu/README.md)
  - [Menu](./menu/menu.md) - Main menu template
  - [Menu Contents](./menu/contents.md) - Menu contents template
  - [Menu List Item](./menu/list-item.md) - Individual menu item template
- [User Info](./user-info.md) - User information display template

## Usage

Templates are used to define the structure and appearance of reusable UI components. They are typically used in conjunction with components to separate presentation from logic.

### Example Usage

```handlebars
<!-- Example of using the User Info template -->
{{> user-info 
  user=user 
  showDetails=true 
  avatarSize="lg"
}}
```

## Customization

Templates can be customized by creating new template files with the same name in your project. The skin will automatically use your custom templates instead of the default ones.

## Template Helpers

Several built-in helpers are available in templates:

- `formatDate` - Format dates
- `truncate` - Truncate text
- `t` - Translation helper
- `eq` - Equality check
- `gt` - Greater than comparison
- `lt` - Less than comparison

## Best Practices

1. Keep templates focused on presentation only
2. Move business logic to components or services
3. Use template partials for reusable UI elements
4. Document all available template variables
5. Follow the DRY (Don't Repeat Yourself) principle

## Styling

Templates should use the provided CSS classes and follow the design system. Custom styles should be added through the theming system when possible.
