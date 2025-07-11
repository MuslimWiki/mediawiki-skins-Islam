# MenuContents.mustache

> **Version Compatibility**: MediaWiki 1.43+

## 📋 Overview
The `MenuContents.mustache` template is the workhorse behind menu content rendering in the Islam skin. It provides a flexible and accessible way to display both structured and unstructured menu items within a semantic `<ul>` list structure.

## 🏗️ Basic Structure

```handlebars
<div class="islam-menu__content">
    {{{html-before-portal}}}
    <ul class="islam-menu__content-list">
        {{#array-list-items}}{{>MenuListItem}}{{/array-list-items}}
        {{#html-items}}{{{.}}}{{/html-items}}
    </ul>
    {{{html-after-portal}}}
</div>
```

## 📚 Data Context

### Core Properties
| Property | Type | Description |
|----------|------|-------------|
| `array-list-items` | Array | Structured menu items to be rendered using `MenuListItem` partial |
| `html-items` | HTML | Raw HTML content to be inserted directly into the menu |
| `html-before-portal` | HTML | Content to be inserted before the menu items (not escaped) |
| `html-after-portal` | HTML | Content to be inserted after the menu items (not escaped) |

### Menu Item Structure (for array-list-items)
Each item in `array-list-items` should be an object that can be processed by the `MenuListItem` partial. See [MenuListItem documentation](./list-item.md) for detailed structure.

## 🎨 CSS Classes

### Layout Classes
- `.islam-menu__content` - Main container for menu contents
- `.islam-menu__content-list` - The `<ul>` element containing menu items
- `.islam-menu__content--collapsible` - Applied when menu supports collapsible sections

### State Classes
- `.is-active` - Indicates the current active menu item
- `.is-expanded` - Indicates an expanded menu section
- `.has-children` - Indicates a menu item with child items

## ♿ Accessibility Features
- Semantic HTML structure
- ARIA attributes for menu states
- Keyboard navigation support
- Screen reader announcements
- High contrast support

## 🔄 Related Components
- [Menu](./menu.md) - The parent container for menu contents
- [MenuListItem](./list-item.md) - Renders individual menu items
- [Link](../../components/link.md) - Used for menu item links

## 🏆 Best Practices

### When to Use
- Main navigation menus
- Dropdown menus
- Context menus
- Sidebar navigation
- Any list of navigational links

### Recommended Patterns
- Use `array-list-items` for structured data when possible
- Keep menu hierarchies shallow (max 2-3 levels deep)
- Ensure keyboard navigation works correctly
- Test with screen readers
- Consider touch targets on mobile devices

## 🛠️ Example Usage

### Basic Menu with Structured Items
```php
$menuItems = [
    [
        'text' => 'Home',
        'href' => '/wiki/Main_Page',
        'icon' => 'home',
        'class' => 'is-active'
    ],
    [
        'text' => 'Categories',
        'href' => '/wiki/Special:Categories',
        'icon' => 'folder'
    ]
];

$templateData = [
    'array-list-items' => $menuItems,
    'html-before-portal' => '<div class="menu-header">Main Menu</div>',
    'html-after-portal' => '<div class="menu-footer">Footer content</div>'
];
```

### Mixed Content Menu
```handlebars
<div class="islam-menu__content">
    <div class="menu-welcome">Welcome, {{username}}!</div>
    <ul class="islam-menu__content-list">
        {{#array-list-items}}{{>MenuListItem}}{{/array-list-items}}
        <li class="special-item">
            <a href="/special-link">Special Link</a>
        </li>
        {{#html-items}}{{{.}}}{{/html-items}}
    </ul>
    <div class="menu-footer">Last updated: {{lastUpdated}}</div>
</div>
```

## 🧪 Testing

### Automated Tests
- Verify menu structure
- Check ARIA attributes
- Test keyboard navigation
- Validate HTML output

### Manual Testing Checklist
- [ ] Menu items are properly aligned
- [ ] Icons display correctly
- [ ] Active states are visible
- [ ] Keyboard navigation works
- [ ] Screen reader announces menu structure
- [ ] Works in RTL mode

## 📝 Version History

| Version | Changes |
|---------|---------|
| 1.0.0   | Initial release |
| 1.1.0   | Added support for html-items |
| 1.2.0   | Improved accessibility features |

## 🔍 See Also
- [WAI-ARIA Menu Pattern](https://www.w3.org/WAI/ARIA/apg/patterns/menu/)
- [MDN Lists](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/ul)
- [Islam Menu Component](../../components/menu/overview.md)

## Rendering Modes

### 1. Structured Data (Recommended)
```json
{
    "array-list-items": [
        {
            "text": "Home",
            "href": "/wiki/Main_Page",
            "icon": "home",
            "class": "is-active"
        }
               ]
           }
       ]
   }
   ```

2. **Raw HTML (Legacy)**:
   ```json
   {
       "html-items": "<li><a href='/wiki/Main_Page'>Home</a></li>"
   }
   ```

## Example Data
```json
{
    "html-before-portal": "<div class='menu-notice'>Important notice</div>",
    "array-list-items": [
        {
            "array-links": [
                {
                    "href": "/wiki/Main_Page",
                    "text": "Home",
                    "icon": "home"
                }
            ]
        },
        {
            "array-links": [
                {
                    "href": "/wiki/Special:RecentChanges",
                    "text": "Recent Changes",
                    "icon": "recent-changes"
                }
            ]
        }
    ],
    "html-after-portal": "<div class='menu-footer'>Version 1.0</div>"
}
```

## Notes
- The template uses triple curly braces (`{{{...}}`) for HTML properties to prevent escaping of HTML content
- The `array-list-items` approach is preferred as it provides better structure and accessibility
- The template is designed to be flexible and can be used for different types of menus throughout the site
- Menu items can be either structured data (using `MenuListItem` partial) or raw HTML (using `html-items`)
