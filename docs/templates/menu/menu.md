# Menu.mustache

> **Version Compatibility**: MediaWiki 1.43+

## 📋 Overview
The `Menu.mustache` template provides the structural foundation for all navigation menus in the Islam skin. It creates an accessible navigation landmark (`<nav>`) and handles the container structure, while delegating the rendering of individual menu items to the `MenuContents` partial.

## 🏗️ Basic Structure

```handlebars
<nav
    id="{{id}}"
    class="islam-menu{{#class}} {{.}}{{/class}}"
    {{{html-tooltip}}}
    {{{html-userlangattributes}}}
    {{#aria-label}}aria-label="{{.}}"{{/aria-label}}
    {{#aria-labelledby}}aria-labelledby="{{.}}"{{/aria-labelledby}}
    role="navigation"
>
    {{#label}}
    <div class="islam-menu__heading{{#label-class}} {{.}}{{/label-class}}">
        {{.}}
    </div>
    {{/label}}
    {{>MenuContents}}
</nav>
```

## 📚 Data Context

### Required Properties
| Property | Type | Description |
|----------|------|-------------|
| `id` | String | Unique identifier for the menu (used for ARIA attributes and JavaScript hooks) |

### Optional Properties
| Property | Type | Description |
|----------|------|-------------|
| `class` | String | Additional CSS class(es) for the menu container |
| `html-tooltip` | HTML | Rendered HTML for tooltips (escaped) |
| `html-userlangattributes` | HTML | Rendered HTML for language attributes |
| `label` | String | Optional heading text for the menu |
| `label-class` | String | Additional CSS class(es) for the label |
| `aria-label` | String | ARIA label for the navigation landmark (recommended if no visible label) |
| `aria-labelledby` | String | ID of the element that labels the navigation (alternative to aria-label) |
| `data` | Object | Additional data attributes to be added to the nav element |

### Menu Contents
The menu items are rendered using the `MenuContents` partial, which is included via `{{>MenuContents}}`. The data structure for menu items is documented in the [MenuContents template documentation](./contents.md).

## 🎨 CSS Classes

### Core Classes
- `.islam-menu` - Base class for all menu containers
- `.islam-menu--vertical` - Applied when menu is vertically oriented
- `.islam-menu--horizontal` - Applied when menu is horizontally oriented

### Sub-components
- `.islam-menu__heading` - Container for the menu's heading/label
- `.islam-menu__items` - Container for the menu items (added by MenuContents)

## ♿ Accessibility Features
- Proper ARIA roles and attributes
- Keyboard navigation support
- Screen reader announcements
- High contrast support
- RTL language support

## 🔄 Related Components
- [MenuContents](./contents.md) - Renders the list of menu items
- [MenuListItem](./list-item.md) - Individual menu item component
- [Link](../../components/link.md) - Used for menu item links

## 🏆 Best Practices

### When to Use
- Main navigation menus
- Sidebar navigation
- Dropdown menus
- Contextual menus
- Tabbed interfaces

### Recommended Patterns
- Always provide either a visible label or an ARIA label
- Use semantic HTML structure
- Ensure proper heading hierarchy
- Test keyboard navigation
- Support touch devices
- Consider RTL languages

## 🛠️ Example Usage

### Basic Menu
```php
$menu = new IslamComponentMenu('main-menu', 'Main Navigation');
$menu->addItem(new MenuListItem('Home', '/wiki/Main_Page', 'home'));
$menu->addItem(new MenuListItem('About', '/wiki/About', 'info'));
$menu->addItem(new MenuListItem('Contact', '/wiki/Contact', 'envelope'));

$templateData = [
    'id' => $menu->getId(),
    'class' => 'islam-menu--main',
    'label' => $menu->getLabel(),
    'items' => $menu->getItemsData()
];
```

### Menu with ARIA Label
```handlebars
<nav
    id="user-menu"
    class="islam-menu islam-menu--dropdown"
    aria-label="{{msg-usermenu-tooltip}}"
>
    {{>MenuContents}}
</nav>
```

## 🧪 Testing

### Automated Tests
- Verify ARIA attributes are present
- Check keyboard navigation
- Test with screen readers
- Validate HTML structure

### Manual Testing Checklist
- [ ] Menu is keyboard accessible
- [ ] Focus indicators are visible
- [ ] Screen reader announces menu structure
- [ ] Works in RTL languages
- [ ] Properly handles touch events

## 📝 Version History

| Version | Changes |
|---------|---------|
| 1.0.0   | Initial release |
| 1.1.0   | Added ARIA support |
| 1.2.0   | Improved RTL support |

## 🔍 See Also
- [WAI-ARIA Menu Pattern](https://www.w3.org/WAI/ARIA/apg/patterns/menu/)
- [MDN Navigation Landmarks](https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/Roles/navigation_role)
- [Islam Skin Components](../components/README.md)

## Example Data
```json
{
    "id": "main-navigation",
    "class": "main-nav",
    "label": "Main Menu",
    "label-class": "visually-hidden",
    "html-tooltip": "title=\"Main Navigation\"",
    "html-userlangattributes": "lang=\"en\" dir=\"ltr\""
}
```

## Notes
- The template uses HTML5 `<nav>` element for better semantic structure
- The `html-tooltip` and `html-userlangattributes` are passed through without escaping (using triple curly braces)
- The template is designed to be flexible and can be used for various types of menus throughout the site
- The actual menu items are rendered by the included `MenuContents` partial
