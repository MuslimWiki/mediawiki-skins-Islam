# IslamComponentUserInfo

> **Version Compatibility**: MediaWiki 1.43+

## 📋 Overview
`IslamComponentUserInfo` is a core component that manages the display of user-related information in the Islam skin. It's primarily responsible for rendering the user menu that appears when clicking on the user icon in the header, providing quick access to user account options and information.

### UserInfo Component Example

```html
<div class="user-info">
  <button class="user-button" aria-expanded="false" aria-controls="user-dropdown">
    <span class="user-avatar">
      <img src="/path/to/avatar.jpg" alt="User Avatar" width="32" height="32">
    </span>
    <span class="user-name">JohnDoe</span>
    <span class="dropdown-arrow">▼</span>
  </button>
  
  <div id="user-dropdown" class="user-dropdown" hidden>
    <div class="user-details">
      <div class="user-avatar-large">
        <img src="/path/to/avatar.jpg" alt="User Avatar" width="64" height="64">
      </div>
      <div class="user-meta">
        <div class="username">JohnDoe</div>
        <div class="user-email">john@example.com</div>
        <div class="user-editcount">1,234 edits</div>
      </div>
    </div>
    
    <ul class="user-links">
      <li><a href="/wiki/User:JohnDoe">My Profile</a></li>
      <li><a href="/wiki/User:JohnDoe/Contributions">My Contributions</a></li>
      <li><a href="/wiki/Special:Preferences">Preferences</a></li>
      <li><a href="/wiki/Special:Watchlist">Watchlist</a></li>
      <li class="divider"></li>
      <li><a href="/wiki/Special:UserLogout">Log out</a></li>
    </ul>
  </div>
</div>
```

## 🏗️ Basic Usage

### Creating a UserInfo Component

```php
use Islam\Components\IslamComponentUserInfo;
use MediaWiki\MediaWikiServices;

// Get required services
$services = MediaWikiServices::getInstance();
$user = $services->getUserFactory()->newFromUserIdentity($userIdentity);
$title = $services->getTitleFactory()->newFromText('User:' . $user->getName());

// Create the UserInfo component
$userInfo = new IslamComponentUserInfo(
    $services,
    $services->getContentLanguage(),
    $this, // MessageLocalizer
    $title,
    $user
);

// Get template data for rendering
$userData = $userInfo->getTemplateData();
```

### Displaying User Information

```php
// In your template or skin class
$userData = $userInfo->getTemplateData();

// Example of displaying user info in a dropdown
$html = \Html::openElement('div', ['class' => 'user-menu']);
$html .= \Html::element('div', [
    'class' => 'user-avatar',
    'style' => 'background-image: url(' . $userData['avatar']['src'] . ')'
]);
$html .= \Html::element('span', ['class' => 'user-name'], $userData['username']);
$html .= \Html::closeElement('div');
```

## 📂 File Location
`/includes/Components/IslamComponentUserInfo.php`

## 🔗 Dependencies
- `MediaWiki\Html\Html` - HTML generation utilities
- `MediaWiki\Language\Language` - Language and localization support
- `MediaWiki\MediaWikiServices` - Core MediaWiki services
- `MediaWiki\Title\*` - Title-related classes
- `MediaWiki\User\User` - User account management
- `MessageLocalizer` - Interface for message localization

## 🔄 Related Components
- [Menu](./menu/overview.md) - Used for the user dropdown menu
- [Link](./link.md) - Used for navigation links in the user menu
- [MenuListItem](../templates/menu/list-item.md) - Used for individual menu items

## 🏗️ Class Structure

### Properties
- `private MediaWikiServices $services` - MediaWiki services instance
- `private Language $lang` - Language object for localization
- `private MessageLocalizer $localizer` - For message localization
- `private Title $title` - Current title object
- `private User $user` - Current user object
- `private array $userPageData` - User page related data
- `private array $userMenuItems` - Cached user menu items

## Methods

### `__construct()`
- **Parameters**:
  - `MediaWikiServices $services` - MediaWiki services instance
  - `Language $lang` - Language object for localization
  - `MessageLocalizer $localizer` - For message localization
  - `Title $title` - Current title object
  - `User $user` - Current user object
- **Description**: Initializes the UserInfo component with required dependencies
- **Example**:
  ```php
  $userInfo = new IslamComponentUserInfo(
      $services,
      $services->getContentLanguage(),
      $this,
      $title,
      $user
  );
  ```

### `getTemplateData()`
- **Returns**: `array` - Template data for rendering the user info
- **Description**: Prepares and returns all user information needed for templates
- **Return Structure**:
  ```php
  [
      'username' => string,         // User's display name
      'userpage' => [              // User page link
          'href' => string,         // URL to user page
          'text' => string,         // Display text
          'title' => string,        // Link title
          'exists' => bool          // Whether the page exists
      ],
      'avatar' => [                // User avatar information
          'src' => string,         // Image source URL
          'alt' => string,         // Alt text
          'width' => int,          // Image width
          'height' => int          // Image height
      ],
      'editcount' => [             // Edit count information
          'value' => string,       // Formatted edit count
          'label' => string        // Localized label
      ],
      'registration' => [          // Registration date
          'value' => string,       // Formatted date HTML
          'label' => string        // Localized label
      ],
      'groups' => [                // User groups
          'value' => string,       // Comma-separated group names
          'label' => string        // Localized label
      ],
      'menu' => [                  // User menu items
          // Array of menu items
      ]
  ]
  ```

### `getUserEditCount()`
- **Returns**: `?array` - User's edit count with label or null if not available
- **Description**: Gets the user's edit count formatted with a localized label
- **Example Output**:
  ```php
  [
    'value' => '1,234',
    'label' => 'edits',
    'title' => 'Total number of edits',
    'class' => 'user-editcount'
  ]
  ```
- **Usage**:
  ```php
  $editCount = $userInfo->getUserEditCount();
  if ($editCount) {
      echo "{$editCount['value']} {$editCount['label']}";
  }
  ```

### `getUserRegistration()`
- **Returns**: `?array` - User's registration date with label or null if not available
- **Description**: Gets the user's registration date in a formatted HTML string with proper time element
- **Example Output**:
  ```php
  [
    'value' => '<time class="islam-user-regdate" datetime="2023-01-01T00:00:00Z" 
                data-timestamp="1672531200">January 1, 2023</time>',
    'label' => 'Joined on',
    'class' => 'user-registration',
    'timestamp' => 1672531200
  ]
  ```
- **Usage**:
  ```php
  $registration = $userInfo->getUserRegistration();
  if ($registration) {
      echo "{$registration['label']} {$registration['value']}";
  }
  ```

### `getUserGroups()`
- **Returns**: `?array` - User's groups with label or null if not available
- **Description**: Gets the user's groups as a formatted string with label
- **Example Output**:
  ```php
  [
    'value' => 'Administrator, Sysop, Editor',
    'label' => 'Groups',
    'class' => 'user-groups',
    'groups' => ['sysop', 'editor']
  ]
  ```
- **Usage**:
  ```php
  $groups = $userInfo->getUserGroups();
  if ($groups) {
      echo "<strong>{$groups['label']}:</strong> {$groups['value']}";
  }
  ```

### `getUserMenuItems()`
- **Returns**: `array` - Array of menu items for the user dropdown
- **Description**: Gets the list of menu items to display in the user dropdown
- **Example Output**:
  ```php
  [
      [
          'text' => 'My Preferences',
          'href' => '/wiki/Special:Preferences',
          'icon' => 'settings',
          'class' => 'menu-item',
          'id' => 'pt-preferences'
      ],
      // ... more menu items
  ]
  ```
- **Usage**:
  ```php
  $menuItems = $userInfo->getUserMenuItems();
  foreach ($menuItems as $item) {
      echo "<a href='{$item['href']}'>{$item['text']}</a>";
  }
  ```
- **Description**: Gets the list of user groups the current user belongs to
- **Uses**: `IslamComponentLink` and `IslamComponentMenuListItem`
- **Example Output**:
  ```php
  [
    'array-list-items' => [
      // Array of menu list items
    ]
  ]
  ```

### `getUserPage()`
- **Returns**: `array`
- **Description**: Builds the template data for the user page menu
- **Modifies**: Adds real name and username to the user menu
- **Uses**: `IslamComponentMenu`

### `getTemplateData()`
- **Returns**: `array`
- **Description**: Main method that compiles all user information for the template
- **Behavior**:
  - For registered users:
    - Shows user page menu
    - Displays edit count and registration date
    - Shows user groups (if not a temporary account)
  - For anonymous users:
    - Shows "not logged in" message
    - Displays login/registration prompt

## Template Usage
This component is typically used in the header of the skin to display user information. The data from `getTemplateData()` is passed to a Mustache template that renders the user menu.

## Styling
- The component uses the following CSS classes:
  - `islam-user-regdate` - For the registration date element
  - `islam-userInfo-usergroup` - For user group list items

## Related Components
- `IslamComponentMenu` - Used for rendering the dropdown menu
- `IslamComponentLink` - Used for creating links in the user menu
- `IslamComponentMenuListItem` - Used for menu items

## Notes
- The component handles both temporary and permanent user accounts
- All text is localized using the MessageLocalizer
- The registration date is formatted according to the user's language preferences
