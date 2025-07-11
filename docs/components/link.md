# IslamComponentLink

> **Version Compatibility**: MediaWiki 1.43+

## 📋 Overview
`IslamComponentLink` is a core component that handles the creation and rendering of accessible, localized links throughout the Islam skin. It provides a consistent way to generate links with proper HTML structure, ARIA attributes, and internationalization support.

### Link Examples

```html
<!-- Basic link -->
<a href="/wiki/Main_Page" class="islam-link">Home</a>

<!-- Link with icon -->
<a href="/wiki/Special:Preferences" class="islam-link">
  <span class="icon icon-settings"></span>
  <span>Preferences</span>
</a>

<!-- External link with indicator -->
<a href="https://example.com" class="islam-link external" target="_blank" rel="noopener">
  External Link
  <span class="icon icon-external"></span>
</a>
```

## 🏗️ Basic Usage

### Creating a Simple Link

```php
use Islam\Components\IslamComponentLink;

// Create a basic link
$link = new IslamComponentLink(
    '/wiki/Main_Page',  // URL
    'Home',             // Link text
    'home',             // Optional icon
    $localizer,         // MessageLocalizer instance
    'h'                 // Access key (optional)
);

// Get template data
$linkData = $link->getTemplateData();
```

### Creating a Localized Link

```php
// Create a link with a localized message
$link = new IslamComponentLink(
    '/wiki/Special:Preferences',
    $localizer->msg('preferences')->text(),
    'settings',
    $localizer
);
```

## 📂 File Location
`/includes/Components/IslamComponentLink.php`

## 🔗 Dependencies
- `MediaWiki\Html\Html` - HTML generation utilities
- `MediaWiki\Linker\Linker` - Link-related utilities
- `MessageLocalizer` - Interface for message localization
- `IslamComponent` - Base interface for all Islam skin components

## 🔄 Related Components
- [Menu](../templates/menu/menu.md) - Uses links for navigation items
- [MenuListItem](../templates/menu/list-item.md) - Wraps links in list items
- [UserInfo](../templates/user-info.md) - Uses links for user menu items

## 🏗️ Class Structure

### Properties
- `private string $href` - The URL the link points to
- `private string $text` - The display text of the link
- `private ?string $icon` - Optional icon identifier
- `private ?MessageLocalizer $localizer` - For message localization
- `private ?string $accessKeyHint` - Optional access key hint for keyboard shortcuts
- `private array $attributes` - Additional HTML attributes
- `private bool $isExternal` - Whether the link is external
- `private ?string $rel` - Link relation type
- `private ?string $target` - Target attribute value

## Methods

### `__construct()`
- **Parameters**:
  - `string $href` - The target URL
  - `string $text` - The link text (can be a message key if localizer is provided)
  - `?string $icon = null` - Optional icon identifier from the icon font
  - `?MessageLocalizer $localizer = null` - For message localization
  - `?string $accessKeyHint = null` - Optional access key hint for keyboard shortcuts
- **Description**: Initializes a new link component with the specified parameters
- **Example**:
  ```php
  // Basic link
  $link = new IslamComponentLink('/wiki/Main_Page', 'Home');
  
  // Localized link with icon
  $link = new IslamComponentLink(
      '/wiki/Special:Preferences',
      'preferences', // Message key
      'settings',
      $localizer
  );
  ```
- **Throws**:
  - `InvalidArgumentException` - If required parameters are missing or invalid

### `getTemplateData(): array`
- **Returns**: `array` - Template data for rendering the link
- **Description**: Prepares the link data for template rendering, including all necessary attributes and properties
- **Return Structure**:
  ```php
  [
      // Basic properties
      'href' => string,           // The target URL
      'text' => string,          // Link text (localized if localizer was provided)
      'icon' => ?string,         // Optional icon identifier
      
      // Attributes
      'array-attributes' => [    // Array of HTML attributes
          [
              'key' => 'href',
              'value' => string   // The target URL
          ],
          // Additional attributes...
      ],
      'html-attributes' => string, // Rendered HTML attributes
      
      // State information
      'isExternal' => bool,      // Whether the link points to an external site
      'isNewWindow' => bool,     // Whether the link opens in a new window
      'hasIcon' => bool,         // Whether the link has an icon
      'accessKey' => ?string,    // Access key if specified
      'rel' => ?string,          // Link relation type
      'target' => ?string,       // Target attribute value
      'title' => ?string,        // Title attribute
      'class' => string,         // CSS classes
      'data' => array           // Data attributes
  ]
  ```
- **Example**:
  ```php
  $link = new IslamComponentLink(
      'https://example.com',
      'Example',
      'external-link',
      null,
      'e'
  );
  
  $data = $link->getTemplateData();
  /*
  Returns:
  [
      'href' => 'https://example.com',
      'text' => 'Example',
      'icon' => 'external-link',
      'isExternal' => true,
      'isNewWindow' => true,
      'accessKey' => 'e',
      'rel' => 'external noopener noreferrer',
      'target' => '_blank',
      'class' => 'external',
      // ...
  ]
  */
  ```
- **Behavior**:
  - Processes the link URL to determine if it's external
  - Adds appropriate attributes for external links (target, rel)
  - Localizes the link text if a localizer was provided
  - Handles access keys and icons
  - Prepares all attributes for HTML output
  - Processes access key hints if provided
  - Adds tooltips and access key attributes if localizer is available
  - Handles internationalization of link labels

## 🎨 Template Integration

### Data Structure
When used in templates, the Link component provides data in the following structure:

```php
[
    // Basic properties
    'href' => '/wiki/Main_Page',
    'text' => 'Home',
    'icon' => 'home',
    
    // State flags
    'isExternal' => false,
    'isNewWindow' => false,
    'hasIcon' => true,
    
    // Attributes
    'accessKey' => 'h',
    'rel' => null,
    'target' => null,
    'title' => 'Home [h]',
    'class' => 'nav-link',
    
    // Data attributes
    'data' => [
        'tracking' => 'nav-home'
    ],
    
    // HTML attributes
    'array-attributes' => [
        ['key' => 'href', 'value' => '/wiki/Main_Page'],
        ['key' => 'class', 'value' => 'nav-link'],
        // ...
    ],
    'html-attributes' => 'href="/wiki/Main_Page" class="nav-link"',
]
```

### Example Template Usage

```handlebars
<a href="{{href}}" 
   class="{{class}}{{#hasIcon}} has-icon{{/hasIcon}}"
   {{#target}}target="{{.}}"{{/target}}
   {{#rel}}rel="{{.}}"{{/rel}}
   {{#title}}title="{{.}}"{{/title}}
   {{#data}}
       data-{{@key}}="{{.}}"
   {{/data}}>
    
    {{#hasIcon}}
    <span class="icon icon-{{icon}}" aria-hidden="true"></span>
    {{/hasIcon}}
    
    <span class="link-text">
        {{text}}
        {{#isExternal}}
        <span class="external-indicator" aria-hidden="true">↗</span>
        {{/isExternal}}
    </span>
    
    {{#accessKey}}
    <span class="access-key-hint" aria-hidden="true">{{.}}</span>
    {{/accessKey}}
</a>
```

## 🏆 Best Practices

### When to Use
- For all navigational links in the skin
- When you need consistent link styling and behavior
- For links that require localization or accessibility features
- When you need to handle external links consistently

### Accessibility Considerations
- Always provide meaningful link text
- Use the `localizer` parameter for internationalization
- Icons should be decorative with `aria-hidden="true"`
- External links should indicate they open in a new window
- Use access keys sparingly and document them
- Ensure sufficient color contrast for text and icons

## 🔍 Troubleshooting

### Common Issues

1. **Link Not Working**
   - Verify the URL is correctly formatted
   - Check for JavaScript errors
   - Ensure the link isn't being prevented by an event handler

2. **Missing Icon**
   - Verify the icon name matches the icon font class
   - Check if the icon font is loaded
   - Ensure the icon CSS is included

3. **Localization Not Working**
   - Ensure a MessageLocalizer instance is provided
   - Verify the message key exists in the i18n files
   - Check for typos in message keys

## 🚀 Advanced Usage

### Creating a Custom Link Component

```php
class CustomLink extends IslamComponentLink {
    public function getTemplateData(): array {
        $data = parent::getTemplateData();
        
        // Add custom data attributes
        $data['data-custom'] = 'value';
        
        // Modify existing attributes
        if ($this->isExternal) {
            $data['class'] .= ' external-link';
        }
        
        return $data;
    }
}
```

### Adding Tracking to Links

```php
// In your skin or component class
public function createTrackedLink(string $url, string $text, string $category): IslamComponentLink {
    $link = new IslamComponentLink($url, $text, null, $this);
    $link->setData('tracking', $category);
    return $link;
}

// Usage
$link = $this->createTrackedLink('/wiki/Main_Page', 'Home', 'nav-main');
```

## 📚 See Also

- [Menu Component](./menu/overview.md) - For creating navigation menus
- [MenuListItem Component](../templates/menu/list-item.md) - For menu items containing links
- [UserInfo Component](./user-info.md) - For user-related links and information
- [Accessibility Guidelines](../architecture/accessibility.md) - For creating accessible links

## 📝 Version History

| Version | Changes                          |
|---------|----------------------------------|
| 1.0.0   | Initial release                  |
| 1.1.0   | Added external link handling     |
| 1.2.0   | Improved accessibility features  |
| 1.3.0   | Added icon support               |

## Usage Example
```php
// Create a simple link
$link = new IslamComponentLink(
    '/wiki/Main_Page',
    'Home',
    'home',
    $localizer,
    'home-access'
);

// Get template data
$templateData = $link->getTemplateData();
```

## Notes
- The component supports internationalization through the `MessageLocalizer`
- Access keys and tooltips are automatically handled when a localizer is provided
- Icons are optional and should be referenced by their identifier (without the 'mw-ui-icon-' prefix)
- The component is designed to work with the `IslamComponentMenu` and `IslamComponentMenuListItem` components
