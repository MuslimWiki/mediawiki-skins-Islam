# Template Best Practices

> **Version Compatibility**: MediaWiki 1.43+

## 📋 Overview

This guide outlines the best practices for working with Mustache templates in the Islam skin. Following these guidelines will ensure consistency, maintainability, and performance across your templates.

## 🏗️ Template Structure

### File Naming
- Use `PascalCase` for template filenames (e.g., `UserMenu.mustache`)
- Place templates in the appropriate subdirectory under `templates/`
- Keep template files focused on a single responsibility

### Basic Template Structure

```handlebars
{{! Template: Example.mustache }}
{{! 
    Description: Brief description of what this template does
    Variables:
    - variable1: Description
    - variable2: Description (optional)
    - variable3: Description (default: value)
}}

{{! Main template content }}
<div class="example {{#class}}{{.}} {{/class}}" 
     {{#id}}id="{{.}}"{{/id}}
     {{#data}}data-{{@key}}="{{.}}"{{/data}}>
     
    {{! Content goes here }}
    
</div>
```

## 🔧 Template Guidelines

### 1. Variable Usage

#### Use Contextual Variables
```handlebars
{{! Good }}
<div class="alert {{type}}">{{message}}</div>

{{! Avoid }}
<div class="alert {{alert-type}}">{{alert-message}}</div>
```

#### Default Values
```handlebars
{{! Using the "or" operator for defaults }}
{{title or "Default Title"}}

{{! Using hash fallback }}
{{#customTitle}}{{.}}{{/customTitle}}
{{^customTitle}}Default Title{{/customTitle}}
```

### 2. Conditional Rendering

#### Basic Conditionals
```handlebars
{{#isActive}}
    <span class="active-indicator">Active</span>
{{/isActive}}

{{^isReadOnly}}
    <button>Edit</button>
{{/isReadOnly}}
```

#### Complex Conditions
```handlebars
{{#hasPermission}}
    {{#isOwner}}
        <button>Delete</button>
    {{/isOwner}}
{{/hasPermission}}
```

### 3. Loops and Iteration

#### Basic Loop
```handlebars
<ul class="items">
    {{#items}}
        <li class="item">{{.}}</li>
    {{/items}}
</ul>
```

#### Loop with Index
```handlebars
{{#items}}
    <div class="item item-{{@index}}">
        {{#if @first}}First: {{/if}}
        {{#if @last}}Last: {{/if}}
        {{.}}
    </div>
{{/items}}
```

### 4. Partials and Includes

#### Basic Include
```handlebars
{{> Button text="Click me" type="primary" }}
```

#### Dynamic Partial Names
```handlebars
{{! Renders the partial with the name stored in 'partialName' }}
{{> (lookup . 'partialName') }}
```

## 🎨 Styling Guidelines

### Class Naming
- Use BEM (Block Element Modifier) naming convention
- Prefix classes with component name (e.g., `islam-menu__item`)
- Use utility classes for common styles

### Responsive Design
```handlebars
<div class="islam-component">
    <div class="islam-component__content">
        {{! Mobile-first content }}
        <div class="islam-component__header">...</div>
        
        {{! Desktop-specific content }}
        <div class="islam-component__desktop-only">
            {{! Desktop content }}
        </div>
    </div>
</div>
```

## ⚡ Performance Tips

### Minimize Logic in Templates

#### Instead of:
```handlebars
{{#if user.role == 'admin' || user.role == 'moderator'}}
    <button>Admin Action</button>
{{/if}}
```

#### Do:
```handlebars
{{#user.canPerformAdminAction}}
    <button>Admin Action</button>
{{/user.canPerformAdminAction}}
```

### Cache Partial Templates
```handlebars
{{! Cache this partial for 3600 seconds (1 hour) }}
{{#cached 'user-profile-' user.id 3600}}
    {{> UserProfile user=user }}
{{/cached}}
```

## 🔒 Security Best Practices

### Always Escape Dynamic Content
```handlebars
{{! Good - automatically escaped }}
<div>{{userInput}}</div>

{{! Dangerous - unescaped HTML }}
<div>{{{trustedHtml}}}</div>
```

### Sanitize User Input
```handlebars
{{! Sanitize in PHP before passing to template }}
$context['userComment'] = $sanitizer->sanitize($userInput);

{{! Then in template: }}
<div class="comment">{{userComment}}</div>
```

## 🔄 Template Versioning

### Versioning Strategy
- Include version comments in template files
- Document breaking changes in release notes
- Provide migration guides for major version changes

### Version Check
```handlebars
{{! Template: Example.mustache }}
{{! Version: 1.2.0 }}
{{! 
    Changelog:
    - 1.2.0: Added support for dark mode
    - 1.1.0: Improved accessibility
    - 1.0.0: Initial release
}}
```

## 🧪 Testing Templates

### Test Cases
1. Test with all required variables
2. Test with optional variables missing
3. Test with empty data sets
4. Test edge cases (null, empty strings, etc.)

### Example Test Case
```javascript
const template = require('templates/Example.mustache');

describe('Example Template', () => {
    it('renders with required props', () => {
        const data = { title: 'Test' };
        const html = template(data);
        expect(html).toContain('Test');
    });
});
```

## 📚 Related Resources

- [Mustache Documentation](https://mustache.github.io/mustache.5.html)
- [MediaWiki Skin Development](https://www.mediawiki.org/wiki/Manual:Skinning)
- [BEM Methodology](http://getbem.com/)
- [Islam Skin Components](../components/README.md)

## 🤝 Contributing

When contributing to templates:
1. Follow existing patterns
2. Add documentation for new variables
3. Include test cases
4. Update version numbers
5. Document breaking changes

## 📝 Version History

| Version | Changes |
|---------|---------|
| 1.0.0   | Initial release |
| 1.1.0   | Added template versioning |
| 1.2.0   | Added security best practices |
