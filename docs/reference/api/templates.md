# Templates API

This document provides detailed information about the templates available in the Islam Skin.

## Available Templates

### Menu Template
- **File**: `/templates/menu/menu.md`
- **Description**: Template for rendering the main navigation menu.
- **Variables**:
  - `menuItems` (Array): Array of menu items to display
  - `activePath` (String): Currently active path for highlighting
  - `menuId` (String): Unique identifier for the menu

### Menu Contents Template
- **File**: `/templates/menu/contents.md`
- **Description**: Template for rendering the contents of a menu.
- **Variables**:
  - `items` (Array): Array of menu items
  - `level` (Number): Current nesting level (starts at 0)
  - `parentId` (String): ID of the parent menu item (if any)

### Menu List Item Template
- **File**: `/templates/menu/list-item.md`
- **Description**: Template for rendering a single menu item.
- **Variables**:
  - `item` (Object): The menu item to render
  - `isActive` (Boolean): Whether this item is currently active
  - `hasChildren` (Boolean): Whether this item has child items
  - `level` (Number): Current nesting level

### User Info Template
- **File**: `/templates/user-info.md`
- **Description**: Template for rendering user information.
- **Variables**:
  - `user` (Object): User data object
  - `showDetails` (Boolean): Whether to show detailed user info
  - `avatarSize` (String): Size of the user avatar (e.g., 'sm', 'md', 'lg')

## Usage Example

```handlebars
<!-- Example of using the Menu template -->
{{#each menuItems as |item|}}
  <li class="menu-item {{#if item.active}}active{{/if}}">
    <a href="{{item.url}}">{{item.label}}</a>
    {{#if item.children}}
      <ul class="submenu">
        {{> menu-contents items=item.children level=1}}
      </ul>
    {{/if}}
  </li>
{{/each}}
```

## Template Helpers

### `formatDate`
Formats a date string.
```handlebars
{{formatDate date 'MMMM D, YYYY'}}
```

### `truncate`
Truncates text to a specified length.
```handlebars
{{truncate text 100 '...'}}
```

## Customization

Templates can be customized by overriding the default template files. See the [Templates Guide](../../templates/overview.md) for more information.
