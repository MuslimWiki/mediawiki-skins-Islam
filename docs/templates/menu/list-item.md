# MenuListItem.mustache

> **Version Compatibility**: MediaWiki 1.43+

## 📋 Overview
The `MenuListItem.mustache` template is a flexible component that renders individual menu items within navigation menus. It supports both linked and non-linked items, making it versatile for various menu structures in the Islam skin.

## 🏗️ Basic Structure

```handlebars
<li id="{{item-id}}" class="{{item-class}}"{{#data}} data-{{@key}}="{{.}}"{{/data}}>
    {{#array-links}}
        {{>Link}}
    {{/array-links}}
    {{^array-links}}
        <span class="islam-menu__item-text">{{text}}</span>
    {{/array-links}}
    {{#has-children}}
        <span class="islam-menu__toggle" aria-expanded="false" tabindex="0">
            <span class="icon icon-chevron-down" aria-hidden="true"></span>
            <span class="sr-only">Toggle submenu</span>
        </span>
    {{/has-children}}
</li>
```

## 📚 Data Context

### Core Properties
| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `array-links` | Array | Conditional | Array of link objects for the menu item |
| `text` | String | Conditional | Plain text content (used when no array-links) |
| `item-id` | String | Optional | Unique identifier for the menu item |
| `item-class` | String | Optional | CSS classes for the list item |
| `has-children` | Boolean | Optional | Indicates if the item has a submenu |
| `is-active` | Boolean | Optional | Marks the item as currently active |
| `data` | Object | Optional | Custom data attributes |

### Link Object Structure
When using `array-links`, each item should follow the [Link component](../../components/link.md) structure.

## 🎨 CSS Classes

### Component Classes
- `.islam-menu__item` - Base class for menu items
- `.islam-menu__item--active` - Active state
- `.islam-menu__item--has-children` - Indicates dropdown capability
- `.islam-menu__item--divider` - Visual separator

### Sub-components
- `.islam-menu__item-text` - Text container
- `.islam-menu__toggle` - Dropdown toggle button
- `.icon` - Base class for icons

## ♿ Accessibility Features
- Semantic HTML structure
- ARIA attributes for interactive elements
- Keyboard navigation support
- Screen reader announcements
- High contrast support

## 🔄 Related Components
- [Menu](./menu.md) - Parent menu container
- [MenuContents](./contents.md) - Container for menu items
- [Link](../../components/link.md) - Used for menu item links

## 🏆 Best Practices

### When to Use
- Navigation menu items
- Dropdown menu items
- Context menu items
- Any list of interactive elements

### Recommended Patterns
- Use `array-links` for interactive items
- Provide meaningful link text
- Include ARIA labels when needed
- Test keyboard navigation
- Ensure touch targets are large enough

## 🛠️ Example Usage

### Basic Menu Item with Link
```php
$menuItem = [
    'item-id' => 'nav-home',
    'item-class' => 'islam-menu__item',
    'array-links' => [
        [
            'href' => '/wiki/Main_Page',
            'text' => 'Home',
            'icon' => 'home',
            'class' => 'nav-link',
            'title' => 'Go to the main page'
        ]
    ]
];
```

### Menu Item with Submenu
```handlebars
<li id="nav-about" class="islam-menu__item islam-menu__item--has-children" data-tracking="about-menu">
    {{>Link href="#" text="About" icon="info"}}
    <span class="islam-menu__toggle" aria-expanded="false" aria-haspopup="true" tabindex="0">
        <span class="icon icon-chevron-down" aria-hidden="true"></span>
        <span class="sr-only">Toggle About submenu</span>
    </span>
    <ul class="islam-menu__submenu">
        {{>MenuListItem item-class="islam-menu__subitem" array-links=aboutLinks}}
    </ul>
</li>
```

### Non-linked Menu Item
```json
{
    "item-class": "islam-menu__header",
    "text": "Categories",
    "data": {
        "section": "categories"
    }
}
```

## 🧪 Testing

### Automated Tests
- Verify ARIA attributes
- Check keyboard navigation
- Test screen reader announcements
- Validate HTML structure

### Manual Testing Checklist
- [ ] Item highlights on hover/focus
- [ ] Active state is visible
- [ ] Keyboard navigation works
- [ ] Screen reader announces correctly
- [ ] Touch targets are large enough
- [ ] Works in RTL mode

## 📝 Version History

| Version | Changes |
|---------|---------|
| 1.0.0   | Initial release |
| 1.1.0   | Added submenu support |
| 1.2.0   | Improved accessibility |

## 🔍 See Also
- [WAI-ARIA Menu Item Pattern](https://www.w3.org/WAI/ARIA/apg/patterns/menubar/)
- [MDN List Item](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/li)
- [Islam Link Component](../../components/link.md)

## Example Data

### Using array-links (Recommended)
```json
{
    "item-id": "pt-home",
    "item-class": "islam-menu__item",
    "is-active": true,
    "array-links": [
        {
            "href": "/wiki/Main_Page",
            "text": "Home",
            "icon": "home",
            "class": "nav-link",
            "title": "Go to the main page",
            "data": {
                "tracking": "nav-home"
            }
        }
    ]
}
```

### Using Plain Text
```json
{
    "item-class": "divider",
    "text": "Navigation"
}
```

## Rendered Output Examples

### With Link
```html
<li id="pt-home" class="mw-list-item">
    <a href="/wiki/Main_Page" title="Go to the main page">
        <span class="mw-ui-icon mw-ui-icon-home"></span>
        <span>Home</span>
    </a>
</li>
```

### With Plain Text
```html
<li class="divider">Navigation</li>
```

## Notes
- The template is designed to be flexible and can render either linked items or plain text items
- When using `array-links`, it can handle multiple links within a single list item
- The `Link` partial handles the actual rendering of the anchor tag and any associated icons
- The template is typically used within a loop in `MenuContents.mustache` to render all items in a menu
- All HTML attributes are properly escaped to prevent XSS attacks
