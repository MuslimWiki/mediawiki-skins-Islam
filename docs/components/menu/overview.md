# IslamComponentMenu

> **Version Compatibility**: MediaWiki 1.43+

## 📋 Overview
`IslamComponentMenu` is a core component that handles the rendering of navigation menus in the Islam skin. It implements both the `IslamComponent` interface and PHP's `Countable` interface, providing a flexible way to create and manage menu structures.

### Key Features
- Dynamic menu generation from arrays or HTML
- Built-in item counting functionality
- Flexible template data merging
- Support for custom CSS classes and attributes
- Extensible through the `IslamComponent` interface

### Menu Example

```html
<nav id="main-menu" class="nav-menu" aria-label="Main Navigation">
  <ul>
    <li class="nav-item">
      <a href="/" class="nav-link">Home</a>
    </li>
    <li class="nav-item">
      <a href="/about" class="nav-link">About</a>
    </li>
    <li class="nav-item has-dropdown">
      <a href="/services" class="nav-link">Services</a>
      <ul class="dropdown">
        <li><a href="/services/web" class="dropdown-item">Web Development</a></li>
        <li><a href="/services/mobile" class="dropdown-item">Mobile Apps</a></li>
        <li><a href="/services/design" class="dropdown-item">UI/UX Design</a></li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="/contact" class="nav-link">Contact</a>
    </li>
  </ul>
</nav>
```

## 🏗️ Basic Usage

### Creating a Simple Menu

```php
// In your skin class or template
$menuData = [
    'id' => 'main-menu',
    'class' => 'nav-menu',
    'label' => 'Main Navigation',
    'array-list-items' => [
        ['text' => 'Home', 'href' => '/', 'class' => 'nav-item'],
        ['text' => 'About', 'href' => '/about', 'class' => 'nav-item'],
        ['text' => 'Contact', 'href' => '/contact', 'class' => 'nav-item']
    ]
];

$menu = new IslamComponentMenu($menuData);
$menuHtml = $menu->getTemplateData();
```

### Menu with Icons and Dropdowns

```php
$menuData = [
    'id' => 'user-menu',
    'class' => 'user-menu',
    'array-list-items' => [
        [
            'text' => '<i class="icon-user"></i> My Account',
            'href' => '/account',
            'class' => 'has-dropdown',
            'items' => [
                ['text' => 'Profile', 'href' => '/profile'],
                ['text' => 'Settings', 'href' => '/settings'],
                ['divider' => true],
                ['text' => 'Logout', 'href' => '/logout']
            ]
        ]
    ]
];
```

## 📂 File Location
`/includes/Components/IslamComponentMenu.php`

## 🔗 Dependencies
- `Countable` - PHP built-in interface
- `IslamComponent` - Base interface for all Islam skin components

## 🔄 Related Components
- [MenuListItem](./menu-item.md) - For individual menu items
- [UserInfo](../user-info.md) - Often used in conjunction with user menus
- [Link](../link.md) - Used for menu item links

## 🏗️ Class Structure

### Properties
- `private array $data` - Contains menu configuration and items
  - `id` (string) - Unique identifier for the menu
  - `class` (string) - CSS classes for the menu container
  - `label` (string) - Menu heading/label
  - `html-tooltip` (string) - Tooltip text (HTML allowed)
  - `html-items` (string) - Raw HTML for menu items (alternative to array-list-items)
  - `array-list-items` (array|null) - Structured array of menu items

## Methods

### `__construct(array $data)`
- **Parameters**:
  - `$data` (array) - Configuration and items for the menu
- **Description**: Initializes the menu with the provided data
- **Example**:
  ```php
  $menu = new IslamComponentMenu([
      'id' => 'main-nav',
      'class' => 'main-navigation',
      'label' => 'Main Menu',
      'array-list-items' => [
          ['text' => 'Home', 'href' => '/'],
          ['text' => 'About', 'href' => '/about']
      ]
  ]);
  ```
- **Throws**:
  - `InvalidArgumentException` - If required data is missing or invalid

### `count(): int`
- **Returns**: `int` - Number of items in the menu
- **Behavior**:
  - First checks for items in `array-list-items` and returns the count if present
  - If no array items, counts the number of `<li` tags in `html-items`
  - Returns 0 if neither is available
- **Example**:
  ```php
  $menu = new IslamComponentMenu([
      'array-list-items' => [
          ['text' => 'Home', 'href' => '/'],
          ['text' => 'About', 'href' => '/about']
      ]
  ]);
  
  echo $menu->count(); // Output: 2
  ```

### `getTemplateData(): array`
- **Returns**: `array` - Complete template data with default values
- **Description**: Merges the provided menu data with default values to ensure all required keys exist
- **Default Values**:
  ```php
  [
      'id' => '',
      'class' => '',
      'label' => '',
      'html-tooltip' => '',
      'label-class' => '',
      'html-before-portal' => '',
      'html-items' => '',
      'html-after-portal' => '',
      'array-list-items' => null
  ]
  ```
- **Example**:
  ```php
  $menu = new IslamComponentMenu([
      'id' => 'main-menu',
      'label' => 'Navigation'
  ]);
  
  $templateData = $menu->getTemplateData();
  // Returns merged data with all default values
  ```

## 🎨 Template Integration

### Data Structure
When used in templates, the menu expects data in the following structure:

```php
[
    // Required
    'id' => 'unique-menu-id',      // Unique identifier for the menu
    
    // Basic Configuration
    'class' => 'menu-class',       // Additional CSS classes
    'label' => 'Menu Heading',     // Menu heading text
    'label-class' => 'label-class', // CSS classes for the label
    
    // Content
    'html-tooltip' => 'Tooltip',  // Optional tooltip HTML
    'html-before-portal' => '',   // HTML to insert before menu
    'html-after-portal' => '',    // HTML to insert after menu
    
    // Menu Items (choose one)
    'html-items' => '<li>...</li>', // Raw HTML for menu items
    // OR
    'array-list-items' => [        // Structured array of menu items
        [
            'text' => 'Item 1',     // Display text
            'href' => '/item1',     // Link URL
            'class' => 'item-class', // CSS classes
            'title' => 'Title',     // Link title attribute
            'items' => [/* Nested items */] // Submenu items
        ]
    ]
]
```

### Example Template Usage

```html
<nav id="{{id}}" class="islam-menu {{class}}" role="navigation"
     aria-label="{{label}}">
    {{#label}}
    <div class="menu-header">
        <h2 class="menu-title {{label-class}}">{{{label}}}</h2>
        {{#html-tooltip}}
        <span class="menu-tooltip">{{{html-tooltip}}}</span>
        {{/html-tooltip}}
    </div>
    {{/label}}
    
    {{#html-before-portal}}
    <div class="menu-before">
        {{{html-before-portal}}}
    </div>
    {{/html-before-portal}}
    
    <ul class="menu-items">
        {{#array-list-items}}
            {{>MenuListItem}}
        {{/array-list-items}}
        {{^array-list-items}}
            {{{html-items}}}
        {{/array-list-items}}
    </ul>
    
    {{#html-after-portal}}
    <div class="menu-after">
        {{{html-after-portal}}}
    </div>
    {{/html-after-portal}}
</nav>
```
    'html-tooltip' => 'Tooltip text',
    'label-class' => 'label-classes',
    'html-before-portal' => '<!-- HTML before menu -->',
    'html-items' => '<li>Item 1</li><li>Item 2</li>',
    'html-after-portal' => '<!-- HTML after menu -->',
    'array-list-items' => [
        // Array of menu item data
    ]
]
```

## Usage Example
```php
$menu = new IslamComponentMenu([
    'id' => 'user-menu',
    'class' => 'user-dropdown',
    'label' => 'User Menu',
    'html-items' => '<li><a href="/user">Profile</a></li>'
]);

$templateData = $menu->getTemplateData();
```

## Notes
- The component supports two ways to provide menu items:
  1. As raw HTML in `html-items`
  2. As structured data in `array-list-items`
- The `count()` method is particularly useful for conditionally rendering menus based on whether they contain items
- All HTML in `html-items` is output as-is, so ensure it's properly escaped before passing it to the component
