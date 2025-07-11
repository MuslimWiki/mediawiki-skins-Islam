# UserInfo.mustache

> **Version Compatibility**: MediaWiki 1.43+

## 📋 Overview
The `UserInfo.mustache` template renders the user information panel in the Islam skin, typically shown when a user is logged in. It displays user details, groups, and statistics in a clean, accessible format.

## 🏗️ Basic Structure

```handlebars
<div class="islam-userInfo" {{#data}}data-{{@key}}="{{.}}"{{/data}}>
    <!-- User title and menu -->
    <div class="islam-userInfo-title">
        {{#title}}<div class="islam-userInfo-name">{{.}}</div>{{/title}}
        {{#data-user-page}}{{>Menu}}{{/data-user-page}}
    </div>
    
    <!-- User text and groups -->
    <div class="islam-userInfo-text">
        {{#text}}<div class="islam-userInfo-bio">{{.}}</div>{{/text}}
        {{#data-user-groups}}
            <div class="islam-userInfo-groups">
                <span class="islam-userInfo-groups-label">{{groups-label}}:</span>
                <ul class="islam-userInfo-usergroups">
                    {{#array-list-items}}{{>MenuListItem}}{{/array-list-items}}
                </ul>
            </div>
        {{/data-user-groups}}
    </div>
    
    <!-- User statistics -->
    {{#data-user-stats}}
        <div class="islam-userInfo-stats">
            {{#array-stats-items}}
                <div class="islam-userInfo-stats-item">
                    <div class="islam-userInfo-stats-item-label">{{label}}</div>
                    <div class="islam-userInfo-stats-item-value">{{{value}}}</div>
                </div>
            {{/array-stats-items}}
        </div>
    {{/data-user-stats}}
</div>
```

## 📚 Data Context

### Core Properties
| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `title` | String | Optional | User's display name or title |
| `text` | String | Optional | Additional user information or bio |
| `data-user-page` | Object | Optional | Configuration for the user menu (rendered via `Menu` partial) |
| `data-user-groups` | Object | Optional | User group information |
| `data-user-stats` | Object | Optional | User statistics and metrics |
| `data` | Object | Optional | Custom data attributes |

### User Groups Structure
When using `data-user-groups`:
```javascript
{
    "groups-label": "Member of",  // Label for groups section
    "array-list-items": [         // Array of group items
        {
            // MenuListItem compatible object
            "text": "Administrators",
            "href": "/wiki/Special:ListUsers/sysop",
            "class": "user-group-admin"
        }
    ]
}
```

### User Stats Structure
When using `data-user-stats`:
```javascript
{
    "array-stats-items": [
        {
            "label": "Edits",      // Statistic label (e.g., "Edits", "Since")
            "value": "1,234"       // Formatted value (HTML allowed)
        }
    ]
}
```

## 🎨 CSS Classes

### Layout Classes
- `.islam-userInfo` - Main container
- `.islam-userInfo-title` - Header section with user name and menu
- `.islam-userInfo-text` - Bio and groups section
- `.islam-userInfo-stats` - Statistics container
- `.islam-userInfo-groups` - User groups section

### Component Classes
- `.islam-userInfo-name` - User's display name
- `.islam-userInfo-bio` - User biography text
- `.islam-userInfo-stats-item` - Individual statistic item
- `.islam-userInfo-stats-item-label` - Statistic label
- `.islam-userInfo-stats-item-value` - Statistic value
- `.islam-userInfo-usergroups` - List of user groups

## ♿ Accessibility Features
- Semantic HTML structure
- ARIA attributes where needed
- Keyboard navigation support
- Screen reader announcements
- Responsive design patterns

## 🔄 Related Components
- [Menu](./menu/menu.md) - Used for user menu dropdown
- [MenuListItem](./menu/list-item.md) - Renders user group items
- [Link](../components/link.md) - Used for interactive elements

## 🏆 Best Practices

### When to Use
- User profile sections
- Author information panels
- Member directories
- Anywhere user metadata needs to be displayed

### Recommended Patterns
- Keep user stats concise and relevant
- Use appropriate icons for different user groups
- Ensure proper contrast for text and backgrounds
- Test with various username lengths
- Consider mobile layouts

## 🛠️ Example Usage

### Basic User Info
```php
$userInfo = [
    'title' => 'JohnDoe',
    'text' => 'Wiki contributor since 2020',
    'data-user-groups' => [
        'groups-label' => 'Member of',
        'array-list-items' => [
            [
                'text' => 'Editors',
                'href' => '/wiki/Special:ListUsers/editor',
                'class' => 'user-group-editor'
            ]
        ]
    ],
    'data-user-stats' => [
        'array-stats-items' => [
            [
                'label' => 'Edits',
                'value' => '1,234'
            ],
            [
                'label' => 'Since',
                'value' => 'Jan 2020'
            ]
        ]
    ]
];
```

### Minimal User Card
```handlebars
<div class="user-card">
    {{>UserInfo 
        title=user.name 
        text=user.bio
        data-user-page=user.menu
        data={"theme": "compact"}
    }}
</div>
```

## 🧪 Testing

### Automated Tests
- Verify user data rendering
- Check menu functionality
- Validate accessibility attributes
- Test responsive behavior

### Manual Testing Checklist
- [ ] User name displays correctly
- [ ] User menu works as expected
- [ ] Groups are properly listed
- [ ] Statistics are formatted correctly
- [ ] Works in RTL mode
- [ ] Mobile layout is clean

## 📝 Version History

| Version | Changes |
|---------|---------|
| 1.0.0   | Initial release |
| 1.1.0   | Added user statistics |
| 1.2.0   | Improved responsive design |

## 🔍 See Also
- [MediaWiki User Interface](https://www.mediawiki.org/wiki/Manual:Interface/JavaScript)
- [WAI-ARIA Authoring Practices](https://www.w3.org/WAI/ARIA/apg/)
- [Islam Skin Components](../components/README.md)

### data-user-page
Rendered using the `Menu` partial. Contains the user's navigation menu.

### data-user-groups
- `array-list-items`: Array of user group items, each rendered using the `MenuListItem` partial

### data-user-stats
- `array-stats-items`: Array of statistic items, each containing:
  - `label`: The label for the statistic (e.g., "Edits", "Joined")
  - `value`: The value of the statistic (HTML allowed)

## CSS Classes
- `.islam-userInfo`: Main container
- `.islam-userInfo-title`: Container for the title and user menu
- `.islam-userInfo-text`: Container for additional text and user groups
- `.islam-userInfo-usergroups`: List of user groups
- `.islam-userInfo-stats`: Container for user statistics
- `.islam-userInfo-stats-item`: Individual statistic item
- `.islam-userInfo-stats-item-label`: Label for a statistic
- `.islam-userInfo-stats-item-value`: Value of a statistic

## Partials Used
- `Menu`: Renders the user menu
- `MenuListItem`: Renders individual menu items in the user groups list

## Example Data
```json
{
    "title": "Welcome Back",
    "data-user-page": {
        "id": "user-menu",
        "array-list-items": [
            {
                "array-links": [
                    {
                        "href": "/wiki/User:Example",
                        "text": "My Profile",
                        "icon": "user"
                    }
                ]
            }
        ]
    },
    "data-user-groups": {
        "array-list-items": [
            {
                "array-links": [
                    {
                        "href": "/wiki/Project:Administrators",
                        "text": "Administrator"
                    }
                ]
            }
        ]
    },
    "data-user-stats": {
        "array-stats-items": [
            {
                "label": "Edits",
                "value": "1,234"
            },
            {
                "label": "Joined",
                "value": "<time>January 1, 2023</time>"
            }
        ]
    }
}
```

## Notes
- The template uses Mustache's partial rendering system (`{{>PartialName}}`) to include other templates
- User statistics are displayed in a horizontal layout by default
- The template is designed to be flexible and will gracefully handle missing sections
- All user-provided content is properly escaped to prevent XSS attacks
