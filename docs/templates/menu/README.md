# Menu Templates

This directory contains templates used for rendering menu components in the Islam Skin.

## Available Templates

- [Menu](./menu.md) - Main menu template
- [Menu Contents](./contents.md) - Renders the contents of a menu
- [Menu List Item](./list-item.md) - Renders a single menu item

## Template Structure

Menus are composed of nested templates that work together:

1. `menu.md` - The root menu container
2. `contents.md` - Handles rendering the list of menu items
3. `list-item.md` - Renders individual menu items (can be recursive for nested menus)

## Variables

### Menu Template
- `menuItems` - Array of top-level menu items
- `menuId` - Unique identifier for the menu
- `classes` - Additional CSS classes
- `attributes` - HTML attributes for the menu container

### Menu Contents Template
- `items` - Array of menu items to render
- `level` - Current nesting level (0-based)
- `parentId` - ID of the parent menu item (if any)

### Menu List Item Template
- `item` - The menu item object
- `isActive` - Whether the item is currently active
- `hasChildren` - Whether the item has child items
- `level` - Current nesting level
- `index` - Position in the current menu level

## Customization

To customize the menu appearance:

1. Override the template files in your project
2. Add custom CSS classes
3. Extend the template variables in your component

## Example

```handlebars
<!-- Custom menu template example -->
<nav class="main-menu {{classes}}" id="{{menuId}}" {{attributes}}>
  <ul class="menu-level-0">
    {{#each menuItems as |item|}}
      {{> menu-list-item 
        item=item 
        isActive=(eq item.url currentPath)
        level=0
        index=@index
      }}
    {{/each}}
  </ul>
</nav>
```

## Best Practices

- Keep templates focused on presentation
- Use semantic HTML
- Ensure accessibility with proper ARIA attributes
- Support keyboard navigation
- Make sure menus are responsive
