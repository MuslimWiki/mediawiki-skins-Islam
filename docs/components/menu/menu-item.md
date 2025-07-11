# IslamComponentMenuListItem

> **Version Compatibility**: MediaWiki 1.43+

## 📋 Overview
`IslamComponentMenuListItem` is a core component that represents a single item within a menu. It serves as a wrapper around the `IslamComponentLink` component, adding list item-specific attributes and functionality. This component is essential for building accessible and interactive menu structures in the Islam skin.

### Menu List Item Example

```html
<li class="nav-item active" id="home-menu-item">
  <a href="/" class="nav-link">
    <span class="icon icon-home"></span>
    <span>Home</span>
  </a>
</li>

<li class="nav-item has-dropdown" id="services-menu-item">
  <a href="/services" class="nav-link" aria-haspopup="true" aria-expanded="false">
    <span class="icon icon-services"></span>
    <span>Services</span>
    <span class="dropdown-indicator">▼</span>
  </a>
  <ul class="dropdown-menu" aria-labelledby="services-menu-item">
    <li class="dropdown-item">
      <a href="/services/web">Web Development</a>
    </li>
    <li class="dropdown-item">
      <a href="/services/mobile">Mobile Apps</a>
    </li>
  </ul>
</li>
```

## 🏗️ Basic Usage

### Creating a Simple Menu Item

```php
use Islam\Components\IslamComponentLink;
use Islam\Components\IslamComponentMenuListItem;

// First create a link component
$link = new IslamComponentLink(
    '/wiki/Special:Preferences',  // URL
    'Preferences',                // Text
    'settings',                   // Icon name (optional)
    $localizer,                   // Localizer instance
    'preferences-access'          // Message key (optional)
);

// Create a menu list item with the link
$menuItem = new IslamComponentMenuListItem(
    $link,                        // Link component
    'menu-item preferences-link', // CSS classes
    'preferences-menu-item'       // HTML ID (optional)
);

// Get the template data
$templateData = $menuItem->getTemplateData();
```

### Creating a Menu Item with Custom Attributes

```php
// Create a link with additional data attributes
$link = new IslamComponentLink(
    '/wiki/Special:Watchlist',
    'Watchlist',
    'watchlist',
    $localizer
);

// Add custom data attributes to the list item
$menuItem = new IslamComponentMenuListItem($link);
$menuItem->setData('data-tracking', 'main-nav-watchlist');
```

## 📂 File Location
`/includes/Components/IslamComponentMenuListItem.php`

## 🔗 Dependencies
- `IslamComponent` - Base interface for all Islam skin components
- `IslamComponentLink` - For the actual link within the list item

## 🔄 Related Components
- [Menu](./overview.md) - Parent menu component
- [Link](../link.md) - Used for the actual link within the item
- [UserInfo](../user-info.md) - Often used in user menu items

## 🏗️ Class Structure

### Properties
- `private IslamComponentLink $link` - The link component for this menu item
- `private string $class` - CSS class(es) for the list item
- `private string $id` - HTML ID for the list item
- `private array $data` - Additional data attributes for the list item

## Methods

### `__construct()`
- **Parameters**:
  - `IslamComponentLink $link` - The link component to be wrapped
  - `string $class = ''` - Optional CSS class(es) for the list item
  - `string $id = ''` - Optional HTML ID for the list item
- **Description**: Initializes a new menu list item with the provided link and attributes
- **Example**:
  ```php
  $link = new IslamComponentLink('/wiki/Main_Page', 'Home', 'home', $localizer);
  $menuItem = new IslamComponentMenuListItem($link, 'nav-item', 'home-nav-item');
  ```
- **Throws**:
  - `InvalidArgumentException` - If the link parameter is not provided

### `getTemplateData(): array`
- **Returns**: `array` - Template data for rendering the menu list item
- **Description**: Prepares and returns the data needed to render the menu list item in a template
- **Return Structure**:
  ```php
  [
      'array-links' => [
          // Data from IslamComponentLink::getTemplateData()
          'href' => string,        // URL
          'text' => string,        // Link text
          'class' => string,       // Link CSS classes
          'rel' => string,         // Link relation
          'data' => array,         // Data attributes
          'title' => string,       // Link title
          'aria-label' => string,  // ARIA label
          'icon' => string,        // Icon name
          'exists' => bool,        // Whether the target exists
          'active' => bool         // Whether the link is active
      ],
      'item-class' => string,  // CSS class(es) for the list item
      'item-id' => string,    // HTML ID for the list item
      'data' => array        // Additional data attributes
  ]
  ```
- **Example**:
  ```php
  $link = new IslamComponentLink('/wiki/Special:Preferences', 'Preferences', 'settings', $localizer);
  $menuItem = new IslamComponentMenuListItem($link, 'menu-item', 'prefs-item');
  $data = $menuItem->getTemplateData();
  ```

## Usage Example
```php
// First create a link
$link = new IslamComponentLink(
    '/wiki/Special:Preferences',
    'Preferences',
    'settings',
    $localizer,
    'preferences-access'
);

// Then create a menu list item with the link
$menuItem = new IslamComponentMenuListItem(
    $link,
    'user-menu-item preferences',
    'pt-preferences'
);

// Get template data
$templateData = $menuItem->getTemplateData();
```

## Template Integration
In Mustache templates, a menu list item is typically rendered like this:

```html
<li class="{{item-class}}" {{#item-id}}id="{{.}}"{{/item-id}}>
    {{#array-links}}
        {{>Link}}
    {{/array-links}}
</li>
```

## Relationship with Other Components
- **IslamComponentMenu**: Contains multiple `IslamComponentMenuListItem` instances
- **IslamComponentLink**: Wrapped by `IslamComponentMenuListItem` to provide the actual link functionality
- **IslamComponentUserInfo**: Uses `IslamComponentMenuListItem` for user-related menu items

## Notes
- The component is designed to be used within `IslamComponentMenu`
- Multiple links within a single list item are possible by using the `array-links` array
- The component handles both the visual presentation and accessibility attributes
